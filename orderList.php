<?php
include_once 'session.php';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';

?>

<!DOCTYPE html>
<html>
<head>
  <style>
  body {
    background-image: url("wallpaper.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
  }

  @media (max-width: 768px) {
    body {
      background-size: contain;
    }
  }

   .white-table {
  background-color: white;
}

.white-table th {
  color: black;
}
  
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PasarSISWA: Give Feedback</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


    

</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>PasarSISWA : Menu</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Link File CSS -->
    <link rel="stylesheet" href="style_sellermenu.css">

    <script type="text/javascript">
        function searchProduct() {
            let input = document.getElementById('searchbar').value.toLowerCase();
            let products = document.getElementsByClassName('product-title');

            for (let i = 0; i < products.length; i++) {
                if (!products[i].innerHTML.toLowerCase().includes(input)) {
                    products[i].parentNode.parentNode.style.display = "none";
                } else {
                    products[i].parentNode.parentNode.style.display = "";
                }
            }
        }

        function refreshPage() {
            location.reload(true); // Reloads the page
        }
    </script>
</head>
<body>
<header>
        <nav>
            <div class="logo-search">
                <a href="customermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                <div class="search-box">
                    <input id="searchbar" onkeyup="searchProduct()" type="text" name="search" hidden placeholder="Search Here..">
                    
                </div>

                <div class="icon">
                    <a href="customermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="logout.php"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>
  
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Order List</h2>
      </div>
      <table id="product-table" class="table table-striped table-bordered white-table">
        <thead>
          <tr style="font-weight:bold; background-color: #d2e8fe;">
          <th>Order ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price (RM)</th>
            <th>Total Amount (RM)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Read
          try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Modify the query to include the user ID condition
    $stmt = $conn->prepare("SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_status='Completed' AND fld_user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id); // Bind the user ID parameter
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


            foreach ($result as $readrow) {
          ?>
              <tr>
                <td><?php echo $readrow['fld_order_id']; ?></td>
                <td><?php echo $readrow['fld_product_id']; ?></td>
                <td><?php echo $readrow['fld_product_name']; ?></td>
                <td><?php echo $readrow['fld_quantity']; ?></td>
                <td><?php echo number_format($readrow['fld_price'], 2); ?></td>
                <td><?php echo number_format($readrow['fld_amount'], 2); ?></td>
                <td>
                  <button data-href="order_details.php?pid=<?php echo $readrow['fld_product_id']; ?>&orderid=<?php echo $readrow['fld_order_id']; ?>" class="btn btn-warning btn-xs btn-details" role="button">Details</button>
                </td>
              </tr>
          <?php
            }
          $conn = null;
          ?>
        </tbody>
      </table>
       <?php
      if (empty($result)) {
    echo '<div class="center-container">';
    echo '<div class="container text-center mt-5">';
    echo '<h4>You have to purchase an item in order to give feedback on products.</h4>';
    echo '</div>';
    echo '</div>';
}
      ?>
    </div>
  </div>


  <div class="bs-example">

  <div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Order Details</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
        
        <a href="giveFeedback.php?orderid=<?php echo $readrow['fld_order_id']; ?>" class="btn btn-primary btn-xs btn-details" role="button">Give Feedback</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
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



    $('#product-table tbody').on('click', 'button.btn-details', function() {
  var dataURL = $(this).attr('data-href');
  var orderID = getUrlParameter('orderid', dataURL);

  $('.modal-body').load(dataURL, function() {
    // Update the "Give Feedback" button href with the correct order ID
    $('#myModal .btn-details').attr('href', 'giveFeedback.php?orderid=' + orderID);

    // Show the modal
    $('#myModal').modal({
      backdrop: 'static', // Prevents modal from closing when clicking outside
      keyboard: false // Disables closing the modal using the escape key
    });
  });
});

// Function to extract parameter values from URL
function getUrlParameter(name, url) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}


    var exportContainer = $('<div class="export-container"></div>').insertAfter('.dataTables_info');
    table.buttons().container().appendTo(exportContainer);


    $('.export-container .btn-primary').removeClass('btn-secondary').addClass('btn-primary');

  });
</script>

<script>
  function validateNumber(input) {
    var value = input.value;
    var isValid = /^\d+$/.test(value); // Regex to check if the input consists of digits only

    var warningMessage = document.getElementById("price-warning");
    if (!isValid) {
      warningMessage.textContent = "Please enter a valid number.";
    } else {
      warningMessage.textContent = "";
    }
  }
</script>

<script>
  function validateQuantity(input) {
    var value = input.value;
    var isValid = /^\d+$/.test(value); // Regex to check if the input consists of digits only

    var warningMessage = document.getElementById("quantity-warning");
    if (!isValid) {
      warningMessage.textContent = "Please enter a valid number.";
    } else {
      warningMessage.textContent = "";
    }
  }
</script>

</body>
</html>