<?php
session_start();

$outputDir = "uploads/" . $_SESSION['userSession'] . "/";
$fileName = $_GET['file'];
$file = $outputDir . $fileName;

if(!$file){ // Daca fisierul nu exista
    die(' Error 404: File not found! ');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");

    // Se citeste fisierul de pe disc
    readfile($file);
}
?>