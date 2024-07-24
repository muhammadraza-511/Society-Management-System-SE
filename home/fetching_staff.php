<?php
// Include connection file
require_once 'connection.php';

// Prepare SQL query to fetch staff members
$sql = "SELECT * FROM register WHERE role = 'staff'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start building the table
    echo "<h2>List of Staff Members:</h2>";
    echo "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>";
    echo "<th>Username</th>";
    echo "<th>Email</th>";
    echo "<th>Phone No</th>"; // Adjust as per your database schema
    // Add more columns as needed
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phoneno'] . "</td>"; // Adjust as per your database schema
        // Add more cells as needed
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No staff members found.</p>";
}

// Close connection
$conn->close();
?>
