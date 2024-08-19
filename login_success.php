<?php  
//include_once 'database.php';
include_once 'database.php';
include_once 'session.php';
//$pos = $readrow['FLD_POSITION'];
//login_success.php  

 
 	if(isset($_SESSION["userid"]))  
 	{  
     	echo '<script type="text/javascript">'; 
     	if($pos==="admin") {
			echo 'alert("Welcome '.$id.' to pasarSISWA ! Your Privilege is: Admin");'; 
			echo 'window.location.href = "indexadmin.php";';
		}
		elseif($pos==="seller") {
			echo 'alert("Welcome '.$id.' to pasarSISWA Shop ! Your Privilege is: Seller");'; 
			echo 'window.location.href = "indexseller.php";';
		}
		else {
			echo 'alert("Welcome '.$id.' to pasarSISWA Shop ! Your Privilege is: Customer");'; 
			echo 'window.location.href = "custMenu.php";';
		}

		echo '</script>';
 	}  
 	else  
 	{  
	   	echo '<script type="text/javascript">'; 
		echo 'alert("Please Login First!");'; 
		echo 'window.location.href = "login.php";';
		echo '</script>';
 	}  
 ?>  