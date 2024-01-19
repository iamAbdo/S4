<?php
// Set the cookie with an expiration time in the past
setcookie("token", "", time() - 3600, "/");


header('Location: index.php');
exit;
?>