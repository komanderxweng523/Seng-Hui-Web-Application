<!DOCTYPE html><!-- HTML5 Declaration -->
<?php 

session_start();

include("includes/db.php");

include("functions/functions.php");


?>
<script src="js/jquery-3.4.1.js"></script>

<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"  content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
        

<head>
<header>
    <div class="main">
        <div class="logo">
            <img src="img/logo.jpg">
        </div>
        <ul>
                <li><a href="index.php" target="_self">Home</a></li> <!--Homepage-->
                <li><a href="admin_area/login.php" target="_self">Administrator</a></li> <!--Administrator Page-->
                <li><a href="about.php" target="_self">About</a></li> <!--About Us Page-->
                <li><a href="all_products.php" target="_self">Shop</a></li> <!--Shop Page--> <!--For List of motorcycles-->
                <li><a href="tracking.php" target="_self">Tracking<i class='bx bx-link'></i></a></li> <!--Tracking Page-->
                <?php if(!isset($_SESSION['user_id'])){ ?>
	  <li><a href="index.php?action=login">Login</a></li>

    <?php }else{ ?>
      <?php 
    $select_user = mysqli_query($con,"select * from users where id='$_SESSION[user_id] '");
    $data_user = mysqli_fetch_array($select_user);
    ?>
   <li><a href="logout.php">Logout</a></li>
   <?php }?>
                <li><a href="cart.php" target="_self"><i class='bx bxs-shopping-bag-alt bx-md' style='color:#8a2119'  ></i></a></li> <!--A shopping bag icon-->           
            </ul>
    </div>
</header>

<style>
  header{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    height: 13vh;
    background-color: #000000;
}
ul{
    float: right;
    list-style-type: none;
    justify-content: space-between;
    margin-top: 25px;
    margin-right: 20px;
}
ul li{
    display: inline-block;
}
ul li a{
    text-decoration: none;
    color: #ffffff;
    padding: 10px 15px;
    border: 1px solid transparent;
    transition: 0.2s ease;
}
ul li a:hover{
    background-color: #1d1c1c;
    color: #ffffff;
}
.logo img{
    float: left;
    width: 100px;
    height: auto;
    margin-top: 30px;
    margin-left: 70px;
}
</style>
  
  

  
  
  
  
  