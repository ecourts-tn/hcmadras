<?php
include ("clear_unlink.php");
//$get_val=base64_encode('fileName');
if(isset($_POST['fileName']))
{
$file_name=$_POST['fileName'];
$file_name=base64_decode($file_name);
/*$file_name1=explode('/',$file_name);
$array_last_val=count($file_name1)-1;*/
$case=explode('_',$file_name);

$cur_dt=date('Ymd');
	if(!file_exists("cis_files/".$cur_dt))
	{
		mkdir("cis_files/".$cur_dt,0776);
	}
	$order_yr=$case[0];
	$order_caseno=$case[1];
	$order_no=$case[2];
	$type=$case[3];
	$cis_url="http://10.241.0.56/cis";
	//$cis_url="http://192.168.1.39/cis";
	$curlerror="";
	$webservice_file_name = $cis_url."/curl_site_f.php";
	$data = array("action" => "judgment_order_get_data","order_yr" => $order_yr,"order_caseno"=>$order_caseno,"order_no"=>$order_no);
	$data_string = urlencode(json_encode($data));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $webservice_file_name);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("data_arr"=>$data_string));
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$curl_output1 = curl_exec($ch);
	//Check for 404 (file not found). 
	 $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
	if (curl_error($ch)) {
		$curlerror = "Document Loading Error: " . curl_error($ch);
		echo 'err='.$curlerror;
	}

	curl_close($ch);
	$fil_nme = $cur_dt.'_'.$order_yr.'_'.$order_caseno.'_'.$order_no.'_'.$type;

	if (!$curlerror) {
		if ($curl_output1 == "404") {
			$filePath='404';
			}
			else {
				$filePath = "cis_files/$cur_dt/$fil_nme.pdf";
				file_put_contents($filePath, $curl_output1);
			}

			//return $filePath;
			 
		/*}
		else {
			echo $result = "Document Not Found";
		}*/

		
	}
	else {
		//$result = "Document Not Found";
		$filePath='404';
		//return $filepath;
	} 
$file_name_final=$filePath;

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$cur_dt.'_'.$order_caseno.$order_no.'.pdf"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file_name_final);

unlink($file_name_final);


}
else
{
	echo '<div style="border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;
											background-position: 10px center;color: #4F8A10;background-color: #DFF2BF" align="center"><strong class="text-capitalize"><a href="index.php" >Click here to go to Home Page</a> </strong>';
	//echo "<button onclick='window.history.back();' style='margin-right:15px'>Go Back</button>";

}


?>
