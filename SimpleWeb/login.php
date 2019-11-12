<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/16
 * Time: 20:39
 *
 * 说明：
 * 该段代码主要用于登陆
 *
 * 看过代码后才知道，原来登陆就是对会话的设置
 *
 */

require_once 'header.php';

echo "<div class='main'> <h3>Please enter your details to log in</h3>";
$error = $user = $pass = '';

if(isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == '' ||$pass == '')
        $error = "Not all fields were entered <br>";
    else{
        $result = queryMysql("SELECT 1 FROM members WHERE user='$user' AND pass='$pass'");

        if ($result -> num_rows == 0){
            $error = "<span calss='error'>Username/Password invalid</span><br><br>";
        }
        else{
            /**这下面的代码是该文件中的核心功能
             * 对成功POST上来的用户名和密码进行了数据库的对比验证后
             * 对会话的进行键值对的储存，用以表示用户的登陆状态
             */
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("You are now logged in. Please <a href='members.php?view=$user'>".
                "click here</a> to continue.<br><br>");
        }
    }
}
echo <<<_END
<form method="post" action="login.php">$error
<span class="fieldname">Username</span><input type="text" maxlength="16" name="user" value="$user"><br>
<span class="fieldname">Password</span><input type="password" maxlength="16" name="pass" value="$pass">
<br>
<span class="fieldname">&nbsp;</span>
<input type="submit" value="Login">
</form><br><br></div>
</body>
</html>
_END;

