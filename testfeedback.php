<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <!-- Basic styles of the plugin -->
  <link rel="stylesheet" href="path/to/jquery.rateyo.css"/>
</head>
<body>

<div class="container">
  <div class="row">
    <form action="testfeedback.php" method="post">
      <div>
        <h3>Rating System</h3>
      </div>

      <div>
        <label>Name</label>
        <input type="text" name="name">
      </div>
  
      <div class="rateyo" id="rating"
        data-rateyo-rating="4"
        data-rateyo-num-stars="5"
        data-rateyo-score="3">
      </div>

      <span class='result'>0</span>
      <input type="hidden" name="rating">

      <button type="submit">Submit</button>
    </form>
  </div>
</div>

<script>
  $(function () {
    $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
      var rating = data.rating;
      $(this).parent().find('.result').text('rating: ' + rating);
      $(this).parent().find('input[name=rating]').val(rating);
    });
  });
</script>

</body>
</html>


<?php

$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name = $_POST['name'];
    $rating = $_POST["rating"];

    $sql = "INSERT INTO ratee (name, rate) VALUES ('$name','$rating')";

    if(mysql_query($conn, $sql)){
      echo "success";
    } 
    else {
      echo "Error";
    }

    mysql_close($conn);

}

?>