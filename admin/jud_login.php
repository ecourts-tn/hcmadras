<?Php
header ("Cache-Control: no-cache, must-revalidate");  
header ("Pragma: no-cache");
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
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
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
	$key = pack("H*", "0123456789abcdef0123456789abcdef");
$iv =  pack("H*", "abcdef9876543210abcdef9876543210");
//Now we receive the encrypted from the post, we should decode it from base64,
 $encrypted = base64_decode($password);
$pass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv);
$passed = str_replace($_SESSION['time'],"",$pass);
 $string = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $passed);
		
  $uname =$_POST['username'];
   $upass = $string;
   error_log($upass);
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
	

 if($login->login_meeting($uname,$upass))
 {
	
	 $sucess_msg="Autherized Person";
	 if($login->login_info($uname,$sucess_msg,$ip,$login_tym))
	 {
		 if($_SESSION['loginid']!=session_id())
			{
					$url="jud_login.php";
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


?>
<!DOCTYPE html>
<html lang="en" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MHC</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="css/lite-purple.min.css" rel="stylesheet">
</head>
<body>
<div class="auth-layout-wrap" style="background-image: url(images/bg2.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6 text-center" style="background-size: cover;background-image: url(images/009a.jpg)">
                    <div class="pl-3 auth-right">
                        <!--<div class="auth-logo text-center mt-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
                        <div class="flex-grow-1"></div>
                        <div class="w-100 mb-4"><a class="btn btn-outline-primary btn-block btn-icon-text btn-rounded" href="signin.html"><i class="i-Mail-with-At-Sign"></i> Sign in with Email</a><a class="btn btn-outline-google btn-block btn-icon-text btn-rounded"><i class="i-Google-Plus"></i> Sign in with Google</a><a class="btn btn-outline-facebook btn-block btn-icon-text btn-rounded"><i class="i-Facebook-2"></i> Sign in with Facebook</a></div>
                        <div class="flex-grow-1"></div>-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4">
                        <h1 class="mb-3 text-18">Judges Login</h1>
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
 
                        <form method="POST" action=""  enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Your name</label>
                                <select class="form-control" id="username" name="username" type="text">
								<option >Select</option>
									 <?php
										

$jud_qry = $DB_con->query("select j_id,j_name,j_coram,j_prefix from judges where j_page='PJ' AND j_display='Y' order by j_sen asc"); 
while($jud_result = $jud_qry->fetch()){
											
											
											$hon="Hon'ble ";
											$prefi=$jud_result['j_prefix'];
			
											$coram=$jud_result['j_coram'];
											$name=$jud_result['j_name'];
											
	if($coram=='CJ')
	{
		$fjudge=', Chief Justice';
		
	}else
	{
		
		$fjudge='';
	}
	
	$jud_name=$coram."-".$hon.$prefi.".Justice ".$name.$fjudge;

	
											echo "<option value='".$jud_result['j_id']."'>".$jud_name."</option>";
											
										}
											 ?>
                                            
                                            </select>
                            </div>
                            
                             <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="T2" name="password" type="password">
								<input type="hidden" name="rand" id="rand" value="<?php echo $rand = sha1(time());
	$_SESSION['time'] = $rand; ?>" />
                            </div>
							 <div class="form-group">
                                <label for="password">Capcha</label>
                                <input class="form-control" id="Capcha" name='captcha' type="text" autocomplete="off" required>
                            </div>
							<div class="contact100-form-checkbox p-t-90">
<div class="checkbox checkbox-circle checkbox-info peers ai-c">
                                
								<a id="captcha_reload" href="#" class="btn btn-danger "><i class="i-Arrow-Refresh"></i></a>&nbsp; 
                                <span class="peer peer-greed"><img src="captcha.php" id="captcha_image"/></span>
                            </div>
                            </div>
                           
                            <input type='submit' name="login" id="login" value="Login In" class="btn btn-rounded btn-primary btn-block mt-2"/>
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