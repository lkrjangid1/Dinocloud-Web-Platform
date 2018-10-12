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
	

	public function register($uname,$uaddress,$uphone,$ucountry,$email,$upass,$code)
	{
   
		try
		{	
            $hashedPass = hash('sha512', $upass);
			//$password = md5($upass); - Metoda rapida si ineficienta de criptare a parolei
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userAddress,userPhone,userCountry,userEmail,userPass,tokenCode) 
			                                             VALUES(:user_name, :user_address, :user_phone, :user_country, :user_mail, :user_pass, :active_code)");

			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_address",$uaddress);
            $stmt->bindparam(":user_phone",$uphone);
            $stmt->bindparam(":user_country",$ucountry);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$hashedPass);
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
                                                $userFolder=$_SESSION['userSession'];
                                                mkdir("./uploads/$userFolder", 0777, true);
                                                $upload_path = "./uploads/$userFolder";

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
	
     //Functia care seteaza incarcarea individuala pe directorul HOME al utilizatorului, in functie de ID-ul utilizatorului
     public function addFileToDatabase($fileName, $fileSize, $fileType)
      {
        $stmt = $this->conn->prepare("INSERT INTO uploads(userID,FileName,FileSize,FileType, created) VALUES (:user_id, :file_name, :file_size, :file_type, NOW() )");
        $stmt->bindparam(":user_id", $_SESSION['userSession']);
        $stmt->bindparam(":file_name", $fileName);
        $stmt->bindparam(":file_size", $fileSize);
        $stmt->bindparam(":file_type", $fileType);
        $stmt->execute();
       }

    public function removeFileFromDatabase($fileName)
    {
        $stmt = $this->conn->prepare("DELETE FROM uploads WHERE userID = :user_id AND FileName = :file_name");
        $stmt->bindparam(":user_id", $_SESSION['userSession']);
        $stmt->bindparam(":file_name", $fileName);
        $stmt->execute();
    }

	public function logout() //Incheierea sesiunii utilizatorului/Iesire din cont
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
		$mail->SMTPSecure = "tls";             
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 587;             
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
