<?php
include_once 'database.php';
include_once 'registration_create.php'
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_registration.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registration Capybara</title>
    <style>
        @media screen and (max-width: 1024px) {
            /* Adjust styles for laptop screens */
            body {
                font-size: 12px;
            }
        }
    </style>

    <!-- Media query for large screens -->
    <style>
        @media screen and (min-width: 1025px) {
            /* Adjust styles for large screens */
            body {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Register An Account</div>
        <div class="registration-type-buttons">
            <button id="customerButton" onclick="showCustomerForm()">Customer</button>
            <button id="sellerButton" onclick="showSellerForm()">Seller</button>
        </div>

        <div id="customerForm">
            <form action="registration_create.php" method="post" >
               <div class="user-details">
                <div class="input-box">
                    <input type="text" name="full_name" id="fullName" placeholder="Full Name" autofocus required>
                </div>
                <div class="input-box">
                    <input type="text" name="user_id" id="userID" placeholder="Matric No./Staff ID" required>
                </div>
                <div class="input-box">
                    <input type="email" name="userEmail" id="userEmail" placeholder="E-mail" required>
                </div>
                <div class="input-box">
                    <input type="tel" pattern="\+60\d{2}-\d{7}" name="phone" id="phone" placeholder="Phone Number +60##-#######" required>
                </div>
                <div class="input-box">
          <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="input-box">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        </div>
        <div id="passwordMessage"></div>
                <div class="button">
                    <input type="submit" value="Register" onclick="checkPassword()">
                </div>
            </div>
        </form>
    </div>

        <div id="sellerForm">
          
            <form action="#">
               <div class="user-details">
                <div class="input-box">
                    <input type="text" placeholder="Full Name" autofocus required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Matric No./Staff ID" required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Business Name" required>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="E-mail" required>
                </div>
                <div class="input-box">
                    <input type="tel" pattern="\+60\d{2}-\d{7}" placeholder="Phone Number +60##-#######" required>
                </div>
                <div class="input-box">
          <input type="password" id="password" placeholder="Password" required>
        </div>
        <div class="input-box">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        </div>
        <div id="passwordMessage"></div>
                <div class="button">
                    <input type="submit" value="Register" onclick="checkPassword()">
                </div>
            </div>
        </form>
  </div>
    </div>
  </div>
    <script>
        function showCustomerForm() {
            document.getElementById("customerForm").style.display = "block";
            document.getElementById("sellerForm").style.display = "none";
        }

        function showSellerForm() {
            document.getElementById("customerForm").style.display = "none";
            document.getElementById("sellerForm").style.display = "block";
        }


        function checkPassword() {
          var password = document.getElementById("password").value;
          var confirmPassword = document.getElementById("confirmPassword").value;
          var passwordMessage = document.getElementById("passwordMessage");

            if (password === confirmPassword) {
              passwordMessage.innerHTML = "Passwords match!";
              passwordMessage.style.color = "green";
            } else {
              passwordMessage.innerHTML = "Passwords do not match.";
              passwordMessage.style.color = "red";
            }
         }

</script>
</body>
</html>
