<?php
include 'config.php'; // Include the database connection

// Collect form data with checks
$email = isset($_POST['email']) ? $_POST['email'] : '';
$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
$mobileNumber = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : '';
$whatsappNumber = isset($_POST['whatsappNumber']) ? $_POST['whatsappNumber'] : '';
$residence = isset($_POST['residence']) ? $_POST['residence'] : '';
$adults = isset($_POST['adults']) ? $_POST['adults'] : '';
$kidsAbove6 = isset($_POST['kidsAbove6']) ? $_POST['kidsAbove6'] : '';
$kidsBelow6 = isset($_POST['kidsBelow6']) ? $_POST['kidsBelow6'] : '';
$whatsappGroup = isset($_POST['whatsappGroup']) ? $_POST['whatsappGroup'] : '';
$joinWhatsappGroup = isset($_POST['joinWhatsappGroup']) ? $_POST['joinWhatsappGroup'] : '';
$socialMediaFollow = isset($_POST['socialMediaFollow']) ? $_POST['socialMediaFollow'] : '';
$companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
$suggestion = isset($_POST['suggestion']) ? $_POST['suggestion'] : '';

// Check if "Other" fields have values and replace dropdown values if necessary
$residenceOther = isset($_POST['residenceOther']) ? $_POST['residenceOther'] : '';
if ($residence === 'Other' && !empty($residenceOther)) {
    $residence = $residenceOther;
}

$adultsOther = isset($_POST['adultsOther']) ? $_POST['adultsOther'] : '';
if ($adults === 'Other' && !empty($adultsOther)) {
    $adults = $adultsOther;
}

$kidsAbove6Other = isset($_POST['kidsAbove6Other']) ? $_POST['kidsAbove6Other'] : '';
if ($kidsAbove6 === 'Other' && !empty($kidsAbove6Other)) {
    $kidsAbove6 = $kidsAbove6Other;
}

$kidsBelow6Other = isset($_POST['kidsBelow6Other']) ? $_POST['kidsBelow6Other'] : '';
if ($kidsBelow6 === 'Other' && !empty($kidsBelow6Other)) {
    $kidsBelow6 = $kidsBelow6Other;
}

// Check if email already exists
$emailCheckSql = "SELECT COUNT(*) FROM registrations WHERE email = ?";
if ($emailCheckStmt = $conn->prepare($emailCheckSql)) {
    $emailCheckStmt->bind_param("s", $email);
    $emailCheckStmt->execute();
    $emailCheckStmt->bind_result($emailCount);
    $emailCheckStmt->fetch();
    $emailCheckStmt->close();
    
    if ($emailCount > 0) {
        // Email already exists
        header("Location: index1.php?status=email_exists");
        exit();
    }
} else {
    echo "Failed to prepare email check SQL statement: " . $conn->error;
    header("Location: index1.php?status=error");
    exit();
}

// Prepare SQL statement for insertion
$sql = "INSERT INTO registrations (email, fullName, mobileNumber, whatsappNumber, residence, adults, kidsAbove6, kidsBelow6, whatsappGroup, joinWhatsappGroup, socialMediaFollow, companyName, suggestion, registrationDate) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssssssssssss", $email, $fullName, $mobileNumber, $whatsappNumber, $residence, $adults, $kidsAbove6, $kidsBelow6, $whatsappGroup, $joinWhatsappGroup, $socialMediaFollow, $companyName, $suggestion);
    if ($stmt->execute()) {
        // Send confirmation email to user
        $subjectUser = "Registration Confirmation";
        $messageUser = "Dear $fullName,\n\nThank you for registering.\n\nHere are your details:\nEmail: $email\nMobile Number: $mobileNumber\nWhatsApp Number: $whatsappNumber\nResidence: $residence\nAdults: $adults\nKids Above 6: $kidsAbove6\nKids Below 6: $kidsBelow6\nWhatsApp Group: $whatsappGroup\nJoin WhatsApp Group: $joinWhatsappGroup\nSocial Media Follow: $socialMediaFollow\nCompany Name: $companyName\nSuggestion: $suggestion\n\nRegards,\nTeam";
        $headersUser = "From: no-reply@yourdomain.com";
        
        mail($email, $subjectUser, $messageUser, $headersUser);

        // Send notification email to admin
        $adminEmail = "admin@yourdomain.com";
        $subjectAdmin = "New Registration Alert";
        $messageAdmin = "A new registration has been made.\n\nDetails:\nFull Name: $fullName\nEmail: $email\nMobile Number: $mobileNumber\nWhatsApp Number: $whatsappNumber\nResidence: $residence\nAdults: $adults\nKids Above 6: $kidsAbove6\nKids Below 6: $kidsBelow6\nWhatsApp Group: $whatsappGroup\nJoin WhatsApp Group: $joinWhatsappGroup\nSocial Media Follow: $socialMediaFollow\nCompany Name: $companyName\nSuggestion: $suggestion";
        $headersAdmin = "From: no-reply@yourdomain.com";
        
        mail($adminEmail, $subjectAdmin, $messageAdmin, $headersAdmin);

        // Redirect with success status
        header("Location: index.php?status=success");
    } else {
        // Redirect with error status
        header("Location: index.php?status=error");
    }
    $stmt->close();
} else {
    // Prepare statement failed
    echo "Failed to prepare SQL statement: " . $conn->error;
    header("Location: index1.php?status=error");
}

$conn->close();
?>
