<?php
    include('../config/constants.php');

    // Check whether the id and image_name value are set
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if ($image_name != "") {
            $path = "../images/category/".$image_name;
            // Remove image
            $remove = unlink($path);

            // If failed ot remove image then add an error message and stop the process
            if ($remove == FALSE) {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                // Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        // Redirect to Manage Category Page with message
    }
    else {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>