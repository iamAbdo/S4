<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/shop.css">
    <title>Document</title>
</head>
<?php
require 'assets/db/connect.php';
?>
<body>


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
                <a href="./register.html">Register</a>
                <a href="./sign in.html">Sign in</a>
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
                <a onclick="scrollToSection('destination')" >Destination</a>
                <a href="./settings.html">Settings</a>
            </div>
            <div class="mobile-account">
                <a href="./register.html">Register</a>
                <a href="./sign in.html">Sign in</a>
            </div>
        </div>
    </header>

    <div id="space"></div>
    <center><h1>Nos hotels</h1></center>
    <div class="container">
        <div id="cat">
            <a href="#Algeria">Algeria</a>
            <a href="#Morocco">Morocco</a>
            <a href="#Tunisia">Tunisia</a>
            <a href="#Egypt">Egypt</a>
            <a href="#Jordan">Jordan</a>
            <a href="#Lebanon">Lebanon</a>
            <a href="#Turkey">Turkey</a>
            <a href="#Greece">Greece</a>
        </div>
        <div id="Hotel-cards">
            <?php
                $sqlQuery = "SELECT HotelID, Name, Description, ImageURLs FROM Hotels LIMIT 30";
                $result = mysqli_query($conn, $sqlQuery);

                if ($result) {

                    //data
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hotelName = $row['Name'];
                        $hotelID = $row['HotelID'];
                        $hotelDescription = $row['Description'];
                        $imageURLs = json_decode($row['ImageURLs']);
                        $firstImageURL = './assets/Images/Hotels/hotel-' . $hotelID . '/' . $imageURLs[0] . '';
                        // Display the hotel card HTML structure
                        echo '<div class="Hotel-card">';
                        echo '<div class="hotel-img" style="background-image: url(' . $firstImageURL . ');"></div>';
                        echo '<div class="hotel-name">' . $hotelName . '</div>';
                        echo '<div class="hotel-desc">' . $hotelDescription . '</div>';
                        echo '</div>';
                    }
                    // Free result set
                    mysqli_free_result($result);

                } else {
                    // Handle the case where the query fails
                    echo "Error: " . mysqli_error($yourDbConnection);
                }
            ?>
        </div>
        
    </div>
</body>
</html>