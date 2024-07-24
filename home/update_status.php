<?php
// Include database connection
include "connection.php";

// Check if POST data exists
if(isset($_POST['id']) && isset($_POST['status'])) {
    // Sanitize input
    $eventId = $_POST['id'];
    $newStatus = $_POST['status'];

    // Update status in the database
    $sql = "UPDATE events SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        echo "Error: " . $conn->error;
    } else {
        $stmt->bind_param("si", $newStatus, $eventId);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check if the update was successful
        if($result) {
            // Check if any rows were affected
            if($stmt->affected_rows > 0) {
                // Close statement
                $stmt->close();
                // Close connection
                $conn->close();
                // Return success response
                echo "Status updated successfully";
            } else {
                // Close statement
                $stmt->close();
                // Close connection
                $conn->close();
                // Return error response if no rows were affected
                echo "Error: No rows were affected";
            }
        } else {
            // Close statement
            $stmt->close();
            // Close connection
            $conn->close();
            // Return error response if execution failed
            echo "Error: Failed to execute query";
        }
    }
} else {
    // Return error response if POST data is missing
    echo "Error: POST data missing";
}
?>
