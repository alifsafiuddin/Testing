<?php
include_once 'database.php';
session_start();

$message = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function function_alert($message) { 
    echo "<script>alert('$message');</script>"; 
} 

    if (isset($_POST["login"])) {
        if (empty($_POST["userid"]) || empty($_POST["password"])) {
            $message = '<p class="error">Please enter both username and password</p>';
            function_alert("Please enter both username and password");
        } else {
            $user_query = "SELECT * FROM tbl_user_pasarsiswa WHERE fld_user_id = :userid AND fld_password = :password";
            $seller_query = "SELECT * FROM tbl_seller_pasarsiswa WHERE fld_seller_id = :userid AND fld_seller_password = :password";
            $admin_query = "SELECT * FROM tbl_admin_pasarsiswa WHERE fld_admin_id = :userid AND fld_admin_password = :password";

            // Check username length
            if (strlen($_POST["userid"]) !== 7) {
                $message = '<p class="error">Username must be 7 characters long. Please re-enter username</p>';
                function_alert("Username must be 7 characters long. Please re-enter username"); 
            } else {
                // Check in the user table
                $user_stmt = $conn->prepare($user_query);
                $user_stmt->execute(
                    array(
                        'userid' => $_POST["userid"],
                        'password' => $_POST["password"]
                    )
                );
                $user_count = $user_stmt->rowCount();

                if ($user_count == 0) {
                    // Check in the seller table
                    $seller_stmt = $conn->prepare($seller_query);
                    $seller_stmt->execute(
                        array(
                            'userid' => $_POST["userid"],
                            'password' => $_POST["password"]
                        )
                    );
                    $seller_count = $seller_stmt->rowCount();

                    if ($seller_count == 0) {
                        // Check in the admin table
                        $admin_stmt = $conn->prepare($admin_query);
                        $admin_stmt->execute(
                            array(
                                'userid' => $_POST["userid"],
                                'password' => $_POST["password"]
                            )
                        );
                        $admin_count = $admin_stmt->rowCount();

                        if ($admin_count > 0) {
                            $_SESSION["userid"] = $_POST["userid"];
                             echo '<script>alert("Login Successful"); window.location.href = "adminmenu.php";</script>';
                            exit();
                        } else {
                              $message = '<p class="error">Password Incorrect. Please re-enter password</p>';
                              function_alert("Either no user with the given username could be found, or the password you gave was wrong. Please try again.");
                        }
                    } else {
                        $_SESSION["userid"] = $_POST["userid"];
                        header("location:sellermenu.php");
                        exit();
                    }
                } else {
                    $_SESSION["userid"] = $_POST["userid"];
                    header("location:customermenu.php");
                    exit();
                }
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pasarSISWA: Login</title> 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">

    <style type="text/css">

    /* Importing fonts from Google */
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');


    /* Reseting */
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;

    }


    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        text-decoration: none;
        transition: 0.3s;
     }

    section .container{
        margin: 1em;
        width: 100%;
    }

    nav{
        background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
        background size: cover;
        width: 100%;
        height: 92px;
        position: fixed;
        border-bottom: 1px solid green;
    }
    header nav {
        display: flex;
        align-items: center;
    }

    header nav img {
        width: 160px;
    }

    header nav ul {
        margin-left: 840px;
        display: flex;
        list-style: none;
        margin-top: 15px;
    }

    header nav ul li {
        margin-right: 20px;
    }

    header nav ul li a {
        color: white;
        font-size: 20px;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s;
    }

    header nav ul li a:hover {
        background-color: white;
        color: #2AA1A3;
    }


    body{
        background-image: url(shopping2-min.png);
        background-size: 100% 100vh;
        background-attachment: fixed; /* Prevent background scrolling */
    margin: 0; /* Remove default margin */
    overflow-x: hidden; /* Hide horizontal scrollbar */
    }

    h3{
        font-size: 20px;
        text-align: center;
    }

   .wrapper .card{

        overflow        : hidden;
        margin-top      : 180px;
        margin-left     : 300px;
        margin-right     : 260px;
        width           : 800px;
        height          : 450px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(7px);
        border-radius: 12px;
        padding: 20px 20px 20px 20px;
        box-shadow: 1px 1px 20px #cbced1, -1px -1px 20px #00000;
        color: #00000;
         text-align: center;
    }

    .wrapper h3{
        font-size: 46px;
        text-align: center;
          font-weight: bold;
        color: white;
    }
    .wrapper .input-box{
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }
    .input-box input{
        width: 100%;
        height: 100%;
        background: #FFFFFF;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color:  #00000;
        padding: 20px 45px 20px 20px;
    }
    .input-box input::placeholder{
        color: #000000;
    }
    .input-box i{
        position: absolute;
        right: 20px;
        top: 30%;
        transform: translate(-50%);
        font-size: 20px;

    }

    .wrapper .remember-forgot{
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        color:  #fff;
        margin: -15px 0 15px;
    }
    .remember-forgot label input{
        accent-color: #fff;
        margin-right: 3px;

    }
    .remember-forgot a{
        color:#fff;
        text-decoration: none;

    }
    .remember-forgot a:hover{
        text-decoration: underline;
    }
    .wrapper .btn{
        width: 100%;
        height: 45px;
        background: #59F756;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }
    .wrapper .register-link{
        font-size: 14.5px;
        color: #fff;
        text-align: center;
        margin: 20px 0 15px;

    }
    .register-link p a{
        color: #59F756;
        text-decoration: none;
        font-weight: 600;
    }
    .register-link p a:hover{
        text-decoration: underline;
    }

    </style>

    <header>
        <nav>
        <img src="logo4.png" width="160px" class="pasar" style="margin: 0;">
        <img src="5.png" width="160px" class="pasar" style="margin: 0;">
        <img src="4.png" width="160px" class="pasar" style="margin: 0;">
          <ul>
            <li><a href= "login.php">HOME</a></li>
            <li><a href= "mailto:alifsafiuddin0275@gmail.com">HELP</a></li>
          </ul>
        </nav>
    </header>
    <section class="wrapper" style=" display: flex;">
        <div class="card">
        <form  method="post" class="p-3 mt-3">
            <h3>Login</h3>
            <div class="input-box">
                <input type="text" name="userid" placeholder="ID" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" onclick="myFunction()">Show Password</label>

            <script>
                function myFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
                }
            </script> 
            </div>
            <input type="submit" name="login" class="btn mt-3" value="Login"/>
            <div class="register-link">
                <p>New here? Want to be a seller? <a href="register.php">Sign Up</a></p>
            </div>
        </form>
        <div class="text-center fs-6">
              <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        </div>
    </div>

    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>


    </body>
</html>