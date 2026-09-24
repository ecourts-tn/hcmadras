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

		<h2 class="post-title" align="center">e-Filing Tutorial </h2><br>
	<div >
					

<table id="example" class="display responsive" cellspacing="0" width="100%">
  
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:75%">Title</th>   
	    <th style="width:20%">View</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
	 $qry = $DB_con->query("SELECT video_title, video_url
FROM mhc_videos
WHERE video_type = 'F'
ORDER BY video_order desc");
while($row = $qry->fetch())
{	
		
/*
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
		}*/
		
		?>
    <tr align="center">
      <td style="width:5%"><?php echo $i; ?></td>
      <td style="width:75%"><?php echo $row['video_title']; ?></td>
   
      <td style="width:20%"><a href="<?php echo $row['video_url']; ?>" target="_blank">Click Here</a></td>
      
	  
	  
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
