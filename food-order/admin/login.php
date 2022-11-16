<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if (isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Passsword"><br><br>
                
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>

            <p class="text-center">Created By Jakov Filip Prgin</p>
        </div>

    </body>
</html>

<?php
    //Check whether Submint Button is Clicked
    if (isset($_POST['submit'])) {
        //1. Get Data from Login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //2. SQL to check whether the user with username and password exists
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //User available and Login SUccess
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;  //Check whether the user is logged in and logout will unset it
            
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>