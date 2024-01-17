<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reservation.css">
    <title>Document</title>
</head>

<body>
<div class="background-image"></div>
<div class="overlay"></div>
<div class="box">
        <div class="form">
    <h2>Informations de réservation :</h2>

    <?php
    $arrivalDate = $_POST['arrival-date'];
    $departureDate = $_POST['departure-date'];
    $numPeople = $_POST['num-people'];
    $numRooms = $_POST['num-rooms'];

    echo "<p>Arrivée: " . $arrivalDate . "</p>"
        . "<p>Départ: " . $departureDate . "</p>"
        . "<p>Nombre de personnes: " . $numPeople . "</p>"
        . "<p>Nombre de chambres: " . $numRooms . "</p>";

    ?>
    
</div>
    </div>
    
</body>

</html>