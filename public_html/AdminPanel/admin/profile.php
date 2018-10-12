<?php
session_start();
require_once 'class.user.php';

$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>My Profile | Dinocloud</title>
        <!-- Bootstrap library load -->
        <meta name="Radu Goadă" content="author">
        <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <script src="resources/bootstrap/js/bootstrap.min.js"></script>
        <script src="resources/bootstrap/js/jquery-1.9.1.min.js"></script>
        <link href="resources/css/my_profile.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.css">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <div class="navbar navbar-inverse nav navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="http://dinocloud.host22.com/admin/home.php">Admin | My Dashboard</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <!-- <i class="icon-user icon-white"></i> -->  <img src="https://image.ibb.co/emWG8v/rsz_user_icon_png_pnglogocomimg.png" width="26px" height="26px">
								<?php echo $row['userName']; ?> <i class="caret">
                            </i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="my_profile.php"><i class="icon-edit"></i> My Profile</a>
                                     
                                        <a tabindex="-3" href="logout.php"><i class="icon-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                    <!--/.nav-collapse -->

                </div>
            </div>
<div class="page-header">
		<center><h4>My Profile</h4><center>
</div>
<div class="container">

 <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                       <img src="https://image.ibb.co/emWG8v/rsz_user_icon_png_pnglogocomimg.png" alt="rsz_user_icon_png_pnglogocomimg" class="img-circle img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h3><?php echo $row['userName']; ?></h3>
                        <span class="label label-success"><?php echo $row['userCountry']; ?></span>
                        <span class="label label-warning"><?php echo $row['userRoles']; ?></span>
                        <br />
                        <strong>
                          <i class="icon-home"></i> <?php echo $row['userAddress']; ?>
                            <br />
                            <i class="icon-envelope"></i> <?php echo $row['userEmail']; ?>
                            <br />
                            <i class="icon-signal"></i> <?php echo $row['userPhone']; ?> </strong>
                             <br />
                        <!-- Split button -->
                        <div class="btn-group">
                           <button class="btn btn-info" type="button">Share Profile</button>        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

        <!--/.fluid-container-->
        <script src="resources/bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="resources/bootstrap/js/bootstrap.min.js"></script>
        <script src="resources/js/scripts.js"></script>

<footer class="footer-distributed">

			<div class="footer-left">
				<h3>DINO<span>CLOUD</span></h3>
				<p class="footer-company-name"><a href="http://radugoada.blogspot.ro/" target="_blank">Radu Goadă</a> &copy; 2016. All rights reserved.</p>
  
			</div>
                       
</footer>

</body>

</html>