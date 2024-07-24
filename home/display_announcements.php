<?php
// Include the database connection file
include 'connection.php';

// Fetch announcements from the database
$sql = "SELECT * FROM announcements";
$result = $conn->query($sql);

// Check if there are any announcements
if ($result->num_rows > 0) {
    // Loop through each row of the result set and display it
    while ($row = $result->fetch_assoc()) {
        echo '<div class="announcement">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['message'] . '</p>';
        echo '</div>';
    }
} else {
    // If no announcements found, display a message
    echo "No announcements found.";
}

// Close the database connection
$conn->close();
?>
