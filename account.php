<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<?php
include "header.php";
// Check if the 'token' cookie is present
if (isset($_COOKIE['token'])) {
    // Establish a MySQL database connection (replace with your database details)
    $conn = new mysqli('localhost', 'root', '', 'agencedevoyage');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user information from the database
    $token = $conn->real_escape_string($_COOKIE['token']);
    $sql = "SELECT username,email FROM users WHERE cookie = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
    } else {
        header('Location: login.php');
        exit;
    }

    // Close the database connection
    $conn->close();
} else {
    header('Location: sign In.html');
    exit;
}
?>
<link rel="stylesheet" href="assets/css/account.css">

<body>

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

                    <button class="btn profile-edit-btn">Edit Profile</button>

                    <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog"
                            aria-hidden="true"></i></button>

                </div>

                <div class="profile-stats">

                    <ul>
                        <li><span class="profile-stat-count">12</span> Reservations</li>
                        <li><span class="profile-stat-count">188</span> Comments</li>
                    </ul>

                </div>

                <div class="profile-bio">

                    <p>
                        <span class="profile-real-name">
                            <?php echo "Personal Information:<br>" ?>
                        </span>
                        Your Email is :
                        <?php echo $email ?>,
                        <br>Date of Birth: 23-08-2002
                        <br>We hope you the Best Memories 📷✈️🏕️
                    </p>

                </div>
            </div>

        </div>
        <!-- End of profile section -->
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
    include 'footer.php';
    ?>
</body>