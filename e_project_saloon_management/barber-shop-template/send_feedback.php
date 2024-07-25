
<?php
// database connection
include('../admin_panel/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Insert feedback into database
    $query = "INSERT INTO `feedback`(`name`, `email`, `feedback`, `submitted_at`) VALUES ('$name', '$email', '$feedback', NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to thank you page
        header('Location: thank_you.php');
        exit(); 
    } else {
        echo "Error occurred: " . mysqli_error($conn);
    }

    // Close the database connection
    $conn->close();
}
?>
