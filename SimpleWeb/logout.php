<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/19
 * Time: 16:05
 *
 * 说明
 * 通过注销页面来关闭会话，删除任何相关的数据和cookies
 * 用户被要求点击连接转入退出登陆主页，并删除屏幕上方的logged-in链接
 *
 * 让注销保持清洁也许是个好主意
 */

require_once 'header.php';

if (isset($_SESSION['user'])){
    destroySession();
    echo "<div class='main'>You have been logged out. Please".
        "<a href='index.php'>click here</a> to refresh the screen.";
}else{
    echo "<div class='main'><br>".
        "You cannot log out because you are not logged in";
}
echo <<<_END
<br><br>
</div>
</body>
</html>
_END;
