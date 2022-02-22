<?php
    include('partials/menu.php')
?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else {
        header('location:' .SITEURL.'admin/manage-food.php');
    }
?>
<div class="main">
    <div class="wrapper">
        <form action="#" method="POST" class="form-add" enctype="multipart/form-data">
                <h1>Update Food</h1>  
                    <div class="input-box">
                        <span>Title</span>
                        <input type="text" name="title" value ="<?php echo $title; ?>" >
                    </div>

                    <div class="input-box">
                        <span>Description</span>
                        <textarea name="description"  cols="30" ><?php echo $description; ?></textarea>
                    </div>

                    <div class="input-box">
                        <span>Price</span>
                        <input type="number" name="price" value="<?php echo $price ;?>" >
                    </div>

                    <div class="input-box">
                        <span>Current Image</span>
                        <?php
                            if($current_image != "") {
                                ?>
                                <div class="images">
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>">
                                </div>
                                
                                <?php
                            }
                            else {
                                echo "<div class='fail'>Empty image</div>";
                            }
                        ?>
                    </div>
                    
                    <div class="input-box">
                        <span>New Image</span>
                        <input type="file" name="image" >
                    </div>

                    <div class="input-box">
                        <span>Category</span>
                        <div class="select">
                            <select name="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category where active ='Yes'";
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res) ;
                                
                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        

                                        ?>
                                        <option <?php if($current_category == $category_id) {echo "selected" ;}?> value="<?php echo $category_id?>"> <?php echo $category_title ;?></option>
                                        <?php
                                    }
                                    
                                }
                                else {
                                    ?>
                                    <option value="0"> No category</option>
                                    <?php
                                }
                            ?>

                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="input-box">
                        <span>Featured</span>
                        <input <?php if($featured == "yes") { echo "checked";}?> type="radio" name="featured" value="yes"> YES
                        <input <?php if($featured == "no") { echo "checked";}?> type="radio" name="featured" value="no"> NO
                    </div>

                    <div class="input-box">
                        <span>Active</span>
                        <input <?php if($active == "yes") { echo "checked";}?> type="radio" name="active" value="yes"> YES
                        <input <?php if($active == "no") { echo "checked";}?> type="radio" name="active" value="no"> NO
                    </div>

                    <div class="btn-submit">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Add Categories">
                    </div>
        </form>

            <?php
                if(isset($_POST['submit'])) {
                    //1. get all the detail from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];

                        if($image_name !="") {
                            $ext = end(explode('.', $image_name));

                            $image_name = "Food Name".rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
            
                            $destination_path = "../images/food/".$image_name;
            
                            $upload = move_uploaded_file($source_path, $destination_path);
            
                            if($upload == false) {
                                $_SESSION['upload'] = "<div class='fail'>Khong the tai anh</div>";
                                header('location:' .SITEURL.'/admin/manage-food.php');
                                die();
                            }
                            if($current_image !="") {
                                $remove_path = "../images/food/".$current_image;

                                $remove = unlink($remove_path);

                                if($remove == false) {
                                    $_SESSION['remove'] = "<div class='fail'> Lỗi ảnh</div>";
                                    header('location: '.SITEURL.'admin/manage-food.php');
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
                    $sql3 = "UPDATE  tbl_food SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        category_id = '$category',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE  id = $id
                    ";

                    $res3 = mysqli_query($conn, $sql3);

                    if($res3 == true){
                        $_SESSION['update'] = "<div class='success'>Cập nhật thành công</div>";
                        header('location:' .SITEURL.'admin/manage-food.php');
                    }
                    else {
                        $_SESSION['update'] = "<div class='fail'>Cập nhật không thành công</div>";
                        header('location:' .SITEURL.'admin/manage-food.php');
                    }
                    //2. upload the image if selected
                    //3. remove the image if new image is uploaded and current image is exists
                    //4. update the database
                    //5. redirect
                }
            ?>
    </div>
</div>
<?php
    include('partials/footer.php')
?>