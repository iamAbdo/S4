<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/addHotel.css">
</head>

<body>

    <div class="container">
        <form action="addHotel.php" method="GET">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                echo "<div class='section-title'>Editing Hotel $id</div>";
            } else {
                echo 'Id: <input type="number" name="id"><br>';
            }
            ?>
           


            </form>
        
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
    <h2>add hotel</h2>
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
    </div><div class="inputBox">
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
      <input type="text" required="required" />
      <span>ImageURLs</span>
      <i></i>
    </div>
    
     
    <input type="submit" value="ADD" />
  </div>
</div>


</body>


</html>
