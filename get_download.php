<?php
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
require('config/dbconfig.php');

if(isset($_GET['down_id']))
	$download_id=$_GET['down_id'];

	$sql = "SELECT down_file_name,mime_type,down_file FROM mhc_downloads WHERE download_id  = :download_id";
$quer = $DB_con->prepare( $sql);
$quer ->bindParam(':download_id',$download_id);
$quer ->execute();
$reg=$quer->fetch();
//$reg = pg_fetch_object($quer);
 header('Content-type: '.$reg['mime_type']);
 header('Content-Disposition: attachment; filename="'.$reg['down_file_name'].'"');
	echo stream_get_contents($reg['down_file']);
	
	

?>