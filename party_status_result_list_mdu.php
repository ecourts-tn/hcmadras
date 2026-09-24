<?php

session_start(); 
ini_set('display_errors',0);
ini_set('display_startup_errors', 0);
error_reporting( E_ALL);
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

	
	
	
	
?>
<style>

	.table_caseno_search  {
		width:100%;
	}
	
	/*.table_caseno_search table, th, td {
		border: 1px solid black;
		
	}*/
	.view_status_but
{
    background: #0d647e;
    color: white;
    padding: 6px 10px;
    font-weight: 600;
    display: inline-block;
    border: none;
    cursor: pointer;
    -webkit-border-radius: 3px;
    border-radius: 3px;
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
		
		if( (isset($_POST['party_name_captcha']) && !empty($_POST['party_name_captcha']))){
			
			/* $user_captcha = check_input($_POST['caseno_captcha']);
			$page_captcha = trim($_SESSION['case_captcha']); */
			
			$securimage = new Securimage(array('namespace' => 'party_name'));
            $valid = $securimage->check($_POST['party_name_captcha']);
			
			
			
			
			/* if($user_captcha === $page_captcha){ */
			
			if($valid){
				
	if(isset($_POST['party_name']) && !empty($_POST['party_name']) &&  isset($_POST['from_date']) && !empty($_POST['from_date']) && isset($_POST['to_date']) && !empty($_POST['to_date']) && isset($_POST['party_type']) && !empty($_POST['party_type'])){
			
					$party_name =  check_input($_POST['party_name']);
					if($party_name){
						$party_name_tmp=$party_name;
					$party_name ='%'.$party_name.'%';
					}
					else
						$party_name ='';
					$from_date =  check_input($_POST['from_date']);
					$to_date =   check_input($_POST['to_date']);
					$party_type =   check_input($_POST['party_type']);
					if($party_type==1){
						 $party_type_cond=" and pet_name ilike :party_name";
					$search_for= "Petitioner ".'"'.$party_name_tmp.'"'; }
						else if ($party_type==2){
							$party_type_cond=" and res_name ilike :party_name ";
						$search_for= "Respondent ".'"'.$party_name_tmp.'"'; }
				
				
?>						
						
					<h6 class="post-title" style='color:red' align="center">SEARCH RESULTS FOR  : <?php echo $search_for;?></h6>
			<article class="group post-1222 page type-page status-publish hentry">
			
									
				<div class="entry" align="center">
			

<table id="<?php echo 'party_search'; ?>" class="display responsive nowrap no-footer " cellspacing="0" width="100%" >
  <caption></caption>
  <thead style="background: #827676; color: #fff;">
    <tr>
      <th scope="col" width="5%">S.No.</th>
      <th scope="col" width="14%" style="text-align:left;"> Case Details </th>      
      <th scope="col" width="23%" style="text-align:left;"> Petitioner Name </th>
      <th scope="col" width="23%" style="text-align:left;"> Respondent Name </th>
      <th scope="col" width="25%" style="text-align:left;" > Judge name </th>	   
      <th scope="col" width="10%" style="text-align:left;"> Action </th>	   
    </tr>
  </thead>
  <tbody>
<?php


					if($party_name  && $from_date && $to_date && $party_type){
						
						$query_main = $MDU_HCMAS_DB->prepare("SELECT * FROM civil_t WHERE date_of_filing between :from_date and :to_date ".$party_type_cond."  and hide_pet_name!='Y' and hide_res_name!='Y' and hide_partyname!='Y' union SELECT * FROM civil_t_a WHERE date_of_filing between :from_date and :to_date  ".$party_type_cond."  and hide_pet_name!='Y' and hide_res_name!='Y' and hide_partyname!='Y' ORDER BY date_of_filing ASC ");
						
			 	
			
						$result = $query_main->execute(array(':from_date'=>$from_date,':to_date'=>$to_date,':party_name'=>$party_name));	
				 
						if($result){
					
							if($query_main->rowcount()){
						
							$sno=1;	
		while($query_main_result  = $query_main->fetch())
		{
			
						
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
							
						
						
						
						

	    
		 
		
			if(is_null($query_main_result['case_no'])||trim(" ",$query_main_result['case_no'])=="")
				$caseno=$sr_casetype_short_form.'.'.$main_srcase_no.'/'.$main_srcase_year."<br>(Filing Number)";
			else
			$caseno=$reg_casetype_short_form.'.'.$main_case_no.'/'.$main_case_year;
			if($query_main_result['judge_code'])
			$jocode=trim($query_main_result['judge_code']);
			else
			$jocode=0;
			$court_no=$query_main_result['court_no'];
			$cino=$query_main_result['cino'];
			$pet_name =$query_main_result['pet_name'];
			$res_name =$query_main_result['res_name'];
			$case_no=$query_main_result['case_no'];
			$case_type=$query_main_result['regcase_type'];
			$case_num=$query_main_result['reg_no'];
			$case_year=$query_main_result['reg_year']; 
			$res_cino=$query_main_result['cino']; 
			  if($case_no){
			$reg_case_type = $getdata->getcasetype($case_type);
			$case_details_valu = $reg_case_type.'.'.$case_num.'/'.$case_year;}
			 else
			 {
			$reg_case_type = $getdata->getcasetype($query_main_result['filcase_type']);
			 $case_details_valu = $reg_case_type.'.'.$query_main_result['fil_no'].'/'.$query_main_result['fil_year'].'<br>(filing stage)';
			 }
			 
			 
				  // JUDGE DETAILS	         		 				 
				  $orjc1="";
				  $orjc2="";
				  
				if($jocode ==0 or $jocode =='') // RETIRED or JOCODE IS EMPTY or 0
				{ 
				
				//echo "<br/>its if: select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$order_court_no."' and from_dt IS NOT NULL order by b.judge_priority";
					$query = $MDU_HCMAS_DB->query("select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$court_no."' and from_dt IS NOT NULL order by b.judge_priority");
					  
				}
				else 
				{
					if (strpos($jocode, ',') !== false) {			  
						$orjc1 = explode(",",$jocode);												
					}
					
					if(($orjc1))
					{
						$jocode="";
						foreach($orjc1 as $r)
						{
							if($r){
							$orjc2 = "'".$r."',";
							$jocode .= $orjc2;}
						}
						if(!$jocode)
							$jocode=0;
							  
							// GET MULTI JUDGE					  
							//echo "<br/> its else if: select * from judge_name_t where judge_code in(".rtrim($jocode,",").") and display='Y'";
						//	echo "select * from judge_name_t where judge_code in(".rtrim($jocode,",").") and display='Y' order by judge_priority  ".$cino;
						$query=$MDU_HCMAS_DB->query("select * from judge_name_t where judge_code in(".rtrim($jocode,",").") and display='Y' order by judge_priority  ");
							  
					} else {
						
						// GET JUDGE NAME BY JOCODE		  
						//echo "select * from judge_name_t where judge_code='".$jocode."' and display='Y' order by judge_priority";
						//echo "its else else: select * from judge_name_t where judge_code='".$jocode."' and display='Y' ";
						$query = $MDU_HCMAS_DB->query("select * from judge_name_t where judge_code='".$jocode."' and display='Y' "); 
					}
				} //else 	
				  
				  				  
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
				//echo $case_details_valu."-".$jocode."-".$file_name."-".ChkFileExists($file_name);
				
				  	//if(ChkFileExists($file_name)!=404) // CHECK WHETHER ORDER COPY IS EXISTS OR NOT
					
				
		             				
				?>	

				<tr  id="<?php echo $cino;?>">
				   <td style="text-align:left;"><?php echo $sno;?></td>
				   <td style="text-align:left;"><?php echo $caseno;?></td> 
				   <td style="text-align:left;"><?php echo strtoupper($pet_name);?></td>
				   <td style="text-align:left;"><?php echo strtoupper($res_name);?></td>
				   <td style="font-weight:bold;text-align:left;"><?php echo $judges;?></td>
					<td style="text-align:center;">
				    <form method="POST" id="<?php echo 'pdf_capt_sub_'.$sno; ?>" action="case_status_party_result_mdu.php"  target="_blank" >
					<input type="hidden" name='cino' id="cino" value="<?php echo base64_encode($cino);?>"/>
					<input type='button' value=" VIEW " class='view_status_but' onclick='open_overlay("<?php echo $sno;?>")'/>
					<!--<button type="submit" class="text-danger pdf_label" ><i class="fa fa-file-pdf-o"></i>PDF</button>-->
					</form>
				   </td>
				   
				           
				</tr>						  
<?php
		       $sno++;
				  
				    
		      
		}//while ending
		if($sno==1)
		{			 
			echo '<h3 style="color:red;">NO SEARCH RESULTS FOUND</h3>';
		}
?>
		 
		   </tbody>
</table>
					<div class="clear"></div>
				</div>
			
				
					
					
					
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