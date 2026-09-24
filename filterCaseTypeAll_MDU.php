<?php
require("config/dbconfig.php");

$where = "";

 if(isset($_SESSION['MainSection']) && $_SESSION['MainSection'] != "") {
	if($_SESSION['MainSection'] == "J") {
		
		$excJudicial = $MDU_HCMAS_DB->query("SELECT * FROM court_t WHERE court_no = '1'");
		$rowJudicial = $excJudicial->fetch();
		$judicialData = explode(',',$rowJudicial['case_types']);
		$judicialData = "'" . implode( "', '", $judicialData ) . "'";
		
		$where = " WHERE case_type IN (".$judicialData.")";
		
	} else if($_SESSION['MainSection'] == "W") {
		
		////////WRIT
		$excWrit = $MDU_HCMAS_DB->query("SELECT * FROM court_t WHERE court_no = '2'");
		$rowWrit = $excWrit->fetch();
		$writData = explode(',',$rowWrit['case_types']);
		$writData = "'" . implode( "', '", $writData ) . "'";
		
		$where = " WHERE case_type IN (".$writData.")";
		
	} else if($_SESSION['MainSection'] == "O") {
		
		////////ORIGINAL
		$excOriginal = $MDU_HCMAS_DB->query("SELECT * FROM court_t WHERE court_no = '3'");
		$rowOriginal = $excOriginal->fetch();
		$originalData = explode(',',$rowOriginal['case_types']);
		$originalData = "'" . implode( "', '", $originalData ) . "'";
		
		$where = " WHERE case_type IN (".$originalData.")";
		
	} else if($_SESSION['MainSection'] == "C") {
		
		////////CRIMINAL
		$excCriminal = $MDU_HCMAS_DB->query("SELECT * FROM court_t WHERE court_no = '4'");
		$rowCriminal = $excCriminal->fetch();
		$criminalData = explode(',',$rowCriminal['case_types']);
		$criminalData = "'" . implode( "', '", $criminalData ) . "'";
		
		$where = " WHERE case_type IN (".$criminalData.")";
		
	} else {
		$where = "";
	}
}


$qry_case_type = "SELECT type_name,full_form,case_type,matter_type FROM case_type_t";
$res_case_type = $MDU_HCMAS_DB->query($qry_case_type);
   while($row_case_type = $res_case_type->fetch()) {
        $data[] = array('value'=>$row_case_type['type_name'].'_'.$row_case_type['full_form'], 'id'=>$row_case_type['case_type'], 'matter_type' => $row_case_type['matter_type']);
    }
echo json_encode($data);
?>
