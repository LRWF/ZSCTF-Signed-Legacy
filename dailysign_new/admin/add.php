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
	<title>ZSCTF - 添加成员</title>
');

echo ('
	<link
      rel="stylesheet"
      href="../require/mdui/css/mdui.min.css"
      integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
      crossorigin="anonymous"
    />
');

if(isset($_POST['ok']))
{
    $id = $_POST["id"];
    $name = $_POST["name"];

    require_once("../require/config.php");
    mysqli_select_db($conn,'databasename');

    $sql = "INSERT INTO databasename(id,name)
    VALUES ('$id', '$name')";
        
    if ($conn->query($sql) === TRUE)
    {
        echo "<script>alert('添加成功！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    else
    {
        echo "<script>alert('添加失败，数据库连接出错，请稍后重试！如果多次出现错误，请联系超级管理员！contact@lechnolocy.cn');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    
    $conn->close();
}

date_default_timezone_set("PRC");

echo ('
    <script
      src="../require/mdui/js/mdui.min.js"
      integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
      crossorigin="anonymous"
    ></script>
');

echo ("
	<script type=\"text/javascript\">
	function checkname()
    {
        if(subform.name.value==\"\")
        {
            alert(\"姓名输入为空，请输入姓名！\");
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
    function checkid()
    {
        if(subform.id.value==\"\")
        {
            alert(\"学号输入为空，请输入学号！\");
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
        
        <br><div class=\"mdui-typo\" style=\"font-size:28px;font-weight:500;text-align:center\">添加成员信息</div>
        <div class=\"mdui-typo\" style=\"font-size:12px;font-weight:300;text-align:center\">
        <a href=\"./index.php\"> &nbsp;&nbsp;返回首页&nbsp;&nbsp; </a>
        <a href=\"./member.php\"> &nbsp;&nbsp;查看成员&nbsp;&nbsp; </a>
        </div>
");

echo ("
    <form action=\"add.php\" method=\"post\" name=\"subform\" onsubmit=\"return checkname() && checkid()\">
        <div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">请输入姓名</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"name\" />
    	</div>
    	
    	<div class=\"mdui-textfield mdui-textfield-floating-label\">
            <label class=\"mdui-textfield-label\">请输入学号</label>
            <input class=\"mdui-textfield-input\" type=\"text\" name=\"id\" />
    	</div>
");

echo ("
    <br><br>
        	<center>
        	    <button class=\"mdui-color-pink-a200 mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent\" type=\"submit\" name=\"ok\">确认添加</button>
        	</center>
        </form>
");

?>