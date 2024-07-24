<?php
// Include the database connection file
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $description = $_POST["description"];
    $maintenance_date = $_POST["maintenance_date"];

    // Validate form data (you should add more validation as per your requirements)
    if (empty($description) || empty($maintenance_date)) {
        // Handle empty fields
        echo "All fields are required!";
    } else {
        // SQL to insert data into database
        $sql = "INSERT INTO maintain (description, maintenance_date) VALUES (?, ?)";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        
        // Bind the parameters and execute the statement
        $stmt->bind_param("ss", $description, $maintenance_date);
        if ($stmt->execute()) {
            echo "Maintenance request submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close the statement
        $stmt->close();
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>
