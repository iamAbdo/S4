<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/addHotel.css">
</head>

<body>

    <div class="container">
        <form action="addHotel.php" method="GET">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                echo "<div class='section-title'>Editing Hotel $id</div>";
            } else {
                echo 'Id: <input type="number" name="id"><br>';
            }
            ?>
            Name: <input type="text" name="name"><br>
            LocationID: <input type="number" name="locationId"><br>
            Description: <input type="text" name="description"><br>
            Price: <input type="text" name="price"><br>
            Rating: <input type="text" name="rating"><br>
            ImageURLs: <input type="text" name="imageURLs"><br>
            <input type="submit"><br>

        </form>
    </div>
</body>

</html>