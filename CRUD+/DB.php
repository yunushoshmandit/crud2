<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection 

$conn = new mysqli($servername, $username, $password);

// Check if the connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database 
$sql = "CREATE DATABASE TechBillionaires";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>

