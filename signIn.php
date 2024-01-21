<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>sign in</title>
    <link rel="stylesheet" href="assets/css/sign in.css">

</head>
<?php
require 'assets/db/connect.php';
?>
<?php
$message = "";
if (isset($_POST['password']) && isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user information from the database
    $sql = "SELECT password, cookie FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the password is correct
        if (password_verify($password, $row['password'])) {

            $token = $row['cookie'];
            echo "Token: " . $token;

            setcookie('token', $token, time() + (3600 * 24 * 365), '/'); // Cookie expires in 1 Year

            echo "<br>correct";

            header("Location: account.php");
        } else {
            $message = "Password";
        }
    } else {
        $message = "account";
    }

    // Close the database connection
    $conn->close();
}
?>

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

    <!-- partial:index.partial.html -->
    <form action="signIn.php" method="POST">
        <div class="box">
            <div class="form">
                <h2>Sign in</h2>
                <div class="inputBox">
                    <input type="text" name="email" required="required" />
                    <span>Email</span>
                    <i></i>
                </div>
                <?php
                if ($message == "account") {
                    echo "<p style='color:red;font-weight: bold;'>you dont have an account!</p>";
                }
                ?>
                <div class="inputBox">
                    <input type="password" name="password" required="required" />
                    <span>Password</span>
                    <i></i>
                </div>
                <?php
                if ($message == "Password") {
                    echo "<p style='color:red;font-weight: bold;'>Incorrect Password!</p>";
                }
                ?>
                <div class="links">
                    <a href="forgetpassword.html">Forgot Password</a>
                    <a href="./sign up.html">Signup</a>
                </div>
                <input type="submit" value="Login" />
            </div>
        </div>
    </form>
    <!-- partial -->

</body>

</html>