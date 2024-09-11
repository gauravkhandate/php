<?php 
include 'config.php'; 
session_start();

// Check if the user is not authenticated (session variable not set)
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php"); // Redirect to the login page
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming 'user_id' is the identifier for the user in the session

// Query to fetch the user's name from the specific table in the database
$query = "SELECT name FROM admin_login WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name_of_user = $row['name'] ;
} else {
    // Handle the case where user name is not found
    $name_of_user = "Unknown"; // Set a default value
}

// Check if success message is set
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">';
    echo $_SESSION['success_message'];
    echo '</div>';

    // Unset the session variable to prevent displaying the message again on refresh
    unset($_SESSION['success_message']);
}

// Function to generate dropdown options
function generateOptions($optionsArray, $selectedValue = null) {
    $options = '';
    foreach ($optionsArray as $key => $value) {
        $selected = ($selectedValue == $key) ? 'selected' : '';
        $options .= "<option value='$key' $selected>$value</option>";
    }
    return $options;
}

// Define the theme mapping array
$themeMapping = array(
    'Theme 1' => 'आन्वीक्षिकी विभाग Vedic Philosophical and Cognitive Sciences',
    'Theme 2' => 'व्यावहारिकी विभाग Social and Cultural Sciences',
    'Theme 3' => 'वाग्विभाग Speech and Linguistics',
    'Theme 4' => 'राजनीति एवं अर्थशास्त्र विभाग Political, Economic and Strategic sciences',
    'Theme 5' => 'गणित-भौत-ज्यौतिष विभाग Mathematical, Physical and Astronomical Sciences',
    'Theme 6' => 'भैषज्य एवं आरोग्य विभाग Medical and Health sciences',
    'Theme 7' => 'द्रव्य-गुण-संयोग विभाग Culinary, Nutritional and Pharmacological Sciences',
    'Theme 8' => 'कृषि एवं पशुपाल्य विभाग (वार्ता विभाग) Agricultural and Veterinary Sciences',
    'Theme 9' => 'गांधर्व विभाग Performing Arts',
    'Theme 10' => 'यांत्रिक अभियांत्रिकी विभाग Mechanical Design & Engineering',
    'Theme 11' => 'नव्य अभियांत्रिकी विभाग Digital Design & Engineering',
    'Theme 12' => 'वास्तु विभाग Civil and Architectural Science',
    'Theme 13' => 'शिल्प-आलेख्य विभाग Fine Arts and Sculpture',
    'Theme 14' => 'रस-धातु विभाग Chemical, Metallurgical & Material Sciences',
    'Theme 15' => 'अलङ्कारादि विभाग Fashion and Interior Design',
    'Theme 16' => 'शैक्षणिक-क्रीड़नीयक विभाग Edutainment Sciences'
);

// Define the category mapping array
$categoryMapping = array(
    'Category 1' => 'General',
    'Category 2' => 'Life Member',
    'Category 3' => 'Student'
);

// Define the state mapping array
$stateMapping = array(
    'AN' => 'Andaman and Nicobar Island',
    'AP' => 'Andhra Pradesh',
    'AR' => 'Arunachal Pradesh',
    'AS' => 'Assam',
    'BH' => 'Bihar',
    'CH' => 'Chandigarh',
    'CG' => 'Chhattisgarh',
    'DL' => 'Delhi',
    'GA' => 'Goa',
    'GJ' => 'Gujarat',
    'HR' => 'Haryana',
    'HP' => 'Himachal Pradesh',
    'JK' => 'Jammu and Kashmir',
    'JH' => 'Jharkhand',
    'KA' => 'Karnataka',
    'KL' => 'Kerala',
    'LD' => 'Lakshadweep Islands',
    'MP' => 'Madhya Pradesh',
    'MH' => 'Maharashtra',
    'MN' => 'Manipur',
    'ML' => 'Meghalaya',
    'MZ' => 'Mizoram',
    'NL' => 'Nagaland',
    'OD' => 'Odisha',
    'PY' => 'Pondicherry',
    'PB' => 'Punjab',
    'RJ' => 'Rajasthan',
    'SK' => 'Sikkim',
    'TN' => 'Tamil Nadu',
    'TS' => 'Telangana',
    'TR' => 'Tripura',
    'UP' => 'Uttar Pradesh',
    'UK' => 'Uttarakhand',
    'WB' => 'West Bengal'
);

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>Viśva-Veda-Vijñāna-Sammelanam | 4th World Congress of Vedic Sciences | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon"> 
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link id="fontsLink" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" >
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
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
    </style>
