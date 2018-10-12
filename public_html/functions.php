<?php 
//Functie pentru log-uri de utilizatori, adresa IP -  get server  remote address, date() - data la care s-a conectat si dispozitivul de pe care s-a conectat
$fo = fopen("logs/Logs.txt", "a");
$date = (new DateTime())->setTimeZone(new DateTimeZone('Europe/Bucharest'))->format('Y-m-d H:i:s');
fwrite($fo, "\n" . 'TIME: ' . $date . ', ' .'IP: ' . $_SERVER['REMOTE_ADDR']. ', ' .'DEVICE: ' .$_SERVER['HTTP_USER_AGENT']. "\n"); 
fclose($fo);
?>