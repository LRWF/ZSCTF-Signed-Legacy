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
	<title>ZSCTF - 查看成员</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/mdui/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

$dbhost = 'localhost:3306';
$dbuser = 'username';
$dbpass = 'password';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(!$conn)
{
    die('连接失败：'.mysqli_error($conn));
}

mysqli_query($conn,"set name utf8");
$sql = 'SELECT id,name FROM sqlname';
mysqli_select_db($conn,'sqlname');
$retval = mysqli_query($conn,$sql);

if(!$retval)
{
    die('无法读取数据：'.mysqli_error($conn));
}

echo ('
    <script
      src="../require/mdui/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ('
    <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">查看成员列表</div><br>
');

echo ('
    <div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable"><thead><tr><th>姓名</th><th>学号</th><th class="mdui-table-col-numeric">删除</th></tr></thead>
');

while($row = mysqli_fetch_array($retval,MYSQLI_ASSOC))
{
    echo "<td>{$row['name']}</td>".
         "<td>{$row['id']}</td>".
         "<td><a onclick=\"return confirm('确定删除？')\" href='admindeletemember.php?id={$row['id']}'>删除</a></td>".
         "</tr>";
}

mysqli_close($conn);

?>