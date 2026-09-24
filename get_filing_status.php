<?php 
session_start();
require('config/dbconfig.php');
require('config/dbconfig_status.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);
error_reporting( 0);
include 'fun_class.php';
require_once 'securimage.php';
$getdata =new GETDETAILS($HCMAS_DB);
$cond="";
$case_details_valu="";
$search_for ="NO SEARCH RESULTS FOUND";
$temp_id="";
$valid1="";



//CASE NO SEARCH
if(isset($_POST['action']) and $_POST['action']=='get_filing_status')
{
	
	$securimage1 = new Securimage(array('namespace' => 'statusform'));
    $valid1 = $securimage1->check($_POST['status_captcha']);
	
	if($valid1){  
		
	    $valid1=1;  
	    $section=$_POST['section'];
		$fdate=$_POST['from_date'];
		if(isset($_POST['to_date']))
		{
		$tdate=$_POST['to_date'];
		}
		else
		{
		$tdate=$_POST['from_date'];
		}
		//$mode=$_POST['mode'];
		


$sno=1;
		?>
		<div class="commentform" style="margin-top: 20px;">
		 <h2 class="post-title" align="center">THE CASE INFORMATION SYSTEM</h2>
				
				<h6 class="post-title" style='color:red' align="center">SEARCH RESULTS FOR  : Allocation details of cases filed on <?php echo implode('-',array_reverse(explode('-',$fdate)))."-".implode('-',array_reverse(explode('-',$tdate)));?></h6>
			<article class="group post-1222 page type-page status-publish hentry">
			
									
				<div class="entry" align="center">
			

<table id="<?php echo 'filing_status'; ?>" class="display responsive nowrap" cellspacing="0" width="100%" >
  <caption></caption>
  <thead style="background: #827676; color: #fff;">
    <tr>
     <th scope="col" width="2%">Sno.</th>
      <th scope="col" width="10%" style="text-align:left;"> Cino / E-Filing No.</th>      
      <th scope="col" width="10%" style="text-align:left;"> Filing No. </th>
	  <th scope="col" width="10%" style="text-align:left;"> Case No. </th>
	  <th scope="col" width="11%" style="text-align:left;"> Party Details </th>
      <th scope="col" width="10%" style="text-align:left;"> Counsel Details </th>	   
      <th scope="col" width="3%" style="text-align:left;"> AE </th>	 
	<th scope="col" width="9%" style="text-align:left;"> Alloted Date </th>
<th scope="col" width="5%" style="text-align:left;"> Status </th>	
	<th scope="col" width="8%" style="text-align:left;"> Passed / Returned Date </th>	
	<th scope="col" width="22%" style="text-align:left;"> Remarks </th>	
    </tr>
  </thead>
  <tbody>	
			
		<?php
		if($section!='4'){
		$excJudicial = $HCMAS_DB->query("SELECT * FROM court_t WHERE court_no = '".$section."'");
								$rowJudicial = $excJudicial->fetch();
								$judicialData = explode(',',$rowJudicial['case_types']);
								//$judicialData = "'" . implode( "', '", $judicialData ) . "'";
								$s_judicialData="'";
								for($i=0;$i<count($judicialData);$i++)
								{
									if($i!=0)
									{
										$s_judicialData.=",'";
									}
									$tmp=$getdata->getcasetype($judicialData[$i]);
									$s_judicialData.=trim($tmp);
									$s_judicialData.="'";
								}
								$sub_query = " AND casetype_name IN (".$s_judicialData.")";
						
		$exec_qry="with excl_efilno as(
							SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,reason_for_rej,date(create_modify) as ret_ctreate_on,'N' as under_obj,'N' as obj_flag, RANK() OVER ( partition by efilno ORDER BY create_on DESC	) efile_rank from ecivil_t_rejected where date_of_filing >='2024-03-01' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."' and efilno not like 'ECHCMA%' ".$sub_query." and efilno not in (SELECT efilno FROM ecivil_t WHERE date_of_filing >='2024-03-01' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."' and efilno not like 'ECHCMA%' ".$sub_query." )
							),
							exec_qry as (SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,'' as reason_for_rej,date('1900-07-23') as ret_ctreate_on,under_obj,obj_flag FROM civil_t WHERE date_of_filing >='2024-03-01' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."' and efilno is null and branch_id='".$section."' union SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,'' as reason_for_rej,date('1900-07-23') as ret_ctreate_on,under_obj,obj_flag FROM civil_t_a WHERE date_of_filing >='2024-03-01' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."' and efilno is null and branch_id='".$section."' union SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,reason_for_rej,date(create_modify) as ret_ctreate_on,'N' as under_obj,'N' as obj_flag FROM ecivil_t WHERE date_of_filing >='2024-03-01' and  date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."' and efilno not like 'ECHCMA%' ".$sub_query." union SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,reason_for_rej, ret_ctreate_on,'N' as under_obj,'N' as obj_flag FROM
		excl_efilno  where efile_rank =1)
		select * from exec_qry";
		}
		else{
			$exec_qry="SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,'' as reason_for_rej,date('1900-07-23') as ret_ctreate_on,under_obj,obj_flag FROM civil_t WHERE date_of_filing >='2024-09-30' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."'  and branch_id='".$section."' union 
							SELECT case_no,efilno, cino, filcase_type, fil_no, fil_year, regcase_type, reg_no, reg_year, pet_name, lpet_name, res_name, lres_name, pet_adv, res_adv,filing_no,'' as reason_for_rej,date('1900-07-23') as ret_ctreate_on,under_obj,obj_flag FROM civil_t_a WHERE date_of_filing >='2024-09-30' and date_of_filing >= '".$fdate."' and date_of_filing <= '".$tdate."'  and branch_id='".$section."' ";
		}
	//	echo $exec_qry;
		$ecivil_qry=$HCMAS_DB->query($exec_qry) ;
				
		if($ecivil_qry->rowCount()>0)
		{
		while($ecivil_qry_data=$ecivil_qry->fetch())
				{
					if(!is_null($ecivil_qry_data['efilno']))
					{
					if($section!='4'){	
					$index_qry=$CIS_DB->query("select * from ((SELECT  ae_emp_code,efilno,status,receipt_dt,'' as objection,allocation_dt,9999 as sar_pass,date('1900-07-23') as sar_date  FROM tn_ae_distribution_efilno where efilno not like 'ECHCMA%' and efilno='".$ecivil_qry_data['efilno']."') union (SELECT  ae_emp_code,efilno,status,receipt_dt,objection,allocation_dt,sar_pass,sar_date  FROM tn_ae_distribution_efile where efilno not like 'ECHCMA%' and efilno='".$ecivil_qry_data['efilno']."' )) a  order by allocation_dt desc,status asc limit 1 ");
					}
					else
					{
						$index_qry=$CIS_DB->query(" SELECT  ae_emp_code,efilno,status,receipt_dt,objection,allocation_dt,sar_pass,sar_date  FROM tn_ae_distribution_efile where efilno not like 'ECHCMA%' and efilno='".$ecivil_qry_data['efilno']."'  order by allocation_dt desc,status asc limit 1 ");
					}
					
					if($index_qry->rowCount()>0)
		{
			$status="";
			$alloc_dt="";
			$ae_initial="";
			$pass_ret_dt="";
			$remarks="";
			$main_case_no="";
			$fil_case_no="";
						if($ecivil_qry_data['case_no'])
						if(trim($ecivil_qry_data['case_no']) != "" && trim($ecivil_qry_data['case_no']) != "0") {
							$matter_year = $ecivil_qry_data['reg_year'];
							$matter_no = $ecivil_qry_data['reg_no'];
							$matter_type = $getdata->getcasetype($ecivil_qry_data['regcase_type']);
							$main_case_no=$matter_type." No. ".$matter_no."/".$matter_year;
						}
						if($ecivil_qry_data['filing_no'])
						if(trim($ecivil_qry_data['filing_no']) != "" && trim($ecivil_qry_data['filing_no']) != "0") {
							$fil_year = $ecivil_qry_data['fil_year'];
							$fil_no = $ecivil_qry_data['fil_no'];
							$fil_type = $getdata->getcasetype($ecivil_qry_data['filcase_type']);
							$fil_case_no=$fil_type." No. ".$fil_no."/".$fil_year;
						}
							
							$pet_name=trim($ecivil_qry_data['pet_name']);
							if(!is_null($ecivil_qry_data['lpet_name']))
								$pet_name=$pet_name." ".trim($ecivil_qry_data['lpet_name']);
							if(trim($pet_name)=="")
								$pet_name= "--";
							$res_name=trim($ecivil_qry_data['res_name']);
							if(!is_null($ecivil_qry_data['lres_name']))
								$res_name=$res_name." ".trim($ecivil_qry_data['lres_name']);
							if(trim($res_name)=="")
								$res_name= "--";
							$party_det=$pet_name."<br>vs<br>".$res_name;
						$pet_res=$pet_name."<br>vs<br>".$res_name;
						if(!is_null($ecivil_qry_data['cino']))
							$cino="<br>(".$ecivil_qry_data['cino'].")";
						else
							$cino="";
						
						$efil_cino=str_replace("C","-C",$ecivil_qry_data['efilno']).$cino;
						$pet_adv="";
						if(!is_null($ecivil_qry_data['pet_adv']))
							$pet_adv=trim($ecivil_qry_data['pet_adv']);
						else
							$pet_adv="--";
						if(!is_null($ecivil_qry_data['res_adv'])&&trim($ecivil_qry_data['res_adv'])!="")
							$res_adv=trim($ecivil_qry_data['res_adv']);
						else
							$res_adv="--";
					while($index_qryData=$index_qry->fetch())
						{
							$alloc_dt=implode('-',array_reverse(explode('-',$index_qryData['allocation_dt'])));
							$ae_qry=$CIS_DB->query("select initial from tn_users where user_id='".trim($index_qryData['ae_emp_code'])."'");
								if($ae_qry->rowCount()>0)
									{
										$ae_data=$ae_qry->fetch();
										if(!is_null($ae_data['initial'])&&trim($ae_data['initial'])!="")
										$ae_initial=$ae_data['initial'];
									else
										$ae_initial="";
									}
							if($index_qryData['status']=='1')
							{
								$status="<span style='font-weight:bold;color:green'>Passed</span>";
								$pass_ret_dt=implode('-',array_reverse(explode('-',$index_qryData['receipt_dt'])));
								
									 $remarks="";
							}
							else if ($index_qryData['status']=='4')
							{
								if($index_qryData['sar_pass']!=9999&&$index_qryData['sar_date']!='1900-07-23') //efile table
								{
									if($index_qryData['sar_pass']==1)
									{
										$status="<span style='font-weight:bold;color:red'>Returned</span>";
										$pass_ret_dt=implode('-',array_reverse(explode('-',$index_qryData['receipt_dt'])));
										if(trim($index_qryData['objection'])!="")
										$remarks=str_replace("%","",$index_qryData['objection']);
									}
									else
									{
										$pass_ret_dt="";
										$remarks="Pending with AE for scrutiny";
										$status="";
									}
								}
								else
								{
									$status="<span style='font-weight:bold;color:red'>Returned</span>";
									$remarks=$ecivil_qry_data['reason_for_rej'];
									$pass_ret_dt=implode('-',array_reverse(explode('-',$ecivil_qry_data['ret_ctreate_on'])));
								}
								/*$status="<span style='font-weight:bold;color:red'>Returned</span>";
								$pass_ret_dt=implode('-',array_reverse(explode('-',$index_qryData['receipt_dt'])));
								if(trim($index_qryData['objection'])!="")
								$remarks=$index_qryData['objection'];
								else
								{
									$remarks=$ecivil_qry_data['reason_for_rej'];
									$pass_ret_dt=implode('-',array_reverse(explode('-',$ecivil_qry_data['ret_ctreate_on'])));
								}*/
							}
							else
							{
								$pass_ret_dt="";
								$remarks="Pending with AE for scrutiny";
								$status="";
							}
							
						?>	
						
							<tr>
				   <td style="text-align:left;"><?php echo $sno;?></td>
				   <td style="text-align:left;"><?php echo $efil_cino;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $fil_case_no;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $main_case_no;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo strtoupper($pet_name)."<br>Vs<br>".strtoupper($res_name);?></td>
				   <td style="text-align:left;word-wrap: break-word;"><?php echo strtoupper($pet_adv)."<br>Vs<br>".strtoupper($res_adv);?></td>
				   <td style="text-align:left;font-weight:bold"><?php echo $ae_initial;?></td>
				   <td style="text-align:left;"><?php echo $alloc_dt;?></td>
				   <td style="text-align:left;"><?php echo $status;?></td>
				   <td style="text-align:left;"><?php echo $pass_ret_dt;?></td>
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $remarks;?></td>
				   
				</tr>		  
<?php
		      $sno++;
				  }
				}
		      
					}
					else{
					$index_qry=$CIS_DB->query("SELECT  ae_emp_code,cino,status,receipt_dt,allocation_dt,represent_flag  FROM tn_ae_distribution where cino='".$ecivil_qry_data['cino']."'  order by status asc, allocation_dt desc limit 1 ");
					
					if($index_qry->rowCount()>0)
		{
			$status="";
			$alloc_dt="";
			$ae_initial="";
			$pass_ret_dt="";
			$remarks="";
			$main_case_no="";
			$fil_case_no="";
						if($ecivil_qry_data['case_no'])
						if(trim($ecivil_qry_data['case_no']) != "" && trim($ecivil_qry_data['case_no']) != "0") {
							$matter_year = $ecivil_qry_data['reg_year'];
							$matter_no = $ecivil_qry_data['reg_no'];
							$matter_type = $getdata->getcasetype($ecivil_qry_data['regcase_type']);
							$main_case_no=$matter_type." No. ".$matter_no."/".$matter_year;
						}
						if($ecivil_qry_data['filing_no'])
						if(trim($ecivil_qry_data['filing_no']) != "" && trim($ecivil_qry_data['filing_no']) != "0") {
							$fil_year = $ecivil_qry_data['fil_year'];
							$fil_no = $ecivil_qry_data['fil_no'];
							$fil_type = $getdata->getcasetype($ecivil_qry_data['filcase_type']);
							$fil_case_no=$fil_type." No. ".$fil_no."/".$fil_year;
						}
							
							$pet_name=trim($ecivil_qry_data['pet_name']);
							if(!is_null($ecivil_qry_data['lpet_name']))
								$pet_name=$pet_name." ".trim($ecivil_qry_data['lpet_name']);
							if(trim($pet_name)=="")
								$pet_name= "--";
							$res_name=trim($ecivil_qry_data['res_name']);
							if(!is_null($ecivil_qry_data['lres_name']))
								$res_name=$res_name." ".trim($ecivil_qry_data['lres_name']);
							if(trim($res_name)=="")
								$res_name= "--";
							$party_det=$pet_name."<br>vs<br>".$res_name;
						$pet_res=$pet_name."<br>vs<br>".$res_name;
						if(!is_null($ecivil_qry_data['cino']))
							$cino=$ecivil_qry_data['cino'];
						else
							$cino="";
						
						$efil_cino=$cino;
						$pet_adv="";
						if(!is_null($ecivil_qry_data['pet_adv']))
							$pet_adv=trim($ecivil_qry_data['pet_adv']);
						else
							$pet_adv="--";
						if(!is_null($ecivil_qry_data['res_adv'])&&trim($ecivil_qry_data['res_adv'])!="")
							$res_adv=trim($ecivil_qry_data['res_adv']);
						else
							$res_adv="--";
					while($index_qryData=$index_qry->fetch())
						{
							$alloc_dt=implode('-',array_reverse(explode('-',$index_qryData['allocation_dt'])));
							$ae_qry=$CIS_DB->query("select initial from tn_users where user_id='".trim($index_qryData['ae_emp_code'])."'");
								if($ae_qry->rowCount()>0)
									{
										$ae_data=$ae_qry->fetch();
										if(!is_null($ae_data['initial'])&&trim($ae_data['initial'])!="")
										$ae_initial=$ae_data['initial'];
									else
										$ae_initial="";
									}
							if(!is_null($ecivil_qry_data['case_no'])||(!is_null($ecivil_qry_data['case_no'])&&trim($ecivil_qry_data['case_no'])!=''))
							{
								$status="<span style='font-weight:bold;color:green'>Passed</span>";
								if(!is_null($index_qryData['receipt_dt']))
								$pass_ret_dt=implode('-',array_reverse(explode('-',$index_qryData['receipt_dt'])));
								else
								$pass_ret_dt='';
									 $remarks="";
							}
							else if((is_null($ecivil_qry_data['case_no'])||(!is_null($ecivil_qry_data['case_no'])&&trim($ecivil_qry_data['case_no'])==''))&&$ecivil_qry_data['under_obj']=='Y')
							{  
								$rep_dt="";
								$remarks="";
								$obj_list="";
								$pass_ret_dt='';
								$obj_hist=$HCMAS_DB->query("select * from objection_history where cino='".$ecivil_qry_data['cino']."' order by srno desc limit 1");
								if($obj_hist->rowCount()>0)
									{
										$obj_hist_data=$obj_hist->fetch();
										$obj_list=trim($obj_hist_data['objection']);
										$pass_ret_dt=implode('-',array_reverse(explode('-',$obj_hist_data['objprepare_dt'])));
										$tn_obj_hist=$CIS_DB->query("select * from tn_objection_history_records where cino='".$ecivil_qry_data['cino']."' and obj_return_dt='".$obj_hist_data['objprepare_dt']."' order by obj_srno desc limit 1");
										if($tn_obj_hist->rowCount()>0)
									{
										$tn_obj_hist_data=$tn_obj_hist->fetch();
										$rep_dt=$tn_obj_hist_data['obj_represent_dt'];
										
									}
									}
								if($index_qryData['represent_flag']==0){
								$status="<span style='font-weight:bold;color:red'>Returned</span>";
								
										if($rep_dt){
										if($index_qryData['allocation_dt']>=$rep_dt) // Represented by ADV
										{
											$remarks='Pending with AE for Scrutiny';
											$pass_ret_dt='';
											$status="";
										}
										else
										{
											$tatus="";
										}}
										else{ //Pending with ADV
										$obj_list_arr=explode('%',$obj_list);
										$obj_sno=1;
										if(trim($obj_list_arr[0])){
										$obj_list_arr_0=implode("','",explode(',',$obj_list_arr[0]));
										if($obj_list_arr_0)
										$obj_list_final="'".$obj_list_arr_0."'";
										else
											$obj_list_final='0';
										$obj_t_qry=$HCMAS_DB->query("select objtype from objection_t where objcode in (".$obj_list_final.") ");
										
										if($obj_t_qry->rowCount()>0)
									{
										while($obj_t_data=$obj_t_qry->fetch()){
										$remarks.="<span style='text-weight:bold'>".$obj_sno.')</span> '.trim($obj_t_data['objtype'])." ";
										$obj_sno++;
										}
									}
										}
									if($obj_list_arr[1])
									if(trim($obj_list_arr[1]))
										$remarks.="<span style='text-weight:bold'>".$obj_sno.')</span> '.trim($obj_list_arr[1]);
									$status="<span style='font-weight:bold;color:red'>Returned</span>";
									}
									//}
								}
								else if ($index_qryData['represent_flag']==1)
								{
									//old data
									if($rep_dt){
										if($index_qryData['allocation_dt']<=$rep_dt) // Represented by ADV
										{
											$remarks='Pending with AE for Scrutiny';
											$pass_ret_dt='';
											$status="";
										}}
										else
										{
											 //Pending with ADV
										$obj_list_arr=explode('%',$obj_list);
										$obj_sno=1;
										if(trim($obj_list_arr[0])){
										$obj_list_arr_0=implode("','",explode(',',$obj_list_arr[0]));
										if($obj_list_arr_0)
										$obj_list_final="'".$obj_list_arr_0."'";
										else
											$obj_list_final='0';
										$obj_t_qry=$HCMAS_DB->query("select objtype from objection_t where objcode in (".$obj_list_final.") ");
										
										if($obj_t_qry->rowCount()>0)
									{
										while($obj_t_data=$obj_t_qry->fetch()){
										$remarks.="<span style='text-weight:bold'>".$obj_sno.')</span> '.trim($obj_t_data['objtype'])." ";
										$obj_sno++;
										}
									}
										}
									if($obj_list_arr[1])
									if(trim($obj_list_arr[1]))
										$remarks.="<span style='text-weight:bold'>".$obj_sno.')</span> '.trim($obj_list_arr[1]);
									$status="<span style='font-weight:bold;color:red'>Returned</span>";
									
										}
									
									//New data
									
								}
								
							/*	$status="<span style='font-weight:bold;color:red'>Returned</span>";
								$pass_ret_dt=implode('-',array_reverse(explode('-',$index_qryData['receipt_dt'])));
								if(trim($index_qryData['objection'])!="")
								$remarks=$index_qryData['objection'];
								else
								{
									$remarks=$ecivil_qry_data['reason_for_rej'];
									$pass_ret_dt=implode('-',array_reverse(explode('-',$ecivil_qry_data['ret_ctreate_on'])));
								}*/
							}
							else if((is_null($ecivil_qry_data['case_no'])||(!is_null($ecivil_qry_data['case_no'])&&trim($ecivil_qry_data['case_no'])==''))&&$ecivil_qry_data['under_obj']=='N')
							{
								$pass_ret_dt="";
								$remarks="Pending with AE for Scrutiny";
								$status="";
							}
							else
							{
								$pass_ret_dt="";
								$remarks="";
								$status="";
							}
							
						?>	
						
							<tr>
				   <td style="text-align:left;"><?php echo $sno;?></td>
				   <td style="text-align:left;"><?php echo $efil_cino;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $fil_case_no;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $main_case_no;?></td> 
				   <td style="text-align:left;word-wrap: break-word;"><?php echo strtoupper($pet_name)."<br>Vs<br>".strtoupper($res_name);?></td>
				   <td style="text-align:left;word-wrap: break-word;"><?php echo strtoupper($pet_adv)."<br>Vs<br>".strtoupper($res_adv);?></td>
				   <td style="text-align:left;font-weight:bold"><?php echo $ae_initial;?></td>
				   <td style="text-align:left;"><?php echo $alloc_dt;?></td>
				   <td style="text-align:left;"><?php echo $status;?></td>
				   <td style="text-align:left;"><?php echo $pass_ret_dt;?></td>
				   <td style="text-align:left;word-wrap: break-word;"><?php echo $remarks;?></td>
				   
				</tr>		  
<?php
		      $sno++;
				  }
					}}
				}    
		//while ending
		if($sno==1)
		{			 
			echo '<h3 style="color:red;">NO SEARCH RESULTS FOUND</h3>';
		}
?>
		 
		   </tbody>
</table>
					<div class="clear"></div>
				</div><!--/.entry-->
				<?php
}
else
	echo '<h3 style="color:red;">NO SEARCH RESULTS FOUND</h3>';

?>

				
			</article>
			
<?php 	


?>
				
	
	</div><!--/.container-->

	<?php 				
							
	}
else
echo '<h3 style="color:red;">Captcha not matching</h3>';}
else
	echo "there is an error ";
						
				
?>




<style>

.main-inner {
    position: relative;
min-height: 600px; }
.col-3cm .main-inner {
    background:none;
	padding-left: 0;
padding-right: 0;
}

.col-3cm .main {
background:None; }


table.dataTable tbody td{border-bottom: 1px solid #999;}
	</style>
	  
	   
	


<!--/.container-->

	
	
	
	<script>
	$(document).ready( function () {
		var table_id='filing_status';
		$('#'+table_id).DataTable();
	});
	
	</script>