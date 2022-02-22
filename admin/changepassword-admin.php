<?php
    include('partials/menu.php');
?>

<div class="main">
    <div class="wrapper">
        <h1>THAY ĐỔI MẬT KHẨU </h1>
        <br/><br/>
        
        <?php
            if(isset($_GET['id']))
            $id = $_GET['id'];
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    
                    <td>Mật khẩu cũ</td>
                    <td>
                        <input type="password" name="current_pass" placeholder="Mật khẩu cũ">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu mới:</td>
                    <td>
                        <input type="password" name="new_pass" placeholder="Mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td>Xác nhận mật khẩu:</td>
                    <td>
                        
                        <input type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu">
                    </td>
                </tr>
                
                <tr>
                    <td colpans = "2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit"name="submit" value="Thay đổi mật khẩu" class="btn-add">
                    </td>

                </tr>

            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //1. Get all data from form
        $id = $_POST['id'];
        $current_pass = md5($_POST['current_pass']);
        $new_pass =md5($_POST['new_pass']);
        $confirm_pass = md5($_POST['confirm_pass']);
        //2. check wether user id and password exists in database or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_pass'";

        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $count = mysqli_num_rows($res);  

            if($count == 1){
                if($new_pass == $confirm_pass) {
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_pass' 
                        Where id = $id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {
                        
                        $_SESSION['change_password'] = "<div class='success'>Đổi mật khẩu thành công!!</div>";
                        header('location:'. SITEURL.'/admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change_password'] = "<div class='fail'>Đổi mật khẩu không thành công!!</div>";
                        header('location:'. SITEURL.'/admin/manage-admin.php');
                    }
                }
                else{
                    $_SESSION['chk_new_password'] = "<div class='fail'>Mật khẩu mới không khớp với nhau ! Vui lòng nhập lại</div>";
                    header('location:'.SITEURL.'/admin/manage-admin.php');
                }
            }   
            else{
                $_SESSION['chk_curr_password'] = "<div class='fail'>Mật khẩu hiện tại không đúng! Vui lòng nhập lại</div>";
                header('location:'.SITEURL.'/admin/manage-admin.php');
            }
            
        }
        
        //3. check the new password and confirm password is match or not
        
    }
?>

<?php
    include('partials/footer.php');
?>