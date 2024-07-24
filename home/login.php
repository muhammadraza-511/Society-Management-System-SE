<?php
// Include the database connection file
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate form data (you should add more validation as per your requirements)
    if (empty($email) || empty($password)) {
        // Handle empty fields
        echo "Email and password are required!";
    } else {
        // SQL to fetch user data based on email
        $sql = "SELECT * FROM register WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Password is correct, check user's role
                if ($row["role"] === 'admin') {
                    // Start session and store user email for future use
                    session_start();
                    $_SESSION["user_email"] = $email;
                    // Redirect to AdminDash.html
                    header("Location: AdminDash.html");
                    exit();
                } elseif ($row["role"] === 'resident') {
                    // Start session and store user email for future use
                    session_start();
                    $_SESSION["user_email"] = $email;
                    // Redirect to resident.html
                    header("Location: resident.html");
                    exit();
                } elseif ($row["role"] === 'staff') {
                    // Start session and store user email for future use
                    session_start();
                    $_SESSION["user_email"] = $email;
                    // Redirect to staffdash.html for staff members
                    header("Location: staffdash.html");
                    exit();
                } else {
                    // For other roles, redirect to a generic page or show a message
                    echo "You are not authorized to access this page.";
                }
            } else {    
                // Password is incorrect
                echo "Incorrect password!";
            }
        } else {
            // User not found
            echo "User not found!";
        }
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>
