<?php
// Include the database connection file
include 'connection.php';

// Check if the connection is successful
if ($conn === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

// Retrieve the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if data is received
// Check if data is received
if (!empty($data['description']) && !empty($data['location']) && !empty($data['dateLost']) && !empty($data['contactInfo'])) {
    // Extract data and sanitize
    $description = mysqli_real_escape_string($conn, $data['description']);
    $location = mysqli_real_escape_string($conn, $data['location']);
    $dateLost = mysqli_real_escape_string($conn, $data['dateLost']); // Corrected field name
    $contactInfo = mysqli_real_escape_string($conn, $data['contactInfo']);

    // Prepare SQL statement with a parameterized query
    $sql = "INSERT INTO lostandfound (description, location, dateTimeLost, contactInfo) VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement and bind parameters
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $description, $location, $dateLost, $contactInfo); // Corrected field name

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // If insertion is successful, send a success response
        echo "Data inserted successfully!";
    } else {
        // If there's an error, send an error response
        echo "Error: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If any required data is missing, send a failure response
    echo "Error: Required data is missing!";
}

// Close connection
mysqli_close($conn);
?>
