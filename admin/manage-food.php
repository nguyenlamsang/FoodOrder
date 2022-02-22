<?php
    include('partials/menu.php')
?>

    <!--Main section start-->
    <div class="main">
        <div class="wrapper">
            <h1>Quản Lý Thực Đơn</h1>
            </br></br>

            <?php
                if(isset($_SESSION['add-food'])) {
                    echo $_SESSION['add-food'];
                    unset ($_SESSION['add-food']);
                }
                if(isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['remove'])) {
                    echo $_SESSION['remove'];
                    unset ($_SESSION['remove']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
            ?>
            <button class="btn-add">
                <a href="add-food.php
                ">
                    Thêm Thực Đơn
                </a>
            </button>
            <table class="tbl-full">
                <tr>
                    <th>T.T</th>
                    <th>Tên món</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_food";

                    $res = mysqli_query($conn, $sql);

                    
                    $count = mysqli_num_rows($res);
                    $sl = 1;

                    if($count >0) {
                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sl ++ ;?></td>
                                    <td><?php echo $title ;?></td>
                                    <td><?php echo $price.'K' ;?></td>
                                    <td>
                                        <?php
                                            if($image_name != ""){
                                        ?>
                                        <div class="images">
                                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>">
                                        </div>
                                                
                                        <?php
                                            }
                                        ?>
                            
                                    </td>
                                    <td><?php echo $featured ;?></td>
                                    <td><?php echo $active ;?></td>
                                    <td>
                                        <button class="btn-update"><a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id?>" >Cập nhật</a></button>
                                        <button class="btn-delete"><a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" >Xóa</a></button>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else {
                        echo "Empty food in database";
                    }
                ?>
                

                
            </table>
        </div>
    </div>
    <!--Main section start-->

<?php
    include('partials/footer.php')
?>