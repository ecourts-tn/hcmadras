<?php

session_start(); 
require_once 'securimage.php';
require('config/dbconfig.php');
require('config/dbconfig_status.php');
include 'fun_class.php';

$getdata =new GETDETAILS($MDU_HCMAS_DB);

	function check_input($a){
		
		$raw1 = trim($a);
		$raw2 = $raw1 ? stripslashes($raw1) : '';
		$raw3 = $raw2 ? htmlspecialchars($raw2) :'';
		
		return $raw3;

	}
	
	function check_tags ($content){
		$content_fin ='';
		$content1 = $content ?  trim($content) : '';
		$content_fin = $content1 ? htmlspecialchars($content1) :'';
		
		return $content_fin;
	}
	
	function fee_mode($a){
			$b ='';
		if(trim($a)==1){
			$b = "Cash";
		} else if(trim($a)==2){
			$b = "Stamp";
		} else if(trim($a)==3){
			$b = "E-Chalan";
		} else if(trim($a)==4){
			$b = "Challan";
		} else if(trim($a)==5){
			$b = "D.D.";
		} else if(trim($a)==6){
			$b = "Cheque";
		}
		
		return $b;
	}
	
	function notice_mode($a){
		$b='';
		if($a==1){
			$b ='Bailiff';
		} else if ($a==2){
			$b ='RPAD';
		} else if ($a==3){
			$b ='SpeedPost';
		} else if ($a==4){
			$b ='Ordinary';
		}
		return $b;
	}
	
	function daet_formt($data){
		$result = $data ? date('d-m-Y',strtotime($data)) : '';
    	return $result;

    }
	
	
	

	/* function integer_tester($a,$b){
		
		$final_value =0;
		$first_filter = $a ? (int) filter_var($a, FILTER_SANITIZE_NUMBER_INT)  : ''; 
		
		$string_length = $first_filter ? strlen($first_filter): '';
		if($string_length){
			$final_value = $b == 'unknown' ? $first_filter : $string_length == $b ? $first_filter  : ''  ;
		}  
		
		return $final_value;
	} */

	function integer_tester($a,$b){
		
		$final_value =0;
		$first_filter = is_numeric($a) ? $a  : ''; 
		
		$string_length = $first_filter ? strlen($first_filter): '';
		if($string_length){
		$final_value = $b == 'unknown' ? $first_filter :( $string_length == $b ? $first_filter  : '');
		}  
		return $final_value;
	}
	
	// CHECK WHETHER ORDER COPY PDF FILE EXISTS ON 1.36 SERVER
