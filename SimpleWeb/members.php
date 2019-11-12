<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/18
 * Time: 15:57
 *
 * 说明
 * 这个程序有两种模式
 * 第一种模式用于列出所有成员及他们与你的关系。
 * 在测试GET变量add和remove，如果其中之一有值存在，该值即为用户想要添加或删除的好友名，那么在MySQL的friends表中查找用户，完成好友名的插入或删除。
 *
 * 第二种模式用于显示用户的简介信息。
 * 该模式对GET变量VIEW进行测试，如果该变量存在，表示某用户想要查看某人的信息。
 *
 * 注意
 * 无论是GET的值还是POST的值，都应该进行安全处理后再被程序调用
 */

require_once 'header.php';

if (!$loggedin) die();

echo "<div class='main>";

//如果有view值被get上来，也就是说想查看view用户的信息
if (isset($_GET['view'])) {
    echo "<div class='main'>";
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else                $name = "$view's'";

    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a class='button' href='messages.php?view=$view'>" .
        "View $name messages</a><br><br>";                    //有一个Button进入message.php并GET传入view（参看的用户的名字）的值
    die("</div></body></html>");
}

//如果有add被添加，也就是执行add程序
if (isset($_GET['add'])) {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");  //检索add用户是否已经是user的朋友
    if (!$result->num_rows) {                                                                    //如果检索出来没有值那么执行插入语句
        queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
    }
} elseif (isset($_GET['remove'])) {                                                             //查询到add用户是user的朋友，那么检查有没有remove值被GET上来
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}

$result = queryMysql("SELECT user FROM members ORDER BY user");                        //检索数据库中所有注册的用户
$num = $result->num_rows;

echo "<h3>Other Members</h3><ul>";
//把数据库中所有的用户名都列出来
for ($j = 0; $j < $num; $j++) {
    $row = $result->fetch_array(MYSQLI_ASSOC);    //还有中方法是while($row = $result->fetch_array() ,猜测，每一次执行fetch_array内部指针后移，即移向查询数据result的下一行
    if ($row['user'] == $user) continue;

    echo "<li><a href='members.php?view= " .
        $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE user='" . $row['user'] . "' AND friend='$user'");
    $t1 = $result1->num_rows;

    $result1 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='" . $row['user'] . "'");
    $t2 = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2) {
        echo " &rarr; is following you";
        $follow = "recip";
    }

    if (!$t1) echo "[<a href='members.php?add=" .
        $row['user'] . "'>follow</a>]";
    else        echo "[<a href='members.php?remove=" .
        $row['user'] . "'>dorp</a>]";
}

echo <<<_END
</ul></div>
</body>
</html>
_END;

