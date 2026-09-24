<?php
header("cache-control: no-cache, no-store, must-revalidate");  
header("pragma: no-cache");
header('expires: 0');
header('Content-Type:text/html; charset=UTF-8');
ini_set( 'session.cookie_httponly', 1 );
ini_set ('session.use_trans_sid',0);
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
ini_set('docref_root', '0');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

include 'config/dbconfig.php';
date_default_timezone_set("Asia/Kolkata");

$cookie_name = 'pontikis_net_php_cookie';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time() - 3600);
//session_start();
//session_gc();
//session_destroy();
//session_start();
$_SESSION['loginid']='';
//session_regenerate_id();
$_SESSION['loginid']=session_id();
$ses_id=$_SESSION['user_session'];
 $expireAfter = 30;
if($ses_id=='')
{
header("Location:logout.php");
}
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
		//session_unset();
		//setcookie("PHPSESSID","",time()-3600,"/"); // delete session cookie  
        //session_destroy();
		
		$url="logout.php";
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
 $chkstr=filter_var($_GET['CheckString'], FILTER_SANITIZE_STRING); 
} 
 else if(isset($_POST['CheckString']))  
{ 
$chkstr=filter_var($_POST['CheckString'], FILTER_SANITIZE_STRING);

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

 }
 else
 {
	 $url="logout.php";
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
		
 }
}
}

  if(isset($_GET['1a63c8004d716c8b91f5b7af780555b9']))
	 {
		$page_id=filter_var($_GET['1a63c8004d716c8b91f5b7af780555b9'], FILTER_SANITIZE_STRING);
		
		
		//echo "bsfnnetjetyj".$page_id;
	 }
	else
	{
		$page_id=base64_encode('active'); 
	}	
	
	
$mhc_user=$_SESSION['user_session'];
		//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}

include 'function/log_fun.php';
$log_fun =new LOGFUN($DB_con);	
?>
<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard | MHC Admin </title>
    <link href="css/css.css" rel="stylesheet" />
	  <link rel="stylesheet" href="css/bootstrap.min.css?v4.0.2">
    <link href="css/lite-purple.min.css" rel="stylesheet" />
    <link href="css/perfect-scrollbar.min.css" rel="stylesheet" />
	   <link rel="stylesheet" href="css/datatables.min.css" />
	   <link rel="stylesheet" href="css/jquery-ui.css" />
	   <link rel="stylesheet" href="css/richtext.min.css">
		 <link href="css/latest-multiselect.css" rel="stylesheet">
		 <link href="css/sweetalert.min.css" rel="stylesheet">
				
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-header">
            <div class="logo">
                <img src="images/logo.png" alt="">
            </div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="d-flex align-items-center">
             
            </div>
            <div style="margin: auto"></div>
            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
                
                <!-- Notificaiton -->
                <div class="dropdown">
                  
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                        
                    </div>
                </div>
                <!-- Notificaiton End -->
                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
					<?php
			if($_SESSION['roll']=='R')
					{
						if($_SESSION['profile_status']=='N')
						{
				?>
				 <img src="images/user.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php
						}
						else
						{
						?>
						<img src="view_image.php?img_id=<?php echo  base64_encode($_SESSION['user_session']);?>&page=<?php echo  base64_encode('RTI');?>" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php
					}
					}
						else
						{
				?>
                        <img src="images/user.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php
						}
						?>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<?php
			if($_SESSION['roll']=='R')
					{
						if($_SESSION['profile_status']=='N')
						{
				?>
				<div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> <?php echo $_SESSION['user_name']; ?>
                            </div>
                            
                            <!--<a class="dropdown-item">Billing history</a>-->
							<a class="dropdown-item" href="changepwd.php?edit_id=<?php echo base64_encode($_SESSION['user_session'])?>&CheckString=<?php echo $chkstr ?>&<?php echo md5('page_id')?>=<?php echo $page_id;?>">Change password</a>
                            <a class="dropdown-item" href="logout.php">Sign out</a>
				<?php
						}
						else
						{
						?>
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> <?php echo $_SESSION['full_name']; ?>
                            </div>
                           <a href="rti_user_profile.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id')?>=<?php echo $page_id ?>" class="dropdown-item">Profile</a>
						   <a class="dropdown-item" href="changepwd.php?edit_id=<?php echo base64_encode($_SESSION['user_session'])?>&CheckString=<?php echo $chkstr ?>&<?php echo md5('page_id')?>=<?php echo $page_id;?>">Change password</a>
                            <a class="dropdown-item" href="logout.php">Sign out</a>
							<?php
						}
					}
					else
					{
						?>
					<div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> <?php echo $_SESSION['user_name']; ?>
                            </div>
                            <!--<a class="dropdown-item">Account settings</a>
                            <a class="dropdown-item">Billing history</a>-->
							<a class="dropdown-item" href="changepwd.php?edit_id=<?php echo base64_encode($_SESSION['user_session'])?>&CheckString=<?php echo $chkstr ?>&<?php echo md5('page_id')?>=<?php echo $page_id;?>">Change password</a>
                            <a class="dropdown-item" href="logout.php">Sign out</a>
							<?php
					}
					?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-content-wrap">
		<?php include 'menu.php';
		
	/*	echo base64_decode($page_id)."=====$page_id_data";
	if(isset($_GET['1a63c8004d716c8b91f5b7af780555b9'])&&$page_id!=$page_id_data)
		{
		$url="logout.php";
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

		}*/
		if(!is_numeric(base64_decode($page_id))&&!in_array(base64_decode($page_id), $menu_page_id)&&'active'!=base64_decode($page_id))
		{
		$url="logout.php";
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

		}
		?>
           
            <div class="sidebar-overlay"></div>
        </div>