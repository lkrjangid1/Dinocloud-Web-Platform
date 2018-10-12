<!-- <script>
     function closeShare()
       {
       document.getElementById("sharePopup").style.visibility = 'hidden';
       }
     </script> 
<div id="sharePopup">
    <input type="button" value="x" onclick="closeShare();" />
 <h4 id="shareUrl"></h4>
</div>   -->
   <!-- function makeShare(filename)
    {
        $.ajax({
            url:"share.php",
            method:"POST",
            data:{file:filename},
            success:function(data)
            {
                //alert("URL> " + data);
                document.getElementById("shareUrl").innerHTML = data;
                document.getElementById("sharePopup").style.visibility = 'visible';
            }
        });
    } -->

<script>
    function makeDelete(filename)
    {
        $.ajax({
            url:"delete.php",
            method:"POST",
            data:{file:filename},
            success:function(data)
            {
                alert("Delete successful!");

                // refresh
                window.location.reload();
            }
        });
    };
</script>


<!-- Include script library -->
<script src="dist/clipboard.min.js"></script>

<!-- Instantiate clipboard by passing a HTML element -->
  <script>
   
    var clipboard = new ClipboardJS('.btn');
    clipboard.on('success', function(e) {
        console.log(e);
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
        alert("Success: Your link has been copied!");
        e.clearSelection();
    });
    
    clipboard.on('error', function(e) {
        console.log(e);
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
        
    });
    </script> 

<?php
session_start();
$connect = mysqli_connect("localhost", "dyno", "Dinocloud.1995", "dinocloud");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT FileName, FileSize, FileType, created FROM uploads 
  WHERE FileName LIKE '%".$search."%' AND
  userID=".$_SESSION['userSession'].";";
}
else
{
 $query = "
  SELECT FileName, FileSize, FileType, created FROM uploads WHERE userID=".$_SESSION['userSession']."
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <div class="header" width="100%" style="margin-top: 0;">
  <div class=".col-xs-12 .col-sm-6 .col-lg-8">
   <table width="100%" class="table table-hover">
    <tr>
     <th bgcolor="#59b300"><span class="glyphicon glyphicon-list"></span></th>
     <th bgcolor="#59b300"><center>Name</center></th>
     <th bgcolor="#59b300"><center>Type</center></th>
     <th bgcolor="#59b300"><center>Size</center></th>
     <th bgcolor="#59b300"><center>Added</center></th>
     <th bgcolor="#59b300"><center>Options</center></th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
     <td><img src="resources/images/filecloudicon.png" height="30" width="30"></img></td>
     <td>'.$row["FileName"].'</td>
     <td>'.$row["FileType"].'</td>
     <td>'.$row["FileSize"].' bytes </td>
     <td>'.$row["created"].'</td>
     <td>
        <a href="download.php?file='.$row["FileName"].'"><img src="resources/images/download.png" height="30" width="30"></a>
        <img src="resources/images/delete.png" height="30" width="30" onclick="makeDelete(\''.$row["FileName"].'\')"></img>
        <button class="btn" data-clipboard-text="http://dinocloud.tk/uploads/' . $_SESSION["userSession"] . '/' . $row["FileName"] . '">
        Share
        </button>
        </img>
     </td>
   </tr>
  ';
 }
 
 echo $output;
 }

 else
 {
 echo '<h3>No results found.. Please search again with a different keyword!</h3>';
 }

?>

 <!--<button onclick="makeDelete(\''.$row["FileName"].'\')"> Delete </button>
        <button onclick="makeShare(\''.$row["FileName"].'\')"> Share </button> -->
