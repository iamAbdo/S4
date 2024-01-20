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

    if (isset($_COOKIE['token'])) {
        // Establish a MySQL database connection (replace with your database details)
        $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user information from the database
        $token = $conn->real_escape_string($_COOKIE['token']);

        // if he submitted his informations
        if (isset($_POST['submit'])) {
            // Process form data here
            $userName = isset($_POST['UserName']) ? $_POST['UserName'] : null;
            $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : null;
            $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            $phoneNumber = isset($_POST['phone-number']) ? $_POST['phone-number'] : null;
            $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;

            // Check for missing values
            $missingFields = [];
            if (!$userName)
                $missingFields[] = 'Pseudo';
            if (!$lastName)
                $missingFields[] = 'Nom';
            if (!$firstName)
                $missingFields[] = 'Prénom';
            if (!$email)
                $missingFields[] = 'Email';
            if (!$address)
                $missingFields[] = 'Adresse';
            if (!$phoneNumber)
                $missingFields[] = 'Numéro de téléphone';
            if (!$birthdate)
                $missingFields[] = 'Date de naissance';

            if (!empty($missingFields)) {
                echo "Missing Fields:<br>";
                foreach ($missingFields as $field) {
                    echo "$field is missing<br>";
                }
            } else {
                //add to db
                $stmtUpdate = $conn->prepare("UPDATE users SET UserName = ?, LastName = ?, FirstName = ?, Email = ?, address = ?, phone = ?, birthdate = ? WHERE cookie = ?");
                $stmtUpdate->bind_param("ssssssss", $userName, $lastName, $firstName, $email, $address, $phoneNumber, $birthdate, $token);
                $stmtUpdate->execute();
                $stmtUpdate->close();

                header('Location: account.php');
                exit;
            }
        }

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
    } else {
        header('Location: sign In.html');
        exit;
    }
    function EchoIfset($value)
    {
        if (isset($value)) {
            echo $value;
        }
    }
    ?>


    <div id="formulaire">
        <form action="EditAccount.php" method="POST">
            <h2>Modifier Informations Personnelles</h2>

            <label for="UserName">Pseudo:</label>
            <input type="text" id="UserName" name="UserName" value="<?= EchoIfset($username) ?>" required>

            <label for="last-name">Nom:</label>
            <input type="text" id="last-name" name="last-name" value="<?= EchoIfset($LastName) ?>" required>

            <label for="first-name">Prénom:</label>
            <input type="text" id="first-name" name="first-name" value="<?= EchoIfset($FirstName) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= EchoIfset($email) ?>" required>

            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address" value="<?= EchoIfset($address) ?>" required>

            <label for="phone-number">Numéro de téléphone:</label>
            <input type="tel" id="phone-number" name="phone-number" value="<?= EchoIfset($phone) ?>" required>

            <label for="birthdate">Date de naissance:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?= EchoIfset($dob) ?>" required>

            <input type="submit" name="submit" value="Enregistrer">
        </form>
    </div>

    <?php
    include 'include/footer.php';
    ?>

</body>

</html>