function ChkFileExists($ord_yr,$ord_caseno,$ord_no) {
	$order_yr=$ord_yr;
	$order_caseno=$ord_caseno;
	$order_no=$ord_no;
	$cis_url="http://10.241.47.2/cis";
	$curlerror="";
	$webservice_file_name = $cis_url."/hcmadras_files.php";
	$data = array("action" => "judgment_orders","order_yr" => $order_yr,"order_caseno"=>$order_caseno,"order_no"=>$order_no);
	$data_string = urlencode(json_encode($data));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $webservice_file_name);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("chk_data_arr"=>$data_string));
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$curl_output1 = curl_exec($ch);
	 $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
	if (curl_error($ch)) {
		$curlerror = "Document Loading Error: " . curl_error($ch);
	}

	curl_close($ch);
	$fil_nme = $ord_yr.'_'.$ord_caseno.'_'.$ord_no.'_MDUmain';

	if (!$curlerror) {
		if ($curl_output1 == "404") {
			$filePath='404';
			}
			else {
				$filePath = $fil_nme;
			}

			return $filePath;
			}
	else {
		$filePath='404';
		return $filePath;
	} 
}

	
	
	
	
	
?>
<style>
		.pdf_but
{
    background: #CB0909;
    color: white;
    padding: 6px 10px;
    font-weight: 600;
    display: inline-block;
    border: none;
    cursor: pointer;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
	.table_caseno_search  {
		width:100%;
	}
	
	.table_caseno_search table, th, td {
		border: 1px solid black;
		
	}
	
	
	
	.table_caseno_search th, td {
		padding: 15px;
	}
	
	.table_caseno_search th {
		font-weight: 600;
	}
	
	
	.table_heading_style{
		 background-color:#cccccc;font-weight: bold; 
	}
	
	th {
		background-color: #6c8e99;
		color: white;
		font-weight: bold;
	}
	td {
		font-weight: bold;
	}

</style>
<div class="commentform" style="margin-top: 20px;">

<?php	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//echo $_POST['filing_captcha'];
		
		if( (isset($_POST['caseno_captcha']) && !empty($_POST['caseno_captcha']))){
			
			/* $user_captcha = check_input($_POST['caseno_captcha']);
			$page_captcha = trim($_SESSION['case_captcha']); */
			
			$securimage = new Securimage(array('namespace' => 'contact'));
            $valid = $securimage->check($_POST['caseno_captcha']);
			
			
			
			
			/* if($user_captcha === $page_captcha){ */
			
			if($valid){
				
				if(isset($_POST['case_nme']) && !empty($_POST['case_nme']) &&  isset($_POST['case_no']) && !empty($_POST['case_no']) && isset($_POST['case_year']) && !empty($_POST['case_year'])){
			
					$cas_name =  check_input($_POST['case_nme']);
			 
					$cas_no =  check_input($_POST['case_no']);
					$cas_year =   check_input($_POST['case_year']);
			
					$case_name = integer_tester($cas_name,'unknown');
			 
					$case_no = integer_tester($cas_no,'unknown');
					$case_year = integer_tester($cas_year,4);
				
			 
			
			
					if($case_name  && $case_no && $case_year){
				
						$query_main = $MDU_HCMAS_DB->prepare("SELECT * FROM civil_t WHERE regcase_type = :case_name AND reg_no = :caseno AND reg_year = :case_year union SELECT * FROM civil_t_a WHERE regcase_type = :case_name AND reg_no = :caseno AND reg_year = :case_year  ORDER BY reg_no ASC ");
			 	
			
						$result = $query_main->execute(array(':case_name'=>$case_name,':caseno'=>$case_no,':case_year'=>$case_year));	
				 
						if($result){
					
							if($query_main->rowcount()){
						
								$query_main_result  = $query_main->fetch();
						
						//getting case type name,no,year,cino
							
						$main_srcase_typeno =  trim($query_main_result['filcase_type']) ? trim($query_main_result['filcase_type']) : '' ;
							
							//getting fullform sr case type
							
								$sr_casetype_full_form = '';
								$sr_casetype_short_form = '';
								
								$sr_casetype = $MDU_HCMAS_DB->prepare("select type_name,full_form from case_type_t where case_type = :srcasetype_no ");
								
								if($sr_casetype){
									$srcasequery_execute = $sr_casetype->execute(array(':srcasetype_no'=>$main_srcase_typeno));
									if($srcasequery_execute){
										if($sr_casetype->rowcount()){
											
											$sr_casetype_result = $sr_casetype->fetch();
											$sr_casetype_full_form = trim($sr_casetype_result['full_form']);
											$sr_casetype_short_form = trim($sr_casetype_result['type_name']);
											
										} //row emtpy
									} //execute err
								} //qry err
								
							//getting fullform sr case type
						
							$main_srcase_no = trim($query_main_result['fil_no']) ? trim($query_main_result['fil_no']) : 0 ;
							$main_srcase_year = trim($query_main_result['fil_year']) ? trim($query_main_result['fil_year']) : 0;
						
							$main_case_typeno = $query_main_result['regcase_type'] ? trim($query_main_result['regcase_type']) : 0 ;
							//getting fullform main case type
								$reg_casetype_full_form = '';
								$reg_casetype_short_form = '';
								
								$regno_casetype = $MDU_HCMAS_DB->prepare("select type_name,full_form from case_type_t where case_type = :regcasetype_no ");
								if($regno_casetype){
									$regno_casetype_execute = $regno_casetype->execute(array('regcasetype_no'=>$main_case_typeno));
									if($regno_casetype_execute){
										if($regno_casetype->rowcount()){
											$regno_casetype_result =  $regno_casetype->fetch();
											
											$reg_casetype_full_form = trim($regno_casetype_result['full_form']) ;
											$reg_casetype_short_form =  trim($regno_casetype_result['type_name']) ;
											
										
										} //
									}  //execute 
								} //qry error
							
							//getting fullform main case  type
						
							
								$main_case_no = trim($query_main_result['reg_no']) ? trim($query_main_result['reg_no']) : 0;
								$main_case_year =  trim($query_main_result['reg_year']) ? trim($query_main_result['reg_year']) : 0;
							
								$cino = trim($query_main_result['cino']) ? trim($query_main_result['cino']) : '';
							
							//getting case type name,no,year,cino
						
							// first petition address and details 
							
							$peti_address = '';
							$peti_disct_cd ='';
							$peti_disct_nm ='';
							if($cino){
								
								$main_peti_address_qry = $MDU_HCMAS_DB->prepare("select address,dist_code from party_address where cino = :cino AND party_no = '0' AND type = '1' union select address,dist_code from party_address_a where cino = :cino  AND party_no = '0' AND type = '1' ");
								
								if($main_peti_address_qry){
									
									$main_peti_addres_execute = $main_peti_address_qry->execute(array(':cino'=>$cino));
									if($main_peti_addres_execute){
										if($main_peti_address_qry->rowcount()){
											
											$main_peti_address_result = $main_peti_address_qry->fetch();
										
											$peti_address = trim($main_peti_address_result['address']);
											$peti_disct_cd = trim($main_peti_address_result['dist_code']);
											
											if($peti_disct_cd ){ 
												
												$peti_distr_qry = $MDU_HCMAS_DB->prepare("select dist_name from district_t where dist_code = :distrct_cd ");
												if($peti_distr_qry ){
													
													$peti_distr_execu = $peti_distr_qry->execute(array(':distrct_cd'=>$peti_disct_cd));
													if($peti_distr_execu){
														
														$peti_distr_reslt = $peti_distr_qry->fetch();
														
														$peti_disct_nm = trim($peti_distr_reslt['dist_name']);
														 
													} //qry execute
												} //qry
											} //adress empty
										} //rwo emtpy
									} //execute qry
								}//qry error
							} //cino empty								
								
						//first petition address and details
						
						//first respondent address and details
							
						$resp_address = '';
						$resp_disct_cd ='';
						$resp_disct_nm ='';
						
						if($cino){
							
							$main_resp_address_qry = $MDU_HCMAS_DB->prepare("select address,dist_code from party_address where cino =:cino AND party_no = '0' AND type = '2' union select address,dist_code from party_address_a where cino= :cino AND party_no = '0' AND type = '2'  ");
						
							if($main_resp_address_qry){
								$main_resp_address_execu = $main_resp_address_qry->execute(array(':cino'=>$cino));
								if($main_resp_address_execu){
									if($main_resp_address_qry->rowcount()){
										
										$main_resp_address_result  = $main_resp_address_qry->fetch();
										$resp_address = trim($main_resp_address_result['address']);
										$resp_disct_cd = trim($main_resp_address_result['dist_code']);
										
										if($resp_disct_cd){
											
											$resp_disct_qry = $MDU_HCMAS_DB->prepare('select dist_name  from district_t where dist_code = :distcode');
											if($resp_disct_qry){
												$resp_dict_execut = $resp_disct_qry->execute(array(':distcode'=>$resp_disct_cd));
												
												$resp_disct_result = $resp_disct_qry->fetch();
												
												$resp_disct_nm = trim($resp_disct_result['dist_name']);
												
											
												
												
											
											} //disctrict qry
										}//district code mepty
									} //rowcount
								}//qry execute
							} //qry error
						}//cino emtpy
						//first respondent address and details
?>						
		<h2 class="post-title" align="center" > Case Details </h2>		
		<table id="example" class="display responsive nowrap" cellspacing="0" width="100%" >	
			<tbody>
				<tr>
					<th> Filing No.  </th>
					<td>   
<?php
							echo check_tags($sr_casetype_short_form).'-'. check_tags($query_main_result['fil_no']).'/'.check_tags($query_main_result['fil_year']);	
							
?>
					</td>
					<th> Filing Date  </th>
					<td>    
<?php
							echo check_tags(implode('/',array_reverse(explode('-',$query_main_result['date_of_filing']))));
?>						
					</td>
				</tr>
				<tr>
					<th> Registration No.  </th>
					<td>   
<?php
						$trsnf_cs ='';
						if(trim($query_main_result['filcase_type']) =='19'){
							
							$addinl_qry = $MDU_HCMAS_DB->prepare("select * from additional_info where cino = :cino and search21 ='1'");
							
							if($addinl_qry){
								$addinl_qry->execute(array(':cino'=>$cino));
								
								if($addinl_qry->rowcount()){
									
									$trsnf_cs ='(TRANSFER CS)';
									
								
								} //row empty
							} //qry err
						}
							
						echo $cas_ty_pe =  check_tags($reg_casetype_short_form).$trsnf_cs.'-'. check_tags($query_main_result['reg_no']).'/'.check_tags($query_main_result['reg_year']);	
							
?>						
						
					</td>
					<th> Registration Date  </th>
					<td>    
<?php
							echo check_tags(implode('/',array_reverse(explode('-',$query_main_result['dt_regis']))));
							
?>						
					</td>
				</tr>
					
				<tr>
					<th> Stage  </th>
					<td colspan="3" >   
<?php 
							if($query_main_result['date_of_decision']=='' && $query_main_result['date_filing_disp']=='' ){
									echo "Pending ";
									    
							} else {
								
								$displey_nature = '';
								if(trim($query_main_result['disp_nature'])){
									$dispsl_natre = $MDU_HCMAS_DB->prepare("select disp_name from disp_type_t where disp_type = :disple_nature and disp_type!=0");
									
									//var_dump($dispsl_natre);
									if($dispsl_natre){
										
										$dispsl_natre->execute(array(':disple_nature'=>$query_main_result['disp_nature']));
										if($dispsl_natre->rowcount()){	
											
											$dispsl_natre_reslt = $dispsl_natre->fetch();
											$displey_nature = check_tags($dispsl_natre_reslt['disp_name']);
										}
									}
								}
								
								$date_decsin = '';
								if(trim($query_main_result['date_of_decision'])){
									$date_decsin = trim($query_main_result['date_of_decision']);
								} else {
									if(trim($query_main_result['date_filing_disp'])){
										$date_decsin = trim($query_main_result['date_filing_disp']);
									}	
								}
								 
								   
								echo "<span style='color:red;'> Disposed  </span> ";
								echo $displey_nature ? ' ( '.$displey_nature.' ) ': '';
								
								echo " on ";
								echo  implode('/',array_reverse(explode('-',check_tags($date_decsin)))) ;
								echo " by ";
									
									//else part
									$judg_nmes = '';
									$judg_codes = $query_main_result['judge_code'];
									//var_dump($judg_codes);
									//else part
									
									$dispsl_judg_nm ='';
									
									$disposl_proc =   $MDU_HCMAS_DB->prepare("SELECT judge_code FROM disposal_proc WHERE cino = :cino");
									//var_dump($disposl_proc);
									if($disposl_proc){
										$disposl_proc->execute(array(':cino'=>$cino));
										if($disposl_proc->rowcount()){
											
											$disposl_proc_reslt = $disposl_proc->fetch();
											$dispsl_judg_nm = check_tags($disposl_proc_reslt['judge_code']);
											
										} //row empty
									} //qry error
									//var_dump($dispsl_judg_nm);
									
									
									if($dispsl_judg_nm){
										$judge_displ = explode(',',$dispsl_judg_nm);
										foreach($judge_displ as $code_vallue){
											if($code_vallue){
												$judg_names_disposl = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code =:jj_code");
												//var_dump($judg_names_disposl);
												if($judg_names_disposl){
													$judg_names_disposl->execute(array(':jj_code'=>$code_vallue));
													
													if($judg_names_disposl->rowcount()){
														$judg_names_disposl_res = $judg_names_disposl->fetch();
														$judg_nmes .= check_tags($judg_names_disposl_res['judge_name']).', '.' ';
													
													}
												}
											} //value ending
										} //foreach
										
									} else if($judg_codes!=''){
												
										$judg_namees = explode(',',$judg_codes);
										foreach ($judg_namees as $value){
											if($value){
												$judg_names = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code =:judd_code");
												  
												if($judg_names){
													$judg_names->execute(array(':judd_code'=>$value));
													
													if($judg_names->rowcount()){ 
														$judg_names_reslt = $judg_names->fetch();
														$judg_nmes .= check_tags($judg_names_reslt['judge_name']).', '.' ';

													} //rowcount  
												} //query error
											} // emtpy											
										} //foreach ending 
									}  else {
										
										$court_codde = $MDU_HCMAS_DB->prepare("select * from  judge_t where court_no = :jud_courtcode ");
										//var_dump($court_codde);
										if($court_codde){
											$court_codde->execute(array(':jud_courtcode'=>$query_main_result['court_no']));
											
											if($court_codde->rowcount()){
												while($court_codde_res = $court_codde->fetch()){
													$judge_nmme_cod = trim($court_codde_res['judge_code']);
													if($judge_nmme_cod){
														$judge_nme_court = $MDU_HCMAS_DB->prepare("select * from judge_name_t where judge_code =  :judnmee_code");
														if($judge_nme_court){
															$judge_nme_court->execute(array(':judnmee_code'=>$judge_nmme_cod));
															
															if($judge_nme_court->rowcount()){
																$judge_nme_court_res = $judge_nme_court->fetch();
																$judg_nmes .= check_tags($judge_nme_court_res['judge_name']).', '.' ';
																
															
															} //row empty
														} //qry err
													} //judge emtpy
												} //while ending
											} //row emty
										} //qry err
									}										
									
									
									
									
									
									//disposed in sr stage judge name
									if(!trim($judg_nmes)){
										
										if($cino){
											 
											$sr_judge = $MDU_HCMAS_DB->prepare("select court_no from disposal_proc_filing  where cino =:cino");
											//var_dump($sr_judge);
											if($sr_judge){
												
												$sr_judge->execute(array(':cino'=>$cino));
												if($sr_judge->rowCount()){
													
													$sr_judge_resl =$sr_judge->fetch();
													$court_code = check_tags(trim($sr_judge_resl['court_no']));
													
													if($court_code){
														$juedg_cdee = $MDU_HCMAS_DB->prepare("select judge_code from judge_t	 where court_no = :coourt_code ");
														//var_dump($juedg_cdee);
														if($juedg_cdee){
															
															$juedg_cdee->execute(array(':coourt_code'=>$court_code));
															
															if($juedg_cdee->rowCount()){
																
																$juedg_cdee_resl = $juedg_cdee->fetch();
																$judg_cood = check_tags(trim($juedg_cdee_resl['judge_code']));
																
																if($judg_cood){
																	$juddg_name = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code = :juddgg_code");
																	//var_dump("select judge_name from judge_name_t where judge_code ='".$judg_cood."'");
																	if($juddg_name){
																		$juddg_name->execute(array(':juddgg_code'=>$judg_cood));
																		
																		if($juddg_name->rowCount()){
																			$juddg_name_ress = $juddg_name->fetch();
																			$judg_nmes = check_tags(trim($juddg_name_ress['judge_name']));
																			
																		} //row emtpy
																	}// qry err
																} //judge emtpy
															} //row emtpy
														} //qry err
													} //code empty
												} //row empty
											} //qry err
										} //cino emtpy
									} //judge name emtpy
									
									echo  rtrim(strtoupper($judg_nmes),', ');
							} //else ending
		

?>
						
					</td>
				</tr>
				<tr>
					<th> CNR   </th>
					<td colspan='3'>    
<?php
							echo check_tags($query_main_result['cino']);
							
?>						
					</td>
				</tr>
					
				<tr class="table_heading_style" > <th class="text-center" colspan="4"> Petitioner and Respondent Details </th> </tr>
					
				<tr>
					<th> Petitioner Details  </th>
					<td colspan="3" >     
<?php					
						$addinl_inf_search = '';
						if(trim($query_main_result['cino'])){
							if($reg_casetype_short_form==119){
								$addinl_inf = $MDU_HCMAS_DB->prepare("select * from additional_info where cino = :cino");
								if($addinl_inf){
									
									$addinl_inf->execute(array(''=>$cino));
									if($addinl_inf->rowCount()){
										$addinl_inf_result = $addinl_inf->fetch();
										$addinl_inf_search = $addinl_inf_result['search1'];
										echo check_tags($addinl_inf_search).'<br>';
											
									}
								}
							}
						}
						
						$party_inpers='';
						if(isset($query_main_result['pet_inperson'])){
							
							if(trim($query_main_result['pet_inperson'])=='Y'){
								$party_inpers = ' <b style="color:black;"> (P-IN-P)</b> ';
							}
						}
						$pet_det='';
						if(isset($query_main_result['hide_pet_name'])||isset($query_main_result['hide_partyname'])){
							
							if(trim($query_main_result['hide_pet_name'])=='Y' || trim($query_main_result['hide_partyname'])=='Y'){
								$pet_det = 'XXXXXXXXXX';
							}
							else
								$pet_det = check_tags(strtoupper(trim($query_main_result['pet_name']))).$party_inpers.'<br>'.$peti_address.' '.$peti_disct_nm.'<br>';  
						}
						else
							$pet_det = check_tags(strtoupper(trim($query_main_result['pet_name']))).$party_inpers.'<br>'.$peti_address.' '.$peti_disct_nm.'<br>'; 
						
						echo $pet_det; 
						
						
						//echo $peti_address.' '.$peti_disct_nm.'<br>'; 
						
						// additional petitioner and address
						if($cino && isset($query_main_result['hide_partyname']) && trim($query_main_result['hide_partyname'])!='Y'){
							
							$addl_petitioner = $MDU_HCMAS_DB->prepare("(select CAST(party_id as INTEGER ) as one,* from civ_address_t where cino = :cino and display='Y' and type='1' ) union ( select CAST(party_id as INTEGER ) as one,* from civ_address_t_a where cino = :cino and display='Y' and type='1' ) order by one");
							
							 
							//var_dump($addl_petitioner);
							
							if($addl_petitioner){
								$addl_petitioner->execute(array(':cino'=>$cino));
								
								if($addl_petitioner->rowcount()){
									
									while($addl_petitioner_result = $addl_petitioner->fetch()){
										
										$addl_petitioner_addrs =  $MDU_HCMAS_DB->prepare("select address,dist_code from party_address where cino= :cino AND party_no = :partey_no AND type = '1' union select address,dist_code from party_address_a where cino= :cino AND party_no = :partey_no AND type = '1'");
										//var_dump($addl_petitioner_addrs);
										
										$addl_peti_addres='';
										$addl_peti_distr ='';

										if($addl_petitioner_addrs){
											
											$add_partyno = check_tags($addl_petitioner_result['party_no']);
											$add_partyide = check_tags($addl_petitioner_result['party_id']);
											
											$addln_party_nme = $addl_petitioner_result['name'];
											$addl_petitioner_addrs->execute(array(':cino'=>$cino,':partey_no'=>$add_partyno));
											
											if($addl_petitioner_addrs->rowcount()){
												
												$addl_petitioner_addrs_result = $addl_petitioner_addrs->fetch();
												$addl_peti_addres = check_tags(trim($addl_petitioner_addrs_result['address']));
												$addl_peti_distr ='';
												$adl_peti_dst_cd  = check_tags(trim($addl_petitioner_addrs_result['dist_code']));
												if($adl_peti_dst_cd){
													
													$addl_petitioner_distr = $MDU_HCMAS_DB->prepare("select dist_name from district_t where dist_code = :addl_peti_discd");
													$addl_petitioner_distr->execute(array(':addl_peti_discd'=>$adl_peti_dst_cd));
													if($addl_petitioner_distr){
														if($addl_petitioner_distr->rowcount()){
															$addl_petitioner_distr_result = $addl_petitioner_distr->fetch();
															$addl_peti_distr = check_tags(trim($addl_petitioner_distr_result['dist_name']));

														} //row count distrcit
													}//dist query not working
												} //if dist code not availbaleb
											}//row count
										} //query not running

										$exparty_inpers='';
										if(isset($addl_petitioner_result['extra_inperson'])){
											
											if(trim($addl_petitioner_result['extra_inperson'])=='Y'){
												$exparty_inpers = ' <b style="color:black;"> (P-IN-P)</b> ';
											}
										}
										
									 
										if(trim($addl_petitioner_result['hide_partyname'])=='Y'){
										echo "<br> P-".check_tags(trim($add_partyide))." XXXXXXXXXX<br><br>"; 
									 }
									 else
									 {
										echo "<br> P-".check_tags(trim($add_partyide))." ".check_tags(trim(strtoupper($addln_party_nme))).$exparty_inpers.'<br>';
										echo  $addl_peti_addres." ".$addl_peti_distr.'<br>';
									 }
										
										
									 
									} //while ending
								}   //row count
							} // query not working 
						} //cino empty
					else echo "";	
							
?>
					</td>
				</tr>
				<tr>	 
					<th> Respondent Details  </th>
					<td colspan="3" >    
<?php							
						$party_inpers_resp='';
						if(isset($query_main_result['res_inperson'])){
							
							if(trim($query_main_result['res_inperson'])){
								$party_inpers_resp = '  <b style="color:black;" >(P-IN-P)</b>  ';
							}
						}
						$res_det='';
						if(isset($query_main_result['hide_res_name'])||isset($query_main_result['hide_partyname'])){
							
							if(trim($query_main_result['hide_res_name'])=='Y' || trim($query_main_result['hide_partyname'])=='Y'){
								$res_det = 'XXXXXXXXXX';
							}
							else
								$res_det = check_tags(strtoupper(trim($query_main_result['res_name']))).$party_inpers_resp.'<br>'; 
						}
						else
							$res_det =  check_tags(strtoupper(trim($query_main_result['res_name']))).$party_inpers_resp.'<br>'; 
						
						echo $res_det; 
						//echo check_tags(strtoupper(trim($query_main_result['res_name']))).$party_inpers_resp.'<br>'; 
						//echo check_tags(trim($resp_address)).' '.$resp_disct_nm.'<br><br>' ; 
						
						$addl_respon_dist ='';
						$addl_respo_addrs = '';
						
						if($cino && isset($query_main_result['hide_partyname']) && trim($query_main_result['hide_partyname'])!='Y'){	
						
							$addl_respondent = $MDU_HCMAS_DB->prepare("(select CAST(party_id as INTEGER ) as one,* from civ_address_t where cino= :cino and display='Y' and type='2' ) union ( select CAST(party_id as INTEGER ) as one,* from civ_address_t_a where cino=:cino and display='Y' and type='2') order by one");
							
							//var_dump($addl_respondent);			
							
							if($addl_respondent){
								
								$addl_respondent->execute(array(':cino'=>$cino));
								if($addl_respondent->rowcount()){

									while($addl_respondent_result = $addl_respondent->fetch()){
										
										
										$respd_partyno = check_tags(trim($addl_respondent_result['party_no']));
										$respd_partyidee = check_tags(trim($addl_respondent_result['party_id']));
										
								
										$addl_respon_addrs =  $MDU_HCMAS_DB->prepare("(select address,dist_code from party_address where cino= :cino AND party_no = :res_partyno AND type = '2' order by party_no) union (select address,dist_code from party_address_a where cino= :cino AND party_no = :res_partyno AND type = '2' order by party_no)");
										
										if($addl_respon_addrs){
											
											$addl_respon_addrs->execute(array(':res_partyno'=>$respd_partyno,':cino'=>$cino));
											
											if($addl_respon_addrs->rowcount()){
												
												$addl_respon_addrs_result = $addl_respon_addrs->fetch();
												
												$addl_respo_addrs = check_tags(trim($addl_respon_addrs_result['address']));
												$addl_respo_disccodee = (int)check_tags(trim($addl_respon_addrs_result['dist_code']));
												
												if($addl_respo_addrs){
													
													$addl_respon_distr = $MDU_HCMAS_DB->prepare("select dist_name from district_t where dist_code = :resp_discode");
													
													if($addl_respon_distr){
														$addl_respon_distr->execute(array(':resp_discode'=>$addl_respo_disccodee));
														if($addl_respon_distr->rowcount()){

															$addl_respon_distr_result = $addl_respon_distr->fetch();
															$addl_respon_dist = check_tags(trim($addl_respon_distr_result['dist_name']));

														} //dist count
													} // dist query
												} //distcode emtpy
											} // extra address count
										} //query extra address
										
										$exparty_inpers_resp='';
										if(isset($addl_respondent_result['extra_inperson'])){
											
											if(trim($addl_respondent_result['extra_inperson'])=='Y'){
												$exparty_inpers_resp = '  <b style="color:black;"  >(P-IN-P)</b>  ';
											}
										}
										
										if($addl_respondent_result['hide_partyname']=='Y')
										{
										echo " R-".$respd_partyidee." XXXXXXXXXX"."<br><br>";
										}
										else
										{
										echo " R-".$respd_partyidee." ".check_tags(strtoupper(trim($addl_respondent_result['name']))).$exparty_inpers_resp."<br>";	
										echo  $addl_respo_addrs." ".$addl_respon_dist."<br><br>";
										}
									} //while ending
								} //row count empty
							} //empty
						} //cino empty
							else
							echo "";
						
?>
					</td> 
				</tr>
				<tr>	 
					<th> Petitioner Counsel  </th>
					<td colspan="3" >    
<?php						
						if($query_main_result['pet_adv']){

              				echo check_tags(strtoupper(trim($query_main_result['pet_adv']))).'<br>'; 
              			}
						
						if($cino){
							
							$extr_main_pet_advcts  = $MDU_HCMAS_DB->prepare("select * from extra_adv_t where cino =:cino and type='1' and party_no='0' order by party_no,sr_no");
							 
							//var_dump("select * from extra_adv_t where cino ='".$query_main_result['cino']."' and type='1' and party_no='0'   order by sr_no");
							if($extr_main_pet_advcts){
								 
								$extr_main_pet_advcts->execute(array(':cino'=>$cino));
								
								if($extr_main_pet_advcts->rowCount()){
									
									while($extr_main_pet_advcts_reslt = $extr_main_pet_advcts->fetch()){
										
										echo  $extr_main_pet_advcts_reslt['adv_name'] ? check_tags(strtoupper(trim($extr_main_pet_advcts_reslt['adv_name']))).'<br>' : '';
										
									}
								}
							}
						
							$extr_peti_adv = $MDU_HCMAS_DB->prepare("( select adv_name,party_no,create_modify from civ_address_t where cino = :cino and type = '1' and display='Y' order by party_no ) union ( select adv_name,party_no,create_modify from civ_address_t_a where cino = :cino and type = '1' and display='Y' order by party_no ) ");
						
								 
							if($extr_peti_adv){
								
								$extr_peti_adv->execute(array(':cino'=>$cino));
								
								if($extr_peti_adv->rowcount()){
									
									while($extr_peti_adv_result = $extr_peti_adv->fetch()){
										
										$ext_advpartyno = check_tags(trim($extr_peti_adv_result['party_no']));
										
										echo  $extr_peti_adv_result['adv_name'] ? check_tags(strtoupper(trim($extr_peti_adv_result['adv_name']))).'<br>' : '';
										
										if(trim($extr_peti_adv_result['adv_name'])){
											
											$extr_peti_advcts = $MDU_HCMAS_DB->prepare("select * from extra_adv_t where cino = :cino and type ='1' and party_no =:ext_advpartyno order by party_no,sr_no");
											//var_dump($extr_peti_advcts);
											if($extr_peti_advcts)
											{
												
												$extr_peti_advcts->execute(array(':cino'=>$cino,':ext_advpartyno'=>$ext_advpartyno));
												if($extr_peti_advcts->rowCount()){
													
													while($extr_peti_advcts_reslt = $extr_peti_advcts->fetch()){
														
														echo  $extr_peti_advcts_reslt['adv_name'] ? check_tags(strtoupper(trim($extr_peti_advcts_reslt['adv_name']))).'<br>' : '';
														
													}//while empty
												} //row2 emtpy
											} //second qry err
										}
									} //while ending
								} //row count
							}//query nt workng
						}//cino 
?>						
					</td> 
				</tr>
				<tr>	 
					<th> Respondent Counsel  </th>
					<td colspan="3" >    
<?php					
						if($query_main_result['res_adv']){
         					echo check_tags(strtoupper(trim($query_main_result['res_adv']))).'<br>';
         				}
						
						if($cino){
							
							//main party extra advocate starting
							$extr_main_resp_advcts  = $MDU_HCMAS_DB->prepare("select * from extra_adv_t where cino = :cino and type='2' and party_no='0' order by party_no,sr_no");
							
							//var_dump($extr_main_resp_advcts);
							if($extr_main_resp_advcts){
								$extr_main_resp_advcts->execute(array(':cino'=>$cino));
								if($extr_main_resp_advcts->rowCount()){
									while($extr_main_resp_advcts_reslt = $extr_main_resp_advcts->fetch()){
										
										echo  $extr_main_resp_advcts_reslt['adv_name'] ? check_tags(strtoupper(trim($extr_main_resp_advcts_reslt['adv_name']))).'<br>' : '';
									}
								}
							}
							//main party extra advocate starting
							
							//extra party  advocate and extra advocate starting
							$extr_respo_adv = $MDU_HCMAS_DB->prepare("( select adv_name,party_no,create_modify from civ_address_t where cino = :cino and type = '2' and display ='Y' order by party_no ) union ( select adv_name,party_no,create_modify from civ_address_t_a where cino = :cino and type = '2' and display ='Y' order by party_no )");
							//var_dump($extr_respo_adv);
							if($extr_respo_adv){
								$extr_respo_adv->execute(array(':cino'=>$cino));
								if($extr_respo_adv->rowcount()){
									while($extr_respo_adv_result = $extr_respo_adv->fetch()){
										
										$resp_advpartyno = check_tags(trim($extr_respo_adv_result['party_no']));
										
										echo  $extr_respo_adv_result['adv_name'] ?  check_tags(strtoupper(trim($extr_respo_adv_result['adv_name']))).'<br>' : '';
										
										$extr_resp_advcts = $MDU_HCMAS_DB->prepare("select * from extra_adv_t where cino =:cino and type ='2' and party_no =:resp_advpartyno order by party_no,sr_no");
										//var_dump($extr_resp_advcts);
										if($extr_resp_advcts){
											$extr_resp_advcts->execute(array(':cino'=>$cino,':resp_advpartyno'=>$resp_advpartyno));
											if($extr_resp_advcts->rowCount()){
												while($extr_resp_advcts_reslt = $extr_resp_advcts->fetch()){
													
													echo  $extr_resp_advcts_reslt['adv_name'] ? check_tags(strtoupper(trim($extr_resp_advcts_reslt['adv_name']))).'<br>' : '';
													
												}
											}
										}	
										
										//echo  implode('/',array_reverse(explode('-',$query_main_result['date_of_filing']))) ;
									} //while ending
								}   //row count
							}//query nt workng
							//extra party  advocate and extra advocate starting
							
							
							
						} //cino  emtpy
						
						
						
?>						
					</td> 
				</tr>
				<tr> 
					<th> Subject </th>
					<td colspan="3" >    
<?php						
						$subj_result1 = '';
						$subj_result2 = '';
						$subj_result3 = '';
						$subj_result4 = '';

						if($query_main_result['c_subject']){
							$subject = $MDU_HCMAS_DB->prepare("select subject_name,subject_code from subject_master where subject_code =:subjct_cd");
								//var_dump($subject);
							$csubjectcd = check_tags(trim($query_main_result['c_subject']));
							if($subject){
								
								$subject->execute(array(':subjct_cd'=>$csubjectcd));
								if($subject->rowcount()){
										$subject_result = $subject->fetch();
										$subj_result1 = check_tags(trim($subject_result['subject_name']));

									//sub 2
									if(isset($query_main_result['cs_subject']) && !empty($query_main_result['cs_subject'])){
										
										$cs_subjcett = check_tags(trim($query_main_result['cs_subject']));
										
										$subject_1 = $MDU_HCMAS_DB->prepare("SELECT subnature1_desc FROM subnature1_t where nature_cd =:subjct_cd and subnature1_cd= :cssub_ject1 ");
										//var_dump($subject_1);
										if($subject_1){
											$subject_1->execute(array(':cssub_ject1'=>$cs_subjcett,'subjct_cd'=>$csubjectcd ));
											if($subject_1->rowcount()){
												$subject_1_result =  $subject_1->fetch();
												$subj_result2 = check_tags($subject_1_result['subnature1_desc']);

											} //count
										} // query 
									} //isset check

									//sub 3 
									if(isset($query_main_result['css_subject']) && !empty($query_main_result['css_subject'])){
										
										$css_sub_ject = trim($query_main_result['css_subject']);
										
										$subject_2 = $MDU_HCMAS_DB->prepare("SELECT subnature2_desc FROM subnature2_t where nature_cd = :subjct_cd and subnature1_cd= :cssub_ject1 and subnature2_cd= :cssub_ject2 ");
										//var_dump($subject_2);
										if($subject_2){
											
											$subject_2->execute(array(':subjct_cd'=>$csubjectcd,':cssub_ject1'=>$cs_subjcett,':cssub_ject2'=>$css_sub_ject));
											
											if($subject_2->rowcount()){
												
												$subject_2_result =  $subject_2->fetch();
												$subj_result3 = check_tags(trim($subject_2_result['subnature2_desc']));
												
												
												
												
											} 
										}//query not working
									}
									//sub3
									
									//sub 4
									if(isset($query_main_result['csss_subject']) && !empty($query_main_result['css_subject'])){
										
										$subject_3 = $MDU_HCMAS_DB->prepare("SELECT subnature3_desc FROM subnature3_t where nature_cd = :subjct_cd and subnature1_cd= :cssub_ject1 and subnature2_cd= :cssub_ject2 and subnature3_cd = :cssub_ject3  ");
										//var_dump($subject_3);
										if($subject_3){
											$csss_subjctcde =  trim($query_main_result['csss_subject']);
											$subject_3->execute(array(':subjct_cd'=>$csubjectcd,':cssub_ject1'=>$cs_subjcett,':cssub_ject2'=>$css_sub_ject,':cssub_ject3'=>$csss_subjctcde));
											if($subject_3->rowcount()){
												$subject_3_result =  $subject_3->fetch();
												$subj_result4 = $subject_3_result['subnature3_desc'];
												
											}  //row empty
										}//query not working
									}//emtpy
									
									//sub 4
									
									
									
									
								} //rowcount
							} //subject query
						}// isset of suject
						
						
?>
							<?php echo trim($subj_result1) ? trim($subj_result1)."" : ""; ?> 
							<?php  echo trim($subj_result2) ? " - ".$subj_result2."" : ""; ?>   
							<?php echo trim($subj_result3) ? " - ".trim($subj_result3)."" : ''; ?>
							<?php echo trim($subj_result4) ? " - ".trim($subj_result4)."" : ''; ?>
					</td>
				</tr>
				<tr> 
					<th> District </th> 
					<td>  
<?php						
							$case_district ='';
							if($cino){
								
								$case_dist = $MDU_HCMAS_DB->prepare("select case_dist_code from case_info  where cino = :cino union select case_dist_code from case_info_a  where cino = :cino ");
								if($case_dist){
									$case_dist->execute(array(':cino'=>$cino));
									if($case_dist->rowcount()){
										$case_dist_result = $case_dist->fetch();
										
										if(trim($case_dist_result['case_dist_code'])){
											
											$casedist_code = check_tags(trim($case_dist_result['case_dist_code']));
											
											$disct_case = $MDU_HCMAS_DB->prepare("select dist_name from  district_t where dist_code = :case_distcode ");
											if($disct_case){
												
												$disct_case->execute(array(':case_distcode'=>$casedist_code));
												if($disct_case->rowcount()){
													
													$disct_case_result = $disct_case->fetch();
													echo $case_district = trim($disct_case_result['dist_name']);

												} //row2 err
											} //qry2 err
										} //discode empty
									} //row
								} //qry 
							}//cino emty
						
?>						
					</td>
					<th> Nature of Writ </th> 
					<td>  
<?php						
						$nature_name = '';
						$regcse_type =0;
						
						if(trim($query_main_result['dt_regis'])>'2018-09-25'){
							
							$cse_ntrcode =(int) check_tags(trim($query_main_result['nature_cd']));
							
							$regcse_type = $query_main_result['regcase_type'] ? trim($query_main_result['regcase_type']) : 0 ;
							
							$nature_writ = $MDU_HCMAS_DB->prepare("select nature_desc from nature_t where nature_cd = :case_naturecd and case_type_cd = :register_casetyp ");
								//var_dump($nature_writ);
							if($nature_writ){
								$nature_writ->execute(array('case_naturecd'=>$cse_ntrcode,'register_casetyp'=>$regcse_type));
								if($nature_writ->rowcount()){
									$nature_writ_result = $nature_writ->fetch();
									$nature_name = check_tags($nature_writ_result['nature_desc']);
									echo trim($nature_name);
								}
							}

						}
?>						
					</td>
				</tr>
				<tr>
					<th> Case Ready Status </th> 
					<td colspan="3" >  
<?php
							if(trim($query_main_result['cino'])){
								
								$notce_result = array();
								
								$ntce_cont = '';
								$cse_notc_count = '';
								$notice_status =  $MDU_CIS_DB->prepare("select served_date from tn_notice_servestatus where cino = :cino ");
								//$notice_status =  $MDU_CIS_DB->query("select served_date from tn_notice_servestatus where cino ='HCMA013663802018' ");
								//var_dump($notice_status);
								
								if($notice_status){
									
									$notice_status->execute(array(':cino'=>$cino));
									$ntce_cont = $notice_status->rowCount();
									 
									if($notice_status->rowCount()){
										
										while($notice_status_result = $notice_status->fetch()){
											if(trim($notice_status_result['served_date'])){
												
												$notce_result[] = $notice_status_result['served_date'];
												
											}
										}
										
										$cse_notc_count = count($notce_result);
										
									} else {
										$ntce_cont ='1';
									}
									
									if($ntce_cont == $cse_notc_count){
										echo "Case Ready";
								
									} else {
										echo "Not Ready";
									}
								} //qry err
							} //cino 
					

?>						
					</td>
				</tr>
				<tr>	 
					<th> Coram </th>
					<td colspan="3" > 
<?php
						if(trim($query_main_result['judge_code'])){
							$judge_name_case ='';
							
							$jcode = explode(',',$query_main_result['judge_code']);
							foreach($jcode as $value){
								if($value){
									
									$corm_judcode = $value ;
									$qry_judg_nm = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code = :corm_judcode");
									$qry_judg_nm->execute(array(':corm_judcode'=>$corm_judcode));
									$query_judg_nm = $qry_judg_nm->fetch();
									
									$judge_name_case .= check_tags(strtoupper($query_judg_nm['judge_name'])).', ';
								}
							}
							echo rtrim($judge_name_case,', ');
						}

?>
					</td> 
				</tr>
				<tr> 
					<th> Causelist </th> 
					<td>
<?php
						//Causelist
						$causelist_res ='';
						$causelist_res_lt ='';
						if($cino){
								
							$resCauselist = $MDU_HCMAS_DB->prepare("(select causelist_type,causelist_date from cause_list where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date < DATE(NOW())+1 union select causelist_type,causelist_date from cause_list_a where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date < DATE(NOW())+1  order by causelist_date  desc limit 1)");
							//var_dump($resCauselist);
							if($resCauselist){
								$resCauselist->execute(array(':cino'=>$cino));
								
								if($resCauselist->rowCount()){
									
									$rowCauselist_lte = $resCauselist->fetch();
									$causelist_res_lt = trim($rowCauselist_lte['causelist_type']);
									if($causelist_res_lt){
										
										$resCauselis = $MDU_HCMAS_DB->prepare("SELECT cause_list_type FROM cause_list_period where cause_list_type_id = :causelist_reslt ");
										
										 
										if($resCauselis){
											$resCauselis->execute(array(':causelist_reslt'=>$causelist_res_lt));
											if($resCauselis->rowcount()){
												$resCauselis_t = $resCauselis->fetch();
												//var_dump($resCauselis_t);
												$causelist_res = check_tags(trim($resCauselis_t['cause_list_type']));
											} //rowemty
										} //qry2 err
									} //causelits emtpy								
								} //row empty 
							}//qry err
							echo $causelist_res;
						} //cino empty
						


?>
					</td>
					<th> Bench Type	 </th> 
					<td>
<?php
						$c_bench = "";
						if(trim($query_main_result['bench_type'])) {
							
							$main_csebench = trim($query_main_result['bench_type']);
							$res_benchtype = $MDU_HCMAS_DB->prepare("SELECT * FROM bench_type where bench_type_code= :maincase_bench");
							$res_benchtype->execute(array(':maincase_bench'=>$main_csebench));
							
							$benchtype = $res_benchtype->fetch();
							$c_bench = check_tags(trim($benchtype['bench_type_name'])); 
							echo $c_bench;
							
						} else if(trim($query_main_result['judge_code'])) {
							
							$totl_judg = trim($query_main_result['judge_code']);
							$jud_no = explode(",",$totl_judg);
							
							$no_judgs = count($jud_no);
							 
							if($no_judgs == '1'){
								echo "Single Bench";
							} else if($no_judgs == '2'){
								echo "Division Bench";
							} else if($no_judgs ==  '3'){
								echo "Full Bench";
							} else if($no_judgs == '7' ){
								echo "Larger Bench";
							}
							
						}


?>						
					</td>
				</tr>
				<tr> 
					<th> Last Listed on </th> 
					<td>  
<?php
						$item_noo_date ='';
						 
			 
						if($cino){
							
							$item_noo = $MDU_HCMAS_DB->prepare("(select causelist_date  from cause_list where cino = :cino and  causelist_date < DATE(NOW())+1 and causelist_sr_no != 0 and elimination !='Y' union select causelist_date  from cause_list_a where cino = :cino and  causelist_date < DATE(NOW())+1 and causelist_sr_no != 0 and elimination !='Y' order by causelist_date desc limit 1 )");	
							//var_dump($item_noo);
							if($item_noo){
								$item_noo->execute(array(':cino'=>$cino));
								
								if($item_noo->rowCount()){
									
									$item_noo_reslt = $item_noo->fetch();
									$item_noo_date = check_tags(trim($item_noo_reslt['causelist_date']));
								 
								}
							}
						}
			 
						echo implode('/',array_reverse(explode('-',$item_noo_date))) ;


?>						
					</td>
					<th> Item No.	 </th> 
					<td>
<?php
						$sr_no_itm ='';
						$clink_itm ='';
						if($cino){
							
							 
							$item_no = $MDU_HCMAS_DB->prepare("(select sr_no,clink_code,causelist_date  from cause_list where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date < DATE(NOW())+1    union select sr_no,clink_code,causelist_date  from cause_list_a where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date < DATE(NOW())+1   order by causelist_date desc limit 1)");
							//var_dump($item_no);
							if($item_no){
								$item_no->execute(array(':cino'=>$cino));
								if($item_no->rowCount()){
									$item_no_reslt = $item_no->fetch();
									$sr_no_itm = trim($item_no_reslt['sr_no']);
									$clink_itm = trim($item_no_reslt['clink_code']);
									if($sr_no_itm){
										echo check_tags(trim($sr_no_itm));
									} else {
										
										$item_no = $MDU_HCMAS_DB->prepare("(select sr_no,clink_code,causelist_date from cause_list where case_no = :item_caseno and elimination !='Y'   union select sr_no,clink_code,causelist_date from cause_list_a where case_no = :item_caseno and elimination !='Y' order by causelist_date desc limit 1 )");
										//var_dump($item_no);
										if($item_no){
											$item_no->execute(array(':item_caseno'=>$clink_itm));
											if($item_no->rowCount()){
												$item_no_reslt = $item_no->fetch();
												$sr_no_itm = trim($item_no_reslt['sr_no']);
												echo check_tags(trim($sr_no_itm));
											} //row count
										} //qry not wokring
									} //else ending
								} //row empty  
							} //qry not working
						} //cino empty

?>						
					</td>
				</tr>
				<tr> 
					<th> Last return date </th> 
					<td>
<?php
							$return_case_dt = $MDU_HCMAS_DB->prepare("select objprepare_dt,srno from objection_history where cino = :cino union  select objprepare_dt ,srno from objection_history_a where cino = :cino order by srno desc limit 1");
							//var_dump($return_case_dt);
							if($return_case_dt){
								$return_case_dt->execute(array(':cino'=>$cino));
								if($return_case_dt->rowcount()){
									$return_case_dt_res = $return_case_dt->fetch();
									
									$retrn_cse_dt =  check_tags(trim($return_case_dt_res['objprepare_dt']));
									echo implode('/',array_reverse(explode('-',$retrn_cse_dt)));
								} //row empty
							} //qry err

?>						
					</td>
					<th> Last Represent date </th> 
					<td>
<?php
						$last_presnt_dt ='';
						$last_represnt_dt = $MDU_CIS_DB->prepare("select obj_represent_dt from tn_objection_history_records where cino = :cino order by obj_srno desc limit 1");
						//var_dump($last_represnt_dt);
						if($last_represnt_dt){
							$last_represnt_dt->execute(array(':cino'=>$cino));
							if($last_represnt_dt->rowcount()){
								$last_represnt_dt_res  = $last_represnt_dt->fetch();
								$last_presnt_dt = check_tags(trim($last_represnt_dt_res['obj_represent_dt']));
								
							
							
							}
						} //qry err
						
						echo implode('/',array_reverse(explode('-',$last_presnt_dt)));

?>						
					</td>
				</tr>
			</tbody>
		</table><br>
						
<?php 
			//var_dump($query_main_result);
			if($cino){
				
				$countrs = $MDU_CIS_DB->prepare("select * from tn_documentregister where cino = :cino  and docu_type='21'");
				
				
				//var_dump($countrs);
				if($countrs){
					$countrs->execute(array(':cino'=>$cino));
					if($countrs->rowcount()){
?>
							<h2 class="post-title" align="center">   Counters   </h2>
							<table id="example1" class="display responsive nowrap" cellspacing="0" width="100%">
								<thead>
								</thead>
								<tbody>
									
								</tr>	
								<tr class="hidden-sm" >
									<th class='' > Sl. No. </th>
									<th class=''  > Counter Filed on </th>
									<th class=''  > Filed by </th>
									<th class='' > Updated on </th>
								</tr>
<?php
						   $si=1;
							while($countrs_result = $countrs->fetch()){
							echo "<tr>";
							echo "<th class='hidden-lg hidden-md'>Sl. No.</th><td class=''>".$si."</td>";
							echo "<th class='hidden-lg hidden-md'>Counter Filed on</th><td class=''>".implode('/',array_reverse(explode('-',check_tags($countrs_result['date_of_filing']))))."</td>";
							echo "<th class='hidden-lg hidden-md'>Filed by</th><td class=''>".strtoupper(check_tags($countrs_result['adv_name']))."</td>";
							echo "<th class='hidden-lg hidden-md'>Updated on</th><td class=''>".implode('/',array_reverse(explode('-',check_tags($countrs_result['updated_date']))))."</td>";
							echo "</tr>";
							$si++;
							} //while counter
?>
							</tbody>
							</table><br>
				 
<?php     	
					} //count counter
				}//query conter
			}	//cino empty
?>				
								
			<h4 class="post-title"  align="center"> <b> Lower Court Details </b> </h4>
			<table id="example2" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead class="hidden-sm" >
					
						<th> Sl No.  </th>
						<th> Lower case Number	  </th>
						<th>  Lower Court Name and District	 </th>
						<th>  Order Date </th>
				</thead>
				<tbody>
<?php
			if($cino){	
			
				$tlcourt = $MDU_HCMAS_DB->prepare("select lower_court_code,lower_court,lower_court_dec_dt,lower_trial  from trial_lower_court where cino =:cino order by lower_trial");
				//var_dump($tlcourt);
				//$tlcourt = $MDU_HCMAS_DB->query("select lower_court_code,lower_court from trial_lower_court where cino ='HCMA010495962016' order by lower_trial");
				
				if($tlcourt){
					
					$tlcourt->execute(array(':cino'=>$cino)); 
					
					if($tlcourt->rowCount()){
						$slo =1;
						$date_of_order = "";
						while($tlcourt_result = $tlcourt->fetch()){
							
							$date_of_order = implode('/',array_reverse(explode('-',check_tags($tlcourt_result['lower_court_dec_dt']))));
							
							echo "<tr>";
							echo "<th class='hidden-lg hidden-md'>Sl No.</th><td>".$slo."</td>";
							
							$lcourt_casetypename ='';
							echo "<th class='hidden-lg hidden-md'>Lower case Number</th><td>";
							
								if(trim($tlcourt_result['lower_court'])){
									
									$lcourt_no = check_tags(trim($tlcourt_result['lower_court']));
									//echo $lcourt_no;
									$lcourt_year = substr($lcourt_no, -4);									
									$lcourt_caseno = substr($lcourt_no, -11,-4);
									$lcourt_casetype = substr($lcourt_no, 1,-11);
									 
									if((int)$tlcourt_result['lower_trial']==3){
																				
										//var_dump((int)$tlcourt_result['lower_trial']);
										$qry_app_high_court = $MDU_HCMAS_DB->prepare("SELECT * FROM civil_t where case_no= :lco_urtno UNION SELECT * FROM civil_t_a where case_no= :lco_urtno ");
										$qry_app_high_court->execute(array('lco_urtno'=>$lcourt_no));
										
										$exc_app_high_court =  $qry_app_high_court->fetch();
										
										$date_of_order  = implode('/',array_reverse(explode('-',check_tags($exc_app_high_court['date_of_decision']))));
										
										$qryLowCaseType = $MDU_HCMAS_DB->prepare("SELECT type_name FROM case_type_t where case_type=:lcourt_casetype");
										//var_dump($qryLowCaseType);
										if($qryLowCaseType){
											
											$qryLowCaseType->execute(array('lcourt_casetype'=>$lcourt_casetype));
											if($qryLowCaseType->rowCount()){
												
												$excLowCaseType_reslt =  $qryLowCaseType->fetch();
												$lcourt_casetypename = check_tags($excLowCaseType_reslt['type_name']);
											
											}
										}
									} else {
										
										$qryLowCaseType = $MDU_HCMAS_DB->prepare("SELECT type_name FROM lcase_type_t where lcase_type=:lcourt_casetype ");
										//var_dump($qryLowCaseType);
										if($qryLowCaseType){
											$qryLowCaseType->execute(array(':lcourt_casetype'=>$lcourt_casetype));
											if($qryLowCaseType->rowCount()){
												
												$excLowCaseType_reslt =  $qryLowCaseType->fetch();
												$lcourt_casetypename = check_tags($excLowCaseType_reslt['type_name']);
												
												
											} //ro wmepty
										}//qry err
										
									} //else 
								} //lowercourt no
								
								echo $lcourt_casetypename.".".(int)$lcourt_caseno." /".$lcourt_year;
							echo "</td>";
							//echo "<td>".$tlcourt_result['lower_court_name'].", ".$tlcourt_result['dist_name']."</td>";							
							echo "<th class='hidden-lg hidden-md'>Lower Court Name and District</th><td>";
							
								if((int)$tlcourt_result['lower_trial']==3){
									
									echo "High Court Of Madras";
								} else {
									if(trim($tlcourt_result['lower_court_code'])){
										
										$lowwr_code = check_tags(trim($tlcourt_result['lower_court_code']));
										$lwcort_naame = '';
										$lwcort_distrct ='';
										$lwcourt_distict ='';
										$lwcount_nme = $MDU_HCMAS_DB->prepare("select lower_court_name,dist_code from lcourt_t where lower_court_code = :lowwr_code ");
										//var_dump($lwcount_nme);
										
										$lwcount_nme->execute(array(':lowwr_code'=>$lowwr_code));
										
										if($lwcount_nme){
											if($lwcount_nme->rowCount()){
												$lwcount_nme_reslt = $lwcount_nme->fetch();
												
												$lwcort_naame = check_tags(trim($lwcount_nme_reslt['lower_court_name']));
												$lwcort_distrct = check_tags(trim($lwcount_nme_reslt['dist_code']));
												
												if(trim($lwcort_distrct)){
													$lwcort_dist = $MDU_HCMAS_DB->prepare("select dist_name from district_t where dist_code = :lwcort_distrct");
													$lwcort_dist->execute(array(':lwcort_distrct'=>$lwcort_distrct));
													
													if($lwcort_dist){
														if($lwcort_dist->rowCount()){
															
															$lwcort_dist_reslt = $lwcort_dist->fetch();
															$lwcourt_distict = $lwcort_dist_reslt['dist_name'];
															 
														}
													} //qry error
												}//emtpy
												
												echo $lwcort_naame.",".$lwcourt_distict;
												
											}//row emtpy
										}//qry err
									} //lower code
								
								} //else
								
								
								
							echo "</td>";
							echo "<th class='hidden-lg hidden-md'>Order Date</th><td>".$date_of_order."</td>";
							echo "</tr>";
							$slo++;
						
						} //while ending
					} else {
						 echo "<tr><td colspan='4' align='center' > No records </td></tr>";
					}
				}
			}
				

?>					 
				</tbody>
			</table><br>
						
						
			<h4 class="post-title" align ="center"> Applications Details </h4>
			<table id="example3" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead class="hidden-sm" >
					<th> Case No.  </th>
					<th> Prayer Details		  </th>
					<th>  Date of filing		 </th>
					<th>  Advocate </th>
				</thead>
				<tbody>
<?php
			
	$row1 = '';
	$row2 = '';
	$row3 = '';
	
	if(trim($query_main_result['main_case_no'])!='' || trim($query_main_result['main_matter_cino'])!=''){
		
		$case_maincino = check_tags(trim($query_main_result['main_matter_cino']));
		$case_maincasenumbr = check_tags(trim($query_main_result['main_case_no']));
		
		
		if($case_maincasenumbr!=''){
			
			$main_cass =  $MDU_HCMAS_DB->prepare("(select * from civil_t where case_no = :maincase_numb ) union  (select * from civil_t_a where case_no = :maincase_numb ) order by fil_no,fil_year");
			$main_cass->execute(array(':maincase_numb'=>$case_maincasenumbr));
			
		} else if($case_maincino!=''){
			
			$main_cass =  $MDU_HCMAS_DB->prepare("(select * from civil_t where cino = :main_matr_cino) union  (select * from civil_t_a where cino = :main_matr_cino ) order by fil_no,fil_year");
			$main_cass->execute(array(':main_matr_cino'=>$case_maincino));
		}
		
		if($main_cass){
			if($main_cass->rowcount()){
				$main_cas_type='';
				while($main_cass_result = $main_cass->fetch()){
					echo "<tr class='heding_td' >";
					$main_cas_type = $main_cass_result['filcase_type'];
					if($main_cas_type){
						$main_css_nme = '';
						$main_css_name = $MDU_HCMAS_DB->prepare("select type_name,full_form from case_type_t WHERE case_type = :fullfrm_maincse ");
						$main_css_name->execute(array(':fullfrm_maincse'=>check_tags($main_cas_type)));
						if($main_css_name){
							if($main_css_name->rowCount()){
								$main_css_name_reslt = $main_css_name->fetch();
								$main_css_nme = $main_css_name_reslt['type_name'];
								$main_css_ful_nm = $main_css_name_reslt['full_form'];
														
							} //row emtys
						} //qury not working
					} //filecastype emtpy
						
					if($main_cass_result['reg_no']){
	 
	
	echo '<th class="hidden-lg hidden-md">Case No.</th><td class="result_td">  '.$main_css_nme.'.'.$main_cass_result['reg_no'].'/'.$main_cass_result['reg_year'].'&nbsp;&nbsp;(Main case)</td>';
	
					} else {
						
	echo '<th class="hidden-lg hidden-md">Case No.</th><td class="result_td"> '.$main_css_nme.'.'.$main_cass_result['fil_no'].'/'.$main_cass_result['fil_year'].'  <br> (Main case in Filing Stage)</td>';
	
	//echo "				<td class='result_td'>".$main_css_nme.".".$main_cass_result['fil_no']."/".$main_cass_result['fil_year']."&nbsp;&nbsp;(Filing Stage)"."</td>";
					}
						
				//prayer details	
				$main_case_pryer = '';
				$pryer_minncase = check_tags($main_cass_result['cino']);
				$main_cse_prayer = $MDU_HCMAS_DB->prepare("select prayer_cd,prayer_type from case_info as a join prayer_t as b on a.prayer_cd = b.prayercode where cino =:pryer_minncase union select prayer_cd,prayer_type from case_info_a as a join prayer_t as b on a.prayer_cd = b.prayercode where cino = :pryer_minncase");
				//var_dump($main_cse_prayer);
				if($main_cse_prayer){
					$main_cse_prayer->execute(array(':pryer_minncase'=>$pryer_minncase));
					if($main_cse_prayer->rowcount()){
						$main_cse_prayer_result = $main_cse_prayer->fetch();
						$main_case_pryer = check_tags($main_cse_prayer_result['prayer_type']);
						echo "<th class='hidden-lg hidden-md'>Prayer Details</th><td class='result_td'>".$main_case_pryer."</td>";
					} else {
						echo "<th class='hidden-lg hidden-md'>Prayer Details</th><td></td>";
					}
				}
					//prayer ending
					
					echo "<th class='hidden-lg hidden-md'>Date of filing</th><td class='result_td' >".implode('/',array_reverse(explode('-',check_tags($main_cass_result['date_of_filing']))))."  </td>";
					echo "<th class='hidden-lg hidden-md'>Advocate</th><td class='result_td' >".strtoupper(check_tags($main_cass_result['pet_adv']))."</td>";				
				
	
					echo "</tr>";	
				} //while ending
			}  else {
				$row1 = 1;
			}//row emty
		} //qry not wroking
		 
	} else {
		$row1 = 1;
	}
	
	//wmp cases only, starts
	$wmp_cass ='';
	
	if(trim($query_main_result['main_case_no'])==''){
		 
		if(trim($query_main_result['case_no'])){
			 
			$wmp_cass = $MDU_HCMAS_DB->prepare("(select * from civil_t where main_case_no = :mnn_caseno and cino!= :cino ) union  (select * from civil_t_a where main_case_no = :mnn_caseno and cino!=:cino ) order by fil_no,fil_year");
			
			$wmp_cass->execute(array(':cino'=>$cino,':mnn_caseno'=>$query_main_result['case_no']));
			
		} else if(trim($query_main_result['main_matter_cino'])){
			 
			$wmp_cass = $MDU_HCMAS_DB->prepare("(select * from civil_t where main_matter_cino = :mnm_cino and cino!= :cino ) union  (select * from civil_t_a where main_matter_cino = :mnm_cino and cino!= :cino) order by fil_no,fil_year");
			
			$wmp_cass->execute(array(':cino'=>$cino,':mnm_cino'=>$query_main_result['main_matter_cino']));
			
		} else if(trim($query_main_result['cino'])){
			 
			$wmp_cass = $MDU_HCMAS_DB->prepare("(select * from civil_t where main_matter_cino = :cino and cino!= :cino ) union  (select * from civil_t_a where main_matter_cino = :cino and cino!=:cino) order by fil_no,fil_year");
			
			$wmp_cass->execute(array(':cino'=>$cino,':cino'=>$cino));
		}
	
	} elseif(trim($query_main_result['main_case_no'])!='') {
		
		$wmp_cass = $MDU_HCMAS_DB->prepare("(select * from civil_t where main_case_no = :mmncaseno and cino!= :cino ) union  (select * from civil_t_a where main_case_no = :mmncaseno and cino!=:cino) order by fil_no,fil_year");
		
		$wmp_cass->execute(array(':cino'=>$cino,':mmncaseno'=>$query_main_result['main_case_no']));
	}//wmp cases only, ends
	//var_dump($wmp_cass);
	
	$wmp_cases_type ='';
		if($wmp_cass){
			if($wmp_cass->rowcount()){
				while($wmp_cases_result = $wmp_cass->fetch()){
	echo "			<tr class='heding_td' >";
					$wmp_cases_type = $wmp_cases_result['filcase_type'];
					if($wmp_cases_type){
						$wmp_cses_name = $MDU_HCMAS_DB->prepare("select type_name,full_form from case_type_t WHERE case_type = :wmp_csety_pe");
						$wmp_cses_name->execute(array(':wmp_csety_pe'=>$wmp_cases_type));
						if($wmp_cses_name){
							if($wmp_cses_name->rowCount()){
								$wmp_cses_name_reslt = $wmp_cses_name->fetch();
								$wmp_cses_typ_name = check_tags($wmp_cses_name_reslt['type_name']);
								$wmp_css_full_nm = check_tags($wmp_cses_name_reslt['full_form']);
														
							} //row emtys
						} //qury not working
					} //filecastype emtpy
				
					
					if($wmp_cases_result['reg_no']){
	//echo "				<td class='result_td'> <button onclick = 'case_status_new(".$wmp_cases_type.",".$wmp_cases_result['reg_no'].",".$wmp_cases_result['reg_year'].'"'.$wmp_css_full_nm.'"'.")'> ".$wmp_cses_typ_name.".".$wmp_cases_result['reg_no']."/".$wmp_cases_result['reg_year']." </button> </td>";
	echo '<th class="hidden-lg hidden-md">Case No.</th><td class="result_td" > '.$wmp_cses_typ_name.'.'.$wmp_cases_result['reg_no'].'/'.$wmp_cases_result['reg_year'].' </td>';
	
	
					} else {
	echo '<th class="hidden-lg hidden-md">Case No.</th><td class="result_td" > '.$wmp_cses_typ_name.'.'.$wmp_cases_result['fil_no'].'/'.$wmp_cases_result['fil_year'].'  &nbsp;&nbsp;(Filing Stage) </td>';					
						
	//echo "				<td class='result_td'>".$wmp_cses_typ_name.".".$wmp_cases_result['fil_no']."/".$wmp_cases_result['fil_year']."&nbsp;&nbsp;(Filing Stage)"."</td>";
					}
					
					//prayer details	
					$wmp_case_pryer = '';
					$wmp_cse_prayer = $MDU_HCMAS_DB->prepare("select prayer_cd,prayer_type from case_info as a join prayer_t as b on a.prayer_cd = b.prayercode where cino = :wmpcses_cino union select prayer_cd,prayer_type from case_info_a as a join prayer_t as b on a.prayer_cd = b.prayercode where cino = :wmpcses_cino");
					//var_dump($main_cse_prayer);
					$wmp_cse_prayer->execute(array(':wmpcses_cino'=>$wmp_cases_result['cino']));
					if($wmp_cse_prayer){
						if($wmp_cse_prayer->rowcount()){
							$wmp_cse_prayer_result = $wmp_cse_prayer->fetch();
							$wmp_case_pryer = check_tags($wmp_cse_prayer_result['prayer_type']);
	echo "				<th class='hidden-lg hidden-md'>Prayer Details</th><td class='result_td'>".$wmp_case_pryer."</td>";
						} else {
	echo "				<th class='hidden-lg hidden-md'>Prayer Details</th><td></td>";
						}
					}
					//prayer ending	
					
	echo "				<th class='hidden-lg hidden-md'>Date of filing</th><td class='result_td' >".implode('/',array_reverse(explode('-',check_tags($wmp_cases_result['date_of_filing']))))."  </td>";
	echo "				<th class='hidden-lg hidden-md'>Advocate</th><td class='result_td' >".strtoupper(check_tags($wmp_cases_result['pet_adv']))."</td>";										
				
	echo "			</tr>";			
				} //while ending
			} else {
				$row2 = 1;
			}				//row emtpy 
		} //query not wkrng
	
	
	
	//ia filing starting
			if(trim($query_main_result['cino'])){
				//$ia_filng = $MDU_HCMAS_DB->query("(select * from ia_filing where cino = '".trim($query_main_result['cino'])."' order by date_of_ia_registration,ia_regno) union (select * from ia_filing_a where cino = '".trim($query_main_result['cino'])."' order by date_of_ia_registration,ia_regno) ");
				
				$all_rows_ia = '';
				$ia_filng = $MDU_HCMAS_DB->prepare("(select * from ia_filing where cino = :cino ) union (select * from ia_filing_a where cino = :cino) order by date_of_ia_registration,ia_regno ");
				//var_dump($ia_filng);
				
				if($ia_filng){
					
					$ia_filng->execute(array(':cino'=>$cino));
					if($ia_filng->rowCount()){
						$all_rows_ia = '';
						echo "<tr style='background-color:#eaeaea;font-weight: bold;'><td class='  result_td'>IA no</td>  <td class='  result_td'> Prayer  </td>  <td class='  result_td'> Date of Filing </td>  <td class='result_td'> Party </td>   </tr>";
						while($ia_filng_reslt = $ia_filng->fetch()){
							echo "<tr>";
								$ia_no = $ia_filng_reslt['ia_no'];
								$ia_year = substr($ia_no,-4);
								$ia_no = substr($ia_no,-6,-4);
								
									echo "<td class=' col-md-2'>".check_tags($ia_no)."-".check_tags($ia_year)."</td>";
									echo "<td class='col-md-4'>".trim(check_tags($ia_filng_reslt['relief_offense']))."</td>";
									echo "<td class='col-md-2'>".implode('/',array_reverse(explode('-',check_tags($ia_filng_reslt['date_of_ia_filing']))))."</td>";
									echo "<td class='col-md-4'>".check_tags($ia_filng_reslt['appotherparty'])."<h4> <span style='color:red;'> vs </span> </h4>".check_tags($ia_filng_reslt['againotherparty'])."</td>";
							echo "</tr>";
						}
					} else {
						$row3  = 1;
					}
				} 
			}
			
			 
			//ia filing ending
		if($row1 and $row2 and $row3 ==1){
			echo "<tr><td colspan='4' align='center' > No records </td></tr>";
		}
 
?>					 
				</tbody>
			</table> <br>
			
			
<?php
	if(trim($query_main_result['link_cino'])){
?>			
			<h4 class="post-title" align="center">  Connected Matters </h4>
			<table id="example4" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead class="hidden-sm" >
					<th colspan="2" > Case No. </th>
					<th colspan="2" > Stage  </th>
				</thead>
				<tbody>
<?php
			$conncted_cases = $MDU_HCMAS_DB->prepare("select * from connected_t a join civil_t b on a.cino = b.cino where a.linkcino = :cino and a.cino!= :cino and (b.main_matter_cino ='' or b.main_matter_cino is null or main_case_no ='' or main_case_no  is null )  union select * from connected_t a join civil_t_a b on a.cino = b.cino where a.linkcino = :cino and a.cino!= :cino and  (b.main_matter_cino ='' or b.main_matter_cino is null ) and ( main_case_no ='' or main_case_no is null ) order by reg_year,reg_no ");
			//var_dump($conncted_cases);
					
			$connt_case_nme ='';
			$connt_case_reg = '';
			$connt_case_year = '';
					
			if($conncted_cases){
				$conncted_cases->execute(array(':cino'=>$cino));
				
				if($conncted_cases->rowCount()){
					//var_dump($conncted_cases_result1);
							
					while($conncted_cases_result =$conncted_cases->fetch()){
						echo "<tr>";
						if(trim($conncted_cases_result['regcase_type']) and trim($conncted_cases_result['reg_no']) and trim($conncted_cases_result['reg_year']))
						{
											
							$conct_caase_tpe = '';
							
							$conectd_cse_type = $MDU_HCMAS_DB->prepare("select type_name from case_type_t WHERE case_type =:connctedcse_tyyp");
							if($conectd_cse_type){
								$conectd_cse_type->execute(array(':connctedcse_tyyp'=>$conncted_cases_result['regcase_type']));
								if($conectd_cse_type->rowCount()){
									$conectd_cse_type_result = $conectd_cse_type->fetch();
									$conct_caase_tpe = check_tags($conectd_cse_type_result['type_name']); 
													
								}
							}
											
							echo "<th class='hidden-lg hidden-md'>Case No.</th><td class='result_td' colspan='2'>  ".$conct_caase_tpe.".".check_tags($conncted_cases_result['reg_no'])."/".check_tags($conncted_cases_result['reg_year'])."</td>";
							
							
											
							/*
									wmp of connected  matters
								
								
							$connctd_wmp = $MDU_HCMAS_DB->query("select * from civil_t where main_case_no ='".$conncted_cases_result['case_no']."' union select * from civil_t_a where main_case_no ='".$conncted_cases_result['case_no']."' ");
							//var_dump($connctd_wmp);
							if($connctd_wmp){
								if($connctd_wmp->rowCount()){
									while($connctd_wmp_result = $connctd_wmp->fetch()){
										echo "<tr>";
										if($connctd_wmp_result['regcase_type']){
											$conectd_wmp_type = $MDU_HCMAS_DB->query("select type_name from case_type_t WHERE case_type ='".$connctd_wmp_result['regcase_type']."'");
											$conectd_wmp_type_result = $conectd_wmp_type->fetch();
											$connt_case_nme = $conectd_wmp_type_result['type_name'];
											$connt_case_reg = $connctd_wmp_result['reg_no'];
											$connt_case_year = $connctd_wmp_result['reg_year'];

										}
										echo "<td colspan='4'> <button class='wmp_buttons btn-default'>".$connt_case_nme.".".$connt_case_reg."/".$connt_case_year."</button></td>";
										echo "</tr>";

									}  //while ending
								}	// row count
							}// query failed 
							
							*/
											
											
											
									
						} else {
										
							if(trim($conncted_cases_result['filcase_type']) and trim($conncted_cases_result['fil_no']) and trim($conncted_cases_result['fil_year']))
							{
											
								$fil_cse_ype = '';
								 
								$fil_cse_tp = $MDU_HCMAS_DB->prepare("select type_name from case_type_t WHERE case_type =:connctad_filcastyp");
								if($fil_cse_tp){
									
									$fil_cse_tp->execute(array(':connctad_filcastyp'=>check_tags($conncted_cases_result['filcase_type'])));
									if($fil_cse_tp->rowcount()){
										$fil_cse_tp_result = $fil_cse_tp->fetch();
											$fil_cse_ype = check_tags($fil_cse_tp_result['type_name']);
													
											}  
										}
										echo "<th class='hidden-lg hidden-md'>Case No.</th><td class='result_td' colspan='2' >".strtoupper($fil_cse_ype)."-".$conncted_cases_result['fil_no']."/".$conncted_cases_result['fil_year']."&nbsp;&nbsp;(Filing Stage)"."</td>";
							}
						} //else
							
						echo "<th class='hidden-lg hidden-md'>Stage</th><td colspan='2' class='result_td'>";
								
								
								
								if($conncted_cases_result['date_of_decision'] == '' and $conncted_cases_result['date_filing_disp']=='' ){
								
									echo "Pending";
								} else {
									echo "Disposed";
								}
								
								
							
							echo "</td>";
						
						echo "</tr>";
					}//while   
				} else {
					echo '<td align="center" colspan="3"> No records </td>';
					
				}					//row empty
			} //query failed 
					
					

?>					 
				</tbody>
			</table><br>
<?php

	}			


		if(trim($query_main_result['juri_value'])==''){ 
		
?>
	
			<table id="example5" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead>
				</thead>
				<tbody>
					<tr class="case_status_heding" style="background-color:#eaeaea; font-weight: bold;">
            		<th class="text-center"> Relief Details </th>
            		<td class="text-center " >
            			<?php 
            			if($query_main_result['regcase_type'] == '19'){
            				echo "Civil Suit";
            			} else {
            				echo " Relief Amount";
            			}
            			?> 
            		</td>
        			</tr>
        			<tr>
            		<td class="text-center result_td"> 
            			<?php 
            				echo $releif_res ='';
            				/*$releif = $MDU_HCMAS_DB->query("select relief_offense  from case_info where cino ='".$query_main_result['cino']."' union select relief_offense  from case_info_a where cino ='".$query_main_result['cino']."'");
            				if($releif){
            					if($releif->rowcount()){
            						$releif_result = $releif->fetch();
            						$releif_res = $releif_result['relief_offense'];
            						echo $releif_res;
            					} 
            				}	*/

            			?>
            		</td>
            		<td class="text-center result_td"> 

            			<?php 
            				$jruy_value = trim($query_main_result['juri_value']);
								echo $jruy_value ? check_tags($jruy_value) : ''; 
            			?>
            			
            		</td>
        			</tr>

        		</tbody>
        	</table>
<?php 
	
	} //juri emtpy

?>	
	
	<h4 class="post-title" align="center"> <b> Prayer </b> </h4>
			<table id="example6" class="display responsive nowrap" cellspacing="0" width="100%">
				 
				<tbody>
				<tr>
				    <th class="hidden-lg hidden-md">Prayer</th>
					<td>
<?php
				$prayer_res ='';
							
				if(trim($query_main_result['branch_id'])=='4'){
					$prayer_res = check_tags($query_main_result['subject1']);
					echo $prayer_res;
				} else {
					if(trim($query_main_result['cino'])){
						$prayer = $MDU_HCMAS_DB->prepare("select relief_offense  from case_info where cino = :cino union select relief_offense  from case_info_a where cino = :cino");
						if($prayer){
							$prayer->execute(array(':cino'=>$cino));
							if($prayer->rowcount()){
								$prayer_result = $prayer->fetch();
								$prayer_res = check_tags($prayer_result['relief_offense']);
								echo trim($prayer_res);
							} 
						}
					}
				}

?>				
					</td>
				</tr>
				</tbody>
			</table><br>
			
			<h4 class="post-title" align="center"> <b> History of Case Hearing </b> </h4>
			<table id="example7" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead class="hidden-sm" >
				<tr>
					<th> Judge </th>
					<th> Item no.  </th>
					<th> Business On Date	  </th>
					<th> Business	  </th>
					<th> Hearing Date </th>
					<th> Purpose of hearing </th>
					<th> Adjournment </th>
					</tr>
				</thead> 
				<tbody>
				 
					 
<?php
	
	$judge_name1='';
	$totel_htr_count = 1;
    if(trim($query_main_result['cino'])){
		
		$srrecds = ''; 
		$regnoo = trim($query_main_result['reg_no']);
		if(!$regnoo){
			
			$filing_hist = $MDU_HCMAS_DB->query("select * from daily_proc_filing where cino='".$query_main_result['cino']."' order by todays_date NULLS FIRST");
			
			///var_dump($filing_hist);
			
			if($filing_hist){
				
				if($filing_hist->rowcount()){
					$srrecds = 1;
					
					echo "<tr> <td class='text-center' colspan ='7'> <b>SR Stage History of Hearing</b> </td></tr>";
					
					while($filing_hist_res = $filing_hist->fetch()){
						
						/*judge name for sr */
						$judge_namesr1 ='';
						//Judge Name
						$jcode1 = explode(',',$filing_hist_res['judge_code']);
						//var_dump($jcode1);
						
						foreach($jcode1 as $value) {
							if($value){
								$qry_judg_nm1 = $MDU_HCMAS_DB->query("select judge_name from judge_name_t where judge_code ='".$value."'");
								//var_dump("select judge_name from judge_name_t where judge_code ='".$value."'");
								$query_judg_nm1 = $qry_judg_nm1->fetch();
								$judge_namesr1 .= $query_judg_nm1['judge_name'].', '.' ';
							}	 //value emtpy
						} //foreach end
						
						/*judge name for sr */
						
						
						echo '<tr>';
							echo '<td>'.$judge_namesr1.'</td>';
							
							/* sr no       */
							$sr_no_itm ='';
							$clink_itm ='';
							if(trim($query_main_result['cino'])){
								
								$cinnno = $query_main_result['cino'];
								$item_no = $MDU_HCMAS_DB->prepare("(select sr_no,clink_code from cause_list where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date = :hofh_todaysdate union select sr_no,clink_code from cause_list_a where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date = :hofh_todaysdate )");
								//var_dump($item_no);
								if($item_no){
									$item_no->execute(array(':cino'=>$cinnno,':hofh_todaysdate'=>$filing_hist_res['todays_date']));
									if($item_no->rowCount()){
										$item_no_reslt = $item_no->fetch();
										$sr_no_itm = trim($item_no_reslt['sr_no']);
										$clink_itm = trim($item_no_reslt['clink_code']);
										//var_dump($sr_no_itm);
										
										if($sr_no_itm){
											 
										} else {
											
											$item_no = $MDU_HCMAS_DB->prepare("select sr_no,clink_code from cause_list where case_no = :clink_itm and causelist_date = :hofh_todaysdate and elimination !='Y'  union select sr_no,clink_code from cause_list_a where case_no = '".$clink_itm."' and causelist_date = :hofh_todaysdate and elimination !='Y'   ");
											//var_dump($item_no);
											if($item_no){
												$item_no->execute(array(':clink_itm'=>$clink_itm,':hofh_todaysdate'=>$filing_hist_res['todays_date']));
												if($item_no->rowCount()){
													$item_no_reslt = $item_no->fetch();
													$sr_no_itm = trim($item_no_reslt['sr_no']);
													
												} //row count
											} //qry not wokring
										} //else ending
									} //row empty  
								} //qry not working
							} //cino empty
							/* sr no       */
							echo '<td>'.$sr_no_itm.'</td>';
							echo "	<td>".implode('/',array_reverse(explode('-',$filing_hist_res['todays_date'])))."</td>";
							echo "<td>".$filing_hist_res['order_remark']."</td>" ;
							if($filing_hist_res['next_date']!="5000-01-01"){
								echo "<td>".implode('/',array_reverse(explode('-',$filing_hist_res['next_date'])))."</td>";
							} else {
								echo "<td></td>";
							}
							
							//Purpose of the case
							$purpose_sr ='';
							$purpse_code = trim($filing_hist_res['purpose_code']);
							if($purpse_code){
								$purpse_nme = $MDU_HCMAS_DB->query("select purpose_name from purpose_t where purpose_code ='".$filing_hist_res['purpose_code']."' ");  
								//var_dump($purpse_nme);
								if($purpse_nme){
									if($purpse_nme->rowCount()){
										$purpse_nme_reslt = $purpse_nme->fetch();
										$purpose_sr = $purpse_nme_reslt['purpose_name'];
										
									}
								}
							} else {
								$purpose_sr = "-";
							}
							//purpose of the case empty
							
							
							echo "<td>".$purpose_sr."</td>  ";
							 
						 
							echo "<td> </td> ";
						
						
						
						
						echo '</tr>';
					} //while
				}   
			} //qry err
		}//regno emtpy
		
		
		
		$query_histry_herng = $MDU_HCMAS_DB->prepare("(select a.judge_code,a.todays_date,a.next_date ,a.purpose_code,case_remark,order_remark,adjcode from daily_proc as a   where cino = :cino ) union  ( select a.judge_code,a.todays_date,a.next_date ,a.purpose_code,case_remark,order_remark,adjcode from daily_proc_a as a   where cino =:cino ) order by todays_date NULLS FIRST" );
		
		//var_dump($query_histry_herng);
		
		//var_dump($query_histry_herng);
		if($query_histry_herng){
			$query_histry_herng->execute(array(':cino'=>$cino));
			$histry_count = $query_histry_herng->rowcount();
			 
			if($query_histry_herng->rowcount()){
				
				$judge_name1='';
				$totel_htr_count = 1;
				while ($result_histry_herng = $query_histry_herng->fetch()){
					
					//Judge Name
					$jcode1 = explode(',',$result_histry_herng['judge_code']);
					//var_dump($jcode1);
					
					foreach($jcode1 as $value) {
						if($value){
							$qry_judg_nm1 = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code = :hofh_jcode");
							//var_dump("select judge_name from judge_name_t where judge_code ='".$value."'");
							$qry_judg_nm1->execute(array(':hofh_jcode'=>$value));
							$query_judg_nm1 = $qry_judg_nm1->fetch();
							$judge_name1 .= check_tags($query_judg_nm1['judge_name']).', '.' ';
						}	 //value emtpy
					} //foreach end
					 

					//Purpose of the case
					$purpose ='';
					$purpse_code = check_tags($result_histry_herng['purpose_code']);
					if($purpse_code){
						$purpse_nme = $MDU_HCMAS_DB->prepare("select purpose_name from purpose_t where purpose_code = :hofh_purcod ");  
						//var_dump($purpse_nme);
						if($purpse_nme){
							
							$purpse_nme->execute(array(':hofh_purcod'=>$purpse_code));
							if($purpse_nme->rowCount()){
								$purpse_nme_reslt = $purpse_nme->fetch();
								$purpose = check_tags($purpse_nme_reslt['purpose_name']);
								
							}
						}
					} else {
						$purpose = "-";
					}
					//purpose of the case empty
				
				
					echo "<tr>
						<th class='hidden-lg hidden-md'>Judge</th><td>".rtrim(strtoupper($judge_name1),', ')."</td>";
						
							$sr_no_itm ='';
							$clink_itm ='';
							if(trim($query_main_result['cino'])){
								 
								$item_no = $MDU_HCMAS_DB->prepare("(select sr_no,clink_code from cause_list where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date = :hofh_todaysdate union select sr_no,clink_code from cause_list_a where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date = :hofh_todaysdate )");
								//var_dump($item_no);
								if($item_no){
									$item_no->execute(array(':cino'=>$cino,':hofh_todaysdate'=>$result_histry_herng['todays_date']));
									if($item_no->rowCount()){
										$item_no_reslt = $item_no->fetch();
										$sr_no_itm = check_tags($item_no_reslt['sr_no']);
										$clink_itm = check_tags($item_no_reslt['clink_code']);
										//var_dump($sr_no_itm);
										
										if($sr_no_itm){
											 
										} else {
											
											$item_no = $MDU_HCMAS_DB->prepare("select sr_no,clink_code from cause_list where case_no = :hofh_clink and causelist_date = :hofh_toddaydate and elimination !='Y'  union select sr_no,clink_code from cause_list_a where case_no = :hofh_clink and causelist_date = :hofh_toddaydate and elimination !='Y'   ");
											//var_dump($item_no);
											if($item_no){
												$item_no->execute(array(':hofh_toddaydate'=>$result_histry_herng['todays_date'],':hofh_clink'=>$clink_itm));
												if($item_no->rowCount()){
													$item_no_reslt = $item_no->fetch();
													$sr_no_itm = check_tags($item_no_reslt['sr_no']);
													
												} //row count
											} //qry not wokring
										} //else ending
									} //row empty  
								} //qry not working
							} //cino empty
						
						echo "<th class='hidden-lg hidden-md'>Item no.</th><td>".$sr_no_itm."</td>";
					
					
						echo "<th class='hidden-lg hidden-md'>Business On Date</th><td>".implode('/',array_reverse(explode('-',check_tags($result_histry_herng['todays_date']))))."</td>";
					
					
						echo "<th class='hidden-lg hidden-md'>Business</th><td>".check_tags($result_histry_herng['order_remark'])."</td>";
					
						if($result_histry_herng['next_date']!="5000-01-01"){
							echo "<th class='hidden-lg hidden-md'>Hearing Date</th><td>".implode('/',array_reverse(explode('-',check_tags($result_histry_herng['next_date']))))."</td>";
						} else {
							echo "<th class='hidden-lg hidden-md'>Hearing Date</th><td></td>";
						}
					
						$disp_name ='';		
						echo "<th class='hidden-lg hidden-md'>Purpose of hearing</th><td>".$purpose."</td>  ";
					 
						$adjcode = '';
						if(trim($result_histry_herng['adjcode'])){
						 
							$adj_cdd = $MDU_HCMAS_DB->prepare("select adjname from adjcode_t where adjcode = :hofh_ajcode");
							if($adj_cdd){
								$adj_cdd->execute(array(':hofh_ajcode'=>$result_histry_herng['adjcode']));
								if($adj_cdd->rowCount()){
								
									$adj_cdd_res = $adj_cdd->fetch();
									$adjcode = $adj_cdd_res['adjname'];
								} //rowcount
							} //qry err
						}//emtpy  
					 
						echo "<th class='hidden-lg hidden-md'>Adjournment</th><td>".$adjcode."</td> ";	
					 
					echo "</tr>";
					$totel_htr_count++;
					$judge_name1='';  
				  
				}// while ending
				

				//$revoke_qry = $MDU_HCMAS_DB->query("");
					
				if($query_main_result['date_of_decision'] ==''){

				}  else {

					echo "<tr>";
						$last_row =  $MDU_HCMAS_DB->prepare("select * from disposal_proc where cino = :cino");
						//var_dump($last_row);
						if($last_row){
							$last_row->execute(array(':cino'=>$cino));
							if($last_row->rowCount()){
								$last_row_result = $last_row->fetch();

								$jcode2 = explode(',',$last_row_result['judge_code']);
								$judge_name2 ='';
								foreach($jcode2 as $value1) {
									$qry_judg_nm2 = $MDU_HCMAS_DB->prepare("select judge_name from judge_name_t where judge_code = :hofh_disp_jcode");
									$qry_judg_nm2->execute(array(':hofh_disp_jcode'=>$value1));
									//var_dump("select judge_name from judge_name_t where judge_code ='".$value1."'");
									$query_judg_nm2 = $qry_judg_nm2->fetch();
									$judge_name2 .= check_tags($query_judg_nm2['judge_name']).', '.' ';
								}

								//var_dump($disp_name);
								echo "<td class='hidden-lg hidden-md'>Judge</td><td>".rtrim(strtoupper($judge_name2),', ')."</td>";
								$sr_no_itm ='';
								$clink_itm ='';
								$item_noo_date ='';
								if($cino){
									 
									$item_no = $MDU_HCMAS_DB->prepare("select sr_no,clink_code from cause_list where cino = :cino and causelist_type !='1009' and causelist_sr_no != 0 and elimination !='Y' and causelist_date < DATE(NOW())+1 order by causelist_date desc limit 1");
									//var_dump($item_no);
									if($item_no){
										$item_no->execute(array(':cino'=>$cino));
										if($item_no->rowCount()){
											$item_no_reslt = $item_no->fetch();
											$sr_no_itm = check_tags($item_no_reslt['sr_no']);
											$clink_itm = check_tags($item_no_reslt['clink_code']);
											if($sr_no_itm){
												$item_noo_date = $sr_no_itm;
											} else {
												$item_no = $MDU_HCMAS_DB->prepare("select sr_no,clink_code from cause_list where case_no = :dips_hofh_lkitem  order by causelist_date desc limit 1 ");
												if($item_no){
													$item_no->execute(array(':dips_hofh_lkitem'=>$clink_itm));
													if($item_no->rowCount()){
														$item_no_reslt = $item_no->fetch();
														$sr_no_itm = trim($item_no_reslt['sr_no']);
														$item_noo_date = $sr_no_itm;
													} //row count
												} //qry not wokring
											} //else ending
										} //row empty  
									} //qry not working
								} //cino empty
								 
								
								echo "<td class='hidden-lg hidden-md'>Item no.</td><td>".check_tags($item_noo_date)."</td>";
								echo "<td class='hidden-lg hidden-md'>Business On Date</td><td>".implode('/',array_reverse(explode('-',check_tags($last_row_result['todays_date']))))."</td> ";
								
								
								echo "<td class='hidden-lg hidden-md'>Business</td><td>".check_tags($last_row_result['order_remark'])."</td>";
								
								
								
								echo "<td></td>";
								
								if(trim($query_main_result['disp_nature'])){
									
									$disp_natre = $MDU_HCMAS_DB->prepare("select disp_name from disp_type_t where disp_type = :hofh_dispnt and disp_type!=0");
									if($disp_natre){
										$disp_natre->execute(array(':hofh_dispnt'=>check_tags($query_main_result['disp_nature'])));
										if($disp_natre->rowcount()){

											$disp_natre_result = $disp_natre->fetch();
									 
											$disp_name = check_tags($disp_natre_result['disp_name']);
									
										} //count emtpy 
									} //disp emty
										echo "<td class='hidden-lg hidden-md'>Business</td><td>".$disp_name."</td>";
								} else {
									echo "<td class='hidden-lg hidden-md'>Purpose of hearing</td><td>".$purpose."</td> ";
								} 
								
								echo "<td></td>";
							} //err emtpy
						} //qry err
					echo "</tr>";
				} //else emtpy
			} else {
				if($srrecds){
				
				} else {
					echo "<tr> <td class='text-center' colspan ='7'> no records </td><tr>";
				}
			} //row count
		} //query not working
	} //cino emtpy
		
				

?>				
					 
				</tbody>
			</table><br>
			
<?php		

	if($cino){	

		$documnt_reg = $MDU_CIS_DB->prepare("select * from tn_documentregister where cino= :cino");
		//var_dump($documnt_reg);
		if($documnt_reg){
			$documnt_reg->execute(array(':cino'=>$cino));
			if($documnt_reg->rowCount()){
?>					
				<h4 class="post-title" align="center">    List of Documents   </h4>
				<table id="example8" class="display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					   <tr class="hidden-sm">						
							<th> Sl.No. </th>
							<th> Document No. </th>
							<th> Document Name </th>
							<th> Advocate Name </th>
							<th> Filing Date </th>
							 
						</tr>	
					</thead>
					<tbody >
						
						
<?php
			$sl = 1;
			while($documnt_reg_result = $documnt_reg->fetch()){
				echo "<tr>";
					echo "<th class='hidden-lg hidden-md'>Sl.No.</th><td>".$sl."</td>";
					echo "<th class='hidden-lg hidden-md'>Document No.</th><td>";
					echo check_tags($documnt_reg_result['docu_no'])."/".check_tags($documnt_reg_result['fil_year']) ;
					if(trim($documnt_reg_result['oldfiling_no'])){
						echo "<br/> (Old Filing No.) : ".check_tags($documnt_reg_result['oldfiling_no']);
					}
					
					echo "</td>";
					echo "<th class='hidden-lg hidden-md'>Document Name</th><td>";
					if($documnt_reg_result['docu_type']==0){
						echo check_tags($documnt_reg_result['document_name']);
					} else {
						
						$doc_typ_nm = $MDU_HCMAS_DB->prepare("select docu_name from docu_type_t where docu_type= :doct_typ_ee ");
						if($doc_typ_nm){
							$doc_typ_nm->execute(array(':doct_typ_ee'=>check_tags($documnt_reg_result['docu_type'])));
							
							if($doc_typ_nm->rowCount()){
								$doc_typ_nm_result = $doc_typ_nm->fetch();
								echo check_tags($doc_typ_nm_result['docu_name']);
							}
						}
					}
					echo "</td>";
					echo "<th class='hidden-lg hidden-md'>Advocate Name</th><td>".strtoupper($documnt_reg_result['adv_name'])."</td>";
					echo "<th class='hidden-lg hidden-md'>Filing Date</th><td>".implode('/',array_reverse(explode('-',check_tags($documnt_reg_result['date_of_filing']))))."</td>";
					
							 
				echo "</tr>";
				$sl++;
			} //while ending
?>						
					</tbody>
				</table><br>
<?php
			}//row empty
		}//doc
	}//cino empty	
?>	
	
		<h4 class="post-title" align="center">   <b> Caveat Details  </b> </h4>
		<table id="example9" class="display responsive nowrap" cellspacing="0" width="100%">
			<thead  >
				<tr class="hidden-sm">
					<th> Sl.No. </th>
					<th> Filing No </th>
					<th> Caveat No </th>
					<th> Petitioner </th>
					<th> Respondent </th>
					<th> Petitioner Counsel  </th>
					<th> Filing Date  </th>
				</tr>	
			</thead>
			<tbody>
				 
				
		<?php
		if($query_main_result['caveat']){
		if(trim($query_main_result['caveat'])){				
			
			$caveat_no_all = explode(",",trim($query_main_result['caveat']));
			//var_dump($query_main_result['caveat']);
			//var_dump($caveat_no_all);
			if($caveat_no_all){
			
				foreach($caveat_no_all as $value){
					
					if(trim($value)){
						 
						$caveat_qry = $MDU_HCMAS_DB->query("SELECT * FROM caveat_t where caveat_no = '".trim($value)."' union SELECT * FROM caveat_t_a where caveat_no ='".trim($value)."'");
						 
						//$caveat_qry = $MDU_HCMAS_DB->query("SELECT * FROM caveat_t where cino = 'HCMA01C000022018' union SELECT * FROM caveat_t_a where cino = 'HCMA01C000022018'");
						//var_dump($caveat_qry);
						
						if($caveat_qry){
							if($caveat_qry->rowCount()){
								
								$serlno = 1;
								while($caveat_qry_result = $caveat_qry->fetch()){
									echo "<tr>";
									echo "<th class='hidden-lg hidden-md'>Sl.No.</th><td>".$serlno."</td>";
									echo "<th class='hidden-lg hidden-md'>Filing No</th><td>".$caveat_qry_result['slno']."/".$caveat_qry_result['slyear']."</td>";
									 
									echo "<th class='hidden-lg hidden-md'>Caveat No</th><td>".$caveat_qry_result['caveat_no']."</td>";
									echo "<th class='hidden-lg hidden-md'>Petitioner</th><td>".$caveat_qry_result['petname']."</td>";
									echo "<th class='hidden-lg hidden-md'>Respondent</th><td>".$caveat_qry_result['resname']."</td>";
									echo "<th class='hidden-lg hidden-md'>Petitioner Counsel</th><td>".strtoupper($caveat_qry_result['pet_adv'])."</td>";
									echo "<th class='hidden-lg hidden-md'>Filing Date</th><td>".$caveat_qry_result['dt_filing']."</td>";
								 
									echo "</tr>";
									$serlno++;
									
								}
							} else {
								echo "<tr><td colspan='7' align='center'>No records</td></tr>";
							}
						}
					}
				}
			} else {
				echo "<tr ><td colspan='7' align='center'>No records</td></tr>";
			}
		} else {
			echo "<tr ><td colspan='7' align='center'>No records</td></tr>";
							}} else {
			echo "<tr ><td colspan='7' align='center'>No records</td></tr>";
		}
		?>					
			</tbody>
		</table><br>
						
<?php

			
	
		$noticess_qry = '';
		 
		if($case_name  and $case_no and $case_year){
			
			$noticess_qry = $MDU_CIS_DB->prepare("SELECT * FROM tn_notice_servestatus where regcase_type = :casenam_e and reg_no = :case_no_o and reg_year = :case_ye_ar  and casenotype = 'R' and despatch_entry_date IS NOT NULL  and display='Y'  order by party_no,type,process_id");
			
			
		} 
		
		//var_dump($noticess_qry);
		if($noticess_qry){
			$noticess_qry->execute(array(':casenam_e'=>$case_name,':case_no_o'=>$case_no,':case_ye_ar'=>$case_year));
			if($noticess_qry->rowCount()){
?>
			<h4  class="post-title" align="center">   <b> Notices  </b> </h4>
			<table id="example10" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead  >
					<tr class="hidden-sm">
						<th> Sl.No. </th>
						<th> Party </th>
						<th> Dispatch Date(Notice) </th>
						<th> Seat </th>
						<th> Mode of Dispatch </th>
						<th> Dispatch Date(CS)  </th>
						<th> Status  </th>
						<th> Served Date/(Return Date & Reason)  </th>
					</tr>	
				</thead>
				<tbody>
					 
					
<?php
				$sl =1;
				while($notices_result = $noticess_qry->fetch()){
					echo "<tr>";
					echo "<th class='hidden-lg hidden-md'>Sl.No.</th>	<td>".$sl."</td>";
					echo "<th class='hidden-lg hidden-md'>Party</th>	<td>";
					$part_yrank = '';
					$part_yno ='';
					if(check_tags($notices_result['type']) && check_tags($notices_result['party_no']) && check_tags($notices_result['party_no'])){
						
						if(check_tags($notices_result['type']) ==1){
							echo check_tags($notices_result['name']).'<br>';
							echo " <b>( P-";
							echo check_tags(($notices_result['party_no']));
							echo ") </b>";
							
						} else if(check_tags($notices_result['type']) ==2){
							echo check_tags($notices_result['name']).'<br>';
							echo " <b>( R ";
							echo check_tags($notices_result['party_no']) ? ' -'.check_tags($notices_result['party_no'])  : '';
							echo " ) </b>";
						}
						
					}  else {
						echo check_tags($notices_result['name']) ;
						 
					
					}
					echo "	</td>";
					
					echo "<th class='hidden-lg hidden-md'>Dispatch Date(Notice)</th>	<td>";
							$dispt_dt_entry = check_tags($notices_result['despatch_entry_date']);
					echo $dispt_dt_entry ? implode('/',array_reverse(explode('-',$dispt_dt_entry))) : '';
					echo "	</td>";
					echo "<th class='hidden-lg hidden-md'>Seat</th>	<td>";
						$notce_sectn = '';
						 if(trim($notices_result['despatch_section'])){
							 
							 $sectn_qry = $MDU_HCMAS_DB->prepare("SELECT * FROM section_t WHERE sectioncode = :dispct_sectn ");
							 if($sectn_qry){
								 $sectn_qry->execute(array(':dispct_sectn'=>check_tags($notices_result['despatch_section'])));
								 if($sectn_qry->rowCount()){
									 $sectn_qry_resl = $sectn_qry->fetch();
									 $notce_sectn = check_tags($sectn_qry_resl['section_name']);
									 echo $notce_sectn;
								 } //row emtpy
							 } //qry error
						 } //secn empty
					echo "	</td>";
					echo "<th class='hidden-lg hidden-md'>Mode of Dispatch</th>	<td>";
						$noticbalif_name = '';
						 
						if(check_tags($notices_result['bailiff_id'])){
							
							$notce_balif = $MDU_CIS_DB->prepare("SELECT bailiffname FROM tn_baliff_t where bailiffid = :balidf_di ");
							 
							if($notce_balif){
								$notce_balif->execute(array(':balidf_di'=>check_tags($notices_result['bailiff_id'])));
								if($notce_balif->rowCount()){
									$notice_reslt = $notce_balif->fetch();
									$noticbalif_name = check_tags($notice_reslt['bailiffname']);
									
								} //row empty
							} //qry error
						} //balif emtpy
						
						echo notice_mode(check_tags($notices_result['notice_mode']));
						 
						echo $notices_result['notice_mode']== 1 && $noticbalif_name ? '('.$noticbalif_name.')'  : '';
						
					echo "	</td>";
					echo "<th class='hidden-lg hidden-md'>Dispatch Date(CS)</th>	<td>";
						$dispt_dt = check_tags($notices_result['despatch_date']);
						echo $dispt_dt ? implode('/',array_reverse(explode('-',$dispt_dt))) : '';
					echo "	</td>";
					
					echo "<th class='hidden-lg hidden-md'>Status</th>	<td>";
						$serv_dt = check_tags($notices_result['served_date']);
						echo $serv_dt ? 'SERVED' : 'UNSERVED';
					echo "	</td>";
					
					echo "<th class='hidden-lg hidden-md'>Served Date/(Return Date & Reason)</th>	<td>";
						if($serv_dt){
							 
							echo $serv_dt ? implode('/',array_reverse(explode('-',$serv_dt))) : '';
						} else {
							$retuble_date = check_tags($notices_result['returnable_date']);
							echo $retuble_date ? implode('/',array_reverse(explode('-',$retuble_date))) : '';
							if(trim($notices_result['reason_code'])){
								$resn_notcee ='';
								$notc_resn_code = $MDU_HCMAS_DB->prepare("SELECT * FROM process_unsuccessful_t  where unsuccessful_id = :reason_cdoe ");
								if($notc_resn_code){
									$notc_resn_code->execute(array(':reason_cdoe'=>check_tags($notices_result['reason_code'])));
									if($notc_resn_code->rowCount()){
										$notc_resn_code_resl = $notc_resn_code->fetch();
										$resn_notcee =$notc_resn_code_resl['unsuccessful_name'];
										echo " & ".check_tags($resn_notcee) ;
									} // row emtpy
								} //qry error
							} else {
								
							} //
						} //else ending
					echo "	</td>";
						
						
					echo "</tr>";
								$sl++;
				} //while ending
?>	
				</tbody>
        	</table>			
<?php
			} //rowcount empy
		} //query error
		
		
		
?>
		<h4  class="post-title" align="center">   <b> Orders  </b> </h4>
		<table id="example11" class="display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr class="hidden-sm">
					<th> Sl.No. </th>
					<th> Case Details </th>
					<th> Petitioner Name </th>
					<th> Respondent Name </th>
					<th> Order Date  </th>
					<th>  Judge name  </th>
					<th> Order Copy  </th>
					 
				</tr>	
			</thead>
			<tbody>
<?php		

		if($cino){
			$sno=0;
			$order_qry = $MDU_HCMAS_DB->prepare("SELECT * FROM order_details WHERE cino=:cinno UNION SELECT * FROM order_details_a WHERE cino=:cinno order by order_dt, order_no");
			/*$order_qry = $MDU_HCMAS_DB->prepare("select * from (
SELECT civ.case_no as case_no,od.order_no as order_no,od.order_dt as order_dt,
od.jocode as jocode,od.doc_type as doc_type,od.court_no as court_no,od.cino as cino FROM order_details od inner join civil_t 
civ on od.cino=civ.cino WHERE od.cino=:cinno 
UNION
SELECT civa.case_no as case_no,oda.order_no as order_no,oda.order_dt as order_dt,
oda.jocode as jocode,oda.doc_type as doc_type,oda.court_no as court_no,oda.cino as cino FROM order_details_a oda inner join civil_t_a 
civa on oda.cino=civa.cino
WHERE oda.cino=:cinno )a order by order_dt, order_no");*/
			$orderexec = $order_qry->execute(array(':cinno'=>check_tags($cino)));
			
			if($orderexec){
				if($order_qry->rowcount()){
					//var_dump();
					 
					$sno=1;		
					while($order_qry_res = $order_qry->fetch()){
						//var_dump($order_qry_res);
						if(is_null($order_qry_res['case_no'])||trim(" ",$order_qry_res['case_no'])=="")
						$order_caseno="F".$order_qry_res['filing_no'];
						else
						$order_caseno = trim($order_qry_res['case_no']);
						$order_no = trim($order_qry_res['order_no']);
						$order_dt = trim($order_qry_res['order_dt']);
						$date = date_create($order_dt);
						$order_dt_fmt = date_format($date,"d/m/Y");						 
						$order_jocode = trim($order_qry_res['jocode']);
						$order_doc_type = trim($order_qry_res['doc_type']);
						$order_court_no = trim($order_qry_res['court_no']);
						$order_cino = trim($order_qry_res['cino']);
						$ord_yr = explode("-",$order_dt);
						
						$file_name = '192.168.1.36/hc_cis_mas/orders/'.$ord_yr[0].'/'.$order_caseno."_".$order_no.".pdf";
						
						$orjc1="";
						$orjc2="";
						
						 
						if(!trim($order_jocode)){
							
							$query = $MDU_HCMAS_DB->query("select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$order_court_no."' and from_dt IS NOT NULL order by b.judge_priority");
												
						}  else {
							
							if (strpos($order_jocode, ',') !== false) {			  
								$orjc1 = explode(",",$order_jocode);												
							}
							
							//var_dump($orjc1);
							
							if($orjc1)
							{
								$order_jocodes="";
								foreach($orjc1 as $r)
								{
									if(trim($r)){
										
										$orjc2 = "'".$r."',";
										$order_jocodes .= $orjc2;
									}  
								}
								
								
									  
									// GET MULTI JUDGE					  
									//echo "select * from judge_name_t where judge_code in(".rtrim($order_jocode,",").") and display='Y'";
								if($order_jocodes){
									
									$query=$MDU_HCMAS_DB->query("select * from judge_name_t where judge_code in(".rtrim($order_jocodes,",").") and display='Y' order by judge_priority asc");
									 
								} else {
								 
									
									$query = $MDU_HCMAS_DB->query("select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$order_court_no."' and from_dt IS NOT NULL order by b.judge_priority");
								}
							} else {
								
								// GET JUDGE NAME BY JOCODE		  
								//echo "select * from judge_name_t where judge_code='".$order_jocode."' and display='Y' order by judge_priority";
								$query = $MDU_HCMAS_DB->query("select * from judge_name_t where judge_code='".$order_jocode."' and display='Y' order by judge_priority asc"); 
							} 
						} //else ending
						
						//var_dump($query);
						
						$judges='';
						$shortjudge_namerep="";
						$countnorows=$query->rowCount();		  
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
						}//while
						
						//var_dump($file_name);
						
						 $year_cino=substr($order_cino,-4);
						//var_dump($file_name);
						$file_name=ChkFileExists($year_cino,$order_caseno,$order_no);
						if($file_name!='404') 
						{
							if($query_main_result['reg_no']&&$query_main_result['case_no'])
								$cas_ty_pe1=$cas_ty_pe;
							else
								$cas_ty_pe1=check_tags($sr_casetype_short_form).'-'. check_tags($query_main_result['fil_no']).'/'.check_tags($query_main_result['fil_year']).'  <br>(Filing Stage)' ;
		             				
?>	

				<tr class="<?php echo $file_name;?>" id="<?php echo $order_cino;?>">
				  <th class='hidden-lg hidden-md'>Sl.No.</th> <td style="text-align:left;"><?php echo $sno;?></td>
				  <th class='hidden-lg hidden-md'>Case Details</th> <td style="text-align:left;"><?php echo $cas_ty_pe1;?></td> 
				 <th class='hidden-lg hidden-md'>Petitioner Name</th>  <td style="text-align:left;"><?php echo check_tags(strtoupper(trim($query_main_result['pet_name'])));?></td>
				  <th class='hidden-lg hidden-md'>Respondent Name</th> <td style="text-align:left;"><?php echo check_tags(strtoupper(trim($query_main_result['res_name'])));?></td>
				  <th class='hidden-lg hidden-md'>	Order Date</th> <td style="text-align:left;"><?php echo $order_dt_fmt;?></td>
				  <th class='hidden-lg hidden-md'>Judge name</th> <td style="font-weight:bold;text-align:left;"><?php echo $judges;?></td>
				  <th class='hidden-lg hidden-md'>Order Copy</th> <td style="text-align:center;">
				    <form method="POST" action="order_view_mdu.php" target="_blank" >
					<input type="hidden" name='fileName' id="fileName" value="<?php echo base64_encode($file_name);?>"/>
					<button type="submit" class="pdf_but" ><i class="fa fa-file-pdf-o"></i> PDF </button>
					</form>
				   </td>
		           	           
				</tr>						  
<?php
		       $sno++;
						}
						
						
						
					} //while
				} else {
					echo "<tr><td colspan='7' align='center'> No records </td></tr>";
				} //rowmepty
				if($sno==1)	
					echo "<tr><td colspan='7' align='center'> No records </td></tr>";	
			}//qry err
			else
				echo "<tr><td colspan='7' align='center'> No records </td></tr>";
		}//cino emtpy		 
			 
		 
		
		
?>
			</tbody>
		</table>
						
<?php						
							} else {
								echo '<h3 style="color:red;">No record found</h3>';
							}//row emtpy main query
						} else {
							echo '<h3 style="color:red;">Unable to process the request. Try again later.</h3>';
						}// error main query
						 
					} else {
						echo '<h3 style="color:red;">Please enter all Mandatory value.</h3>';
					}//
				} else {
					echo '<h3 style="color:red;">Please check all madatory fields are filled</h3>';
				}//emtpy input
			} else {
				echo '<h3 style="color:red;">Captcha not matching</h3>';
			}
		} else {
			echo '<h3 style="color:red;">Captcha emtpy</h3>';
		}
		
	} else {
		echo '<h3 style="color:red;">Invalid Access</h3>';
	}	//post method

?>

</div>