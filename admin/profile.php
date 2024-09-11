<?php
include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit;
}

$userData = [];

$userId = mysqli_real_escape_string($connection, $_SESSION['id']);
$userQuery = "SELECT * FROM admin_login WHERE id = '$userId'";
$userResult = mysqli_query($connection, $userQuery);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
    $name_of_user = $userData['name'];
} else {
    $errorMessage = "User not found.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin Profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Name: </strong><?php echo $userData['name']; ?></h5>
                <p class="card-text"><strong>Email: </strong><?php echo $userData['email']; ?></p>
                <p class="card-text"><strong>Mobile: </strong><?php echo $userData['mobile']; ?></p>
                <p class="card-text"><strong>State: </strong><?php echo $userData['state']; ?></p>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
                <a href="edit_profile.php" class="btn btn-primary">Edit your profile</a>
            </div>
        </div>
    </div>
</body>

</html>
