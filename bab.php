<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bab.css">
    <title>Document</title>
</head>

<body>

    <center>
        <h1>Nos hotels</h1>
    </center>
    <div class="container">

        <div id="cat">
            <?PHP
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
            <div class="info-card">
                <div class="images">
                    <!-- ... Vos images ... -->
                </div>
                <div class="detail">
                    <h1 class="title">nom de lhotel</h1>
                    <div class="stars">/5 stars</div>
                    <div class="description">
                        PARIS<br>
                        <u>Hotel Description:</u><br>

                    </div>
                    <div class="services-dhotel">
                        <!-- ... Vos services ... -->
                    </div>
                    <div class="reserve-option">
                        <!-- ... Vos options de réservation ... -->
                    </div>
                    <a href="reservation.php" class="reserve-button">
                        Reserve Now
                    </a>
                </div>
            </div><br>
            <div class="info-card">
                <div class="images">
                    <!-- ... Vos images ... -->
                </div>
                <div class="detail">
                    <h1 class="title">nom de lhotel</h1>
                    <div class="stars">/5 stars</div>
                    <div class="description">
                        PARIS<br>
                        <u>Hotel Description:</u><br>

                    </div>
                    <div class="services-dhotel">
                        <!-- ... Vos services ... -->
                    </div>
                    <div class="reserve-option">
                        <!-- ... Vos options de réservation ... -->
                    </div>
                    <a href="reservation.php" class="reserve-button">
                        Reserve Now
                    </a>
                </div>
            </div>


            <div class="thumbnails">
                <div class="thumbnail-container">
                    <!-- ... Vos miniatures ... -->
                </div>
                <div class="arrow">➡️</div>
            </div>

        </div>
    </div>
    <script src="./assets/js/hotel-slider.js"></script>

</body>

</html>