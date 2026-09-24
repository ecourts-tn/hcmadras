
<?php  
include "header.php";
require('config/dbconfig.php');
?>



	 <script>
	$(document).ready(function(){
//	$("#content").hide();
	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
	
})


      </script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

<h2 class="post-title" align="center" >Downloads</h2><br>
 

<div class="post-inner post-hover">
<div class="">

	


<div class="">


<table id="example" class="display responsive no-footer dtr-inline" cellspacing="0" width="100%" style="text-align:center">
    <thead>
        <tr align='left'>
		<th align='left'>Date</th>
            <th align='left'>Title</th>
            <th align='left'>Size</th>
            <th align='left'>Language</th>
            <th align='left'>Application</th>
            <th>Click Here</th>
        </tr>
    </thead>
    <tbody>
	<?php
	$curr_dt=date('Y-m-d');
	 $qry = $DB_con->query("select * from mhc_downloads where display='Y' order by download_id desc");
while($row = $qry->fetch())
{
	
			
		$date=date('M d, Y',strtotime($row['upload_date']));
		$date_exp=date_create($row['upload_date']);
			date_add($date_exp,date_interval_create_from_date_string("7 days"));
			$to_dt= date_format($date_exp,"Y-m-d");
		if($row['new_icon']=='Y')
		{
			if($to_dt>=$curr_dt)
				$new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
			
			else
				$new='';
			
		}
		else
		$new='';
		if($row['down_type']=="link")
					{
						$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$row['down_url']."', '_blank');}})";
						
						$view='<a  href="#" class="btn btn-primary" onclick="'.$alt.'"><img src="admin/images/download_icon.jpg" width="40" height="40" alt="'. $row['down_title'] .'"></a>';
					}
					else if($row['down_type']=="pdf")
					{
						//$view='<a  href="admin/view_pdf.php?pdf_id='.base64_encode($row['download_id']).'&page='.base64_encode('O').'" class="btn btn-primary" target="_blank"><img src="admin/images/download_icon.jpg" width="40" height="40" alt="'. $row['down_title'] .'"></a>';
						$view='<form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['download_id']).'"/>
	  <input type="hidden" name="page" id="page" value="'.base64_encode("O").'" />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;background-color: white;border: white;"><img src="admin/images/download_icon.jpg" width="40" height="40" alt="'. $row['down_title'] .'"></button>
	  </form>';
					}
					else
					{
						$alt="swal({
  title: 'Are you sure?',
  text: 'Do you want to download this file!',
  icon: 'warning',
  buttons: true,
  closeOnConfirm: false,dangerMode: false,
}).then((isDownload)=>{if (isDownload) {
	window.open('get_download.php?down_id=".$row['download_id']."', '_parent');
}});";
						$view='<a  href="#"  class="btn btn-primary" onclick="'.$alt.'" ><img src="admin/images/download_icon.jpg" width="40" height="40" alt="'. $row['down_title'] .'"></a>';
						
					}
					/*<a href="admin/view_pdf.php?pdf_id=<?php echo base64_encode($row['download_id']) ?>&page=<?php echo base64_encode('O') ?>"  target="_blank"  title="<?php echo $row['down_title'] ?>"> <img src="admin/images/download_icon.jpg" width="30" height="30" alt="<?php echo $row['down_title'] ?>"></a>*/
		?>
        <tr>
		 <td align='left'><?php echo $date; ?></td>
           <td align='left'><?php echo $row['down_title'].$new; ?></a></td>
		   
           <td align='left'><?php echo $row['d_size']; ?></td>
           <td align='left'><?php echo $row['d_language']; ?></td>
           <td align='left'><?php echo $row['d_app']; ?></td>
    <td><?php echo $view;?></td>
        </tr>
     
		
		<?php
}
?>
    </tbody>
</table>


   <div class="clear"></div>

</div>
</div>
</div>
 
 
</div><!--/.pad-->
</div><!--/.content-->


 <link href="css/sweetalert.min.css" rel="stylesheet">

<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

