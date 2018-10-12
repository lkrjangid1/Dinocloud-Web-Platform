<?php
session_start();
include_once 'class.user.php';

$outputDir = "uploads/" . $_SESSION['userSession'] . "/";
$fileName = $_POST['file'];
$file = $outputDir . $fileName;

if (file_exists($file))
{
    if (unlink($file))
    {
        // db
        $userFiles = new USER();
        $userFiles->removeFileFromDatabase($fileName);
    }
}

?>