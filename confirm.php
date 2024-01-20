<?php
require "assets/db/connect.php";

if (isset($_COOKIE['token'])) {
    require "assets/db/connect.php";

    // Retrieve user information from the database
    $token = $conn->real_escape_string($_COOKIE['token']);
    $sql = "UPDATE bookings SET status = 'confirmed' WHERE UserID = (SELECT UserID FROM users WHERE cookie = '$token')";
    $result = $conn->query($sql);

    header('Location: account.php');
    exit;

} else {
    header('Location: sign In.html');
    exit;
}

?>