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

$urname = $_GET["username"];

require_once("../require/config.php");
mysqli_select_db($conn,'databasename');

$sql = 'DELETE FROM databasename WHERE username = "'.$urname.'"';

$result = mysqli_query($conn, $sql);

if ($result)
{
    header("location:view.php");
}
else
{
    echo "删除失败，请联系超级管理员！<br>contact@lechnolocy.cn";
}

mysqli_close($conn);

?>