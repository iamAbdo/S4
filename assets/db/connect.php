<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "agencedevoyage";
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>