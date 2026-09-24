<?php
include 'config/dbconfig.php';

$valid=false;

if(isset($_GET['img_id']))
	{
$page= base64_decode($_GET['page']);
$cod= base64_decode($_GET['img_id']);
if(is_numeric($cod))
{
$valid=true;	
}
	}
	else
	{
		
		$page= base64_decode($_GET['page']);
		$jud_code= base64_decode($_GET['jud_code']);
		if(is_numeric($jud_code))
{
$valid=true;	
}
	}
if($valid){
if($page=='J')
{
	if(isset($_GET['img_id']))
	{


$sql = "select j_photo from judges where j_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> j_photo);


}
	}
	else
	{
		

$sql = "select j_photo from judges where jud_code='$jud_code' and j_page='PJ' and j_display='Y'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> j_photo);


}
	}
}
else if($page=='FJ')
{
	


$sql = "select j_photo from former_judges where  j_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> j_photo);


}
}
else if($page=='P')
{
	


$sql = "select photo_thm from mhc_photo where  photo_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> photo_thm);


}
}
else if($page=='G')
{



$sql = "select images from photo_gallery where  gallery_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> images);


}
}
else if($page=='V')
{
	


$sql = "select video_image from mhc_videos where video_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> video_image);


}
}
else if($page=='R')
{



$sql = "select reg_photo from registrars where  reg_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> reg_photo);


}
}
else if($page=='A')
{



$sql = "select an_icon_img from announcement where  an_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> an_icon_img);


}
}
else if($page=='O')
{
	


$sql = "select icon from mhc_downloads where  download_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> icon);


}
}

else if($page=='S')
{
	


$sql = "select slider_img from mhc_sliders where  slider_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> slider_img);


}
}
else if($page=='D')
{



$sql = "select doc_icon from mhc_document where  doc_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> doc_icon);


}
}
else if($page=='T')
{
	


$sql = "select icon from mhc_transfer where  transfer_id='$cod'";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> icon);


}
}
else if($page=='H')
{
	


$sql = "select gallery_img from home_gallery where  h_gallery_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> gallery_img);


}
}
else if($page=='HT')
{
	


$sql = "select thumb_img from mhc_homepage where  h_id='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> thumb_img);


}
}
else if($page=='RTI')
{
	


$sql = "select photo from mhc_rti_users where  rti_user_id	='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> photo);


}
}
else if($page=='RTID')
{
	


$sql = "select upload_id_proof from mhc_rti_users where  rti_user_id	='$cod' ";
//error_log($sql);
$quer = pg_query($bd22, $sql);
header('Content-type: image/jpeg');
while($reg = pg_fetch_object($quer))
{


print pg_unescape_bytea($reg -> upload_id_proof);


}
}
else
{
echo '<div style="border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;
											background-position: 10px center;color: #4F8A10;background-color: #DFF2BF" align="center"><strong class="text-capitalize">No Image Found!</strong>';
	}
}
else
{
echo '<div style="border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;
											background-position: 10px center;color: #4F8A10;background-color: #DFF2BF" align="center"><strong class="text-capitalize">No Image Found!</strong>';
	}


?>
