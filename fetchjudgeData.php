<?php
$bd_hc = pg_pconnect("host=10.236.216.155 port=5432 dbname=hc_cis_mas user=postgres") or die("Opps some thing went wrong");
//$searchTerm=trim($_GET['q']);
$searchTerm = pg_escape_string($bd_hc,$_POST['search']);
$sql_jud=pg_query($bd_hc,"select judge_name,judge_code from judge_name_t where judge_name ilike '%".$searchTerm."%' order by judge_name asc"); 
 while($hud_hc=pg_fetch_object($sql_jud))
{
	//echo $hud_hc->judge_name."\n";
	$judge_name=explode('justice',strtolower($hud_hc->judge_name));
	//echo trim($judge_name[1])."\n";
	if(trim($judge_name[1])!='')
	{
		//echo trim(strtoupper($judge_name[1]))."\n";	
		$response[] = array("value"=>$row['judge_code'],"label"=>trim(strtoupper($judge_name[1])));
	}
}
    echo json_encode($response);
  
?>