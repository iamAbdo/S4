<link rel="stylesheet" href="assets/css/include/header.css">
<script>
    function LogoutPopOp() {
        var confirmLogout = window.confirm("Are you sure you want to log out?");

        if (confirmLogout) {
            // User clicked "Yes," redirect to logout.php
            window.location.href = "logout.php";
        } else {
            // User clicked "No" or closed the popup
            // You can optionally add some handling here
        }
    }
</script>
<header class="header">

    <div class="left-side">
        <div class="logo">
            <img src="./assets/Images/sahlaa-removebg-preview (1).png" alt="logo" class="logo_img">
            <div class="logo_name">
                <a href="index.php"><img src="./assets/Images/NL.png" alt="logo" class="logo_img"></a>
            </div>
        </div>
        <div class="nav-links">
            <a href="index.php">Main</a>
            <a href="hotels.php">Hotels</a>
            <a href="destinations.php">Destination</a>
            <a href="vols.php">Vols</a>
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
                    echo "<a href='account.php'>Welcome $username!</a>"; ?>
                    <button id="theDoor" onclick="LogoutPopOp()">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 7.63636L14 4.5C14 4.22386 13.7761 4 13.5 4L4.5 4C4.22386 4 4 4.22386 4 4.5L4 19.5C4 19.7761 4.22386 20 4.5 20L13.5 20C13.7761 20 14 19.7761 14 19.5L14 16.3636"
                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 12L21 12M21 12L18.0004 8.5M21 12L18 15.5" stroke="#000000" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <?php
                } else {
                    // delete the cooke because why do you have it in the first place
                    setcookie("token", "", time() - 3600, "/");
                }

                $conn->close();
            } else {
                echo '<a href="./sign up.html">Register</a>
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
            <a href="index.php" target="_blank">Main</a>
            <a href="hotels.php" target="_blank">Hotels</a>
            <a href="destinations.php">Destination</a>
            <a href="vols.php">Vols</a>
        </div>
        <div class="mobile-account">
            <a href="./sign up.html">Register</a>
            <a href="./sign in.html">Sign in</a>
        </div>
    </div>
</header>

<div id="space"></div>
<script src="./assets/js/scroll_effect.js"></script>