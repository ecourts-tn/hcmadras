<?php
require('config/dbconfig.php');
?>
<script src="js/sweetalert.min.js"></script>
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
		    <th style="width:5%">Date</th>
            <th style="width:80%">File Name</th>
            <th style="width:15%">Click Here</th>
        </tr>
    </thead>
    <tbody>
	<?php
	$cur_dt=date('Y-m-d');
	 $qry = $DB_con->query("select * from announcement where display='Y' order by an_id desc ");
while($row = $qry->fetch())
{
	
		if($row['an_new_icon']=='Y' and $row['an_archive']>=$cur_dt)
		{
        $new='<img src="images/new.gif"/ width="20" height="20">';
		}
		else
		{
		$new='';
		}	
		$date=date('F d, Y',strtotime($row['an_update_date']));
		
		if($row['an_icon_img']=='PDF')
		{
        $icon='<img width="30" height="30" src="admin/images/pdf.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['an_icon_img']=='XLS')
		{
		$icon='<img width="30" height="30" src="admin/images/xlsx.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['an_icon_img']=='IMG')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['an_icon_img']=='DOW')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		?>
        <tr>
		 <td><?php echo $date; ?></td>
           <td><?php echo $row['an_text'].' '.$new; ?></td>
           <td> <form method="POST" action="admin/view_pdf.php" onsubmit="return submitForm(this);" style="margin-top: -120px; " target="_blank">
    <input type="text" name="name" />
	<input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['an_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value="<?php echo base64_encode('A'); ?>" />
    <input type="submit" />
</form></td>
        </tr>
     
		
		<?php
}
?>
    </tbody>
</table>

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