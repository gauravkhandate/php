<?php 
include 'config.php'; 
session_start();

// Check if the user_id is provided in the URL
if (!isset($_GET['user_id'])) {
    // Redirect to the user list page if user_id is not provided
    header("Location: index.php");
    exit;
}

// Get the user_id from the URL
$user_id = $_GET['user_id'];

$query = "SELECT *
          FROM registrations 
          WHERE id = $user_id";
$result = mysqli_query($connection, $query);

// Fetch the data into an associative array
$user = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>Stree 2024 | View Profiles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon"> 
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link id="fontsLink" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" >
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar-menu .navbar-nav .nav-link {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: .625rem 1rem;
            color: #eef0f7;
            font-size: var(--tb-vertical-menu-item-font-size);
            font-family: var(--tb-font-sans-serif);
            margin: 4px 12px;
            font-weight: var(--tb-vertical-menu-item-font-weight);
        }
        .navbar-menu .navbar-nav .nav-link {
            transition: color 0.3s ease, background-color 0.3s ease;
        }
        .navbar-menu .navbar-nav .nav-link.active {
            color: var(--tb-vertical-menu-item-active-color);
            background-color: #abadbb;
            border-radius: 15px;
        }
        <!-- Add CSS in the <head> section or in a separate CSS file -->
    .card-fixed-height {
        height: 250px; /* Set a fixed height for the cards */
    }

    .card-fixed-height .card-body {
        overflow: hidden; /* Ensure content does not overflow */
        text-overflow: ellipsis; /* Handle overflow content with ellipsis */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-fixed-height img {
        max-height: 150px; /* Limit the image height */
        width: auto;
        height: auto;
    }
    .card-fixed-height .card-body {
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 230px;
}
        .address-proof-preview {
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        .address-proof-preview iframe {
            width: 50%;
            height: 200px;
        }
 
    </style>
</head>
<body>
    <!-- Layout wrapper and header -->
    <div id="layout-wrapper">
        <!-- App Menu -->
        <?php include 'header.php'; ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay -->
        <div class="vertical-overlay"></div>
        <!-- Header -->
        <!-- Header -->
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../images/log.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../images/logo.png" alt="" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../images/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../images/logo.png" alt="" height="22">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <div class="main-content mt-5">
            <!-- Page content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mt-4">
                            <div class="card-body mt-4">
                                <h4 class="card-title d-flex align-items-center justify-content-between">
                                    User Profile
                                    <!--<div class="d-flex ms-auto">
                                        <button type="button" class="btn btn-primary" onclick="sendCredentials(<?php echo $user_id; ?>)">Send Credentials to User</button>
                                    </div>-->
                                </h4>

                                <!-- Add button to send credentials -->
    

                                <!-- Modal for showing the success/failure message -->
                                <div id="messageModal" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p id="messageText"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    
                                <div class="table-responsive">
                                    <table class="table mt-4">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Full Name</th>
                                                <td><?php echo $user['fullName']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td><?php echo $user['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile Number (Calling)</th>
                                                <td><?php echo $user['mobileNumber']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile Number (WhatsApp)</th>
                                                <td><?php echo $user['whatsappNumber']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Place of Residence</th>
                                                <td><?php echo $user['residence']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Number of Adults (including Children above 12 years old)</th>
                                                <td><?php echo $user['adults']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Number of Kids (above 6 and below 12 years old)</th>
                                                <td><?php echo $user['kidsAbove6']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Number of Kids (below 6 years old)</th>
                                                <td><?php echo $user['kidsBelow6']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">WhatsApp Group</th>
                                                <td><?php echo $user['whatsappGroup']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Join WhatsApp Group</th>
                                                <td><?php echo $user['joinWhatsappGroup']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Social Media Follow</th>
                                                <td><?php echo $user['socialMediaFollow']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Company Name</th>
                                                <td><?php echo $user['companyName']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Suggestion</th>
                                                <td><?php echo $user['suggestion']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Registration Date</th>
                                                <td><?php echo $user['registrationDate']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for showing the success/failure message -->
        <div id="messageModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="messageText"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ... other elements ... -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/app.js"></script>
    </div>
</body>
</html>