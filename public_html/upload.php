<?php
session_start();
include_once 'class.user.php';

//Setam folderul pentru incarcarea fisierelor, individual pentru fiecare utilizator in parte
$output_dir = "uploads/" . $_SESSION['userSession'] . "/";
$fileType = pathinfo($output_dir, PATHINFO_EXTENSION);

$userFiles = new USER();

if(isset($_FILES["myfile"]))
{
    $ret = array();
    $error = $_FILES["myfile"]["error"];

    // Incarcarea unui singur fisier
    if(!is_array($_FILES["myfile"]["name"])) //un singur fisier
    {
        $fileName = $_FILES["myfile"]["name"];
        $fileSize = $_FILES["myfile"]["size"];
        $fileType = $_FILES["myfile"]["type"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
        $userFiles->addFileToDatabase($fileName, $fileSize, $fileType);
        $ret[]= $fileName;
    }
    else
    {
        // Incarcarea mai multor fisiere
        $fileCount = count($_FILES["myfile"]["name"]);
        for($i=0; $i<$fileCount; $i++)
        {
            $fileName = $_FILES["myfile"]["name"][$i];
            $fileType = $_FILES["myfile"]["type"][$i];
            $fileSize = intval($_FILES["myfile"]["size"]); 
            move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
            $userFiles->addFileToDatabase($fileName, $fileSize, $fileType);
            $ret[]= $fileName;
        }
    }

    //Se livreaza numele fișierelor ca șiruri separate prin virgulă pentru a afișa starea/statusul
    echo json_encode($ret);
}
?>