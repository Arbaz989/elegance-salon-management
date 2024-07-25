<?php
session_start();
include('../admin_panel/db_connection.php');
// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];

// Check if the logged-in user has the role 'user'
$user_role_check_sql = "SELECT role FROM users WHERE id = '$user_id'";
$user_role_check_result = $conn->query($user_role_check_sql);
$user_role = $user_role_check_result->fetch_assoc()['role'];

if ($user_role !== 'user') {
    echo "Only users with the 'user' role can book appointments.";
    exit();
}

// Handle the appointment booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $service_id = $_POST['service_id'];
    $appointment_date = $_POST['appointment_date'];
    $time_slot_id = $_POST['time_slot_id'];
    $stylist_id = $_POST['stylist_id'];

    // Check if the user is registered
    $user_check_sql = "SELECT id FROM users WHERE user_name = '$user_name' AND user_email = '$user_email'";
    $user_check_result = $conn->query($user_check_sql);

    if ($user_check_result->num_rows > 0) {
        // User is registered, proceed with booking
        $sql = "INSERT INTO appointments (user_id, user_name, user_email, service_id, appointment_date, time_slot_id, stylist_id, status) 
                VALUES ('$user_id', '$user_name', '$user_email', '$service_id', '$appointment_date', '$time_slot_id', '$stylist_id', 'pending')";
        if ($conn->query($sql) === TRUE) {
            echo "Appointment booked successfully! It is now pending approval.";
            // Add email/SMS notification code here if needed
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // User is not registered, show error message
        echo "Error: User name and email do not match any registered user.";
    }
}

// Fetch available time slots
$slots_result = $conn->query("SELECT * FROM time_slots");

// Fetch available services
$services_result = $conn->query("SELECT * FROM services");

// Fetch available stylists
$stylists_result = $conn->query("SELECT id, user_name FROM users WHERE role = 'stylist'");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Barber X - Barber Shop Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; }
        input, select, button { width: 100%; padding: 10px; margin-top: 5px; }
        button { background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top-bar-left">
                            <div class="text">
                                <h2>8:00 - 9:00</h2>
                                <p>Opening Hour Mon - Fri</p>
                            </div>
                            <div class="text">
                                <h2>+123 456 7890</h2>
                                <p>Call Us For Appointment</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Barber <span>X</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="service.php" class="nav-item nav-link">Service</a>
                        <a href="price.php" class="nav-item nav-link">Price</a>
                        <a href="team.php" class="nav-item nav-link">Barber</a>
                        <a href="portfolio.php" class="nav-item nav-link">Gallery</a>
                        <a href="book_appointment.php" class="nav-item nav-link">Book an appointment</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Actions</a>
                            <div class="dropdown-menu">
                                <a href="user_appointment_history.php" class="dropdown-item">Appointment history</a>
                                <a href="login.php" class="dropdown-item">Login</a>
                                <a href="logout.php" class="dropdown-item">Logot</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Book an Appointment</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; }
        input, select, button { width: 100%; padding: 10px; margin-top: 5px; }
        button { background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>

<div class="">
    <div class="container-fluid">
        <div class="container">
            <h2>Book Appointment</h2>
            <form method="POST">
                <label for="user_name">Name:</label>
                <input type="text" id="user_name" name="user_name" required>
                
                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required>
                
                <label for="service_id">Service:</label>
                <select id="service_id" name="service_id" required>
                    <?php while ($service = $services_result->fetch_assoc()) { ?>
                        <option value="<?= $service['id'] ?>"><?= $service['service_name'] ?> - $<?= $service['price'] ?></option>
                    <?php } ?>
                </select>
                
                <label for="appointment_date">Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
                
                <label for="time_slot_id">Time Slot:</label>
                <select id="time_slot_id" name="time_slot_id" required>
                    <?php while ($slot = $slots_result->fetch_assoc()) { ?>
                        <option value="<?= $slot['id'] ?>"><?= $slot['slot_time'] ?></option>
                    <?php } ?>
                </select>
                
                <label for="stylist_id">Select Stylist:</label>
                <select id="stylist_id" name="stylist_id" required>
                    <?php while ($stylist = $stylists_result->fetch_assoc()) { ?>
                        <option value="<?= $stylist['id'] ?>"><?= $stylist['user_name'] ?></option>
                    <?php } ?>
                </select>
                
                <button type="submit">Book Appointment</button>
            </form>
        </div>
    </div>
</div>

        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="footer-contact">
                                    <h2>Salon Address</h2>
                                    <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                                    <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                                    <p><i class="fa fa-envelope"></i>info@example.com</p>
                                    <div class="footer-social">
                                        <a href=""><i class="fab fa-twitter"></i></a>
                                        <a href=""><i class="fab fa-facebook-f"></i></a>
                                        <a href=""><i class="fab fa-youtube"></i></a>
                                        <a href=""><i class="fab fa-instagram"></i></a>
                                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="footer-link">
                                    <h2>Quick Links</h2>
                                    <a href="">Terms of use</a>
                                    <a href="">Privacy policy</a>
                                    <a href="">Cookies</a>
                                    <a href="">Help</a>
                                    <a href="">FQAs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="footer-newsletter">
                            <h2>Newsletter</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Quisque eu lectus a leo dictum nec non quam. Tortor eu placerat rhoncus, lorem quam iaculis felis, sed lacus neque id eros.
                            </p>
                            <div class="form">
                                <input class="form-control" placeholder="Email goes here">
                                <button class="btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">BARBER X</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p>Designed By  Aptech</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
