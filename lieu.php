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
        <h1>Nos Destinations</h1>
    </center>
    <div class="container">

        <div id="cat">
            <h3 style="color:white; margin: 10px auto">Sort By:</h3>
            <a href="">Most visited</a>
            <a href="">Highest Rating</a>
            <a href="">Option 3</a>
        </div>

        <div class="container">
            <?php
            require 'assets/db/connect.php';
            $sqlQuery = "SELECT LocationID,Name,Description,ImageURL FROM locations LIMIT 30";

            $result = mysqli_query($conn, $sqlQuery);

            if ($result) {

                //data
                while ($row = mysqli_fetch_assoc($result)) {
                    $LocationName = $row['Name'];
                    $LocationID = $row['LocationID'];
                    $LocationDescription = $row['Description'];
                    $imageURL = $row['ImageURL'];
                    $firstImageURL = './assets/Images/destination/lieu-' . $LocationID . '/' . $imageURL . '';
                    // Display the hotel card HTML structure
            
                    ?>
                    <div class="info-card">

                        <div class="images">
                            <img class="hotel-image" src="<?= $firstImageURL ?>" alt="">
                        </div>

                        <div class="detail">
                            <h1 class="title">
                                <?= $LocationName ?>
                            </h1>
                            <div class="description">
                                <u>Description:</u><br>
                                <?= $LocationDescription ?>
                            </div>
                            <div class="services-dhotel">
                                <!-- ... Vos services ... -->
                            </div>
                            <div class="reserve-option">
                                <!-- ... Vos options de réservation ... -->
                            </div>
                            <a href="Vols.php?lieu=<?= $LocationID ?>" class="reserve-button">
                                Voir Les Vols
                            </a>
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
                    <b>Page
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