<?php
class LOGFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id)
    {
		
       try
       {
			$page_id=base64_decode($page_id);
			//error_log("INSERT INTO user_logs(	user_id, page_id,ip, message,action,record_id) VALUES($mhc_user,$page_id,$ip,$message,$action,$record_id)");
			$stmt = $this->db->prepare("INSERT INTO user_logs(
           	user_id, page_id,ip, message,action,record_id) 
						VALUES(:mhc_user,:page_id,:ip,:message,:action,:record_id)");	
			$stmt->bindparam(":mhc_user", $mhc_user);  
			$stmt->bindparam(":page_id",$page_id);
			$stmt->bindparam(":ip", $ip); 
			$stmt->bindparam(":message", $message); 
			$stmt->bindparam(":action", $action);	 
			$stmt->bindparam(":record_id", $record_id);
			if($stmt->execute())
			{
				
				
				/* $sms=$message.'-Action User '.$mhc_user;
				
				
				global $SMS_DB; 	
		$sqlFetchDet1 = $SMS_DB->prepare("SELECT * FROM Connection_details");
		$sqlFetchDet1->execute();
		$row = $sqlFetchDet1->fetch();
		
		$uname = $row["user_name"];
		$pass = $row["pass_word"];
		$send = $row["sender"];
		$dlt_entity_id = trim($row["dlt_entity_id"]);
		$dlt_template_id= trim($row["dlt_template_id"]);
		
			$mhc_user = $this->db->prepare("SELECT full_name,mobile FROM mhc_users WHERE roll='A' AND mobile!='' ORDER BY mhc_user_id");
			$mhc_user->execute();				 
			while ($user_row= $mhc_user->fetch()) 
			{
					
	$mhc_user_name=$user_row['full_name'];	
	$dest1 = $user_row['mobile'];
	$msg1 = $sms;
	$dest = trim($dest1);
	$msg = trim($msg1);
	$URL = "https://smsgw.sms.gov.in/failsafe/HttpLink";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $URL);
	$mystring = $URL;
	$findme = "https";
	$pos1 = strpos($mystring, $findme);
	if (-1 < $pos1) {
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	}
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$uname&pin=$pass&signature=$send&mnumber=$dest&message=$msg&dlt_entity_id=$dlt_entity_id&dlt_template_id=$dlt_template_id");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$curl_output1 = curl_exec($ch);
	$pos = strpos($curl_output1, "Accepted");
	$curl_output2="";
	$sent='';
		if ($pos != "") {
			$sent = "Y";
			$first = explode("=", $curl_output1);
			$second = explode("~", $first[1]);
			$curl_output2 = $second[0];
		}
		else {
			$sent = "F";
			$curl_output2 = "Invalid Destination";
		}
		$send_sms = $this->db->prepare("INSERT INTO mhc_sms(
           	mhc_user, mobile_no,message, sms_flag,sms_output) 
			VALUES(:mhc_user_name,:dest1,:sms,:sent,:curl_output2)");
$send_sms->bindparam(':mhc_user_name', $mhc_user_name);
$send_sms->bindparam(':dest1', $dest1);
$send_sms->bindparam(':sms', $sms);
$send_sms->bindparam(':sent', $sent);
$send_sms->bindparam(':curl_output2', $curl_output2);
$send_sms->execute();
				} */
			}
			
			
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
	}

		public function log_data()
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM user_logs");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					$user_id=$row['user_id'];
					$page_id=$row['page_id'];
					 $stmt2 = $this->db->prepare("SELECT  full_name FROM mhc_users where mhc_user_id=:user_id");
 $stmt2->execute(array(':user_id' => $user_id));
 $userRow=$stmt2->FETCH(PDO::FETCH_ASSOC);
 
 $stmt3 = $this->db->prepare("SELECT  page_name FROM mhc_menu where menu_id=:page_id");
 $stmt3->execute(array(':page_id' => $page_id));
 $pageRow=$stmt3->FETCH(PDO::FETCH_ASSOC);
					
					$date=date('d-m-Y h:m:s',strtotime($row['create_modify']));
					
					$action_data=wordwrap($row['action'], 20, "<br/>\n");
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$userRow['full_name'].'</td>
                          <td>'.$row['ip'].'</td>
						  <td>'.$pageRow['page_name'].'</td>
                          <td>'.$row['record_id'].'</td>
                          <td>'.$row['message'].'</td>
                          <td>'.$row['action'].'</td>
                          <td>'.$date.'</td>
                          </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	} 
public function redirect($url)
   {
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
		
   }
}
?>