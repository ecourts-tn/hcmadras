<?php
include 'config/dbconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);
?>
<html>
<head>
<style>
.card {
 
  color: white;
  padding: 1rem;
  height: 2rem;
  font-size:20px;
  /* background-image: url("images/bg_b.jpg");*/
     font-weight: bold;
	  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;
  border:1px solid black;
  background:black
}

body {font-family: sans-serif;
    font-size: 20px;
}
td { vertical-align: top; 
    border: 0.6mm solid #000000;
	align: center;
}
table thead th { background-color: #EEEEEE;
    text-align: center;
    border: 0.6mm solid #000000;
}

</style>
</head>
<body>
<div class="card" align="center"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;DISTRICT JUDICIARY VIDEO CONFERENCING DETAILS </div> <br><br>
<table width='70%' align='center' style='font-size:20px;border:1px solid #000000; border-collapse: collapse;' cellpadding='8'>
<thead>
<th style='width:5%'>Sno.</th>
<th style='width:50%'>Court Name</th>
<th style='width:15%'>Action</th>
</thead>
<tbody>
<?php

$district=array();
$district_cd=array();
$dist=base64_decode($_GET['dist_id']);

if($dist=='A')
	$d_stmt = $DB_con->prepare("SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y' ORDER BY dist_name ");
else
{
	$d_stmt = $DB_con->prepare("SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y' and dist_code=:dist ORDER BY dist_name ");
	$d_stmt->bindParam(':dist',$dist);
}
$d_stmt->execute();	
while ($row1 = $d_stmt->fetch()) {
	$district_cd[]=$row1['dist_code'];
 $district[$row1['dist_code']]=$row1['dist_name'];
}
if($dist!='A')
$filename = $district[$dist].'.html';
else
	$filename = 'Dist_VC_template.html';
header('Content-disposition: attachment; filename=' . $filename);
header('Content-type: text/html');
for($j=0;$j<count($district_cd);$j++){
$flag=0;
$disp='Y';
//if($dist!='A')
$taluk_qry ="select dist_id,taluk_id,taluk from taluk where  disp=:disp and dist_id=:dist order by dist_id,taluk_pri";
/*else
$taluk_qry ="select dist_id,taluk_id,taluk from taluk where  disp=:disp  order by dist_id,taluk_pri";*/	
$taluk_qry1=$DB_con->prepare($taluk_qry);
//if($dist!='A')
$taluk_qry1->bindParam(':dist',$district_cd[$j]);
$taluk_qry1->bindParam(':disp',$disp);
if($taluk_qry1->execute()){
	$taluk_qry_data = $taluk_qry1->fetchAll();
	
	echo "<tr><td colspan='3' align='center' style='background-color:#07bbed38;font-weight:bold'>District : ". $district[$district_cd[$j]]."</td>	</tr>";
	if($taluk_qry1->rowCount()>0){
for($i=0;$i<count($taluk_qry_data);$i++)
{
	$to_date=date('Y-m-d');
$vc_qry ="select a.vc_link,b.court_name from mhc_dj_vc a inner join court_det b on a.court_code=b.court_code where b.dist_id = :dist_id AND b.taluk_id = :taluk_id and b.court_end is null and b.disp=:disp and a.dist_id=:dist_id and a.to_date>=:to_date and a.display=:disp";	
$vc_qry1=$DB_con->prepare($vc_qry);
$vc_qry1->bindParam(':dist_id',$taluk_qry_data[$i]['dist_id']);
//$vc_qry1->bindParam(':dist1',$taluk_qry_data[$i]['dist_id']);
$vc_qry1->bindParam(':taluk_id',$taluk_qry_data[$i]['taluk_id']);
$vc_qry1->bindParam(':disp',$disp);
$vc_qry1->bindParam(':to_date',$to_date);
if($vc_qry1->execute()){
	if($vc_qry1->rowCount()>0){
		$flag++;
		echo "<tr><td colspan='3' align='left' style='font-weight:bold'>Taluk : ". $taluk_qry_data[$i]['taluk']."</td>	</tr>";
		$sno=1;
		while($vc_qry_data = $vc_qry1->fetch())
		{
			echo '<tr>
			<td>'.$sno.'</td>
			<td>'.$vc_qry_data['court_name'].'</td>
			<td><a href="#"  onclick="if (confirm(\'Click here to Connect the Teams Video Conferencing\') == true) {
    window.open(\''. $vc_qry_data['vc_link'] .'\', \'_blank\');
  }"><u>Click Here</u></a></td>
			</tr>';
			
			$sno++;
		}
}
	
}
}}
if($flag==0)
	echo "<tr><td colspan='3' align='center'>No VC</td>	</tr>";
}}
?>
</tbody>

</table>
<script>
function myFunction() {
  let text = "Click here to Connect the Teams Video Conferencing";
  if (confirm(text) == true) {
    window.open("<?php echo $vc_qry_data['vc_link'] ?>", '_blank');
  } else {
    
  }
}
</script>
</body>
</html>
