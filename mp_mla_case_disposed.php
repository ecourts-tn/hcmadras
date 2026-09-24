<?php  
include "header.php";

require('config/dbconfig.php');

//$bench=$_GET['bench'];

?>
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

		<h1 class="post-title" align="center">MP MLA Court Cases - Disposed Cases</h1><br>
	<div >
					

<table id="example" class="display responsive" cellspacing="0" width="100%">
  <caption></caption>
  <thead>
    <tr align="center">
      <th style="width:20%">Sl.No.</th>
      <th style="width:60%">Data- Month / Year</th>     
	    <th style="width:20%">View</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
 $curr_dt=date('Y-m-d');
 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='D' order by doc_order desc, doc_f_date desc");
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
		$date=date('F , Y',strtotime($row['doc_f_date']));
		
		//$title =$row['doc_title'].' - ('.$row['doc_size'].') '.$row['doc_lan'];
		if($row['doc_icon']=='PDF')
		{
        $icon='<img width="30" height="30" src="admin/images/pdf.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['doc_icon']=='XLS')
		{
		$icon='<img width="30" height="30" src="admin/images/xlsx.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['doc_icon']=='IMG')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['doc_icon']=='DOW')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		?>
    <tr align="center">
      <td style="width:20%"><?php echo $i; ?></td>
      <td style="width:60%" align="left"><?php echo ucfirst(strtolower($row['doc_title'])).$new; ?></td>     
      <td style="width:20%"> <form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['doc_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("D"); ?>' />
	    <button type="submit" name="submit" id="submit" style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?><br><?php echo $row['doc_size']; ?> - <?php echo $row['doc_lan']; ?></button>
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
