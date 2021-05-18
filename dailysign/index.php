<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

$filename = './require/'.'filetokensave.txt';
$fp = fopen($filename, "r"); 
$str = fread($fp,filesize($filename));
$token = $_GET['token'];

if(isset($_POST['ok']))
{
	$conn = new mysqli("localhost","username","password","sqlname");
	
	$name = $_POST['name'];
	$time = date("YmdHis");
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$status = "签到成功";
    $details = "正常出勤";
	
	if ($conn->connect_error)
	{
		die ('<br>连接数据库失败，请联系管理员！<br>contact@lechnolocy.cn');
	}

    $sql = "INSERT INTO sqlname(name,time,ip,token,status,details)
    VALUES ('$name', '$time', '$ip', '$token', '$status', '$details')";

    if ($token == $str)
    {
        mysqli_select_db($conn,'sqlname');
        $checksql = 'SELECT * FROM sqlname WHERE name = "'.$name.'"';
        $getauthentication = mysqli_query($conn, $checksql);
        if (mysqli_num_rows($getauthentication)!=0)
        {
            if ($conn->query($sql) === TRUE)
            {
                echo "<script>alert('签到成功！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            }
            else
            {
                echo "<script>alert('签到失败，数据库连接出错，请稍后重试！如果多次出现错误，请联系管理员！contact@lechnolocy.cn');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            }
        }
        else
        {
            echo "<script>alert('签到失败，您不是ZSCTF成员！如果您是尚未录入信息的新成员，请联系管理员！contact@lechnolocy.cn');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
    }
    else
    {
        echo "<script>alert('token不正确，签到失败！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
     
    $conn->close();
}

date_default_timezone_set("PRC");

echo ("
	<meta charset=\"UTF-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">
	<title>ZSCTF - 签到系统</title>
");

echo ("
	<link
        rel=\"stylesheet\"
        href=\"./require/mdui/css/mdui.min.css\"
        integrity=\"sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw\"
        crossorigin=\"anonymous\"
    />
");

echo ("
	<script type=\"text/javascript\">
	function check()
    {
        if(subform.name.value==\"\")
        {
            alert(\"姓名输入为空，请输入你的姓名！\");
            return false;
        }
        if(subform.name.value.length>=5 || subform.name.value.length<=1)
        {
            alert(\"姓名长度不合法，请检查后重试！\");
            return false;
        }
        else
        {
            return true;
        }
    }
");

echo ("
    function checktoken()
    {
        if(subform.token.value==\"\")
        {
            alert(\"token输入为空，请输入token！\");
            return false;
        }
        else
        {
            return true;
        }
    }
    </script>
");

echo ("
    <div class=\"mdui-container doc-container\">
        
        <br><div class=\"mdui-typo\" style=\"font-size:28px;font-weight:500;text-align:center\">ZSCTF 签到</div>
        <div class=\"mdui-typo\" style=\"font-size:10px;font-weight:300;text-align:center\"><br>禁止对本平台进行包括但不限于未经授权的扫描、渗透、攻击等操作！<br>否则将按照相关法律法规处理！</div>
        <br>
");

echo ("
    <form action=\"index.php?token=").htmlspecialchars($token).("\" method=\"post\" name=\"subform\" onsubmit=\"return check() && checktoken()\">
        <div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">请输入姓名</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"name\" onblur=\"check()\"/>
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"ok\">签到</button>
        	</center>
        </form>
    <br>
            <center><a href=\"./leave.php\"><button class=\"mdui-color-cyan-a100 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\">请假</button></a>
            </center>
    </div>
");

echo (
    "<script
      src=\"./require/mdui/js/mdui.min.js\"
      integrity=\"sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A\"
      crossorigin=\"anonymous\"
    ></script>
");
?>