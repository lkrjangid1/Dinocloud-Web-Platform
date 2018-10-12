<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$uaddress = trim($_POST['txtuaddress']);
        $uphone = trim($_POST['txtuphone']);
        $ucountry = trim($_POST['txtucountry']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));

	$stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>We're sorry! This email allready exists. Please Try another one.</strong> 
			  </div>
			  ";
	}

	else
	{
		if($reg_user->register($uname,$uaddress,$uphone,$ucountry,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to Dinocloud!<br/>
						To complete your registration just click the following link: <br/>
						<br /><br />
						<a href='http://dinocloud.tk/verify.php?id=$id&code=$code'> Click HERE to Activate your account!</a>
						<br /><br />
						Thank you,
						DinoCloud Team.
                                     ";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
				<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Success! </strong> We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account.
			  	</div>
					";
		}
		else
		{
			echo "We are sorry , Query could not be executed!";
		}		
	}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Dinocoloud | Register</title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/old-bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="resources/old-bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
    <script src="resources/old-bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body id="login">

    <div class="container">
		<?php if(isset($msg)) echo $msg;  ?>

     <form class="form-signin" method="post">
     <br \>
       <center><h3 class="form-signin-heading">Register Account</h3></center>   
         <hr />
        <input type="text" class="input-block-level" placeholder="Full Name" name="txtuname" required />    
	    <input type="text" class="input-block-level" placeholder="Address" name="txtuaddress" required />
        <input type="text" class="input-block-level" placeholder="Phone Number" name="txtuphone" required />
        <input type="text" class="input-block-level" placeholder="Country" name="txtucountry" required />
        <input type="email" class="input-block-level" placeholder="*Email Address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="*Password" name="txtpass" required />
     	<hr />
      <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Register</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Back to Login</a>
    </form>

    </div> <!-- Sfarsit CONTAINER -->

  </body>
</html>
