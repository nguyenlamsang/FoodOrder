<?php
    include('partials/menu.php');
?>

<div class="main">
    <div class="wrapper">
            <?php
                if(isset($_SESSION['add-food'])) {
                    echo $_SESSION['add-food'];
                    unset ($_SESSION['add-food']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
            ?>
        <form action="#" method="POST" class="form-add" enctype="multipart/form-data">
            <h1>Add Food</h1>
            <div class="input-box">
                <span>Title</span>
                <input type="text" name="title" >
            </div>

            <div class="input-box">
                <span>Description</span>
                <textarea name="description"  cols="30" ></textarea>
            </div>

            <div class="input-box">
                <span>Price</span>
                <input type="number" name="price" >
            </div>

            <div class="input-box">
                    <span>Image</span>
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
                                $id = $row['id'];
                                $title = $row['title'];
                                

                                ?>
                                <option value="<?php echo $id; ?>"> <?php echo $title;?></option>
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
                <input type="radio" name="featured" value="yes"> YES
                <input type="radio" name="featured" value="no"> NO
            </div>

            <div class="input-box">
                <span>Active</span>
                <input type="radio" name="active" value="yes"> YES
                <input type="radio" name="active" value="no"> NO
            </div>

            <div class="btn-submit">
                <input type="submit" name="submit" value="Add Food">
            </div>
        </form>  

        
    </div>
</div>

<?php
            if(isset($_POST['submit'])) {
                
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = 'NO';
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

                        $image_name = "Food-Name_".rand(0000,9999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
        
                        $destination_path = "../images/food/".$image_name;
        
                        $upload = move_uploaded_file($source_path, $destination_path);
        
                        if($upload == false) {
                            $_SESSION['upload'] = "<div class='fail'>Khong the tai anh</div>";
                            header('location:' .SITEURL.'/admin/manage-food.php');
                            die();
                        }   
                                            
                    }

                    
                }
                else{
                    $image_name = "";
                }

                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    image_name = '$image_name',
                    description = '$description',
                    price = $price,    
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";  

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {
                    $_SESSION['add-food'] = "<div class='success'>Food add successfully</div>";
                    header('location:' .SITEURL.'/admin/manage-food.php');
                }
                else {
                    $_SESSION['add-food'] = "<div class='fail'>Failure to add food</div>";
                    header('location:' .SITEURL.'/admin/add-food.php');
                }
            }
        ?>
<?php
    include('partials/footer.php')
?>