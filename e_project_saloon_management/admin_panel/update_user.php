<?php
// Include database connection
include('db_connection.php');

// Get the form data
$user_id = $_POST['id'];
$role = $_POST['role'];

// Update user role in the database
$query = "UPDATE users SET role = '$role' WHERE id = $user_id";
if (mysqli_query($conn, $query)) {
    echo "User role updated successfully. <a href='admin_access_contro.php'>Go back to Admin Panel</a>";
} else {
    echo "Error updating user role: " . mysqli_error($conn);
}
?>
