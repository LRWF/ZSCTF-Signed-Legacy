<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ZSCTF - 签到数据详情</title>
');

echo ('
	<link
      rel="stylesheet"
      href="./require/mdui/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

require_once("./require/config.php");

mysqli_query($conn,"set names utf8");

$sql = 'SELECT name,time,status,details FROM databasename';
mysqli_select_db($conn,'databasename');
$retval = mysqli_query($conn,$sql);

if(!$retval)
{
    die('无法读取数据，请联系管理员！<br>contact@lechnolocy.cn');
}

echo ('
    <script
      src="./require/mdui/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">签到数据详情</div>
    <div class="mdui-typo" style="font-size:12px;font-weight:300;text-align:center">-（时间格式为年月日时分秒  表格支持水平和垂直滚动）-</div><br>
');

echo ('
    <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable"><thead><tr><th>签到状态</th><th>姓名</th><th>签到时间</th><th>出勤详情</th></tr></thead>
');

while($row = mysqli_fetch_array($retval,MYSQLI_ASSOC))
{
    echo "<td>{$row['status']} </td> ".
         "<td>{$row['name']} </td> ".
         "<td>{$row['time']} </td> ".
         "<td>{$row['details']} </td> ".
         "</tr>";
}

mysqli_close($conn);

?>