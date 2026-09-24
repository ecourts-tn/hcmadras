<?php  
include "header.php";
require('config/dbconfig.php');
require('config/dbconfig_status.php');
?>
 <style>


.col-3cm .main {
background:None; }

.card {
 
  color: white;
  padding: 1rem;
  height: 2rem;
  font-size:20px;
   background-image: url("images/bg_b.jpg");
     font-weight: bold;
}

  
.cards {
 
  margin: 0 auto;
  display: grid;
  grid-gap: 0.5rem;
   font-weight: bold;
}




	</style>	
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

		
		<div class="card" align="center"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;MADURAI BENCH VIDEO CONFERENCING DETAILS (<?php echo date("d-m-Y");?>)</div>	
	<div class="entry" align="center" id="content">
				

<table   width="100%">

  <thead>
    <tr>
      <th>S.No.</th>
      <th>Hon'ble Judge Name</th>
      
	    <th>VC Link</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $cur_date=date('Y-m-d');
  $bench_id='';
  //error_log("SELECT bench_id FROM tn_causelist WHERE causelist_date = '".$cur_date."' AND court_det = 'MHC' AND published='Y'  GROUP BY bench_id");
   $qry1 = $MDU_CIS_DB->query("SELECT bench_id FROM tn_causelist WHERE causelist_date = '".$cur_date."' AND court_det = 'MDU' AND published='Y'  GROUP BY bench_id");
   		if($qry1->rowCount() > 0) {
while($row1 = $qry1->fetch())
{
	$bench_id .="'".$row1['bench_id']."',";
}
$ben_id=rtrim($bench_id,',');
	
		
  $i=1;
	 $qry = $MDU_CIS_DB->query("select * from tn_vc_det where bench_id IN (".$ben_id.") and court_det='MDU' and to_date >='".$cur_date."' and  from_date <='".$cur_date."' order by cause_no ASC");
	 if($qry->rowCount() > 0) {
while($row = $qry->fetch())
{
	
	
   
																  
   
	  
   
		  
	   
																					
		
		?>
    <tr>
      <td><?php echo $i; ?></td>
       <td align='left'><?php echo strtoupper(nl2br(html_entity_decode($row['judge_name'], FILTER_SANITIZE_STRING))); ?></td>
	  
	<td><a title="Click here to Connect the Teams Video Conferencing" target="_blank"><img width="30" height="30" onclick="submitForm('<?php echo  $row['meeting_link']; ?>')" src="images/Team-video-conferencing-logo-2.jpg" alt="Click here to Connect the Teams Video Conferencing" /></a></td>    
	

	  
	  
    </tr>
    <?php
	$i++;
}
	 }
	 else
	 {
		 ?>
		     <tr>
      <td colspan='3'></td>
	     </tr>
		 <?php
		 
	 }
		}
		else
		{
?>
  <tr>
      <td colspan='3'></td>
	     </tr>
		 <?php
		 
	 }
	 ?>
  </tbody>
</table>
					<div class="clear"></div>
				</div>
</div>
</div><!--/.content-->
<script>

function submitForm(link) {
		swal({
		title: "Alert",
		text: "External Website that opens in a new window",
		type: "info"
		}).then(function() {
   	window.open(
  link,
  "_blank" // <- This is what makes it open in a new window.
);
});
        return false;
    }
	
	
	
			
</script>


<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>
