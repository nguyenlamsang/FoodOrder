<?php
    include ('../config/constants.php');
    //1. get id
    echo $id = $_GET['id'];

    //2. Create query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    //3. check wether query is excuted or not
    $res = mysqli_query($conn, $sql);
    
    if($res == TRUE){
        $_SESSION['delete'] = 'Delete successfully';
        header("location:".SITEURL."/admin/manage-admin.php");
    }
    else {
        $_SESSION['delete'] = 'Delete Failure';
        header("location:".SITEURL."/admin/manage-admin.php");
    }
    //4. redirect
?>