<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/tableaux.css">
</head>

<body>
    <?php
    include 'header.php';
    //check if user is admin or redirect; mazal
    require 'assets/db/connect.php';
    ?>

    <div class="container">
        <div class="container-title">
            Les Hotels
            <div class="open-container">
                <svg onclick="OpenHotel()" id="HotelClosed" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="opener" onclick="CloseHotel()" id="HotelOpen" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div id="Hotel-data" class="container-data">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hotel Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sqlQuery = "SELECT HotelID, Name FROM Hotels LIMIT 10";

                    $result = mysqli_query($conn, $sqlQuery);


                    if ($result) {

                        //data
                        while ($row = mysqli_fetch_assoc($result)) {
                            $hotelName = $row['Name'];
                            $hotelID = $row['HotelID'];
                            $type = "Hotel";
                            // Display the hotel card HTML structure
                            echo '<tr>';
                            echo "<td>$hotelID</td>";
                            echo "<td>$hotelName</td>";
                            echo "<td>$hotelName</td>";
                            echo "<td>$hotelName</td>";
                            echo '<td>
                                    <a href="addHotel.php?id=' . $hotelID . '">
                                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <a href="delete.php?type=' . $type . '&id=' . $hotelID . '">
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 3L21 21M18 6L17.6 12M17.2498 17.2527L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6H4M16 6L15.4559 4.36754C15.1837 3.55086 14.4194 3 13.5585 3H10.4416C9.94243 3 9.47576 3.18519 9.11865 3.5M11.6133 6H20M14 14V17M10 10V17"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    </a>
                                </td></tr>';
                        }
                        // Free result set
                        mysqli_free_result($result);

                    } else {
                        // Handle the case where the query fails
                        echo "<h1>Pas d'Hotels</h1>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="ajouter">
                <button><a href="addHotel.php">Ajouter +</a></button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-title">
            Les Reservations
            <div class="open-container">
                <svg onclick="OpenBooking()" id="BookingClosed" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="opener" onclick="CloseBooking()" id="BookingOpen" width="32px" height="32px"
                    viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div id="Booking-data" class="container-data">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Hotel</th>
                        <th>Airline</th>
                        <th>Date: CheckIn - CheckOut</th>
                        <th>Price</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sqlQuery = "SELECT 
                                    bookings.BookingID,
                                    users.email,
                                    users.UserName,
                                    hotels.Name AS HotelName,
                                    flights.Airline,
                                    bookings.CheckInDate,
                                    bookings.CheckOutDate,
                                    bookings.TotalPrice
                                    FROM bookings
                                    INNER JOIN users ON bookings.UserID = users.UserID
                                    LEFT JOIN hotels ON bookings.HotelID = hotels.HotelID
                                    LEFT JOIN flights ON bookings.FlightID = flights.FlightID;
                                ";

                    $result = mysqli_query($conn, $sqlQuery);


                    if ($result) {

                        //data
                        while ($row = mysqli_fetch_assoc($result)) {
                            $bookingID = $row['BookingID'];
                            $email = $row['email'];
                            $userName = $row['UserName'];
                            $hotelName = $row['HotelName'];
                            $airline = $row['Airline'];
                            $checkInDate = $row['CheckInDate'];
                            $checkOutDate = $row['CheckOutDate'];
                            $totalPrice = $row['TotalPrice'];
                            $type = "Booking";

                            // Display the hotel card HTML structure
                            echo '<tr>';
                            echo "<td>$bookingID</td>";
                            echo "<td>$email</td>";
                            echo "<td>$userName</td>";
                            echo "<td>$hotelName</td>";
                            echo "<td>$airline</td>";
                            echo "<td>$checkInDate - $checkOutDate</td>";
                            echo "<td>$totalPrice</td>";

                            echo '<td>
                                    <a href="addHotel.php?id=' . $bookingID . '">
                                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <a href="delete.php?type=' . $type . '&id=' . $bookingID . '">
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 3L21 21M18 6L17.6 12M17.2498 17.2527L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6H4M16 6L15.4559 4.36754C15.1837 3.55086 14.4194 3 13.5585 3H10.4416C9.94243 3 9.47576 3.18519 9.11865 3.5M11.6133 6H20M14 14V17M10 10V17"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    </a>
                                </td></tr>';
                        }
                        // Free result set
                        mysqli_free_result($result);

                    } else {
                        // Handle the case where the query fails
                        echo "<h1>Pas de reservations</h1>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="ajouter">
                <button><a href="addHotel.php">Ajouter +</a></button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-title">
            Les Locations
            <div class="open-container">
                <svg onclick="OpenLoc()" id="LocClosed" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="opener" onclick="CloseLoc()" id="LocOpen" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div id="Loc-data" class="container-data">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loc Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sqlQuery = "SELECT LocationID,Name FROM locations LIMIT 10";

                    $result = mysqli_query($conn, $sqlQuery);


                    if ($result) {

                        //data
                        while ($row = mysqli_fetch_assoc($result)) {
                            $LocationName = $row['Name'];
                            $LocationID = $row['LocationID'];
                            $type = "Location";

                            echo '<tr>';
                            echo "<td>$LocationID</td>";
                            echo "<td>$LocationName</td>";
                            echo "<td>$LocationName</td>";
                            echo "<td>$LocationName</td>";
                            echo '<td>
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <a href="delete.php?type=' . $type . '&id=' . $LocationID . '">
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 3L21 21M18 6L17.6 12M17.2498 17.2527L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6H4M16 6L15.4559 4.36754C15.1837 3.55086 14.4194 3 13.5585 3H10.4416C9.94243 3 9.47576 3.18519 9.11865 3.5M11.6133 6H20M14 14V17M10 10V17"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    </a>
                                </td></tr>';
                        }
                        // Free result set
                        mysqli_free_result($result);

                    } else {
                        // Handle the case where the query fails
                        echo "<h1>Il exist Pas de location dans la base</h1>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="container-title">
            Les Utilisateurs
            <div class="open-container">
                <svg onclick="OpenUser()" id="UserClosed" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="opener" onclick="CloseUser()" id="UserOpen" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div id="User-data" class="container-data">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Email</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sqlQuery = "SELECT UserID,Username,email,Role FROM users ORDER BY Role DESC LIMIT 10";

                    $result = mysqli_query($conn, $sqlQuery);


                    if ($result) {

                        //data
                        while ($row = mysqli_fetch_assoc($result)) {
                            $UserName = $row['Username'];
                            $UserID = $row['UserID'];
                            $email = $row['email'];
                            $Role = $row['Role'];
                            $type = "User";

                            echo '<tr>';
                            echo "<td>$UserID</td>";
                            echo "<td>$UserName</td>";
                            echo "<td>$email</td>";
                            echo "<td ";
                            if ($Role == 'admin') {
                                echo "style='font-weight: bolder;'";
                            }
                            echo ">$Role</td>";
                            echo '<td>
                                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <a href="delete.php?type=' . $type . '&id=' . $UserID . '">
                                            <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 3L21 21M18 6L17.6 12M17.2498 17.2527L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6H4M16 6L15.4559 4.36754C15.1837 3.55086 14.4194 3 13.5585 3H10.4416C9.94243 3 9.47576 3.18519 9.11865 3.5M11.6133 6H20M14 14V17M10 10V17"
                                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </td></tr>';
                        }
                        // Free result set
                        mysqli_free_result($result);

                    } else {
                        // Handle the case where the query fails
                        echo "<h1>Il exist Pas de location dans la base</h1>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="container-title">
            Les Commentaires
            <div class="open-container">
                <svg onclick="OpenReview()" id="ReviewClosed" width="32px" height="32px" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="opener" onclick="CloseReview()" id="ReviewOpen" width="32px" height="32px"
                    viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div id="Review-data" class="container-data">
            <table>
                <thead>
                    <tr>
                        <th>Review ID</th>
                        <th>User Name</th>
                        <th>Hotel Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Edit</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlQuery = "SELECT R.ReviewID, U.UserID, U.UserName, H.HotelID, H.Name AS HotelName, R.Rating, R.Comment, R.Date
                             FROM Reviews R
                             JOIN Users U ON R.UserID = U.UserID
                             JOIN Hotels H ON R.HotelID = H.HotelID
                             LIMIT 10";
                    $result = mysqli_query($conn, $sqlQuery);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $reviewID = $row['ReviewID'];
                            $userID = $row['UserID'];
                            $userName = $row['UserName'];
                            $hotelID = $row['HotelID'];
                            $hotelName = $row['HotelName'];
                            $rating = $row['Rating'];
                            $comment = $row['Comment'];
                            $date = $row['Date'];
                            $type = "Review";

                            echo '<tr>';
                            echo "<td>$reviewID</td>";
                            echo "<td>$userName</td>";
                            echo "<td>$hotelName</td>";
                            echo "<td>$rating</td>";
                            echo "<td>$comment</td>";
                            echo "<td>$date</td>";
                            echo '<td>
                                <a href="editReview.php?id=' . $reviewID . '">
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Your edit icon/svg path here -->
                                    </svg>
                                </a>
                                <a href="delete.php?type=' . $type . '&id=' . $reviewID . '">
                                    <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Your delete icon/svg path here -->
                                    </svg>
                                </a>
                            </td></tr>';
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "<h1>Pas d'Avis</h1>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="ajouter">
                <button><a href="addHotel.php">Ajouter +</a></button>
            </div>
        </div>
    </div>

    <script>
        function OpenHotel() {
            const hotelsection = document.getElementById("Hotel-data");
            const ClosedIcon = document.getElementById("HotelClosed");
            const OpenIcon = document.getElementById("HotelOpen");

            hotelsection.style.display = 'block';
            ClosedIcon.style.display = 'none';
            OpenIcon.style.display = 'block';
        }
        function CloseHotel() {
            const hotelsection = document.getElementById("Hotel-data");
            const ClosedIcon = document.getElementById("HotelClosed");
            const OpenIcon = document.getElementById("HotelOpen");

            hotelsection.style.display = 'none';
            ClosedIcon.style.display = 'block';
            OpenIcon.style.display = 'none';
        }
        function OpenLoc() {
            const Locsection = document.getElementById("Loc-data");
            const ClosedIcon = document.getElementById("LocClosed");
            const OpenIcon = document.getElementById("LocOpen");

            Locsection.style.display = 'block';
            ClosedIcon.style.display = 'none';
            OpenIcon.style.display = 'block';
        }
        function CloseLoc() {
            const Locsection = document.getElementById("Loc-data");
            const ClosedIcon = document.getElementById("LocClosed");
            const OpenIcon = document.getElementById("LocOpen");

            Locsection.style.display = 'none';
            ClosedIcon.style.display = 'block';
            OpenIcon.style.display = 'none';
        }
        function OpenUser() {
            const Usersection = document.getElementById("User-data");
            const ClosedIcon = document.getElementById("UserClosed");
            const OpenIcon = document.getElementById("UserOpen");

            Usersection.style.display = 'block';
            ClosedIcon.style.display = 'none';
            OpenIcon.style.display = 'block';
        }
        function CloseUser() {
            const Usersection = document.getElementById("User-data");
            const ClosedIcon = document.getElementById("UserClosed");
            const OpenIcon = document.getElementById("UserOpen");

            Usersection.style.display = 'none';
            ClosedIcon.style.display = 'block';
            OpenIcon.style.display = 'none';
        }
        function OpenBooking() {
            const Bookingsection = document.getElementById("Booking-data");
            const ClosedIcon = document.getElementById("BookingClosed");
            const OpenIcon = document.getElementById("BookingOpen");

            Bookingsection.style.display = 'block';
            ClosedIcon.style.display = 'none';
            OpenIcon.style.display = 'block';
        }
        function CloseBooking() {
            const Bookingsection = document.getElementById("Booking-data");
            const ClosedIcon = document.getElementById("BookingClosed");
            const OpenIcon = document.getElementById("BookingOpen");

            Bookingsection.style.display = 'none';
            ClosedIcon.style.display = 'block';
            OpenIcon.style.display = 'none';
        }
        function OpenBooking() {
            const Bookingsection = document.getElementById("Booking-data");
            const ClosedIcon = document.getElementById("BookingClosed");
            const OpenIcon = document.getElementById("BookingOpen");

            Bookingsection.style.display = 'block';
            ClosedIcon.style.display = 'none';
            OpenIcon.style.display = 'block';
        }
        function CloseReview() {
            const Reviewsection = document.getElementById("Review-data");
            const ClosedIcon = document.getElementById("ReviewClosed");
            const OpenIcon = document.getElementById("ReviewOpen");

            Reviewsection.style.display = 'none';
            ClosedIcon.style.display = 'block';
            OpenIcon.style.display = 'none';
        }
    </script>

</body>

</html>