<?php
include "config.php";
/* session_start();
 if(isset($_SESSION['login_user'])) 
{
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysql_query("select name from hc_users where username='$user_check'");
	if(mysql_num_rows($ses_sql)==1)
	{
		$row = mysql_fetch_array($ses_sql);
		$login_session = $row['name'];
		
	}
	
} */
 session_start();
 if(isset($_SESSION['login_user'])) 
{

	$user_email = $_SESSION['login_user'];	
	$usercheck = $conn->prepare('SELECT * FROM "hc_users" WHERE usr_login_id=:user_email');
	$usercheck->bindValue(':user_email', $user_email);	
	$usercheck->execute();
	$ses_det=$usercheck->fetch();
    //print_r($REC_DB->errorInfo());
	
	
	if(!empty($ses_det))
	{
	echo $login_session = $ses_det['usr_login_id'];
		 $aname=$ses_det['usr_name'];
		//$midname=$ses_det['midname'];
        //$lastname=$ses_det['lastname'];
		
		$login_type = $ses_det['usr_type'];
		
	}
	
	
}
 function parms($string,$data)
  {
        $indexed=$data==array_values($data);
        foreach($data as $k=>$v)
		{
            if(is_string($v)) $v="'$v'";
            if($indexed) $string=preg_replace('/\?/',$v,$string,1);
            else $string=str_replace(":$k",$v,$string);
        }
        return $string;
  }
  
  
	?>