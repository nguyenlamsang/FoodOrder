<?php
    include('partials/menu.php')
?>

    <!--Main section start-->
    <div class="main">
        <div class="wrapper">
        <h1>Dasboard</h1>
        <br/><br/>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                    }

                ?>
            <div class="dasboard">  
                <div class="col-4 text-center">
                    <?php
                        $sql4 = "SELECT * FROM tbl_admin";

                        $res4 = mysqli_query($conn, $sql4) ;

                        $count4 = mysqli_num_rows($res4);
                    ?>
                        <h2><?php echo $count4; ?></h2>
                        <p>Quản trị viên</p>
                </div>

                <div class="col-4 text-center">

                <?php
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql) ;

                    $count = mysqli_num_rows($res);
                ?>
                    <h2><?php echo $count; ?></h2>
                    <p>Danh mục</p>
                </div>

                <div class="col-4 text-center">
                <?php
                    $sql2 = "SELECT * FROM tbl_food";

                    $res2 = mysqli_query($conn, $sql2) ;

                    $count2 = mysqli_num_rows($res2);
                ?>
                    <h2><?php echo $count2; ?></h2>
                    <p>Món ăn</p>
                </div>

                <div class="col-4 text-center">
                <?php
                    $sql3 = "SELECT * FROM tbl_order";

                    $res3 = mysqli_query($conn, $sql3) ;

                    $count3 = mysqli_num_rows($res3);
                ?>
                    <h2><?php echo $count3; ?></h2>
                    <p>Đơn hàng</p>
                </div>

                
            </div>
            
        </div>

        
    </div>
    <!--Main section end-->
