<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role:</label>
                                <select name="role" class="form-control" id="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="receptionist">Receptionist</option>
                                    <option value="stylist">Stylist</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <hr>
                        <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




<?php
// database connection

include('../admin_panel/db_connection.php');

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate user credentials based on role using prepared statement
    $query = "SELECT * FROM users WHERE user_email = ? AND role = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {
            // Set session variables based on roles
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['role'] = $user['role'];

            // Redirect user based on role
            switch ($role) {
                case 'user':
                    header('Location: index.php');
                    break;
                case 'admin':
                    header('Location: /e_project_saloon_management/admin_panel/admin_index.php');
                    break;
               case 'receptionist':
                        header('location: receptionist_dashboard.php');
                        break;
                case 'stylist':
                    header('Location: stylist_dashboard.php');
                    break;
                default:
                    header('Location: register.php');
                    break;
            }
            exit(); // Ensure that script stops here to prevent further execution
        } else {
            echo "Error: Incorrect password";
        }
    } else {
        echo "Error: User not found or invalid role";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
