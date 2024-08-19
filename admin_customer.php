<?php
include_once 'database.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_orders FROM tbl_order_pasarsiswa";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalOrders = $row['total_orders'];
} else {
    $totalOrders = 0; 
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_sellers FROM tbl_seller_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalSellers = $row['total_sellers'];
} else {
    $totalSellers = 0; 
}

// Query to get the total count of products
$sql = "SELECT COUNT(*) as total_products FROM tbl_products_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    $totalProducts = 0; 
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_customers FROM tbl_user_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalCustomers = $row['total_customers'];
} else {
    $totalCustomers = 0; 
}

$totalUsers = $totalCustomers + $totalSellers;

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA :Admin Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');
 


  .page-header {
    background-color: #5FFA3D;
    padding: 20px;
    text-align: center;
    color: #fff;
  }

  table {
    width: 100%;
    background-color: #fff;
    border: 1px solid #ddd;
    margin-top: 20px;
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #d2e8fe;
  }

  tbody tr:hover {
    background-color: #f5f5f5;
  }

  .export-container {
    margin-top: 20px;
  }

  .export-container .btn-primary {
    color: #fff;
    background-color: #5FFA3D;
    border-color: #5FFA3D;
  }

  .export-container .btn-primary:hover {
    background-color: #2AA1A3;
    border-color: #2AA1A3;
  }
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
}
body{
    background: #e9eaf0;
}
section .container{
    margin: 1em;
    width: 100%;
}
section .side-nav{
    width: 30%;
    height:1300px;
    background-color: #B5B7B8; 
}
section .side-bar-option{
    width: 50%;
    height:100%;
    background-color: #e9eaf0; 
}
section .product-option ul li{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1rem;
    background-color: #B5B7B8;
}


header{
    background-color: #5FFA3D;
    background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
    height: 125px;
}
header nav{
    width: 100%;
    margin: auto;
}
header nav .logo-search{ 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-block: 35px;
}
header nav .logo-search .logo{ 
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
}
header nav .logo-search .logo span{ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
}
header nav .logo-search .icon a{  
    color: #fff;
    margin-left: 10px;
    font-size: 25px;
}
header nav .logo-search .icon span{
    color: #fff;
    margin-left: 10px;
    font-size: 15px;
    text-align: center;
    font-family: sans-serif;
}
header nav .logo-search .icon a:hover{
    color: #fccb3f;
}
header nav .logo-search .icon a span:hover{
    color: #fccb3f;
}
header nav .logo-search .icon2 a {
    color: #fff;
    font-size: 40px;  
    padding-right: 30px;
}  
header nav .logo-search .icon2 a:hover{
    color: #fccb3f;
}

.container .side-nav{
    overflow: hidden;
    width: 250px;
    height: 100vh;
    background-color: #B5B7B8;
    overflow: hidden;
    padding: 20px 10px 20px 10px;
}
.container .side-nav ul li{
    padding: 10px 20px;
    color: #000000;
    cursor: pointer;
    background-color: #fff;
    margin: 5px 0 20px 0;
    text-align: center;
}
.container .side-nav ul li a{
    color: #000000;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}

.main--content {
    
    overflow        : hidden;
    margin-top      : 0px;
    margin-bottom   : 0px;
    margin-left     : 30px;
    padding         : 0 20px;
    height          : 100%;
    width           : calc(100% - 300px);
    transition      : .3s;
   
   
}
.main--content.active {
    width: calc(100% - 103px);
}
.title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    margin-top: 30px;
}
.section--title {
    font-weight: 400;
}
.dropdown {
    outline: none;
    border: none;
    background-color: #f1f4f8;
    border-radius: 5px;
    width: 150px;
    padding: 5px;
}
.cards {
    display: flex;
    gap: 20px;
}
.card {
    padding: 20px;
    border-radius: 20px;
    min-width: 230px;
    height: auto;
    transition: .3s;
}
.card:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.card--data {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}
.card h1 {
    font-size: 30px;
    margin-top: 10px;
}
.card--icon--lg {
    font-size: 80px;
}

.card-1 {
    background-color: rgba(80, 115, 251, .1);
}
.card-1 .card--title {
    color: rgba(80, 115, 251, 1);
}
.card-1 .card--icon--lg {
    color: rgba(80, 115, 251, .4);
}
.card-2 {
    background-color: rgba(241, 210, 67, .1);
}
.card-2 .card--title {
    color: rgba(241, 210, 67, 1);
}
.card-2 .card--icon--lg {
    color: rgba(241, 210, 67, .4);
}
.card-3 {
    background-color: rgba(112, 215, 165, .1);
}
.card-3 .card--title {
    color: rgba(112, 215, 165, 1);
}
.card-3 .card--icon--lg {
    color: rgba(112, 215, 165, .4);
}
.card-4 {
    background-color: rgba(227, 106, 82, .1);
}
.card-4 .card--title {
    color: rgba(227, 106, 82, 1);
}
.card-4 .card--icon--lg {
    color: rgba(227, 106, 82, .4);
}
.card-5 {
    background-color: rgba(218, 177, 67, .1);
}
.card-5 .card--title {
    color: rgba(218, 177, 67, 1);
}
.card-5 .card--icon--lg {
    color: rgba(218, 177, 67, .4);
}


