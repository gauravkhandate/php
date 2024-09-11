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

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>Shakti 2024 | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <link rel="shortcut icon" href="../assets/images/logo-dark.png" type="image/x-icon"> 
    <link rel="icon" href="../assets/images/logo-dark.png" type="image/x-icon">
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
        element.style {
            height: auto;
            width: 1600px;
        }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
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
                                    <img src="../assets/images/logo-dark.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-dark.png" alt="" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-dark.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-dark.png" alt="" height="22">
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
                    <!-- <form method="GET" action="">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <select name="state" class="form-select">
                                    <option value="">Select State</option>
                                    <?php echo generateOptions($stateMapping, $_GET['state'] ?? null); ?>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear Filters</button>
                            </div>
                        </div>
                    </form> -->

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
                                        $queryTotalUsers = "SELECT COUNT(*) as total FROM registrations WHERE 1";


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
                                            <?php
include 'config.php'; // Include the database connection

echo '<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>';

$sql = "SELECT email, fullName, mobileNumber, whatsappNumber, residence, adults, kidsAbove6, kidsBelow6, whatsappGroup, joinWhatsappGroup, socialMediaFollow, companyName, suggestion, registrationDate FROM registrations";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>
            <th>Email</th>
            <th>Full Name</th>
            <th>Mobile Number</th>
            <th>WhatsApp Number</th>
            <th>Residence</th>
            <th>Adults</th>
            <th>Kids Above 6</th>
            <th>Kids Below 6</th>
            <th>WhatsApp Group</th>
            <th>Join WhatsApp Group</th>
            <th>Social Media Follow</th>
            <th>Company Name</th>
            <th>Suggestion</th>
            <th>Registration Date</th>
          </tr>';
          
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['fullName']) . '</td>
                <td>' . htmlspecialchars($row['mobileNumber']) . '</td>
                <td>' . htmlspecialchars($row['whatsappNumber']) . '</td>
                <td>' . htmlspecialchars($row['residence']) . '</td>
                <td>' . htmlspecialchars($row['adults']) . '</td>
                <td>' . htmlspecialchars($row['kidsAbove6']) . '</td>
                <td>' . htmlspecialchars($row['kidsBelow6']) . '</td>
                <td>' . htmlspecialchars($row['whatsappGroup']) . '</td>
                <td>' . htmlspecialchars($row['joinWhatsappGroup']) . '</td>
                <td>' . htmlspecialchars($row['socialMediaFollow']) . '</td>
                <td>' . htmlspecialchars($row['companyName']) . '</td>
                <td>' . htmlspecialchars($row['suggestion']) . '</td>
                <td>' . htmlspecialchars($row['registrationDate']) . '</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo 'No records found.';
}

$connection->close();
?>



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

