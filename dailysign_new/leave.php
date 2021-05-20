<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

if(isset($_POST['ok']))
{
	require_once("./require/config.php");
	
    $name = $_POST['name'];
    $time = date("YmdHis");
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $token = "NULL";
    $status = "请假";
    $details = $_POST['details'];

    $sql = "INSERT INTO databasename(name,time,ip,token,status,details)
    VALUES ('$name', '$time', '$ip', '$token', '$status', '$details')";

    mysqli_select_db($conn,'databasename');
    $checksql = 'SELECT * FROM databasename WHERE name = "'.$name.'"';
    $getauthentication = mysqli_query($conn, $checksql);
    
    if (mysqli_num_rows($getauthentication)!=0)
    {
        if ($conn->query($sql) === TRUE)
        {
            echo "<script>alert('已成功提交登记请假信息！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
        else
        {
            echo "<script>alert('信息录入失败，数据库连接出错，请稍后重试！如果多次出现错误，请联系管理员！contact@lechnolocy.cn');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
    }
    else
    {
        echo "<script>alert('请假失败，您不是ZSCTF成员！如果您是尚未录入信息的新成员，请联系管理员！contact@lechnolocy.cn');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
 
    $conn->close();
}

date_default_timezone_set("PRC");

echo ('
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>ZSCTF - 请假登记</title>
');

echo ('
	<link
        rel="stylesheet"
        href="./require/mdui/css/mdui.min.css"
        integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
        crossorigin="anonymous"
    />
');

echo ('
	<script type="text/javascript">
	function check()
    {
        if(subform.name.value=="")
        {
            alert("姓名输入为空，请输入你的姓名！");
            return false;
        }
        if(subform.name.value.length>=5 || subform.name.value.length<=1)
        {
            alert("姓名长度不合法，请检查后重试！");
            return false;
        }
        else
        {
            return true;
        }
    }
    function checkdetails()
    {
        if(subform.details.value=="")
        {
            alert("请假理由输入为空，请输入请假理由！");
            return false;
        }
        else
        {
            return true;
        }
    }
    </script>
');
	
echo ('
    <div class="mdui-container doc-container">
        <br><div class="mdui-typo" style="font-size:28px;font-weight:500;text-align:center">ZSCTF 请假信息登记</div>
        <div class="mdui-typo" style="font-size:10px;font-weight:300;text-align:center"><br>禁止对本平台进行包括但不限于未经授权的扫描、渗透、攻击等操作！<br>否则将按照相关法律法规处理！</div>
        <br>
');

echo ('
        <form action="leave.php" method="post" name="subform" onsubmit="return check() && checkdetails()">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">请输入姓名</label>
                <input class="mdui-textfield-input" type="text" name="name" />
        	</div>
');

echo ('
        	<div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">请假理由</label>
                <input class="mdui-textfield-input" type="text" name="details" />
        	</div>
');

echo ('
        	<br><br>
        	
        	<center>
        	    <button class="mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" type="submit" name="ok">提交</button>
        	</center>
        </form>
    </div>
');

echo ('
        <script
          src="./require/mdui/js/mdui.min.js"
          integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
          crossorigin="anonymous"
        ></script>
');

?>