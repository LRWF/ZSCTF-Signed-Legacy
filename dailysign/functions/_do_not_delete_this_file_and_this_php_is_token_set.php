<?php
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

$filename = '../require/'.'filetokensave.txt';
$myfile = fopen($filename, "w") or die("Failed to open the file!");
$txt = randpw(16,'ALL');
fwrite($myfile, $txt);
fclose($myfile);
echo "<script>alert('Succeed！');location.href='./_make_token_qr_code.php';</script>";