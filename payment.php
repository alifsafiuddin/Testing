<?php
include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>PasarSISWA : Payment</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<style type="text/css"> 

	*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
   }
    /*background belakang*/

     body{
    background: #e9eaf0;/*kelabu cair*/

    }

    section {
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: stretch; /* Stretch the content vertically */
    }

    section .addproductOption {
            flex: 1; /* Take up remaining space */
            height: 100%; /* Full height */
            background-color: #e9eaf0;
            padding: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
    }

    section .product-option ul li{
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-gap: 1rem;
            background-color: #B5B7B8;
    }


    /* header */

    header{
        background-color: #5FFA3D;
        background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
        height: 125px;
    }
    header nav{
        width: 100%;
        margin: auto;
        justify-content: space-between;
    }

    header nav .logo{ 
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding-block: 35px;
          margin-right: 20px;
    }

    header nav .logo .logoo{ /*adjust font logo pasarsiswa*/
        color: #fff;
        text-transform: lowercase;
        font-size: 35px;
        font-weight: bold;
        padding-left: 30px;
    }

    header nav .logo .logoo span{ /*adjust font logo pasarsiswa*/ 
        color: #fff;
        text-transform: uppercase;
        font-size: 35px;
        font-weight: bold;
        margin-right: 70px;
    }


    header nav .logo .addproduct{ 
        color: #fff;
        font-size: 25px;
        margin-right: 350px; 
    }

    header nav .logo-search .search-box{ /*adjust searchbox*/ 
        width: 500px;
        height: 40px;
        position: relative;
    }
    header nav .logo-search .search-box input{ /*adjust searchbox Seach for... input*/ 
        width: 100%;
        height: 100%;
        padding: 0 10px 0 12px;
    }
    header nav .logo-search .search-box i{ /*adjust searchbox icon*/ 
        position: absolute;
        right: 2;
        top: 10;
        height: 100%;
        width: 55px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        color: #fff;
        background-color: #5FFA3D ;
        border: 6px solid white;
    }

    header nav .logo .icon3 a{ /*adjust nav icon*/ 
        color: #fff;
        margin-left: 10px;
        font-size: 25px;
    }

    header nav .logo .icon3 span{
          color: #fff;
          margin-left: 10px;
          font-size: 15px;
          text-align: center;
          font-family: sans-serif;
    }

    header nav .logo .icon3 a:hover{
          color: #fccb3f;
    }

    header nav .logo .icon3 a span:hover{
          color: #fccb3f;
    }

    header nav .logo .profile a {
          color: #fff;
          font-size: 40px;  
          padding-right: 30px;
          margin-left: 50px;
    }  

    header nav .logo  .profile a:hover{
          color: #fccb3f;
    }


    /*start container product ordered*/

    .container .addproductOption{
      padding:30px;
      width:1200px;
      background: #fff;
      box-shadow: 0 5px 10px rgba(0,0,0,.1);
      align-self:   center;
    }
    .container .addproductOption ul li{
        padding: 25px 0px;
        color: #000000;
        background-color: #fff;
        margin: 5px 0 10px 0;
        text-align: center;
        font-weight: bold;
    }
    .container .addproductOption ul li img{
        width: 100%;
    }
    .container .addproductOption ul li a{
        color: #black;
        display: block;
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-top: 5px;
        margin-bottom: 20px;
    }

    .form-group label {
      display: inline-block;
      width: 150px; /* Adjust the width as needed */
      text-align: right;
      margin-right: 25px;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 80%; /* Adjust the width as needed */
      padding: 13px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      display: inline-block;
      vertical-align: top;
    }

    .addproductOption form button {
        background-color: #4caf50;
        /* Green */
        color: white;
        padding: 15px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .addproductOption form button:hover {
        background-color: #45a049;
    }

    .image-upload {
      display: flex;
      align-items: center;
      margin-top: 20px;
      width: 230px;
      height: 200px;
    }

    .image-upload input {
      width: 0;
      height: 0;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }

    .tm-upload-icon {
      font-size: 40px;
      color: #555;
      margin-top: 55px;
    }

    .file-box {
      border: 1px solid #ccc;
      padding: 10px;
      width: 200px;
      height: 200px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      align-items: center; /* Center content vertically */
      justify-content: center; /* Center content horizontally */
    }

    .file-content {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #fileName {
      font-size: 14px;
      color: #555;
      flex-grow: 1;
      margin-right: 10px
    }

    .file-content span {
      margin-top: 5px;
      font-size: 12px;
    }

    section .product-orders {
          flex: 1;
          height: 100%;
          background-color: #e9eaf0;
          padding: 20px;
          margin-top: 20px;
          margin-left: 20px;
          margin-right: 20px;
          display: flex;
          flex-direction: column;
          gap: 20px;
        }

        .order-container {
          border: 1px solid #ccc;
          border-radius: 8px;
          padding: 20px;
          display: flex;
          flex-direction: column;
          gap: 10px;
          background-color: white; 
        }

        .order-header {
          font-size: 24px;
          font-weight: bold;
        }

        .product-photo img {
          background-color: ; /* Set your desired background color */
          width: 120px;
          border-radius: 8px;
        }

        .product-details {
        display: grid;
        grid-template-rows: 1fr 1fr;
        grid-template-columns: repeat(6, 1fr); /* Use auto to equally distribute columns */
        gap: 10px;
        width: 100%;
        align-items: center; /* Center vertically */
        justify-content: center; /* Center horizontally */
      }

      .attribute-column,
      .attribute-values {
        display: flex;
        flex-direction: row;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center; /* Center horizontally within each column */
        justify-items: center; /* Center horizontally */
      }

      .attribute-column div,
      .attribute-values div {
        flex: 1;
        margin-right: 0;
      }

        .order-total {
        font-size: 18px;
        font-weight: bold;
         text-align: right; /* Align text to the right */
          margin-right: 100px;
      }


       .container{
      	display: flex;
      	justify-content: center;
        overflow        : hidden;
        padding:25px;
        align-self:   center;
       
    }

    /*start container billing and payment*/

    .container form{
      padding:30px;
      width:1200px;
      background: #fff;
      box-shadow: 0 5px 10px rgba(0,0,0,.1);
      align-self:   center;
    }

    .container form .row{
      display: flex;
      flex-wrap: wrap;
      gap:15px;
      align-self:   center;
    }

    .container form .row .col{
      flex:1 1 250px;
    }

    .container form .row .col .title{
      font-size: 20px;
      color:#333;
      padding-bottom: 5px;
      text-transform: uppercase;
    }

    .container form .row .col .inputBox{
      margin:15px 0;
    }

    .container form .row .col .inputBox span{
      margin-bottom: 10px;
      display: block;
    }

    .container form .row .col .inputBox input{
      width: 100%;
      border:1px solid #ccc;
      padding:10px 15px;
      font-size: 15px;
      text-transform: none;
    }

    .container form .row .col .inputBox input:focus{
      border:1px solid #000;
    }

    .container form .row .col .flex{
      display: flex;
      gap:15px;
    }

    .container form .row .col .flex .inputBox{
      margin-top: 5px;
    }

    .container form .row .col .inputBox img{
      height: 34px;
      margin-top: 5px;
      filter: drop-shadow(0 0 1px #000);
    }

    .container form .row .col .total-orders img{
      font-size: 25px;
      font-weight: bold;
      text-align: right; /* Align text to the right */
      margin-right: 100px;
    }

    .container form .submit-btn{
      width: 100%;
      padding:12px;
      font-size: 17px;
      background: #27ae60;
      color:#fff;
      margin-top: 5px;
      cursor: pointer;
    }

    .container form .submit-btn:hover{
      background: #2ecc71;
    }

    </style>
</head>
<body>

	<!-- Header -->
	<header>
		<nav>
			<div class="logo-search">
				<div class="logo">
      <a href="#" class="logoo">pasar<span>siswa</span></a>
      <a href="#" class="addproduct">Payment</a>
      <div class="icon3">
        <a href="#"><i class="fas">&#xf015;</i><span>Home</span></a>
        <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
      </div>
      <div class="profile">
        <a href="logout.php"><i class="fa">&#xf2be;</i></a>
      </div>
    </div>
		</nav>
	</header>
	<section class="container" style=" display: flex;">

		<div class="product-orders">

      <!-- Product Order Container -->
      <div class="order-container">
        <div class="order-header">Product Ordered</div>

        <!-- Product 1 Details -->
     <div class="attribute-column">
    <div><strong>Image</strong></div>
    <div><strong>Product</strong></div>
    <div><strong>Variation</strong></div>
    <div><strong>Unit Price</strong></div>
    <div><strong>Quantity</strong></div>
    <div><strong>Amount</strong></div>
    </div>


    <div class="attribute-values">
    <div class="product-photo">
    <img src="images/potatochips.png" alt="Product 1">
    </div>
    <div>Potato Chips</div>
    <div>Spicy</div>
    <div>RM5.20</div>
    <div>1</div>
    <div>RM5.20</div>
    </div>

    <div class="order-total">Order Total: RM5.20</div>
  </div>
      </div>
      <!-- End of First Order Container -->
    </div>
</section>

<!-- Payment and Billing Container-->
<div class="container">

    <form action="">

        <div class="row">

            <div class="col">

                <h3 class="title">Billing Address</h3>

                <div class="inputBox">
                    <span>Full Name :</span>
                    <input type="text" placeholder="Full Name">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" placeholder="example@gmail.com">
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" placeholder="room - street - locality">
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" placeholder="Bangi">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>State :</span>
                        <input type="text" placeholder="Selangor">
                    </div>
                    <div class="inputBox">
                        <span>postcode :</span>
                        <input type="text" placeholder="43600">
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Cards Accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Name on Card :</span>
                    <input type="text" placeholder="farah diana">
                </div>
                <div class="inputBox">
                    <span>Credit Card number :</span>
                    <input type="text" placeholder="1111-2222-3333-4444">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Expiry :</span>
                        <input type="text" placeholder="08/22">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="123">
                    </div>
                </div>

                <div class="inputBox">
                <div class="order-totals"><b>Order Total: RM5.20</b></div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="Pay" class="submit-btn">

    </form>

</div>    
<!-- End of Payment and Billing Container Container -->
	 
</body>
</html>