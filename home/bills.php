<?php
// Include database connection
include "connection.php";

// Check if POST data exists
if(isset($_POST['description']) && isset($_POST['location']) && isset($_POST['dateTimeLost']) && isset($_POST['contactInfo'])) {
    // Sanitize input
    $description = $_POST['description'];
    $location = $_POST['location'];
    $dateTimeLost = $_POST['dateTimeLost'];
    $contactInfo = $_POST['contactInfo'];

    // Prepare SQL statement to insert data into the 'lostandfound' table
    $sql = "INSERT INTO lostandfound (description, location, dateTimeLost, contactInfo) VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $description, $location, $dateTimeLost, $contactInfo);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data inserted successfully!";
    } else {
        // Error in executing SQL statement
        echo "Error: Unable to insert data";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Return error response if POST data is missing
    echo "Error: POST data missing";
}
?>
