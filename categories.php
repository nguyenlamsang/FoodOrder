<?php
    include('partial-font/menu.php');
?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count >0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        
                        ?>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
            ?>


            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    


<?php
    include('partial-font/footer.php');
?>