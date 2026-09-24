<?php 
	
require('config/dbconfig.php');
?>
	
	<br>
<table id="example1" class="display responsive nowrap" cellspacing="0" width="100%">
  
  <thead>
    <tr>
     
      <th>Date</th>
      <th>Title</th>
	    <th>View</th>
    </tr>
  </thead>
  <tbody>
    <?php

	 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='S' and order_type='SO' order by doc_order ASC");
while($row = $qry->fetch())
{
	
		if($row['doc_new_icon']=='Y')
		{
        $new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
		}
		else
		{
		$new='';
		}	
		$date=date('F d, Y',strtotime($row['doc_f_date']));
		
		$title =$row['doc_title'].' - ('.$row['doc_size'].') '.$row['doc_lan'];
		
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
    <tr>
     
      <td><?php echo $date; ?></td>
      <td><?php echo $title.$new; ?></td>

      <td>
	  <form method="POST" action="admin/view_pdf.php" target="_blank" style="margin-top: -120px;  ">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['doc_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value="<?php echo base64_encode('D'); ?>" />
	   <button type="submit" name="submit" id="submit" onclick="alert('External Website that opens in a new window')" style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?></button>
	  </form>
	  <!--<a href="admin/view_pdf.php?pdf_id=<?php echo $row['doc_id'] ?>&page=D" title="PDF file that opens in a new window" target="_blank" onclick="alert('External Website that opens in a new window')"><?php echo $icon;?></a>-->
	  </td>
      
	  
	  
    </tr>
    <?php
}
?>
  </tbody>
</table>
<script>
$(document).ready( function () {
    $('#example1').DataTable({
		"ordering":false
	});
	
} );
</script>