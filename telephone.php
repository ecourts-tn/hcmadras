<?php  
include "header.php";

?>





	 <script>
	$(document).ready(function(){
//	$("#content").hide();
	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})



      </script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
<h2 class="post-title" align="center">MADRAS HIGH COURT  TELEPHONE DIRECTORY</h2><br>
 
 <table id="example" class="display   no-footer dtr-inline" cellspacing="0" width="100%">
    <thead>
        <tr>
		<th align='left' style="width:10%">Sl.No</th> 
            <th align='left' style="width:40%">Officers</th> 
			<th align='left' style="width:25%">Bench</th>			
            <th align='left' style="width:25%">Intercom Number / Fax (F)</th>            
                       
                   
        </tr>
    </thead>
    <tbody>
	
	    <?php 	
		$i=1;
$sql_qry = $DB_con->query("select * from mhc_telephone_diary where display='Y' order by bench desc, order_id asc");
while($row = $sql_qry->fetch())
{
	if($row['bench']=='MHC')
		$bench='Principal Seat';
	else if($row['bench']=='MDU')
		$bench='Madurai Bench';
	else
		$bench=$row['bench'];
	if($row['type']=='O')
	{
		
		$sql_qry1 = $DB_con->query("select * from registrars where reg_rel is null and reg_desig ='".$row['name']."' and reg_place='".$row['bench']."'");
		if($sql_qry1->rowcount()>0){
		while($row1 = $sql_qry1->fetch())
		{
			$r_name=$row1['reg_name'];
			$r_fax=$row1['reg_fax_no'];
			$r_tele=$row1['reg_contact_no'];
		//$type="Officer"."<br>(".$row['bench'].")";
		$type=$bench;
		$select_qry = $DB_con->query("SELECT desig FROM officer_designation where sno='".$row['name']."'");
		$row2 = $select_qry->fetch();
		$tmp=str_replace("(","( ",str_replace(")"," )",$row2['desig']));
$name=$r_name."<br>".ucwords(strtolower($tmp));
		if(!is_null($row['intercom_no']) && $row['intercom_no'] !="" &&$row['intercom_no'] !=' ' )
		{
			$tele=str_replace(",","<br>",$row['intercom_no']);
			if($r_fax)
			$tele.="<br>".$r_fax." (F)" ;
			
		}	else
		{
			$tele=str_replace(",","<br>",$r_tele);
			if($r_fax)
			$tele.="<br>".$r_fax." (F)" ;
		}

		}}else
		{
			$select_qry = $DB_con->query("SELECT desig FROM officer_designation where sno='".$row['name']."'");
			$row2 = $select_qry->fetch();
			$tmp=str_replace("(","( ",str_replace(")"," )",$row2['desig']));
			$name=ucwords(strtolower($tmp));
			$tele=str_replace(",","<br>",$row['intercom_no']);
			$type=$bench;
			
		}
		}
	else
	{
		$select_qry = $DB_con->query("SELECT depart FROM  departments where sno='".$row['name']."'");
		$row2 = $select_qry->fetch();
		$tmp=str_replace("(","( ",str_replace(")"," )",$row2['depart']));
		$name=ucwords(strtolower($tmp));
		$tele=str_replace(",","<br>",$row['intercom_no']);
		$type="Section"."<br>(".$bench.")";
	}

	

	  ?>
	  
        <tr>  
			<td style="width:10%"><?php echo $i  ?></td>			
           <td style="width:40%"><?php echo $name  ?></td>	
			<td style="width:25%"><?php echo $type  ?></td>		   
           <td style="width:25%"><?php echo $tele  ?></td>		 
          		 
        </tr>
		
       
		<?php
		$i++;
}
 

  ?>
    </tbody>
</table>
 
 
 

	</div><!--/.pad-->
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

