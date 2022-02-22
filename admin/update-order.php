<?php
    include('partials/menu.php')
?>
<div class="main">
    <div class="wrapper">
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_order";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0) {
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_email = $row['customer_email'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                    
                }
            }
            else {
                header('location: '.SITEURL.'admin/manage-order.php');
            }
        ?>
        <form action="#" method="POST" class="form-add" enctype="multipart/form-data">
                <h1>Cập nhật đơn hàng</h1>  
                    <div class="input-box">
                        <span>Tên Món</span>
                        <span class="bold"><?php echo $food; ?></span>
                    </div>

                    <div class="input-box">
                        <span>Price</span>
                        <span class="bold"><?php echo $price.'K'; ?></span>
                    </div>

                    <div class="input-box">
                        <span>Số lượng</span>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </div>

                    

                    <div class="input-box">
                        <span>Tình trạng</span>
                        <select name="status">
                            <option <?php if($status=="Ordered") {echo "selected"; } ?> value="Ordered">Đã đặt hàng</option>
                            <option <?php if($status=="OnDelivery") {echo "selected"; } ?> value="OnDelivery">Đang giao</option>
                            <option <?php if($status=="Delivered") {echo "selected"; } ?> value="Delivered">Đã giao</option>
                            <option <?php if($status=="Cancelled") {echo "selected"; } ?> value="Cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span>Tên khách hàng</span>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" >
                    </div>
                    <div class="input-box">
                        <span>Sđt</span>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" >
                    </div>
                    
                    

                    <div class="btn-submit">
                        
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Lưu cập nhật">
                    </div>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $status = $_POST['status'];
                    $customer_name = $_POST['customer_name'];
                    
                    $customer_contact = $_POST['customer_contact'];
                    

                    $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        
                        customer_contact = '$customer_contact'
                        
                        WHERE id=$id
                    " ;

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == true) {
                            $_SESSION['update'] = "<div class='success'>cập nhật thành công!!</div>";
                            header('location:'.SITEURL.'admin/manage-order.php');
                        }
                        else {
                            $_SESSION['update'] = "<div class='fail'>Lỗi cập nhật!!</div>";
                            header('location:'.SITEURL.'admin/manage-order.php');
                        }
            }
            
        ?>
    </div>
</div>
<?php
    include('partials/footer.php')
?>