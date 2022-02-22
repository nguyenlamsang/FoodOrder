<?php
    include('partials/menu.php')
?>

    <!--Main section start-->
    <div class="main">
        <div class="wrapper">
            <?php
                if(isset($_SESSION['add-category'])){
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset ($_SESSION['remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset ($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
            ?>
            <h1>Quản Lý Danh Mục</h1>
            <button class="btn-add">
                <a href="add-categories.php">
                    Thêm Danh Mục
                </a>
            </button>
            <table class="tbl-full">
                <tr>
                    <th>T.T</th>
                    <th>Tên món</th>
                    <th>Ảnh</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    
                    $count = mysqli_num_rows($res);
                    $sl = 1;
                    if($count >0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                ?>
                            <tr>
                                <td><?php echo $sl++;  ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                        if($image_name != ""){
                                    ?>
                                    <div class="images">
                                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>"class= "img">
                                    </div>
                                            
                                    <?php
                                        }
                                    ?>
                            
                                </td>
                                <td><?php if($featured == "yes") echo "CO"; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <button class="btn-update"><a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id?>" >Cập nhật</a></button>
                                    <button class="btn-delete"><a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" >Xóa</a></button>
                                </td>
                            </tr>
                <?php
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