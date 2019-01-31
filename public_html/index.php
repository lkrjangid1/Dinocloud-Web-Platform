<?php
session_start();
require_once 'class.user.php';
//require_once 'functions.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);

	if($user_login->login($email,$upass))
	{
		$user_login->redirect('home.php');
	}
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Dinocloud Login</title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/old-bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="resources/old-bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
    <script src="resources/old-bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="resources/old-bootstrap/js/bootstrap.min.js"></script>
  </head>
  
  <body id="login">
    <div class="container">
    
       <!--<div class="imgcontainer"> -->
     
     <!--  </div>  -->
         
		 <?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<center><strong>This Account is not activated. Please check your Inbox/Spam/Bulk and activate it.
				    Feel free to contact dinocloudonline@gmail.com for support!
				</strong></center>
			</div>
            <?php
		}
	       ?>
   
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
	?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong credentials inserted!</strong> 
			</div>
            <?php
		}
	       ?>
       <!-- <center> <img src="/resources/images/dinocloud_logo.png" alt="Avatar" class="dinocloud_avatar" height="150" width="155"> </center> -->
        <br />
        <center><h3 class="form-signin-heading"> Login </h3></center>
      
        <hr /> 
      
        <input type="email" class="input-block-level" placeholder="Email address.." name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password.." name="txtupass" required />
     	<hr />

        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Login</button>
        <a href="signup.php" style="float:right;" class="btn btn-large">Register</a><hr />
        <center><a href="forgotpass.php">Forgot your Password? Click Here.</a></center>
      </form>
	<?php 
		if(isset($_GET['inactive']))
		{
			?>
          <!--  <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
			<	<center>Please contact dinocloudonline@gmail.com for support.</center> 
			</div> -->
            <?php
		}
	       ?>
	 <!-- <footer>
       <center> <h5>Logo made with <a href="https://www.designevo.com/en/" title="Free Online Logo Maker">DesignEvo</a> </h5> <center>
    </footer> -->
    
  </body>
</html>
