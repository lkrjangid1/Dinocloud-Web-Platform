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
	
	$stmt = $user->runQuery("SELECT * FROM users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>We're Sorry! Password doesn't match. </strong>
						</div>";
			}
			else
			{
                $password= hash('sha512', $cpass);
				// $password = md5($cpass);
				$stmt = $user->runQuery("UPDATE users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success! Password has been changed<strong>
						</div>";
				header("refresh:5;index.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-block'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>No Account Found! Please try again.</strong>
				</div>";			
	}
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="resources/old-bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="resources/old-bootstrap/js/bootstrap.min.js"></script>
    <link href="resources/old-bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="resources/old-bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
  </head>
  <body id="login">
    <div class="container">
    
    <form class="form-signin" method="post">
        <center><h3 class="form-signin-heading">Password Reset</h3></center>
            <hr />
            <div class='alert alert-success'>
            <center><strong>Hello <?php echo $rows['userName'] ?>! Please enter your new password:</strong></center>
		</div>
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
        <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
     	<hr />
        <center><button class="btn btn-medium btn-primary" type="submit" name="btn-reset-pass">Reset My Password</button></center>
        <hr />
        <center><a href="index.php">Back to Login</a></center>
        
     </form>

    </div> <!-- Sfarsit Continut -->
  </body>

</html>