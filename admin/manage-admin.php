<?php
    include('partials/menu.php')
?>

    <!--Main section start-->
    <div class="main">
        <div class="wrapper">
            <h1>Quản Lý Quản Trị Viên</h1>
            <p style="color:green">
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){

                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){

                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['chk_curr_password'])){
                        echo $_SESSION['chk_curr_password'];
                        unset ($_SESSION['chk_curr_password']);
                    }
                    if(isset($_SESSION['chk_new_password'])){
                        echo $_SESSION['chk_new_password'];
                        unset ($_SESSION['chk_new_password']);
                    }
                    if(isset($_SESSION['change_password'])){
                        echo $_SESSION['change_password'];
                        unset ($_SESSION['change_password']);
                    }
                ?>
            </p>
            
            <br/>
            <button class="btn-add">
                <a href="add-admin.php">
                    Thêm Quản Trị Viên
                </a>
            </button>
            <table class="tbl-full">
                <tr>
                    <th>Số</th>
                    <th>Họ tên</th>
                    <th>Tài khoản</th>
                    <th>Chức năng</th>
                </tr>

                <?php
                    //query to select all data in database
                    $sql = "SELECT * FROM tbl_admin";

                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //check whether the query is excuted or not
                    if($res == TRUE){
                        $count = mysqli_num_rows($res);
                        $sl = 1;
                        if($count > 0) {
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $fullname = $rows['full_name'];
                                $username = $rows['username'];
                ?>
                                    <tr>
                                        <td><?php echo $sl++?></td>
                                        <td><?php echo $fullname?></td>
                                        <td><?php echo $username?></td>
                                        <td>
                                            <button class="btn-changepass"><a href="<?php echo SITEURL; ?>admin/changepassword-admin.php?id=<?php echo $id?>" >Đổi mật khẩu</a></button>
                                            <button class="btn-update"><a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id?>" >Cập nhật</a></button>
                                            <button class="btn-delete"><a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" >Xóa</a></button>
                                        </td>
                                    </tr>
                <?php    
                            }
                        }
                    }

                ?>
                

                

                
            </table>
        </div>
    </div>
    <!--Main section start-->

<?php
    include('partials/footer.php')
?>