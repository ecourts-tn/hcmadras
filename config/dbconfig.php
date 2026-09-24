<?php
/* ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting( E_ALL ); */
header("cache-control: no-cache, no-store, must-revalidate");  
header("pragma: no-cache");
header('expires: 0');
header('Content-Type:text/html; charset=UTF-8');
header('X-Frame-Options: SAMEORIGIN'); 
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
header("Content-Security-Policy:".
        "connect-src 'self' ;". // XMLHttpRequest (AJAX request), WebSocket or EventSource.
        // "default-src 'self' data:  'unsafe-hashes' 'unsafe-eval'".// Default policy for loading html elements
        "frame-ancestors 'self' ;". //allow parent framing - this one blocks click jacking and ui redress
       "frame-src 'self';". // vaid sources for frames // vaid sources for frames
        "media-src 'self' ". // vaid sources for media (audio and video html tags src) *.example.com;
        "object-src 'none'; ". // valid object embed and applet tags src
        "report-uri ". //A URL that will get raw json data in post that lets you know what was violated and blocked
        "script-src 'self' 'unsafe-inline' ga.js ;". // allows js from self, jquery and google analytics.  Inline allows inline js
        "style-src 'self' 'unsafe-inline';");
ini_set( 'session.cookie_httponly', 1 );
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
ini_set('docref_root', '0');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
date_default_timezone_set('Asia/Kolkata');
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL ); */

date_default_timezone_set('Asia/Kolkata');

$bd22 = pg_pconnect("host=10.236.255.28 port=5432 dbname=hcmadrasn user=postgres password=K-preReCr5@");
$serverdate=date('Y-m-d');
$sql_out=pg_query($bd22,"insert into visitor_logs_1 select * from visitor_logs where date(created)<'$serverdate'");
$sql_out=pg_query($bd22,"delete from visitor_logs where date(created)<'$serverdate'");

//MAIN DB FOR WEBSITE
$DB_host = "10.236.255.28";
$DB_user = "postgres";
$DB_pass = "K-preReCr5@";
$DB_name = "hcmadrasn";

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