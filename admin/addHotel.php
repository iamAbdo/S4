<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/addHotel.css">
</head>

<?php
require 'assets/db/connect.php';
?>

<body>



  </div>
  <div class="background-image"></div>

  <header class="Header">
    <div class="left-side">

      <div class="logo">
        <img src="./assets/Images/logo-removebg-preview.png" alt="logo" class="logo_img">
        <div class="logo_name">
          <a href="index.html">Travel <div>Agent</div></a>
        </div>
      </div>

    </div>

    <div class="right-side">

    </div>
  </header>


  <div class="box">
    <div class="form">
      <form action="addHotel.php" method="POST" enctype="multipart/form-data">
        <h2>add hotel</h2>
        <div class="inputBox">
          <input type="text" name="HotelId" required="required" />
          <span>id</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="HotelName" required="required" />
          <span>name</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="LocationID" required="required" />
          <span>LocationID</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="Description" required="required" />
          <span>Description</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="Price" required="required" />
          <span>Price</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="Rating" required="required" />
          <span>Rating</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="file" name="image" required="required" />
          <span>Images</span>
          <i></i>
        </div>
        <!-- Add other input fields as needed -->
        <input type="submit" name="submit" value="Submit">
      </form>

    </div>
  </div>
  <?php
  require 'assets/db/connect.php';
  echo "<script>alert('php excuting')</script>";
  if (isset($_POST['submit'])) {
    echo "<script>alert('submit')</script>";
    if (
      isset($_POST["HotelId"]) &&
      isset($_POST["HotelName"]) &&
      isset($_POST["LocationID"]) &&
      isset($_POST["Description"]) &&
      isset($_POST["Price"]) &&
      isset($_POST["Rating"]) &&
      isset($_FILES["image"])
    ) {
      echo "<script>alert('variables are set')</script>";
      $hotelId = $_POST["HotelId"];
      $hotelName = $_POST["HotelName"];
      $locationId = $_POST["LocationID"];
      $description = $_POST["Description"];
      $price = $_POST["Price"];
      $rating = $_POST["Rating"];
      $image = $_FILES["image"];

      $checkQuery = "SELECT * FROM hotels WHERE HotelId = '$hotelId'";
      $result = mysqli_query($conn, $checkQuery);

      if (mysqli_num_rows($result) == 0) {
        // Hotel doesn't exist, add it to the database
        $insertQuery = "INSERT INTO hotels (HotelId, Name, LocationID, Description, Price, Rating, ImageURLs) 
                        VALUES ('$hotelId', '$hotelName', '$locationId', '$description', '$price', '$rating', '[]')";
        mysqli_query($conn, $insertQuery);

        // Move the uploaded image to the specified folder
        $target_dir = "assets/Images/Hotels/" . "hotel-$hotelId/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (!is_dir($target_dir)) {
          mkdir($target_dir, 0755, true);
        }
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES["image"]["size"] > 5000000) { // this is 5MB
          echo "Sorry, your file is too large.";
          echo "<script>alert('too large')</script>";
          $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          echo "Sorry, only JPG, JPEG & PNG files are allowed.";
          echo "<script>alert('only jpg jpeg and png')</script>";
          $uploadOk = 0;
        }

        // not ok to upload case
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          echo "<script>alert('not uploaded')</script>";
          // if everything is ok, try to upload file
        } else {

          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // send to db
            $newImageUrl = basename($_FILES["image"]["name"]);
            $updateQuery = "UPDATE hotels SET ImageURLs = JSON_ARRAY('$newImageUrl') WHERE HotelId = '$hotelId'";
            mysqli_query($conn, $updateQuery);

            // show message
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            echo "<script>alert('uploaded')</script>";
          } else {
            // case where uploading didnt work (server error)
            echo "Sorry, there was an error uploading your file.";
            echo "<script>alert('server error')</script>";
          }
        }
      } else {
        echo "Error: Hotel with ID $hotelId already exists in the database.";
        echo "<script>alert('id used')</script>";
      }
    } else {
      echo "Error: Some required fields are missing.";
      echo "<script>alert('idk')</script>";
    }
  }

  ?>
</body>


</html>