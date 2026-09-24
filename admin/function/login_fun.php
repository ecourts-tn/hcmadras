<?php
class lOGIN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 


    public function login($uname,$upass)
    {
       try
       {
		   
          $stmt = $this->db->prepare("SELECT * FROM mhc_users WHERE username=:uname and status='A'");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
			  
			  
		   if(password_verify($upass, $userRow['password']))
             { 
             
			 
                 $_SESSION['user_session'] = $userRow['mhc_user_id'];
				$_SESSION['user_name'] = $userRow['full_name'];
				$_SESSION['roll'] = $userRow['roll'];
				$_SESSION['court_type'] = $userRow['court_type'];
				$_SESSION['usr_dist'] = $userRow['dist_id'];
				$_SESSION['default_pass'] = $userRow['default_pass'];
				$_SESSION['dept'] = $userRow['dept'];
				$_SESSION['uMenu']=$userRow['menu_id'];
				$update_user_id=$userRow['mhc_user_id'];
				$session_id=uniqid();
				$_SESSION['login_session']=$session_id;
				$login_flag=1;
				$stmt1 = $this->db->prepare("UPDATE mhc_users
   SET  session_id=:session_id,login_flag=:login_flag
 WHERE mhc_user_id =:update_user_id");
            
			$stmt1->bindValue(':update_user_id', $update_user_id); 
			$stmt1->bindparam(":session_id", $session_id);
			$stmt1->bindparam(":login_flag", $login_flag);
			if($stmt1->execute())
			{
				 $stmt2 = $this->db->prepare("SELECT session_id FROM mhc_users WHERE mhc_user_id=:update_user_id ");
          $stmt2->execute(array(':update_user_id'=>$update_user_id));
          $usersessionRow=$stmt2->fetch(PDO::FETCH_ASSOC);
				$_SESSION['session_id'] = $usersessionRow['session_id'];
			}
                return true;
		 
		 
             }
             else
             {
                return false;
             }
          }
		  
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   public function login_meeting($uname,$upass)
    {
       try
       {
		  
		  // error_log("SELECT * FROM mhc_metting_files WHERE meeting_judges IN ($uname)");
		   
          $stmt = $this->db->prepare("SELECT * FROM mhc_metting_files order by meeting_date desc limit 1 ");
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		   $meeting_judges=explode(',',($userRow['meeting_judges'])); 
          if(in_array($uname, $meeting_judges))
          {
			
			  
		   if(password_verify($upass, $userRow['password']))
             { 
             
			 
                $_SESSION['user_session'] = $userRow['files_id'];
				
				$stmt2 = $this->db->prepare("SELECT j_coram FROM judges WHERE j_id=:uname");
          $stmt2->execute(array(':uname'=>$uname));
          $usersessionRow=$stmt2->fetch(PDO::FETCH_ASSOC);
				
				
				$_SESSION['user_name'] = $usersessionRow['j_coram'];
				$_SESSION['roll'] = 'J';
				$_SESSION['uMenu']=$userRow['menu_id'];
				$session_id=uniqid();
				$_SESSION['login_session']=$session_id;
				$_SESSION['session_id']=$session_id;
                return true;
		 
		 
             }
             else
             {
                return false;
             }
          }
		  
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
    public function rti_login($uname,$upass)
    {
       try
       {
		  
		   $stmt = $this->db->prepare("SELECT * FROM mhc_rti_users WHERE mobile_no=:uname and status='A'");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
			
			  
		   if(password_verify($upass, $userRow['password']))
             { 
             
			 
                $_SESSION['user_session'] = $userRow['rti_user_id'];
				
				$_SESSION['user_name'] = $userRow['mobile_no'];
				$_SESSION['full_name'] = $userRow['full_name'];
				$_SESSION['roll'] = $userRow['roll'];
				$_SESSION['court_type'] = $userRow['court_type'];
				$_SESSION['usr_dist'] = $userRow['dist_id'];
				$_SESSION['default_pass'] = $userRow['default_pass'];
				$_SESSION['profile_status'] = $userRow['profile_status'];
				$_SESSION['uMenu']=$userRow['menu_id'];
				$session_id=uniqid();
				$_SESSION['login_session']=$session_id;
				$_SESSION['session_id']=$session_id;
                return true;
		 
		 
             }
             else
             {
                return false;
             }
          }
		  
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
     public function already_login($uname,$upass)
    {
       try
       {
		   
          $stmt = $this->db->prepare("SELECT * FROM mhc_users WHERE username=:uname and status='A'");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
			  
			  
		   if(password_verify($upass, $userRow['password']))
             { 
                if($userRow['login_flag']==0)
		 {
			 $login_flag_id=0;
                
                return $login_flag_id;
		 }
		 else
		 {
			 	     $id=$userRow['mhc_user_id'];
			   $name=$userRow['full_name'];
			   $rand_value=rand(1000,9999);
			   $today_dt=date("dmY");
			   
				$email=$userRow['email_id'];
				 $hash_val=sha1($email.$rand_value.$today_dt);
				 
			 $act_qry="insert into \"unlock_user\" (mailid,rand_value,date,hash_value) values ('$email','$rand_value','$today_dt','$hash_val')";
	$stmt1 = $this->db->prepare($act_qry);
	
	if($stmt1->execute())
	{
				
			//return false;
			
			   require_once('mailer/class.phpmailer.php');
			   
	$mail =new PHPMailer(); // defaults to using php "mail()"
		$body = '<style type="text/css">body {	margin:0;	padding:0;	height:90%;		background-color: #4C8DB6;	}.wrapper {	background-image: url(temp2.jpg);	position:relative;	width:100%;max-width:1024px;height:auto;margin:10px auto 0;border-radius:4px;}.header {	position:relative;	width:100%;max-width:825px;height:60px;margin:10px auto 0;border-radius:4px;-webkit-box-shadow:4px 5px 0 1px rgba(0,0,0,.24);-moz-box-shadow:4px 5px 0 1px rgba(0,0,0,.24);box-shadow:4px 5px 0 1px rgba(0,0,0,.24)	}.content {	 	margin:10px auto 0;	width:100%;max-width:825px;height:500px;border-radius:4px;margin-top:-20px;-webkit-box-shadow:4px 5px 0 1px rgba(0,0,0,.24);-moz-box-shadow:4px 5px 0 1px rgba(0,0,0,.24);box-shadow:4px 5px 0 1px rgba(0,0,0,.24)	}.hea{text-align:center;vertical-align:center;font-size: 30px;font-family:"Times New Roman";}.teq p{margin-left:50px}</style><body><div class="wrapper"><div class="header"> <p class="hea">High Court of Madras Online Certified Copy Portal</p>				</div><div class="content"><div class="teq"><br><br><p align="left">Dear '.$name.',</p><p>You have been unlock in High Court of Madras Online Certified Copy Portal.</p><p> User Name: '.$email.' </p><p>To Unlock the link for Online Certified Copy portal<br><a href="http://117.193.76.241/onlinecopyapp/activation.php?id='.sha1($id.$rand_value.$today_dt).'">Click Here...</a></p><p>Thank You.<br><br>with regards,<br>High Court Team,<br>High Court of Madras<br>Chennai-104.</p></div></div></div></body>';
		
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                          // 1 = errors and messages
                                           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
		$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
		$mail->SMTPSecure = 'ssl'; 
		$mail->Username   = "kanapathyvijay@gmail.com"; // SMTP account username
		$mail->Password   = "gan@123456";        // SMTP account password
		$mail->SetFrom('kanapathyvijay@gmail.com', 'High Court of Madras');
		$address = $email;
		$mail->AddAddress($address, "High Court of Madras");
		$mail->Subject    = "You have been unlock in High Court of Madras Online Certified Copy Portal..";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAttachment("");      // attachment
$mail->AddAttachment(""); // attachment

/* if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else 
{
  echo 'sucess';
}  */ 
		$login_flag_id=1;
return $login_flag_id;
	}
		 }
             }
             else
             {
                return false;
             }
          }
		  
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
  public function login_info($uname,$sucess_msg,$ip,$login_tym)
    {
       try
       {
   
           $stmt = $this->db->prepare("INSERT INTO user_log(
           	user_name, message,ip, create_date) 
						VALUES(:uname,:sucess_msg,:ip,:login_tym)");
            
			$stmt->bindparam(":uname", $uname);  
			$stmt->bindparam(":sucess_msg", $sucess_msg);
			$stmt->bindparam(":ip", $ip); 
			$stmt->bindparam(":login_tym", $login_tym); 
			
			$stmt->execute();
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function login_error($uname,$sucess_msg,$ip,$login_tym)
    {
       try
       {
   
           $stmt = $this->db->prepare("INSERT INTO user_log(
           	user_name, message,ip, create_date) 
						VALUES(:uname,:sucess_msg,:ip,:login_tym)");
            
			$stmt->bindparam(":uname", $uname);  
			$stmt->bindparam(":sucess_msg", $sucess_msg);
			$stmt->bindparam(":ip", $ip); 
			$stmt->bindparam(":login_tym", $login_tym); 
			
			$stmt->execute();
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	  public function unlock($uname,$upass)
    {
       try
       {
		   
          $stmt = $this->db->prepare("SELECT * FROM mhc_users WHERE username=:uname and status='A'");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
			  
			  
		   if(password_verify($upass, $userRow['password']))
             {
$session_id='NULL';
$login_flag='0';
$mhc_user_id = $userRow['mhc_user_id'];

                $stmt2 = $this->db->prepare("UPDATE mhc_users
   SET  session_id=:session_id,login_flag=:login_flag
 WHERE mhc_user_id =:mhc_user_id");
            
			$stmt2->bindValue(':mhc_user_id', $mhc_user_id); 
			$stmt2->bindparam(":session_id", $session_id);
			$stmt2->bindparam(":login_flag", $login_flag);
			
			$stmt2->execute();
						
   
           return $stmt2; 
             }
             else
             {
                return false;
             }
          }
		  
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("location:$url");
   }
    public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>