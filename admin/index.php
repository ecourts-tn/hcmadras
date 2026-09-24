<?Php
header ("Cache-Control: no-cache, must-revalidate");  
header ("Pragma: no-cache");
header('Content-Type:text/html; charset=UTF-8');
session_start();
include 'config/dbconfig.php';
include 'function/login_fun.php';
$login =new lOGIN($DB_con);
include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
if($login->is_loggedin()!="")
{
 $login->redirect('dashboard.php');
} 

$length = 32;
$value=substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
$options = [
			'cost' => 11,
			//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$enctype_token= password_hash($value, PASSWORD_BCRYPT, $options);
$_SESSION['pageid']=$enctype_token;
$_SESSION['ses_value']=$value;


if($login->is_loggedin()!="")
{
 $login->redirect('dashboard.php?CheckString='.$_SESSION['pageid']);
}  


if(isset($_POST['login']))
{
	
//session_gc();
session_regenerate_id();
$_SESSION['loginid']=session_id();
$_SESSION['log']=session_id();
		
		 $password=$_POST['password'];
 $encrypted = base64_decode($password);
$key = hex2bin('74bf72ec01ab95dfba63feabdc78302a');
$iv = hex2bin('bc25ad795fca895bdfe9452afbe7362c');
$pass = openssl_decrypt($encrypted, 'AES128', $key, OPENSSL_RAW_DATA, $iv);

	/*$key = pack("H*", "74bf72ec01ab95dfba63feabdc78302a");
$iv =  pack("H*", "bc25ad795fca895bdfe9452afbe7362c");
//Now we receive the encrypted from the post, we should decode it from base64,
 $encrypted = base64_decode($password);
$pass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv);*/
$passed = str_replace($_SESSION['time'],"",$pass);
 $string = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $passed);
		
  $uname = $_POST['username'];
   $upass = $string;
$security_code=$_POST["captcha"];

if ($_SESSION['user_phrase']!=$security_code)
		{ 	
	
			$error = " - Invalid Captcha...";	
			
 
}
else
{
	$_SESSION['login_flag']='';
 $login_tym=date("Y-m-d h:i:sa");
	 //timestamp
	 $cur_date=date("Y-m-d");				
		
		
		//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}	
 if(empty($uname))
   {
      
      $error = "Enter your Username !";
   }
 else if(!empty($uname) && $validator->chkbadchar($uname) == false)
 {
  $error= "Please enter valid Username";
 }
 else if(empty($upass))
   {
      
      $error = "Enter your Password !";
   }
 else if(!empty($upass) && $validator->chkbadchar($upass) == false)
 {
  $error= "Please enter valid Password";
 }
else 
{
	
	$login_flag= $login->already_login($uname,$upass);
	  if($login_flag==1)
 {
	 $error = "User Already Login Please Unlock your Acount and Unlock Link Sent Your Register Mail Id ! <button class='btn btn-primary' type='button' data-toggle='modal' data-target='#exampleModalCenter'>Click here to unlock your Account</button>";
 }
 else
 {
 if($login->login($uname,$upass))
 {
	
	 $sucess_msg="Autherized Person";
	 if($login->login_info($uname,$sucess_msg,$ip,$login_tym))
	 {
		 if($_SESSION['loginid']!=session_id())
			{
					$url="index.php";
					$delay = "0";
					echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
			}
			else
			{		 
	         $login->redirect('login.php?CheckString='.$_SESSION['pageid']);
			}
	 }
 }
else
 {
	 
  $sucess_msg="Unautherized Person";
	  if($login->login_error($uname,$sucess_msg,$ip,$login_tym))
	 {
  $error = "Wrong Details!";
	 }
	 
 }	
 }

 
}
}
}
if(isset($_POST['unlock']))
{
	 $security_code1=$_POST["uncaptcha"];
	 $_SESSION['user_phrase1'];
	if ($_SESSION['user_phrase1']!=$security_code1)
		{ 	
	
			$error = "...Invalid Captcha...</br><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#exampleModalCenter'>Click here to unlock your Account</button>";	
			
 
}
else
{
	 $password1=$_POST['unpassword'];
	/*$key1 = pack("H*", "74bf72ec01ab95dfba63feabdc78302a");
$iv1 =  pack("H*", "bc25ad795fca895bdfe9452afbe7362c");
//Now we receive the encrypted from the post, we should decode it from base64,
 $encrypted1 = base64_decode($password1);
$pass1 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key1, $encrypted1, MCRYPT_MODE_CBC, $iv1);*/
$encrypted1 = base64_decode($password1);
$key1 = hex2bin('74bf72ec01ab95dfba63feabdc78302a');
$iv1 = hex2bin('bc25ad795fca895bdfe9452afbe7362c');
$pass1 = openssl_decrypt($encrypted1, 'AES128', $key1, OPENSSL_RAW_DATA, $iv1);
$passed1 = str_replace($_SESSION['time'],"",$pass1);
 $string1 = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $passed1);
		
   $uname1 = $_POST['unusername'];
    $upass1 = $string1;
   
    if($login->unlock($uname1,$upass1))
	 {
		 $login->redirect('index.php?joined1');
 
	 }
	 else
	 {
		  $error = "Wrong Details!</br><button class='btn btn-primary' type='button' data-toggle='modal' data-target='#exampleModalCenter'>Click here to unlock your Account</button>";
	 }
		 
}
	
}
?>
<!DOCTYPE html>
<html lang="en" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signin | MHC Admin </title>
    <link href="css/font_1.css" rel="stylesheet">
    <link href="css/lite-purple.min.css" rel="stylesheet">
