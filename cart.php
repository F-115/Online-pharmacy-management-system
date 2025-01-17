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
    <title>Bracu Pharma- Cart Details</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
    .cart_img{
    width:80px;
    height:80px;
    object-fit:contain;
}
    </style>

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
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Medicine</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./customer/user_signup.php">Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactus.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-shopping-cart"></i><sup><?php cart_item();?></sup></a>
        </li>
        
      </ul>
 
    </div>
  </div>
</nav>
<?php
cart();
?> 
<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">Welcome Guest</a>
        </li> -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="./users_area/user_login.php">Login</a>
        </li> -->
        <?php
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
            </li>";
          }else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
          }
if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a class='nav-link' href='./customer/user_login.php'>Login</a></li>";
}else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='./customer/logout.php'>Logout</a></li>";
}
        ?>

    </ul>
</nav>

<!-- third child -->
<div class="bg-light">
    <h3 class="text-center">Bracu Pharma</h3>
    <p class="text-center"> </p>
</div>

<!-- fourth child-table-->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            
            <tbody>
                <!-- php code to display dynamic data -->
                <?php
                 $get_ip_add = getIPAddress();
                 $total_price=0;
                 $cart_query="Select * from `cart` where ip_address='$get_ip_add'";
                 $result=mysqli_query($con,$cart_query);
                 $result_count=mysqli_num_rows($result);
                 if($result_count>0){
                    echo "<thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Medicine Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                </thead>";

                 while($row=mysqli_fetch_array($result)){
                   $medicine_id=$row['medicine_id'];
                   $select_medicine="Select * from `medicine` where medicine_id='$medicine_id'";
                   $result_medicine=mysqli_query($con,$select_medicine);
                   while($row_medicine_price=mysqli_fetch_array($result_medicine)){
                     $medicine_price=array($row_medicine_price['medicine_price']); 
                     $price_table=$row_medicine_price['medicine_price'];
                     $medicine_name=$row_medicine_price['medicine_name'];
                     $medicine_image=$row_medicine_price['medicine_image'];
                     $medicine_values=array_sum($medicine_price); 
                     $total_price+=$medicine_values; 
                  
                ?>
                <tr>
                    <td><?php echo $medicine_name?></td>
                    <td><img src="./img/<?php echo $medicine_image?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" id="" class="form-input w-50"></td>
                    <?php
                    $get_ip_add = getIPAddress();
                    if(isset($_POST['update_cart'])){
                        $quantities=$_POST['qty'];

                        //update query 
                        $update_cart="update `cart`set quantity=$quantities where ip_address='$get_ip_add'";

                        $result_medicine_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                    }
                    ?>
                    <td><?php echo $price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $medicine_id?>"></td>
                    <td>
                        <!--<button class="bg-info px-3 py-1 border-0 mx-3">Update</button>-->
                        <input type="submit" value="Update Cart" class="bg-info px-3 py-1 border-0 mx-3" name="update_cart">
                        <!--<button class="bg-info px-3 py-1 border-0 mx-3">Remove</button>-->
                        <input type="submit" value="Remove Cart" class="bg-info px-3 py-1 border-0 mx-3" name="remove_cart">
                    </td>
                </tr>
                <?php
            }
        }
    }else{
        echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
    }
                 ?>
            </tbody>
        </table>
        <!-- Total price-->
        <div class="d-flex mb-5">
            <?php
             $get_ip_add = getIPAddress();
             $cart_query="Select * from `cart` where ip_address='$get_ip_add'";
             $result=mysqli_query($con,$cart_query);
             $result_count=mysqli_num_rows($result);
             if($result_count>0){
                echo "<h4 class='px-3'>Total Price: <strong class='text-info'>$total_price/-</strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-info px-3 py-1 border-0 mx-3' name='continue_shopping'>
                <button class='bg-secondary px-3 py-1 border-0'><a href='./customer/checkout.php' class='text-light text-decoration-none'>
                Checkout</a></button>";
             }else{
                echo" <input type='submit' value='Continue Shopping' class='bg-info px-3 py-1 border-0 mx-3' name='continue_shopping'>";
             }
             if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php','_self')</script>";
             }
            ?>
            
        </div>
    </div>
</div>
</form>
<!--function to remove item-->
<?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart` where medicine_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";

            }
        }
    }
}
echo $remove_item=remove_cart_item();
?>

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