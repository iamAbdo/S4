<?php
//Check if user is admin

//get the values or redirect
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
} else {
    header("Location: admin.php");
    exit();
}

require 'assets/db/connect.php';

switch ($type) {
    case 'Hotel':
        $sqlQuery = "DELETE FROM hotels WHERE HotelID = $id";
        break;
    case 'User':
        $sqlQuery = "DELETE FROM users WHERE UserID = $id";
        break;
    case 'Location':
        $sqlQuery = "DELETE FROM locations WHERE LocationID = $id";
        break;
    default:
        header("Location: admin.php");
        break;
}
try {
    if (mysqli_query($conn, $sqlQuery)) {
        header("Location: admin.php");
    } else {
        throw new Exception(mysqli_query($conn, $sqlQuery));
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    if (strpos($error, "foreign key constraint") !== false) {
        preg_match("/CONSTRAINT `(.+?)` FOREIGN KEY/", $error, $matches);
        echo "Error: This $type has related data and cannot be deleted until the other stuff is.
        <br>Example: In $matches[1] table";
    } else {
        echo "Error: " . $error;
    }
}

?>