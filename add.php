<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/add.css">
    <title>Document</title>
</head>

<body>
    <?php
    require "include/fonctions.php";
    require "assets/db/connect.php";

    // Vérifier si l'utilisateur est un administrateur
    checkUserRoleAndRedirect();

    if (isset($_POST['submit'])) {
        $Ajouter = ($_POST['submit']);
        switch ($Ajouter) {
            case 'Ajouter un Lieu':
                // Retrieve form data
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = basename($_FILES["images"]["name"]);

                // Insert data into the database
                $insertQuery = "INSERT INTO locations (Name, Description, ImageURL) VALUES ( ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("sss", $name, $description, $image);
                $stmt->execute();

                $locationID = $stmt->insert_id;
                $target_dir = "assets/Images/destination/lieu-" . $locationID . "/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $imagePath = $target_dir . basename($_FILES["images"]["name"]);
                move_uploaded_file($_FILES["images"]["tmp_name"], $imagePath);

                $stmt->close();

                break;
            case 'Ajouter un Hotel':
                // Retrieve form data
                $name = $_POST['name'];
                $location = $_POST['location'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $rating = $_POST['rating'];
                $image = $_FILES["images"];

                echo '<pre>';
                print_r($_FILES);
                echo '</pre>';
                // Upload images
                $newImageUrl = basename($_FILES["images"]["name"]);
                /*foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $imagePath = 
                    //move_uploaded_file($tmp_name, $imagePath);
                    $imagePaths[] = $imagePath;
                }*/

                $insertQuery = "INSERT INTO hotels (Name, LocationID, Description, Price, Rating, ImageURLs) VALUES (?, ?, ?, ?, ?, JSON_ARRAY('$newImageUrl'))";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("ssdis", $name, $location, $description, $price, $rating);
                $stmt->execute();

                // Get the inserted hotel ID
                $hotelID = $stmt->insert_id;
                echo "<script>alert($hotelID)</script>";
                $target_dir = "assets/Images/Hotels/hotel-$hotelID/";
                $imagePath = "assets/Images/Hotels/hotel-$hotelID/" . $_FILES['images']['name'];
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                move_uploaded_file($_FILES["images"]["tmp_name"], $imagePath);

                $stmt->close();


                break;

            default:
                # code...
                break;
        }
    }

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        switch ($type) {
            case 'hotel':
                ?>
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <h2>Formulaire Hôtel</h2>

                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="location">Location:</label>
                    <select id="location" name="location" required>
                        <?php
                        // Fetch location data from the database
                        $locationQuery = "SELECT LocationID, Name FROM locations";
                        $locationResult = mysqli_query($conn, $locationQuery);

                        if ($locationResult) {
                            while ($row = mysqli_fetch_assoc($locationResult)) {
                                echo '<option value="' . $row['LocationID'] . '">' . $row['Name'] . '</option>';
                            }
                        }
                        ?>
                        <!-- zid ya bouzid -->
                    </select>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="price">Prix:</label>
                    <input type="text" id="price" name="price" required>

                    <label for="rating">Évaluation (étoiles):</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>

                    <label for="images">Images:</label>
                    <input type="file" id="images" name="images" required>

                    <input type="submit" name="submit" value="Ajouter un Hotel">
                </form>
                <?php
                break;
            case 'location':
                ?>
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <h2>Formulaire Location</h2>

                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="images">Images:</label>
                    <input type="file" id="images" name="images" required>

                    <input type="submit" name="submit" value="Ajouter un Lieu">
                </form>



                <?php
                break;
            case 'flight':
                ?>
                <form method="POST" action="addVol.php">
                    <h2>Formulaire Vol</h2>

                    <label for="departure-location">Location de départ:</label>
                    <select id="departure-location" name="departure-location" required>
                        <option value="paris">Paris</option>
                        <option value="newyork">New York</option>
                        <option value="tokyo">Tokyo</option>
                        <!-- zid ya bouzid -->
                    </select>

                    <label for="arrival-location">Location d'arrivée:</label>
                    <select id="arrival-location" name="arrival-location" required>
                        <option value="paris">Paris</option>
                        <option value="newyork">New York</option>
                        <option value="tokyo">Tokyo</option>
                        <!-- zid ya bouzid -->
                    </select>

                    <label for="departure-date">Date de départ:</label>
                    <input type="datetime-local" id="departure-date" name="departure-date" required>

                    <label for="arrival-date">Date d'arrivée:</label>
                    <input type="datetime-local" id="arrival-date" name="arrival-date" required>

                    <label for="price">Prix:</label>
                    <input type="text" id="price" name="price" required>

                    <label for="airline">Compagnie aérienne:</label>
                    <input type="text" id="airline" name="airline" required>

                    <input type="submit" value="Soumettre">
                </form>
                <?php
                break;
            default:
                ?>
                <h1>Vous ne pouvez pas ajouter ce type d'information!</h1>
                <a href="admin.php"><button>Retourner à la page admin</button></a>
                <?php
                break;
        }
    } else {
        header('Location: admin.php');
        exit();
    }
    ?>
</body>

</html>