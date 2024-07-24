<?php
// Include connection file
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data (sanitize if needed)
    $visitorName = $_POST["visitorName"];
    $visitDate = $_POST["visitDate"];
    $visitorType = $_POST["visitorType"];
    $status = "pending"; // Default status

    // Prepare SQL statement to insert data into the visitors table
    $sql = "INSERT INTO visitors (visitor_name, visit_date, visitor_type, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssss", $visitorName, $visitDate, $visitorType, $status);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "Visitor data inserted successfully!";
        } else {
            // Error occurred while inserting data
            echo "Error: " . $stmt->error;
        }

        // Close prepared statement
        $stmt->close();
    } else {
        // Error preparing SQL statement
        echo "Error: " . $conn->error;
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted!";
}

// Close connection
$conn->close();
?>
 