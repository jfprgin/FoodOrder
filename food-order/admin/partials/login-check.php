<?php
    //Authorization - Access Control
    //Check whether the user is logged in
    if (!isset($_SESSION['user'])) {
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
        //Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
?>