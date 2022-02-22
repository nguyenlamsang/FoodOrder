<?php
    include('../config/constants.php');
    //1. get id and image name
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!= "") {
            $path = "../images/food/" .$image_name;

            $remove = unlink($path);

            if($remove == false) {
                $_SESSION['remove'] = "<div class='fail'>Fail to remove image from folder</div>";
                header('location: ' .SITEURL. 'admin/manage-food.php');
                die();
            }
        }
        $sql = "DELETE FROM tbl_food WHERE id=$id" ;

        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $_SESSION['delete'] = "<div class='success'>Delete successfully</div>";
            header('location:' .SITEURL.'admin/manage-food.php');
        }
        else {
            $_SESSION['delete'] = "<div class='fail'> Fail to delete food</div>";
            header('location:' .SITEURL.'admin/manage-food.php');
        }

    }
    else {
        $_SESSION['delete'] = "<div class='fail'> Fail to delete food</div>";
        header('location:' .SITEURL.'admin/manage-food.php');
    }
    
?>