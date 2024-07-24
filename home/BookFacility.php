<?php
// Include connection file
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventType = $_POST["eventType"];
    $hall = ($eventType === 'marriage') ? $_POST["marriageHall"] : NULL;
    $lawn = ($eventType === 'party') ? $_POST["partyLawn"] : NULL;
    $bookingDate = $_POST["bookingDate"];
    $bookingTime = $_POST["bookingTime"];
    $contactNumber = $_POST["contactNumber"];
    
    // Default status is pending
    $status = "pending";

    // Prepare SQL statement to insert data into the bookings table
    $sql = "INSERT INTO bookings (event_type, hall, lawn, booking_date, booking_time, contact_number, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssssss", $eventType, $hall, $lawn, $bookingDate, $bookingTime, $contactNumber, $status);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "Booking data inserted successfully!";
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
