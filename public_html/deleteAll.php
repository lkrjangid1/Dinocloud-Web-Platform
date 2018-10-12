<?php
session_start();
$servername = "localhost";
$username = "dyno";
$password = "Dinocloud.1995";
$dbname = "dinocloud";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Setam modul de eroare PDO ca exceptie
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userDeleteAllFiles = $_SESSION['userSession'];
    $sqli = "DELETE FROM uploads WHERE userID = $userDeleteAllFiles";

    // Pregatire declaratie
    $stmt = $conn->prepare($sqli);

    // Executam interogarea
    $stmt->execute();

    // Cu echo afisam un mesaj de success pentru inregistrarea planului
    echo "All files have beed deleted successfully.";
    header( "refresh:4;url=filemanager.php" );
    }
catch(PDOException $e)
    {
    echo $sqli . "<br>" . $e->getMessage();
    }

$conn = null;
?>
