<?php
include_once 'register_crud.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    // Handle form submission and database operations

    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
    <html>
    <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>pasarSISWA: Register</title> 

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

/*header*/
     nav{
     background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
     background size: cover;
     width: 100%;
     height: 92px;
     position: sticky;
     border-bottom: 1px solid green;
     top: 0;
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
  background-image: url(shopping2.png);
  background-size: 100% 100vh;
}
h3{
  font-size: 20px;
  text-align: center;
  }

.wrapper {
  padding-top: 50px; /* Add padding to the top of the content to prevent overlap */
  display: flex;
}

  /*start container */
.wrapper .card{

    overflow        : hidden;
    margin-bottom   : 40px;
    margin-left     : 200px;
    margin-right    : 200px;
    width           : 1200px;
    height          : 800px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(7px);
    border-radius: 12px;
    padding: 20px 20px 20px 20px;
    box-shadow: 1px 1px 20px #cbced1, -1px -1px 20px #00000;
    color: #00000;
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
  padding: 20px 20px 20px 20px;
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

.wrapper .btn {

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

</head>
<body>

<header>
        <nav>
          <img src = "logo4.png" width="160px" class="pasar" >
          <img src = "5.png" width="160px" class="pasar" >
          <img src = "4.png" width="160px" class="pasar" >
          <ul>
            <li><a href= "login.php">HOME</a></li>
            <li><a href= "mailto:alifsafiuddin0275@gmail.com">HELP</a></li>
          </ul>
        </nav>
      </header>

      <section class="wrapper" style=" display: flex;">
    <div class="card">
    <form  method="post" class="p-3 mt-3">
      <h3>Register An Account</h3>

       <form action="register.php" method="post" class="p-3 mt-3">
        <div class="input-box">
            <input name="sellerid" type="text" class="form-control" id="sellerid" placeholder="Matric No./Staff ID" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_seller_id']; ?>" required>
        </div>

         <div class="input-box">
            <input name="fullname" type="text" class="form-control" id="fullname" placeholder="Full Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_seller_name']; ?>" required>
        </div>
        <div class="input-box">
            <input name="businessname" type="text" class="form-control" id="businessname" placeholder="Business Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_business_name']; ?>" required>
        </div>
         <div class="input-box">
            <input name="selleremail" type="email" class="form-control" id="selleremail" placeholder="E-mail" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_seller_email']; ?>" required>
        </div>
        <div class="input-box">
            <input name="phonenumber" type="tel" class="form-control" id="phonenumber" pattern="\0\d{2}-\d{7}" placeholder="01########" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_seller_phonenumber']; ?>" required>
        </div>
        <div class="input-box">
            <input name="sellerpassword" type="password" class="form-control" id="sellerpassword" placeholder="Password" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_seller_password']; ?>" required>
        </div>
        <div class="input-box">
            <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" required>
        </div>
        <div id="passwordMessage"></div>
        <div class="input-box">
            <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_seller_id']; ?>">
                <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
            <?php } else { ?>
                <a href="login.php"><button  class="btn btn-default" type="submit" name="create" onclick="validateForm()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Register</button></a>
                <div class="register-link">
                <p>Already Have Account? <a href="login.php">Log In</a></p>
            </div>
            <?php } ?>
        </div>
    </form>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
<script>
    function validateForm() {
        var password = $("#sellerpassword").val();
        var confirmPassword = $("#confirmpassword").val();

        // Check if the passwords match
        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }
    }
</script>
</body>
</html>












      