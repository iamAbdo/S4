<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require 'assets/db/connect.php';
    ?>
    <?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sqlQuery = "INSERT INTO users (Username, Password, Email) VALUES 
    ('$username', '$password', '$email')";
    if (mysqli_query($conn, $sqlQuery)) {
        echo "votre compte est cree";
    } else {
        echo "erreur";
    }
    ?>
</body>

</html>