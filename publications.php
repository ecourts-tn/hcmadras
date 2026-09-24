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

		<h2 class="post-title" align="center">Publications</h2><br>
	<div class="entry" align="center" id="content">
					

<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
  <caption></caption>
  <thead>
    <tr>
      <th align='left'>Date</th>
      <th>Title</th>
      <th align='left'>Size</th>
      <th align='left'>Language</th>
	    <th>View</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
  $curr_dt=date('Y-m-d');
 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='P'  order by doc_order DESC");
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
		
		$date1=date('M d, Y',strtotime($row['doc_f_date']));
		//$date=date('F , Y',strtotime($row['doc_f_date']));
		
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
      <td align='left'><?php echo $date1; ?></td>
      <td align='left'><?php echo htmlspecialchars_decode($row['doc_title']).$new; ?></td>
      <td align='left'><?php echo $row['doc_size']; ?></td>
      <td align='left'><?php echo $row['doc_lan']; ?></td>
      <td><form method="POST" action="admin/view_pdf.php" target="_blank"  style="margin-top: -100px;  ">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['doc_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("D"); ?>' />
	   <button type="submit"  style="cursor: pointer;background-color: white;border: white;"><?php echo $icon ?><br><?php echo '('.$row['doc_size'].')'; ?>  <?php echo $row['doc_lan']; ?></button>
	  </form><!--<a href="admin/view_pdf.php?pdf_id=<?php echo $row['doc_id'] ?>&page=D" alt="PDF file that opens in new window" target="_blank" onclick="alert('External Website that opens in a new window')"><?php echo $icon; ?></a>--></td>
      
	  
	  
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
<script>
    function submitForm(form) {
        swal({
            title: "Are you sure?",
            text: "External Website that opens in a new window",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then(function (isOkay) {
            if (isOkay) {
                form.submit();
            }
        });
        return false;
    }
</script>