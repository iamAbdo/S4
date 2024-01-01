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
          <input type="text" required="required" />
          <span>id</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>name</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>LocationID</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>Description</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>Price</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>Rating</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="file" name="image" required="required" />
          <span>Images</span>
          <i></i>
        </div>


        <input type="submit" value="ADD" name="submit" />
      </form>
    </div>
  </div>
  <?php
  echo "<script>alert('inside php')</script>";
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Work in progress (handle image upload):
  if ($_FILES["image"]["size"] > 5000000) { // this is 5MB
    echo "Sorry, your file is too large.";
    echo "<script>alert('too large')</script>";
    $uploadOk = 0;
  }
  // Limit File Type JPG, JPEG, PNG
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    echo "<script>alert('only jpg jpeg and png')</script>";
    $uploadOk = 0;
  }

  if (isset($_POST['submit'])) {
    // not ok to upload case
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      echo "<script>alert('not uploaded')</script>";
      // if everything is ok, try to upload file
    } else {

      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        echo "<script>alert('uploaded')</script>";
      } else {
        // case where uploading didnt work (server error)
        echo "Sorry, there was an error uploading your file.";
        echo "<script>alert('server error')</script>";
      }
    }

  }

  ?>
</body>


</html>