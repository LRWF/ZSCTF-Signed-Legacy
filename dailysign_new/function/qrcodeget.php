<?php

session_start();

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

require '../require/phpqrcode.php';
require_once("../require/config.php");
$ftoken = 'SELECT token FROM token';
mysqli_select_db($conn,'zsctf');
$retval = mysqli_query($conn,$ftoken);
while($row = mysqli_fetch_array($retval,MYSQLI_ASSOC))
{
    $str = $row['token'];
}

Header("Content-type: image/png");
ImagePng(QRcode::png("https://web.lechnolocy.cn/zsctf/dailysign/index.php?token=".$str, false, 'H', 20));

?>