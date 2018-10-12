<?php

require_once 'dbconfig.php';

class USER
{	
	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	

	public function register($uname,$uaddress,$email,$upass,$code)
	{
		try
		{	
                        $hashedPass = hash('sha512', $upass);				
			//$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userAddress,userEmail,userPass,tokenCode) 
			                                             VALUES(:user_name, :user_address, :user_mail, :user_pass, :active_code)");

			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_address",$uaddress);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$hashedPass); //it was $password before.
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']== hash('sha512', $upass))  //it was md5($upass) before
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer(true);
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";             
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="dinocloudonline@gmail.com";  
		$mail->Password="DinoCloud.1995";            
		$mail->SetFrom('dinocloudonline@gmail.com','DinoCloud');
		$mail->AddReplyTo("dinocloudonline@gmail.com","DinoCloud");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}