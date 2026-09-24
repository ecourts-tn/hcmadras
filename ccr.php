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

		<h2 class="post-title" align="center">Case Clearance Rate (CCR)</h2><br>
	<div >
					

<table id="example" class="display responsive" cellspacing="0" width="100%">
  
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:75%">Year</th>   
	    <th style="width:20%">View</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $curr_dt=date('Y-m-d');
  $i=1;
	 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='E' order by doc_order desc,doc_f_date DESC");
while($row = $qry->fetch())
{
	
		if($row['doc_new_icon']=='Y')
		{
			if($row['doc_to_date']){
			if($row['doc_to_date']>=$curr_dt)
				$new='<img src="images/new.gif"/ width="20" height="20">';
			}
			else
				$new='<img src="images/new.gif"/ width="20" height="20">';
			
		}
		else
		{
		$new='';
		}	
		$date=date('F d, Y',strtotime($row['doc_f_date']));
		
       if($row['doc_icon']=='PDF')
		{
        $icon='<img src="admin/images/pdf.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
		}
		else if($row['doc_icon']=='XLS')
		{
		$icon='<img  src="admin/images/xlsx.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
		}
		else if($row['doc_icon']=='IMG')
		{
		$icon='<img  src="admin/images/img.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
		}
		else if($row['doc_icon']=='DOW')
		{
		$icon='<img  src="admin/images/img.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;"/>';
		}
		
		?>
    <tr align="center">
      <td style="width:5%"><?php echo $i; ?></td>
      <td style="width:75%" align="left"><?php echo $row['doc_title'].$new; ?></td>
   
      <td style="width:20%"><form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['doc_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("D"); ?>' />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?><br><?php echo $row['doc_size']; ?> - <?php echo $row['doc_lan']; ?></button>
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
