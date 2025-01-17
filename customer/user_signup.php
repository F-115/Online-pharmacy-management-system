<?php
include('../includes/connect.php');
include('../functions/functions.php');
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-quiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.
    0">
    <title>Signup form</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New Customer</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username field -->
                    <div class="form-outline mb-4" >
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" 
                        placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                    </div>
                    <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" 
                        placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                    </div>
                    <!-- image field -->
                    <div class="form-outline mb-4">
                        <label for="prescription" class="form-label">Prescription</label>
                        <input type="file" id="prescription" class="form-control" required="required" name="prescription"/>
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" 
                        placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                    </div>
                    <!-- confirm password field -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" 
                        placeholder="Confirm  your password" autocomplete="off" required="required" name="conf_user_password"/>
                    </div>
                     <!-- address field -->
                     <div class="form-outline mb-4" >
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" 
                        placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                    </div>
                    <!-- contact field -->
                    <div class="form-outline mb-4" >
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" 
                        placeholder="Enter your contact" autocomplete="off" required="required" name="user_contact"/>
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Submit" class="bg-info py-2 px-3 border-0" name="user_signup"/>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? 
                        <a href="user_login.php" class="text-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
if(isset($_POST['user_signup'])){
    $user_username= $_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $prescription=$_FILES['prescription']['name'];
    $prescription_tmp=$_FILES['prescription']['tmp_name'];
    $user_ip=getIPAddress();

// select query

$select_query="Select * from `customer` where username='$user_username' or user_email='$user_email'";
$result=mysqli_query($con,$select_query);
$rows_count=mysqli_num_rows($result);
if($rows_count>0){
    echo"<script>alert('Username and Email already exists.')</script>";
}else if($user_password!=$conf_user_password){
    echo"<script>alert('Passwords do not match.')</script>";
}

else{
    // insert_query
move_uploaded_file($prescription_tmp,"./prescriptions/$prescription");
$insert_query="insert into `customer` (username,user_email,user_password,prescription,user_ip,
user_address,user_mobile) values ('$user_username','$user_email','$hash_password',
'$prescription','$user_ip','$user_address','$user_contact')";
$sql_execute=mysqli_query($con,$insert_query);
}


//selecting cart items
$select_cart_items="Select * from `cart` where ip_address='$user_ip'";
$result_cart=mysqli_query($con,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']= $user_username;
    echo"<script>alert('You have items in your cart!')</script>";
    echo"<script>window.open('checkout.php','_self')</script>";
}else{
    echo"<script>window.open('../index.php','_self')</script>";
}
}


?>