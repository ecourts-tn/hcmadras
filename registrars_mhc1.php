<?php  
include "config/dbconfig.php";

?>

<style>
#judge_thumb{border-radius: 50%!important; vertical-align: middle;}
 
 td {
           
            word-wrap: break-word;
			
			
        }
</style>


	<h2 class="post-title" align="center">Registrars - Principal Seat</h2><br>
			<article class="group post-1222 page type-page status-publish hentry">
				
									
				<div class="entry" align="center">
					

<table id="example" width="100%" class="display responsive">
  <caption></caption>
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:30%">Name</th>
      <th style="width:30%">Designation</th> 
	  <th style="width:20%">Phone/Fax(F)<br></th>
 
	 
	   
    </tr>
  </thead>
  <tbody>
  <?php 
	 
 $qry_reg = $DB_con->query("SELECT officer_designation .desig,registrars  .* FROM registrars  inner join officer_designation on officer_designation.sno=cast(registrars.reg_desig as integer) where trim(reg_place)='MHC' and registrars.display='Y'  and online_view=1 order by reg_pl_sen asc");
$i=1;
while ($row_reg = $qry_reg->fetch())
	{
	
	
	 $nam=$row_reg['reg_name'];			
			$desig=$row_reg['desig'];
			$contact=$row_reg['reg_contact_no'];
			$cont_val=explode(",",$contact);
			
			$fax=$row_reg['reg_fax_no'];
			$fax_val=explode(",",$fax);
			$sen=$row_reg['reg_pl_sen'];
		
					
	  ?>
    <tr align="center">
    <td style="width:5%"><?php echo $i; ?></td>
      <td style="width:30%"><img width="75" height="75" src="admin/view_image.php?img_id=<?php echo base64_encode($row_reg['reg_id'])?>&page=<?php echo base64_encode('R'); ?>"  alt="<?php echo $row_reg['reg_prefix'].'.'.$nam;?> photo" id="judge_thumb"/><br><?php echo $row_reg['reg_prefix'].'.'.$nam;?></td>
      <td style="width:30%"  align="left"><?php echo $desig; ?></td>
    <td style="width:20%" align="left">
	<?php 
	for($x=0;$x<count($cont_val);$x++)
	{
		if($cont_val[$x])
		echo $cont_val[$x]."<br>";
	}
	?><?php for($x=0;$x<count($fax_val);$x++)
	{
		if($fax_val[$x])
		echo $fax_val[$x]."(F)<br>";
	}?></td>
    
	  
	  
	  
    </tr>
	
	<?php 
	$i++;
	}?>
  </tbody>
</table>
	</div>
	</article>
	<script>
	$('#example').DataTable({
		"ordering":false,
		pagingType: 'simple',
	});
	</script>
