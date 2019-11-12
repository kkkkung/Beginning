<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/16
 * Time: 15:03
 *
 * 说明：
 * 这个模块使用户能够加入到这个网站，完成对网站的注册
 * 好好看看使用JS和PHP对表单做安全处理
 */

require_once 'header.php';

echo <<<_END
<script>
function checkUser(user){
    if (user.value == ''){
        O('info').innerHTML = ''
        return
    }

    params = "user=" + user.value
    request = new ajaxRequest()
    request.open("POST", "checkuser.php", true)
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    request.setRequestHeader("Content-length", params.length)
    request.setRequestHeader("Connection", "close")

    request.onreadystatechange = function(){
                                if(this.readyState == 4)
                                    if(this.status == 200)
                                        if(this.responseText != null)
                                            O('info').innerHTML = this.responseText
                             }
    request.send(params)
}

function ajaxRequest(){
    try { var request = new XMLHttpRequest() }
    catch(e1){
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch (e2){
            try { request = new ActiveXObject("Microsoft.XMLHTTP") }
            catch(e3) {
                request = false
            }
        }    
    }
    return request
}
</script>
<div class = 'main'><h3>Please enter your details to sign up</h3>
_END;

$error = $user = $pass = "";

//检查当前页面是否有会话在进行，如果有则调用function.php中直接定义的函数销毁会话
if (isset($_SESSION['user'])) destroySession();
//如果有user的键值对被POST上来
if (isset($_POST['user'])) {
    //对POST上来的user和pass进行处理
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    //或许我们应该对密码除了安全的处理以外还应该进行复杂的的处理

    if ($user == "" || $pass == "")
        $error = "No all fields were entered <br><br>";
    else {
        $result = queryMysql("SELECT * FROM members WHERE user='$user'");
        if ($result->num_rows)
            $error = "That username already exists <br><br>";
        else {
            queryMysql("INSERT INTO members VALUES('$user','$pass')");
            die("<h4>Account created </h4>Please Log in.");
        }
    }
}

echo <<<_END
    <form method="post" action="signup.php"> $error
    <span class="fieldname">Username</span>
    <input type="text" maxlength="16" name="user" value="$user" onblur="checkUser(this)"><span id="info"></span><br>
    <span class="fieldname">Password</span>
    <input type="password" maxlength="16" name="pass" value="$pass"><br> 
    <span class="fieldname">&nbsp</span>
    <input type="submit" value="Sign up">
</form></div><br>
</body>
</html>
_END;
