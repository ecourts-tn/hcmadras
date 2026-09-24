<?php
date_default_timezone_set('Asia/Kolkata');

//HIGH COURT DB
try
{
$CIS_DB = new PDO("pgsql:host=10.236.216.155;dbname= tn_hc_cis_mas","postgres","");
$CIS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$HCMAS_DB = new PDO("pgsql:host=10.236.216.155;dbname= hc_cis_mas","postgres","");
$HCMAS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$DISPLAY_con = new PDO("pgsql:host=10.236.216.155;dbname= displayboard","postgres","");
$DISPLAY_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$MDU_HCMAS_DB = new PDO("pgsql:host=10.236.216.155;port=5433;dbname= mdubench","postgres","");
$MDU_HCMAS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$MDU_CIS_DB = new PDO("pgsql:host=10.236.216.155;port=5433;dbname= mdu_ppy","postgres","");
$MDU_CIS_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$DISPLAY_con_MDU = new PDO("pgsql:host=10.236.216.155;port=5433;dbname= displayboard","postgres","");
$DISPLAY_con_MDU->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e1)
{
    echo $e1->getMessage();
}
?>