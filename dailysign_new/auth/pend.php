<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

session_start();
require_once("../require/config.php");
mysqli_select_db($conn,'zsctf');

$_SESSION["admin"] = null;
$uname = $_POST['username'];
$pword = $_POST['password'];

$scsql = 'SELECT * FROM zsctfadmin WHERE username = "'.$uname.'" and password = "'.$pword.'"';
$getrow = mysqli_query($conn, $scsql);

if (mysqli_num_rows($getrow)==0)
{
    echo "<script>alert('登录失败！');location.href='./login.html';</script>";
}
else
{
    $_SESSION['admin'] = $uname;
    echo "<script>alert('登录成功！');location.href='../admin/index.php';</script>";
}