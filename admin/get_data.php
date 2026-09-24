<?php
require('config/dbconfig.php');

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
function handlePostDocumentDetails()
{
	global $CIS_DB;
	global $bd;
	global $HCMAS_DB;
	global $DB_con;
	global $validator;
	
	
	$action=$_POST['action'];
	switch($action)
	{
		
		case 'mobilechk':
		$mobile=htmlspecialchars(filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_STRING));
		if(empty($mobile))
   {
      
      echo "Enter your Mobile Number !";
   }
   else if(strlen($mobile)!=10){
					echo 'Enter Valid Mobile Number!';
   }
  else if(!empty($mobile) && $validator->chkbadchar($mobile) == false)
 {
  echo "Please enter valid Mobile Number ";
 }
 else if(!empty($mobile) && $validator->test_datatype($mobile,"[^0-9]") == false)
 {
  echo "Please enter valid  Numeric  Mobile Number";
 }
 else
 {
		$sql="SELECT mobile FROM mhc_users where mobile='".$_POST['mobile_no']."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) {
		echo 1;
		}
		else
		{
			echo 2;
		}
	}
		
		break;
		case 'usernamechk':
		$username=htmlspecialchars(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
		if(empty($username))
   {
      
      echo "Enter your UserName !";
   }
else if(!empty($username) && $validator->chkbadchar($username) == false)
 {
  echo "Please enter valid UserNamer ";
 }
 else
 {
		$sql="SELECT username FROM mhc_users where username='".$_POST['username']."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) {
		echo 1;
		}
		else
		{
			echo 2;
		}
	}
		
		break;
		case 'emailchk':
		$email_id=htmlspecialchars(filter_input(INPUT_POST, 'e_mail_id', FILTER_SANITIZE_STRING));
		if(empty($email_id))
   {
      
      echo "Enter your Email id !";
   }
 else if(!filter_var(trim($email_id), FILTER_VALIDATE_EMAIL))
 {
  echo "Please enter valid Email id ";
 }
 else
 {
		$sql="SELECT email_id FROM mhc_users where email_id='".$_POST['e_mail_id']."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) {
		echo 1;
		}
		else
		{
			echo 2;
		}
	}
		
		break;
		
		case 'contacchk':
		$cont_num=htmlspecialchars(filter_input(INPUT_POST, 'cont_num', FILTER_SANITIZE_STRING));
		if(empty($cont_num))
   {
      
      echo "Enter your Contact Number !";
   }
   else if(strlen($cont_num)!=8){
					echo 'Enter Valid Contact Number!';
   }
  else if(!empty($cont_num) && $validator->chkbadchar($cont_num) == false)
 {
  echo "Please enter valid Contact Number ";
 }
 else if(!empty($cont_num) && $validator->test_datatype($cont_num,"[^0-9]") == false)
 {
  echo "Please enter valid  Numeric  Contact Number";
 }
 else
 {
		$sql="SELECT reg_contact_no FROM registrars where reg_contact_no='".$_POST['cont_num']."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) {
		echo 1;
		}
		else
		{
			echo 2;
		}
	}
		
		break;
		
		case 'faxnochk':
		$fax_num=htmlspecialchars(filter_input(INPUT_POST, 'fax_num', FILTER_SANITIZE_STRING));
		if(empty($fax_num))
   {
      
      echo "Enter your FAX Number !";
   }
   else if(strlen($fax_num)!=8){
					echo 'Enter Valid FAX Number!';
   }
  else if(!empty($fax_num) && $validator->chkbadchar($fax_num) == false)
 {
  echo "Please enter valid FAX Number ";
 }
 else if(!empty($fax_num) && $validator->test_datatype($fax_num,"[^0-9]") == false)
 {
  echo "Please enter valid  Numeric  FAX Number";
 }
 else
 {
		$sql="SELECT reg_fax_no FROM registrars where reg_fax_no='".$fax_num."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) 
		{
		echo 1;
		}
		else
		{
			echo 2;
		}
	}
		
		break;
		
		case 'rtusermobileno':
		$username=htmlspecialchars(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
		if(empty($username))
   {
      
      echo "Enter your UserName !";
   }
else if(!empty($username) && $validator->chkbadchar($username) == false)
 {
  echo "Please enter valid UserName ";
 }
 else
 {
		$sql="SELECT mobile_no FROM mhc_rti_users where mobile_no='".$_POST['username']."' ";
		$res=$DB_con->query($sql);
		if($res->rowCount() > 0) {
		echo 1;
		}
		else
		{
			function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

			 $password=randomPassword();
			
			$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$enctype_pass= password_hash($password, PASSWORD_BCRYPT, $options);
			$stmt = $DB_con->prepare("INSERT INTO mhc_rti_users(
           	mobile_no, password)VALUES(:username,:enctype_pass)");	
			$stmt->bindparam(":username", $username);  
			$stmt->bindparam(":enctype_pass", $enctype_pass);
			if($stmt->execute())
			{
			echo 2;
			}
		}
	}
		
		break;
		
		case 'getCourtName1':
		$option_arr='';
		$disp='Y';
		$sql=$DB_con->prepare("SELECT court_code,court_name FROM court_det WHERE dist_id = :dist_id  AND disp = :disp  and court_end is null order by court_name ");
		$sql->bindparam(":dist_id",$_POST['dist_id']);
		$sql->bindparam(":disp",$disp);
		if($sql->execute()) 
		{$option_arr .="<option value='' selected disabled >Select Court</option>";
		while ($row = $sql->fetch()) {
			if($_POST['court_code']=='A'||(isset($_POST['modify'])&&$_POST['modify']==true))
			{
				if($row['court_code']==$_POST['court_code'])
				$option_arr .="<option value='".$row['court_code']."' selected >".$row['court_name']."</option>";
			else
				$option_arr .="<option value='".$row['court_code']."' >".$row['court_name']."</option>";
			}
			else{
			/*if($row['court_code']==$_POST['court_code'])
				$option_arr .="<option value='".$row['court_code']."' selected >".$row['court_name']."</option>";*/
			$option_arr .="<option value='".$row['court_code']."'  >".$row['court_name']."</option>";
			}
		}
		}
		echo ($option_arr);
		break;
	}
}
	?>