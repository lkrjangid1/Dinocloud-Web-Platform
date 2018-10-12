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
    <title><?php echo $lang['NAVRBAR_FAQ']; ?></title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="resources/css/faq.css" rel="stylesheet" media="screen">
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
                    <a id="flag" href="faq.php?select-language" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                                <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                   <li>
                                        <a href="faq.php?lang=ro">
                                            <img src="https://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="faq.php?lang=en">
                                            <img src="https://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="faq.php?lang=de">
                                            <img src="https://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="faq.php?lang=es">
                                            <img src="https://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/es.png" alt="Spanish" width="28px" height="18px">
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

<div class="container" style="margin-top: 9%;">
<div class="page-header">
<h1>FAQ
<small><?php echo $lang['FAQ_TITLE'];?></small>
</h1>
</div>
  <div class="panel-group" id="accordion">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <a href="#"><?php echo $lang['FAQ_BLOCK01_TITLE']?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $lang['FAQ_BLOCK01_DESCRIPTION'];?></div>
      </div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#"><?php echo $lang['FAQ_BLOCK02_TITLE']?></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $lang['FAQ_BLOCK02_DESCRIPTION'];?></div>
      </div>
    </div>

    <div class="panel panel-warning">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#"><?php echo $lang['FAQ_BLOCK03_TITLE']?></a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $lang['FAQ_BLOCK03_DESCRIPTION'];?></div>
      </div>
    </div>
      
      <div class="panel panel-primary">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#"><?php echo $lang['FAQ_BLOCK04_TITLE']?></a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $lang['FAQ_BLOCK04_DESCRIPTION'];?></div>
      </div>
    </div>
    
      <div class="panel panel-danger">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="panel-title expand">
            <div class="right-arrow pull-right">+</div>
          <a href="#"><?php echo $lang['FAQ_BLOCK05_TITLE']?></a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $lang['FAQ_BLOCK05_DESCRIPTION'];?></div>
      </div>
    </div>
  </div> 
  
</div>

<br \>
<!-- MODAL MESSAGE SEND MAIL (need email client on Server installed)
<div class="container">
    <div class="row" style="margin-top:40px;">
        <div class="col-md-12 text-center">
         Button trigger modal
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalMessage">
              <span class="glyphicon glyphicon-envelope"></span> <?php echo $lang['FAQ_ASK_BUTTON'];?>
            </button>
        </div>
    </div>
</div>

 Modal
<div class="modal fade" id="ModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="sendmail.php" method="POST" id="FormMessage" class="form-horizontal">
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
          <h4 class="text-center" id="myModalLabel">FAQ | DinoCloud</h4>
        </div>

        <div class="modal-body">
          <br />
           <div class="control-group">
            <label for="subject"><?php echo $lang['FAQ_ASK_EMAIL'];?></label>
            <input name="email" type="text" class="form-control">
          </div>
         -->

          <!-- Alegerea subiectului/titlului
          <div class="control-group">
            <label for="subject"><?php echo $lang['FAQ_ASK_TITLE'];?></label>
            <input name="subject" type="text" class="form-control">
          </div>
          <br /> -->

          <!-- Zona de scris
          <div class="control-group">
            <label for="ask_question"><?php echo $lang['FAQ_ASK_SOMETHING'];?></label>
            <textarea id="FormMessageMessage" name="message" class="form-control" rows="5"></textarea>
          </div>
          <br /> -->

       <!-- </div>
        <div class="modal-footer">
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-send"></span> <?php echo $lang['FAQ_ASK_BUTTON'];?></button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div> -->
<br \><br \><br \>

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

    <footer>
        <h5>&copy; 2017<a style="color:dodgerblue; text-decoration:none;" href="home.php"> Dinocloud - Online Web Storage. </a> <?php echo $lang['SMALL_FOOTER']; ?></h5>
    </footer>

</div> <!-- SFARSITUL INTREGULUI WRAPPER -->

</body>

</html>
