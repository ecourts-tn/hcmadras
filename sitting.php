	<?php 
	
require('config/dbconfig.php');
?>
<style>

@media only screen and (max-width: 479px)
{
	#Description{
		display:none;
	}
}
</style>
	<br>
<table id="example1" class="display responsive" cellspacing="0" width="100%">
  
  <thead >
    <tr >
      <th width="20%" align="left">Date</th>	   
	   <th width="15%" align="left">Location</th>
      <th width="45%" align="left">Description</th>
     <th width="20%">Click Here</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$dd = $DB_con->prepare("select * from drop_down where page_id=59   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
  $i=1;
  $curr_dt=date('Y-m-d');
  $prev_dt=date('Y-m-d',strtotime("-7 days"));
  $new='';
	 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='S' order by doc_order Desc,doc_f_date desc");
while($row = $qry->fetch())
{
	$to_dt=$row['doc_to_date'];
		if($row['doc_new_icon']=='Y')
		{
        if($to_dt){
			if($to_dt>=$curr_dt){
				$new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
				//$new='<img src="images/new.gif"/ width="20" height="20">';
			}
			else
				$new='';
			}
			else if ($row['doc_f_date']>=$prev_dt)
				$new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
			else
				$new="";
		}
		else
		{
		$new='';
		}		
		$date=date('M d, Y',strtotime($row['doc_f_date']));
		
		if($row['order_type']=='NO')
			$otype='';
		else
			$otype=$dd_arr[$row['order_type']];
		
		if($row['doc_bench']=='THC')
		{
			$row['doc_bench']="MHC & MDU";
		}
		
		$title =$row['doc_title'];
		
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
    <tr >
     <td width="20%" align="left"><?php echo $date; ?><br><?php echo $otype; ?></td>
	 
<td width="15%" align="Center"><?php echo $row['doc_bench']; ?></td>
     <td width="45%" align="left"><?php echo $title.$new; ?></td>

      <td width="20%" valign="top" >
	  <form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['doc_id']); ?>"/>
	  <input type="hidden" name="page" id="page"  value='<?php echo base64_encode("D"); ?>'  />
	   <button type="submit"  style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?><br><?php echo $row['doc_size'];?>-<?php echo $row['doc_lan'];?></button>
	  </form>
	  <!--<a href="admin/view_pdf.php?pdf_id=<?php echo $row['doc_id'] ?>&page=D" title="PDF file that opens in a new window" target="_blank" onclick="alert('External Website that opens in a new window')"><?php echo $icon;?></a>--></td> 
	  
	  
    </tr>
  <?php
}

?>
  
  
  </tbody>
</table>
<script>
$(document).ready( function () {
       $('#example1 thead th').each( function () {
        var title = $(this).text();
		if(title!="Click Here")
        $(this).html( title+'<br><input type="text" class="form-control" id="'+title+'" placeholder="Search '+title+'" size="15" />' );
    } );
 


     // DataTable
    var table = $('#example1').DataTable({
		"ordering": false,
        initComplete: function () {
            // Apply the search
            this.api().columns([0,1,2]).every( function () {
                var that = this;
 
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search([0,1,2]) !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
	
} );
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