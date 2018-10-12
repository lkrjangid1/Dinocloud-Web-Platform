<?php
session_start();

$outputDir = "https://dinocloud.tk/uploads/" . $_SESSION['userSession'] . "/";
$fileName = $_POST['file'];
$file = $outputDir . $fileName;

echo $file;

?>