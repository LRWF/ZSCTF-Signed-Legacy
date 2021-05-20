<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

$dbhost = 'hostname';
$dbuser = 'username';
$dbpass = 'password';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(!$conn)
{
    die('连接数据库失败，请联系管理员！<br>contact@lechnolocy.cn');
}

?>