</head>
<body>
<div class="auth-layout-wrap" style="background-image: url(images/gg.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="images/logo.png" alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
						  <?php
            if(isset($error))
            {
                  ?>
                   <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize"> <?php echo $error; ?></strong> 
                            <!--<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        </div>
                  <?php
            }
            else if(isset($_GET['joined']))
            {
                 ?>
				 <div class="alert alert-success">
                      <i class="glyphicon glyphicon-success-sign"></i> &nbsp;Your have Successfully registered and Your Login credentials Activated Shortly
                  </div>
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				<div class="alert alert-card alert-info ">
                      <i class=""></i> &nbsp;Your Account Unlock Successfully 
                  </div>
				 <?php
            }
			
			?>
 
			<form method="POST" action="index.php"  enctype="multipart/form-data"  autocomplete="off">
						
                            <div class="form-group">
                                <label for="email">User Name</label>
                                <input class="form-control form-control-rounded" id="unusername" name="username" type="uname" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control form-control-rounded" id="T2" name="password" type="password" autocomplete="off">
                            </div>
							 <div class="form-group">
                                <label for="password">Captcha</label>
                                <input class="form-control form-control-rounded" id="Capcha" name='captcha' type="text" autocomplete="off" required autocomplete="off">
                            </div>
							<div class="contact100-form-checkbox p-t-90">
<div class="checkbox checkbox-circle checkbox-info peers ai-c">
                                
								<a id="captcha_reload" href="#" class="btn btn-danger "><i class="i-Arrow-Refresh"></i></a>&nbsp; 
                                <span class="peer peer-greed"><img src="captcha.php" id="captcha_image"/></span>
                            </div>
</div>
<input type="hidden" name="rand" id="rand" value="<?php echo $rand = sha1(time());
	$_SESSION['time'] = $rand; ?>" />
                            <input type='submit' name="login" id="login" value="Sign In" class="btn btn-rounded btn-primary btn-block mt-2"/>
                        </form>
                        <!--<div class="mt-3 text-center"><a class="text-muted" href="#">
                                <u>Forgot Password?</u></a></div>-->
                    </div>
                </div>
                <div class="col-md-6 text-center" style="background-size: cover;background-image: url(images/mas2_520_245.jpg)">
                   <!-- <div class="pr-3 auth-right"><a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="signup.html"><i class="i-Mail-with-At-Sign"></i> Sign up with Email</a><a class="btn btn-rounded btn-outline-google btn-block btn-icon-text"><i class="i-Google-Plus"></i> Sign up with Google</a><a class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook"><i class="i-Facebook-2"></i> Sign up with Facebook</a></div>http://demos.ui-lib.com/gull/html/-->
                </div>
				
				  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle-2">Unlock Your Account</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
							<form method="POST" action="index.php"  enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                               <div class="form-group">
                                <label for="email">User Name</label>
                                <input class="form-control" id="unusername" name="unusername" type="uname" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="T3" name="unpassword" type="password" autocomplete="off">
								<input type="hidden" name="rand1" id="rand1" value="<?php echo $rand = sha1(time());
	$_SESSION['time'] = $rand; ?>" />
                            </div>
							 <div class="form-group">
                                <label for="password">Capcha</label>
                                <input class="form-control" id="Capcha" name='uncaptcha' type="text" autocomplete="off" required>
                            </div>
							<div class="contact100-form-checkbox p-t-90">
<div class="checkbox checkbox-circle checkbox-info peers ai-c">
                                
								<a id="captcha_reload1" href="#" class="btn btn-danger "><i class="i-Arrow-Refresh"></i></a>&nbsp; 
                                <span class="peer peer-greed"><img src="captcha1.php" id="captcha_image1"/></span>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <input type='submit' name='unlock' id='unlock' value='Unlock User' class="btn btn-primary ml-2" />
                            </div>
                        </div>
						</form>
                    </div>
                </div>
				
            </div>
        </div>
    </div>
</div>

    <script src="js/jquery-3.3.1.min.js"></script>
	 <script src="js/jsrep.js"></script>
	 <script src="js/cookies.min.js"></script>
	  <script src="js/bootstrap.bundle.min.js"></script>
 <script>
  	$(function()
{
	$('#captcha_reload').on('click',function(e)
	{
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image").attr("src", src+'?'+d.getTime());
	});
	
	$('#captcha_reload1').on('click',function(e)
	{
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image1").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image1").attr("src", src+'?'+d.getTime());
	});
	
});
$(document).ready(function() {
		
			$('#T2').blur(function(){
				
		var ndatevar =  sha256($("#T2").val()+$("#rand").val());
		//var pass =  sha256($("#T2").val());
		//var ndatevar = (($('#T2').val()));
		//alert(ndatevar);		
		//var ndatevar1 = $('#T3').val();
		
		$('#T2').val(ndatevar);
		
		if (ndatevar!=''){ 
			$('#limg').show();	
		}	
	});	
	
	$('#T3').blur(function(){
				
		var ndatevar =  sha256($("#T3").val()+$("#rand1").val());
		//var pass =  sha256($("#T2").val());
		//var ndatevar = (($('#T2').val()));
		//alert(ndatevar);		
		//var ndatevar1 = $('#T3').val();
		
		$('#T3').val(ndatevar);
		
		if (ndatevar!=''){ 
			$('#limg').show();	
		}	
	});	
	 });
 </script>
</body>

</html>