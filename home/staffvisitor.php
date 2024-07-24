<?php
// Include connection file
require_once 'connection.php';

// SQL to fetch visitor data from the visitors table
$sql = "SELECT * FROM visitors";

// Execute SQL query
$result = $conn->query($sql);

// Array to hold visitor data
$visitorData = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch each row and add it to the visitorData array
    while($row = $result->fetch_assoc()) {
        // Create an associative array with the required fields
        $visitor = array(
            "id" => $row["id"],
            "visitor_name" => $row["visitor_name"],
            "visit_date" => $row["visit_date"],
            "visitor_type" => $row["visitor_type"],
            "status" => $row["status"],
            "created_at" => $row["created_at"]
        );
        // Add the visitor data to the array
        $visitorData[] = $visitor;
    }
}

// Convert visitorData array to JSON format and output
echo json_encode($visitorData);

// Close connection
$conn->close();
?>
