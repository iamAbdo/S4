<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/hotel.css">
    <link rel="stylesheet" href="assets/css/include/header.css">
    <link rel="stylesheet" href="assets/css/include/footer.css">
    <title>Document</title>
</head>

<body>

    <?php
    //include 'include/header.php';
    
    if (isset($_GET['hotel'])) {
        $hotelID = $_GET['hotel'];
    } else {
        header("Location: hotels.php");
    }


    require 'assets/db/connect.php';
    //"SELECT Hotels.Name AS Name,locations.Name AS location, hotels.Description, Price, ImageURLs, Rating 
    // FROM Hotels INNER JOIN locations ON hotels.LocationID = locations.LocationID WHERE HotelID = 1";
    $sqlQuery = "SELECT Hotels.Name AS Name,locations.Name AS location, hotels.Description AS Description, Price, ImageURLs, Rating 
                    FROM Hotels INNER JOIN locations ON hotels.LocationID = locations.LocationID 
                    WHERE HotelID = $hotelID LIMIT 1";
    $result = mysqli_query($conn, $sqlQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hotelName = $row['Name'];
        $hotelDescription = $row['Description'];
        $hotelprice = $row['Price'];
        $rating = $row['Rating'];
        $location = $row['location'];
        $imageURLs = json_decode($row['ImageURLs']);

    } else {
        echo "Error: " . mysqli_error($yourDbConnection);
    }
    $conn->close();
    ?>

    <div class="info-card">
        <div class="images">
            <div class="main-imgs">
                <img src="./assets/Images/img1.jpg" alt="./assets/Images/Hotels/hotel-4/img1.webp" class="slide"
                    style="left: 0%;">
            </div>
            <div class="s-images">



                <div class="thumbnails">
                    <div class="arrow left">&lt;</div>
                    <div class="thumbnail-container">
                        <?php
                        if ($imageURLs && is_array($imageURLs)) {
                            foreach ($imageURLs as $imageURL) {
                                $fullImageURL = "./assets/Images/Hotels/hotel-$hotelID/$imageURL";
                                //echo "<img src='$fullImageURL' alt='$fullImageURL' class='slide'>";
                                echo '<div class="thumbnail" style="background-image: url(' . $fullImageURL . ');"></div>';
                            }
                        } else {
                            echo "No images available for this hotel.";
                        }
                        ?>
                    </div>
                    <div class="arrow right">&gt;</div>
                </div>
            </div>
        </div>
        <div class="detail">
            <h1 class="title">
                <?php echo $hotelName ?>
            </h1>
            <div class="stars">
                <?php echo $rating ?>/5 stars
            </div>
            <div class="description">
                <?php echo $location ?><br>
                <u>Hotel Description:</u><br>
                <?php echo $hotelDescription ?>
            </div>
            <div class="services-dhotel">
                City view<br>
                Garden<br>
                Pets allowed<br>
                Free WiFi<br>
                Balcony<br>
                Bath<br>
                Air conditioning<br>
                24-hour front desk<br>
                Key card access<br>
                Daily housekeeping<br>
            </div>


            <form id="myForm" action="reservation.php" method="post">
                <?php echo $hotelprice . "$" ?>
                <div class="reserve-option">
                    <label for="arrival-date">Arrivée:</label>
                    <input type="date" id="arrival-date" name="arrival-date" required>

                    <label for="departure-date">Départ:</label>
                    <input type="date" id="departure-date" name="departure-date" required>

                    <label for="num-people">Nombre de personnes:</label>
                    <select id="num-people" name="num-people" required>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <!-- Ajoutez plus d'options au besoin -->
                    </select>

                    <label for="num-rooms">Nombre de chambres:</label>
                    <select id="num-rooms" name="num-rooms" required>
                        <option value="1">1 chambre</option>
                        <option value="2">2 chambres</option>
                        <option value="3">3 chambres</option>
                        <!-- Ajoutez plus d'options au besoin -->
                    </select>
                </div>

                <a href="reservation.html">
                    <button class="btn" type="submit">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor"
                                class="bi bi-airplane-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Z">
                                </path>
                            </svg>
                        </span>
                        <span class="text">RESERVER</span>
                    </button>
                </a>
            </form>
        </div>
    </div>

    <script src="./assets/js/hotel-slider.js"></script>

</body>

</html>