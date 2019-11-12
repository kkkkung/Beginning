<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2017/12/17
 * Time: 16:43
 *
 * 说明
 * 当用户注册并登陆后要做的第一件事情就是创建一个简介文件。
 * 该文件中的代码有很多有意思的地方
 * 例如 图片的上传、调整大小和锐化
 *
 */

require_once 'header.php';

if (!$loggedin) die();

echo "<div class ='main' ><h3>Your Profile</h3>";

//检查用户已经储存了的数据
$result = queryMysql("SELECT * FROM profile WHERE user='$user'");


//对POST上来的TEXT字段进行安全处理后再放入数据库
if (isset($_POST['text'])){
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/',' ',$text);   //将文本中的多个空格（\s正则表达代表一个空格）替换成一个空格
    if ($result->num_rows)
        queryMysql("UPDATE profile SET text='$text' WHERE user='$user'");
    else
        queryMysql("INSERT INTO profile VALUES ('$user','$text')");
}
//如果有文本POST上来就执行上面的代码，如果没有的话就是读取数据库中的文本
else {
    if ($result->num_rows){
        //对mysqli_result对象获取数据的处理，这里应该看看，做做笔记
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $text= stripslashes($row['text']);
    }
    else
        $text = '';
}

$text = stripslashes(preg_replace('/\s\s+/',' ',$text));

//检测是不是有文件（图片）上传上来
if (isset($_FILES['image']['name'])){
    $saveto = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'],$saveto);
    $typeok = TRUE;

    switch ($_FILES['image']['type']){
        case "image/gif":       $src = imagecreatefromgif($saveto);break;
        case "image/jpeg":      //Both regular nad progressive pjpeg
        case "image/pjeg":      $src = imagecreatefromjpeg($saveto);break;
        case "image/png":       $src = imagecreatefrompng($saveto);break;
        default:                $typeok = FALSE;break;
    }

    if($typeok){
        list($w, $h) = getimagesize($saveto);

        $max = 100;
        $tw = $w;
        $th = $h;
        if ($w > $h && $max < $w){
            $th = $max  /$h * $w;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h){
            $tw = $max  / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
            $tw = $th = $max;
        $tmp = imagecreatetruecolor($tw,$th);
        imagecopyresampled($tmp,$src,0,0,0,0,$tw,$th,$w,$h);
        imageconvolution($tmp,array(array(-1,-1,-1),array(-1,16,-1),array(-1,-1,-1)),8,0);
        imagejpeg($tmp,$saveto);
        imagedestroy($tmp);
        imagedestroy($src);

    }
}

showProfile($user);

echo <<<_END
<form method="post" action="profile.php" enctype="multipart/form-data">
<h3>Enter or edit your profile details and/or upload an image</h3>
<textarea name="text" cols="50" rows="3">$text</textarea><br>
Image: <input type="file" name="image" size="14"  >
<input type="submit" value="Save Profile">
</form>
</div>
<br>
</body>
</html>
_END;
