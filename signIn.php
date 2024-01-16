<?php
require 'assets/db/connect.php';
?>
<?php
$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve user information from the database
$sql = "SELECT password, cookie FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if the password is correct
    if (password_verify($password, $row['password'])) {

        $token = $row['cookie'];
        echo "Token: " . $token;

        setcookie('token', $token, time() + 3600, '/'); // Cookie expires in 1 hour

        echo "<br>correct";

        header("Location: account.php");
    } else {
        echo "incorrect Password";
    }
} else {
    echo "you dont have an account";
}

// Close the database connection
$conn->close();
?>