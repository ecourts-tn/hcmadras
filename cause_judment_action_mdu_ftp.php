<?php 
session_start();
require('config/dbconfig.php');
require('config/dbconfig_status.php');
include 'fun_class.php';
require_once 'securimage.php';

$getdata =new GETDETAILS($MDU_HCMAS_DB);
$cond="";
$case_details_valu="";
$search_for ="NO SEARCH RESULTS FOUND";
$temp_id="";
$valid1="";
$valid2="";
$valid3="";
$valid4="";

// CHECK WHETHER ORDER COPY PDF FILE EXISTS ON 1.36 SERVER $cis_url="http://10.241.47.2/cis";
function ChkFileExists($ord_yr,$ord_caseno,$ord_no)  {
	/*$date=date_create(date("Y-m-d"));
	date_sub($date,date_interval_create_from_date_string("1 days"));
	$prev_dt=date_format($date,"Ymd");
	if(file_exists("cis_files/".$prev_dt))
	{
		rmdir("cis_files/".$prev_dt);
	}*/
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
	$fil_nme = $ord_yr.'_'.$ord_caseno.'_'.$ord_no.'_MDUjud';

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



//CASE NO SEARCH
if(isset($_POST['RegCase_type']) and $_POST['RegCase_type']!=''  and is_numeric($_POST['RegCase_type']))
{
	$temp_id="case_no";
	$securimage1 = new Securimage(array('namespace' => 'casenoform'));
    $valid1 = $securimage1->check($_POST['caseno_captcha']);
	
	if($valid1){  
		
	    $valid1=1;  
	    $case_type=$_POST['RegCase_type'];
		$case_num=$_POST['RegCase_no'];
		$case_year=$_POST['RegCase_year'];

		$reg_case_type = $getdata->getcasetype($case_type);
		$search_for=$reg_case_type.'.'.$case_num.'/'.$case_year;
		
		$case_cino="";

		$query_main = $MDU_HCMAS_DB->query("SELECT * FROM civil_t WHERE regcase_type = '".$case_type."' AND reg_no = '".$case_num."' AND reg_year = '".$case_year."' union SELECT * FROM civil_t_a WHERE regcase_type = '".$case_type."' AND reg_no = '".$case_num."' AND reg_year = '".$case_year."' ORDER BY reg_no ASC ");
		$jud_bench_row=$query_main->fetch();
		$case_cino =$jud_bench_row['cino'];	
		
		if($case_cino!='')
		{
			//$cond = " od.cino = '".$case_cino."' and od.doc_type in ('30','29') ";	
			$cond="select a.*,b.* from (select case_no as ct_case_no,cino from civil_t_a where cino = '".$case_cino."'  UNION select case_no as ct_case_no,cino from civil_t where cino = '".$case_cino."')a inner join (select * from order_details where cino = '".$case_cino."' and doc_type in ('30','29') UNION select * from order_details_a where cino = '".$case_cino."' and doc_type in ('30','29'))b on a.cino =b.cino";
		}
		else
		{
			$cond ="";
		}
		$case_details_valu=$reg_case_type.'.'.$case_num.'/'.$case_year;
		//$msg['msg']=0;// Captcha verification is incorrect.
  		//echo json_encode($msg);
	}
	else
	{
	   $valid1=2; 
		
	}
}

//PARTY NAME SEARCH
if(isset($_POST['party_name']) and $_POST['party_name']!='' and isset($_POST['from_date']) and $_POST['from_date']!='')
{
	$temp_id="party";
	$securimage2 = new Securimage(array('namespace' => 'partyform'));
    $valid2 = $securimage2->check($_POST['party_captcha']);
	
	if($valid2){  
	
	    $valid2=1;  
	
	    $party_type= $_POST['party_type'];
		$party_name= $_POST['party_name'];
		$from_date= $_POST['from_date'];
		$to_date= $_POST['to_date'];
		
		//echo "SELECT * FROM civil_t_a WHERE (res_name ilike '%".$party_name."%') and date_of_decision between '".$from_date."' and '".$to_date."' ORDER BY reg_no ASC ";
		
		$party_type_cond="";
		$party_type_cond_a="";
		if($party_type==1) // Petitioner NAME Search
		{
		  $party_type_cond=" ct.pet_name ilike '%".$party_name."%' ";
		  $party_type_cond_a=" cta.pet_name ilike '%".$party_name."%' ";
		  $search_for= "Petitioner ".'"'.$party_name.'"'; 
		  
		}	
		else if($party_type==2) // Respondent NAME Search
		{
			$party_type_cond=" ct.res_name ilike '%".$party_name."%' ";
			$party_type_cond_a=" cta.res_name ilike '%".$party_name."%' ";
		  $search_for= "Respondent ".'"'.$party_name.'"'; 
		  
		}
		
				
		$case_cino="";
		$case_cino1="";
		
		if($party_type_cond!=''&&$party_type_cond_a!='')
		 {	  
		$cond ="select ct.case_no as ct_case_no,od.* from civil_t ct inner join (select * from order_details where order_dt between '".$from_date."' and '".$to_date."' and doc_type in ('30','29'))od on ct.cino=od.cino where  ".$party_type_cond." union select cta.case_no as ct_case_no,oda.* from civil_t_a cta inner join (select * from order_details_a where order_dt between '".$from_date."' and '".$to_date."' and doc_type in ('30','29'))oda on cta.cino=oda.cino where ".$party_type_cond_a ;
		
		 }
		 else
		 {
			$cond =""; 
		 }
		 
		 
	
		//$msg['msg']=0;// Captcha verification is incorrect.
  		//echo json_encode($msg);
	}
	else
	{
		 $valid2=2;  
	  
	}
}

//JUDGE NAME SEARCH
if(isset($_POST['judge_name']) and $_POST['judge_name']!='')
{
	$temp_id="judge";
	$securimage3 = new Securimage(array('namespace' => 'judgeform'));
    $valid3 = $securimage3->check($_POST['judge_captcha']);
	
	if($valid3){  
	
	    $valid3=1; 
	
	    $judge_name= $_POST['judge_name'];
		$jud_from_date= $_POST['jud_from_date'];
		$jud_to_date= $_POST['jud_to_date'];
		$judge_code="";			
		$search_for= "Judge Name ".'"'.$judge_name.'"';		
		//echo "SELECT * FROM judge_name_t WHERE judge_name ilike '%".$judge_name."%'";
		$query_main = $MDU_HCMAS_DB->query("SELECT * FROM judge_name_t WHERE judge_name ilike '%".$judge_name."%' and display='Y'");
		$jrows=$query_main->rowCount() ;
		$judrows =0;
		while($jud_bench_row=$query_main->fetch())
		{	  
		  $judge_code .= "'".$jud_bench_row['judge_code']."',";
		}	
		
		 $judge_code = rtrim( $judge_code,",");
			
		 if($judge_code!='')	
		 {
			// $cond = " od.jocode in (".$judge_code.") and od.doc_typein ('30','29') and od.order_dt between '".$jud_from_date."' and '".$jud_to_date."'";
			/*$cond="select * from (select cta.case_no as ct_case_no,oda.* from civil_t_a cta inner join order_details_a oda on cta.cino=oda.cino and
 oda.order_dt = cta.date_of_decision where oda.jocode in (".$judge_code.") and oda.doc_type in ('30','29') and 
oda.order_dt between '".$jud_from_date."' and '".$jud_to_date."' 
and cta.case_no is not null order by oda.order_dt, oda.order_no

union

select ct.case_no as ct_case_no,od.* from civil_t ct inner join order_details od on ct.cino=od.cino where od.jocode in (".$judge_code.") and od.doc_type in ('30','29') and 
od.order_dt between '".$jud_from_date."' and '".$jud_to_date."' 
and ct.case_no is not null )a order by order_dt, order_no";*/
$cond="select ct.case_no as ct_case_no,od.* from (select * from order_details where court_no in (select court_no from judge_t where judge_code in
 (".$judge_code.")) and doc_type in ('30','29') and order_dt between  '".$jud_from_date."' and '".$jud_to_date."' )od inner join civil_t ct on 
ct.cino=od.cino UNION select cta.case_no as ct_case_no,oda.* from (select * from order_details_a where court_no in (select court_no from judge_t where judge_code in 
(".$judge_code.")) and doc_type in ('30','29') and order_dt between  '".$jud_from_date."' and '".$jud_to_date."' )oda inner join civil_t_a cta on cta.cino=oda.cino ";

		 }
		 else
		 {
			 $cond ="";
		 }
	
	    
	
		//$msg['msg']=0;// Captcha verification is incorrect.
  		//echo json_encode($msg);
	}
	else
	{
	    $valid3=2;
		
	}
}

