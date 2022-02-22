<?php
    include('partials/menu.php');
?>

    <div class="main">
        <div class="wrapper">
            <?php
                if(isset($_SESSION['add-category'])){
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
            ?>
            
            <form action="#" method="POST" class="form-add" enctype="multipart/form-data">
                <h1>Thêm danh mục</h1>
                <div class="input-box">
                    <span>Title</span>
                    <input type="text" name="title" >
                </div>

                <div class="input-box">
                    <span>Image</span>
                    <input type="file" name="image" >
                </div>
                
                <div class="input-box">
                    <span>Featured</span>
                    <input type="radio" name="featured" value="Co"> co
                    <input type="radio" name="featured" value="no"> NO
                </div>

                <div class="input-box">
                    <span>Active</span>
                    <input type="radio" name="active" value="yes"> YES
                    <input type="radio" name="active" value="no"> NO
                </div>

                <div class="btn-submit">
                    <input type="submit" name="submit" value="Add Categories">
                </div>
            </form>
        </div>
        
    </div>

    <?php
        if(isset($_POST['submit'])){
            $title = $_POST['title'];

            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else{
                $featured = 'Co';
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = 'NO';
            }
            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];
                if($image_name != ""){
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food Categories_".rand(000,999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
    
                    $destination_path = "../images/category/".$image_name;
    
                    $upload = move_uploaded_file($source_path, $destination_path);
    
                    if($upload == false) {
                        $_SESSION['upload'] = "<div class='fail'>Khong the tai anh</div>";
                        header('location:' .SITEURL.'/admin/add-categories.php');
                        die();
                    }
                                            
                }

                
            }
            else{
                $image_name = "";
            }

            $sql = "INSERT INTO tbl_category SET
                featured = '$featured',
                title = '$title',
                image_name = '$image_name',
                
                active = '$active'
            ";

            $res = mysqli_query($conn, $sql);

            if($res == true) {
                $_SESSION['add-category'] = "<div class='success'>Them thanh cong</div>";
                header('location:' .SITEURL.'/admin/manage-category.php');
            }
            else {
                $_SESSION['add-category'] = "<div class='fail'>Them that bai</div>";
                header('location:' .SITEURL.'/admin/add-category.php');
            }
        }
    ?>

<?php
    include('partials/footer.php');
?>