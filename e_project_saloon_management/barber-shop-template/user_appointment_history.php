<?php

include('../admin_panel/db_connection.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: /e_project_saloon_management/barber-shop-template/login.php');
    exit();
}

$user_id = $_SESSION['id'];
// $user_name = $_SESSION['user_name'];

// Fetch the user's appointment history
$appointments_query = "
    SELECT 
        a.id, 
        a.service_id,
        s.service_name, 
        a.appointment_date, 
        t.slot_time, 
        a.status,
        u.user_name AS stylist_name 
    FROM appointments a
    JOIN time_slots t ON a.time_slot_id = t.id 
    JOIN services s ON a.service_id = s.id
    JOIN users u ON a.stylist_id = u.id
    WHERE a.user_id = $user_id";
$appointments_result = $conn->query($appointments_query);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Appointment History</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        button { background-color: #4CAF50; color: white; border: none; cursor: pointer; padding: 10px; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Appointment History</h2>
    
    <?php if ($appointments_result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Stylist</th>
                <th>Status</th>
            </tr>
            <?php while ($appointment = $appointments_result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($appointment['service_name']) ?></td>
                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                <td><?= htmlspecialchars($appointment['slot_time']) ?></td>
                <td><?= htmlspecialchars($appointment['stylist_name']) ?></td>
                <td><?= htmlspecialchars($appointment['status']) ?></td>
            </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You don't have any appointment history.</p>
    <?php } ?>
</div>
</body>
</html>
