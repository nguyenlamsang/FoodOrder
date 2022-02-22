<?php

    include('../config/constants.php');
    include('islogin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Website Đặt đồ ăn - Trang chủ</title>
</head>
<body>
    <!--Menu section start-->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Danh mục</a></li>
                <li><a href="manage-food.php">Món ăn</a></li>
                <li><a href="manage-order.php">Đơn hàng</a></li>
                <li><a href="logout.php">Thoát</a></li>
            </ul>
        </div>
    </div>
    <!--Menu section end-->