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

function randpw($len=8,$format='ALL')
{
    $is_abc = $is_numer = 0;
    $password = $tmp =''; 
    
    switch($format)
    {
        case 'ALL':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars='0123456789';
            break;
        default :
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    
    mt_srand((double)microtime()*1000000*getmypid());
    
    while(strlen($password)<$len)
    {
        $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
        
        if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR')
        {
            $is_numer = 1;
        }
        if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER')
        {
            $is_abc = 1;
        }
        $password.= $tmp;
    }
    
    if($is_numer <> 1 || $is_abc <> 1 || empty($password))
    {
        $password = randpw($len,$format);
    }
    
    return $password;
}

$txt = randpw(16,'ALL');
require_once("../require/config.php");
mysqli_select_db($conn,'zsctf');
$sql = "UPDATE token SET token = '".$txt."'";
$rsql = mysqli_query($conn,$sql);
if ($rsql)
{
    echo "<script>alert('Succeed！即将跳转到二维码页面！');location.href='./qrcodeget.php';</script>";
}
else
{
    echo "<script>alert('Failed！数据库连接出错，请稍后重试！如果多次出现错误，请联系管理员！contact@lechnolocy.cn');</script>";
}

?>