<?php
// Database configuration
$dbHost = 'localhost';
$dbUsername = 'root'; // Default username for XAMPP, WAMP, etc.
$dbPassword = ''; // Default password for XAMPP, WAMP, etc.
$dbName = 'contact_us';

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbEmail, $dbMessage);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Assuming form data is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // SQL query to insert data into the table
    $sql = "INSERT INTO contact_form (name, email, message,) 
            VALUES ('$name', '$email', '$message', NOW())";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
