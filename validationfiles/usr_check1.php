<?php 
session_start();
function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */
    
    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
     
    switch($interval) {
     
    case 'yyyy': // Number of full years

        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;

    case "q": // Number of full quarters

        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;

    case "m": // Number of full months

        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;

    case 'y': // Difference between day numbers

        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;

    case "d": // Number of full days

        $datediff = floor($difference / 86400);
        break;

    case "w": // Number of full weekdays

        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;

    case "ww": // Number of full weeks

        $datediff = floor($difference / 604800);
        break;

    case "h": // Number of full hours

        $datediff = floor($difference / 3600);
        break;

    case "n": // Number of full minutes

        $datediff = floor($difference / 60);
        break;

    default: // Number of full seconds (default)

        $datediff = $difference;
        break;
    }    

    return $datediff;

}
//decrypt function
function decrypt_value($login) {
define("KEY_PUBLIC", "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApRpsWwVPJyAlkcAUunf9
ry9tKikmxqfUGfKRJgDwxMBp471Q3clAk20vsGmQTPiR62vuFoFNWWvIX+ySwcHd
OeVIbkblmJltRpGRCrLe22/qK15t4JLmbNf4wwOMZ4e0xPDWpeCMoM2D89lE/gl8
R5O0uEge/Y24wUh+1qjQpj+SayNbcf5Fl8fwUi03pMjF2+ZRRv0pvc1Kok6UILWw
IMH5U+aFnRMMrUyWuSMRV1f3CmqJic8QpK81WodTMu8nGUZLML+oDWawhgLSd1K/
EipkDm+vRrNIdY0UmUtH6vzrElKfAlGeGTVMRh77Nrr+mxPKBAi6kafSoj7K1Jb4
RwIDAQAB
-----END PUBLIC KEY-----");

define("KEY_PRIVATE", "-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: DES-EDE3-CBC,9BA8E55C46E51758

JFenm7U+9mY2q+Gda8wI9dbuZJzYTzV60WIGvH7plkB+naiK2Gs67lEHC6lcRO0x
YDMjLiPbCN9mAlz+DJeDTWqTb3mBB9CY16kxUdVIohkonBK28TzbqxyZ6hFEr808
+aEaKTGnBHCPeEWi8Tndd4TrEVsGsuVvjY50jmA1cT9lvi9u9YMCSH4cX3N8dqu7
HCMCE0lVv7IecMa38dFmuHJiPvNeXG0jtuofumOoPTJtWUgKEC0pd9Ft7d4m2gbJ
dDLykN+FFeuT6cdEYePNLACKLqFdhuYe0LT5KdIyXQUEI5RgJhQwDocxgGLLIJtX
0QqEVw1qMV76A+eKZCJzVqRqcUw/IzrhH1AnEWPwr5m1r7LdMbn2jrOLa+76hwfA
LwCVVtkOQeQl1lC4NA55A9lPueaAZs2LLMEltk3346krDx3kW8GwA5/UaEzltXBg
00zMy3xgWS2qiT/XSWJEZD0qAr5BYn4ddS4mDqPzZ93SeHPjVCvhRsiqaeDSu3va
9psqWxdzUY/832dxyPgb2SsC0OHSgsKRMpsYXlJMKsOvu/OIAaXqt1qj23rPhmMy
NCG+EaFX0sF9Witvv3/QHyyhNyv1IvgR9qR9BDoZz2OGVplUKFNYZnQx/aPt4DrI
hQg4ZsfGB2ZNb08NC523hXZfz4OgXOLFHx9EvhY1je8NKyZBn2cAUxTFF+NsoYJi
leJhQ8XdAnCjTV1lXLgBhPIh6Yq/55c3G1B/r1LPBdlDpr+nfMXc3cQzBG7OtN/7
5YkEMmSlzXSD6Fm7YWe15883b/k+1a86ee+WYERJ/NWkNG64CyZJ3bKIkuV7KBVC
0AGD3IFOQytGMfGKAM1I94/G1Rz4u8DEyp3bBFCoKVZbL7qMYnqjKUqjsORklA4C
0KZ/1KULbnMN5CE2aJ05VfApVzqkeXgIJ4UAuPIiRfdpk/3hPykH50KuoQkr0/0m
Z9YVXqLGvh+EPVaFhvCHFuk+cBcCGQFZR5a3T2GO9p31ES1L14UjYfPbJPRxLklH
UCLVtMjE5uKUGaPulMkRSK/PQqAjcMV8H3A+8uy2Nmt6WFTEZ1f+tX/00mfnYxLt
sJss487CL2+B1brIrhZYxuDHsOu34uL7+TzW17CFK2AchiI8QlSJMw5RaGSgFYN+
ngW4zS6zHrZOq+rxn1MXcCf7OHSZrwRO8XdWGMiqRHJim9DmvGcnMSkoIz8PbMav
B2oBbXKqVtG2Is1fOa+EuGTVE1hZAV26TVjUqYiO1GErWDYQb0nxi1TNIf76kfQ7
kLPdFDjj1DA0iyPQwPrsYoLnq0OkLDQzXGwte/otAwCSB148S4BL8Yk60q4HL7OY
SS+1u4UsP7lF/NcBq8XGZPNH5+mMHiOugm/caK2JpigkPH7bVdTLcOUGOzHxaf+E
3yyC4hRmUmLid4dcU3jmlaLUwqU728eeKVRdoEdd41FLUItEeubte/Crz0JCLRQ5
8pkDcgbbiqIjfjwOn1YNmcrDPW1XVJhtgeOJJUPfdggfyzN4LozZIY1OQsdsIQFn
NctNJ+l6nfMOd6w0aqYJd5TzO7s9s4/X5gUoixdreCYTaIqqE8xzKkFj2noOeokn
-----END RSA PRIVATE KEY-----
");

define("KEY_PASSPHRASE", "tnportal");

 if (!$privateKey = openssl_pkey_get_private(KEY_PRIVATE,KEY_PASSPHRASE)) die('Loading Private Key failed');

    //Decrypt
    $decrypted_text = "";
    if (!openssl_private_decrypt(base64_decode($login), $decrypted_text, $privateKey)) die('Failed to decrypt data');

    //Decrypted :) 
   

    //Free key
    openssl_free_key($privateKey);
	 return $decrypted_text;
}
//require_once "secure_class.php";

$show_form=true;
if(isset($_POST['submit']) && $_SESSION['ptoken'] == $_POST['ptoken'])
{
unset($_SESSION['ptoken']);

$adminid = $_POST['adminname'];
$admincred = $_POST['usercred'];
if(function_exists(openssl_pkey_get_private)){
$adminid = decrypt_value($_POST['adminname']);
$admincred = decrypt_value($_POST['usercred']);
$pass = explode($_SESSION['pass'],$admincred);
if(!empty($pass[0]))
$admincred = $pass[0];
}

 require_once "formvalidator.php";  
    $validator = new FormValidator();
   // $validator->addValidation("adminname","req","Please enter a user name");
   // $validator->addValidation("usercred","req","Please enter a valid password");
	 
	// $validator->addValidation("adminname","badchar","Please enter valid User Name");
	 
	 //$validator->addValidation("usercred","badchar","Please enter valid Password");
	
	$error_msg = '';
if(empty($adminid))
 $error_msg .= "Please Enter User Name".'</br>';
 if(!empty($adminid) && $validator->chkbadchar($adminid) == false)
  $error_msg .= "Please enter valid Username".'</br>';
  if(empty($admincred))
 $error_msg .= "Please Enter Password".'</br>';
 if(!empty($admincred) && $validator->chkbadchar($admincred) == false)
  $error_msg .= "Please Select valid Password".'</br>';
  
      if(empty($error_msg))
    {
        //echo "Saving in progress...";
        $show_form=false;
    }
    else
    {     
	 setcookie("error_msg", $error_msg, time()+3600, '/'); 
			   header('Location: entrylogin.php'); 
			exit;     
    }

// if validations are is success - proceed with saving 
if(false == $show_form)
{
$ip = $_SERVER['REMOTE_ADDR'];
include("conn.php");
$odbc_sql ="select * from loginn where UserName=? and PassWord=? and lock='u'";
  $params = array($adminid,$admincred);
  $odbc_prepare = odbc_prepare($db,$odbc_sql);
$result = odbc_execute( $odbc_prepare,$params);
$num = odbc_num_rows($odbc_prepare);
	if($num == 1){
	$lock = 'u';
	$flag = 's';
	$attempt = 0;
	$newdate = date("Y-m-d H:i:s",strtotime('+330 minute'));
		$odbc_sql ="UPDATE loginn SET lock=?, flag=?, attempt=?, timstamp=?,success_time=?, user_source_ip=? WHERE  UserName=?";
  		$params = array($lock,$flag,$attempt,$newdate,$newdate,$ip,$adminid);
  		$odbc_prepare = odbc_prepare($db,$odbc_sql);
		$result1 = odbc_execute($odbc_prepare,$params);
	
	
	session_regenerate_id();
	
     $_SESSION['uniq'] = 'TnportalA1@3';
	 $_SESSION[uid] = 'yes';
	 if ($adminid == "sicadmin" )
     	 $_SESSION['user'] = "user";
	 else
	     $_SESSION['user'] = "super";
     header("location:entrycauselist.php");
	 exit;
	}
	else{
	$odbc_sql ="select * from loginn where UserName=?";
  $params = array($adminid);
  $odbc_prepare = odbc_prepare($db,$odbc_sql);
$result = odbc_execute( $odbc_prepare,$params);
 $num = odbc_num_rows($odbc_prepare);

	if($num == 1){
	while (odbc_fetch_row($odbc_prepare)) 
	  {
	  $uid=odbc_result($odbc_prepare,"uid");
	  $pass=odbc_result($odbc_prepare,"PassWord");
	  $lock=odbc_result($odbc_prepare,"lock");
	  $attempt=odbc_result($odbc_prepare,"attempt");
	  $flag=odbc_result($odbc_prepare,"flag");
	 $timstamp=odbc_result($odbc_prepare,"timstamp");
	  }
	  if($lock == 'l'){
	 
	
$sec =  datediff('s', $timstamp, date("Y-m-d H:i:s",strtotime('+330 minute')), false);
if($sec > 60){

$lock = 'u';
$flag = 's';
$attempt = 0;
$newdate = date("Y-m-d H:i:s",strtotime('+330 minute'));
		$odbc_sql ="UPDATE loginn SET lock=?, flag=?,  attempt=?, timstamp=?,success_time=?, user_source_ip=? WHERE  uid=?";
  		$params = array($lock,$flag,$attempt,$newdate,$newdate,$ip,$uid);
  		$odbc_prepare = odbc_prepare($db,$odbc_sql);
		$result1 = odbc_execute($odbc_prepare,$params);
		if($pass == $admincred){
		 $salt = 'TnportalA1@3';
		 session_regenerate_id();
     $_SESSION['uniq'] = md5(session_id().$salt);
	 $_SESSION[uid] = 'yes';
		header('Location: entrycauselist.php');
	 	exit;
		}
	 }
		$error_msg = '';
		if($sec > 60)
		$error_msg .='Please check UserName and PassWord';
		else
		$error_msg .='Your credentials has been locked. Please try again after 15 minutes';
	 	setcookie("error_msg", $error_msg, time()+3600, '/'); 
		header('Location: entrylogin.php');
	 	exit;
		}else{
		
		$attempt++;
		$flag= 'f';
		if($attempt == 3)
		$lock = 'l';
		$newdate = date("Y-m-d H:i:s",strtotime('+330 minute'));
		$odbc_sql ="UPDATE loginn SET lock=?, flag=?,  attempt=?, timstamp=?, user_source_ip=? WHERE  uid=?";
  		$params = array($lock,$flag,$attempt,$newdate,$ip,$uid);
  		$odbc_prepare = odbc_prepare($db,$odbc_sql);
		$result1 = odbc_execute($odbc_prepare,$params);
		
			if($result1){
			$error_msg = '';
			if($attempt == 3)
			$error_msg .='Your credentials has been locked. Please try again after 15 minutes</br>';
			else
			$error_msg .='You have attempted '.$attempt.' out of 3. After 3 wrong attempts your account will be locked</br>';
			$error_msg .='Please check UserName and PassWord';
	 		setcookie("error_msg", $error_msg, time()+3600, '/'); 
			header('Location: entrylogin.php'); 
	 		exit;
			}
	  		else{
			$error_msg = '';
			$error_msg .='Please try after some time';
	 		setcookie("error_msg", $error_msg, time()+3600, '/'); 
			header('Location: entrylogin.php'); 
	 		exit;
	
			}
		
		}
	  }
	else{
	$error_msg = '';
	$error_msg .='Please check UserName and PassWord';
	 setcookie("error_msg", $error_msg, time()+3600, '/'); 
	header('Location: entrylogin.php'); 
	 exit;
	
	}
	
	}
}	

} // endif of isset
else{
	header("HTTP/1.1 403 Not Found");
}
?>