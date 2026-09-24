<?php
session_start();
require('config/dbconfig.php');
require('config/dbconfig_status.php');
if($_POST['getCauseListValue'])
		{
			if($_POST['bench']=="MHC")
				$DB_option=$HCMAS_DB;
			else
				$DB_option=$MDU_HCMAS_DB;
			$jud_list="";
			$stmt2 = $DB_option->prepare("select ben.court_no as court_no,UPPER(STRING_AGG(judge_name, ', ')) as judge_name from judge_name_t nam inner join  (select 
court_no,judge_code from judge_t where court_no in (SELECT distinct for_bench_id FROM causelist_title WHERE cause_list_status='P' AND 
 causelist_date ='".date_format(date_create($_POST["cause_date"]),"Y-m-d")."')) ben on nam.judge_code =ben.judge_code group by ben.court_no order by judge_name");
				 $stmt2->execute();				 
					$jud_list.= '<option value="" >Choose Hon\'ble Judge</option>';
				while ($row2 = $stmt2->fetch()) 
				{
					
					$jud_list.= '<option value="'.$row2['court_no'].'">'.$row2['judge_name'].'</option>';
					}
					echo $jud_list;
					
		}

?>