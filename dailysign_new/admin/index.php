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

echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 签到系统管理台</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/mdui/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

echo ('
    <script
      src="../require/mdui/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">签到系统控制台</div><br>
    <div class="mdui-divider"></div><br><br>
    <div class="mdui-typo" style="font-size:20px;font-weight:300;text-align:center">
        <a href="../list.php"> > 签到详情 < </a><br>
        <a href="./member.php"> > 查看成员 < </a><br>
        <a href="./add.php"> > 添加成员 < </a><br>
        <a href="./new.php"> > 增加管理员 < </a><br>
        <a href="./view.php"> > 查看管理员 < </a><br>
        <a href="../function/qrcodeget.php"> > 获取签到二维码 < </a><br>
        <a href="../function/tokenset.php"> > 刷新token并获取签到二维码 < </a><br>
        <a href="../auth/logout.php"> > 安全注销登录 < </a>
    </div><br>
');
?>