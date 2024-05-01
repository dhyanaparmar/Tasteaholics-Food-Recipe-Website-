<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "suggestion_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $foodname = $_POST['foodname'];
    $ingredient = $_POST['ingredient'];
    $recipe = $_POST['recipe'];


    if (!empty($recipe)) {

        $stmt = $conn->prepare("SELECT ingredient FROM suggestions WHERE ingredient = ?");
        $stmt->bind_param("s", $ingredient);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO suggestions (foodname, ingredient, recipe) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $foodname, $ingredient, $recipe);

            if ($stmt->execute() === TRUE) {
               
                // Redirect to index.html
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Someone Already Submitted This ingredient";
        }
    } else {

        $stmt = $conn->prepare("INSERT INTO registration (name, mail, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $mail, $password);
        
        echo "Please Fill The Whole Form";
    }
}

$conn->close();
?>