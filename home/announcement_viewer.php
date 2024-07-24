<?php
// Include connection file
require_once 'connection.php';

// Prepare SQL query to fetch announcements
$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start building the list of announcements
    echo "<div class='announcement-container'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='announcement'>";
        echo "<h2 class='announcement-title'>" . $row['title'] . "</h2>";
        echo "<p class='announcement-message'>" . $row['message'] . "</p>";
        echo "<p class='announcement-date'><strong>Posted At:</strong> " . $row['created_at'] . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No announcements found.</p>";
}

// Close connection
$conn->close();
?>
