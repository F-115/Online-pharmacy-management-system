<?php
if(isset($_GET['edit_medicine'])){
    $edit_id=$_GET['edit_medicine'];
    
    $get_data="Select * from `medicine` where medicine_id=$edit_id";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $medicine_name=$row['medicine_name'];
   
    $medicine_description=$row['medicine_description'];
    $medicine_image=$row['medicine_image'];
    $medicine_price=$row['medicine_price'];

}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit medicine</h1>
    <form action="" method="post" enctype="multipart/form-data"></form>
    <div class="form-outline w-50 m-auto mb-4">
        <label for="medicine_name" class="form-label">Medicine Title</label>
        <input type="text" id="medicine_name" value="<?php echo $medicine_name?>" name="medicine_name" 
        class="form-control" required="required">
    </div>
    <div class="form-outline w-50 m-auto mb-4">
        <label for="medicine_description" class="form-label">Medicine Description</label>
        <input type="text" id="medicine_description" value="<?php echo $medicine_description?>" 
        name="medicine_description" class="form-control" >
    </div>

    <div class="form-outline w-50 m-auto mb-4">
        <label for="medicine_image" class="form-label">Medicine Image</label>
        <div class="d-flex">
        <input type="file" id="medicine_image" name="medicine_image" class="form-control w-50 m-auto" required="required">
        <img src="./medicine_images/<?php echo $medicine_image?>" alt="" class="medicine_image">
        </div>
    </div>

</div>
<div class="form-outline w-50 m-auto mb-4">
        <label for="medicine_price" class="form-label">medicine Price</label>
        <input type="text" id="medicine_price" value="<?php echo $medicine_price?>"name="medicine_price" class="form-control"
        required="required">
    </div>
    <div class="text-center w-50 m-auto">
        <input type="submit" name="edit_medicine" value="Update medicine"
        class="btn btn-info px-3 mb-3">
    </div>
</form>
</div>

<!-- editing medicines-->
<?php
if(isset($_POST['edit_medicine'])){
    $medicine_name=$_POST['medicine_name'];
    $medicine_description=$_POST['medicine_description'];
    $medicine_image=$_FILES['medicine_image'];
    $medicine_price=$_POST['medicine_price'];
    
    $medicine_image=$_FILES['medicine_image']['name'];

    $temp_image=$_FILES['medicine_image']['tmp_name'];

    //checking if field empty or not
    if($medicine_name=='' or $medicine_description=='' or $medicine_image=='' or $medicine_price==''){
        echo "<script> alert('Please fill all the fields and continue the process')</script>";
    }else{
        move_uploaded_file($temp_image,"./medicine_img/$medicine_image");
    

        //query to update medicines
        $update_medicine="update `medicine` set medicine_name='$medicine_name', medicine_description='$medicine_description', 
        medicine_image='$medicine_image',
        medicine_price='$medicine_price', date=NOW() where medicine_id=$edit_id";
        $result_update=mysqli_query($con,$update_medicine);
        if($result_update){
            echo"<script>alert('medicine updated successfully')</script>";
            echo "<script>window.open('./insert_medicine.php','_self')</script>";
        }
    }
}
?>