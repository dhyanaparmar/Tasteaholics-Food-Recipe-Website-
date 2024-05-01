<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_us";

// Create connection
$conn = new mysqli($servername, $name, $email, $message);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $foodname = $_POST['name'];
    $ingredient = $_POST['email'];
    $recipe = $_POST['message'];


    if (!empty($recipe)) {

        $stmt = $conn->prepare("SELECT ingredient FROM suggestions WHERE ingredient = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO suggestions (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute() === TRUE) {
               
                // Redirect to index.html
                header("Location: contact_html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Someone Already Submitted This ingredient";
        }
    } else {

        $stmt = $conn->prepare("INSERT INTO contact_form (name, mail, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
        
        echo "Please Fill The Whole Form";
    }
}

$conn->close();
?>