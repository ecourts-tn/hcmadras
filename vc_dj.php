<?php  
include "header.php";


require('config/dbconfig.php');
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

		
		<div class="card" align="center"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;DISTRICT JUDICIARY VIDEO CONFERENCING DETAILS (<?php echo date("d-m-Y");?>)</div>	
	<div class="entry" align="center" id="content"><br><br>
				<label style='font-weight: bold;'>Select District</label>
				<select class="form-control" id="dist_id" required="required" style='height:35px;width:200px;font-size:16px' name="dist_id" autocomplete="off" onchange="getVClink()">
                                                 <option value="" selected disabled style='font-size:16px'>Select Court</option>
												<?php $sql1 ="SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y' ORDER BY dist_name ";
	$exe1 = pg_query($bd22,$sql1);
	while($row_jud = pg_fetch_array($exe1))
							{
	?>
                                                <option value="<?php echo $row_jud['dist_code']; ?>" style='font-size:16px'><?php echo $row_jud['dist_name']; ?></option>
							<?php }?>
                                            </select>
											
											<br><br>
                                            <div class='popover-content' id="doc_view">
                                               

                                            </div>

					<div class="clear"></div>
				</div>
</div>
</div><!--/.content-->
<script>


	function getVClink()
{
	var dist_id=$('#dist_id').val();
	$.post("methods.php", {dist_id: btoa(dist_id),action:'getVClinks'}, function(result){
	$("#doc_view").html(result);
	$('#table_id2').DataTable();
	});
}
	
	
			
</script>


<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>
