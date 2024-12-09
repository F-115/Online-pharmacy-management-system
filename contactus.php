<html>
<head>

<title>Contact us</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body style = "padding: 50px">
<h3>Feedback Form</h3>

<div class="container">
<form method="POST" action="process.php">
<div class="form-group">
<label for="firstname">First Name</label>
<input type="text" name="firstname" id="firstname" class="form-control" required>
</div>

<div class="form-group">
<label for="lastname">Last Name</label>
<input type="text" name="lastname" id="lastname" class="form-control" required>
</div>


<div class="form-group">
<label for="phone">Phone</label>
<input type="text" name="phone" id="phone" class="form-control" required>
</div>


<div class="form-group">
<label for="email">Email</label>
<input type="email" name="email" id="email" class="form-control" required>
</div>

<div class="form-group">
<label for="message">Feedback</label>
<textarea type="text" name="message" id="message" class="form-control" required> </textarea>
</div>

<div class="form-group">
<button type = "submit" class ="btn btn-info">Submit</button>

</div>

</form>

</div>

</body>


</head>
</html>

