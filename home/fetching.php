<?php
// Include connection file
require_once 'connection.php';

// Prepare SQL query to fetch residents
$sql = "SELECT * FROM register WHERE role = 'resident'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start building the table with larger size and adjusted position
    echo "<div style='margin-top: 20px;'>";
    echo "<h2>List of Residents:</h2>";
    echo "<table border='1' cellspacing='0' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>House No</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['houseno'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No residents found.</p>";
}

// Close connection
$conn->close();
?>
