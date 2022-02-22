<?php
    include('partials/menu.php')
?>
<div class="main">
    <div class="wrapper">
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id =$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1) {
                    $rows = mysqli_fetch_assoc($res);
                    $title = $rows['title'];
                    $current_image = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
                }
                else {
                    $_SESSION['no-category-found'] = "<div class='fail'> Danh mục không tìm thấy! </div>";
                    header('location:' .SITEURL.'admin/manage-category.php');
                }
            }
            else {
                
            }
        ?>
        <form action="#" method="POST" class="form-add" enctype="multipart/form-data">
            <h1>Cập nhật danh mục</h1>  
                <div class="input-box">
                    <span>Title</span>
                    <input type="text" name="title" value ="<?php echo $title; ?>" >
                </div>

                <div class="input-box">
                    <span>Current Image</span>
                    <?php
                        if($current_image != "") {
                            echo $current_image;
                        }
                        else {
                            echo "<div class='fail'>Không có ảnh</div>";
                        }
                    ?>
                </div>
                
                <div class="input-box">
                    <span>New Image</span>
                    <input type="file" name="image" >
                </div>
                
                <div class="input-box">
                    <span>Featured</span>
                    <input <?php if($featured =="yes"){ echo "checked"; }  ?> type="radio" name="featured" value="yes"> YES
                    <input <?php if($featured =="no"){ echo "checked"; }  ?> type="radio" name="featured" value="no"> NO
                </div>

                <div class="input-box">
                    <span>Active</span>
                    <input <?php if($active =="yes"){ echo "checked"; }  ?>  type="radio" name="active" value="yes"> YES
                    <input <?php if($active =="no"){ echo "checked"; }  ?> type="radio" name="active" value="no"> NO
                </div>

                <div class="btn-submit">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Add Categories">
                </div>
            </form>
            <?php
                if(isset($_POST['submit'])) {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image =$_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];

                        if($image_name !="") {
                            $ext = end(explode('.', $image_name));

                            $image_name = "Food Categories_".rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
            
                            $destination_path = "../images/category/".$image_name;
            
                            $upload = move_uploaded_file($source_path, $destination_path);
            
                            if($upload == false) {
                                $_SESSION['upload'] = "<div class='fail'>Khong the tai anh</div>";
                                header('location:' .SITEURL.'/admin/manage-categories.php');
                                die();
                            }
                            if($current_image !="") {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);

                                if($remove == false) {
                                    $_SESSION['remove'] = "<div class='fail'> Lỗi ảnh</div>";
                                    header('location: '.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }        
                        }
                        else {
                            $image_name = $current_image;
                        }
                    }
                    else {
                        $image_name = $current_image;
                    }
                    $sql2 = "UPDATE  tbl_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE  id = $id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true){
                        $_SESSION['update'] = "<div class='success'>Cập nhật thành công</div>";
                        header('location:' .SITEURL.'admin/manage-category.php');
                    }
                    else {
                        $_SESSION['update'] = "<div class='fail'>Cập nhật không thành công</div>";
                        header('location:' .SITEURL.'admin/manage-category.php');
                    }
                }
            ?>
    </div>
</div>
<?php
    include('partials/footer.php')
?>