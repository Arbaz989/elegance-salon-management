<?php
session_start();
include('../admin_panel/db_connection.php');
// Check if the user is logged in and is a receptionist
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'receptionist') {
    header('Location: /e_project_saloon_management/barber-shop-template/login.php');
    exit();
}

// Approve or reject an appointment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_id'], $_POST['status'])) {
    $appointment_id = intval($_POST['appointment_id']);
    $status = $_POST['status'];
    $update_sql = "UPDATE appointments SET status = '$status' WHERE id = $appointment_id";
    if ($conn->query($update_sql) === TRUE) {
        // Reload the page to reflect changes
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        echo "Error updating appointment: " . $conn->error;
    }
}

// Fetch current appointments (pending and upcoming)
$current_appointments_sql = "
    SELECT a.*, t.slot_time, s.service_name
    FROM appointments a
    JOIN time_slots t ON a.time_slot_id = t.id
    JOIN services s ON a.service_id = s.id
    WHERE a.status = 'pending' OR a.status = 'approved'
    ORDER BY a.appointment_date DESC
";
$current_appointments_result = $conn->query($current_appointments_sql);

// Fetch appointment history (approved and rejected)
$appointment_history_sql = "
    SELECT a.*, t.slot_time, s.service_name
    FROM appointments a
    JOIN time_slots t ON a.time_slot_id = t.id
    JOIN services s ON a.service_id = s.id
    WHERE a.status != 'pending'
    ORDER BY a.appointment_date DESC
";
$appointment_history_result = $conn->query($appointment_history_sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receptionist Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; color: #333; }
        .container { max-width: 1000px; margin: auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1, h2 { text-align: center; color: #444; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 15px; border: 1px solid #ddd; text-align: left; }
        table th { background-color: #f4f4f4; }
        form { display: flex; align-items: center; }
        select { margin-right: 10px; padding: 5px; }
        input[type="submit"] { padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
        .action-buttons { display: flex; align-items: center; justify-content: space-between; }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome, Receptionist!</h1>
    <h2>Appointments Management</h2>
    
    <h3>Current and Upcoming Appointments</h3>
    <?php if ($current_appointments_result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Service</th>
                    <th>Time Slot</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $current_appointments_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['user_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['service_name']) ?></td>
                        <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['slot_time']))) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($appointment['status'])) ?></td>
                        <td>
                            <?php if ($appointment['status'] == 'pending'): ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment['id']) ?>">
                                    <div class="action-buttons">
                                        <select name="status">
                                            <option value="approved">Approve</option>
                                            <option value="rejected">Reject</option>
                                        </select>
                                        <input type="submit" value="Update">
                                    </div>
                                </form>
                            <?php else: ?>
                                <?= ucfirst(htmlspecialchars($appointment['status'])) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No current appointments found.</p>
    <?php endif; ?>

    <h3>Appointment History</h3>
    <?php if ($appointment_history_result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Service</th>
                    <th>Time Slot</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $appointment_history_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['user_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['service_name']) ?></td>
                        <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['slot_time']))) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($appointment['status'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No appointment history found.</p>
    <?php endif; ?>
</div>
</body>
</html>