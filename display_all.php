<!-- connection file -->
<?php
include('includes/connect.php');
include('functions/functions.php');
session_start();
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-quiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.
    0">
    <title>Cart</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-info bg-info"> 

    <div class="container-fluid">
        <img src="./images/logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Order</a>
        </li>
          <a class="nav-link" href="display_all.php">Medicine</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./customer/user_signup.php">Signup</a>
        </li>
   
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart<i class="fa-solid fa-shopping-cart"></i><sup><?php cart_item();?></sup></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Total Price: <?php total_cart_price();?>/-</a>
        </li>
        
      </ul>
      
       
    </div>
  </div>
</nav>
<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav mt-4">
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">Welcome Guest</a> -->
        <!-- </li>
        <li class="nav-item">
        <a class="nav-link" href="./customer_area/user_login.php">Login</a>
        </li> -->
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'></a>
          </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
        }
if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a class='nav-link' href='./customer/user_login.php'></a></li>";
}else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='./customer/logout.php'>Logout</a></li>";
}
        ?>

    </ul>
</nav>

<!-- third child -->
<div class="bg-info">

</div>

<!-- fourth child -->
<div class="row px-1">
    <div class="col-md-10"> 
    <!-- medicine -->
    <div class="row">
<!--fetching medicine-->
    <?php
get_all_medicine();


    ?>


<!--row end-->
</div>
<!--col end-->
</div>
    
<div class="col-md-2 bg-muted p-0">
  <ul class="navbar-nav text-center ">
    <!--brands to be displayed-->
    <li class="nav-item bg-muted">
      <a href="#" class="nav-link text-light"><h4></h4></a>
</li>



</ul>
</div>

<!--last child-->
<?php 
include("./includes/footer.php")
?>
</div>
<!--bootstrap js link --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
<html>