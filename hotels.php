<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/include/header.css">
    <link rel="stylesheet" href="assets/css/hotels.css">
    <title>Document</title>
</head>

<body>

    <?php
    include 'include/header.php';
    ?>

    <center>
        <h1>Nos hotels</h1>
    </center>
    <div class="container">

        <div id="cat">
            <?PHP
            $PageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
            $GETLocationID = isset($_GET['LocationID']) ? $_GET['LocationID'] : null;

            require 'assets/db/connect.php';

            $sqlQuery = "SELECT LocationID,Name FROM locations";
            $result = mysqli_query($conn, $sqlQuery);

            if ($GETLocationID !== null) {
                echo " <a href='?' class='unselect-link'>Unselect</a>";
            }

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $LocationName = $row['Name'];
                    $LocationID = $row['LocationID'];
                    echo "<a href='?LocationID=$LocationID'";
                    if ($GETLocationID == $LocationID) {
                        echo " class='selected' ";
                    }
                    echo ">$LocationName</a>";
                }
            }
            ?>
        </div>

        <div class="container">
            <?php
            $sqlQuery = ($GETLocationID == null) ?
                'SELECT
                hotels.HotelID,
                hotels.Name AS Name,
                locations.LocationID,
                locations.Name AS LocationName,
                hotels.Description AS Description,
                hotels.Rating,
                hotels.ImageURLs
                FROM hotels JOIN locations ON hotels.LocationID = locations.LocationID LIMIT 10;' :
                "SELECT
                hotels.HotelID,
                hotels.Name AS Name,
                locations.LocationID,
                locations.Name AS LocationName,
                hotels.Description AS Description,
                hotels.Rating,
                hotels.ImageURLs
                FROM hotels JOIN locations ON hotels.LocationID = locations.LocationID WHERE hotels.LocationID=$GETLocationID LIMIT 10";

            $result = mysqli_query($conn, $sqlQuery);

            if ($result) {

                //data
                while ($row = mysqli_fetch_assoc($result)) {
                    $hotelName = $row['Name'];
                    $locationName = $row['LocationName'];
                    $hotelID = $row['HotelID'];
                    $rating = $row['Rating'];
                    $hotelDescription = $row['Description'];
                    $imageURLs = json_decode($row['ImageURLs']);
                    $firstImageURL = './assets/Images/Hotels/hotel-' . $hotelID . '/' . $imageURLs[0] . '';
                    // Display the hotel card HTML structure
            
                    ?>
                    <div class="info-card">

                        <div class="images">
                            <img class="hotel-image" src="<?= $firstImageURL ?>" alt="">
                        </div>

                        <div class="detail">
                            <h1 class="title">
                                <?= $hotelName ?>
                            </h1>
                            <div class="stars">
                                <?= $rating ?>/5 stars
                            </div>
                            <div class="description">
                                <?= $locationName ?><br>
                                <u>Description:</u><br>
                                <?= $hotelDescription ?>
                            </div>
                            <div class="services-dhotel">
                                <!-- ... Vos services ... -->
                            </div>
                            <div class="reserve-option">
                                <!-- ... Vos options de réservation ... -->
                            </div>
                            <form method="post" action="reservation.php?HotelID=<?= $hotelID ?>">
                                <label for="arrival-date<?= $hotelID ?>">Arrivée:</label>
                                <input type="date" id="arrival-date<?= $hotelID ?>" name="checkInDate" required>

                                <label for="departure-date<?= $hotelID ?>">Départ:</label>
                                <input type="date" id="departure-date<?= $hotelID ?>" name="checkOutDate" required>

                                <br><br>
                                <button type="submit" name="submit" class="reserve-button">
                                    Reserve Now
                                </button>
                            </form>

                            <script>
                                // Get today's date in the format "YYYY-MM-DD"
                                var today = new Date().toISOString().split('T')[0];
                                // Set the minimum value of checkInDate to today
                                document.getElementById('arrival-date<?= $hotelID ?>').min = today;
                                document.getElementById('departure-date<?= $hotelID ?>').min = today;

                                // Add an event listener to checkInDate
                                document.getElementById('arrival-date<?= $hotelID ?>').addEventListener('change', function () {
                                    // Get the selected value of checkInDate
                                    var checkInDateValue = this.value;

                                    // Update the min attribute of checkOutDate to be greater than checkInDate
                                    document.getElementById('departure-date<?= $hotelID ?>').min = checkInDateValue;
                                });
                                document.getElementById('departure-date<?= $hotelID ?>').addEventListener('change', function () {
                                    // Get the selected value of checkInDate
                                    var checkInDateValue = this.value;

                                    // Update the min attribute of checkOutDate to be greater than checkInDate
                                    document.getElementById('arrival-date<?= $hotelID ?>').max = checkInDateValue;
                                });
                            </script>
                        </div>

                    </div>
                    <br>
                <?php }
                // Free result set
                mysqli_free_result($result);

            } else {
                // Handle the case where the query fails
                echo "Error: " . mysqli_error($yourDbConnection);
            }
            $conn->close();
            ?>


            <div class="thumbnails">
                <div class="arrow">⬅️</div>
                <div class="thumbnail-container">
                    <!-- ... Vos miniatures ... -->
                    <b>
                        Page
                        <?= $PageNumber ?>
                    </b>
                </div>
                <div class="arrow">➡️</div>
            </div>

        </div>
    </div>

    <?php
    include 'include/footer.php';
    ?>

    <script src="./assets/js/scroll_effect.js"></script>

</body>

</html>