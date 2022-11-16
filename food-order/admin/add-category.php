<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if (isset($_POST['submit'])) {
                //1. Get the value from Category form
                $title = $_POST['title'];

                //For Radio input type, we need to check whether the button is selected
                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                }
                else {
                    $featured = "No";
                }

                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                }
                else {
                    $active = "No";
                }

                // Check whether the Image is selected and set the value for image name accordingly
                //print_r($_FILES['image']);
                //die(); // Break the code
                if (isset($_FILES['image']['name'])) {
                    //To upload image we need image name, source path and destiantion path
                    $image_name = $_FILES['image']['name'];

                    //Upload image only if image is selected
                    if ($image_name != "") {
                        //Auto Rename Image
                        //Get the extension of our Image
                        $ext = end(explode('.', $image_name));

                        // Rename the Imahe
                        $image_name = "food_category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the Image is uploaded
                        if ($upload == FALSE) {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            //Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the Process
                            die();
                        }
                    }
                }
                else {
                    $image_name = "";
                }

                //2. Create SQL Quer to Insert Category into Database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute the Query and Save into Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the Query executed and data was added
                if ($res == TRUE) {
                   $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                   // Redirect to Manage Category Page
                   header('location:'.SITEURL.'admin/manage-category.php'); 
                }
                else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>