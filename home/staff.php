<?php
// Include the database connection file
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $house_number = $_POST["house_number"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"]; // Add this line to retrieve the role value

    // Validate form data (you should add more validation as per your requirements)
    if (empty($username) || empty($email) || empty($house_number) || empty($phone_number) || empty($password) || empty($confirm_password) || empty($role)) {
        // Handle empty fields
        echo "All fields are required!";
    } elseif ($password != $confirm_password) {
        // Handle password mismatch
        echo "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL to insert data into database
        $sql = "INSERT INTO register (username, email, houseno, phoneno, password, role) VALUES ('$username', '$email', '$house_number', '$phone_number', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>








