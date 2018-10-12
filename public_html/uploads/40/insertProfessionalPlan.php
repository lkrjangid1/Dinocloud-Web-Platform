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

    $userProPlan = $_SESSION['userSession'];
    $sqli = "UPDATE users SET userPlan='Professional' WHERE userID=$userProPlan";

    // Pregatire declaratie
    $stmt = $conn->prepare($sqli);

    // Executam interogarea
    $stmt->execute();

    // Cu echo afisam un mesaj de success pentru inregistrarea planului
    echo "<center><h2>Your 'Professional Plan' has been successfully registered! Redirecting now...</h2></center>";
    header( "refresh:3;url=pricing.php" );
    }
catch(PDOException $e)
    {
    echo $sqli . "<br>" . $e->getMessage();
    }

$conn = null;
?>
