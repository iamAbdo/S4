<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="/assets/css/ticket.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <div class="pass">
        <img src="assets/Images/sahla-ticket.png">
        <?php

        if (isset($_COOKIE['token'])) {
            // Establish a MySQL database connection (replace with your database details)
            $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve user information from the database
            $token = $_COOKIE['token'];

            $sql = "SELECT 
            u.FirstName,
            u.LastName,
            b.*,
            f.DepartureLocationID,
            f.ArrivalLocationID,
            f.DepartureDateTime,
            f.Price,
            f.Airline,
            dl.Name AS DepartureLocationName,
            al.Name AS ArrivalLocationName
        FROM 
            users u
        JOIN 
            bookings b ON u.userid = b.userid
        JOIN 
            flights f ON b.FlightID = f.FlightID
        JOIN 
            locations dl ON f.DepartureLocationID = dl.LocationID
        JOIN 
            locations al ON f.ArrivalLocationID = al.LocationID
        WHERE 
            u.cookie = $token";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $FirstName = $row['FirstName'];
                    $LastName = $row['LastName'];
                    $flightNumber = $row['FlightID'];
                    $departure = $row['DepartureLocationName'];
                    $arrival = $row['ArrivalLocationName'];
                    $date = date('Y-m-d', strtotime($row['DepartureDateTime']));
                    $time = date('H:i', strtotime($row['DepartureDateTime']));
                    $boarding = $row['BookingID'];
                    $gate = '12'; // You may need to retrieve this information based on your database structure
                    $seat = 'B05'; // You may need to retrieve this information based on your database structure
                    $airline = $row['Airline'];
                }
            } else {
                header('Location: account.php');
                exit;
            }

            // Close the database connection
        
        } else {
            header('Location: sign In.html');
            exit;
        }
        ?>

        <div id="vol"><?= $FlightID ?></div>
        <div id="depart"><?= $departure ?></div>
        <div id="arriver"><?= $arrival ?></div>
        <div id="NomPrenom"><?= $FirstName . " " . $LastName ?></div>
        <div id="date"><?= $date ?></div>
        <div id="time"><?= $time ?></div>
        <div id="boarding"><?= $bookingID ?></div>
        <div id="gate"><?= $gate ?></div>
        <div id="seat"><?= $seat ?></div>
        <div id="company"><?= $airline ?></div>
        <div id="nomPrenom2"><?= $FirstName . " " . $LastName ?></div>
        <div id="vol2"><?= $FlightID ?></div>
        <div id="time2"><?= $time ?></div>
        <div id="gate2"><?= $gate ?>15</div>
        <div id="seat2"><?= $seat ?>34B</div><?php }

    </div>
</body>

</html>