<?php
    include('partials/menu.php')
?>

    <!--Main section start-->
    <div class="main">
        <div class="wrapper">
            <h1>Quản Lý Đơn Hàng</h1>
            <br/><br/>
            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
            ?>
            <table class="tbl-full">
                <tr>
                    <th>L.S</th>
                    <th>Tên món ăn</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tên khách hàng</th>
                    <th>Liên hệ</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_order";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    
                    $sn = 1;

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_email = $row['customer_email'];
                            $customer_contact = $row['customer_contact'];
                            $customer_address = $row['customer_address'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $food;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $order_date;?></td>
                                    <td>
                                        
                                        <?php                                        
                                            if($status=="Ordered") {
                                                echo "<label>$status</label>";
                                            }                  
                                            elseif($status =="OnDelivery") {
                                                echo  "<label style='color: #e9690e;'>$status</label>";
                                            }
                                            elseif($status =="Delivered") {
                                                echo  "<label style='color: green;'>$status</label>";
                                            }  
                                            elseif($status =="Cancelled") {
                                                echo  "<label style='color: red;'>$status</label>";
                                            }                
                                        ?>
                                
                                    </td>
                                    <td><?php echo $customer_name;?></td>
                                    <td><?php echo $customer_contact;?></td>
                                    <td><?php echo $customer_email;?></td>
                                    <td><?php echo $customer_address;?></td>
                                    

                                    
                                    <td>
                                    <button class="btn-update"><a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" >Cập nhật</a></button>
                                    
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