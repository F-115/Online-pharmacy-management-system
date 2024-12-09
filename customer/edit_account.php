<?php
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `customer` where username='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}
if(isset($_POST['user_update'])){
    $update_id=$user_id;
    $username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];
    $prescription=$_FILES['prescription']['name'];
    $prescription_tmp=$_FILES['prescription']['tmp_name'];
    move_uploaded_file($prescription_tmp,"./prescription/$prescription");

    //update query
    $update_data="update `customer` set username='$username', user_email='$user_email',prescription='$prescription', user_address='$user_address', user_mobile='$user_mobile' where user_id=$update_id";
    $result_query_update=mysqli_query($con,$update_data);
    if($result_query_update){
        echo"<script>alert('Data Updated Successfully')</script>";
        echo"<script>window.open('profile.php','_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-success mb-4">Edit Account</h3> 
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="prescription">
            <img src="./prescription/<?php echo $prescription?>" alt="" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address"value=" <?php echo $user_address ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
        </div>

        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>

</body>
</html>