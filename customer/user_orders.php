<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
</head>
<body>
    <?php
$username=$_SESSION['username'];
$get_user="Select * from `customer` where username='$username'";
$result=mysqli_query($con,$get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];
//echo $user_id;

?>
<h3 class="text-success">All My Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <tr>
       
        <th>Amount Due</th>
        <th>Total medicine</th>
        <th>Invoice number</th>
        <th>Date</th>
        <th>Complete/Incomplete</th>
        <th>Status</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
 $get_order_details="Select * from `user_orders` where user_id=$user_id";
 $result_orders=mysqli_query($con,$get_order_details);
 while($row_orders=mysqli_fetch_assoc($result_orders)){
    $order_id=$row_orders['order_id'];
    $amount_due=$row_orders['amount_due'];
    $total_medicine=$row_orders['total_medicine'];
    $invoice_number=$row_orders['invoice_number'];
    $order_status=$row_orders['order_status'];
    if($order_status=='pending'){
        $order_status='Incomplete';
    }else{
        $order_status='Complete';
    }
    $order_date=$row_orders['order_date'];
   
    echo "  <tr>
   
    <td>$amount_due</td>
    <td>$total_medicine</td>
    <td>$invoice_number</td>
    <td>$order_date</td>
    <td>$order_status</td>";
    ?>
    <?php
    if($order_status=='Complete'){
        echo"<td>Paid</td>";
    }else{
        echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td> 
        </tr>"; 
    }

 }
?>

</tbody>
</table>
</body>
</html>