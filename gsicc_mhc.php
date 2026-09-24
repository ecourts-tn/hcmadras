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
<h2 class="post-title" align="center">Gender Sensitization - I (Madras High Court)</h2>

		<div class="post-list group">
				<div class="post-row">					
	<div class="post-inner post-hover">
		
		<div class="post-thumbnail">
		
									<!--<img width="520" height="245" src="images/gsicc1.jpg" />-->																			
							
					</div><!--/.post-thumbnail-->
		
	
		
		<!--/.post-title-->
		
				<div class="">	
				
			<table  id="example" class="display responsive nowrap" cellspacing="0" width="100%">
			
			 <thead>
  <tr>
      <th>GSICC</th>
      <th>View File</th>
     
    </tr>
  </thead>
  <tbody>
    <?php

	 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='G' AND doc_bench='MHC' order by doc_order ASC");
while($row = $qry->fetch())
{
	
		if($row['doc_new_icon']=='Y')
		{
        $new='<img src="images/new.gif"/ width="20" height="20">';
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
     
      <td>
<?php echo $title.$new; ?> </td>
 <td>
<a href="admin/view_pdf.php?pdf_id=<?php echo $row['doc_id'] ?>&page=D" title="PDF file that opens in a new window" target="_blank" onclick="alert('External Website that opens in a new window')"><?php echo $icon; ?></a></td>
      
	  
	  
    </tr>
<?php
}
?>
    
  </tbody>
</table>
		</div><!--/.entry-->
				
	</div><!--/.post-inner-->	
		


		

</div>
</div>
</div>
</div><!--/.main-inner-->
<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
</div>
	<?php include "footer.php"; ?>

				
