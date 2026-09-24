<?php 
require('config/dbconfig.php');
require('config/dbconfig_status.php');
//include"header.php";
require_once 'securimage.php';


include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

$causelist_dt=$_POST['cause_list_dt'];
$causelist_date=date('Y-m-d',strtotime($causelist_dt));
 $bench=$_POST['bench'];

$party_name=$_POST['party_name'];
$securimage = new Securimage(array('namespace' => 'partyname'));
$valid = $securimage->check($_POST['partyname_captcha']);

		/*Validate Session and User Captcha Values*/
		if ($valid){ 		
			

if($_POST['submit'] && $_POST['cause_list_dt']!='' && trim(" ",$_POST['party_name'])!='' && $_POST['bench']!='')
{
	
if(empty($causelist_date))
   {
      echo '<br><h3 style="color:red;text-align:center;">Enter your Cause List Date !</h3>';
   
   }
 else if(!empty($causelist_date) && $validator->chkbadchar($causelist_date) == false)
 {
	  echo '<br><h3 style="color:red;text-align:center;">Please enter valid Cause List Date</h3>';

 }
else if(empty($party_name))
   {
        echo '<br><h3 style="color:red;text-align:center;">Enter your Party Name!</h3>';
     
   }
 else if(!empty($party_name) && $validator->chkbadchar($party_name) == false)
 {
	  echo '<br><h3 style="color:red;text-align:center;">Please enter valid Party Name</h3>';

 } 
 else if(!empty($bench) && $validator->chkbadchar($bench) == false)
 {
	  echo '<br><h3 style="color:red;text-align:center;">Please select valid bench</h3>';

 } 
 else
 {	
if($bench=='MHC'){
		$title='PRINCIPAL SEAT OF MADRAS HIGH COURT';
		$DB_option=$HCMAS_DB;
		include 'fun_class.php';
	}
	else
	{
		$title='MADURAI BENCH OF MADRAS HIGH COURT';
		$DB_option=$MDU_HCMAS_DB;
		include 'fun_class_mdu.php';
	}
$getdata =new GETDETAILS($DB_option);


//$adv_code = $getdata->getAdvCd($bar_no);



$cnr_no='';
$c_no='';
$civ_qry=$DB_option->query("SELECT cino FROM civil_t WHERE pet_name ILIKE  '%".$party_name."%' OR res_name ILIKE '%".$party_name."%' UNION SELECT cino FROM civil_t_a WHERE pet_name ILIKE  '%".$party_name."%' OR res_name ILIKE '%".$party_name."%'"); 
if($civ_qry->rowCount()>0){
 while($civ_row=$civ_qry->fetch())
 {
	 $cnr_no .="'".$civ_row['cino']."',";
	 $c_no .=$civ_row['cino'].',';
	 
 }

  $cnr_num=rtrim($cnr_no,',');
  //$cn_no =rtrim($c_no,',');
 $bench_id='';
  //echo "SELECT distinct(for_bench_id) FROM cause_list WHERE cino IN (".$cnr_num.") and causelist_date='".$causelist_date."' ";
 // echo "SELECT for_bench_id FROM cause_list WHERE cino IN (".$cnr_num.") and causelist_date='".$causelist_date."'  and elimination='N' UNION SELECT for_bench_id FROM cause_list_a WHERE cino IN (".$cnr_num.") and causelist_date='".$causelist_date."'  and elimination='N'group by for_bench_id";
 $jud_bench_qry=$DB_option->query("SELECT for_bench_id FROM cause_list WHERE cino IN (".$cnr_num.") and causelist_date='".$causelist_date."'  and elimination='N' UNION SELECT for_bench_id FROM cause_list_a WHERE cino IN (".$cnr_num.") and causelist_date='".$causelist_date."'  and elimination='N'group by for_bench_id");
 if($jud_bench_qry->rowCount()>0){
while($jud_bench_row=$jud_bench_qry->fetch())
{
$bench_id .="'".$jud_bench_row['for_bench_id']."',";
}
  $jud_bench=rtrim($bench_id,',');


?>

	 
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
<div class="pad group">
		
				<h2 class="post-title" align="center"><?php echo $title;?></h2>
				<h6 class="post-title" style='color:red;font-family: "Times New Roman", Times, red serif;' align="center"><b>CAUSE LIST FOR <?php echo $causelist_dt?></b></h6>
				<h6 class="post-title" style='color:red;font-family: "Times New Roman", Times, red serif;' align="center">SEARCH RESULTS FOR PARTY NAME - <?php echo $party_name;?></h6>
			<article class="group post-1222 page type-page status-publish hentry">
			
									
				<div class="entry" align="center">
			


<table id="partyname" class="display responsive nowrap" style="width:100%">
        <thead style="background: #827676; color: #fff;">
           <tr>
      <th>S.No.</th>
	    <th>Bench Id</th>
	    <th>CAUSE LIST TYPE</th>
	    <th>Purpose code</th>
      <th>Case Number</th>
      <th>Party Name</th>
      <th>Petitioner Advocate</th>
      <th>Respondent Advocate</th>
      <th>Current Position</th>
	   
    </tr>
        </thead>
        <tbody>
		
		<?php
	
		 $cause_list=$DB_option->query("SELECT distinct(sr_no),cino,case_no,ctype,originalsr_no,case_remark,causelist_type,causelist_period,list_from_date,list_to_date,causelist_date,for_bench_id,purpose_cd,reg_dt,filing_dt,section_id,on_filing,clink_code,elimination,causelist_sr_no,cause_list_eliminate,ia_no,ia_next_date,ia_flag,search_case,initial_status,final_status,cause_case_type,cause_reg_no,cause_reg_year,ia_case_type,bunch_code,purpose_priority,short_order,court_no FROM cause_list WHERE  causelist_date ='".$causelist_date."' AND for_bench_id IN (".$jud_bench.")  AND cino IN (".$cnr_num.") AND causelist_sr_no!='0' AND  originalsr_no!='0' and elimination='N'  UNION SELECT distinct(sr_no),cino,case_no,ctype,originalsr_no,case_remark,causelist_type,causelist_period,list_from_date,list_to_date,causelist_date,for_bench_id,purpose_cd,reg_dt,filing_dt,section_id,on_filing,clink_code,elimination,causelist_sr_no,cause_list_eliminate,ia_no,ia_next_date,ia_flag,search_case,initial_status,final_status,cause_case_type,cause_reg_no,cause_reg_year,ia_case_type,bunch_code,purpose_priority,short_order,court_no FROM cause_list_a WHERE  causelist_date ='".$causelist_date."' AND for_bench_id IN (".$jud_bench.")  AND cino IN (".$cnr_num.") AND causelist_sr_no!='0' AND  originalsr_no!='0' and elimination='N' ORDER BY sr_no");
			
		
			
			
			if($cause_list->rowCount() > 0)
			{
				 while($cause_list_row=$cause_list->fetch())
				{
					
					$RegCase_type=$cause_list_row['cause_case_type'];
					$RegCase_no=$cause_list_row['cause_reg_no'];
					$RegCase_year=$cause_list_row['cause_reg_year'];
					$cino=$cause_list_row['cino'];
					$case_no=$cause_list_row['case_no'];
					$sr_no=$cause_list_row['sr_no'];
					$causelist_id=$cause_list_row['causelist_type'];
$for_bench_id=$cause_list_row['for_bench_id'];
$purpose_cd=$cause_list_row['purpose_cd'];

 $query=$DB_option->query("select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b 
 			where a.display='Y' and a.judge_code=b.judge_code and b.court_no='$for_bench_id' and b.from_dt IS NOT NULL 
 			and b.to_dt IS NULL order by b.judge_priority");

		  $judges='';
		   $shortjudge_namerep="";
		$countnorows=$query->rowCount() ;   
		$judgrows=0;
	while($row1=$query->fetch())
	{
		
		$judge_code=$row1['judge_code'];
		$desigcode=$row1['desg_code'];
		$shortjudge_name=$row1['short_judge_name'];
		if($desigcode==1)
			$judge_name="HON'BLE The Chief Justice";
		else if($desigcode==2)
			$judge_name="HON'BLE The Acting Chief Justice";
		else if($desigcode==98)
			$judge_name="";
		else
			$judge_name=$row1['judge_name'];
		if(($countnorows-1)==$judgrows && $countnorows!=1)
		{
			$judges.="AND <br>";
		}
		if($judge_name!='')
		{
		$judges.="THE ".str_replace('HONOURABLE','HON\'BLE',strtoupper($judge_name))."<br>";
		}
		$shortjudge_namerep.=strtoupper(trim($row1['short_judge_name']))."_";
		$judgrows++;
	}
	
					$section = $getdata->getsection($causelist_id);
					$purpose_name = $getdata->getpurpose($purpose_cd);
					
					$ia_case='';
					if(isset($cause_list_row['ia_no'])) 
					{
					$ia_num=$cause_list_row['ia_no'];
					$ia_no = (int)substr($ia_num, -7,-4);
					$ia_year = (int)substr($ia_num, -4);
					$ia_case_no=$cause_list_row['case_no'];
					//IA CASE Details 
					$ia_case_qry=$DB_option->query("SELECT appotherparty,appotheradv,againotheradv,case_no,purpose_code,case_remark FROM ia_filing WHERE case_no = '".$ia_case_no."' and ia_no='".$ia_num."' union SELECT appotherparty,appotheradv,againotheradv,case_no,purpose_code,case_remark FROM ia_filing_a WHERE case_no = '".$ia_case_no."' and ia_no='".$ia_num."'");
					if($ia_case_qry->rowCount() > 0)
			{
					$ia_row=$ia_case_qry->fetch();
					
					$ia_pet_name=$ia_row['appotherparty']; 
					$ia_res_name=$ia_row['appotherparty']; 
					$ia_pet_adv= html_entity_decode(str_replace("&", "and", $ia_row['appotheradv']));
					$ia_res_adv= html_entity_decode(str_replace("&", "and", $ia_row['againotheradv']));
					
					$ia_case_datails='MP /'.$ia_no.' /'.$ia_year;
					$ia_party_details=$ia_pet_name.'<br/>------------'.$ia_res_name;
					
					 $ia_extra_qry=$DB_option->query("SELECT pet_extracount,res_extracount,pet_name,res_name,pet_adv,res_adv,pet_adv_cd,res_adv_cd FROM civil_t WHERE case_no = '".$ia_case_number."' UNION SELECT pet_extracount,res_extracount,pet_name,res_name,pet_adv,res_adv,pet_adv_cd,res_adv_cd FROM civil_t_a WHERE case_no = '".$ia_case_number."'");
			if($ia_extra_qry->rowCount() > 0)
			{	
			while($ia_case_extra_row=$ia_extra_qry->fetch())	
			{
				
				$cause_case_type =$getdata->getcasetype($cause_list_row['cause_case_type']);
				
				
				//$extra_ia_no =$ia_extra_row2['ia_no'];
				$extra_ia_case_no = (int)substr($ia_case_extra_row['case_no'], -7,-4);
				
				$extra_ia_year = (int)substr($ia_case_extra_row['case_no'], -4);
			    $extra_ia_pet_name=$ia_case_extra_row['pet_name']; 
				$extra_ia_res_name=$ia_case_extra_row['res_name']; 
				$ia_pet_count=$ia_case_extra_row['pet_extracount']; 					
					$ia_res_count=$ia_case_extra_row['res_extracount'];
			if($ia_pet_count==1)
			{
				$ia_pet_cont=" AND ANOTHER.";
			}
			else if($ia_pet_count > 1)
			{
				$ia_pet_cont=" AND ".$ia_pet_count." OTHERS.";
			}
			else
			{
				$ia_pet_cont="";
			}
			
			if($ia_res_cont==1)
			{
				$ia_res_cont=" AND ANOTHER.";
			}
			else if($ia_res_cont>1)
			{
				$ia_res_cont=" AND ".$ia_res_cont." OTHERS.";
			}
			else
			{
				$ia_res_cont="";
			}					
				$extra_ia_pet_adv= html_entity_decode(str_replace("&", "and", $ia_extra_row2['pet_adv']));
				$extra_ia_res_adv= html_entity_decode(str_replace("&", "and", $ia_extra_row2['res_adv']));
				
				
				$ia_extra_case_details=$cause_case_type.'.'.$extra_ia_case_no.'/'.$extra_ia_year;
				$ia_extra_party_details=$extra_ia_pet_name.$ia_pet_cont.'</br>--------------</br>'.$extra_ia_res_name.$ia_res_cont;
				$ia_extra_case='<tr>
									<td></td>
									 <td>'.$judges.'</td>
                <td>'.$section.'</td>
                <td>'.$purpose_name.'</td>
									<td>IN </br>'.$ia_extra_case_details.'</td>
									<td>'.$ia_extra_party_details.'</td>
									<td>'.$extra_ia_pet_adv.'</td>
									<td>'.$extra_ia_res_adv.'</td>
									<td></td>
									</tr>';
			}
			}
					
					$ia_case_data='<tr>
									<td>'.$sr_no.'</td>
									 <td>'.$judges.'</td>
									<td>'.$section.'</td>
									<td>'.$purpose_name.'</td>
									<td>'.$ia_case_datails.'</td>
									<td>'.$ia_party_details.'</td>
									<td>'.$ia_pet_adv.'</td>
									<td>'.$ia_res_adv.'</td>
									<td></td>
									</tr>';
									$ia_case=$ia_case_data.$ia_extra_case;
					
			}
					}
					else
					{
					
					$link_cause='';
					
					 $link_cause_list_qry=$DB_option->query("SELECT cino,cause_case_type,cause_reg_no,cause_reg_year,on_filing,case_no,causelist_type FROM cause_list WHERE causelist_date ='".$causelist_date."'  AND for_bench_id = '".$for_bench_id."'  AND causelist_type='".$causelist_id."' AND clink_code ='".$case_no."' AND  elimination='N' ORDER BY sr_no");
		
			
			if($link_cause_list_qry->rowCount() > 0)
			{			
			while($link_cause_list_row=$link_cause_list_qry->fetch())	
			{
					$link_RegCase_type=$link_cause_list_row['cause_case_type'];
					$link_RegCase_no=$link_cause_list_row['cause_reg_no'];
					$link_RegCase_year=$link_cause_list_row['cause_reg_year'];
					$link_cino=$link_cause_list_row['cino'];
					$link_case_no=$link_cause_list_row['case_no'];
					
				
				$link_civil_qry = $DB_option->prepare("SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,
				pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount  FROM civil_t WHERE cino=:link_cino UNION SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount   FROM civil_t_a WHERE cino=:link_cino");
				$link_civil_qry->execute(array(':link_cino'=>$link_cino));				 
				$link_civil_row= $link_civil_qry->fetch();

				
					
				
					
				
				if($link_cause_list_row['on_filing']=='Y')
				{
					$link_fil_type = $getdata->getcasetype($link_RegCase_type);
					$link_case_details="SR No. ".$link_fil_type.'.'.$link_RegCase_no.'/'.$link_RegCase_year;
					
					 $link_civil_t_a_qry = $DB_option->query("SELECT date_filing_disp,disp_nature FROM civil_t_a where cino='".$link_cino."' and date_filing_disp IS NOT NULL  ORDER BY date_filing_disp DESC");
					
							if($link_civil_t_a_qry->rowcount()>0)
						  {
							 
							  
					     $disp_c_nat = $link_civil_t_a_qry->fetch();
						 $link_adj_dis_type = $getdata->GetDisType($disp_c_nat['disp_nature']);	
						 $link_todays_date=date('d-M-Y',strtotime($disp_c_nat['date_filing_disp']));
						 
						  }
						  else
						  {
							  $link_resSrCaseType = $DB_option->query("SELECT todays_date,order_remark,next_date FROM daily_proc_filing where cino='".$link_cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							
							 if($link_resSrCaseType->rowcount()>0)
						  {
							$link_rowDailyCause = $link_resSrCaseType->fetch();
						 //$link_disp_nature=$link_rowDailyCause['disp_nature'];	
						  if(is_null($link_rowDailyCause['next_date']) || $link_rowDailyCause['next_date']=='' ||  $link_rowDailyCause['next_date']=='5000-01-01')
						 {
							  $link_todays_date='';
						 }
						 else
						 {
						 $link_todays_date=date('d-M-Y',strtotime($link_rowDailyCause['next_date']));
						 }
						
							$link_adj_dis_type=$link_rowDailyCause['order_remark'];
						
						  }
						  else
						  {
							 $link_adj_dis_type='';
							$link_todays_date='';							 
						  }
						  }
					
				}
				else
				{
					$link_case_type = $getdata->getcasetype($link_RegCase_type);
					$link_case_details=$link_case_type.'.'.$link_RegCase_no.'/'.$link_RegCase_year;
					$link_daily_pro = $DB_option->query("SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc where cino='".$link_cino."' and todays_date IS NOT NULL  UNION SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc_a where cino='".$link_cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
					if($link_daily_pro->rowcount()>0)
					{
						 $link_daily_pro_row = $link_daily_pro->fetch();
						 $link_adjcode=$link_daily_pro_row['adjcode'];	
						 //$link_todays_date=date('d-M-Y',strtotime($link_daily_pro_row['todays_date']));
						 if(is_null($link_daily_pro_row['next_date']) || $link_daily_pro_row['next_date']==''  ||  $link_daily_pro_row['next_date']=='5000-01-01')
						 {
							  $link_todays_date='';
						 }
						 else
						 {
						 $link_todays_date=date('d-M-Y',strtotime($link_daily_pro_row['next_date']));
						 }
						if($link_adjcode!=0)
						{							
						$link_adj_dis_type = $getdata->GetADType($link_adjcode);
						}
						else
						{
							$link_adj_dis_type=$link_daily_pro_row['order_remark'];
						}
					
					}
					else
					{
						$link_disposal_qry = $DB_option->query("SELECT order_remark FROM disposal_proc where cino='".$link_cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							if($link_disposal_qry->rowcount()>0)
						  {
							  $link_disposal_row = $link_disposal_qry->fetch();
							   
						$link_dis_pos_case=$DB_option->prepare("SELECT disp_nature,date_of_decision FROM civil_t_a  where cino=:cino and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
						$link_dis_pos_case->execute(array(':cino'=>$link_cino));
						$link_row_dis_pos_case= $link_dis_pos_case->fetch(PDO::FETCH_ASSOC);
						$link_adj_dis_type = $getdata->GetDisType($link_row_dis_pos_case['disp_nature']);	
						//$link_todays_date=date('d-M-Y',strtotime($link_row_dis_pos_case['date_of_decision']));	
						$link_todays_date='';	
						
						  }
						  else
						  {
							   $link_civil_t_query1 = $DB_option->query("SELECT disp_nature,date_of_decision FROM civil_t_a where cino='".$link_cino."' and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
							if($link_civil_t_query1->rowcount()>0)
						  {
					          $link_row_civil_t1 = $link_civil_t_query1->fetch();
						 
							  $link_disp_nature_id=$link_row_civil_t1['disp_nature'];
							// $link_todays_date=date('d-M-Y',strtotime($link_row_civil_t1['date_of_decision']));
							 $link_todays_date='';
							  $link_adj_dis_type = $getdata->GetDisType($link_disp_nature_id);	
							  
						  }
						  else
						  {
							  $link_restore_qry=$DB_option->prepare("SELECT remark,next_date,todays_date FROM restorerevoke  where cino=:cino  AND datetype='rev' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
								$link_restore_qry->execute(array(':cino'=>$link_cino));
								$link_restore_row=$link_restore_qry->fetch(PDO::FETCH_ASSOC);
								$link_adj_dis_type = $link_restore_row['remark'];
								// $link_todays_date=date('d-M-Y',strtotime($rlink_estore_row['todays_date']));
								if(is_null($link_restore_row['next_date']) || $link_restore_row['next_date']=='' ||  $link_restore_row['next_date']=='5000-01-01')
						 {
							  $link_todays_date='';
						 }
						 else
						 {
								$link_todays_date=date('d-M-Y',strtotime($link_restore_row['next_date']));
						 }
								
						  }
							  
						  }
					}
				}
					
					$link_pet_name=$link_civil_row['pet_name'];
					$link_res_name=$link_civil_row['res_name'];
					
					$link_pet_count=$link_civil_row['pet_extracount']; 					
					$link_res_count=$link_civil_row['res_extracount']; 
					
					if($link_pet_count==1)
			{
				$link_pet_co=" AND ANOTHER.";
			}
			else if($link_pet_count > 1)
			{
				$link_pet_co=" AND ".$link_pet_count." OTHERS.";
			}
			else
			{
				$link_pet_co="";
			}
			
			if($link_res_count==1)
			{
				$link_res_co=" AND ANOTHER.";
			}
			else if($link_res_count>1)
			{
				$link_res_co=" AND ".$link_res_count." OTHERS.";
			}
			else
			{
				$link_res_co="";
			}
					$link_extra_pet_party = $getdata->GetExtraPetParty($link_cino);
					$link_extra_res_party = $getdata->GetExtraResParty($link_cino);
					
					$link_party_details=$link_pet_name.$link_pet_co.'</br>'.$link_extra_pet_party.'</br>----------------</br>'.$link_res_name.$link_res_co.'</br>'.$link_extra_res_party;
					
					$link_pet_adv=$link_civil_row['pet_adv'];
					$link_res_adv=$link_civil_row['res_adv'];
					
					$link_extra_pet_adv = $getdata->GetExtraPetAdv($link_cino);
					$link_extra_res_adv = $getdata->GetExtraResAdv($link_cino);
					
					$link_pet_advocate_details=$link_pet_adv.'</br>'.$link_extra_pet_adv;
					$link_res_advocate_details=$link_res_adv.'</br>'.$link_extra_res_adv;
					
					$link_proceding=$link_adj_dis_type;
					$link_proceding_dt=$link_todays_date;
					
					$link_cause .='<tr>
									<td></td>
									 <td>'.$judges.'</td>
                <td>'.$section.'</td>
                <td>'.$purpose_name.'</td>
									<td>AND</br>'.$link_case_details.'</td>
									<td>'.$link_party_details.'</td>
									<td>'.$link_pet_advocate_details.'</td>
									<td>'.$link_res_advocate_details.'</td>
									<td>'.$link_proceding.'</br>'.$link_proceding_dt.'</td>
									</tr>';
			}
			}
			
			
					
					
					
				$civil_qry = $DB_option->prepare("SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,
				pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount FROM civil_t WHERE cino=:cino UNION SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount  FROM civil_t_a WHERE cino=:cino");
				$civil_qry->execute(array(':cino'=>$cino));				 
				$civil_row= $civil_qry->fetch();

				//$main_cino=$civil_row['cino'];
					
				
					
				
				if($cause_list_row['on_filing']=='Y')
				{
					$fil_type = $getdata->getcasetype($RegCase_type);
					$case_details="SR No. ".$fil_type.'.'.$RegCase_no.'/'.$RegCase_year;
					$civil_t_a_qry = $DB_option->query("SELECT date_filing_disp,disp_nature FROM civil_t_a where cino='".$cino."' and date_filing_disp IS NOT NULL  ORDER BY date_filing_disp DESC");
					
							if($civil_t_a_qry->rowcount()>0)
						  {
							 
							  
					     $disp_c_nat = $civil_t_a_qry->fetch();
						 $adj_dis_type = $getdata->GetDisType($disp_c_nat['disp_nature']);	
						 //$todays_date=date('d-M-Y',strtotime($disp_c_nat['date_filing_disp']));
						 $todays_date='';
						 
						  }
						  else
						  {
							  $resSrCaseType = $DB_option->query("SELECT todays_date,order_remark,next_date FROM daily_proc_filing where cino='".$link_cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							
							 if($resSrCaseType->rowcount()>0)
						  {
							$rowDailyCause = $resSrCaseType->fetch();
						 //$disp_nature=$rowDailyCause['disp_nature'];	
						// $todays_date=date('d-M-Y',strtotime($rowDailyCause['todays_date']));
						if(is_null($rowDailyCause['next_date']) || $rowDailyCause['next_date']=='' ||  $rowDailyCause['next_date']=='5000-01-01')
						 {
							  $todays_date='';
						 }
						 else
						 {
						 $todays_date=date('d-M-Y',strtotime($rowDailyCause['next_date']));
						 }
							$adj_dis_type=$rowDailyCause['order_remark'];
						
						  }
						  else
						  {
							 $adj_dis_type='';
							$todays_date='';							 
						  }
						  }
					
				}
				else
				{
					$case_type = $getdata->getcasetype($RegCase_type);
					$case_details=$case_type.'.'.$RegCase_no.'/'.$RegCase_year;
					//echo "SELECT adjcode, srno FROM daily_proc where cino='".$cino."' and todays_date='".$causelist_date."' UNION SELECT adjcode, srno FROM daily_proc_a where cino='".$cino."' and todays_date='".$causelist_date."' ORDER BY srno DESC";
					 $daily_pro = $DB_option->query("SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc where cino='".$cino."' and todays_date IS NOT NULL  UNION SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc_a where cino='".$cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
					if($daily_pro->rowcount()>0)
					{
						 $daily_pro_row = $daily_pro->fetch();
						 $adjcode=$daily_pro_row['adjcode'];	
						 //$todays_date=date('d-M-Y',strtotime($daily_pro_row['todays_date']));
						 if(is_null($daily_pro_row['next_date']) || $daily_pro_row['next_date']=='' ||  $daily_pro_row['next_date']=='5000-01-01')
						 {
							  $todays_date='';
						 }
						 else
						 {
						 $todays_date=date('d-M-Y',strtotime($daily_pro_row['next_date']));
						 }
						if($adjcode!=0)
						{							
						$adj_dis_type = $getdata->GetADType($adjcode);
						}
						else
						{
							$adj_dis_type=$daily_pro_row['order_remark'];
						}
					
					}
					else
					{
						$disposal_qry = $DB_option->query("SELECT order_remark FROM disposal_proc where cino='".$cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							if($disposal_qry->rowcount()>0)
						  {
							  $disposal_row = $disposal_qry->fetch();
							   
						$dis_pos_case=$DB_option->prepare("SELECT disp_nature,date_of_decision FROM civil_t_a  where cino=:cino and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
						$dis_pos_case->execute(array(':cino'=>$cino));
						$row_dis_pos_case= $dis_pos_case->fetch(PDO::FETCH_ASSOC);
						$adj_dis_type = $getdata->GetDisType($row_dis_pos_case['disp_nature']);	
						//$todays_date=date('d-M-Y',strtotime($row_dis_pos_case['date_of_decision']));	
						$todays_date='';	
						
						  }
						  else
						  {
							   $civil_t_query1 = $DB_option->query("SELECT disp_nature,date_of_decision FROM civil_t_a where cino='".$cino."' and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
							if($civil_t_query1->rowcount()>0)
						  {
					          $row_civil_t1 = $civil_t_query1->fetch();
						 
							  $disp_nature_id=$row_civil_t1['disp_nature'];
							// $todays_date=date('d-M-Y',strtotime($row_civil_t1['date_of_decision']));
							 $todays_date='';
							  $adj_dis_type = $getdata->GetDisType($disp_nature_id);	
							  
						  }
						  else
						  {
							  $restore_qry=$DB_option->prepare("SELECT remark,next_date,todays_date FROM restorerevoke  where cino=:cino  AND datetype='rev' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
								$restore_qry->execute(array(':cino'=>$cino));
								$restore_row=$restore_qry->fetch(PDO::FETCH_ASSOC);
								$adj_dis_type = $restore_row['remark'];
								// $todays_date=date('d-M-Y',strtotime($restore_row['todays_date']));
								if(is_null($restore_row['next_date']) || $restore_row['next_date']=='' ||  $restore_row['next_date']=='5000-01-01')
						 {
							  $todays_date='';
						 }
						 else
						 {
								$todays_date=date('d-M-Y',strtotime($restore_row['next_date']));
						 }
						  }
							  
						  }
					}
				}
					
					$pet_name=$civil_row['pet_name'];
					$res_name=$civil_row['res_name'];
					
					$extra_pet_party = $getdata->GetExtraPetParty($cino);
					$extra_res_party = $getdata->GetExtraResParty($cino);
					
					$pet_count=$civil_row['pet_extracount']; 					
					$res_count=$civil_row['res_extracount']; 
					
					if($pet_count==1)
			{
				$pet_cont=" AND ANOTHER.";
			}
			else if($pet_count > 1)
			{
				$pet_cont=" AND ".$pet_count." OTHERS.";
			}
			else
			{
				$pet_cont="";
			}
			
			if($res_count==1)
			{
				$res_cont=" AND ANOTHER.";
			}
			else if($res_count>1)
			{
				$res_cont=" AND ".$res_count." OTHERS.";
			}
			else
			{
				$res_cont="";
			}
			
					$party_details=$pet_name.$pet_cont.'</br>'.$extra_pet_party.'</br>----------------</br>'.$res_name.$res_cont.'</br>'.$extra_res_party;
					
					$pet_adv=$civil_row['pet_adv'];
					$res_adv=$civil_row['res_adv'];
					
					$extra_pet_adv = $getdata->GetExtraPetAdv($cino);
					$extra_res_adv = $getdata->GetExtraResAdv($cino);
					
					$pet_advocate_details=$pet_adv.'</br>'.$extra_pet_adv;
					$res_advocate_details=$res_adv.'</br>'.$extra_res_adv;
					
					$proceding=$adj_dis_type;
					$proceding_dt=$todays_date;
					$main_cause='<tr style="font-weight:500">
									<td>'.$sr_no.'</td>
									 <td>'.$judges.'</td>
									<td>'.$section.'</td>
									<td>'.$purpose_name.'</td>
									<td>'.$case_details.'</td>
									<td>'.$party_details.'</td>
									<td>'.$pet_advocate_details.'</td>
									<td>'.$res_advocate_details.'</td>
									<td>'.$proceding.'</br>'.$proceding_dt.'</td>
									</tr>';
					echo $cause_list_data=$main_cause.$link_cause.$ia_case;
					//$srno++;
				}
				}
			}
		?>
 
          

          
        </tbody>
        <tfoot>
            <tr>
               <th>S.No.</th>
	    <th>Bench Id</th>
	    <th >CAUSE LIST TYPE</th>
	    <th>Purpose code</th>
      <th>Case Number</th>
      <th>Party Name</th>
      <th>Petitioner Advocate</th>
      <th>Respondent Advocate</th>
      <th>Current Position</th>
            </tr>
        </tfoot>
    </table>	
					<div class="clear"></div>
				</div><!--/.entry-->
				
			</article>
			
	
				
	</div><!--/.pad-->
	
</div><!--/.content-->


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

<?php }else
{
	echo '<h6 class="post-title" style="color:red;font-family: "Times New Roman", Times, red serif;" align="center"><b>NO RECORDS</b></h6>';
}}
else
{
	echo '<h6 class="post-title" style="color:red;font-family: "Times New Roman", Times, red serif;" align="center"><b>NO RECORDS</b></h6>';
}
} } else
		{
			 echo '<br><br><h3 style="color:red;text-align:center;">No Records!</h3>';
		}
		}
		else
		{
			 echo '<br><br><h3 style="color:red;text-align:center;">Captcha not matching</h3>';
		}  ?>
	 <script>
	$(document).ready(function() {
    $('#partyname').DataTable( {
		"scrollX": true,
        order: [[2, 'desc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [ 1, 2, 3 ]
        },
        columnDefs: [ {
            targets: [ 1, 2, 3 ],
            visible: false
        } ],
		lengthMenu: [25,75, 100, 300, 500,800,1000]
    } );
	
	 
	
} );
	
	</script>
