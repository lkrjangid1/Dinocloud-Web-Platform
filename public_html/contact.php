<?php
session_start();
require_once 'class.user.php';
include_once 'common.php';
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
<html>

<head>
    <title><?php echo $lang['NAVRBAR_CONTACT']; ?></title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/contact.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
</head>

<body>

<div class="wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand text-uppercase" href="home.php"><?php echo $lang['NAVBAR_TITLE']; ?></a>
        </div> <!-- SFARSIT NAVBAR HEADER -->

        <div class="collapse navbar-collapse" id="navigation">
  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
                    <a id="flag" href="contact.php?select-language" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                                <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                 <li>
                                        <a href="contact.php?lang=ro">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="contact.php?lang=en">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="contact.php?lang=de">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="contact.php?lang=es">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/es.png" alt="Spanish" width="28px" height="18px">
                                            <span>Español</span>
                                        </a>
                                </li> 
                                </ul>
                           </li>

                <li class=" dropdown">
                   <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="https://image.ibb.co/emWG8v/rsz_user_icon_png_pnglogocomimg.png" width="30px" height="30px"> <?php echo $row['userName']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li> <a href="profile.php"><span class="glyphicon glyphicon-user"></span> <?php echo $lang['NAVRBAR_PROFILE']; ?></a> </li>
                                 <li> <a href="filemanager.php"><span class="glyphicon glyphicon-hdd"></span> <?php echo $lang['NAVRBAR_FILES']; ?></a> </li>
                                <li> <a href="logout.php"><span class="glyphicon glyphicon-off"></span> <?php echo $lang['NAVRBAR_LOGOUT']; ?></a></li>
                            </ul>
                 </li>
                 	    
          </div> <!-- SFARSIT NAV-BAR COLLAPSE -->  
      </div> <!-- SFARSIT CONTAINER -->
    </nav> <!--SFARSIT NAV-BAR INVERSE TOP -->
<br \>

<div class="container" style="margin-top: 9%;">
	<div class="row">

        <div class="span8">
        	<iframe width="100%" height="390" frameborder="1" scrolling="yes" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Bulevardul Ferdinand I, Alba Iulia, Alba County, Romania, &t=&z=15&ie=UTF8&iwloc=&output=embed" marginwidth="0""></iframe>
    	</div>

      	<div class="span4">
    		<h2 style="color: dodgerblue">Contact Dinocloud</h2>
    		<address>
    			<strong>Alba Iulia, Romania</strong><br>
    			<strong>Ferdinand Boulevard, 106A</strong><br>
    			<strong>Cod: 513214</strong><br>
    		</address>
            </div>
</div>

	</div>
</div>

<br \><br \><br \>

<footer>
    <h5>&copy; 2017<a style="color:dodgerblue; text-decoration:none;" href="home.php"> Dinocloud - Online Web Storage. </a> <?php echo $lang['SMALL_FOOTER']; ?></h5>
</footer>

</div> <!-- SFARSITUL INTREGULUI WRAPPER -->


</body>


</html>