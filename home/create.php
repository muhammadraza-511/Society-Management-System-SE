<?php
// Include the database connection file
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["name"];
    $message = $_POST["message"];

    // Validate form data (you should add more validation as per your requirements)
    if (empty($title) || empty($message)) {
        // Handle empty fields
        echo "Title and message are required!";
    } else {
        // SQL to insert data into database
        $sql = "INSERT INTO announcements (title, message) VALUES ('$title', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Announcement added successfully!";
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
