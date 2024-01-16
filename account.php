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
                    Welcome
                    <span class="profile-real-name">
                        <?php echo $username ?>
                    </span>
                    you Email is :
                    <?php echo $email ?>,
                    We hope you the Best Memories 📷✈️🏕️
                </p>

            </div>
        </div>
        <!-- End of profile section -->
    </div>


    <!-- 
        #################### 
        Les Commentaires
        #################### 
    -->
    <?php
    require "assets/db/connect.php";

    $sql = "SELECT ReviewID,reviews.Rating,Comment,Date,Name,ImageURLs FROM reviews INNER JOIN hotels ON reviews.HotelID= hotels.HotelID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $HotelName = $row['Name'];
        $reviews = $row['reviews'];
        $reviews = $row['Comment'];
        $HotelImg = $row[''];
    } else {
        header('Location: login.php');
        exit;
    }

    // Close the database connection
    $conn->close();
    ?>
    <div class="comments-container">
        <h1>Your comments</h1>

        <ul id="comments-list" class="comments-list">
            <li>
                <div class="comment-avatar">
                    <img src="Hotel-image" alt="Hotel-image">
                </div>
                <div class="comment-box">
                    <div class="comment-head">
                        <h6 class="comment-name"><a href="">To Hotel Name</a></h6>
                        <span>il y a 10minutes</span>
                        <div class="starts">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="comment-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium
                        vitae, praesentium optio, sapiente distinctio illo?
                    </div>
                </div>
            </li>
            <li>
                <div class="comment-avatar">
                    <img src="Hotel-image" alt="Hotel-image">
                </div>
                <div class="comment-box">
                    <div class="comment-head">
                        <h6 class="comment-name"><a href="">To Hotel Name</a></h6>
                        <span>il y a 10minutes</span>
                        <div class="starts">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="comment-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium
                        vitae, praesentium optio, sapiente distinctio illo?
                    </div>
                </div>
            </li>
            <li>
                <div class="comment-avatar">
                    <img src="Hotel-image" alt="Hotel-image">
                </div>
                <div class="comment-box">
                    <div class="comment-head">
                        <h6 class="comment-name"><a href="">To Hotel Name</a></h6>
                        <span>il y a 10minutes</span>
                        <div class="starts">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="comment-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium
                        vitae, praesentium optio, sapiente distinctio illo?
                    </div>
                </div>
            </li>
        </ul>
    </div>

</body>