<?php
include('../includes/connect.php');
include('../functions/functions.php');

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    
    
}

//getting total items and total price of all items
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="Select * from `cart` where ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($con,$cart_query_price);
$invoice_number=mt_rand();
$status='pending';

$count_medicine=mysqli_num_rows($result_cart_price);
while($row_price=mysqli_fetch_array($result_cart_price)){
    $medicine_id=$row_price['medicine_id'];
    $select_medicine="Select * from `medicine` where medicine_id='$medicine_id'";
    $run_price=mysqli_query($con,$select_medicine);
    while($row_medicine_price=mysqli_fetch_array($run_price)){
        $medicine_price=array($row_medicine_price['medicine_price']);
        $medicine_values=array_sum($medicine_price);
        $total_price+=$medicine_values;
    }
}


//getting quantity from cart
$get_cart="Select * from `cart`";
$run_cart=mysqli_query($con,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $sub_total=$total_price;

}else{
    $quantity = $quantity;
    $sub_total=$total_price*$quantity;

}
$insert_orders="Insert into `user_orders` (user_id,amount_due,invoice_number,total_medicine,order_date,order_status) values($user_id,$sub_total,$invoice_number,$count_medicine,NOW(),'$status')";
$result_query=mysqli_query($con,$insert_orders);
if($result_query){
    echo"<script>alert('Orders are submitted successfully')</script>";
    echo"<script>window.open('profile.php','_self')</script>";
}

//orders pending
$insert_pending_orders="Insert into `orders_pending` (user_id,invoice_number,medicine_id,quantity,order_status) values($user_id,$invoice_number,$medicine_id,$quantity,'$status')";
$result_pending_orders=mysqli_query($con,$insert_pending_orders);

//delete items from cart

$empty_cart="Delete from `cart` where ip_address='$get_ip_address'";
$result_delete=mysqli_query($con,$empty_cart);
?>