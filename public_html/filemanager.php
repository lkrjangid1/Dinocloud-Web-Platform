<?php
// Incepem sesiunea si includem clasa pentru fiecare utrilizator care se logheaza si este inregistrat pe site
session_start();
include_once 'common.php';
require_once 'class.user.php';

$user_home = new USER(); // Se creeaza un nou utilizator, din clasa USER

 // Daca o persoana nu este logata si  incearca sa acceseze paginile site-ului, atunci se redirectioneaza inapoi spre index.php unde avem pagina de logare
if(!$user_home->is_logged_in())
{
    $user_home->redirect('index.php'); //Comanda de redirect este apelata
}

// Se creeaza interogarea de sesiune pe baza id-ului pentru utilizatorul inregistrat
$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC); // Row este folosit in tabelul de fisiere
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $lang['NAVRBAR_MANAGER']; ?></title>
    <meta name="Radu Goada" content="author">
    <link rel="Shortcut Icon" href="resources/images/favicon_dinocloud.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/myfiles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="resources/css/uploadfile.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.10.2.js" integrity="sha256-it5nQKHTz+34HijZJQkpNBIHsjpV8b6QzMJs9tmOBSo=" crossorigin="anonymous"></script>
    <script src="resources/jquery/jquery.uploadfile.min.js"></script>
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
                   <a id="flag" href="filemanager.php?select-language" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-globe fa-2x"> Lang</i>
                    </a>
                                <ul class="dropdown-menu dropdown-menu-flag" role="menu">
                                   <li>
                                        <a href="filemanager.php?lang=ro">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/ro.png" alt="Romana" width="28px" height="18px">
                                            <span>Romana</span>
                                        </a>
                                 </li>
                                 <li>
                                        <a href="filemanager.php?lang=en">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/gb.png" alt="English" width="28px" height="18px">
                                            <span>English</span>
                                        </a>
                                 </li>       
                                 <li>
                                        <a href="filemanager.php?lang=de">
                                            <img src="http://www.country-dialing-codes.net/img/png-country-4x2-flat-res-640x480/de.png" alt="German" width="28px" height="18px">
                                            <span>Deutsch</span>
                                        </a>
                                </li>  
                                 <li>
                                        <a href="filemanager.php?lang=es">
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
<header class="header-upload">

<div class="container" width="80%" style="margin-top: 4%;">
   <div class="col-sm-12 text-center">  
    <a class="linkFiles" href="#" onclick="window.location.reload(true);"><h3><i class="fa fa-folder-open">
    </i> <?php echo $lang['MY_FILES']; ?></h3></a>
   </div>
  <div class=".col-xs-12 .col-sm-6 .col-lg-8">     
   <div class="form-group">
     <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></span>
      <input type="text" name="search_text" id="search_text" placeholder="<?php echo $lang['SEARCH_TEXT']; ?>" class="form-control" />
     </div> <!-- SFARSIT INPUT GROUP -->
   </div> <!-- SFARSIT FORM GROUP -->
  </div> <!-- SFARSIT COL XS 6 MD 4 -->
</div> <!-- SFARSIT Container -->

</header>

<script> //Functia ajax pentru formularul de search
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"search.php", // Apelam fisierul server-side care contine codul php cu interogarile pentru baza de date
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('.table').html(data); // Afisarea fisierelor se face in timp real in clasa tabel in timp ce utilizatorul scrie
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<script>
function deleteEverything () {
      if (confirm('Are you sure you want to delete all files?')) {
      $.ajax({
        url:"deleteAll.php", //the page containing php script
        type: "POST", //request type
        success:function(result){
        alert(result);
        // Comanda de refresh
        window.location.reload();
       }
     });
   }
 };
 </script>
    
 <!-- Formularul de upload alaturi de functiile jquery specifice versiunii plugin-ului de Upload -->
