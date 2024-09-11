<?php
// Start a session to access session data
session_start();

// End the session
session_destroy();

// Redirect to the login page or another appropriate page
header("Location: sign_in.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Viśva-Veda-Vijñāna-Sammelanam | 4th World Congress of Vedic Sciences | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #283149;
        }
        .card {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card .display-5 {
            color: #007BFF;
        }
        .card .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }
        .text-muted {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="display-5">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <div class="mt-4">
            <h5 class="fs-2xl">You are Logged Out</h5>
            <p class="text-muted">Thank you for using <span class="fw-semibold">Imperial Money</span> admin</p>
            <div class="mt-4">
                <a href="sign_in.php" class="btn btn-primary w-100">Sign In</a>
            </div>
        </div>
    </div>

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
