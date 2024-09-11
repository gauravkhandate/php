<?php include 'config.php'; ?>
<?php

$errorMessage = "";

// Check if the user is already logged in
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to the protected page if already logged in
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredEmail = $_POST["email"];
    $enteredPassword = $_POST["password"];

    // Add condition to check if the user is active
    $query = "SELECT * FROM admin_login WHERE email = '$enteredEmail'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userRow = mysqli_fetch_assoc($result);
        if ($userRow['password'] === $enteredPassword) {
            // Start a session and store the user ID
            session_start();
            $_SESSION['user_id'] = $userRow['email'];
            $_SESSION['password'] = $userRow['password'];
            $_SESSION['name'] = $userRow['name'];
            $_SESSION['id'] = $userRow['id'];
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = "Invalid password.";
        }
    } else {
        $errorMessage = "Invalid email or you are not an active user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rangrasia | Sign-IN Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <link rel="shortcut icon" href="../assets/images/logo-dark.png" type="image/x-icon"> 
    <link rel="icon" href="../assets/images/logo-dark.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link id="fontsLink" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
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

    </style>
</head>

<body>
<section class="vh-100">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6">
                <div class="card mb-0 border-0 shadow-none mb-0 custom-card">
                    <div class="card-body p-sm-4 m-lg-">
                        <div class="logo-container square-border">
                            <img src="../assets/images/logo-dark.png" alt="Logo" class="img-fluid mb-3">
                            <!-- Your logo and branding here -->
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control form-control-sm password-input" id="email" name="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" class="form-control form-control-sm password-input" name="password" placeholder="Password" id="password-input" required>
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>
                                <?php if(isset($errorMessage)) { ?>
                                    <p style="color: red;"><?php echo $errorMessage; ?></p>
                                <?php } ?>
                                <div class="mt-4">
                                    <button class="btn btn-primary btn-sm w-100" type="submit">Sign In</button>
                                </div>
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
