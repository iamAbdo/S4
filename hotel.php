<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_GET['hotel'])) {
        $hotelID = $_GET['hotel'];
    } else {
        header("Location: hotels.php");
    }


    require 'assets/db/connect.php';

    $sqlQuery = "SELECT Name, Description, ImageURLs FROM Hotels WHERE HotelID = $hotelID";
    $result = mysqli_query($conn, $sqlQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hotelName = $row['Name'];
        $hotelDescription = $row['Description'];
        $imageURLs = json_decode($row['ImageURLs']);


        // Display the hotel card HTML structure
        echo "<div class='Hotel-card'>";
        echo '<div class="hotel-name">' . $hotelName . '</div>';
        echo '<div class="hotel-desc">' . $hotelDescription . '</div>';
        echo "<div class='images'>";
        // Check if there are images
        if ($imageURLs && is_array($imageURLs)) {
            // Loop through each image URL and display it
            foreach ($imageURLs as $imageURL) {
                $fullImageURL = "./assets/Images/Hotels/hotel-$hotelID/$imageURL";
                echo "<img src='$fullImageURL' alt='$fullImageURL' style='width: 300px; height: auto;'>";
            }
        } else {
            echo "No images available for this hotel.";
        }
        echo '</div>';
        echo '</div>';




    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($yourDbConnection);
    }
    $conn->close();
    ?>


</body>

</html>