
<?php
include "config/dbconfig.php";
include "config/dbconfig_status.php";
$flag1=false;
$flag2=false;
//$cur_year= date("Y");				
if(isset($_POST['param'])) // when change month and year
{
    $cur_period= strip_tags(base64_decode($_POST['param']));	// brings month and year ie( APRIL 2021)
	$month_name = array("January", "February", "March", "April","May","June","July","August","September","October","November","December");
	
	$dts = explode(" ", $cur_period); // split month and year
	if (in_array($dts[0], $month_name))
	{$m=$dts[0]; // month
	$flag1=true;
	}
	else
	{
	$m="";
	$flag1=false;
	}
	
	if(isset($dts[1])&&strlen($dts[1])==4&&is_numeric($dts[1]))
	{$y=$dts[1]; // year
$flag2=true;
	}
else
{
		$y="";
$flag2=false;
}
	
	
	$date = "1".$m; // month
    $cur_m = date('m', strtotime($date)); //converts month name to number ie( APRIL - 04)
  $a_date = $y."-".$cur_m."-01";
    $lastdate=date("Y-m-t", strtotime($a_date)); 
}
else // onload month and year
{
   $cur_m= date("m"); // current month
   $y= date("Y"); // current year
   
   $a_date = $y."-".$cur_m."-01"; // get last date of the month
   $lastdate=date("Y-m-t", strtotime($a_date));
   
}

if(isset($_POST['type']) and base64_decode($_POST['type'])=='holiday_list' and $flag1  and $flag2)
{
?>
<h3 class="group"><span>Holidays <?php echo $m." ".$y;?></span></h3>
<ul class="alx-posts group thumbs-enabled" >
	
<?php
	//echo "select * from holiday_t where holidayname!='Saturday Holiday' and holidayname!='Sunday Holiday' and holidaydate between '".$y."-".$cur_m."-01' and '".$lastdate."' order by holidaydate";
	$dte=$y."-".$cur_m."-01";
	
	$holiday_query4 = $HCMAS_DB->prepare("select * from holiday_t where holidayname!='Saturday Holiday' and holidayname!='Sunday Holiday' and holidaydate between :dte and :lastdate order by holidaydate");
	$holiday_query4->bindParam(':dte',$dte);
	$holiday_query4->bindParam(':lastdate',$lastdate);
	$holiday_query4->execute();
	while($holiday_result4 = $holiday_query4->fetch())
	{
	?>	
		<li>				
			<div class="post-item-inner group">
				<p class="post-item-title">	
				 <?php echo "<span style='color:red;'>".htmlspecialchars_decode($holiday_result4['holidayname'])."</span> - ". date("F, d",strtotime($holiday_result4['holidaydate']))." ".date("l",strtotime($holiday_result4['holidaydate']));?>			
				</p>
			</div>	
		</li>
	<?php
	}
	?> 
	</ul>
	<?php
}

