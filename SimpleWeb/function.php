<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/14
 * Time: 20:06
 *
 *
 * 说明：这个文件设计五个主要的函数
 * createTable
 *      检查表是否存在，如果不存在则创建这张表
 *
 * queryMysql
 *      查询数据库，如果失败则输出一个错误信息
 *
 * destroySession
 *      撤销PHP会话并当用户退出后清初其数据
 *
 * sanitizeString
 *      消除由用户输入的潜在的恶意代码或标记
 *
 * showProfile
 *      显示一个用户图像和“about me”信息(在数据库中查找该用户的数据)，如果有的话
 */

$dbhost = "localhost";
$dbname = "Mysite";
$dbuser = "root";
$dbpass = "";
$appname = "My first Web";

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($connection->connect_error) die("$connection->connect_error");

//CREATE 语句中的name变量是表名，query 变量是创建表表的结构的语句
function createTable($name,$query){
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}


function queryMysql($query){
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

//这段函数需要好好看一看，还不能理解
function destroySession(){
    $_SESSION = array();                                        //重置超全局变量SESSION
    if (session_id() != "" || isset($_COOKIE[session_name()]))  //检查当前的家脚本中有没有会话存在
        setcookie(session_name(),'',time()-2592000,'/');  //
    session_destroy();                                          //
}

//对字符串进行安全处理的这几个函数再看看了解一下，并笔记下来
function sanitizeString($var){
    global $connection;
    $var = strip_tags($var);                        //删除字符串中的HTML和PHP标记
    $var = htmlentities($var);                      //对字符串中的HTML字符进行转义
    $var = stripslashes($var);                      //对字符串中的转义斜线符号进行处理（删除）
    return $connection->real_escape_string($var);   //最后将字符串用SQL转义符转换成可执行的SQL语句
}

function showProfile($user){
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' style='float:left;'>";
    $result = queryMysql("SELECT * FROM profile WHERE user='$user'");
    if ($result->num_rows){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text'])."<br style='clear:left;'><br>";
    }
}