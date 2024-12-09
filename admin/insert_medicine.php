<?php
include('../includes/connect.php');
if (isset($_POST['insert_medicine'])){
    $medicine_title=$_POST['medicine_title'];
    $description=$_POST['description'];
    $medicine_price=$_POST['medicine_price'];
    $medicine_status='true';

    //accessing images
    $medicine_image=$_FILES['medicine_image']['name'];


    //accessing image tmp name
    $tmp_image=$_FILES['medicine_image']['tmp_name'];


    //checking empty condition
    if ($medicine_title=='' or $description=='' or $medicine_price=='' or $medicine_image=='' ){
        echo "<script> alert ('Please fill all available fields') </script>";
        exit();
    }else{
        move_uploaded_file($tmp_image,"./medicine_img/$medicine_image");

        //insert query
        $insert_medicine= "insert into `medicine` (medicine_name,medicine_description,medicine_image,medicine_price,insert_date,medicine_status) values ('$medicine_title','$description','$medicine_image','$medicine_price',NOW(),'$medicine_status')";
        $result_query=mysqli_query($con,$insert_medicine);
        if($result_query){
            echo "<script>alert('Successfully inserted the medicine')</script>";

        } 
    }

}
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-quiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.
    0">
    <title>insert medicine-Admin Dashboard</title>
        <!--bootstrap css link--> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" 
referrerpolicy="no-referrer" />

<!--css file--> 
<link rel="stylesheet" href="../style.css">
</head>
<body class="bg-lite">
    <div class="container mt-3">
        <h1 class="text-center">Insert medicine</h1>
        <!--form-->
        <form actions="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form outline mb-4 w-50 m-auto">
                <label for="medicine_title" class="form-label">Medicine Name</label>
                <input type="text" name="medicine_title" id="medicine_name" class="form-control" placeholder="Enter medicine Name" autocomplete="off" required="required">
            </div>
            <!--description-->
            <div class="form outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Medicine Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter medicine Description" autocomplete="off" required="required">
            </div>
            
            <!--image -->
            <div class="form outline mb-4 w-50 m-auto">
                <label for="medicine_image" class="form-label">Medicine image</label>
                <input type="file" name="medicine_image" id="medicine_image" class="form-control" required="required">
            </div>

            <!--price-->
            <div class="form outline mb-4 w-50 m-auto">
                <label for="medicine_price" class="form-label">Medicine Price</label>
                <input type="text" name="medicine_price" id="medicine_price" class="form-control" placeholder="Enter medicine Price" autocomplete="off" required="required">
            </div>
            <!--price-->
            <div class="form outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_medicine" class="btn btn-info mb-3 px-3" value="Insert medicine">
            </div>
        </form>
    </div>
</body>
</html>