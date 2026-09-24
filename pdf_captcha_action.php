<?php 
session_start();
require('config/dbconfig.php');
require_once 'securimage.php';
if(isset($_POST['pdf_captcha']) )
{
$securimage1 = new Securimage(array('namespace' => 'pdfform'));
    $valid1 = $securimage1->check($_POST['pdf_captcha']);
	
	if($valid1){ 
	echo '1';
}
else
{
echo '0';}	
}
?>