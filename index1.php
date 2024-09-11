<?php
// Check if a status parameter is set in the URL
$status = isset($_GET['status']) ? $_GET['status'] : '';

?>
<!DOCTYPE html>
<html>
 
<head>
<meta charset="utf-8">
<title>Rangrasia</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="#" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
<style>
    /* Modal styling */
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 60px; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Icon styling */
    .fa-info-circle {
        margin-left: 10px;
        color: #007bff;
        cursor: pointer;
    }

    .fa-info-circle:hover {
        color: #0056b6;
    }
    .progressValue {
    height: 25px;
}

.progress-bar {
    background-color: #007bff;
    color: white;
    text-align: center;
    line-height: 25px;
    font-size: 14px;
}
.text-center {
    text-align: center !important;
    margin-top: 18px;
}

body {
    font-family: Arial, sans-serif;
}

table { 
    border-collapse: collapse; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 5px; /* Reduced padding to decrease row height */
    text-align: left;
}

th {
    background-color: #003366;
    color: white;
    height: 30px; /* Set a specific height for table header cells */
}

td {
    height: 25px; /* Set a specific height for table data cells */
}

.header {
    background-color: orange;
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
}

.category {
    background-color: #003366;
    color: white;
    text-align: center;
    font-weight: bold;
}

.text-muted {
    font-size: 10px;
    color: #555;
}
select.form-control:not([size]):not([multiple]) {
    height: calc(2.25rem + 9px);
}
.notification {
    position: fixed;
    top: 10px; /* Adjust this value as needed to move the notification further down */
    left: 50%;
    transform: translateX(-50%);
    background-color: #333; /* Default background color */
    color: white; /* Default text color */
    padding: 15px 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    z-index: 1000;
    display: none; /* Hidden by default */
    }

    .notification.success {
        background-color: #28a745; /* Green for success */
    }

    .notification.error {
        background-color: #dc3545; /* Red for error */
    }
    .content-container h2 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #007BFF;
    border-bottom: 2px solid #007BFF;
    padding-bottom: 5px;
}

.highlight {
    font-size: 1rem;
    margin: 10px 0;
    line-height: 1.5;
    padding: 10px;
    background-color: #f9f9f9;
    border-left: 5px solid #007BFF;
}

p {
    margin: 10px 0;
    line-height: 1.6;
}

strong {
    color: #333;
}

ul {
    list-style: disc;
    padding-left: 20px;
    margin: 10px 0;
}

ul li {
    margin-bottom: 8px;
}

@media (max-width: 768px) {
    .content-container {
        width: 95%;
        padding: 15px;
    }
}
.notification {
    position: fixed;
    top: 10px; /* Adjust this value as needed to move the notification further down */
    left: 50%;
    transform: translateX(-50%);
    background-color: #333; /* Default background color */
    color: white; /* Default text color */
    padding: 15px 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    z-index: 1000;
    display: none; /* Hidden by default */
    }

    .notification.success {
        background-color: #28a745; /* Green for success */
    }

    .notification.error {
        background-color: #dc3545; /* Red for error */
    }
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        .success {
            background-color: #4CAF50; /* Green for success */
        }
        .error {
            background-color: #f44336; /* Red for error */
        }
        a {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
</style>
<script>
        window.onload = function() {
            <?php if (isset($_SESSION['successMessage'])): ?>
                alert("<?php echo $_SESSION['successMessage']; ?>");
                <?php unset($_SESSION['successMessage']); ?>
            <?php endif; ?>
        };
    </script>
    <script>
function showNotification(message, type) {
    console.log(`Notification: ${message}, Type: ${type}`); // Debug statement
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = `notification ${type}`;
    notification.style.display = 'block';
    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000); // Hide the notification after 5 seconds
}


function clearFormFields() {
    const form = document.querySelector('form');
    if (form) {
        form.reset(); // Clear all form fields
    }
}

window.onload = function() {
    clearFormFields(); // Clear form fields on page load

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'success') {
        showNotification('Registration successful!', 'success');
    } else if (status === 'error') {
        showNotification('There was an error with your registration. Please try again.', 'error');
    }
    
    // Clear URL parameters to prevent form resubmission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
};

window.onload = function() {
    // showNotification('This is a test notification!', 'success');
    
    clearFormFields(); // Clear form fields on page load

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'success') {
        showNotification('Registration successful!', 'success');
    } else if (status === 'error') {
        showNotification('There was an error with your registration. Please try again.', 'error');
    }
    
    // Clear URL parameters to prevent form resubmission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
};


