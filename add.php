<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require "include/fonctions.php";
    // verifier si utilisateur admin
    checkUserRoleAndRedirect();

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        switch ($type) {
            case 'hotel': ?>

                <!--
                =========================================
                            FORMULAIRE HOTEL
                =========================================
                informations a remplir: 
                    - Name
                    - Location (options: paris newyork tokyo ...etc) select option
                    - description zone de text
                    - price 
                    - rating ( combien d'etoile )
                    - Images input type=file
                =========================================
                -->


                <?php break;
            case 'location': ?>

                <!--
                =========================================
                            FORMULAIRE Location
                =========================================
                informations a remplir: 
                    - Name
                    - description zone de text
                    - Images input type=file
                =========================================
                -->

                <?php break;
            case 'flight': ?>

                <!--
                =========================================
                            FORMULAIRE Vol
                =========================================
                informations a remplir: 
                    - Location de depart (select option) liste deroulent
                    - Location de arriver (select option) liste deroulent
                    - date depart
                    - date arriver
                    - prix
                    - companie airline (airalgerie emirates) 
                =========================================
                -->

                <?php break;
            default: ?>
                <h1>Vous pauver pas ajouter ce type d'information!</h1>
                <a href="admin.php"><button>Retourer a page admin</button></a>
                <? break;
        }

    } else {
        header('Location: admin.php');
        exit();
    }
    ?>
</body>

</html>