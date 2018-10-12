<?php
session_start();
require_once 'class.user.php';
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
    <title>Admin | Dinocloud</title>
    <!-- Bootstrap library -->
    <meta name="Radu Goadă" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="resources/bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="resources/bootstrap/js/bootstrap.min.js"></script>
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="resources/css/styles.css" rel="stylesheet" media="screen">
    <link href="resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   
 <body>

<div class="container">
    <div class="row">
		<div class="span4 offset4 well">
			<center><h3>Admin | Dinocloud</h3></center>
  <?php
        if(isset($_GET['error']))
		{
	?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				 <a class="close" data-dismiss="alert" href="#"></a>Incorrect Username or Password!
			</div>
            <?php
		}
	       ?>
         
	<form method="POST" class="form-control" autocomplete="off">
 
        <input type="text" id="username" class="span4" name="txtemail" placeholder="Username">
	<input type="password" id="password" class="span4" name="txtupass" placeholder="Password">

	<button type="submit" name="btn-login" class="btn btn-info btn-block">Login</button>
	</form>    
		</div>
	</div>
</div>

 </body>
</html>