<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

session_start();
$admin = $_SESSION['admin'];

if (!$admin)
{
    exit ("<script>alert('您尚未登录！即将跳转登录页面！');location.href='../auth/login.html';</script>");
}

$name = $_GET["name"];
$id = $_GET["id"];

require_once("../require/config.php");

mysqli_select_db($conn,'databasename');

$sql = 'DELETE FROM databasename WHERE name = "'.$name.'" and id = "'.$id.'"';

$result = mysqli_query($conn, $sql);

if ($result)
{
    header("location:member.php");
}
else
{
    echo "删除失败，请联超级系管理员！<br>contact@lechnolocy.cn";
}

mysqli_close($conn);

?>