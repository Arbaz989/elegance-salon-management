<?php
// Include database connection
include('db_connection.php');

// Get the user ID from the URL
$user_id = $_GET['id'];

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Delete related payments first
    $delete_payments_query = "DELETE FROM payments WHERE appointment_id IN (SELECT id FROM appointments WHERE user_id = $user_id)";
    if (!mysqli_query($conn, $delete_payments_query)) {
        throw new Exception('Error deleting user\'s payments: ' . mysqli_error($conn));
    }

    // Delete related appointments
    $delete_appointments_query = "DELETE FROM appointments WHERE user_id = $user_id";
    if (!mysqli_query($conn, $delete_appointments_query)) {
        throw new Exception('Error deleting user\'s appointments: ' . mysqli_error($conn));
    }

    // Delete user from the database
    $delete_user_query = "DELETE FROM users WHERE id = $user_id";
    if (!mysqli_query($conn, $delete_user_query)) {
        throw new Exception('Error deleting user: ' . mysqli_error($conn));
    }

    // Commit transaction
    mysqli_commit($conn);
    echo "User deleted successfully. <a href='admin_access_contro.php'>Go back to Admin Panel</a>";
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    echo $e->getMessage();
}

// Close the database connection
mysqli_close($conn);
?>