//ORDER DATE SEARCH
if(isset($_POST['order_date']) and $_POST['order_date']!='' )
{
	
	//echo $_POST['order_to_date'];
	$temp_id="order_dt";
	$securimage4 = new Securimage(array('namespace' => 'orddateform'));
    $valid4 = $securimage4->check($_POST['orddate_captcha']);
	
	if($valid4){
 
        $valid4=1; 
	
	    $order_frm_date= $_POST['order_date'];
	   // $order_to_date= $_POST['order_to_date'];
		
		$ordfmdt= explode("-",$order_frm_date);	
		//$ordtodt= explode("-",$order_to_date);	
			
		
        //$search_for= "Order date Between ".$ordfmdt[2]."/".$ordfmdt[1]."/".$ordfmdt[0]." and ".$ordtodt[2]."/".$ordtodt[1]."/".$ordtodt[0];
		$search_for= "Order date ".$ordfmdt[2]."/".$ordfmdt[1]."/".$ordfmdt[0];
		
		if($order_frm_date!='')
		{
			// $cond = " od.order_dt = '".$order_frm_date."' and od.doc_type in ('30','29')";
			/*$cond="select cta.case_no as ct_case_no,oda.* from civil_t_a cta inner join order_details_a oda on cta.cino=oda.cino and oda.order_dt = cta.date_of_decision where
oda.order_dt = '".$order_frm_date."'  and oda.doc_type in ('30','29')
union
select ct.case_no as ct_case_no,od.* from civil_t ct inner join order_details od on ct.cino=od.cino where
od.order_dt = '".$order_frm_date."'  and od.doc_type in ('30','29')";*/
$cond="select cta.case_no as ct_case_no,oda.* from (select * from order_details_a where order_dt ='".$order_frm_date."'  and doc_type in ('30','29'))oda
 inner join civil_t_a cta on cta.cino=oda.cino UNION select ct.case_no as ct_case_no,od.* from( select * from order_details where order_dt ='".$order_frm_date."'  and doc_type in ('30','29'))od inner join civil_t ct on ct.cino=od.cino ";
		}
		else
		{
			$cond ="";
		}
		
		
		//echo $cond;
		
	}
	else
	{
		$valid4=2;
		
		//$msg['msg']=0;// Captcha verification is incorrect.
  		//echo json_encode($msg);
	}
	
}

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

