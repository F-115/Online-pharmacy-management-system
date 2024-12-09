<h3 class="text-center text-success">All medicine</h3>
<table class='table table-bordered mt-5'>
    <thead class="bg-info">
    <tr>
        <th>Service ID</th>
        <th>Service Title</th>
        <th>Service Image</th>
        <th>Service Price</th>
        <th>Total Quantity</th>
        <th>Offering</th>
        <th>Delete</th>
        
    </tr>
    </thead>
<tbody class="bg-secondary text-light">
    <?php
$get_medicine="Select * from `medicine`";
$result=mysqli_query($con,$get_medicine);
$number=0;
while($row=mysqli_fetch_assoc($result)){
    $medicine_id=$row['medicine_id'];
    $medicine_name=$row['medicine_name'];
    $medicine_image=$row['medicine_image'];
    $medicine_price=$row['medicine_price'];
    $status=$row['medicine_status'];
    $number++;
    ?>
    <tr class='text-center'>
    <td><?php echo $number ?></td>
    <td><?php echo $medicine_name ?></td>
    <td><img src='../img/<?php echo $medicine_image; ?>' class='medicine_img'/></td>
    <td><?php echo $medicine_price;?>/-</td>
    <td><?php
    $get_count="Select * from `orders_pending` where medicine_id=$medicine_id";
    $result_count=mysqli_query($con,$get_count);
    $rows_count=mysqli_num_rows($result_count);
    echo $rows_count;
    ?></td>
    <td><?php echo $status;?></td>
  
    <td><a href='index.php?delete_medicine=<?php echo $medicine_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></td>
    </tr>
<?php
}
?>

</tbody>
</table>
