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
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        //$password = $_POST['password'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        // check if email is already used:
        $sqlQuery = "SELECT Email FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $sqlQuery);
        if ($result->num_rows > 0) {
            // Email already exists
            echo "Email already exists";
        } else {
            $sqlQuery = "INSERT INTO users (Username, Password, Email) VALUES 
                        ('$username', '$password', '$email')";
            if (mysqli_query($conn, $sqlQuery)) {
                echo "votre compte est cree ";
                $token = bin2hex(random_bytes(128));
                $sql = "UPDATE users SET cookie = '$token' WHERE Email = '$email'";
                $conn->query($sql);
                echo "cookie = $token";
                setcookie('token', $token, time() + 3600, '/');
            } else {
                echo "erreur";
            }
        }
    } else {
        header("Location: sign up.html?error=snikypeakyAreYOU");
        exit();
    }


    // create cookie: (user id):
    ?>
</body>

</html>