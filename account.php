<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/account.css">
</head>

<body>

    <?php
    include "include/header.php";

    // Check if the 'token' cookie is present
    if (isset($_COOKIE['token'])) {
        // Establish a MySQL database connection (replace with your database details)
        $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user information from the database
        $token = $_COOKIE['token'];
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

        // Close the database connection
    
    } else {
        header('Location: sign In.html');
        exit;
    }


    $query = "SELECT status FROM bookings WHERE UserID = $UserID";
    // Execute the query
    $result = $conn->query($query);

    if ($result) {
        // Check if any row is returned
        if ($result->num_rows > 0) {
            // Fetch the status
            $row = $result->fetch_assoc();
            $status = $row['status'];
        } else {
            //echo "No booking found for the user.";
            $status = "pending";
        }
        // Free the result set
        $result->free();
    } else {
        echo "Error executing query: " . $conn->error;
    }
    ?>

    <?php
    if (isset($_GET["message"])) {
        $ErrorMessage = $_GET["message"];
        switch ($ErrorMessage) {
            case 'noperms':
                echo "<script>alert('Only an Admin can acces this page!')</script>";
                break;

            default:
                echo "<scrpit>$ErrorMessage</script>";
                break;
        }
    }
    ?>

    <div class="container">

        <div class="profile">

            <div class="profile-image">

                <img src="assets/Images/UserIcon.png" alt="UserIcon.png">

            </div>
            <div class="profile-info">
                <div class="profile-user-settings">

                    <h1 class="profile-user-name">
                        <?php echo $username ?>
                    </h1>

                    <a href="EditAccount.php">
                        <button class="btn profile-edit-btn">Edit Profile</button>
                    </a>
                    <?php if ($role == "admin") { ?>
                        <a href="admin.php">
                            <button class="btn profile-edit-btn">Page Admin</button>
                        </a>
                    <?php } ?>

                </div>

                <!--<div class="profile-stats">

                    <ul>
                        <li><span class="profile-stat-count">12</span> Reservations</li>
                        <li><span class="profile-stat-count">188</span> Comments</li>
                    </ul>

                </div>-->

                <div class="profile-bio">
                    <?php
                    //User Info
                    $prixTotal = 0.0;
                    function UserIfset($value, &$FullInfo)
                    {
                        if (isset($value)) {
                            echo $value;
                        } else {
                            echo "non défini";
                            $FullInfo = false;
                        }
                    }

                    $FullInfo = true;
                    ?>
                    <p>
                        <span class="profile-real-name">
                            <?php echo "Personal Information:<br>" ?>
                        </span>
                    <p class="info-label"><b>Email:</b>
                        <?= UserIfset($email, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Nom: </b>
                        <?= UserIfset($LastName, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Prénom: </b>
                        <?= UserIfset($FirstName, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>address: </b>
                        <?= UserIfset($address, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>date de naissance: </b>
                        <?= UserIfset($dob, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Numéro de téléphone: </b>
                        <?= UserIfset($phone, $FullInfo) ?>
                    </p>
                    <br>We hope you the Best Memories 📷✈️🏕️
                    </p>

                </div>
            </div>

        </div>
        <!-- End of profile section -->
    </div>
    <div class="Res-container">
        <h1>Your Reservation</h1>
        <br>
        <table>
            <tr>
                <th>Informations sur le Vol</th>
                <th>Informations sur l'Hôtel</th>
                <th>Prix Total</th>
            </tr>
            <tr>
                <!--<td>

                    <p class="info-label"><b>Email:</b>
                        <= UserIfset($email, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Nom: </b>
                        <= UserIfset($LastName, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Prénom: </b>
                        <= UserIfset($FirstName, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>address: </b>
                        <= UserIfset($address, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>date de naissance: </b>
                        <= UserIfset($dob, $FullInfo) ?>
                    </p>
                    <p class="info-label"><b>Numéro de téléphone: </b>
                        <= UserIfset($phone, $FullInfo) ?>
                    </p>
                </td>-->
                <td>
                    <?php
                    $sql = "SELECT b.BookingID, b.FlightID,
                        f.FlightID, f.DepartureLocationID, f.ArrivalLocationID, f.DepartureDateTime, f.ArrivalDateTime, f.Price, f.Airline,
                        dl.Name AS DepartureLocationName, al.Name AS ArrivalLocationName
                        FROM users u
                        JOIN bookings b ON u.UserID = b.UserID
                        LEFT JOIN flights f ON b.FlightID = f.FlightID
                        LEFT JOIN locations dl ON f.DepartureLocationID = dl.LocationID
                        LEFT JOIN locations al ON f.ArrivalLocationID = al.LocationID
                        WHERE u.cookie = '$token'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        if ($row['FlightID'] !== null) {
                            // User has booked a flight
                            $hasFlight = true;
                            $FlightID = $row['FlightID'];
                            $DepartureLocationID = $row['DepartureLocationID'];
                            $ArrivalLocationID = $row['ArrivalLocationID'];
                            $DepartureDateTime = $row['DepartureDateTime'];
                            $ArrivalDateTime = $row['ArrivalDateTime'];
                            $Price = $row['Price'];
                            $Airline = $row['Airline'];

                            $prixTotal += floatval($Price);

                            $DepartureLocationName = $row['DepartureLocationName'];
                            $ArrivalLocationName = $row['ArrivalLocationName'];
                        } else {
                            $hasFlight = false;
                        }
                    } else {
                        $hasFlight = false;
                    }
                    if ($hasFlight) { // 3ndo Reservation Vol ?>
                        <p><b>Numéro de Vol:</b>
                            <?= $FlightID ?>
                        </p>
                        <p class="info-label"><b>Du </b>
                            <?= $DepartureLocationName ?>
                            <b>Vers </b>
                            <?= $ArrivalLocationName ?>
                        </p>
                        <p class="info-label"><b> Date et Heure de Départ: </b><br>
                            Du
                            <?= $DepartureDateTime ?>
                            A
                            <?= $ArrivalDateTime ?>
                        </p>
                        <p class="info-label"><b>Compagnie Aérienne: </b>
                            <?= $Airline ?>
                        </p>
                        <p class="info-label"><b>Prix Vol: </b>
                            <?= $Price ?>
                        </p>


                    <?php } else { // Ma 3ndoch reservation Vol ?>
                        <div class="actions">
                            Vous avez pas un vol
                            <a href="vols.php" class="confirm-button">Book Now!</a>
                        </div>
                    <?php }
                    ?>
                </td>

                <td>
                    <?php
                    $sql = "SELECT b.BookingID, b.HotelID,
                    h.HotelID, h.Name AS HotelName, h.Price, h.Rating,
                    l.Name AS LocationName
                    FROM users u
                    JOIN bookings b ON u.UserID = b.UserID
                    LEFT JOIN hotels h ON b.HotelID = h.HotelID
                    LEFT JOIN locations l ON h.LocationID = l.LocationID
                    WHERE u.cookie = '$token'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        if ($row['HotelID'] !== null) {
                            // User has booked a hotel
                            $hasHotel = true;
                            $HotelID = $row['HotelID'];
                            $HotelName = $row['HotelName'];
                            $Price = $row['Price'];
                            $Rating = $row['Rating'];

                            $prixTotal += floatval($Price);

                            $LocationName = $row['LocationName'];
                        } else {
                            $hasHotel = false;
                        }
                    } else {
                        $hasHotel = false;
                    }
                    if ($hasHotel) { // 3ndo Reservation Vol ?>
                        <p class="info-label"><b>Nom de l'Hotel:</b>
                            <?= $HotelName ?>
                        </p>
                        <p class="info-label"><b>Emplacement :</b>
                            <?= $LocationName ?>
                        </p>
                        <p class="info-label"><b>Prix Hotel:</b>
                            <?= $Price ?>
                        </p>
                    <?php } else { // Ma 3ndoch reservation Vol ?>
                        <div class="actions">
                            Vous avez pas un Hotel
                            <a href="hotels.php" class="confirm-button">Book Now!</a>
                        </div>
                    <?php }
                    ?>

                </td>

                <td class="total-price">
                    <p class="info-label">Montant:
                        <?= $prixTotal ?>
                    </p>
                    <br>
                    <div class="actions">
                        <?php
                        if ($status == "pending") { ?>
                            <a <?php if (!$FullInfo) {
                                echo 'onclick="nonDefiniPopOp()" ';
                            } else {
                                echo 'href="confirm.php"';
                            } ?> class="confirm-button">Confirmer</a>
                            <button class="cancel-button">Annuler</button>
                        <?php } else {
                            echo "<h2>Reservation Confirmer</h2><a href='ticket.php' class='confirm-button'>Votre ticket</a>";
                        }
                        ?>

                    </div>
                </td>
            </tr>
        </table>

        <br>
    </div>

    <!-- 
        #################### 
        Les Commentaires
        #################### 
    -->

    <div class="comments-container">
        <h1>Your comments</h1>

        <ul id="comments-list" class="comments-list">
            <?php
            require "assets/db/connect.php";

            $sql = "SELECT ReviewID,reviews.Rating,Comment,Date,Name,ImageURLs,hotels.HotelID FROM reviews INNER JOIN hotels ON reviews.HotelID= hotels.HotelID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    $hotelID = $row['HotelID'];
                    $HotelName = $row['Name'];
                    $Rating = $row['Rating'];
                    $Comment = $row['Comment'];
                    $Date = $row['Date'];
                    $imageURLs = json_decode($row['ImageURLs']);
                    $HotelImg = './assets/Images/Hotels/hotel-' . $hotelID . '/' . $imageURLs[0] . '';

                    $filledStars = min(5, $Rating); // Limit to a maximum of 5 stars
                    $emptyStars = 5 - $filledStars;

                    echo '<li>
                        <div class="comment-avatar">
                            <img src="' . $HotelImg . '" alt="Hotel-image">
                        </div>
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name"><a href="">To
                                       ' . $HotelName . '
                                    </a></h6>
                                <span>
                                    ' . $Date . '
                                </span>
                                <div class="starts">';
                    for ($i = 1; $i <= $emptyStars; $i++) {
                        echo '<i class="far fa-star"></i>';
                    }
                    for ($i = 1; $i <= $filledStars; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }

                    echo '</div>
                            </div>
                            <div class="comment-content">
                                ' . $Comment . '
                            </div>
                        </div>
                    </li>';

                }
            } else {
                header('Location: login.php');
                exit;
            }

            // Close the database connection
            $conn->close();
            ?>
        </ul>
    </div>

    <?php
    include 'include/footer.php';
    ?>

</body>

</html>