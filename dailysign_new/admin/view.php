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
	<title>ZSCTF - 查看管理</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/mdui/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

require_once("../require/config.php");

mysqli_query($conn,"set username utf8");
$sql = 'SELECT username FROM databasename';
mysqli_select_db($conn,'databasename');
$retval = mysqli_query($conn,$sql);

if(!$retval)
{
    die('无法读取数据，请联系超级管理员！<br>contact@lechnolocy.cn');
}

echo ('
    <script
      src="../require/mdui/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">查看管理员列表</div>
    <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">
    <a href="./index.php"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
    <a href="./new.php"> &nbsp;&nbsp;新增管理&nbsp;&nbsp; </a>
    </div><br>
');

echo ('
    <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable"><thead><tr><th>用户名</th><th class="mdui-table-col-numeric">操作</th></tr></thead>
');

while($row = mysqli_fetch_array($retval,MYSQLI_ASSOC))
{
    echo "<td>{$row['username']}</td>".
         "<td><a onclick=\"return confirm('确定删除？')\" href='rm.php?username={$row['username']}'>删除</a></td>".
         "</tr>";
}

mysqli_close($conn);

?>