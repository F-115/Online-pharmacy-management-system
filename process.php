<?php
include("config.php");

// Extract POST data
extract($_POST);

// Prepare the SQL query
$query = "INSERT INTO `contact-data` (`firstname`, `lastname`, `phone`, `email`, `messages`) VALUES ('$firstname', '$lastname', '$phone', '$email', '$message')";

// Perform the query
$result = $mysqli->query($query);

// Check if the query was successful
if (!$result) {
    echo "Something went wrong: " . $mysqli->error;
} else {
    echo "Thank you for submitting your feedback";
}

// Close the database connection
$mysqli->close();


?>
