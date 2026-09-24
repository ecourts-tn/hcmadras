<?php
session_start();
include 'config/dbconfig.php';
include 'function/login_fun.php';
$login =new lOGIN($DB_con);


	$login_tym=date("Y-m-d h:i:sa");
//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}	
	 $sucess_msg="Logout Sucessfully";
	 $uname=$_SESSION['user_session'];
	  if($login->login_error($uname,$sucess_msg,$ip,$login_tym))
	 {
				
			
if($_SESSION['roll']=='J')
{
    $_SESSION = array();

 if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
	//var_dump($params);
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

ini_set('session.gc_maxlifeime','1');
ini_set('session.gc_probability', '1');
ini_set('session.gc_divisor', '1');

	session_destroy();

   header("Location: jud_login.php");
}
else if($_SESSION['roll']=='R')
{
    $_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
	//var_dump($params);
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

ini_set('session.gc_maxlifeime','1');
ini_set('session.gc_probability', '1');
ini_set('session.gc_divisor', '1');

	session_destroy();

   header("Location: rti_login.php");
}
else
{
	$update_user_id=$_SESSION['user_session'];
				$session_id=NULL;
				$login_flag=0;
$stmt1 = $DB_con->prepare("UPDATE mhc_users
   SET  session_id=:session_id,login_flag=:login_flag
 WHERE mhc_user_id =:update_user_id");
            
			$stmt1->bindValue(':update_user_id', $update_user_id); 
			$stmt1->bindparam(":session_id", $session_id);
			$stmt1->bindparam(":login_flag", $login_flag);
			$stmt1->execute();
			 $_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
	//var_dump($params);
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    ); 
	
	/*$arr_cookie_options = array (
                'expires' => time() + 60*60*24*30,
                'path' => '/',
                'domain' => '.example.com', // leading dot for compatibility or use subdomain
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'None' // None || Lax  || Strict
                );
				setcookie(session_name(), '', $arr_cookie_options);   */
}
//session_gc();
ini_set('session.cookie_lifetime','0');
ini_set('session.gc_maxlifeime','1');
ini_set('session.gc_probability', '1');
ini_set('session.gc_divisor', '1');
session_destroy();

   header("Location: index.php");
}
	 }
	 else
	 {
	 	 
//session_gc();
if($_SESSION['roll']=='J')
{
	session_destroy();

   header("Location: jud_login.php");
}
if($_SESSION['roll']=='R')
{
	session_destroy();

   header("Location: rti_login.php");
}
else
{
session_destroy();

   header("Location: index.php");
}
	 }
    ?>
