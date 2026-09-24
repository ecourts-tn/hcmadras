	<?php 
	
require('config/dbconfig.php');
?>
<style>
@media only screen and (max-width: 479px)
{
	#Type{
		display:none;
	}
}
</style>

</br>


<table id="example2" class="display responsive" cellspacing="0" width="100%">
    <thead>
        <tr >
		 <th style="width:20%" align="left">Notification</th>
      <th style="width:20%" align="left">Cadre</th>
      <th style="width:40%" align="left">Type</th>
	    <th style="width:20%" align="left">Click Here</th>
        </tr>
    </thead>
    <tbody>
	<?php
	$cur_year=date('Y');
	$curr_dt=date('Y-m-d');
	//echo "select * from mhc_transfer where display='Y' AND notification_year!='".$cur_year."' order by transfer_date DESC";
	 $qry = $DB_con->query("select * from mhc_transfer where display='Y' AND notification_year!='".$cur_year."' order by notification_year desc,transfer_order desc,transfer_date 	 DESC");
while($row = $qry->fetch())
{
	
		
			$date=date('F d, Y',strtotime($row['transfer_date']));
			$date_exp=date_create($row['transfer_date']);
			date_add($date_exp,date_interval_create_from_date_string("7 days"));
			$to_dt= date_format($date_exp,"Y-m-d");
		if($row['new_icon']=='Y')
		{
			if($to_dt>=$curr_dt)
				$new='<img src="images/new.gif"/ alt="new icon" width="30" height="30">';
			
			else
				$new='';
			
		}
		else
		$new='';
		$dd_arr=array();
			$dd = $DB_con->prepare("select * from drop_down where page_id=63  and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
			$transfer_cadre=$dd_arr[$row['transfer_cadre']];
			$transfer_type=$dd_arr[trim(trim($row['transfer_type']))];
		/*if($row['transfer_cadre']=='DJ')
					{
						$transfer_cadre='District Judge';
					}
					else if($row['transfer_cadre']=='CJ')
					{
						$transfer_cadre='Civil Judge';
					}
					else if($row['transfer_cadre']=='SJ')
					{
						$transfer_cadre='Senior Civil Judge';
					}
					else if($row['transfer_cadre']=='AJ')
					{
						$transfer_cadre='Additional Judge';
					}
					
					if(trim($row['transfer_type'])=='T')
					{
						$transfer_type='Transfer';
					}
					else if(trim($row['transfer_type'])=='P')
					{
						$transfer_type='Postings';
					}
					else if(trim($row['transfer_type'])=='R')
					{
						$transfer_type='Promotion';
					}
					else if(trim($row['transfer_type'])=='TP')
					{
						$transfer_type='Transfer and Postings';
					}
					else if(trim($row['transfer_type'])=='PP')
					{
						$transfer_type='Promotion and Postings';
					}
					else if(trim($row['transfer_type'])=='PT')
					{
						$transfer_type='Promotion, Transfer and Postings ';
					}*/
						if($row['icon']=='PDF')
		{
        $icon='<img width="30" height="30" src="admin/images/pdf.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['icon']=='XLS')
		{
		$icon='<img width="30" height="30" src="admin/images/xlsx.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['icon']=='IMG')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		else if($row['icon']=='DOW')
		{
		$icon='<img width="30" height="30" src="admin/images/img.png"/ title="PDF file that opens in new window" width="20" height="20"/>';
		}
		?>
         <tr>
	  <td style="width:20%" align="left"><?php echo $row['notification_no'].'/'.$row['notification_year']; ?></br><?php echo $date; ?></td>
      <td style="width:20%" align="left"><?php echo $transfer_cadre; ?></td>
      <td style="width:40%" align="left"><?php echo $transfer_type; ?></td>

      <td style="width:20%" ><form method="POST" action="admin/view_pdf.php" target="_blank">
	  <input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['transfer_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("T"); ?>' />
	   <button type="submit" name="submit" id="submit" style="cursor: pointer;background-color: white;border: white;"><?php echo $icon ?><br><?php echo $row['trans_doc_lan'];?> - <?php echo $row['trans_doc_size']?></button>
	  </form></td>
        </tr>
     
		
		<?php
}
?>
    </tbody>
</table>

<script type="text/javascript">
		
		  
		$(document).ready(function() {
			
				//$('#example').DataTable();
	
	
    // Setup - add a text input to each footer cell
    $('#example2 thead th').each( function () {
        var title = $(this).text();
		if(title!="Click Here")
        $(this).html( title+'<br><input type="text" class="form-control" id="'+title+'" placeholder="Search '+title+'" size="15"/>' );
    } );
 


     // DataTable
    var table = $('#example2').DataTable({
		"ordering": false,
        initComplete: function () {
            // Apply the search
            this.api().columns([0,1,2]).every( function () {
                var that = this;
 
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search([1,2,3]) !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
	
	
	
	} );
		</script>


