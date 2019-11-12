<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/15
 * Time: 16:17
 *
 * 说明：
 * 该文件调用在function文件中的createTable函数在数据库中创建表单
 * 创建了如下4个表单：
 *      members  用来储存已注册的用户名和密码
 *      messages 用来储存消息
 *      friends  用来储存用户的朋友
 *      profile  用来存储个人主页信息的
 *
 * 书上给的这些表的结构很基础，适合拿来学习用，不适合用于生产环境
 *
 * 或许我们可以直接在数据库中创建那样是不是更简单一些呢？
 *但是书上有这么一篇，就当作练习吧
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database</title>
    </head>
    <body>
        <h3>Setting up ...</h3>

        <?php
        require_once 'function.php';

        createTable('members',
            'user VARCHAR(16),
            pass VARCHAR(16),
            INDEX(user(6))');

        createTable('messages',
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            auth VARCHAR(16),
            recip VARCHAR(16),
            pm CHAR(1),
            time INT UNSIGNED,
            message VARCHAR(4096),
            INDEX(auth(6)),
            INDEX(recip(6))');

        createTable('friends',
            'user VARCHAR(16),
            friend VARCHAR(16),
            INDEX(user(6)),
            INDEX(friend(6))');

        createTable('profile',
            'user VARCHAR(16),
            text VARCHAR(4096),
            INDEX(user(6))');

        ?>
    <br> ...done.
    </body>
</html>
