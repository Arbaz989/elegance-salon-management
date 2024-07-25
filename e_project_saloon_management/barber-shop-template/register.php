<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Register Account</h2>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role:</label>
                                <select name="role" class="form-control" id="role" required>
                                    <option value="user">user</option>
                                    <option value="receptionist">Receptionist</option>
                                    <option value="stylist">Stylist</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register Account</button>
                        </form>
                        <hr>
                        <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match";
    } else {
        // Check if the user already exists
        $sql = "SELECT * FROM users WHERE user_name = '$username' OR user_email = '$email'";
        $check_result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($check_result) > 0) {
            echo "Error: Email or Username is already registered";
        } else {
            // Hash the password before saving
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into database
            $query = "INSERT INTO `users`(`user_name`, `user_email`, `role`, `user_password`, `created_at`) VALUES ('$username', '$email', '$role', '$hashedPassword', NOW())";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Redirect user based on role
                switch ($role) {
                    case 'user':
                        header('location:index.php');
                        break;
                    case 'receptionist':
                        header('location: receptionist_dashboard.php');
                        break;
                    case 'stylist':
                        header('location: stylist_dashboard.php');
                        break;
                    default:
                        // Redirect to a default page or handle accordingly
                        header('location: index.php');
                        break;
                }
                exit(); // Ensure that script stops executing after redirection
            } else {
                echo "Error occurred: " . mysqli_error($conn);
            }
        }
    }

    // Close the database connection
    $conn->close();
}
?>




























