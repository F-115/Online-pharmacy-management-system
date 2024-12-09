<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "bracu pharma";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION["username"] = $username;
        header("Location: admin_dashboard.php");
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login Error</title>
</head>
<body>
    <div class="container">
        <p><?php echo $error_message; ?></p>
        <a href="admin_login.php">Go back to login</a>
    </div>
</body>
</html>