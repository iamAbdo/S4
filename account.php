<?php
// Check if the 'token' cookie is present
if (isset($_COOKIE['token'])) {
    // Establish a MySQL database connection (replace with your database details)
    $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user information from the database
    $token = $conn->real_escape_string($_COOKIE['token']);
    $sql = "SELECT username,email FROM users WHERE cookie = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
        echo "Welcome to the dashboard $username! <br>
                Your email is : $email";
    } else {
        header('Location: login.php');
        exit;
    }

    // Close the database connection
    $conn->close();
} else {
    header('Location: sign In.html');
    exit;
}
?>