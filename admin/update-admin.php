<?php
    include('partials/menu.php')
?>
<div class="main">
    <div class="wrapper">
        <h1>Cập nhật quản trị viên</h1>
        <br/><br/>
        <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    $rows = mysqli_fetch_assoc($res);

                    $fullname = $rows['full_name'];
                    $username = $rows['username'];
                }
            }
        ?>
        <form action="" method="post" class="form-add">
            <h1>Thêm Quản Trị Viên</h1>
                <div class="input-box">
                    <span>Họ tên:</span>
                    <input type="text" name="full_name" value="<?php echo $fullname;?>">
                </div>

                <div class="input-box">
                    <span>Tên người dùng:</span>
                    <input type="text" name="username" value="<?php echo $username;?>">
                </div>

                

                

                <div class="btn-submit">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Cập nhật">
                </div>
        </form>     
        
    </div>
</div>
<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
         // create the query
        $sql = "UPDATE tbl_admin SET
        full_name = '$fullname',
        username = '$username'
        WHERE id = '$id'
        ";
        //execute
        $res = mysqli_query($conn, $sql);

        //check
        if($res == true) {
            $_SESSION['update'] = "<div class='success'>Cập nhật thành công</div>";
            header('location:' .SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['update'] = "<div class='fail'>cập nhật thất bại</div>";
            header('location:' .SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php
    include('partials/footer.php')
?>