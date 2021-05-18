<?php
require '../require/phpqrcode.php';
$filename = '../require/'.'filetokensave.txt';
$fp = fopen($filename, "r"); 
$str = fread($fp,filesize($filename));
Header("Content-type: image/png");
ImagePng(QRcode::png("https://web.lechnolocy.cn/zsctf/dailysign/index.php?token=".$str, false, 'H', 20));
?>