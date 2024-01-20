<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>sign up</title>
    <link rel="stylesheet" href="assets/css/sign up.css">

</head>

<body>
    <div class="background-image"></div>
    <header class="Header">
        <div class="left-side">

            <div class="logo">
                <img src="./assets/Images/sahlaa-removebg-preview (1).png" alt="logo" class="logo_img">
                <div class="logo_name">
                    <a href="index.php"><img src="./assets/Images/NL.png" alt="logo" class="logo_img"></a>
                </div>
            </div>

        </div>

        <div class="right-side">

        </div>
    </header>

    <?php
    require 'assets/db/connect.php';
    $emailexists = false;

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        // check if email is already used:
        $sqlQuery = "SELECT Email FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $sqlQuery);
        if ($result->num_rows > 0) {
            $emailexists = true;
        } else {
            $sqlQuery = "INSERT INTO users (Username, Password, Email) VALUES 
                        ('$username', '$password', '$email')";
            if (mysqli_query($conn, $sqlQuery)) {
                $token = bin2hex(random_bytes(128));
                $sql = "UPDATE users SET cookie = '$token' WHERE Email = '$email'";
                $conn->query($sql);
                setcookie('token', $token, time() + 3600, '/');
                header("Location: account.php");
            } else {
                echo "erreur";
            }
        }
    }

    ?>

    <div class="box">
        <div class="form">
            <h2>Sign Up</h2>
            <form action="signUp.php" method="post">
                <div class="inputBox">
                    <input type="text" name="username" required>
                    <span>Username</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="text" name="email" required>
                    <span>Email</span>
                    <i></i>
                </div>
                <?php
                if ($emailexists) {
                    echo "<p style='color:red;font-weight: bold;'>Email already used!</p>";
                }
                ?>
                <div class="inputBox">
                    <input type="password" name="password" required>
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="confirm_password" required>
                    <span>Confirm Password</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="./sign in.html">Already have an account?</a>
                </div>

                <input type="submit" value="Sign Up">
            </form>
        </div>
    </div>
</body>

</html>