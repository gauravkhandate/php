<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch user details from the user_login table based on user_id
    $query = "SELECT * FROM user_login WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        

        $to = $user['email'];
        $subject_user = 'Registration Confirmation';
        $emailBody_user = "<p>Dear " . $user['name'] . ",</p>";
        $emailBody_user .= "<p>Thank you for registering for the Viśva-Veda-Vijñāna-Sammelanam 2024 Team. Here are your registration details:</p>";
        $emailBody_user .= "<p><strong>Name:</strong> " . $user['name'] . "</p>";
        $emailBody_user .= "<p><strong>Designation:</strong> " . $user['designation'] . "</p>";
        $emailBody_user .= "<p><strong>Organization:</strong> " . $user['organization'] . "</p>";
        $emailBody_user .= "<p><strong>Email:</strong> " . $user['email'] . "</p>";
        $emailBody_user .= "<p><strong>Mobile:</strong> " . $user['mobile'] . "</p>";
        $emailBody_user .= "<p><strong>State:</strong> " . $stateName . "</p>";
        $emailBody_user .= "<p><strong>Password:</strong> " . $user['password'] . "</p>";
        $emailBody_user .= "<p><strong>Login URL:</strong> https://vvvs.in/user/sign_in.php</p>";
        $emailBody_user .= "<p>Best regards,<br>Viśva-Veda-Vijñāna-Sammelanam 2024 Team</p>";

        // Email headers
        $headers_user = "MIME-Version: 1.0" . "\r\n";
        $headers_user .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers_user .= "From: vvvsvibha@gmail.com";

        // Send the email to the user
        if (mail($to, $subject_user, $emailBody_user, $headers_user)) {
            echo "Login Credentials sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}
?>
