<?php
// Fetch admin and user data from database
$sql = "SELECT admins.admin_id, admins.admin_name, GROUP_CONCAT(users.user_name SEPARATOR ', ') AS assigned_users
        FROM admins
        LEFT JOIN users ON admins.admin_id = users.admin_id
        GROUP BY admins.admin_id";

$result = $conn->query($sql);

// Display data in the table
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["admin_id"] . "</td>";
        echo "<td>" . $row["admin_name"] . "</td>";
        echo "<td>" . $row["assigned_users"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data available</td></tr>";
}

$conn->close();
?>
