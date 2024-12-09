<h3 class="text-center text-danger">Customer Information</h3>
<table class="table table-bordered mt-8">
    <thead class="bg-info">
        <?php
        $get_customer="Select * from `customer`";
        $result=mysqli_query($con,$get_customer);
        $row_count=mysqli_num_rows($result);
        

    if($row_count==0){
        echo "<h2 class='bg-dark text-center mt-5'>No customer yet</h2>";
    }else{
        echo " <tr>
        <th>Sl no.</th>
        <th>username</th>
        <th>user_email</th>
        <th>prescription</th>
        <th>user_address</th>
        <th>user_mobile</th>
   
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
            $user_id=$row_data['user_id'];
            $username=$row_data['username'];
            $user_email=$row_data['user_email'];
            $prescription=$row_data['prescription'];
            $user_address=$row_data['user_address'];
            $user_mobile=$row_data['user_mobile'];
            $number++;
            echo "<tr>
            <td>$number</td>
            <td>$username</td>
            <td>$user_email</td>
            <td><img src='../customer/prescription/$prescription' alt='$username' class='medicine_img'/></td>
            <td>$user_address</td>
            <td>$user_mobile</td>
            
        </tr>";
    }
}      
?>
    </tbody>
</table>