<?php  
include "header.php";

require('config/dbconfig.php');
?>
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

		<h2 class="post-title" align="center">Rules</h2><br>
	<div >
					

<table id="example" class="display responsive" cellspacing="0" width="100%">
  
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:75%">Rules</th>   
	    <th style="width:20%">View</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
	// $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='R' order by doc_order,doc_f_date DESC");
	$curr_dt=date('Y-m-d');
	 $qry = $DB_con->query("select * from mhc_rules where display='Y' order by rules_order DESC");
while($row = $qry->fetch())
{
		
		//$date=date('F d, Y',strtotime($row['upload_date']));
		$date_exp=date_create($row['upload_date']);
			date_add($date_exp,date_interval_create_from_date_string("7 days"));
			$to_dt= date_format($date_exp,"Y-m-d");
		if($row['rules_new_icon']=='Y')
		{
			if($to_dt>=$curr_dt)
				$new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
			
			else
				$new='';
			
		}
		else
		$new='';
		
        $icon='<img src="admin/images/pdf.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
		
		
		?>
    <tr align="center">
      <td style="width:5%" align="center"><?php echo $i; ?></td>
      <td style="width:75%" align="left"><?php echo $row['rules_title'].$new; ?></td>
   
      <td style="width:20%" align="center"><form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['rules_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("R"); ?>'  />
	   <button type="submit" name="submit" id="submit" style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?><br><?php echo $row['rules_size']; ?> - <?php echo $row['rules_lan']; ?></button>
	  </form></td>
      
	  
	  
    </tr>
    <?php
	$i++;
}

?>
  </tbody>
</table>
					<div class="clear"></div>
				</div>
</div>
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>
