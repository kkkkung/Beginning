<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/16
 * Time: 16:26
 *
 * 说明：
 * 该文件被signup.php中JS模块AJax实时调用检查输入的用户是否已被注册
 */

require_once 'function.php';

if (isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $result = queryMysql("SELECT * FROM members WHERE user='$user'");

    if ($result->num_rows)
        echo "<span class='taken'>&nbsp;#x2718;".
            "This username is taken</span>";
    else
        echo "<span class='available'>&nbsp;&#x2714;".
            "This username is available </span>";
}