<?php
include 'config.php';

$errorMessage = "";

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $state = $_POST["state"];

    // Function to generate a random password
    function generateRandomPassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    // Generate a random password
    $password = generateRandomPassword();

    // Check if email already exists
    $emailCheckQuery = "SELECT * FROM admin_login WHERE email = '$email'";
    $emailCheckResult = mysqli_query($connection, $emailCheckQuery);
    if (mysqli_num_rows($emailCheckResult) > 0) {
        $errorMessage = "Email already exists. Please use a different email.";
    } else {
        // Check if mobile number already exists
        $mobileCheckQuery = "SELECT * FROM admin_login WHERE mobile = '$mobile'";
        $mobileCheckResult = mysqli_query($connection, $mobileCheckQuery);
        if (mysqli_num_rows($mobileCheckResult) > 0) {
            $errorMessage = "Mobile number already exists. Please use a different mobile number.";
        } else {
            $query = "INSERT INTO admin_login (name, email, mobile, state, password) 
                      VALUES ('$name', '$email', '$mobile', '$state', '$password')";
            $insertResult = mysqli_query($connection, $query);

            if ($insertResult) {
                // Your email sending code for sending the auto-generated password to the user
                $to = $email;
                $subject = 'Your Auto-Generated Password';
                $message = 'Hello ' . $name . ',<br><br>';
                $message .= 'Your auto-generated password is: ' . $password . '<br><br>';
                $message .= 'Please keep this password secure. You can change your password after logging in.<br><br>';
                $message .= 'Thank you,<br>';
                $message .= 'Viśva-Veda-Vijñāna-Sammelanam';
                $headers = "From: Viśva-Veda-Vijñāna-Sammelanam <vvvsvibha@gmail.com>\r\n";
                $headers .= "Reply-To: \r\n";
                $headers .= "Content-type: vvvsvibha@gmail.com text/html\r\n";
                mail($to, $subject, $message, $headers);

                header("Location: sign_in.php");
                exit;
            } else {
                $errorMessage = "Error occurred. Please try again later.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Viśva-Veda-Vijñāna-Sammelanam | 4th World Congress of Vedic Sciences | Sign-Up Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon"> 
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link id="fontsLink"
          href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
          rel="stylesheet">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #001f3f;
        }

        .blue-heading {
            font-size: 24px;
            color: #007bff;
            font-weight: bold;
        }

        /* Additional CSS for the card */
        .custom-card {
            width: 100%; /* Set a fixed width for the card */
            max-width: 400px; /* Set a maximum width for the card */
            margin: 0 auto; /* Center the card horizontally */
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px; /* Adjust the margin as needed */
        }

        .logo-container img {
            max-width: 50%;
            height: auto;
        }

        .form-control-sm {
            min-height: calc(1.5em + .5rem + calc(var(--tb-border-width)* 2));
            padding: .25rem .5rem;
            font-size: calc(var(--tb-font-base) * .875);
            border-radius: .2rem;
            width: 100%; /* Make the input fields utilize the whole space horizontally */
        }
    </style>
</head>


<body>
<!-- Sign-up form HTML -->
<section class="vh-100">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6">
                <div class="card mb-0 border-0 shadow-none mb-0 custom-card">
                    <div class="card-body p-sm-4 m-lg-">
                        <div class="logo-container square-border">
                            <img src="assets/images/Logo.png" alt="Logo" class="img-fluid mb-3">
                            <!-- Your logo and branding here -->
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Form fields for name, email, mobile, and state -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name"
                                                   name="name" placeholder="Your Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Mail ID <span
                                                        class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm" id="email"
                                                   name="email" placeholder="Your Mail ID" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="mobile"
                                                   name="mobile" placeholder="Your Mobile Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="state"
                                                   name="state" placeholder="Your State" required>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-sm w-100" type="submit">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($errorMessage)) { ?>
                                    <p style="color: red;"><?php echo $errorMessage; ?></p>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>
