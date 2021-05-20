<?php

/****************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * License: MIT
****************************/

session_start();
unset($_SESSION['admin']);
session_destroy();
exit ("<script>alert('您已安全退出登录！');location.href='./login.html';</script>");

?>