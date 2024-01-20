<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reservation.css">
    <title>Document</title>
</head>

<body>
    <?php
    // check if he has a booking
    $checkBookingQuery = "SELECT BookingID FROM bookings WHERE UserID = (SELECT UserID FROM users WHERE cookie = '$token')";
    $bookingResult = $connection->query($checkBookingQuery);


    if ($bookingResult->num_rows == 0) {
        // User doesn't have an existing booking, create a new one
        $hotelID = isset($_GET['hotelID']) ? $_POST['hotelID'] : null;
        $flightID = isset($_GET['flightID']) ? $_GET['flightID'] : null;
        $checkInDate = isset($_POST['checkInDate']) ? $_POST['checkInDate'] : null;
        $checkOutDate = isset($_POST['checkOutDate']) ? $_POST['checkOutDate'] : null;

        // Insert the new booking into the bookings table
        $insertBookingQuery = "INSERT INTO bookings (UserID, HotelID, FlightID, CheckInDate, CheckOutDate)
                               VALUES ((SELECT UserID FROM users WHERE cookie = '$token'), ?, ?, ?, ?)";

        $stmt = $connection->prepare($insertBookingQuery);
        $stmt->bind_param("iissd", $hotelID, $flightID, $checkInDate, $checkOutDate);
        $stmt->execute();
        $stmt->close();

    }

    ?>
    <div class="background-image"></div>
    <div class="overlay"></div>
    <div class="box">
        <div class="form">
            <h2>Informations de réservation :</h2>

            <?php

            echo "<p>Arrivée: " . "</p>"
                . "<p>Départ: " . "</p>"
                . "<p>Nombre de personnes: " . "</p>"
                . "<p>Nombre de chambres: " . "</p>";

            ?>

        </div>
    </div>

</body>

</html>