</head>
<body>
    <div id="layout-wrapper">
        <!-- App Menu -->
        <?php include 'header.php'; ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <!-- Header -->
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="vvvs/images/log.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="vvvs/images/logo.png" alt="" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="vvvs/images/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="vvvs/images/logo.png" alt="" height="22">
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
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h2 class="mb-sm-0">Verified Payment</h2>
                                <div>
                                    <h4 class="mb-sm-0">Admin Console</h4>
                                    <button type="button" class="btn btn-success" onclick="window.location.href='export_verified_payment.php'">Download Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Filter Form -->
                    <form method="GET" action="">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <select name="state" class="form-select">
                                    <option value="">Select State</option>
                                    <?php echo generateOptions($stateMapping, $_GET['state'] ?? null); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="theme" class="form-select">
                                    <option value="">Select Theme</option>
                                    <?php echo generateOptions($themeMapping, $_GET['theme'] ?? null); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-select">
                                    <option value="">Select Category</option>
                                    <?php echo generateOptions($categoryMapping, $_GET['category'] ?? null); ?>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <!-- Button to clear filters -->
                                <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear Filters</button>
                            </div>
                        </div>
                    </form>
                    <!-- User Details Table -->
                    <div class="row">
                        <!-- Card visual for total number of users -->
                        <div class="col-lg-3">
                            <a href="all_users.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Entries</h4>
                                        <?php
                                        include 'config.php'; // Make sure this includes the database connection

                                        // Query to get the total number of users based on filter criteria
                                        $queryTotalUsers = "SELECT COUNT(*) as total FROM user_login u WHERE 1";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryTotalUsers .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryTotalUsers .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryTotalUsers .= " AND u.category = '$category'";
                                        }

                                        $resultTotalUsers = mysqli_query($connection, $queryTotalUsers);
                                        $rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
                                        $totalUsers = $rowTotalUsers['total'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($totalUsers); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Payment Not Done Card -->
                        <div class="col-lg-3">
                            <a href="payment_not_done.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Payment Not Done</h4>
                                        <?php
                                        // Query to get the count of users who haven't made a payment
                                        $queryPaymentNotDone = "
                                            SELECT COUNT(DISTINCT u.id) as total
                                            FROM user_login u
                                            LEFT JOIN payment_screenshots p ON u.id = p.user_id
                                            WHERE p.user_id IS NULL
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryPaymentNotDone .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryPaymentNotDone .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryPaymentNotDone .= " AND u.category = '$category'";
                                        }

                                        $resultPaymentNotDone = mysqli_query($connection, $queryPaymentNotDone);
                                        $rowPaymentNotDone = mysqli_fetch_assoc($resultPaymentNotDone);
                                        $paymentNotDone = $rowPaymentNotDone['total'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($paymentNotDone); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Payment Done Card -->
                        <div class="col-lg-3">
                            <a href="payment_done.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Payment Done</h4>
                                        <?php
                                        // Query to get the count of users who have made a payment
                                        $queryPaymentDone = "
                                            SELECT COUNT(DISTINCT u.id) as total
                                            FROM user_login u
                                            JOIN payment_screenshots p ON u.id = p.user_id
                                            WHERE p.user_id IS NOT NULL
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryPaymentDone .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryPaymentDone .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryPaymentDone .= " AND u.category = '$category'";
                                        }

                                        $resultPaymentDone = mysqli_query($connection, $queryPaymentDone);
                                        $rowPaymentDone = mysqli_fetch_assoc($resultPaymentDone);
                                        $paymentDone = $rowPaymentDone['total'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($paymentDone); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Verified Payments Card -->
                        <div class="col-lg-3">
                            <a href="verified_payment.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Verified Payments</h4>
                                        <?php
                                        // Query to get the count of verified payments
                                        $queryVerifiedPayments = "
                                            SELECT COUNT(*) as verifiedCount
                                            FROM payment_screenshots p
                                            JOIN user_login u ON p.user_id = u.id
                                            WHERE p.status = 'Verified'
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryVerifiedPayments .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryVerifiedPayments .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryVerifiedPayments .= " AND u.category = '$category'";
                                        }

                                        $resultVerifiedPayments = mysqli_query($connection, $queryVerifiedPayments);
                                        $rowVerifiedPayments = mysqli_fetch_assoc($resultVerifiedPayments);
                                        $verifiedCount = $rowVerifiedPayments['verifiedCount'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($verifiedCount); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Not Verified Payments Card -->
                        <div class="col-lg-3">
                            <a href="not_verified_payment.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Not Verified Payments</h4>
                                        <?php
                                        // Query to get the count of not verified payments
                                        $queryNotVerifiedPayments = "
                                            SELECT COUNT(*) as notVerifiedCount
                                            FROM payment_screenshots p
                                            JOIN user_login u ON p.user_id = u.id
                                            WHERE p.status = 'Not Verified'
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryNotVerifiedPayments .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryNotVerifiedPayments .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryNotVerifiedPayments .= " AND u.category = '$category'";
                                        }

                                        $resultNotVerifiedPayments = mysqli_query($connection, $queryNotVerifiedPayments);
                                        $rowNotVerifiedPayments = mysqli_fetch_assoc($resultNotVerifiedPayments);
                                        $notVerifiedCount = $rowNotVerifiedPayments['notVerifiedCount'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($notVerifiedCount); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Abstract Uploaded Card -->
                        <div class="col-lg-3">
                            <a href="abstract_uploaded.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Abstract Uploaded</h4>
                                        <?php
                                        // Query to count users with an abstract uploaded
                                        $queryAbstractUploaded = "
                                            SELECT COUNT(DISTINCT u.id) as abstractCount
                                            FROM user_login u 
                                            LEFT JOIN abstract_pdf a ON u.id = a.user_id
                                            WHERE a.file_path IS NOT NULL
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryAbstractUploaded .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryAbstractUploaded .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryAbstractUploaded .= " AND u.category = '$category'";
                                        }

                                        $resultAbstractUploaded = mysqli_query($connection, $queryAbstractUploaded);
                                        $rowAbstractUploaded = mysqli_fetch_assoc($resultAbstractUploaded);
                                        $abstractCount = $rowAbstractUploaded['abstractCount'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($abstractCount); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Abstract Not Uploaded Card -->
                        <div class="col-lg-3">
                            <a href="abstract_not_uploaded.php" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Abstracts Not Uploaded</h4>
                                        <?php
                                        // Query to count users with an abstract not uploaded
                                        $queryAbstractNotUploaded = "
                                            SELECT COUNT(DISTINCT u.id) as abstractCount
                                            FROM user_login u 
                                            LEFT JOIN abstract_pdf a ON u.id = a.user_id
                                            WHERE a.file_path IS NULL
                                        ";

                                        // Add conditions based on filter selections
                                        if (!empty($_GET['state'])) {
                                            $state = mysqli_real_escape_string($connection, $_GET['state']);
                                            $queryAbstractNotUploaded .= " AND u.state = '$state'";
                                        }
                                        if (!empty($_GET['theme'])) {
                                            $theme = mysqli_real_escape_string($connection, $_GET['theme']);
                                            $queryAbstractNotUploaded .= " AND u.theme = '$theme'";
                                        }
                                        if (!empty($_GET['category'])) {
                                            $category = mysqli_real_escape_string($connection, $_GET['category']);
                                            $queryAbstractNotUploaded .= " AND u.category = '$category'";
                                        }

                                        $resultAbstractNotUploaded = mysqli_query($connection, $queryAbstractNotUploaded);
                                        $rowAbstractNotUploaded = mysqli_fetch_assoc($resultAbstractNotUploaded);
                                        $abstractNullCount = $rowAbstractNotUploaded['abstractCount'];
                                        ?>
                                        <h3><?php echo htmlspecialchars($abstractNullCount); ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>



                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0 flex-grow-1">User Details</h4>
                                    <!--<button type="button" class="btn btn-success" onclick="window.location.href='export_users.php'">Download User Data in Excel</button>-->
                                </div>
                                <div class="card-body">    
                                    <div class="table-gridjs">
                                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                            <div>
                                                <form method="GET" action="" id="searchForm">
                                                    <div class="gridjs-head">    
                                                        <div class="gridjs-search">
                                                            <input type="search" placeholder="Type a keyword..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" id="searchInput" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                                                            <button type="submit" class="btn btn-primary btn-sm ml-2">Search</button>
                                                            <a href="verified_payment.php" class="btn btn-secondary btn-sm ml-2">Clear Search</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="gridjs-wrapper" style="height: auto;">
                                                <table role="grid" class="gridjs-table" style="height:auto;">
                                                    <thead class="gridjs-thead">
                                                        <tr class="gridjs-tr">
                                                            <th>Sr. No.</th>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                            <th>Email</th>
                                                            <th>Abstract</th>
                                                            <th>User Details</th>
                                                            <th>Registered Date</th>
                                                            <th>Payment Screenshot</th>
                                                            <th>Transaction Status</th>
                                                            <th>Change Status</th>
                                                            <th>Uploaded At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="grid-tbody">
                                                        <?php 
                                                        // Fetch and display filtered user details based on selected filters
                                                        $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

                                                        // Subquery to get the latest payment screenshot for each user
                                                            $latest_payment_screenshot_subquery = "
                                                            SELECT user_id, MAX(created_at) AS latest_created_at
                                                            FROM payment_screenshots
                                                            GROUP BY user_id
                                                            ";

                                                            // Main query to fetch user details and the latest payment screenshot
                                                            $query = "
                                                            SELECT u.id, u.name, u.mobile, u.email, u.reg_at, 
                                                                a.file_path AS abstract_path, 
                                                                p.ss_path AS payment_screenshot_path, 
                                                                p.status, p.created_at
                                                            FROM user_login u
                                                            LEFT JOIN abstract_pdf a ON u.id = a.user_id
                                                            LEFT JOIN payment_screenshots p 
                                                                ON u.id = p.user_id 
                                                                AND p.created_at = (
                                                                    SELECT latest_created_at 
                                                                    FROM ($latest_payment_screenshot_subquery) AS lps 
                                                                    WHERE lps.user_id = p.user_id
                                                                )
                                                            WHERE p.status='Verified'
                                                            ";

                                                        // Add search condition
                                                        if ($search) {
                                                            $query .= " AND (u.name LIKE '%$search%' OR u.mobile LIKE '%$search%' OR u.email LIKE '%$search%')";
                                                        }

                                                        // Add existing filters
                                                        if (!empty($_GET['state'])) {
                                                            $state = $_GET['state'];
                                                            $query .= " AND u.state = '$state'";
                                                        }
                                                        if (!empty($_GET['theme'])) {
                                                            $theme = $_GET['theme'];
                                                            $query .= " AND u.theme = '$theme'";
                                                        }
                                                        if (!empty($_GET['category'])) {
                                                            $category = $_GET['category'];
                                                            $query .= " AND u.category = '$category'";
                                                        }

                                                        // Remove pagination variables and LIMIT clause
                                                        $query .= " ORDER BY u.id DESC";
                                                        $result = mysqli_query($connection, $query);

                                                        // Calculate starting serial number for the current page
                                                        $serialNumber = 1;

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                <tr class="gridjs-tr">
                                                                    <td class="gridjs-td"><?php echo $serialNumber++; ?></td> <!-- Serial number column -->
                                                                    <td class="gridjs-td"><?php echo $row['name']; ?></td>
                                                                    <td class="gridjs-td"><?php echo $row['mobile']; ?></td>
                                                                    <td class="gridjs-td"><?php echo $row['email']; ?></td>
                                                                    <td class="gridjs-td">
                                                                        <?php if (!empty($row['abstract_path'])) : ?>
                                                                            <div class="d-inline-flex">
                                                                                <a href="../user/<?php echo $row['abstract_path']; ?>" target="_blank" class="btn btn-primary btn-sm mr-2">View PDF</a>
                                                                            </div>
                                                                        <?php else : ?>
                                                                            No PDF Uploaded
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="gridjs-td">
                                                                        <a href="view_profile.php?user_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View Profile</a>
                                                                    </td>
                                                                    <td class="gridjs-td"><?php echo $row['reg_at']; ?></td>
                                                                    <td class="gridjs-td">
                                                                        <?php if (!empty($row['payment_screenshot_path'])) : ?>
                                                                            <div class="d-inline-flex">
                                                                                <a href="../user/<?php echo $row['payment_screenshot_path']; ?>" target="_blank" class="btn btn-primary btn-sm mr-2">View Screenshot</a>
                                                                            </div>
                                                                        <?php else : ?>
                                                                            No Screenshot Uploaded
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="gridjs-td">
                                                                        <?php echo $row['status']; ?>
                                                                    </td>
                                                                    <td class="gridjs-td">
                                                                        <div class="mb-1"> <!-- Add margin bottom -->
                                                                            <button class="btn btn-success btn-sm change-status" style="width: 100px;" data-status="Verified" data-id="<?php echo $row['id']; ?>">Verified</button>
                                                                        </div>
                                                                        <div>
                                                                            <button class="btn btn-danger btn-sm change-status" style="width: 100px;" data-status="Not Verified" data-id="<?php echo $row['id']; ?>">Not Verified</button>
                                                                        </div>
                                                                    </td>
                                                                    <td class="gridjs-td"><?php echo $row['created_at']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='11'>No users found.</td></tr>";
                                                        }
                                                        // Close the result set
                                                        mysqli_free_result($result);

                                                        // No pagination query
                                                        mysqli_close($connection);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            var statusButtons = document.querySelectorAll('.change-status');
            statusButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var status = this.getAttribute('data-status');
                    var pdfId = this.getAttribute('data-id');
                    console.log('Button clicked: ', status, pdfId); // Debugging log
                    updateStatus(status, pdfId);
                });
            });

            function updateStatus(status, pdfId) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log('Status updated successfully:', xhr.responseText); // Debugging log
                            location.reload();
                        } else {
                            console.error('Error updating status:', xhr.responseText);
                        }
                    }
                };
                xhr.open('POST', 'update_status.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('status=' + encodeURIComponent(status) + '&pdf_id=' + encodeURIComponent(pdfId));
            }
        });
        </script>
        <script>
            function clearFilters() {
                // Reset the form by setting its values to empty strings
                document.querySelector('select[name="state"]').value = '';
                document.querySelector('select[name="theme"]').value = '';
                document.querySelector('select[name="category"]').value = '';

                // Submit the form to apply the cleared filters
                document.querySelector('form').submit();
            }
        </script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/js/pages/sweetalerts.init.js"></script>
         <!-- gridjs js -->
        <script src="assets/libs/gridjs/gridjs.umd.js"></script>
        <script src="assets/libs/gridjs/theme/mermaid.min.css"></script>
        <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
        <!-- gridjs init -->
        <script src="assets/js/pages/gridjs.init.js"></script>
        <script src="assets/js/app.js"></script>
        <script>
            function exportUserData() {
                if (confirm('Are you sure you want to export all user data?')) {
                    window.location.href = 'export_users.php';
                }
            }
        </script>
    </div>
</body>
</html>

</html>