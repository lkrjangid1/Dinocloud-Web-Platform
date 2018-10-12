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
    <title><?php echo $lang['NAVRBAR_PROFILE']; ?></title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/profile.css" rel="stylesheet" media="screen">
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
                    <a id="flag" href="profile.php?select-language" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                          <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                 <li>
                                        <a href="profile.php?lang=ro">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="profile.php?lang=en">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="profile.php?lang=de">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="profile.php?lang=es">
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


<script>
function deactivateAccount () {
      if (confirm('Are you sure you want to deactivate your account? Warning: This cannot be undone!')) {
      $.ajax({
        url:"deactivateAccount.php", //the page containing php script
        type: "POST", //request type
        success:function(result){
        alert(result);
        // Comanda de refresh
       // window.location.reload();
          window.location.href = "logout.php";
       }
     });
   }
 };
 </script>

<div class="container" style="margin-top: 20%;">
	
	<div class="row">

         <div class="col-md-2 col-md-offset-5">
             <center><img src="https://image.ibb.co/emWG8v/rsz_user_icon_png_pnglogocomimg.png" alt="rsz_user_icon_png_pnglogocomimg" alt="" class="img-circle img-responsive"/></center>
         </div>
       
                    <div class="col-md-2 col-md-offset-5">
                        <h2><?php echo $row['userName']; ?></h2>
                        <h4><span class="label label-success"><?php echo $row['userCountry']; ?></span></h4>
                        <h4><span class="label label-warning"><?php echo $row['userRoles']; ?></span></h4>
                        <h4><span class="label label-info"><?php echo $row['userPlan']; ?></span></h4>
                        <br />
                        <strong>
                             <?php echo $row['userAddress']; ?>
                            <br />
                             </i> <?php echo $row['userEmail']; ?>
                            <br />
                             </i> <?php echo $row['userPhone']; ?>
                        </strong>
                        <br />
                        <hr>    
                        <button class="btn btn-danger" onclick="deactivateAccount()"><span class="glyphicon glyphicon-remove"></span> <?php echo $lang['NAVRBAR_DEACTIVATE']; ?></button>
                    </div>
     </div>
          
</div>


    <footer>
        <h5>&copy; 2017<a style="color:dodgerblue; text-decoration:none;" href="home.php"> Dinocloud - Online Web Storage. </a><?php echo $lang['SMALL_FOOTER']; ?></h5>
    </footer>

</div> <!-- SFARSITUL INTTREGULUI WRAPPER -->

</body>

</html>