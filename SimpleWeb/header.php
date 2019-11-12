<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/15
 * Time: 15:46
 *说明：
 * 为了统一每一页都需要使用相同的特征集，因此这些特征都被放在了这个header文件中
 *
* 该文件输出　Echo出了一个网页（HTML）需要的基本架构头，包括了标记<html><head>以及<body>中定义了一些每个网页都会显示的内容
 *
 */

session_start();

echo "<!DOCTYPE html>\n <html><head>";

require_once 'function.php';

$userstr = '(Guest)';

//通过检查超全局变量$_SESSION 看有没有user的值，如果有则代表登陆过了
if(isset($_SESSION['user'])){
    $user        = $_SESSION['user'];
    $loggedin    = TRUE;
    $userstr     = "($user)";
}
else
    $loggedin = FALSE;

echo "<title>$appname$userstr</title><link rel='stylesheet' ".
    "href='styles.css' type='text/css'>"                     .          //CSS文件样式直接拷贝的书中给出的源码文件
    "</head><body><center><canvas id='logo' width='624'"     .
    "height ='96'>$appname</canvas></center>"                .
    "<div class='appname'>$appname$userstr</div>"            .
    "<script src='javascript.js'></script>";                            //画布文件，生成图片的JS文件直接拷贝的源码

if ($loggedin)
    echo "<br><ul class='menu'>"   .
        "<li><a href='members.php?view=$user'>Home</a></li>".
        "<li><a href='members.php'>Members</a></li>"        .
        "<li><a href='friends.php'>Friends</a></li>"        .
        "<li><a href='messages.php'>Messages</a></li>"      .
        "<li><a href='profile.php'>Edit Profile</a></li>"   .
        "<li><a href='logout.php'>Log Out</a></li></ul><br>";
else
    echo "<br><ul class='menu'> "   .
        "<li><a href='index.php'>Home</a> </li>".
        "<li><a href='signup.php'>Sign up</a> </li>".
        "<li><a href='login.php'>Log in</a> </li>"  .
        "<br><br><span class='info' >&#8658;You Must be logged in to".
        " view this page.</span></ul><br>";

//书上注释，要我们注意！再网页布局中使用<br>标记创建间距，是一个快捷但丑陋的方法。通常会使用CSS边距来微调元素间的间距