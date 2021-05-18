<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

$id = $_GET["id"];

$dbhost = 'localhost:3306';
$dbuser = 'username';
$dbpass = 'password';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$conn)
{
    die('数据库连接失败：'.mysqli_error($conn));
}

mysqli_select_db($conn,'sqlname');

$sql = 'DELETE FROM sqlname WHERE id = "'.$id.'"';

$result = mysqli_query($conn, $sql);

if ($result)
{
    header("location:adminmemberview.php");
}
else
{
    echo "删除失败：" . mysql_error();
}

mysqli_close($conn);
?>