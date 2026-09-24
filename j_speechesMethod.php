<?php
include 'config/dbconfig.php';


	?>

<table id="table_id2">
<thead>
<tr>
<th style="width:10%">Sl.No.</th>
<th style="width:70%">Title</th>
<th style="width:20%">Language & Size</th>
</tr></thead>
<?php
if($_POST['jud_id']){
$data_val='';
	$result='';
	$sno=1;
	$display='Y';
	$dtype="S";
	$judge_id=base64_decode($_POST['jud_id']);
	if ( is_numeric($judge_id) == true){
		 $icon='<img src="admin/images/pdf.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
	$qry_jud1 ="select j_doc_id,j_doc_name, j_doc_size,j_doc_lan from judges_doc where j_doc_display=:dis  and j_doc_type=:d_type and j_jud_id=:j_id";
	$qry_jud2=$DB_con->prepare($qry_jud1);
	$qry_jud2->bindParam(':dis',$display);
	$qry_jud2->bindParam(':d_type',$dtype);
	$qry_jud2->bindParam(':j_id',$judge_id );
	if($qry_jud2->execute()){
while($row = $qry_jud2->fetch())
{	

echo '<tr> <td>'.$sno.'</td>
		<td>'.$row["j_doc_name"].'</td>
	<td><form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['j_doc_id']).'"/>
	  <input type="hidden" name="page" id="page" value="'.base64_encode("J").'" />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;background-color: white;border: white;">'.$icon.'<br>'.$row["j_doc_lan"].' - '.$row["j_doc_size"].'</button>
	  </form></td>
			</tr>';				
$sno++;
}
	}	}
	
}	
?>

</table>
<?php

?>