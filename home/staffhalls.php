<?php
// Include database connection
include "connection.php";

// SQL to fetch event booking data from the events table
$sql = "SELECT * FROM bookings";

// Execute SQL query
$result = $conn->query($sql);

// Array to hold event booking data
$eventData = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch each row and add it to the eventData array
    while($row = $result->fetch_assoc()) {
        // Create an associative array with the required fields
        $event = array(
            "id" => $row["id"], 
            "event_type" => $row["event_type"],
            "hall" => $row["hall"],
            "lawn" => $row["lawn"],
            "booking_date" => $row["booking_date"],
            "booking_time" => $row["booking_time"], 
            "contact_number" => $row["contact_number"],
            "status" => $row["status"],
            "created_at" => $row["created_at"]
        );
        // Add the event booking data to the array
        $eventData[] = $event;
    }
}

// Convert eventData array to JSON format and output
echo json_encode($eventData);

// Close connection
$conn->close();
?>
