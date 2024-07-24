<?php
// Include the database connection file
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if an admin already exists
    $sql_check_admin = "SELECT id FROM register WHERE role = 'admin'";
    $result_check_admin = $conn->query($sql_check_admin);

    if ($result_check_admin->num_rows > 0) {
        echo "An admin already exists. Only one admin can be registered.";
    } else {
        // Retrieve form data
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $role = $_POST["role"]; // Add this line to retrieve the role value

        // Set house number based on the role
        $house_number = ($role === 'admin') ? 'NULL' : $_POST["house_number"];

        // Validate form data (you should add more validation as per your requirements)
        if (empty($username) || empty($email) || empty($phone_number) || empty($password) || empty($confirm_password) || empty($role)) {
            // Handle empty fields
            echo "All fields are required!";
        } elseif ($password != $confirm_password) {
            // Handle password mismatch
            echo "Passwords do not match!";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // SQL to insert data into database
            $sql_insert_admin = "INSERT INTO register (username, email, houseno, phoneno, password, role) 
                                VALUES ('$username', '$email', $house_number, '$phone_number', '$hashed_password', '$role')";

            if ($conn->query($sql_insert_admin) === TRUE) {
                echo "Admin registered successfully.";
            } else {
                echo "Error: " . $sql_insert_admin . "<br>" . $conn->error;
            }
        }
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>
