<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Add Food Title">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Add Food Description"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                    <?php
                        // Create PHP Code to display categories from Database
                        //1. Create SQL to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        $res = mysqli_query($conn, $sql);

                        // Count rows to check whether we have categories
                        $count = mysqli_num_rows($res);

                        // If count > 0 we have categories
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                // Get details of Category
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else {
                            ?>
                                <option value="0">No Category Found</option>
                            <?php
                        }

                        //2. Display on Dropdown
                    ?>

                    </select>
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
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
            </table>

        </form>

        <?php
            //Check whether the button is clicked
            if (isset($_POST['submit'])) {
                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check whether radio button for feature and active are checked
                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                }
                else {
                    $featured = "No";   // Setting the Default Value
                }

                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                }
                else {
                    $active = "No";
                }

                //2. Upload the Image if selected
                // CHeck wheter select image is clicked and upload the image only ig the image is selected
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    // Check whether the image is selected and upload only if selected
                    if ($image_name != "") {
                        // Image is selected
                        // Rename the image
                        $ext = end(explode('.', $image_name));
                        
                        // Create New Name for Image
                        $image_name ="food_name_".rand(0000, 9999).".".$ext;

                        // Upload the image
                        // Get the src path and Destionation path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;

                        // Upload Image
                        $upload = move_uploaded_file($src, $dst);

                        // CHeck whether image uploaded
                        if ($upload == FALSE) {
                            // Failed to upload image nad Redirect to Add Food Page with error message
                            $_SESSION['upload'] = "<div class ='error'>Failed to Upload Image</div>";
                            header('loation:'.SITEURL.'admin/add-food.php');
                            //Stop the process
                            die();
                        }

                    }
                }
                else {
                    $image_name = "";   // Setting Default valuer as blank
                }

                //3. Insert into Database
                // Create SQL Query to Save or Add Food
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute Query
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect with message to Manage Food Page
                // Check wheret data is inserted
                if ($res2 == TRUE) {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>