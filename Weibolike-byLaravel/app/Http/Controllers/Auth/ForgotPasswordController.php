<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */



    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

//    public function forgot()
//    {
//        return view('auth.forgot');
//    }

//    public function sendEmail(Request $request)
//    {
//        $request->validate( [
//            'email' => 'required|email|exists:users,email'
//        ]);
//
//        $this->emailMaker($request->email);
//        return redirect('/')->with('warning', 'We send you one email make you reset password.');
//
//    }
//
//    protected function emailMaker($token)
//    {
//        Mail::to($email)->send(new PasswordReset($token));
//    }
}
