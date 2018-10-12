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
    <title><?php echo $lang['NAVRBAR_PRICING']; ?></title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="resources/css/pricing.css" rel="stylesheet" media="screen">
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
                    <a id="flag" href="pricing.php?select-language" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                                <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                 <li>
                                        <a href="pricing.php?lang=ro">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="pricing.php?lang=en">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="pricing.php?lang=de">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="pricing.php?lang=es">
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
    </nav> <!-- SFARSIT NAV-BAR INVERSE TOP -->

    <br \>
    
    <!-- Planuri si preturi pentru utilizatori -->
    <section id="plans">
        <div class="container" style="margin-top: 9%;">
            <div class="row">

                <!-- GRUP/CASUTA -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-success panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h2><?php echo $lang['FREE_PLAN']; ?></h2>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $lang['FREE_FEATURES']; ?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['FREE_PLAN01']; ?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['FREE_PLAN02']; ?></li>
                            <li class="list-group-item"><i class="fa fa-times"></i> <?php echo $lang['FREE_PLAN03']; ?></li>
                        </ul>
                        <div class="panel-footer">
                            <button type="button" name="btn-free-plan" class="btn btn-success disabled"><?php echo $lang['FREE_PLAN_BUTTON']; ?></button>
                        </div>
                    </div>
                </div>
                <!-- SFARSIT GRUP/CASUTA -->

                <!-- GRUP/CASUTA -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h2><?php echo $lang['BUSINESS_PLAN']; ?></h2>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $lang['BUSINESS_FEATURES']; ?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['BUSINESS_PLAN01']; ?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['BUSINESS_PLAN02']; ?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['BUSINESS_PLAN03']; ?></li>
                        </ul>
                        <div class="panel-footer">
<form action="insertBusinessPlan.php" method="post">
              <button id="business-btn" value="business" type="submit" class="btn btn-warning"><?php echo $lang['BUSINESS_PLAN_BUTTON']; ?></button>
</form>
                        </div>
                    </div>
                </div>
                <!-- SFARSIT GRUP/CASUTA -->

                <!-- GRUP/CASUTA -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-danger panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h2><?php echo $lang['PROFESSIONAL_PLAN']; ?></h2>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $lang['PROFESSIONAL_FEATURES']; ?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['PROFESSIONAL_PLAN01']; ?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['PROFESSIONAL_PLAN02']; ?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $lang['PROFESSIONAL_PLAN03']; ?></li>
                        </ul>
                        <div class="panel-footer">
<form action="insertProfessionalPlan.php" method="post">
                            <button value="professional" type="submit" class="btn btn-danger"><?php echo $lang['PROFESSIONAL_PLAN_BUTTON']; ?></button>
</form>
                        </div>
                    </div>
                </div>
                <!-- SFARSIT GRUP/CASUTA -->

            </div>
        </div>
    </section>
    <!-- SFARSIT PLANURI -->
    <br \> <br \>

    <footer>
        <h5>&copy; 2017<a style="color:dodgerblue; text-decoration:none;" href="home.php"> Dinocloud - Online Web Storage. </a> <?php echo $lang['SMALL_FOOTER']; ?></h5>
    </footer>

</body>

</html>