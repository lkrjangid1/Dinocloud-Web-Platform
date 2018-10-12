<?php 
// Definim variabilele pentru serverul de SMTP, pentru trimiterea unui mail/mesaj
$name = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent="Subject: $name \n Message: $message";
$recipient = "dinocloudonline@gmail.com";
$subject = "DinoCloud | FAQ Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "<center><h2>Thank you, your question has been sent to us!</center></h2>";
header( "refresh:3;url=faq.php" ); // Redirectionare dupa 3 secunde ca sa revenim la pagina anterioara
?>