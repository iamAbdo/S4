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
    $PageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
    ?>

    <center>
        <h1>Nos Vols</h1>
    </center>
    <div class="container">

        <div id="cat">
            <h3 style="margin: 30px auto">Filtres:</h3>
            <a href="">Most visited</a>
            <a href="">Highest Rating</a>
            <a href="">Lowest Price</a>

            <h3 style="margin: 30px auto">Date / Time:</h3>
            <label for="DepartureDateTime">Departure Date/Time: </label>
            <input type="date" name="DepartureDateTime">
            <label for="ArrivalDateTime">Arrival Date/Time: </label>
            <input type="date" name="ArrivalDateTime">

            
        </div>

        <div class="container">
            <?php
            require 'assets/db/connect.php';

            $sqlQuery = "SELECT f.FlightID, 
                    f.DepartureLocationID, dl.Name AS DepartureLocationName,
                    f.ArrivalLocationID, al.Name AS ArrivalLocationName,
                    f.DepartureDateTime, f.ArrivalDateTime, f.Price, f.Airline
                    FROM flights f
                    LEFT JOIN locations dl ON f.DepartureLocationID = dl.LocationID
                    LEFT JOIN locations al ON f.ArrivalLocationID = al.LocationID
                    LIMIT 30";

            $result = mysqli_query($conn, $sqlQuery);

            if ($result) {
                // data
                while ($row = mysqli_fetch_assoc($result)) {
                    $flightID = $row['FlightID'];
                    $departureLocationID = $row['DepartureLocationID'];
                    $departureLocationName = $row['DepartureLocationName'];
                    $arrivalLocationID = $row['ArrivalLocationID'];
                    $arrivalLocationName = $row['ArrivalLocationName'];
                    $departureDateTime = $row['DepartureDateTime'];
                    $arrivalDateTime = $row['ArrivalDateTime'];
                    $price = $row['Price'];
                    $airline = $row['Airline'];
                    $firstImageURL = './assets/Images/Airlines/' . $airline . '.jpg';
                    // Display the hotel card HTML structure
            
                    ?>
                    <div class="info-card">

                        <div class="images">
                            <img class="hotel-image" src="<?= $firstImageURL ?>" alt="">
                        </div>

                        <div class="detail">
                            <h1 class="title">
                                Vols Numéro:
                                <?= $flightID ?>
                            </h1>
                            <div class="stars">
                                <?= $price ?>DA
                            </div>
                            <div class="description">
                                <b> Du </b>
                                <?= $departureLocationName ?> <b>Vers</b>
                                <?= $arrivalLocationName ?><br><br>
                                <u>Temps Du Depart:</u><br>
                                <?= $departureDateTime ?><br>
                                <u>Temps Du Arrivée:</u><br>
                                <?= $arrivalDateTime ?>
                            </div>
                            <div class="services-dhotel">
                                <!-- ... Vos services ... -->
                            </div>
                            <div class="reserve-option">
                                <!-- ... Vos options de réservation ... -->
                            </div>
                            <form method="post" action="reservation.php?flightID=<?= $flightID ?>">
                                <button type="submit" name="submit" class="reserve-button">
                                    Reservez Maitennent
                                </button>
                            </form>

                            <script>
                                // Get today's date in the format "YYYY-MM-DD"
                                var today = new Date().toISOString().split('T')[0];
                                // Set the minimum value of checkInDate to today
                                document.getElementById('arrival-date<?= $flightID ?>').min = today;
                                document.getElementById('departure-date<?= $flightID ?>').min = today;

                                // Add an event listener to checkInDate
                                document.getElementById('arrival-date<?= $flightID ?>').addEventListener('change', function () {
                                    // Get the selected value of checkInDate
                                    var checkInDateValue = this.value;

                                    // Update the min attribute of checkOutDate to be greater than checkInDate
                                    document.getElementById('departure-date<?= $flightID ?>').min = checkInDateValue;
                                });
                                document.getElementById('departure-date<?= $flightID ?>').addEventListener('change', function () {
                                    // Get the selected value of checkInDate
                                    var checkInDateValue = this.value;

                                    // Update the min attribute of checkOutDate to be greater than checkInDate
                                    document.getElementById('arrival-date<?= $flightID ?>').max = checkInDateValue;
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