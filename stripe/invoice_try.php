<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <style type="text/css">
          
        *,
        *::after,
        *::before{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        :root{
            --blue-color: #0c2f54;
            --dark-color: #535b61;
            --white-color: #fff;
        }

        ul{
            list-style-type: none;
        }
        ul li{
            margin: 2px 0;
        }

        /* text colors */
        .text-dark{
            color: var(--dark-color);
        }
        .text-blue{
            color: var(--blue-color);
        }
        .text-end{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .text-start{
            text-align: left;
        }
        .text-bold{
            font-weight: 700;

        }
        /* hr line */
        .hr{
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        /* border-bottom */
        .border-bottom{
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body{
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            font-size: 14px;
        }
        .invoice-wrapper{
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.1);
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .invoice{
            max-width: 850px;
            margin-right: auto;
            margin-left: auto;
            background-color: var(--white-color);
            padding: 70px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            min-height: 920px;
        }
        .invoice-head-top-left img{
            width: 130px;
        }
        .invoice-head-top-right h3{
            font-weight: 500;
            font-size: 27px;
            color: var(--blue-color);
        }
        .invoice-head-middle, .invoice-head-bottom{
            padding: 16px 0;
        }
        .invoice-body{
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }
        .invoice-body table{
            border-collapse: collapse;
            border-radius: 4px;
            width: 100%;
        }
        .invoice-body table td, .invoice-body table th{
            padding: 12px;
        }
        .invoice-body table tr{
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .invoice-body table thead{
            background-color: rgba(0, 0, 0, 0.02);
        }
        .invoice-body-info-item{
            display: grid;
            grid-template-columns: 80% 20%;
        }
        .invoice-body-info-item .info-item-td{
            padding: 12px;
            background-color: rgba(0, 0, 0, 0.02);
        }
        .invoice-foot{
            padding: 30px 0;
        }
        .invoice-foot p{
            font-size: 12px;
        }
        .invoice-btns{
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .invoice-btn{
            padding: 3px 9px;
            color: var(--dark-color);
            font-family: inherit;
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 10px;
        }

        @media screen and (max-width: 992px){
            .invoice{
                padding: 40px;
            }
        }

        @media screen and (max-width: 576px){
            .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
                grid-template-columns: repeat(1, 1fr);
            }
            .invoice-head-bottom-right{
                margin-top: 12px;
                margin-bottom: 12px;
            }
            .invoice *{
                text-align: left;
            }
            .invoice{
                padding: 28px;
            }
        }

        .overflow-view{
            overflow-x: scroll;
        }
        .invoice-body{
            min-width: 600px;
        }

        @media print{
            .print-area{
                visibility: visible;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                overflow: hidden;
            }

            .overflow-view{
                overflow-x: hidden;
            }

            .invoice-btns{
                display: none;
            }
        }
        </style>
    </head>
    <body>

        <div class="invoice-wrapper" id="print-area">
    <div class="invoice">
        <div class="invoice-container">

            <?php
            // Include your database connection logic here
            $servername = "lrgs.ftsm.ukm.my";
            $username = "a187044";
            $password = "giantblackfox";
            $dbname = "a187044";

            // Assuming you have a database connection object named $conn
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Get the order ID from the URL parameter
            $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';


            // Fetch data from the database based on the trimmed order ID
            $sql = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_id = '$order_id'";
            

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Retrieve data from the database
                $product_name = $row['fld_product_name'];
                $quantity = $row['fld_quantity'];
                $price = $row['fld_price'];
                $amount = $row['fld_amount'];
                $date = $row['fld_order_date'];
                $user = $row['fld_user_id'];

                // Check if 'user_id' key exists in the $row array
                $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

                // Fetch customer details based on user_id
                $sql_customer = "SELECT * FROM tbl_user_pasarsiswa WHERE fld_user_id = '$user_id'";
                $result_customer = mysqli_query($conn, $sql_customer);

                if ($result_customer && mysqli_num_rows($result_customer) > 0) {
                    $customer_details = mysqli_fetch_assoc($result_customer);

                    // Retrieve customer information
                    $customer_name = isset($customer_details['fld_user_name']) ? $customer_details['fld_user_name'] : '';
                    $customer_email = isset($customer_details['fld_email']) ? $customer_details['fld_email'] : '';
                    $customer_phone = isset($customer_details['fld_phone']) ? $customer_details['fld_phone'] : '';
                } else {
                    // Handle the case when customer details are not found
                    $customer_name = $customer_email = $customer_phone = 'N/A';
                }


                 // Check if 'seller_id' key exists in the $row array
                $seller_id = isset($_GET['seller_id']) ? $_GET['seller_id'] : '';

                // Fetch seller details based on user_id
                $sql_seller = "SELECT * FROM tbl_seller_pasarsiswa WHERE fld_seller_id = '$seller_id'";
                $result_seller = mysqli_query($conn, $sql_seller);

                if ($result_seller && mysqli_num_rows($result_seller) > 0) {
                    $seller_details = mysqli_fetch_assoc($result_seller);

                    // Retrieve customer information
                    $seller_name = isset($seller_details['fld_seller_name']) ? $seller_details['fld_seller_name'] : '';
                    $seller_bname = isset($seller_details['fld_business_name']) ? $seller_details['fld_business_name'] : '';
                    $seller_email = isset($seller_details['fld_seller_email']) ? $seller_details['fld_seller_email'] : '';
                    $seller_phone = isset($seller_details['fld_seller_phonenumber']) ? $seller_details['fld_seller_phonenumber'] : '';

                } else {
                    // Handle the case when customer details are not found
                    $seller_name = $seller_bname = $seller_email = $seller_phone = 'N/A';
                }
            
            
           

            // Output the data in your HTML
            ?>

                <div class = "invoice-head">
                        <a href="http://localhost/aa/customermenu.php?" style="color: black" ><span class = "text-bold">Back to Homepage <</span></a>
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start" style="display: flex">
                                <img src = "logo_pasarsiswa.png">
                                <img src = "logo_watan.png">
                                <img src = "logo_ukm.png">
                            </div>
                            <div class = "invoice-head-top-right text-end">
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date</span>: <?php echo $date; ?></p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Order ID: <?php echo $order_id; ?></span></p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Customer Info:</li>
                                    <li><?php echo $customer_name; ?></li>
                                    <li><?php echo $customer_email; ?></li>
                                    <li><?php echo $customer_phone; ?></li>
                                    
                                </ul>
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Seller Info:</li>
                                    <li><?php echo $seller_name; ?></li>
                                    <li><?php echo $seller_bname; ?></li>
                                    <li><?php echo $seller_email; ?></li>
                                    <li><?php echo $seller_phone; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                <div class="overflow-view">
                    <div class="invoice-body">
                        <table>
                            <thead>
                            <tr>
                                <td class="text-bold">Product Name</td>
                                <td class="text-bold text-center">Quantity</td>
                                <td class="text-bold text-end">Price(RM)/unit</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $row['fld_product_name']; ?></td>
                                <td class="text-center"><?php echo $row['fld_quantity']; ?></td>
                                <td class="text-end"><?php echo number_format($row['fld_price'], 2, '.', ''); ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="invoice-body-bottom">
                            <div class="invoice-body-info-item border-bottom">
                                <div class="info-item-td text-end text-bold">Sub Total:</div>
                                <div class="info-item-td text-end" type="number" name="amount" value="" disabled required><?php echo number_format($amount, 2, '.', ''); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                        <div class = "invoice-btns">
                            <button type = "button" class = "invoice-btn" onclick="printInvoice()">
                                <span>
                                    <i class="fa-solid fa-print"></i>
                                </span>
                                <span>Print</span>
                            </button>
                        </div>
                    </div>

                <?php
            } else {
            
                echo "Order not found.";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

        </div>
    </div>
</div>

<script type="text/javascript">

    function printInvoice() {
        window.print();
    }

</script>

</body>
</html>