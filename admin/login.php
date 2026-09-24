<?php
header("cache-control: no-cache, no-store, must-revalidate");  
header("pragma: no-cache");
header('expires: 0');
ini_set( 'session.cookie_httponly', 1 );
ini_set ('session.use_trans_sid',0);
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
ini_set('docref_root', '0');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');


//session_start();
include 'config/dbconfig.php';
date_default_timezone_set("Asia/Kolkata");

$cookie_name = 'pontikis_net_php_cookie';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time() - 3600);


//session_gc();
//session_destroy();
//session_start();
$_SESSION['loginid']='';
//session_regenerate_id();
$_SESSION['loginid']=session_id();

$ses_id=$_SESSION['user_session'];

 $expireAfter = 30;

//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
     $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        //echo "haiiiii";
		session_unset();
		setcookie("PHPSESSID","",time()-3600,"/"); // delete session cookie  
        session_destroy();
		
		$url="index.php";
$delay = "0";
echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

    }
    
}
 $_SESSION['last_action'] = time();
 
if($_SESSION['loginid']!=session_id())
{
		$url="logout.php";
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
		
}
else
{
	

if($_SESSION['session_id']!=$_SESSION['login_session'])
{
	
$url="logout.php";
$delay = "0";
echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

}
else
{
	
	 if(isset($_GET['CheckString'])) 
{ 
$chkstr=$_GET['CheckString']; 
} 
 else if(isset($_POST['CheckString']))  
{ 

$chkstr=$_POST['CheckString'];

 }
  else 
{ 

$chkstr="";

 }
  if(password_verify($_SESSION['ses_value'], $chkstr))
 {
	 if(($_SESSION['pageid']=='') || ($_SESSION['loginid']=='') || ($_SESSION['loginid']!=session_id()))
		{
				
		$url="logout.php";
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

		}
		 else
 {
	
	// include 	$page;
	 
		$url="dashboard.php?CheckString=".$chkstr;
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
	
 }
 }
}
}

 

?>