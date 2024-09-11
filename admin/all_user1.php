<?php 
include 'config.php'; 
session_start();

// Check if the user is not authenticated (session variable not set)
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php"); // Redirect to the login page
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming 'user_id' is the identifier for the user in the session


// Build the query for fetching user details with filters
$query = "SELECT * FROM user_login WHERE 1";

// Apply filters if they are set
if (!empty($_GET['state'])) {
    $state = mysqli_real_escape_string($connection, $_GET['state']);
    $query .= " AND state = '$state'";
}
if (!empty($_GET['category'])) {
    $category = mysqli_real_escape_string($connection, $_GET['category']);
    $query .= " AND category = '$category'";
}

// Add ordering
$query .= " ORDER BY id DESC";

$result = mysqli_query($connection, $query);

// Calculate starting serial number for the current page
$serialNumber = 1;

function generateOptions($mapping, $selectedValue) {
    $options = '';
    foreach ($mapping as $key => $value) {
        $selected = ($key == $selectedValue) ? 'selected' : '';
        $options .= "<option value=\"$key\" $selected>$value</option>";
    }
    return $options;
}



// Define the category mapping array
$categoryMapping = array(
    'Category 1' => 'Institutional (3 Persons)',
    'Category 2' => 'General Delegates (Academician, Scientists, Faculty, Entrepreneurs, Business Women)',
    'Category 3' => 'Student Delegates(Research Students, Diploma Students, PG Students, UG Students)',
    'Category 4' => 'Shakti Members'
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
    <title>Stree 2024 | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
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
        .gridjs-footer {
            display: flex;
            justify-content: center; /* Center align the pagination */
        }

        .gridjs-pagination {
            display: inline-block;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .page-item {
            margin: 0 5px;
        }

        .page-link {
            text-decoration: none;
            color: #007bff;
        }

        .page-item.active .page-link {
            font-weight: bold;
            color: #495057;
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
                                <h2 class="mb-sm-0">Total Entries</h2>
                                <div>
                                    <h4 class="mb-sm-0">Admin Console</h4>
                                    <button type="button" class="btn btn-success" onclick="window.location.href='export_users.php'">Download Excel</button>
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
                                                        <a href="all_users.php" class="btn btn-secondary btn-sm ml-2">Clear Search</a>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="gridjs-wrapper" style="height: auto;">
                                            <?php
                                            include 'config.php'; // Ensure database connection is included

                                            // Build the query for fetching user details with filters
                                            $query = "SELECT * FROM user_login WHERE 1";

                                            // Apply filters if they are set
                                            if (!empty($_GET['state'])) {
                                                $state = mysqli_real_escape_string($connection, $_GET['state']);
                                                $query .= " AND state = '$state'";
                                            }
                                            if (!empty($_GET['category'])) {
                                                $category = mysqli_real_escape_string($connection, $_GET['category']);
                                                $query .= " AND category = '$category'";
                                            }
                                            if (!empty($_GET['search'])) {
                                                $search = mysqli_real_escape_string($connection, $_GET['search']);
                                                $query .= " AND (name LIKE '%$search%' OR mobile LIKE '%$search%' OR email LIKE '%$search%')";
                                            }

                                            // Add ordering
                                            $query .= " ORDER BY id DESC";

                                            $result = mysqli_query($connection, $query);

                                            // Calculate starting serial number for the current page
                                            $serialNumber = 1;

                                            // State mapping for display
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

                                            <table role="grid" class="gridjs-table" style="height:auto;">
                                                <thead class="gridjs-thead">
                                                    <tr class="gridjs-tr">
                                                        <th>Sr. No.</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>State</th>
                                                        <th>User Details</th>
                                                        <th>Payment Screenshot</th>
                                                        <th>Registered Date</th>
                                                        <th>Status</th>
                                                        <th>Change Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="grid-tbody">
                                                    <?php 
                                                    if ($result && mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            // Get the state code and map it to the full state name
                                                            $stateCode = $row['state'];
                                                            $stateName = isset($stateMapping[$stateCode]) ? $stateMapping[$stateCode] : 'Unknown';
                                                            
                                                            // Retrieve the latest payment screenshot for each user
                                                            $paymentQuery = "SELECT payment FROM user_login WHERE id = " . $row['id'];
                                                            $paymentResult = mysqli_query($connection, $paymentQuery);
                                                            $paymentRow = mysqli_fetch_assoc($paymentResult);
                                                            
                                                            ?>
                                                            <tr class="gridjs-tr">
                                                                <td class="gridjs-td"><?php echo $serialNumber++; ?></td> <!-- Serial number column -->
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($row['name']); ?></td>
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($row['mobile']); ?></td>
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($row['email']); ?></td>
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($stateName); ?></td>
                                                                <td class="gridjs-td">
                                                                    <a href="view_profile.php?user_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View Profile</a>
                                                                </td>
                                                                <td class="gridjs-td">
                                                                    <?php 
                                                                    if (!empty($paymentRow['payment'])) : ?>
                                                                        <div class="d-inline-flex">
                                                                            <a href="../payment_screenshots/<?php echo htmlspecialchars($paymentRow['payment']); ?>" target="_blank" class="btn btn-primary btn-sm mr-2">View Screenshot</a>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        No Screenshot Uploaded
                                                                    <?php endif;
                                                                    mysqli_free_result($paymentResult);
                                                                    ?>
                                                                </td>
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($row['reg_at']); ?></td>
                                                                <td class="gridjs-td"><?php echo htmlspecialchars($row['status']); ?></td>
                                                                <td class="gridjs-td">
                                                                    <div class="mb-1">
                                                                        <button class="btn btn-success btn-sm change-status" style="width: 100px;" data-status="Verified" data-id="<?php echo $row['id']; ?>">Verified</button>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-danger btn-sm change-status" style="width: 100px;" data-status="Not Verified" data-id="<?php echo $row['id']; ?>">Not Verified</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='10'>No users found.</td></tr>";
                                                    }
                                                    mysqli_free_result($result);
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
        // Reset the form fields
        document.querySelector('select[name="state"]').value = '';
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