.pdf_label {
    display: inline;
    padding: 8px 15px;;
    font-size: 90%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
	background:#CB0909;
}
.pdf_label:hover{color:#fff; background:#E30B0B;}

table.dataTable tbody td{border-bottom: 1px solid #999;}
	</style>
	  
	   <div class="commentform" style="margin-top: 20px;">
	
<?php

if($cond!='' and ($valid1==1 or $valid2==1 or $valid3==1 or $valid4==1))
{
	?>
		
				<h2 class="post-title" align="center">THE JUDGMENTS INFORMATION SYSTEM</h2>
				
				<h6 class="post-title" style='color:red' align="center">SEARCH RESULTS FOR  : <?php echo $search_for;?></h6>
			<article class="group post-1222 page type-page status-publish hentry">
			
									
				<div class="entry" align="center">
			

<table id="<?php echo 'judment_'.$temp_id; ?>" class="display responsive nowrap" cellspacing="0" width="100%" >
  <caption></caption>
  <thead style="background: #827676; color: #fff;">
    <tr>
      <th scope="col" width="5%">S.No.</th>
      <th scope="col" width="15%" style="text-align:left;"> Case Details </th>      
      <th scope="col" width="20%" style="text-align:left;"> Petitioner Name </th>
      <th scope="col" width="20%" style="text-align:left;"> Respondent Name </th>
	  <th scope="col" width="10%" style="text-align:left;"> Order Date </th>
      <th scope="col" width="20%" > Judge name </th>	   
      <th scope="col" width="20%" style="text-align:left;"> Order Copy </th>	   
    </tr>
  </thead>
  <tbody>
<?php


	    $jud_data='';
	    $cause_list_main_val='';
	    $data_val=''; 
//echo "select ct.case_no as ct_case_no,od.* from civil_t_a ct inner join order_details_a od on ct.cino=od.cino and od.order_dt = ct.date_of_decision where ".$cond."and ct.case_no is not null  order by od.order_dt, od.order_no";
		//$order_qry= "select ct.case_no as ct_case_no,od.* from civil_t_a ct inner join order_details_a od on ct.cino=od.cino and od.order_dt = ct.date_of_decision where ".$cond." and ct.case_no is not null  order by od.order_dt, od.order_no";
		$order_qry=$cond;
		//echo "condo query:".$order_qry;
		$order_qry_exe =$MDU_HCMAS_DB->query($order_qry);
		 
		$sno=1;	
		while($order_row = $order_qry_exe->fetch())
		{
			if(is_null($order_row['case_no'])||trim(" ",$order_row['case_no'])=="")
				$order_caseno="F".$order_row['filing_no'];
			else
			$order_caseno=trim($order_row['ct_case_no']);
			$order_no=$order_row['order_no'];
			$order_dt=$order_row['order_dt'];
			$date=date_create($order_dt);
			$order_dt_fmt=date_format($date,"d/m/Y");						 
			$order_jocode=$order_row['jocode'];
			$order_doc_type=$order_row['doc_type'];
			$order_court_no=$order_row['court_no'];
			$order_cino=$order_row['cino'];
			$ord_yr = explode("-",$order_dt);
			 
			//$file_name = 'http://192.168.1.36/hc_cis_mas/orders/'.$ord_yr[0].'/'.$order_caseno."_".$order_no.".pdf";
			 
			   //echo "SELECT * FROM civil_t WHERE cino = '".$order_cino."' union SELECT * FROM civil_t_a WHERE cino = '".$order_cino."'";
			//echo "<br/>SELECT * FROM civil_t WHERE cino = '".$order_cino."' union SELECT * FROM civil_t_a WHERE cino = '".$order_cino."'";
			$case_det_qry = $MDU_HCMAS_DB->query("SELECT * FROM civil_t WHERE cino = '".$order_cino."' union SELECT * FROM civil_t_a WHERE cino = '".$order_cino."'");
			$case_det_row=$case_det_qry->fetch();
			
			$case_det_cino =$case_det_row['cino'];
			$pet_name =$case_det_row['pet_name'];
			$res_name =$case_det_row['res_name'];
			
			$case_type=$case_det_row['regcase_type'];
			$case_num=$case_det_row['reg_no'];
			$case_year=$case_det_row['reg_year']; 
			$res_cino=$case_det_row['cino']; 
			  $year_cino=substr($res_cino,-4);
			 if($case_num){
			$reg_case_type = $getdata->getcasetype($case_type);
			 $case_details_valu = $reg_case_type.'.'.$case_num.'/'.$case_year;}
			 else
			 {
			$reg_case_type = $getdata->getcasetype($case_det_row['filcase_type']);
			 $case_details_valu = $reg_case_type.'.'.$case_det_row['fil_no'].'/'.$case_det_row['fil_year'].'<br>(filing stage)';
			 }
			 
			 
				  // JUDGE DETAILS	         		 				 
				  $orjc1="";
				  $orjc2="";
				  
				if($order_jocode ==0 or $order_jocode =='') // RETIRED or JOCODE IS EMPTY or 0
				{ 
				
				//echo "<br/>its if: select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$order_court_no."' and from_dt IS NOT NULL order by b.judge_priority";
					$query = $MDU_HCMAS_DB->query("select a.judge_code,a.judge_name as judge_name,a.desg_code,a.short_judge_name from Judge_name_t as a,judge_t as b where a.display='Y' and a.judge_code=b.judge_code and b.court_no='".$order_court_no."' and from_dt IS NOT NULL order by b.judge_priority");
					  
				}
				else 
				{
					if (strpos($order_jocode, ',') !== false) {			  
						$orjc1 = explode(",",$order_jocode);												
					}
					
					if(($orjc1))
					{
						$order_jocode="";
						foreach($orjc1 as $r)
						{
							$orjc2 = "'".$r."',";
							$order_jocode .= $orjc2;
						}
							  
							// GET MULTI JUDGE					  
							//echo "<br/> its else if: select * from judge_name_t where judge_code in(".rtrim($order_jocode,",").") and display='Y'";
						$query=$MDU_HCMAS_DB->query("select * from judge_name_t where judge_code in(".rtrim($order_jocode,",").") and display='Y' order by judge_priority  ");
							  
					} else {
						
						// GET JUDGE NAME BY JOCODE		  
						//echo "select * from judge_name_t where judge_code='".$order_jocode."' and display='Y' order by judge_priority";
						//echo "its else else: select * from judge_name_t where judge_code='".$order_jocode."' and display='Y' ";
						$query = $MDU_HCMAS_DB->query("select * from judge_name_t where judge_code='".$order_jocode."' and display='Y' "); 
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
				//echo $case_details_valu."-".$order_jocode."-".$file_name."-".ChkFileExists($file_name);
				
				  	//if(ChkFileExists($file_name)!=404) // CHECK WHETHER ORDER COPY IS EXISTS OR NOT
					$file_name=ChkFileExists( $year_cino,$order_caseno,$order_no);
					if($file_name!='404')
	 	            
	 	            {
		             				
				?>	

				<tr class="<?php echo $file_name;?>" id="<?php echo $res_cino;?>">
				   <td style="text-align:left;"><?php echo $sno;?></td>
				   <td style="text-align:left;"><?php echo $case_details_valu;?></td> 
				   <td style="text-align:left;"><?php echo strtoupper($pet_name);?></td>
				   <td style="text-align:left;"><?php echo strtoupper($res_name);?></td>
				   <td style="text-align:left;"><?php echo $order_dt_fmt;?></td>
				   <td style="font-weight:bold;text-align:left;"><?php echo $judges;?></td>	
					 <?php if($valid1!=1){ ?>
					<td style="text-align:center;">
				    <form method="POST" id='myTest' action="order_view_mdu_ftp.php"  target="_blank" >
					<input type="hidden" name='fileName' id="fileName" value="<?php echo base64_encode($file_name);?>"/>
					<input type='button' value="PDF" onclick='test()'/>
					<!--<button type="submit" class="text-danger pdf_label" ><i class="fa fa-file-pdf-o"></i>PDF</button>-->
					</form>
				   </td>
				   <?php } else {?>
				   <td style="text-align:center;">
				    <form method="POST" action="order_view_mdu_ftp.php" target="_blank" >
					<input type="hidden" name='fileName' id="fileName" value="<?php echo base64_encode($file_name);?>"/>
					<button type="submit" class="text-danger pdf_label" ><i class="fa fa-file-pdf-o"></i>PDF</button>
					</form>
				   </td>
				   <?php }?>
				   
	           
				</tr>						  
<?php
		       $sno++;
				  }
				    
		      
		}//while ending
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
else if($valid1==2 or $valid2==2 or $valid3==2 or $valid4==2)
{
	echo '<h3 style="color:red;">Captcha not matching</h3>';
}
else
	echo '<h3 style="color:red;">NO SEARCH RESULTS FOUND</h3>';

?>

				
			</article>
			
	
				
	
	</div><!--/.container-->

	
	
	
	<script>
	$(document).ready( function () {
		var table_id='<?php echo 'judment_'.$temp_id; ?>';
		$('#'+table_id).DataTable();
	});
	</script>