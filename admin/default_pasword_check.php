<?php

$stmt = $DB_con->prepare("SELECT * FROM mhc_users WHERE mhc_user_id=:uname and status='A' and default_pass='Y'");
					$stmt->execute(array(':uname'=>$_SESSION['user_session']));
					if($stmt->rowCount() > 0){
						$url="changepwd.php?edit_id=".base64_encode($_SESSION['user_session'])."&CheckString=".$chkstr."&".md5('page_id')."=".$page_id;
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';	
die();				

					}
?>