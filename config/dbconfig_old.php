<?php
header('X-Frame-Options: SAMEORIGIN'); 
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
ini_set( 'session.cookie_httponly', 1 );
date_default_timezone_set('Asia/Kolkata');


date_default_timezone_set('Asia/Kolkata');

//HIGH COURT DB
/*$CIS_DB = new PDO("pgsql:host=10.236.216.155;dbname= tn_hc_cis_mas","postgres","");
$HCMAS_DB = new PDO("pgsql:host=10.236.216.155;dbname= hc_cis_mas","postgres","");
$ECOURTIS_DB = new PDO("pgsql:host=10.236.216.155;dbname=ecourtisuserdb","postgres","");

$CIS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$CIS_DB->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);*/


/*$MDU_HCMAS_DB = new PDO("pgsql:host=10.236.216.155;port=5433;dbname= mdubench","postgres","");
$MDU_CIS_DB = new PDO("pgsql:host=10.236.216.155;port=5433;dbname= mdu_ppy","postgres","");
$MDU_CIS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$MDU_CIS_DB->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);  */
/*
// MADURAI BENCH DB

$MDU_HCMAS_DB = new PDO("pgsql:host=192.168.1.36;dbname= hc_cis_mas","postgres","");
$MDU_CIS_DB = new PDO("pgsql:host=192.168.1.36;dbname= tn_hc_cis_mas","postgres","");
$MDU_CIS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$MDU_CIS_DB->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);


*/

//DISPLAY BORAD DB

/*$DB_host_DB = "10.236.216.155";
$DB_user_DB = "postgres";
$DB_pass_DB = "postgres";
$DB_name_DB = "displayboard";

try
{
     $DISPLAY_con = new PDO("pgsql:host={$DB_host_DB};dbname={$DB_name_DB}",$DB_user_DB,$DB_pass_DB);
     $DISPLAY_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
	 //if($DB_con1);
}
catch(PDOException $e1)
{
    echo $e1->getMessage();
}
$DB_host_DB_MDU = "10.236.216.155";

try
{
     $DISPLAY_con_MDU = new PDO("pgsql:host={$DB_host_DB_MDU};port=5433;dbname={$DB_name_DB}",$DB_user_DB,$DB_pass_DB);
     $DISPLAY_con_MDU->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
	 //if($DB_con1);
}
catch(PDOException $e1)
{
    echo $e1->getMessage();
}*/
/*
$VC_host_DB = "10.241.0.75";
$VC_user_DB = "postgres";
$VC_pass_DB = "postgres";
$VC_name_DB = "tn_vc";

try
{
     $VC_con = new PDO("pgsql:host={$VC_host_DB};dbname={$VC_name_DB}",$VC_user_DB,$VC_pass_DB);
     $VC_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
	 //if($DB_con1);
}
catch(PDOException $e2)
{
    echo $e2->getMessage();
}
*/
//NORMAL DB CONNECTION FOR image view 
$bd22 = pg_pconnect("host=10.236.255.28 port=5432 dbname=hcmadras user=postgres password=K-preReCr5@") or die("Opps some thing went wrong");

//MAIN DB FOR WEBSITE
$DB_host = "10.236.255.28";
$DB_user = "postgres";
$DB_pass = "K-preReCr5@";
$DB_name = "hcmadras";

try
{
     $DB_con = new PDO("pgsql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
	 //if($DB_con1);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>