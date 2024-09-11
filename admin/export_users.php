<?php
include 'config.php';

// Build the query to fetch user details based on provided criteria
$query = "SELECT email, fullName, mobileNumber, whatsappNumber, residence, adults, kidsAbove6, kidsBelow6, 
                 whatsappGroup, joinWhatsappGroup, socialMediaFollow, companyName, suggestion, registrationDate 
          FROM registrations
          WHERE 1"; // Start building the query

// Add conditions based on filter selections
if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query .= " AND (fullName LIKE '%$search%' OR mobileNumber LIKE '%$search%' OR email LIKE '%$search%')";
}

if (!empty($_GET['residence'])) {
    $residence = mysqli_real_escape_string($connection, $_GET['residence']);
    $query .= " AND residence = '$residence'";
}

// Order by registrationDate in descending order to get newest entries first
$query .= " ORDER BY registrationDate DESC";
$result = mysqli_query($connection, $query);

// File path for the CSV file
$filename = 'User_Details.csv';

// Set headers to prompt download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="'.$filename.'"');

// Open the output stream and write to file
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('Email', 'Full Name', 'Mobile Number', 'WhatsApp Number', 'Residence', 'Adults', 
                       'Kids Above 6', 'Kids Below 6', 'WhatsApp Group', 'Join WhatsApp Group', 
                       'Social Media Follow', 'Company Name', 'Suggestion', 'Registration Date'));

// Fetch and output the rows
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, array($row['email'], $row['fullName'], $row['mobileNumber'], $row['whatsappNumber'], 
                               $row['residence'], $row['adults'], $row['kidsAbove6'], $row['kidsBelow6'], 
                               $row['whatsappGroup'], $row['joinWhatsappGroup'], $row['socialMediaFollow'], 
                               $row['companyName'], $row['suggestion'], $row['registrationDate']));
    }
}

// Close the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($connection);

// Output the file to the browser
exit;
?>
