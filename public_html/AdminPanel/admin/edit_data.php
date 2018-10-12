/*
include_once 'dbconfig.php';
$conn = new Database();
$table = "users";

if(isset($_GET['edit_id']))
{
 $sql=mysql_query("SELECT * FROM users WHERE userID=".$_GET['edit_id']);
 $result=mysql_fetch_array($sql);
}

// and update condition would be as follow ...

if(isset($_POST['btn-update']))
{
 $uname = $_POST['userName'];
 $uaddress = $_POST['userAddress'];
 $role = $_POST['userRole'];
 
 $id=$_GET['edit_id'];
 $res=$conn->update($table,$id,$uname,$uaddress,$role);
}
*/