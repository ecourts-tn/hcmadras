<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL );  */
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'config/dbconfig.php';
$valid=false;
if(isset($_POST['page']))
{	
/* echo $_POST['page'];
echo "<br>"; 
echo $_POST['pdf_id'];*/
$page= base64_decode($_POST['page']);
 $cod= base64_decode($_POST['pdf_id']);
if(is_numeric($cod))
{
$valid=true;	
}
}
else
{
	$page=base64_decode($_GET['page']);
	$cod=base64_decode($_GET['pdf_id']);
if(is_numeric($cod))
{
$valid=true;	
}

}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL ); 
if($valid){
if($page=='J')
{


$sql = "SELECT j_document FROM judges_doc WHERE j_doc_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
 
print pg_unescape_bytea($reg -> j_document);
}
else if($page=='A')
{
	

$sql = "SELECT an_pdf FROM announcement_file WHERE announc_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> an_pdf);
}
else if($page=='O')
{
	

$sql = "SELECT down_file FROM mhc_downloads WHERE download_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> down_file);
}
else if($page=='R')
{


$sql = "SELECT rules_pdf_file FROM mhc_rules WHERE rules_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> rules_pdf_file);
}
else if($page=='I')
{
	
//error_log("SELECT doc_pdf_file FROM mhc_document WHERE doc_id = '$cod'");
$sql = "SELECT doc_pdf_file FROM document_files WHERE document_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> doc_pdf_file);
}
else if($page=='D')
{	
//error_log("SELECT doc_pdf_file FROM mhc_document WHERE doc_id = '$cod'");
$sql = "SELECT doc_pdf_file,doc_title FROM document_files inner join mhc_document on mhc_document.doc_id=document_files.document_id WHERE document_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);
$title=str_replace('.','_',trim($reg -> doc_title));
$titletrim=str_replace(',','_',$title);
$title_main=str_replace(' ','_',$titletrim);
header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=".$title_main.".PDF");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');  
print pg_unescape_bytea($reg -> doc_pdf_file); 
}

else if($page=='T')
{
	

$sql = "SELECT trans_doc FROM transfer_files WHERE trans_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> trans_doc);
}
else if($page=='M')
{
	

$sql = "SELECT meeting_file FROM mhc_metting_files WHERE files_id = '$cod'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> meeting_file);
}
else if($page=='H')
{
	

$sql = "SELECT gallery_img FROM home_gallery WHERE h_gallery_id = '$cod' AND upload_type='PDF'";
$quer = pg_query($bd22, $sql);

$reg = pg_fetch_object($quer);

 header('Content-type: application/pdf');
 header("Content-Disposition:inline;filename=\"downloaded.PDF\"");
 header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
print pg_unescape_bytea($reg -> gallery_img);
}
else{
	echo '<div style="border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;
											background-position: 10px center;color: #4F8A10;background-color: #DFF2BF" align="center"><strong class="text-capitalize">No Records!</strong>';
	
}
}
else
{
echo '<div style="border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;
											background-position: 10px center;color: #4F8A10;background-color: #DFF2BF" align="center"><strong class="text-capitalize">No Records!</strong>';
	}

?>