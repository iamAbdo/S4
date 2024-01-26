<?php
// Include your database connection code here
// Example: $conn = new mysqli("localhost", "username", "password", "database");
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

        $userID = $row['UserID'];
        $username = $row['Username'];
        $email = $row['Email'];
        $LastName = $row['LastName'];
        $FirstName = $row['FirstName'];
        $phone = $row['phone'];
        $dob = $row['birthdate'];
        $address = $row['address'];

        $role = $row['Role'];
    } else {
        header('Location: signIn.php');
        exit;
    }

    // Close the database connection

} else {
    header('Location: signIn.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $description = $_POST['description'];
    $etoiles = $_POST['etoiles'];

    // For demonstration purposes, let's assume the UserID and HotelID are known or retrieved from the session
    $hotelID = 1; // Replace with the actual HotelID

    // Insert data into the reviews table
    $insertQuery = "INSERT INTO reviews (UserID, HotelID, Rating, Comment, Date)
                    VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iiss", $userID, $hotelID, $etoiles, $description);

    if ($stmt->execute()) {
        echo "Review added successfully!";
    } else {
        echo "Error adding review: " . $stmt->error;
    }

    $stmt->close();
    // Redirect to the page where you want to display reviews
    header('Location: account.php');
    exit;
}

// Close the database connection if needed
$conn->close();
