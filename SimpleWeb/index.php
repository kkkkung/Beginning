<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/15
 * Time: 16:37
 *
 * 说明：
 * 这个文件很普通，但在为项目设置主页中却是必须的。其说要做的就是显示一条简单的欢迎信息。在程序结尾处，显示一些鼓励注册的信息
 *
 */

require_once 'header.php';

echo "<br><br><span class='main'>Welcome to $appname,";

if ($loggedin) echo "$user, you are logged in.";
else           echo "please sign up and/or log in to join in.";

echo "</span><br><br><br></body></html>";

