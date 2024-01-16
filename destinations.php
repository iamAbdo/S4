<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/shop.css">
    <title>Document</title>
</head>

<body>

    <?php
    include 'header.php';
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
        <div id="Hotel-cards">
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
                    echo "<a href='vols.php?location=$LocationID'><div class='Hotel-card'>";
                    echo '<div class="hotel-img" style="background-image: url(' . $firstImageURL . ');"></div>';
                    echo '<div class="hotel-name">' . $LocationName . '</div>';
                    echo '<div class="hotel-desc">' . $LocationDescription . '</div>';
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