<div class="container" style="margin-top: 1%;">
  <div align="left">
    <button class="btn btn-danger" onclick="deleteEverything()">Remove All Files</button>
  </div>
  <br />
     <div class=".col-md-4" id="multiple_file_uploader"><?php echo $lang['UPLOAD_BUTTON']; ?></div>
        <script>
        $(document).ready(function()
        {

            $("#multiple_file_uploader").uploadFile({
                fileName : "myfile",
                fileSize : "filesize",
                url : "upload.php",
                multiple : true,
                maxFileCount : 15,
                maxFileSize: 5242880000,
                processData: false,
                allowedTypes : "jpeg,mp4,flac,pls,extollo,xcodeproject,md,lua,jpg,exe,pkg,png,gif,doc,docx,pdf,ppt,cpp,cs,odt,csv,xml,py,tiff,srt,sub,hdr,mov,avi,app,css,html,php,torrent,mkv,srt,3gp,zip,7zip,tar.gz,tar,tor,rar,iso,h,xls,xlsx,ppts,css,js,bmp,svg,tar,7z,txt,pro,psd,rtf,pptx,tif,map,wav,mp3",
                showProgress : true,
                showAbort : true,
                afterUploadAll : function(obj) //Functie pentru actualizarea in timp real a continutului din tabel
                {
                    alert("Upload successful!");
                    // Comanda de refresh
                    window.location.reload();
                }
             });
         });
        </script> 
</div> <!-- SFARSIT CONTAINER-->  

<br \>

<?php
 // Se creeaza o conexiune noua la baza de date
 $dbLink = new mysqli('localhost', 'dyno', 'Dinocloud.1995', 'dinocloud');
   if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
     }

$sql = 'SELECT FileName, FileType, FileSize, created FROM uploads WHERE userID=' . $_SESSION['userSession'] . ' ORDER BY FileName ASC';
$result = $dbLink->query($sql);

 // Verificam daca conexiunea s-a realizat cu success
if($result) {
    // Verificam in baza de date daca sunt ceva fisiere, daca nu sunt atunci se afiseaza mesajul de mai jos
    if($result->num_rows == 0) {
        echo '<center><h3>Your file manager is empty...Click the Upload button to upload your first files!</h3></center>';
    }

    else {
        // Se incepe afisarea si crearea tabelului, la care se adauga 2 div-ul de bootstrap pentru o incadrare mai eficienta si optimizata si pentru celelalte dispozitive
        echo '<div class="container" width="100%" style="margin-top: 0;">';
        echo '<div class=".col-xs-12 .col-sm-6 .col-lg-8">';   	 
        echo '<table width="100%" class="table table-hover">  	

                <tr>
                    <td><span class="glyphicon glyphicon-list"></span></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></center></td>
                    <td><b>Size</b></td>
                    <td><b>Added</b></td>
                    <td><b>Options</b></td>
                </tr>';
 
        // Afisam fiecare fisier in parte 
        while($row = $result->fetch_assoc()) { 
            echo "
                <tr>
                    <td><img src='resources/images/filecloudicon.png' height='45' width='55'></img></td>
                    <left><td>{$row['FileName']}</td></left>
                    <td>{$row['FileType']}</td>
                    <td>{$row['FileSize']} bytes</td>
                    <td>{$row['created']}</td>
                    <td>
                        <a href='download.php'><<img src='resources/images/download.png' height='30' width='30'></a>
                        <a href='delete.php'><img src='resources/images/delete.png' height='30' width='30'></a>
                        <button class='btn' data-clipboard-text='https://dinocloud.tk/uploads/'>
    				    Share
    				 	</button>
                    </td>
                </tr>"; 
        }
        // Inchidem tabelul si celelalte 2 div-uri
        echo '</table>';
        echo '</div>';
        echo '</div>';
    }
 
    // Eliberam rezultatul
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>"; // Afisarea erorilor de la baza de date
}
// Inchidem conexiunea cu baza de date MySQL
$dbLink->close();
?>

<script> //Functie javascript pentru afisarea unui panou informativ pentru iconita dollar cu Preturi si Planuri
    $(function() {
         $('[data-toggle="tooltip"]').tooltip()
        }
    )
</script>

<footer class="footer-left">
<a class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Upgrade my plan!" href="pricing.php"><span class="glyphicon btn-glyphicon glyphicon glyphicon-usd"></span></a>
</footer>

</div> <!-- SFARSITUL INTREGULUI WRAPPER -->

</body>

</html>