if(isset($_POST['type']) and $_POST['type']=='holiday_note' and $flag1 and $flag2)
{
	// HOLIDAYS NOTE
	//$cur_year =date("Y");

	$holiday_query23 = $DB_con->prepare("select * from mhc_holiday where holiday_from_date IS NULL and year=:year");
	$holiday_query23->bindParam(':year',$y);
	$holiday_query23->execute();
	$i23=1;
	while($holiday_result23 = $holiday_query23->fetch())
	{	
	  
	?>		
		<li>
		 <p class="tab-item-date"><?php echo $i23.". ".htmlspecialchars_decode($holiday_result23['holidayname']);?></p>						                    
		</li>		
	<?php
	$i23++;
	} 
	// VACATION HOLIDAYS
	$holiday_query24 = $DB_con->prepare("select * from mhc_holiday where holiday_from_date IS NOT NULL and  holiday_to_date IS NOT NULL and year=:year");
	$holiday_query24->bindParam(':year',$y);
	$holiday_query24->execute();
	$i24=1;
	while($holiday_result24 = $holiday_query24->fetch())
	{				      
	?>		
		<li>
		 <p class="tab-item-date"><?php echo "<span style='color:red;'>".htmlspecialchars_decode($holiday_result24['holidayname'])." : </span> ".date("d.m.Y",strtotime($holiday_result24['holiday_from_date']))." to ".date("d.m.Y",strtotime($holiday_result24['holiday_to_date']));?></p>						                    
		</li>		
	<?php
	$i24++;
	} 
}
if(isset($_POST['type']) and $_POST['type']=='year_holiday_list')
{
	$holiday=array();
	$yr=base64_decode($_POST['yr']);
	$frm_dte=$yr.'-01-01';
	$to_dte=$yr.'-12-31';
	$disp='Y';
	$holiday_query4 = $HCMAS_DB->prepare("SELECT holidaydate,holidayname FROM holiday_t WHERE holidaydate between :dte and :lastdate and holidayname not in ('Sunday Holiday','Saturday Holiday') and display=:disp order by holidaydate");
	$holiday_query4->bindParam(':dte',$frm_dte);
	$holiday_query4->bindParam(':lastdate',$to_dte);
	$holiday_query4->bindParam(':disp',$disp);
	$holiday_query4->execute();
	while($holiday_result4 = $holiday_query4->fetch())
	{
		$tmp=strtotime($holiday_result4['holidaydate']);
		$day = date('l', $tmp);
		$hdate=implode('-',array_reverse(explode("-",$holiday_result4['holidaydate'])));
		$hname=$holiday_result4['holidayname'];
		$holiday[$hdate][0]=$day;
		$holiday[$hdate][1]=$hname;
		
		
	}
	
	echo json_encode($holiday);
	//echo $holiday_query4->rowCount();
	
}
if(isset($_POST['type']) and $_POST['type']=='year_vacation_list')
{
	$format = 'd-m-Y';
	$holiday=array();
	$year=base64_decode($_POST['year']);
	$dates = array();
	$holiday_query22 = $DB_con->prepare("select * from mhc_holiday where year =:year and holiday_from_date is not null and holiday_to_date is not  null ");
	$holiday_query22->bindParam(':year',$year);
	$holiday_query22->execute();
	while($holiday_result4 = $holiday_query22->fetch())
	{
		$current =strtotime($holiday_result4['holiday_from_date']);
		$date2 = strtotime($holiday_result4['holiday_to_date']);
		 $stepVal = '+1 day';
      while( $current <= $date2 ) {
         $dates[] = date($format, $current);
         $current = strtotime($stepVal, $current);
      }
		
		
	}
	
	echo json_encode($dates);
	//echo $holiday_query4->rowCount();
	
}
if(isset($_POST['type']) and $_POST['type']=='year_holiday_note' and isset($_POST['year']) )
{
	// HOLIDAYS NOTE
	//$cur_year =date("Y");
	$op=array();
	$yr=base64_decode($_POST['year']);
	$holiday_query23 = $DB_con->prepare("select * from mhc_holiday where holiday_from_date IS NULL and year=:year");
	$holiday_query23->bindParam(':year',$yr);
	$holiday_query23->execute();
	$i23=1;
	while($holiday_result23 = $holiday_query23->fetch())
	{	
	  $op[]='<li>
		 <p class="tab-item-date">'.$i23.". ".htmlspecialchars_decode($holiday_result23['holidayname']).'</p>						                    
		</li>';
	
	//$op[]='anu';
	$i23++;
	} 
	// VACATION HOLIDAYS
	$holiday_query24 = $DB_con->prepare("select * from mhc_holiday where holiday_from_date IS NOT NULL and  holiday_to_date IS NOT NULL and year=:year");
	$holiday_query24->bindParam(':year',$yr);
	$holiday_query24->execute();
	$i24=1;
	while($holiday_result24 = $holiday_query24->fetch())
	{			
		$op[]='<li>
		 <p class="tab-item-date"><span style="color:red;">'.htmlspecialchars_decode($holiday_result24['holidayname'])." : ".date("d.m.Y",strtotime($holiday_result24['holiday_from_date']))." to ".date("d.m.Y",strtotime($holiday_result24['holiday_to_date'])).'</p>						                    
		</li>';
	
	$i24++;
	} 
	echo json_encode($op);
}
?>
