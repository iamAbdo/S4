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
    //check if logged in
    if (isset($_COOKIE['token'])) {
        // Establish a MySQL database connection (replace with your database details)
        $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user information from the database
        $token = $conn->real_escape_string($_COOKIE['token']);
        $sql = "SELECT UserID,address, phone, birthdate, Username, Email, LastName, Role, FirstName FROM users WHERE cookie = '$token'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $UserID = $row['UserID'];
            $username = $row['Username'];
            $email = $row['Email'];
            $LastName = $row['LastName'];
            $FirstName = $row['FirstName'];
            $phone = $row['phone'];
            $dob = $row['birthdate'];
            $address = $row['address'];

            $role = $row['Role'];
        } else {
            header('Location: login.php');
            exit;
        }
    } else {
        header('Location: sign In.html');
        exit;
    }

    // check Informations
    if (isset($_POST['submit'])) {
        // User doesn't have an existing booking, create a new one
        $HotelID = isset($_GET['HotelID']) ? $_GET['HotelID'] : null;
        $flightID = isset($_GET['flightID']) ? $_GET['flightID'] : null;
        $checkInDate = isset($_POST['checkInDate']) ? $_POST['checkInDate'] : null;
        $checkOutDate = isset($_POST['checkOutDate']) ? $_POST['checkOutDate'] : null;


        // Reservation Hotel
        if (isset($_GET['HotelID'])) {
            echo "changer Hotel";
            // check if he has a booking
            $checkBookingQuery = "SELECT BookingID FROM bookings WHERE UserID = (SELECT UserID FROM users WHERE cookie = '$token')";
            $bookingResult = $conn->query($checkBookingQuery);


            if ($bookingResult->num_rows == 0) {
                // Insert the new booking into the bookings table
                $insertBookingQuery = "INSERT INTO bookings (UserID, HotelID, FlightID, CheckInDate, CheckOutDate)
                               VALUES ((SELECT UserID FROM users WHERE cookie = '$token'), ?, ?, ?, ?)";

                $stmt = $conn->prepare($insertBookingQuery);
                $stmt->bind_param("iissd", $HotelID, $flightID, $checkInDate, $checkOutDate);
                $stmt->execute();
                $stmt->close();

            } else {
                // User has an existing booking, update HotelID, CheckInDate, and CheckOutDate
                $bookingData = $bookingResult->fetch_assoc();
                $bookingID = $bookingData['BookingID'];

                // Update the existing booking with the new values
                $updateBookingQuery = "UPDATE bookings SET HotelID = ?, CheckInDate = ?, CheckOutDate = ? WHERE BookingID = ?";

                $stmt = $conn->prepare($updateBookingQuery);
                $stmt->bind_param("isss", $HotelID, $CheckInDate, $CheckOutDate, $bookingID);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Reservation Flight
        if (isset($_GET['flightID'])) {
            echo "changer Vol";
            // check if he has a booking
            $checkBookingQuery = "SELECT BookingID FROM bookings WHERE UserID = (SELECT UserID FROM users WHERE cookie = '$token')";
            $bookingResult = $conn->query($checkBookingQuery);

            if ($bookingResult->num_rows == 0) {
                // Insert the new booking into the bookings table
                $insertBookingQuery = "INSERT INTO bookings (UserID, HotelID, FlightID, CheckInDate, CheckOutDate)
                            VALUES ((SELECT UserID FROM users WHERE cookie = '$token'), ?, ?, ?, ?)";

                $stmt = $conn->prepare($insertBookingQuery);
                $stmt->bind_param("iiss", $HotelID, $flightID, $checkInDate, $checkOutDate);
                $stmt->execute();
                $stmt->close();
            } else {
                // User has an existing booking, update FlightID, CheckInDate, and CheckOutDate
                $bookingData = $bookingResult->fetch_assoc();
                $bookingID = $bookingData['BookingID'];

                // Update the existing booking with the new values
                $updateBookingQuery = "UPDATE bookings SET FlightID = ? WHERE BookingID = ?";

                $stmt = $conn->prepare($updateBookingQuery);
                $stmt->bind_param("is", $flightID, $bookingID);
                $stmt->execute();
                $stmt->close();
            }
        }
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