.sales--right--btns {
    display: flex;
    align-items: center;
    gap: 30px;
}

.sales--cards {
    display: flex;
    gap: 20px;
}
.sale--card {
    padding: 20px;
    border-radius: 20px;
    height: auto;
    transition: .3s;
    border: 2px solid #f1f1f1;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: .8rem;
}
.sale--card:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.Jan {
    color: #5073fb;
}
.Feb {
    color: #5073fb;
}
.March {
    color: #5073fb;
}
.Apr {
    color: #5073fb;
}
.May {
    color: #5073fb;
}
.June {
    color: #5073fb;
}
.July {
    color: #5073fb;
}
.Aug {
    color: #5073fb;
}
.Sep {
    color: #5073fb;
}
.Oct {
    color: #5073fb;
}
.Nov {
    color: #5073fb;
}
.Dec {
    color: #5073fb;
}

.yearly--report {
    margin-bottom: 20px;
}

.table {
    height: 200px;
    overflow-y: scroll;
}
table {
    width: 100%;
    text-align: left;
    border-collapse: collapse;
}
tr {
    border-bottom: 1px solid #f1f1f1;
}
td,
th {
    padding-block: 10px;
}
.pending {
    color: #f1d243;
}
.confirmed {
    color: #70d7a5;
}
.rejected {
    color: #e86786;
}

/* responsive starts here */
@media screen and (max-width:1350px) {
    .cards,
    .sales--cards {
        overflow-x: scroll;
    }
}

}

</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
        $(document).ready(function () {
            // Load order list when "Orders" link is clicked
            $("#load-orders").click(function () {
                $("#content-container").load("admin_order.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load Seller list when "Sellers" link is clicked
            $("#load-sellers").click(function () {
                $("#content-container").load("admin_seller.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load Customers list when "Customers" link is clicked
            $("#load-customers").click(function () {
                $("#content-container").load("admin_customer.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load products list when "Products" link is clicked
            $("#load-products").click(function () {
                $("#content-container").load("admin_products.php");
            });
        });
</script>

</head>
<body>
    <header>
        <nav>
            <div class="logo-search">
                <a href="adminmenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                
                <div class="icon">
                    <a href="adminmenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="#"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>

    <section class="container" style="display: flex;">
        <div class="side-nav">
            <ul>
                <li><a href="adminmenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="admin_order.php">Orders</a></li>
                <li><a href="admin_seller.php">Sellers</a></li>
                <li><a href="admin_customer.php">Customers</a></li>
                <li><a href="admin_products.php">Products</a></li>
            </ul>
        </div>

        <div class="main--content">
        <div id="content-container">
            
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <br>
      <div class="page-header">
        <h2>Customer List</h2>
      </div>
      <table id="product-table" class="table table-striped table-bordered white-table">
        <thead>
          <tr style="font-weight:bold; background-color: #d2e8fe;">
          <th>User ID</th>
            <th>User Name</th>
            <th>Position</th>
            <th>User Email</th>
            <th>Phone Number</th>
            <th>Location</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
           // Read
           try {
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $conn->prepare("select * from tbl_user_pasarsiswa");
             $stmt->execute();
             $result = $stmt->fetchAll();
           } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
           }
           foreach ($result as $readrow) {
           ?>
             <tr>
               <td><?php echo $readrow['fld_user_id']; ?></td>
               <td><?php echo $readrow['fld_user_name']; ?></td>
               <td><?php echo $readrow['fld_position']; ?></td>
               <td><?php echo $readrow['fld_email']; ?></td>
               <td><?php echo $readrow['fld_phone']; ?></td>
               <td><?php echo $readrow['fld_location']; ?></td>
               <td>
               </td>
             </tr>
           <?php
           }
           $conn = null;
           ?>
        </tbody>
      </table>
    </div>
  </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>



<script>
  $(document).ready(function() {

    var table = $('#product-table').DataTable({
      "order": [[1, "asc"]], 
      "pagingType": "full_numbers", 
      "pageLength": 5, 
      "lengthMenu": [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]], 
      "searching": true, 
      "columnDefs": [{ "searchable": false, "targets": 2 }],  
      "dom": 'lBfrtip', 
      "buttons": [
        {
          extend: 'excelHtml5',
          text: 'Excel',
          exportOptions: {
            columns: [0, 1, 2, 3]
          },
          className: 'btn btn-primary' 
        }
      ]
    });


    var exportContainer = $('<div class="export-container"></div>').insertAfter('.dataTables_info');
    table.buttons().container().appendTo(exportContainer);


    $('.export-container .btn-primary').removeClass('btn-secondary').addClass('btn-primary');

  });
</script>
</body>
</html>