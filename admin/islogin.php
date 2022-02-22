<?php

    if(!isset($_SESSION['islogin'])){
        $_SESSION['no-login-message'] = "<div class='fail'>Đăng nhập để vào hệ thống quản trị!!</div>";
        header("location:" .SITEURL ."/admin/login.php");
    }
?>