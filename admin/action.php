<?php

include 'config/dbconfig.php';
//$_POST["action"]='fetch_data';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);
if(isset($_POST["action"]))
{
 if($_POST["action"] == 'fetch_data')
 {
	 //echo "SELECT * FROM registrars ORDER BY reg_pl_sen ASC";
  $stmt = $DB_con->prepare("SELECT A.reg_id,A.reg_name,A.reg_place,A.display,A.reg_pl_sen,B.desig 
FROM registrars A LEFT JOIN officer_designation B ON B.sno=CAST(A.reg_desig AS INTEGER)  where A.display='Y' ORDER BY A.reg_pl_sen ASC");
				 $stmt->execute();				 
				$sno=1;
				$data=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data[] = $row;
					
						
					}

  echo json_encode($data);
 
}
if($_POST["action"] == 'tele_fetch_data')
 {
	 //echo "SELECT * FROM registrars ORDER BY reg_pl_sen ASC";
  $stmt = $DB_con->prepare("SELECT A.telephone_id,A.type,A.bench,A.order_id,A.display,B.desig FROM mhc_telephone_diary A LEFT JOIN officer_designation B ON B.sno=CAST(A.name AS INTEGER)  where A.display='Y' ORDER BY A.bench desc,A.order_id ASC");
				 $stmt->execute();				 
				$sno=1;
				$data=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data[] = $row;
					
						
					}

  echo json_encode($data);
 
}

 if($_POST['action'] == 'update')
 {
  for($count = 0;  $count < count($_POST["page_id_array"]); $count++)
  {
   echo $query = "
   UPDATE registrars 
   SET reg_pl_sen = '".($count+1)."' 
   WHERE reg_id = '".$_POST["page_id_array"][$count]."'
   ";
   $statement = $DB_con->prepare($query);
   $statement->execute();
  }
 }
  if($_POST['action'] == 'tele_update')
 {
  for($count = 0;  $count < count($_POST["page_id_array"]); $count++)
  {
   echo $query = "
   UPDATE mhc_telephone_diary 
   SET order_id = '".($count+1)."' 
   WHERE telephone_id = '".$_POST["page_id_array"][$count]."'
   ";
   $statement = $DB_con->prepare($query);
   $statement->execute();
  }
 }
 if($_POST["action"] == 'jud_data')
 {
	 //echo "SELECT * FROM judges ORDER BY j_sen ASC";
  //$stmt = $DB_con->prepare("SELECT j_id,j_name,j_coram,j_display,j_sen FROM judges where j_display='Y' AND j_page='PJ' ORDER BY j_sen ASC");
  $cur=date('Y-m-d');
  $stmt = $DB_con->prepare("select j_id,j_name,j_coram,j_display,j_sen from judges where j_display='Y'  and  j_page='PJ' and j_ret>='".$cur."' order by j_sen asc");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data[] = $row;
					}

  echo json_encode($data);
 
}
 if($_POST["action"] == 'f_jud_data')
 {
	 //echo "SELECT * FROM judges ORDER BY j_sen ASC";
  $stmt = $DB_con->prepare("SELECT j_id,j_name,j_display,j_sen FROM former_judges where j_display='Y' ORDER BY j_sen ASC");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data[] = $row;
					}

  echo json_encode($data);
 
}

 if($_POST['action'] == 'jud_update')
 {
  for($count = 0;  $count < count($_POST["page_id_array"]); $count++)
  {
   echo $query = "
   UPDATE judges 
   SET j_sen = '".($count+1)."' 
   WHERE j_id = '".$_POST["page_id_array"][$count]."'
   ";
   $statement = $DB_con->prepare($query);
   $statement->execute();
  }
 }
  if($_POST['action'] == 'f_jud_update')
 {
  for($count = 0;  $count < count($_POST["page_id_array"]); $count++)
  {
   echo $query = "
   UPDATE former_judges 
   SET j_sen = '".($count+1)."' 
   WHERE j_id = '".$_POST["page_id_array"][$count]."'
   ";
   $statement = $DB_con->prepare($query);
   $statement->execute();
  }
 }

  if($_POST["action"] == 'slid_data')
 {
  $stmt = $DB_con->prepare("SELECT slider_id,slider_name,slider_order,slider_display FROM mhc_sliders ORDER BY slider_order ASC");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data[] = $row;
					}

  echo json_encode($data);
 
}
 if($_POST['action'] == 'slid_update')
 {
  for($count = 0;  $count < count($_POST["page_id_array"]); $count++)
  {
   echo $query = "
   UPDATE mhc_sliders  
   SET slider_order = ".($count+1)."  
   WHERE slider_id = ".$_POST["page_id_array"][$count];
  // echo "<script>alert('".$query ."');</script>";
   $statement = $DB_con->prepare($query);
   $statement->execute();
  }
 }
  if($_POST['action'] == 'get_max_trans_order')
 {
	$year=$_POST['not_year'];
	$stmt = $DB_con->prepare("SELECT max(transfer_order)
FROM mhc_transfer
WHERE notification_year = '".$year."'");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data = $row["max"];
					if(is_null($data))
						$data=0;
					}

  echo json_encode($data);
 }
   if($_POST['action'] == 'get_max_page_order')
 {
	 
	$page=$_POST['page_val'];
	$stmt = $DB_con->prepare("SELECT  max(doc_order)
FROM mhc_document where doc_show_page='".$page."'");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$data = $row["max"];
					if(is_null($data))
						$data=0;
					}

  echo json_encode($data);
 }
 if($_POST['action'] == 'get_overall_hits')
 {
	 
	$stmt = $DB_con->prepare("select count (*) as user_hist from ( select  user_ip_address FROM visitor_logs  group by user_ip_address)a");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch()) {
					
					$data = $row["user_hist"];
					if(is_null($data))
						$data=0;
					}

  echo $data;
 }

	if($_POST['action']=='getList')
	{
		$op="";
		$id=base64_decode($_POST['id']);
		$op="<option value='' selected disabled>Choose</option>";
		if($id=='O')
		{
			 $select_qry1 = $DB_con->query("SELECT * FROM officer_designation where display='Y' order by desig");
while($row1 = $select_qry1->fetch())
{
$op.= "<option value='".$row1['sno']."'>".$row1['desig']." </option>";
}
		}
	else {
		 $select_qry1 = $DB_con->query("SELECT * FROM departments where display='Y'  order by depart");
while($row1 = $select_qry1->fetch())
{
$op.="<option value='".$row1['sno']."'>".$row1['depart']." </option>";
}
	}
		echo $op;
	}
	if($_POST['action']=='getMenus')
	{
		$op="";
		$court_ty=base64_decode($_POST['court_ty']);
		$cond="";
		if($_SESSION['court_type']=='D' && $_SESSION['roll']=='U')
			$cond=" and menu_user in ('AL','DJ') ";
		else if($_SESSION['court_type']=='H' && $_SESSION['roll']=='U')
			$cond=" and menu_user in ('AL','HC') ";
		$main_menu = $DB_con->query("select menu_id,page_name from mhc_menu where menu_parent_id='0' and set_menu='BM' and display='Y' ".$cond." order by menu_id,main_menu_order asc"); 
		
										while($main_menu_result = $main_menu->fetch()){
											$op.= "<optgroup label='".$main_menu_result["page_name"]."'>";
											$sub_menu = $DB_con->query("SELECT  * FROM mhc_menu where menu_parent_id=".$main_menu_result['menu_id']." and set_menu='BM' ".$cond." order by sub_menu_order");
											if($sub_menu->rowCount()==0){
												$op.= "<option value='".$main_menu_result["menu_id"]."'>".$main_menu_result["page_name"]."</option>";

											} else {
												while($sub_menu_result = $sub_menu->fetch()){
													$op.= "<option value='".$sub_menu_result["menu_id"]."'>".$sub_menu_result["page_name"]."</option>";
												} 
											}

											$op.= "</optgroup>";
										}
									
		echo $op;
	}
	if($_POST['action']=='getMenusEdit')
	{
		$edit=base64_decode($_POST['id']);
		$stmt = $DB_con->prepare("SELECT  menu_id FROM mhc_users where mhc_user_id=:id");
		$stmt->execute(array(':id' => $edit));
		$editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
		$menu_list=explode(',',$editRow['menu_id']);
		$op="";
		$court_ty=base64_decode($_POST['court_ty']);
		$cond="";
		if($_SESSION['court_type']=='D' && $_SESSION['roll']=='U')
			$cond=" and menu_user in ('AL','DJ') ";
		else if($_SESSION['court_type']=='H' && $_SESSION['roll']=='U')
			$cond=" and menu_user in ('AL','HC') ";
		$main_menu = $DB_con->query("select menu_id,page_name from mhc_menu where menu_parent_id='0' and set_menu='BM' and display='Y' ".$cond." order by menu_id,main_menu_order asc"); 
		
										while($main_menu_result = $main_menu->fetch()){
											$op.= "<optgroup label='".$main_menu_result["page_name"]."'>";
											if(in_array($main_menu_result['menu_id'],$menu_list))
											{
											$sub_menu = $DB_con->query("SELECT  * FROM mhc_menu where menu_parent_id=".$main_menu_result['menu_id']." and set_menu='BM' ".$cond." order by sub_menu_order");
											if($sub_menu->rowCount()==0){
												$op.= "<option value='".$main_menu_result['menu_id']."' SELECTED>".$main_menu_result['page_name']."</option>";

											} else {
												while($sub_menu_result = $sub_menu->fetch()){
													$op.= "<option value='".$sub_menu_result['menu_id']."' SELECTED>".$sub_menu_result['page_name']."</option>";
												} 
											}
										}
											
											else{
											
											$sub_menu = $DB_con->query("SELECT  * FROM mhc_menu where menu_parent_id=".$main_menu_result['menu_id']." and set_menu='BM' ".$cond." order by sub_menu_order");
											if($sub_menu->rowCount()==0){
												$op.= "<option value='".$main_menu_result["menu_id"]."'>".$main_menu_result["page_name"]."</option>";

											} else {
												while($sub_menu_result = $sub_menu->fetch()){
													$op.= "<option value='".$sub_menu_result["menu_id"]."'>".$sub_menu_result["page_name"]."</option>";
												} 
											}
										}

											$op.= "</optgroup>";
										}
									
		echo $op;
	}

}

?>