<?php
    include('partial-font/menu.php');
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql = "SELECT * FROM tbl_food ";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0 ) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo "$".$price; ?></p>
                                <p class="food-detail">
                                    Made with Italian Sauce, Chicken, and organice vegetables.
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
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