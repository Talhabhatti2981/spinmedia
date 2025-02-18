<?php
// Enable error reporting for debugging (optional, remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get form data
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$textarea = $_POST['textarea'];

// Create connection to the database
$conn = new mysqli('localhost', 'root', '', 'registration');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO connect_form (firstname, lastname, email, subject, textarea) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssss", $firstname, $lastname, $email, $subject, $textarea);

// Execute the statement
if ($stmt->execute()) {
    echo "Form submitted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>