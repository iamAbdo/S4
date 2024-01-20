<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/3reservation.css">
    <title>Réservation de Vol</title>
</head>

<body>

    <?php
    include 'include/header.php';
    ?>
    <div id="formulaire">
        <form>
            <h2>Modifier Informations Personnelles</h2>

            <label for="last-name">Nom:</label>
            <input type="text" id="last-name" name="last-name" required>

            <label for="first-name">Prénom:</label>
            <input type="text" id="first-name" name="first-name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone-number">Numéro de téléphone:</label>
            <input type="tel" id="phone-number" name="phone-number" required>

            <label for="birthdate">Date de naissance:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <input type="submit" value="Enregistrer les modifications">
        </form>
    </div>

    <?php
    include 'include/footer.php';
    ?>
</body>

</html>