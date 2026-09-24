<?php
include 'config/dbconfig.php';

if(isset($_POST['action'])){
	if($_POST['action']=='getVClinks'){
	?>

<table id="table_id2">
<thead>
<tr>
<th style="width:10%">Sl.No.</th>
<th style="width:70%">Court Name</th>
<th style="width:20%">VC Link</th>
</tr></thead>
<?php
if(isset($_POST['dist_id'])&&$_POST['dist_id']){
$data_val='';
	$result='';
	$sno=1;
	$display='Y';
	$cur_date=date('Y-m-d');
	$dist_id=base64_decode($_POST['dist_id']);
	if ( is_numeric($dist_id) == true){
		 $icon='<img src="admin/images/pdf.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
	$c_stmt = $DB_con->prepare("SELECT court_code,court_name FROM court_det WHERE  disp = :disp and dist_id= :dist_id order by court_name");
	$c_stmt->bindParam(':disp',$display);
	$c_stmt->bindParam(':dist_id',$dist_id);
			 $c_stmt->execute();
			 while ($row2 = $c_stmt->fetch()) {
				 $court_name[$row2['court_code']]=$row2['court_name'];
			 }
	$qry_jud1 ="select court_code,vc_link from mhc_dj_vc where display=:dis  and dist_id=:dist_id and to_date >=:t_date and  from_date <=:f_date";
	$qry_jud2=$DB_con->prepare($qry_jud1);
	$qry_jud2->bindParam(':dis',$display);
	$qry_jud2->bindParam(':dist_id',$dist_id);
	$qry_jud2->bindParam(':t_date',$cur_date );
	$qry_jud2->bindParam(':f_date',$cur_date );
	if($qry_jud2->execute()){
while($row = $qry_jud2->fetch())
{	

echo '<tr> <td>'.$sno.'</td>
		<td align="left">'.$court_name[$row["court_code"]].'</td>
	<td><a href="#"  onclick="swal({title:\'Alert\',text:\'Click here to Connect the Teams Video Conferencing\',type:\'info\'}).then(function() {window.open(\''.$row['vc_link'].'\', \'_blank\');})"><img width="30" height="30"  src="images/Team-video-conferencing-logo-2.jpg" alt="Click here to Connect the Teams Video Conferencing" /></a>
	</td>
			</tr>';				
$sno++;
}
	}	}
	
}	//onclick="submitForm('.$row['vc_link'] .')"
?>

</table>
<?php
}
}
?>