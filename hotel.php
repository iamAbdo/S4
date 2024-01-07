<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/hotel.css">
    <title>Document</title>
</head>

<body>

    <?php
    include 'header.php';

    if (isset($_GET['hotel'])) {
        $hotelID = $_GET['hotel'];
    } else {
        header("Location: hotels.php");
    }


    require 'assets/db/connect.php';
    //"HotelID Name LocationID Description Price Rating ImageURLs";
    $sqlQuery = "SELECT Name, Description, ImageURLs FROM Hotels WHERE HotelID = $hotelID";
    $result = mysqli_query($conn, $sqlQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hotelName = $row['Name'];
        $hotelDescription = $row['Description'];
        $imageURLs = json_decode($row['ImageURLs']);

    } else {
        echo "Error: " . mysqli_error($yourDbConnection);
    }
    $conn->close();
    ?>

    <div class="info-card">
        <div class="images">
            <div class="main-imgs">
                <img src="https://picsum.photos/id/154/2000/2000" class="slide" alt="">
                <?php
                if ($imageURLs && is_array($imageURLs)) {
                    foreach ($imageURLs as $imageURL) {
                        $fullImageURL = "./assets/Images/Hotels/hotel-$hotelID/$imageURL";
                        echo "<img src='$fullImageURL' alt='$fullImageURL' class='slide'>";
                    }
                } else {
                    echo "No images available for this hotel.";
                }
                ?>
            </div>
            <div class="s-images">
                <button onclick="imgBefore()" class="small-img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                        <path
                            d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z" />
                        <path d="M13.293 7.293 8.586 12l4.707 4.707 1.414-1.414L11.414 12l3.293-3.293-1.414-1.414z" />
                    </svg>
                </button>
                <?php
                if ($imageURLs && is_array($imageURLs)) {
                    $cpt = 0;
                    foreach ($imageURLs as $imageURL) {
                        $fullImageURL = "./assets/Images/Hotels/hotel-$hotelID/$imageURL";
                        echo "<div class='small-img' onclick='setCounterAndSlide($cpt)'>
                                <img src='$fullImageURL' alt='$fullImageURL'></div>";
                        $cpt++;
                    }
                } else {
                    echo "No images";
                }
                ?>
                <button onclick="imgAfter()" class="small-img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                        <path
                            d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z" />
                        <path d="M9.293 8.707 12.586 12l-3.293 3.293 1.414 1.414L15.414 12l-4.707-4.707-1.414 1.414z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="detail">
            <h1 class="title">Jianguo Hotel Qianmen</h1>
            <div class="stars">4.7/5 stars</div>
            <div class="description">
                <u>Hotel Description:</u><br>
                The Jianguo Hotel Qianmen is located near Tiantan Park,
                just a 10-minute walk from the National Center for the
                Performing Arts and Tian'anmen Square. Built in 1956 it
                has old school charm and many rooms still feature high,
                crown-molded ceilings. A 2012 renovation brought all rooms
                and services up to modern day scratch and guestrooms come
                equipped with free Wi-Fi and all the usual amenities
                required for a comfortable stay.
            </div>
            <div class="services-dhotel">
                City view
                Garden
                Pets allowed
                Free WiFi
                Balcony
                Bath
                Air conditioning
                24-hour front desk
                Key card access
                Daily housekeeping
            </div>
            <div class="reserve-option">
                2beds-1room 1bed 3beds-2rooms 2beds-2rooms
            </div>
            <a href="reservation.php">
                <div class="reserve-button">Reserve Now</div>
            </a>
        </div>
    </div>

    <script src="./assets/js/hotel-slider.js"></script>

</body>

</html>