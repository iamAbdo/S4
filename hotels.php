<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/shop.css">
    <title>Document</title>
</head>

<body>

    <?php
    include 'header.php';
    ?>

    <center>
        <h1>Nos hotels</h1>
    </center>
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
            require 'assets/db/connect.php';

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
                    echo "<a href='hotel.php?hotel=$hotelID'><div class='Hotel-card'>";
                    echo '<div class="hotel-img" style="background-image: url(' . $firstImageURL . ');"></div>';
                    echo '<div class="hotel-name">' . $hotelName . '</div>';
                    echo '<div class="hotel-desc">' . $hotelDescription . '</div>';
                    echo '</div></a>';
                }
                // Free result set
                mysqli_free_result($result);

            } else {
                // Handle the case where the query fails
                echo "Error: " . mysqli_error($yourDbConnection);
            }
            $conn->close();
            ?>

        </div>

    </div>

    <script src="./assets/js/scroll_effect.js"></script>

</body>

</html>