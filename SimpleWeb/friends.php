<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/19
 * Time: 14:44
 *
 * 说明
 * 该模块是用于说明某个用户的好友和追求者的模块。
 * 所有追求者被保存在叫$followers的数组中，所有被追求的人被放置在叫做$following的数组中
 * array_intersect 函数用来提取所有两个数组共用的成员并返回一个新的只包含这些人的数组。这个数组而后被保存在$mutual中
 * 可以将array_diff函数用于每个$followers和$following数组，只保留那些不是互为好友的用户信息
 */

require_once 'header.php';

if (!$loggedin) die();

if (isset($_GET['view']))   $view = sanitizeString($_GET['view']);
else                        $view = $user;

if ($view == $user){
    $name1 = $name2 = "Your";
    $name3 =          "You are";
}else{
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}

echo "<div class='main'>";

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num = $result->num_rows;
for ($j=0;$j<$num;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num = $result->num_rows;
for ($j=0;$j<$num;$j++){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['user'];
}

//array_intersect()函数用来提取两个数组共用的成员返回一个新的只包含这些人的数组。
$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;

if (sizeof($mutual)){
    echo "<span class='subhead'>$name2 mutual friends</span><ul>";
    foreach ($mutual as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a> ";
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($followers)){
    echo "<span class='subhead'>$name2 followers</span><ul>";
    foreach ($followers as $friend) {
        echo "<li><a href='members.php?view=$friend'>$friend</a> ";
    }
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($following)){
    echo "<span class='subhead'>$name3 following</span><ul>";
    foreach ($following as $friend) {
        echo "<li><a href='members.php?view=$friend'>$friend</a> ";
    }
    echo "</ul>";
    $friends = TRUE;
}

if (!$friends) echo "<br>You don't have any friends yet.<br><br>";

echo "<a class='button' href='messages.php?view=$view'>"."View $name2 messages</a>";

echo <<<_END
</div>
<br>
</body>
</html>
_END;
