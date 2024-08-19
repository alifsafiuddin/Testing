<?php
include_once 'database.php';
// Check if a year is selected
if (isset($_GET['selected_year'])) {
     $selected_year = $_GET['selected_year'];

 // Assuming your order date is in 'Y-m-d H:i:s' format
 $start_date = "$selected_year-01-01 00:00:00";
 $end_date = "$selected_year-12-31 23:59:59";

 // Your MySQLi database connection code here
 $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders for the selected year
$query = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_date BETWEEN '$start_date' AND '$end_date'";
// Execute the query and display the results
$result = $conn->query($query);
// Close the database connection
$conn->close();
} else {
// If no year is selected, display a message
echo "<p>Please select a year from the admin menu.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA : Menu</title>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style type="text/css"> 
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
}
body{
    background: #e9eaf0;/*kelabu cair*/
}
section .container{
    margin: 1em;
    width: 100%;
    
}

@media print {
 .table, .table__body {
  overflow: visible;
  height: auto !important;
  width: auto !important;
 }
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
}
header nav .logo-search{ /*align semua item dalam header*/
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-block: 35px;
}
header nav .logo-search .logo{ /*adjust font logo pasarsiswa*/
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
}
header nav .logo-search .logo span{ /*adjust font logo pasarsiswa*/ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
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
header nav .logo-search .icon a{ /*adjust nav icon*/ 
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


/* start table */

table {
    width: 100%;
    
}

table, th, td {
    border-collapse: collapse;
    padding: 1rem;
    text-align: left;
}

thead th {
    position: sticky;
    top: 0;
    left: 0;
    background-color: #d5d1defe;
    cursor: pointer;
    text-transform: capitalize;
}

tbody tr:nth-child(even) {
    background-color: #0000000b;
}

tbody tr {
    --delay: .1s;
    transition: .5s ease-in-out var(--delay), background-color 0s;
}

tbody tr.hide {
    opacity: 0;
    transform: translateX(100%);
}

tbody tr:hover {
    background-color: #fff6 !important;
}


@media (max-width: 1000px) {
    td:not(:first-of-type) {
        min-width: 12.1rem;
    }
}


thead th:hover {
    color: #6c00bd;
}


thead th.active,tbody td.active {
    color: #6c00bd;
}

.export__file {
    position: relative;
}

.export__file .export__file-btn {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    background: #fff6 url(img/export.png) center / 80% no-repeat;
    border-radius: 50%;
    transition: .2s ease-in-out;
}

.export__file .export__file-btn:hover { 
    background-color: #fff;
    transform: scale(1.15);
    cursor: pointer;
}

.export__file input {
    display: none;
}

.export__file .export__file-options {
    position: absolute;
    right: 0;
    
    width: 12rem;
    border-radius: .5rem;
    overflow: hidden;
    text-align: center;

    opacity: 0;
    transform: scale(.8);
    transform-origin: top right;
    
    box-shadow: 0 .2rem .5rem #0004;
    
    transition: .2s;
}

.export__file input:checked + .export__file-options {
    opacity: 1;
    transform: scale(1);
    z-index: 100;
}

.export__file .export__file-options label{
    display: block;
    width: 100%;
    padding: .6rem 0;
    background-color: #f2f2f2;
    
    display: flex;
    justify-content: space-around;
    align-items: center;

    transition: .2s ease-in-out;
}

.export__file .export__file-options label:first-of-type{
    padding: 1rem 0;
    background-color: #86e49d !important;
}

.export__file .export__file-options label:hover{
    transform: scale(1.05);
    background-color: #fff;
    cursor: pointer;
}

.export__file .export__file-options img{
    width: 2rem;
    height: auto;
}

/*start container table-left*/

main.table-left {
    margin-top: 1rem;
    margin-left: 38rem;
    width: 20vw;
    height: 30vh;
    background-color: #fff5;

    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border-radius: .8rem;

    overflow: hidden;
}

.table-left.table__header {
    width: 100%;
    height: 10%;
    background-color: #5FFA3D;
    padding: .8rem 2rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}


.table-left.table__body {
    width: 95%;
    max-height: calc(89% - 1.6rem);
    background-color: #fffb;

    margin: .8rem auto;
    border-radius: .6rem;

    overflow: auto;
    overflow: overlay;
}


.table-left.table__body::-webkit-scrollbar{
    width: 0.5rem;
    height: 0.5rem;
}

.table-left.table__body::-webkit-scrollbar-thumb{
    border-radius: .5rem;
    background-color: #0004;
    visibility: hidden;
}

.table-left.table__body:hover::-webkit-scrollbar-thumb{ 
    visibility: visible;
}



/* start container table */

main.table {
    margin-top: 1rem;
    margin-left: 1rem;
    width: 82vw;
    height: 90vh;
    background-color: #fff5;
    margin-left: 8rem;
    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border-radius: .8rem;
    overflow: scroll;
}

.table__header {
    width: 100%;
    height: 10%;
    background-color: #5FFA3D;
    padding: .8rem 1rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}


.table__body {
    width: auto;
    height: auto;
    background-color: #fffb;
    margin: .8rem auto;
    border-radius: .6rem;
    overflow: auto;
    overflow: overlay;
}



.table__body::-webkit-scrollbar{
    width: 0.5rem;
    height: 0.5rem;
}

.table__body::-webkit-scrollbar-thumb{
    border-radius: .5rem;
    background-color: #0004;
    visibility: hidden;
}

.table__body:hover::-webkit-scrollbar-thumb{ 
    visibility: visible;
}


.row .btn1 {
    margin-top: 1rem;
    display: inline-block;
    border: 1.5px solid #ddd;
    text-align: center;
    padding: 0.8rem 5rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
    right: 25px;
    margin-left: 35rem;
}
.row .btn1{
    cursor: pointer;
    color: #fff;
}

.row .btn1:first-of-type{
    background: #5FFA3D;
}

.row .btn1:last-of-type{
    background: #5FFA3D;
}

.row .btn1:hover{
    background: #B8FF95;
    border-color: transparent;
    color: #fff;
}

.row .btn2 {
    margin-top: 1rem;
    display: inline-block;
    border: 1.5px solid #ddd;
    text-align: center;
    padding: 0.8rem 5rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
    right: 25px;
}
.row .btn2{
    cursor: pointer;
    color: #fff;
}

.row .btn2:first-of-type{
    background: #5FFA3D;
}

.row .btn2:last-of-type{
    background: #5FFA3D;
}

.row .btn2:hover{
    background: #B8FF95;
    border-color: transparent;
    color: #fff;
}

</style>

<script type="text/javascript">

const toExcel = function (table) {
  const t_heads = table.querySelectorAll('th'),
    tbody_rows = table.querySelectorAll('tbody tr');

  const headings = [...t_heads].map(head => {
    let actual_head = head.textContent.trim().split(' ');
    return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
  }).join('\t');

  const table_data = [...tbody_rows].map(row => {
    const cells = row.querySelectorAll('td'),
      data_without_img = [...cells].map(cell => cell.textContent.trim()).join('\t');

    return data_without_img;
  }).join('\n');

  return headings + '\n' + table_data;
};

// Download function with blob creation and download link
const downloadFile = function (data, fileType, fileName = '') {
  const blob = new Blob([data], { type: `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8` });
  const link = document.createElement('a');
  link.href = window.URL.createObjectURL(blob);
  link.download = fileName;
  link.click();
  window.URL.revokeObjectURL(link.href);
};

// Attach click event listener to the button with ID "toEXCEL"
document.getElementById('toEXCEL').addEventListener('click', function () {
  const excel = toExcel(customers_table);
  downloadFile(excel, 'xlsx', 'customer_orders');
});

</script>

</head>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<body>
    <header>
        <nav>
            <div class="logo-search">
                <a href="adminmenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                

                <div class="icon" style="margin-left: 900px;">
                    <a href="adminmenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="logout.php"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>

    <section class="container">

    <main class="table-left" id="report_table">
    <section class="table__header">
        <h1>Details</h1>
    </section>

    <section class="table__body">
        <table>
            <tbody>
                <tr>
                    <td><strong>Start Date</strong></td>
                    <td><?php echo $start_date; ?></td>
                </tr>
                <tr>
                    <td><strong>End Date</strong></td>
                    <td><?php echo $end_date; ?></td>
                </tr>

                <tr>
                    <td><strong>Sales Total</strong></td>
                    <td><?php
                        $total_sales = 0;
                        while ($row = $result->fetch_assoc()) {
                            $total_sales += $row['fld_amount'];
                        }
                        echo 'RM' . number_format($total_sales, 2);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    </main>

       

        <main class="table" id="customers_table" >
            <section class="table__header">
                <h1>Sales Reports for <?php echo $selected_year;?></h1>

        
                <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" class=".eicon-dl" >EXCEL <img src="img/excel.png" alt=""></label>
                </div>
            </div>
            </section>

            <section class="table__body">
                <table>
                    <tbody>
                    <?php
                    // Check if a year is selected
                    if (isset($_GET['selected_year'])) {
                         $selected_year = $_GET['selected_year'];
    
                     // Assuming your order date is in 'Y-m-d H:i:s' format
                     $start_date = "$selected_year-01-01 00:00:00";
                     $end_date = "$selected_year-12-31 23:59:59";

                     // Your MySQLi database connection code here
                     $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch orders for the selected year
                    $query = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_date BETWEEN '$start_date' AND '$end_date'";
                    $query = "SELECT o.*, p.fld_category
                                FROM tbl_order_pasarsiswa o
                                JOIN tbl_products_pasarsiswa p ON o.fld_product_id = p.fld_product_id
                                WHERE o.fld_order_date BETWEEN '$start_date' AND '$end_date'";
                    // Execute the query and display the results
                    $result = $conn->query($query);

                    if ($result) {
                        echo "<table border='1'>";
                        echo "<tr><th>Order ID</th><th>Order Date</th><th>Product Name</th><th>Product Category</th><th>Quantity</th><th>Amount (RM)</th></tr>";
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['fld_order_id']}</td>";
                            echo "<td>{$row['fld_order_date']}</td>";
                            echo "<td>{$row['fld_product_name']}</td>";
                            echo "<td>{$row['fld_category']}</td>";                            
                            echo "<td>{$row['fld_quantity']}</td>";
                            echo "<td>" . number_format($row['fld_amount'], 2) . "</td>";
                            echo "</tr>";
                        }
                        
                        echo "</table>";
                    } else {
                        echo "Error in the query: " . $conn->error;
                    }

                    // Close the database connection
                    $conn->close();
                } else {
                    // If no year is selected, display a message
                    echo "<p>Please select a year from the admin menu.</p>";
                }
                ?>
                    </tbody>
                </table>
            </section>
        </main>
  
        <br>
    </section>

   
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
  $(document).ready(function() {

    var table = $('#sales-table').DataTable({
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