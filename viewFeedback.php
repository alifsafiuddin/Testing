<?php
include_once 'database.php';
include_once 'session.php';
$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
$sellerType = isset($_SESSION['seller_type']) ? $_SESSION['seller_type'] : '';

// Function to get feedback with product and seller details from the database
function getFeedbackDetails($conn, $productId) {
    $query = "SELECT f.*, p.fld_product_name, p.fld_product_rating, p.fld_product_image, s.fld_seller_name, u.fld_user_name
              FROM tbl_feedback_pasarsiswa f
              JOIN tbl_products_pasarsiswa p ON f.fld_product_id = p.fld_product_id
              JOIN tbl_user_pasarsiswa u ON f.fld_user_id = u.fld_user_id
              JOIN tbl_seller_pasarsiswa s ON f.fld_seller_id = s.fld_seller_id
              WHERE f.fld_product_id = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $productId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $feedbackDetails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $feedbackDetails[] = $row;
    }

    return $feedbackDetails;
}

$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;

$feedbackDetails = getFeedbackDetails($conn, $productId);

// Now $feedbackDetails contains an array of feedback with product and seller details
// You can loop through $feedbackDetails to access individual fields



?>


<style>
  
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

    section {
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: stretch; /* Stretch the content vertically */
        }

        section .side-nav {
            width: 250px;
            height: 100vh;
            background-color: #B5B7B8;
            overflow: hidden;
            padding: 20px 10px 20px 10px;
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

  header nav .logo .logoo{ 
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
  }

  header nav .logo .logoo span{ 
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

  header nav .logo .icon3 a{ 
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

/* start review container */
@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;400;500;800&display=swap'); 
@import url('https://fonts.googleapis.com/css23family=Lato:wght@400;700;900&display=swap');

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body {
    background-color: ##e9eaf0;;
}
.rating-review{
    height: 100%;
    width: 55%;
    margin: 50px auto;
    background-color: #fff;
}
.rating-review table {
    width: 100%;
    margin: 0;
    font-family: "roboto", sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    color: #DCDCDC; /kelabu cair/
    margin-bottom: .625rem;
}
.rating-review table,
.rating-review td {
    font-size: .8125rem;
    text-align: center;

}
.rating-review td {
    padding: 1rem;
    width: 33.3%;

}
.tri {
    border-bottom: 1px solid #ffff;
    padding: 12px;

}
.rnb h3 {
    color: #FFE045 ; /kuning cair/
    font-size: 2.4rem;
    font-family: font-family: "roboto", sans-serif ;

}
.tri .pdt-rate {
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

}
.rating-stars {
    position: relative;
    vertical-align: baseline;
    color: #DCDCDC; /* Grey color for stars */
    line-height: 10px;
    float: left;
}

.rating-stars .filled-star,
.rating-stars .grey-star {
    font-size: 19px;
    line-height: 18px;
    display: inline-block;
}

.rating-stars .filled-star {
    color: #FFE045; /* Yellow color for filled stars */
}

.rating-stars .grey-star {
    color: #DCDCDC; /* Grey color for stars */
}





.rnrn {
    width: 100%;
    font-family: "lato";
    font-weight: 700;
    font-size: 1rem;
}
.rpb {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.rnpb {
    display: flex;
    width: 100%;
}
.rnpb label:first-child {
    margin-right: 5px ;
    margin-top: -2px;
}
.rnpb label:last-child {
    margin-left: 3px;
    margin-top: -2px;
}
.rnpb label i {
    color:#FFE045 ; 
}
.ropb {
    height: 10px;
    width: 75%;
    background-color: #fff;
    position: relative;
    margin-bottom: 10px;
}
.ripb {
    height: 100%;
    background-color: #FFE045 ; 
    border: 1px solid #DCDCDC;
}
.rrb p {
    font-size: 1rem;
    font-weight: 500;
    font-family: "raleway";
    margin-bottom: 10px;
}
.rrb button {
    width: 220px;
    height: 40px;
    background-color: #45DAFF; 
    color: #fff;
    border: 0;
    outline: none;
    font-size: 1.2rem;
    font-family: "roboto", sans-serif;
    box-shadow: 0px 2px 2px #45DAFF; 
    cursor: pointer;
}
.rrb button:hover {
    opacity: .9;
}
.review-bg {
    position: fixed;
    background-color: rgba(0, 0, 0, .8);
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 100;
}
.review-modal {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 101;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.rmp {
    width: 400px;
    height: auto;
    background-color: #fff;
    border-radius: 10px;
    animation: scaleUp .7s ease-in-out;
    z-index: 201;
}
@keyframes scaleUp {
    0% {
        transform: scale(0.2);

    }
    25% {
        transform: scale(0.8);

    }
    50% {
        transform: scale(1.2);

    }
    75% {
        transform: scale(0.8);

    }
    100% {
        transform: scale(1);

    }
}
.rpc {
    text-align: right;
    padding: 6px 15px;
    font-size: 1.5rem;
    color: #FF4545; /merah/
}
.rpc span {
    cursor: pointer;
}
.rps {
    padding: 20px;

}
.rps i {
    font-size: 1.6rem;
    cursor: pointer;
}
.rptf textarea,
.rptf inpuy {
    width: 80%;
    outline: none;
    border: 1px solid #fff;
    border-radius: 5px;
    padding: 7px;
    resize: none;
    min-height: 80px;
    margin-bottom: 10px;
    font-family: "roboto", sans-serif;
    font-size: .9rem;
    font-weight: 100;
    color: #DCDCDC; 
}
.rptf input {
    min-height: 10px !important;
}
.rate-error {
    font-size: 12px;
    color: #000000;
    font-family: "robot0", sans-serif;

}
.rpsb button {
    color: #fff;
    background-color: #45DAFF; 
    border: 0;
    outline: none;
    width: 80%;
    height: 40px;
    margin-bottom: 20px;
    border-radius: 3px;
    font-family: "robot0", sans-serif;
    cursor: pointer;
}
.bri {
    overflow: hidden;
    height: 100%;
    margin: 30px 30px 30px 30px;
    border-bottom: 2px solid #ccc;

}
.uscms-secs {
    padding: 10px;
    display: flex;
    width: 100%;
    height: 100%;
    

}
.us-img {
    width: 13%;
    display: flex;
    justify-content: left;
    align-items: center;
}
.us-img p {
    background-color: #45DAFF; 
    width: 45px;
    height: 45px;
    border-radius: 50%;
    text-align: center;
    line-height: 45px;
    color: #fff;
    font-size: 1.1rem;
    font-family: "roboto", sans-serif;
    font-weight: 100;
}
.us-img-p img {
    width: 200px; /* Set maximum width to ensure responsiveness */
    height: auto; /* Maintain aspect ratio, prevents stretching */
    float: left;
    border-radius: 5px; /* Optional: Add border-radius for rounded corners */
    margin-bottom: 20px;
}
.uscms {
    display: flex;
    flex-direction: column;
    width: 87%;
    margin-bottom: 20px;
}
.bri .filled-stars::before,
.bri .grey-stars::before {
    font-size: 24px;
}
.us-cmt p {
    font-size:  .9rem;
    padding: 20px 20px 20px 0;
    color : #333;
    font-weight: 500;
    font-family: "raleway", sans-serif;
}
.us.nm p {
    font-size: .8rem;
    font-weight: 500;
    color:#DCDCDC; 
    font-family: "roboto", sans-serif;

}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA: View Feedback</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">

        function refreshPage() {
            location.reload(true); // Reloads the page
        }
    </script>

    <script type="jquery/jquery.js"></script>

</head>
<body>
<header>
    <nav>
        <div class="logo">
        <a href="<?php echo ($userType === 'buyer') ? 'customermenu.php' : (($sellerType === 'seller') ? 'sellermenu.php' : ''); ?>" class="logoo">pasar<span>siswa</span></a>


            <a href="#" class="addproduct">View Feedback</a>
            <div class="icon3">
                <a href="<?php echo ($userType === 'buyer') ? 'customermenu.php' : (($sellerType === 'seller') ? 'sellermenu.php' : ''); ?>"><i class="fas" onclick="refreshPage()" >&#xf015;</i><span>Home</span></a>
                <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
            </div>
            <div class="profile">
                <a href="logout.php"><i class="fa">&#xf2be;</i></a>
            </div>
        </div>
    </nav>
</header>

<section class="container" style=" display: flex;">

    <div class = "rating-review">
      
        
        <?php if (empty($feedbackDetails)): ?>
            <p>There is no feedback yet for this product.</p>
        <?php else: ?>

        <?php foreach ($feedbackDetails as $feedback): ?>
        <div class="bri">
        <div class="uscm">
            <div class="uscm-secs">

                <div class="us-img">
                    <?php 
                        $userNameInitials = '';
                        if (isset($feedback['fld_user_name'])) {
                            $nameWords = explode(' ', $feedback['fld_user_name']);
                            foreach ($nameWords as $word) {
                                $userNameInitials .= strtoupper(substr($word, 0, 1));
                            }
                        } else {
                            $userNameInitials = 'X';
                        }
                    ?>
                    <p><?php echo $userNameInitials; ?></p>
                </div>

                    <div class="us-cmt">
                        <p><?php echo isset($feedback['fld_user_name']) ? $feedback['fld_user_name'] : 'Customer Name'; ?></p>
                    </div>



                <div class="uscms">

                    <div class="us-nm">
                        <?php
                        $rating = isset($feedback['fld_feedback_rating']) ? $feedback['fld_feedback_rating'] : 'Unknown';

                        if ($rating > 4) {
                            $label = '🔥 HOT';
                            $color = 'red';
                        } elseif ($rating > 3) {
                            $label = '👍 GOOD';
                            $color = '#FFAC1C';
                        } elseif ($rating > 2) {
                            $label = '&#128513; NOT BAD';
                            $color = 'blue';
                        } else {
                            $label = '😕 NOT REALLY';
                            $color = 'grey';
                        }
                        ?>
                        <p><i>Rating: <?php echo $rating; ?> / 5 (<span class="cmdt" style="color: <?php echo $color; ?>; font-weight: bold;"><?php echo $label; ?></span>)</i></p>
                    </div>

                    <div class="us-cmt">
                        <p><?php echo isset($feedback['fld_feedback']) ? $feedback['fld_feedback'] : 'No comment available'; ?></p>
                    </div>

                    <div class="us-img-p">
                <?php if (isset($feedback['fld_feedback_img']) && !empty($feedback['fld_feedback_img'])): ?>
                    <?php
                        $imagePath = 'img/' . $feedback['fld_feedback_img'];
                    ?>
                    <img src="<?php echo $imagePath; ?>" alt="Feedback Image">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
            </div>

                    <div class="us-nm">
                        <p><i>Date : <span class="cmdt"><?php echo isset($feedback['fld_feedback_date']) ? $feedback['fld_feedback_date'] : 'Unknown'; ?></span></i></p>
                    </div>

                </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
    </div>
</section>
</body>
</html>