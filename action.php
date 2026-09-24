<?php
require('config/dbconfig.php');
require('config/dbconfig_status.php');
require_once('mailer/class.phpmailer.php');
include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

switch ($_SERVER["REQUEST_METHOD"]) 
{
	case 'GET':
		handleGetDocumentDetails();
		break;

	case 'POST';
		handlePostDocumentDetails();
		break;
}
function handleGetDocumentDetails()
{
}
function sendMailOTP($email_id,$mail_otp,$DB_con)
{
	
		$body = '<p align="left">Dear Sir/Madam</b>,</p><p>Your OTP for feedback in highcourt website is: <b>'.$mail_otp.'</b>.</p>';
		$mail =new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "10.236.242.79"; // SMTP server
		$mail->SMTPDebug  = 1;                     	// enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  	// enable SMTP authentication
		$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
		$mail->SMTPSecure = 'ssl'; 
		$mail->Username   = "syanltmhc.ecourts"; // SMTP account username
		$mail->Password   = "Mypass#@1";        // SMTP account password
		$mail->SetFrom('syanltmhc.ecourts@tn.gov.in', 'Madras High Court'); 
		
		$mail->Subject    = "OTP for MHC Website Feedback";
		
		$mail->MsgHTML($body);
		
		//$mail->AddAttachment($location);      // attachment
		
		
		$mail->AddAddress($email_id);
		if(!$mail->Send()) {				
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else
		{	$stmt = $DB_con->prepare("INSERT INTO mhc_feedback(
           	mail_id, mail_otp) 
						VALUES(:email_id,:mail_otp)");	
			$stmt->bindparam(":email_id", $email_id);  
			$stmt->bindparam(":mail_otp", $mail_otp);
			$stmt->execute();
			echo "Success";
		}
}
function handlePostDocumentDetails()
{
	global $CIS_DB;
	global $bd;
	global $HCMAS_DB;
	global $DB_con;
	global $validator;
	global $MDU_HCMAS_DB;
	global $MDU_CIS_DB;
	
	$action=$_POST['action'];
	switch($action)
	{
		
		case 'getcourt':
		$cause_list_dt=htmlspecialchars(filter_input(INPUT_POST, 'cause_list_dt', FILTER_SANITIZE_STRING));
		if(empty($cause_list_dt))
   {
      
      echo 2;
   }
  
  
 else
 {
	 $c_date=date('Y-m-d',strtotime($cause_list_dt));
		 $stmt1 = $HCMAS_DB->prepare("SELECT distinct(court_id) FROM causelist_title where  court_id IS NOT NULL AND court_id!='' AND cause_list_status='P' AND causelist_sr_no!='0' and court_id!='0' and court_id!='00' and court_id!='000' and court_id!=' 0' and court_id!='-' and court_id!='.' and causelist_date='".$c_date."' AND published='Y' order by court_id ");
												$stmt1->execute();	
												
												if($stmt1->rowCount() > 0) {
													echo '<option value="" >Choose Court No</option>     ';
												while ($row1 = $stmt1->fetch()) 
												{
													echo '<option value="'.$row1['court_id'].'">'.$row1['court_id'].'</option>';
												}
		
	
		}
		else
		{
			echo 2;
		}
	}
		
		break;
	
	case 'getmducourt':
		$cause_list_dt=htmlspecialchars(filter_input(INPUT_POST, 'cause_list_dt', FILTER_SANITIZE_STRING));
		if(empty($cause_list_dt))
   {
      
      echo 2;
   }
  
  
 else
 {
	 $c_date=date('Y-m-d',strtotime($cause_list_dt));
		 $stmt1 = $MDU_HCMAS_DB->prepare("SELECT distinct(court_id) FROM causelist_title where  court_id IS NOT NULL AND court_id!='' AND cause_list_status='P' AND causelist_sr_no!='0' and court_id!='0' and court_id!='00' and court_id!='000' and court_id!=' 0' and court_id!='-' and court_id!='.' and causelist_date='".$c_date."' AND published='Y' order by court_id ");
												$stmt1->execute();	
												
												if($stmt1->rowCount() > 0) {
													echo '<option value="" >Choose Court No</option>     ';
												while ($row1 = $stmt1->fetch()) 
												{
													echo '<option value="'.$row1['court_id'].'">'.$row1['court_id'].'</option>';
												}
		
	
		}
		else
		{
			echo 2;
		}
	}
		
		break;
	case 'getCaseType':
		$bench=htmlspecialchars(filter_input(INPUT_POST, 'bench', FILTER_SANITIZE_STRING));
		if(empty($bench))
   {
      
      echo 2;
   }
  
  
 else
 {
		 if($bench=="MHC")
				$DB_option=$HCMAS_DB;
			else
				$DB_option=$MDU_HCMAS_DB;
	 
	 $stmt = $DB_option->prepare("SELECT case_type,type_name,full_form FROM case_type_t where display='Y' ORDER BY case_type");
				 $stmt->execute();				 
				if($stmt->rowCount() > 0) {
					echo '<option value="">Choose Case Type</option>';
				while ($row = $stmt->fetch()) 
				{
					
						echo '<option value="'.$row['case_type'].'">'.$row['type_name'].'_'.$row['full_form'].'</option>';
					}
				}
		
		else
		{
			echo 2;
		}
	}
		
		break;
	
		
	
		case 'sendotp':
		 $email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
		  $mob_no=htmlspecialchars(filter_input(INPUT_POST, 'mob', FILTER_SANITIZE_STRING));
		// Function to generate OTP
function generateNumericOTP($n) {
      
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";
  
    // Iterate for n-times and pick a single character
    // from generator and append it to $result
      
    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
  
    // Return result
    return $result;
}
  
// Main program
$n = 6;

		$mobile_otp=generateNumericOTP($n);
		
		if(empty($email_id)||empty($mob_no))
   {
      echo 2;
   }
  else
  {
	  
	  
	//	sendMailOTP($email_id,$mail_otp,$DB_con);
	
	      $stmt = $DB_con->prepare("INSERT INTO mhc_feedback(
           	mail_id,mobile_no, mobile_otp) 
						VALUES(:email_id,:mobile_no,:mobile_otp)");	
			$stmt->bindparam(":email_id", $email_id);  
			$stmt->bindparam(":mobile_no", $mob_no); 
			$stmt->bindparam(":mobile_otp", $mobile_otp);
			$stmt->execute();
			echo $mobile_otp;
			
  }
  
 
		
		break;
		
		
			case 'otpcheck':
		 $email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
		 $mob_no=htmlspecialchars(filter_input(INPUT_POST, 'mob_no', FILTER_SANITIZE_STRING));
		 $mobile_otp=htmlspecialchars(filter_input(INPUT_POST, 'mobile_otp', FILTER_SANITIZE_STRING));
		


		
		if(empty($email_id))
   {
      echo 2;
   }
   else	if(empty($mobile_otp))
   {
      echo 2;
   }
   else if (empty($mob_no))
	   echo 2;
  else
  {
	  //var_dump("SELECT * FROM mhc_feedback where  feedback_msg IS NULL AND mail_id='".$email_id."' AND mail_otp='".$email_otp."' order by create_modify DESC ");
	      /*  $stmt1 = $DB_con->prepare("SELECT * FROM mhc_feedback where  feedback_msg IS NULL AND mail_id='".$email_id."' AND mobile_otp='".$mobile_otp."' and mobile_no ='".$mob_no."'order by create_modify DESC ");*/
		  $stmt1 = $DB_con->prepare("SELECT * FROM mhc_feedback where  feedback_msg IS NULL AND mail_id=:email_id AND mobile_otp=:mobile_otp and mobile_no =:mob_no order by create_modify DESC ");
		  $stmt1->bindValue(":email_id", $email_id);  
			$stmt1->bindValue(":mob_no", $mob_no);
			$stmt1->bindValue(":mobile_otp", $mobile_otp);
			$stmt1->execute();
			if($stmt1->rowCount() > 0) 
			{
				echo '1';
				
			}
			else
			{
						echo '2';							
			}									
  }
  
 
		
		break;
		case 'feedback_msg':
		
		$email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
		$mob_no=htmlspecialchars(filter_input(INPUT_POST, 'mob_no', FILTER_SANITIZE_STRING));
		 $mobile_otp=htmlspecialchars(filter_input(INPUT_POST, 'mobile_otp', FILTER_SANITIZE_STRING));
		 $feedback_msg=htmlspecialchars(filter_input(INPUT_POST, 'feedback_msg', FILTER_SANITIZE_STRING));

		
		
		if(empty($email_id))
   {
      echo 2;
   }
   else	if(empty($mobile_otp))
   {
      echo 2;
   }
   	else if(empty($feedback_msg))
   {
      echo 2;
   }
   else if(empty($mob_no))
   {
      echo 2;
   }
  else
  {
	$stmt_chk= $DB_con->prepare("select * from mhc_feedback where feedback_msg is null and mail_id=:email_id and mobile_no=:mob_no and mobile_otp=:mobile_otp order by create_modify desc limit 1");
	$stmt_chk->bindValue(":email_id", $email_id);  
			$stmt_chk->bindValue(":mob_no", $mob_no);
			$stmt_chk->bindValue(":mobile_otp", $mobile_otp);
			$stmt_chk->execute();
			if($stmt_chk->rowCount()>0)
		    {
					$stmt = $DB_con->prepare("UPDATE mhc_feedback SET  feedback_msg=:feedback_msg where   mail_id=:email_id and mobile_otp=:mobile_otp and mobile_no=:mob_no");	
					$stmt->bindValue(":email_id", $email_id);  
					$stmt->bindValue(":mobile_otp", $mobile_otp);
					$stmt->bindparam(":feedback_msg", $feedback_msg);
					$stmt->bindValue(":mob_no", $mob_no);
					if($stmt->execute())
					{
						echo 1;
					}
					else
					{
						echo 2;
				}
			
			
  }
  else echo 2;
  
 
		
		break;
		
	}
}}
	?>