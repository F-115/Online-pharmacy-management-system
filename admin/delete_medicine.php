<?php
if(isset($_GET['delete_medicine'])){
    $delete_id=$_GET['delete_medicine'];

    $delete_medicine="Delete from `medicine` where medicine_id=$delete_id";
    $result_medicine=mysqli_query($con,$delete_medicine);
    if($result_medicine){
        echo "<script> alert ('Medicine deleted successfully')</script>";
        echo "<script> window.open('./index.php','_self')</script>";
    }
}
?>