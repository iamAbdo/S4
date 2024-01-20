<?php
function checkUserRoleAndRedirect()
{
    if (isset($_COOKIE['token'])) {
        // Establish a MySQL database connection (replace with your database details)
        $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user information from the database
        $token = $conn->real_escape_string($_COOKIE['token']);
        $sql = "SELECT Role FROM users WHERE cookie = '$token'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row['Role'];
            if ($role == "user") {
                header('Location: account.php?message=noperms');
                exit;
            }
        } else {
            echo "<script>alert('Ok smart guy YOU ARE BANNED!')</script>";
            header('Location: sign In.php');
            exit;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "<script>alert('You need an Account to access this page')</script>";
        header('Location: sign In.html');
        exit;
    }
}

?>