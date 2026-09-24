<?php
require('config/dbconfig.php');



switch ($_SERVER["REQUEST_METHOD"]) 
{
	case 'GET':
		handleGetDocumentDetails();
		break;

	case 'POST';
		handlePostDocumentDetails();
		break;
}

function handlePostDocumentDetails()
{
	global $CIS_DB;
	global $bd;
	global $HCMAS_DB;
	global $DB_con;
	global $validator;
	
	
	$action=$_POST['action'];
	switch($action)
	{
		case 'getcourt':
		
		$sql="SELECT distinct(causelist_date),court_id FROM causelist_title where  causelist_date='".$_POST['dist_state_id']."' order by court_id";
		$res=$HCMAS_DB->query($sql);
		 $option='<option selected>Select Court Id</option>';
		while($val =$res->fetch()){
		@$option .='<option value="'.$val['court_id'].'" >'.$val['court_id'].'</option>';
		}
		echo $option;
		break;
		
	}
}
	?>