</script>
</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    
    <!-- Main Header-->
    <?php include 'header.php'; ?>
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/18.jpg);">
        <div class="parallax-scene parallax-scene-1 anim-icons">
            <span data-depth="0.60" class="parallax-layer icon icon-dots-1"></span>
            <span data-depth="0.70" class="parallax-layer icon twist-line-1"></span>
            <span data-depth="0.80" class="parallax-layer icon icon-circle-7"></span>
            <span data-depth="0.90" class="parallax-layer icon icon-triangles"></span>
        </div>
        <div class="auto-container">
            <h1>Rangrasia</h1>
            <ul class="bread-crumb clearfix"> 
                <li>Please fill out the form below to register for the Event Rangrasia </li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Info Section -->
    <?php
    if (isset($_SESSION['successMessage'])) {
        echo '<p class="success">' . $_SESSION['successMessage'] . '</p>';
        unset($_SESSION['successMessage']);
    }
    if (isset($errorMessage) && !empty($errorMessage)) {
        echo '<p class="error">' . $errorMessage . '</p>';
    }
    ?>

<?php if ($status === 'success'): ?>
            <div class="message success">
                Registration successful! A confirmation email has been sent to you.
            </div>
        <?php elseif ($status === 'error'): ?>
            <div class="message error">
                An error occurred during registration. Please try again.
            </div>
        <?php elseif ($status === 'email_exists'): ?>
            <div class="message error">
                This email address is already registered. Please use a different email.
            </div>
        <?php endif; ?>
    <section class="become-sponsor">
    <div class="auto-container">
        <div class="row justify-content">
            <!--Form Column--> 
            <div class="rorm-column col-lg-6 col-md-12 col-sm-12">
                    <div class="application-form" style="background-image: url(images/background/20.jpg);">
                        
                    <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="fullName">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="fullName" id="fullName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="mobileNumber">Mobile Number (Calling) <span class="text-danger">*</span></label>
                    <input type="tel" name="mobileNumber" id="mobileNumber" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="whatsappNumber">Mobile Number (WhatsApp) <span class="text-danger">*</span></label>
                    <input type="tel" name="whatsappNumber" id="whatsappNumber" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="residence">Place of Residence <span class="text-danger">*</span></label>
                    <select name="residence" id="residence" class="form-control" required onchange="toggleOtherInput('residence')">
                        <option value="Dubai">Dubai</option>
                        <option value="Sharjah">Sharjah</option>
                        <option value="Abu Dhabi">Abu Dhabi</option>
                        <option value="Ajman">Ajman</option>
                        <option value="Umm-Al-Quawain">Umm-Al-Quawain</option>
                        <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                        <option value="Fujairah">Fujairah</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" name="residenceOther" id="residenceOther" class="form-control mt-2" placeholder="Please specify" style="display:none;">
                </div>

                <div class="form-group">
                    <label for="adults">Number of Adults including Children above 12 years old <span class="text-danger">*</span></label>
                    <select name="adults" id="adults" class="form-control" required onchange="toggleOtherInput('adults')">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" name="adultsOther" id="adultsOther" class="form-control mt-2" placeholder="Please specify" style="display:none;">
                </div>

                <div class="form-group">
                    <label for="kidsAbove6">Number of Kids above 6 and below 12 years old <span class="text-danger">*</span></label>
                    <select name="kidsAbove6" id="kidsAbove6" class="form-control" required onchange="toggleOtherInput('kidsAbove6')">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" name="kidsAbove6Other" id="kidsAbove6Other" class="form-control mt-2" placeholder="Please specify" style="display:none;">
                </div>

                <div class="form-group">
                    <label for="kidsBelow6">Number of Kids below 6 years old <span class="text-danger">*</span></label>
                    <select name="kidsBelow6" id="kidsBelow6" class="form-control" required onchange="toggleOtherInput('kidsBelow6')">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" name="kidsBelow6Other" id="kidsBelow6Other" class="form-control mt-2" placeholder="Please specify" style="display:none;">
                </div>

                <div class="form-group">
                    <label for="whatsappGroup">Are you part of our WhatsApp communication group? <span class="text-danger">*</span></label>
                    <select name="whatsappGroup" id="whatsappGroup" class="form-control" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="joinWhatsappGroup">If you are not part of our WhatsApp group, would you like to become a member of it?</label>
                    <select name="joinWhatsappGroup" id="joinWhatsappGroup" class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <option value="Not Applicable">Not Applicable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Have you followed the below links for more updates? <span class="text-danger">*</span></label>
                    <div>
                        <a href="https://www.facebook.com/yourpage" target="_blank" class="d-inline-block mr-2">
                            <img src="images/facebook.png" alt="Facebook Page" style="width: 50px; height: 50px;">
                        </a>
                        <a href="https://www.instagram.com/yourpage" target="_blank" class="d-inline-block mr-2">
                            <img src="images/instagram.png" alt="Instagram Page" style="width: 50px; height: 50px;">
                        </a>
                        <a href="https://www.youtube.com/yourchannel" target="_blank">
                            <img src="images/youtube.png" alt="YouTube Channel" style="width: 50px; height: 50px;">
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <label for="socialMediaFollow">Have you followed the above social media pages? <span class="text-danger">*</span></label>
                    <select name="socialMediaFollow" id="socialMediaFollow" class="form-control" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="companyName">Please name the company/Business where you work <span class="text-danger">*</span></label>
                    <input type="text" name="companyName" id="companyName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="suggestion">Any suggestion?</label>
                    <textarea name="suggestion" id="suggestion" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-custom btn-block">Register</button>
            </form>
                    <script>
                        function toggleDelegateFields(select) {
                            var delegateFields = document.getElementById('delegate-fields');
                            if (select.value === 'Delegate') {
                                delegateFields.style.display = 'block';
                            } else {
                                delegateFields.style.display = 'none';
                            }
                        }
                    </script>


                    <script>
                        function showOtherField(select) {
                            var otherField = document.getElementById('other-state-field');
                            if (select.value === 'Other') {
                                otherField.style.display = 'block';
                                document.getElementById('other_state').setAttribute('required', 'required');
                            } else {
                                otherField.style.display = 'none';
                                document.getElementById('other_state').removeAttribute('required');
                            }
                        }
                    </script>
                    <?php if ($errorMessage): ?>
                    <script>
                        alert("<?php echo $errorMessage; ?>");
                    </script>
                    <?php endif; ?> 
            </div>
            </div>
            <div id="notification" class="notification"></div>
            
            <div class="form-column-column content-column col-lg-6 col-md-12 col-sm-12">
            <div class="content-container mt-4">
            <h2 class="text-center">Highlights of the Event</h2>
            <div class="highlight">
                • Beloved Shyam Darshan - मनभावन दरबार;
            </div>
            <div class="highlight">
                • Chappan Bhog Jhanki - छप्पन भोग झांकी;
            </div>
            <div class="highlight">
                • Renowned Bhajan singers Shri Raj Parik Ji and Smt. Reshmi Sharma Ji - राज पारीक जी और रेशमी शर्मा जी की जुगलबंदी;
            </div>
            <div class="highlight">
                • Renowned Musicians team Shri Naresh Poonia Ji - नरेश पुनिया जी की नागिन धुन;
            </div>
            <div class="highlight">
                • Special arrangements for kids' activities - बच्चों के खिलोनें;
            </div>
            <div class="highlight">
                • Delicious Shyam Prasad - श्याम प्रसाद.
            </div>
            <p>Everyone is warmly invited to this unique event. It is a wonderful opportunity for all Shyam Bhakats to come together, immerse in the devotional evening.</p>
            <p><strong>Date:</strong> 7th December 2024</p>
            <p><strong>Venue:</strong> Rashidiya Grand Ball Room, Movenpick Grand Al Bustan Hotel, Al Garhoud, Dubai</p>
            <p><strong>Time:</strong> 03:00 PM Onwards</p>
            <p><strong>Contact:</strong> +971 56 661 3171, +971 50 552 4049, +971 50 346 6919, +971 52 618 5050</p>
            <p><strong>Note:</strong></p>
            <ul>
                <li>Register only when you are sure to attend as the seats are limited and those can be allocated to another Bhakat;</li>
                <li>Registration is mandatory to attend;</li>
                <li>Please ensure that there are no duplicate entries;</li>
                <li>Once the registration form is filled your registration is confirmed, you need to carry a hard/digital copy of the mail received on your E-mail ID.</li>
            </ul>
        </div>
            </div>
            <!--End Form Column-->
        </div>
    </div>
    </div>
