<?php

/* emailing wont work with default php mail() function 
Causes:
- First we need an SMTP server
- Next we need to add  SSL or TLS encryption for it to work with company's like googe (gmail)


Solutions:
- Use a PHP library like PHPMailer
- just abandone the idea simply as with the given time frame its hard to realise
*/
$to = $_POST["email"];
$subject = "This is subject";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:abc@somedomain.com \r\n";
$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail($to, $subject, $message, $header);

if ($retval == true) {
    echo "Message sent successfully...";
} else {
    echo "Message could not be sent...";
}
?>