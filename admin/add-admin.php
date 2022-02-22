<?php
    include('partials/menu.php')
?>
<div class="main">
    <div class="wrapper">
        
        <p style="color:red">
            <?php
                if(isset($_SESSION['add'])){
                    
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
            ?>
        </p>
        <form action="" method="post" class="form-add">
            <h1>Thêm Quản Trị Viên</h1>
                <div class="input-box">
                    <span>Full Name:</span>
                    <input type="text" name="fname">
                </div>

                <div class="input-box">
                    <span>User Name:</span>
                    <input type="text" name="username">
                </div>

                <div class="input-box">
                    <span>Pass Word:</span>
                    <input type="password" name="pass">
                </div>

                

                <div class="btn-submit">
                <input type="submit" name="submit" value="Thêm">
                </div>
        </form>     
    </div>
</div>

<?php
    include('partials/footer.php')
?>

<?php
    if(isset($_POST['submit']))
    {
        //1. Get the data from form
        $full_name = $_POST['fname'];
        $username = $_POST['username'];
        $password = md5($_POST['pass']);
        
        //2. Sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
                full_name = '$full_name',
                username = '$username',
                password = '$password'
        ";

        //3. Excuting sql query to save data into database
        $res = mysqli_query($conn, $sql) or die (mysqli_error());

        //4. Check whether the data inserted or not 
        if($res ==TRUE) {
            $_SESSION['add'] = "Thêm thành công";
            //Redirect
            header("location:".SITEURL.'/admin/manage-admin.php');
        }
        else {
            $_SESSION['add'] = "Thêm thất bại";
            header("location:".SITEURL.'/admin/add-admin.php');
        }
    }

    
?>