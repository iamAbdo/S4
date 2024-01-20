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
        <h1>Flights to</h1>
    </center>
    <div class="container">
        <div id="cat">
            <h3 style="color:white; margin: 10px auto">Sort By:</h3>
            <a href="">Most visited</a>
            <a href="">Highest Rating</a>
            <a href="">Lowest Price</a>

            <h3 style="color:white; margin: 10px auto">Date / Time:</h3>
            <label for="DepartureDateTime">Departure Date/Time: </label>
            <input type="date" name="DepartureDateTime">
            <label for="ArrivalDateTime">Arrival Date/Time: </label>
            <input type="date" name="ArrivalDateTime">
        </div>
        <div id="Hotel-cards">
            <?php
            require 'assets/db/connect.php';
            $sqlQuery = "SELECT FlightID,DepartureLocationID,ArrivalLocationID,DepartureDateTime,ArrivalDateTime,Price,Airline FROM flights WHERE 1";

            $result = mysqli_query($conn, $sqlQuery);

            if ($result) {

                //data
                while ($row = mysqli_fetch_assoc($result)) {
                    $FlightID = $row['FlightID'];
                    $DepartureLocationID = $row['DepartureLocationID'];
                    $ArrivalLocationID = $row['ArrivalLocationID'];
                    $DepartureDateTime = $row['DepartureDateTime'];
                    $ArrivalDateTime = $row['ArrivalDateTime'];
                    $Price = $row['Price'];
                    $Airline = $row['Airline'];
                    $firstImageURL = './assets/Images/Airlines/' . $Airline . '.jpg';

                    $Description = "Du $DepartureLocationID vers $ArrivalLocationID Date: $DepartureDateTime to $ArrivalDateTime";

                    echo "<a href='vol.php?vol=$FlightID'><div class='info-card'>";
                    echo '<div class="images" style="background-image: url(' . $firstImageURL . ');"></div>';
                    echo '<div class="title"> Flight-' . $FlightID . '</div>';
                    echo '<div class="description">' . $Description . '</div>';
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