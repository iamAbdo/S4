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

    // Vérifier si l'utilisateur est un administrateur
    checkUserRoleAndRedirect();

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        switch ($type) {
            case 'hotel':
                ?>
                <form>
                    <h2>Formulaire Hôtel</h2>

                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="location">Location:</label>
                    <select id="location" name="location" required>
                        <option value="paris">Paris</option>
                        <option value="newyork">New York</option>
                        <option value="tokyo">Tokyo</option>
                        <!-- zid ya bouzid -->
                    </select>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="price">Prix:</label>
                    <input type="text" id="price" name="price" required>

                    <label for="rating">Évaluation (étoiles):</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>

                    <label for="images">Images:</label>
                    <input type="file" id="images" name="images" accept="image/*" multiple required>

                    <input type="submit" value="Soumettre">
                </form>
                <?php
                break;
            case 'location':
                ?>
                <form>
                    <h2>Formulaire Location</h2>

                        <label for="name">Nom:</label>
                        <input type="text" id="name" name="name" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required></textarea>

                        <label for="images">Images:</label>
                        <input type="file" id="images" name="images" accept="image/*" multiple required>

                        <input type="submit" value="Soumettre">
                </form>



                <?php
                break;
            case 'flight':
                ?>
                <form>
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
                    <input type="date" id="departure-date" name="departure-date" required>

                    <label for="arrival-date">Date d'arrivée:</label>
                    <input type="date" id="arrival-date" name="arrival-date" required>

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
