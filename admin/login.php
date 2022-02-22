<?php
    include ('../config/constants.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>  
        <form action="" method="post" class="box" autocomplete="off">
            
            <h1>LOGIN</h1>
            <div class="session">
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset ($_SESSION['no-login-message']);
                    }

                ?>
            </div>
            <input  type="text" name="username" placeholder="username" autocomplete="off">
            <input autocomplete="off" type="password" name="password" placeholder="password">
            <input  type="submit" name="submit" value="submit">
        </form>

        <?php
            if(isset($_POST['submit'])) {
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                
                if($count==1) {
                    $_SESSION['login'] = "<div class='success'>ĐĂNG NHẬP THÀNH CÔNG</div";
                    $_SESSION['islogin'] = $username;
                    header('location:'.SITEURL.'/admin' );
                }
                else {
                    $_SESSION['login'] = "<div class='fail'>Tên đăng nhập hoặc mật khẩu không đúng!</div";
                    header('location:'.SITEURL.'/admin/login.php' );
                }
            }
        ?>
    
</body>
</html>