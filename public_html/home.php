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
        <title><?php echo $lang['PAGE_TITLE']; ?></title>
        <meta name="Radu Goada" content="author">
        <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="resources/css/home.css" rel="stylesheet" media="screen">
      <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js""></script>
        <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css"> -->
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
                    <a id="flag" href="home.php?select-language" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                                <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                 <li>
                                        <a href="home.php?lang=ro">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="home.php?lang=en">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="home.php?lang=de">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="home.php?lang=es">
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
    </nav> <!-- SFARSIT NAv-BAR INVERSE TOP -->

<header class="header">

    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
        <!-- Indicatoare -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper pentru animatia de glisare -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="resources/images/slide01.png" alt="Slide01" width="100%" height="100%">
                <div class="carousel-caption">
                </div>
            </div>

            <div class="item">
                <img src="resources/images/slide02.png" alt="Slide02" width="100%" height="100%">
                <div class="carousel-caption">
                    <h3>Responsive Layout</h3> 
                </div>
            </div>
            <div class="item">
                <img src="resources/images/slide03.png" alt="Slide03" width="100%" height="100%">
                <div class="carousel-caption">
                    <h3>Ideas put into practice</h3>
                </div>
            </div>
            <div class="item">
                <img src="resources/images/slide04.png" alt="Slide04" width="100%" height="100%">
                <div class="carousel-caption">
                </div>
            </div>
        </div>

        <!-- Controalele/Indicatoarele Stanga, Dreapta -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</header>

<header class="header">

   <div class="col-md-4 text-center">  
      <img src="resources/images/servers.png" width="380px" height="220px">
   </div>

<div class="col-md-4 text-center">  
</div>

 <div class="col-md-4 text-center">   
   <h1><?php echo $lang['SERVER_BANNER1']; ?></h1>
   <h3><?php echo $lang['SERVER_BANNER2']; ?><h3>
   <h4><?php echo $lang['SERVER_BANNER3']; ?></h4>
 </div>

</header>

<header class="header-marketing">

      <div class="container" style="margin-top: 0;">
          <!-- Trei coloane reprezentate in CAROUSEL prin scris si iconite -->
          <div class="row">
                <div class="col-md-4 text-center" style="margin-top: 2%;">
                  
             <img class="img-circle" src="resources/images/icon1.png">
                    <h2><?php echo $lang['SERVER_AD1']; ?></h2>
                    <p><?php echo $lang['SERVER_ADV1']; ?></p>
                </div>

                <div class="col-md-4 text-center" style="margin-top: 2%;">
                    <img class="img-circle" src="resources/images/icon2.png">
                    <h2><?php echo $lang['SERVER_AD2']; ?></h2>
                    <p><?php echo $lang['SERVER_ADV2']; ?></p>
                </div>

                <div class="col-md-4 text-center" style="margin-top: 2%;">
                    <img class="img-circle" src="resources/images/icon3.png">
                    <h2><?php echo $lang['SERVER_AD3']; ?></h2>
                    <p><?php echo $lang['SERVER_ADV3']; ?></p>
                </div>

            </div><!-- SFARSIT RAND(ROW) -->
</header>


<div class="container">
    <div class="row">

<div class="col-md-4">
</div>

<div class="col-md-4">
            <div class="jumbotron-my">
            <h1><?php echo $lang['UPLOAD_BANNER1']; ?></h1>
            <p><?php echo $lang['UPLOAD_BANNER2']; ?></p>
            <p><a href="filemanager.php" class="btn btn-primary btn-lg"><?php echo $lang['UPLOAD_BUTTON']; ?></a></p>
        </div>
</div>

<div class="col-md-4">
</div>

    </div>
</div>

<div class="chat">
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b6ad395df040c3e9e0c66f3/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</div>


<footer class="footer-distributed">
			<div class="footer-left">
				<h3>DINO<span>CLOUD</span></h3>
	                 	<p class="footer-links">
					<a href="pricing.php"><?php echo $lang['FOOTER_PRICING']; ?></a>
					<a href="faq.php"><?php echo $lang['FOOTER_FAQ']; ?></a>		
					<a href="contact.php"><?php echo $lang['FOOTER_CONTACT']; ?></a>
				</p>

				<p class="footer-company-name">&copy; Dinocloud 2017. All rights reserved.</p>
			</div>
			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>Ferdinand Boulevard, Nr. 50A </span> Alba, Romania</p>
				</div>
				<div>
					<i class="fa fa-phone"></i>
					<p>+40728637210</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:dinocloudonline@gmail.com">dinocloudonline@gmail.com</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span><?php echo $lang['ABOUT_US']; ?></span>
					<?php echo $lang['ABOUT_DESCRIPTION']; ?>
				</p>
				<div class="footer-icons">
					<a href="https://facebook.com/dinocloudonline" target="_blank"><i class="fa fa-facebook" style="color:DodgerBlue"></i></a>
					<a href="https://twitter.com/dinocloudonline" target="_blank"><i class="fa fa-twitter" style="color:DeepSkyBlue"></i></a>
					<a href="https://instagram.com/radugoada" target="_blank"><i class="fa fa-instagram" style="color:OrangeRed"></i></a>
				</div>
			</div>
		</footer> <!-- FOOTER END -->
     
</div> <!-- SFARSITUL INTREGULUI WRAPPER -->

</body>

</html>