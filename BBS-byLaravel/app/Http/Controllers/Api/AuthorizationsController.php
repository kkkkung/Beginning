<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;



class AuthorizationsController extends Controller
{
    /*
     * 第三方登录返回Token
     */
    protected function responseWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
    /*
     * 第三方（微信）认证注册用户
     */
    public function socialStore($type, SocialAuthorizationRequest $request)
    {
        if (!in_array($type, ['weixin'])) {
            return $this->response->errorBadRequest();
        }

        // 创建 Socialite 微信（$type='weixin'）驱动实例
        $driver = Socialite::driver($type);

        try {
            // 如果请求中存在code字段，使用code获取 access token
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                // 否则token值为请求中的access_token
                $token = $request->access_token;
                // 如果请求认证的类型为weixin，为驱动实例设置openID
                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }
            // 已经有了access token 和 openID 后可用拉取用户信息
            $oauthUser = $driver->userFromToken($token);
        } catch (Exception $e) {
            // 如果拉取用户信息过程中出错，则返回一个认证失败的响应
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }

        //对拉取下来的用户信息做处理
        switch ($type) {
            case 'weixin' :
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                //没有用户，默认创建一个用户
                if (!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }
        //通过获取到用户模型使用 fromUser 方法为该用户模型生成 token
        $token =Auth::guard('api')->fromUser($user);
        return $this->responseWithToken($token)->setStatusCode(201);
    }

    /*
     * 通过用户名（邮箱或手机）认证用户登录
     */
    public function store(AuthorizationRequest $request)
    {
        $username = $request->input('username');

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->input('password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'exprires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    /*
     * 刷新 Token
     */
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->responseWithToken($token);
    }

    /*
     * 删除 Token
     */
    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }
}
