<?php 
session_start();
require('config/dbconfig.php');
include "header.php";
include 'fun_class.php';
require_once 'securimage.php';
$getdata =new GETDETAILS($HCMAS_DB);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
extract($_POST);
// $security_code=$_POST["captcha"];

	
$causelist_dt='03-09-2021';

 $causelist_date=date('Y-m-d',strtotime($causelist_dt));
 $court_no='VC 02';
 

 


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




	</style>
	 
		
				<h2 class="post-title" align="center">CAUSE LIST</h2>
				<h6 class="post-title" style='color:red;font-family: "Times New Roman", Times, red serif;' align="center"><b>CAUSE LIST FOR <?php echo $causelist_dt?></b></h6>
				<h6 class="post-title" style='color:red;font-family: "Times New Roman", Times, red serif;' align="center">SEARCH RESULTS FOR <?php echo $court_no?></h6>
			<article class="group post-1222 page type-page status-publish hentry">
			
									
				<div class="" align="center">
			
<table id="example0" class="display responsive nowrap" style="width:100%">
        <thead>
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
		 $cause_list=$HCMAS_DB->query("SELECT distinct(sr_no),cino,case_no,ctype,originalsr_no,case_remark,causelist_type,causelist_period,list_from_date,list_to_date,causelist_date,for_bench_id,purpose_cd,reg_dt,filing_dt,section_id,on_filing,clink_code,elimination,causelist_sr_no,cause_list_eliminate,ia_no,ia_next_date,ia_flag,search_case,initial_status,final_status,cause_case_type,cause_reg_no,cause_reg_year,ia_case_type,bunch_code,purpose_priority,short_order,court_no FROM cause_list WHERE  causelist_date ='".$causelist_date."' AND for_bench_id IN ('16752','16338','16774','16354') AND causelist_sr_no!='0' AND  originalsr_no!='0' and elimination='N'  ORDER BY sr_no");
			
		
			
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
					
					$case_type = $getdata->getcasetype($RegCase_type);
					$case_details=$case_type.'.'.$RegCase_no.'/'.$RegCase_year;
					
					$civil_qry = $HCMAS_DB->prepare("SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,
				pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount FROM civil_t WHERE cino=:cino UNION SELECT filcase_type,fil_no,fil_year,pet_name,res_name,pet_adv_cd,res_adv_cd,regcase_type,reg_no,reg_year,pet_adv,res_adv,filing_no,case_no,pet_mobile,res_mobile,pet_extracount,res_extracount  FROM civil_t_a WHERE cino=:cino");
				$civil_qry->execute(array(':cino'=>$cino));				 
				$civil_row= $civil_qry->fetch();

				//$main_cino=$civil_row['cino'];
					
				
					
				
				if($cause_list_row['on_filing']=='Y')
				{
					$fil_type = $getdata->getcasetype($RegCase_type);
					$case_details="SR No. ".$fil_type.'.'.$RegCase_no.'/'.$RegCase_year;
					$civil_t_a_qry = $HCMAS_DB->query("SELECT date_filing_disp,disp_nature FROM civil_t_a where cino='".$cino."' and date_filing_disp IS NOT NULL  ORDER BY date_filing_disp DESC");
					
							if($civil_t_a_qry->rowcount()>0)
						  {
							 
							  
					     $disp_c_nat = $civil_t_a_qry->fetch();
						 $adj_dis_type = $getdata->GetDisType($disp_c_nat['disp_nature']);	
						 //$todays_date=date('d-M-Y',strtotime($disp_c_nat['date_filing_disp']));
						 $todays_date='';
						 
						  }
						  else
						  {
							  $resSrCaseType = $HCMAS_DB->query("SELECT todays_date,order_remark,next_date FROM daily_proc_filing where cino='".$link_cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							
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
					 $daily_pro = $HCMAS_DB->query("SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc where cino='".$cino."' and todays_date IS NOT NULL  UNION SELECT adjcode, srno,todays_date,order_remark,next_date FROM daily_proc_a where cino='".$cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
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
						$disposal_qry = $HCMAS_DB->query("SELECT order_remark FROM disposal_proc where cino='".$cino."' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
							if($disposal_qry->rowcount()>0)
						  {
							  $disposal_row = $disposal_qry->fetch();
							   
						$dis_pos_case=$HCMAS_DB->prepare("SELECT disp_nature,date_of_decision FROM civil_t_a  where cino=:cino and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
						$dis_pos_case->execute(array(':cino'=>$cino));
						$row_dis_pos_case= $dis_pos_case->fetch(PDO::FETCH_ASSOC);
						$adj_dis_type = $getdata->GetDisType($row_dis_pos_case['disp_nature']);	
						//$todays_date=date('d-M-Y',strtotime($row_dis_pos_case['date_of_decision']));	
						$todays_date='';	
						
						  }
						  else
						  {
							   $civil_t_query1 = $HCMAS_DB->query("SELECT disp_nature,date_of_decision FROM civil_t_a where cino='".$cino."' and date_of_decision IS NOT NULL  ORDER BY date_of_decision DESC");
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
							  $restore_qry=$HCMAS_DB->prepare("SELECT remark,next_date,todays_date FROM restorerevoke  where cino=:cino  AND datetype='rev' and todays_date IS NOT NULL  ORDER BY todays_date DESC");
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
					
					echo '<tr>
					<td>'.$sr_no.'</td>
                <td>'.$cause_list_row['for_bench_id'].'</td>
                <td>'.$cause_list_row['causelist_type'].'</td>
                <td>'.$cause_list_row['purpose_cd'].'</td>
                <td>'.$case_details.'</td>
                <td>'.$party_details.'</td>
									<td>'.$pet_advocate_details.'</td>
									<td>'.$res_advocate_details.'</td>
									<td>'.$proceding.'</br>'.$proceding_dt.'</td>
            </tr>';
				}
			}
		?>
 
          

          
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>

					<div class="clear"></div>
				</div><!--/.entry-->
				
			</article>
			
	<?php include "footer.php"; ?>
	
	<script type='text/javascript' src='https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js'></script>
	<script type='text/javascript' src='https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js'></script>
	<script>
	$(document).ready(function() {
    $('#example0').DataTable( {
        order: [[2, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [ 1, 2, 3 ]
        },
        columnDefs: [ {
            targets: [ 1, 2, 3 ],
            visible: false
        } ]
    } );
	
} );
	/* $(document).ready(function() {
    var groupColumn = 1;
    var table = $('#example0').DataTable({
        "columnDefs": [
            { "visible": false, "targets": [ 1, 2,3 ] }
        ],
        "order": [[ [ 1, 2,3 ], 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column([ 1, 2,3 ], {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#example0 tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === [ 1, 2,3 ] && currentOrder[1] === 'asc' ) {
            table.order( [3, 'desc'],[2, 'desc'], [1, 'desc'] ).draw();
        }
        else {
            table.order( [3, 'asc'],[2, 'asc'], [1, 'asc']).draw();
        }
    } );
} ); */
	</script>