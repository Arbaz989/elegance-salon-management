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
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register Account</button>
                        </form>
                        <hr>
                        <p class="text-center">Already have an account? <a href="../barber-shop-template/login.php">Login here</a></p>
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


<!--  -->
<?php
// database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = 'admin'; // Default role set to admin

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match";
    } else {
        // Check if the user already exists
        $sql = "SELECT * FROM users WHERE user_name = '$username' OR user_email = '$email'";
        $check_result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($check_result) > 0) {
            echo "Error: Email is already registered";
        } else {
            // Hash the password before saving
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO `users`(`user_name`, `user_email`, `role`, `user_password`, `created_at`) VALUES ('$username', '$email', '$role', '$hashedPassword', NOW())";

            $result = mysqli_query($conn, $query);

            if ($result) {
                header('location: admin_index.php');
                // echo "Data submitted successfully";
            } else {
                echo "Error occurred: " . mysqli_error($conn);
            }
        }
    }   

    // Close the database connection
    $conn->close();
}
?>

























