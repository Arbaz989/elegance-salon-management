<?php
// Include database connection
include('db_connection.php');

// Get the user ID from the URL
$user_id = $_GET['id'];

// Fetch user details from the database
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Role</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Edit User Role</h2>
                <form action="update_user.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="receptionist" <?php if($user['role'] == 'receptionist') echo 'selected'; ?>>Receptionist</option>
                            <option value="stylist" <?php if($user['role'] == 'stylist') echo 'selected'; ?>>Stylist</option>
                            <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
