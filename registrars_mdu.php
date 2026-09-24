<?php  
include "header.php";
if(isset($_GET['sear']))
{
	 $sear = $_GET['sear'];
}
else
{
	 $sear ="";
}

?>

<style>
#judge_thumb{border-radius: 50%!important; vertical-align: middle;}
td {
           
            word-wrap: break-word;
			
        }
</style>

<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
	<h2 class="post-title" align="center">Registrars - Madurai Bench</h2><br>
			<article class="group post-1222 page type-page status-publish hentry">
				
									
				<div class="entry" align="center" >
					

<table id="example" width="100%" class="display responsive">
  <caption></caption>
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:30%">Name</th>
      <th style="width:30%">Designation</th> 
	  <th style="width:20%">Phone/Fax<br></th>
 
	 
	   
    </tr>
  </thead>
  <tbody>
  <?php 
	 
 //$qry_reg = $DB_con->query("SELECT * FROM registrars where trim(reg_place)='MDU' and display='Y' order by reg_pl_sen asc");
 $qry_reg = $DB_con->query("SELECT officer_designation .desig,registrars  .* FROM registrars  inner join officer_designation on officer_designation.sno=cast(registrars.reg_desig as integer) where trim(reg_place)='MDU' and registrars.display='Y'  and online_view=1 order by reg_pl_sen asc");
$i=1;
while ($row_reg = $qry_reg->fetch())
	{
	
	
	 $nam=$row_reg['reg_name'];			
			$desig=$row_reg['reg_desig'];
			$contact=$row_reg['reg_contact_no'];
			$cont_val=explode(",",$contact);
			$fax=$row_reg['reg_fax_no'];
			$sen=$row_reg['reg_pl_sen'];
			$desig=$row_reg['desig'];
	/*$select_qry = $DB_con->query("select sno,desig from officer_designation where display='Y' and sno=:reg_desig order by sno asc");
	$select_qry->bindParam(':reg_desig',$row_reg['reg_desig']);
	$select_qry->execute();
					$get_row = $select_qry->fetch();*/
					
					
					
	  ?>
    <tr align="center">
      <td style="width:5%"><?php echo $i;?></td>
      <td style="width:30%"><img width="75" height="75" src="admin/view_image.php?img_id=<?php echo base64_encode($row_reg['reg_id'])?>&page=<?php echo base64_encode('R'); ?>"  alt="<?php echo $row_reg['reg_prefix'].'.'.$nam. ' photo';?>" id="judge_thumb" /><br><?php echo $row_reg['reg_prefix'].'.'.$nam;?></td>
      
      <td style="width:30%" align="left"><?php echo $desig; ?></td>
      <td style="width:20%" align="left"><?php echo $cont_val[0];?><br><?php echo $cont_val[1];?><br><?php echo $cont_val[2];?><br><?php echo $fax;?><?php if ($fax!=''){
		echo '(F)';
	}else { echo '';} ?></td>
	  
	  
	  
    </tr>
	
	<?php 
	$i++;
	}?>
  </tbody>
</table>
	</div>
	</article>

</div><!--/.pad-->
</div><!--/.content-->

	<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

