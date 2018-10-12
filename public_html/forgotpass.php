<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hello , $email
				   <br /><br />
				   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email!
				   <br /><br />
				   Click the following link to RESET your password: 
				   <br /><br />
				   <a href='http://dinocloud.tk/resetpass.php?id=$id&code=$code'>-> Click HERE to reset my password <-</a>
				   <br /><br />
				   Thank you, Dinocloud Support Team.
		            ";
		$subject = "Dinocloud Password Reset";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<center><strong>We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. </strong></center>
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<center><strong>We're Sorry!  This email was not found in our database.</strong> <center>
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Password Recovery</title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/old-bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="resources/old-bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="resources/old-bootstrap/js/bootstrap.min.js"></script>
    <link href="resources/old-bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
  </head>

  <body id="login">
    <div class="container">
      <form class="form-signin-forgot-pass" method="post">
       <center> <h3 class="form-signin-heading">Password Recovery</h3><hr /> </center>
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				A link will be sent to your email to create your new password.
				</div>  
                <?php
			}
			?>
          <div class="input-group-addon">
             <i class="input-block-lever glyphicon glyphicon-user"></i>
          </div>
        <input type="email" class="input-block-level" placeholder="Email address.." name="txtemail" required />  
     	<hr />
        
        <center><button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate New Password</button></center>
        <hr />
			<center><a href="index.php">Back to Login</a></center>
      </form>

    </div> <!-- Sfarsit continut -->
  </body>

</html>
