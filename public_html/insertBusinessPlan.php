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

    $userSessionPlan = $_SESSION['userSession'];
    $sql = "UPDATE users SET userPlan='Business' WHERE userID=$userSessionPlan";

    // Pregatire declaratie
    $stmt = $conn->prepare($sql);

    // Executam interogarea
    $stmt->execute();

    // Cu echo afisam un mesaj de success pentru inregistrarea planului
    echo "<center><h2>Your 'Business Plan' has been successfully registered! Redirecting now...</h2></center>";
    header( "refresh:3;url=pricing.php" );
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