</section>
<script>
    function toggleOtherInput(selectId) {
        const selectElement = document.getElementById(selectId);
        const otherInputId = selectId + 'Other';
        const otherInput = document.getElementById(otherInputId);
        otherInput.style.display = selectElement.value === 'Other' ? 'block' : 'none';
    }
</script>

<style>
    .title-bg {
        background-color: #171d89;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px; /* Adjust margin bottom as needed */
    }
    label { 
    color: #efef00;
    }
</style>
    <!-- End Map Section -->


    <!-- Main Footer -->
    <?php include 'footer.php'; ?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!--Search Popup-->
<div id="search-popup" class="search-popup">
    <div class="close-search theme-btn"><span class="fa fa-times"></span></div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="post" action="https://t.commonsupport.xyz/weston/index.php">
                <div class="form-group">
                    <fieldset>
                        <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required >
                        <input type="submit" value="Search Now!" class="theme-btn">
                    </fieldset>
                </div>
            </form>
            <br>
            <h3>Recent Search Keywords</h3>
            <ul class="recent-searches">
                <li><a href="#">Business</a></li>
                <li><a href="#">Web Development</a></li>
                <li><a href="#">SEO</a></li>
                <li><a href="#">Logistics</a></li>
                <li><a href="#">Freedom</a></li>
            </ul>
        </div>        
    </div>
</div>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.bootstrap-touchspin.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/validate.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcaOOcFcQ0hoTqANKZYz-0ii-J0aUoHjk"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
</body>

<!-- Mirrored from t.commonsupport.xyz/weston/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Aug 2024 04:04:23 GMT -->
</html>