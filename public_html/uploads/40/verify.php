<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT userID,userStatus FROM users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			$msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>Congratulation! Your account is now Activated.</strong><a href='index.php'> Click to Login</a>
			       </div>
			       ";	
		}
		else
		{
			$msg = "
		           <div class='alert alert-error'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>We are sorry but your account is already Activated. </strong><a href='index.php'>Login here</a>
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-error'>
			   <button class='close' data-dismiss='alert'>&times;</button>
			   <strong>We're sorry! No Account Found: </strong><a href='signup.php'>Register here</a>
			   </div>
			   ";
	}	
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>DinoCloud Confirm Registration</title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
    <script src="resources/bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body id="login">
    <div class="container">
		<?php if(isset($msg)) { echo $msg; } ?>
    </div> <!-- Sfarsit CONTAINER -->
 
  </body>
</html>
