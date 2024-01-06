<link rel="stylesheet" href="assets/css/header.css">
<header class="header">

    <div class="left-side">
        <div class="logo">
            <img src="./assets/Images/logo-removebg-preview.png" alt="logo" class="logo_img">
            <div class="logo_name">
                <a href="index.html">Travel <div>Agent</div></a>
            </div>
        </div>
        <div class="nav-links">
            <a href="index.html">Main</a>
            <a href="#">Hotels</a>
            <a href="#">Destination</a>
            <a href="./settings.html">Settings</a>
        </div>

    </div>

    <div class="right-side">

        <div class="account">
            <?php
            // Check if the 'token' cookie is present
            if (isset($_COOKIE['token'])) {
                require 'assets/db/connect.php';

                // making the token anti sql injection
                $token = $conn->real_escape_string($_COOKIE['token']);

                $sql = "SELECT username FROM users WHERE cookie = '$token'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $username = $row['username'];
                    echo "<a href='account.php'>Welcome $username!</a>";
                } else {
                    // delete the cooke because why do you have it in the first place
                    setcookie("token", "", time() - 3600, "/");
                }

                $conn->close();
            } else {
                echo '<a href="./register.html">Register</a>
                      <a href="./sign in.html">Sign in</a>';
            }
            ?>
        </div>


        <div id="menu-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="4" cy="4" r="2" fill="#fff" />
                <circle cx="4" cy="12" r="2" fill="#fff" />
                <circle cx="4" cy="20" r="2" fill="#fff" />

                <rect x="8" y="2" width="16" height="4" rx="2" fill="#fff" />
                <rect x="8" y="10" width="16" height="4" rx="2" fill="#fff" />
                <rect x="8" y="18" width="16" height="4" rx="2" fill="#fff" />
            </svg>
        </div>
    </div>
    <div class="mobile-header">
        <div class="mobile-nav-links">
            <a href="https://www.messenger.com/" target="_blank">Main</a>
            <a href="https://www.youtube.com/" target="_blank">Hotels</a>
            <a onclick="scrollToSection('destination')">Destination</a>
            <a href="./settings.html">Settings</a>
        </div>
        <div class="mobile-account">
            <a href="./sign up.html">Register</a>
            <a href="./sign in.html">Sign in</a>
        </div>
    </div>
</header>

<div id="space"></div>
<script src="./assets/js/scroll_effect.js"></script>