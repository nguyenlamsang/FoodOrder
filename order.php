<?php
    include('partial-font/menu.php');
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <div class="order-background">
        <div class="container">
                
            <h2 class="text-center text-white">Điền thông tin khách hàng</h2>
            <?php
                if(isset($_GET['food_id'])) {
                    $food_id = $_GET['food_id'];
                    
                    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count = 1) {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $price = $row['price'];
                        
                    }
                }
                else {
                    header('location:'.SITEURL);
                }
            ?>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price"><?php echo $price.'K'; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Lâm Sang" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="0817467xxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="sangnguyen***b7@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="9/20 Thãnh Mỹ Lợi Q2" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </div>
    <?php
        if(isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_email = '$customer_email',
                customer_contact = '$customer_contact',
                customer_address = '$customer_address'
            ";
            

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true) {
                $_SESSION['order'] = "<div class='success text'>Đặt món thành công!!</div>";
                header('location:'.SITEURL);
            }
            else {
                $_SESSION['order'] = "<div class='fail'>Đặt món thất bại!!</div>";
                header('location:'.SITEURL);
            }
        }
    ?>
        
    
    <!-- fOOD sEARCH Section Ends Here -->

<?php
    include('partial-font/footer.php');
?>