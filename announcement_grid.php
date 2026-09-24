
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
	});
	
	
	})

      </script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

<h2 class="post-title" align="center" >Announcements  Archives</h2><br>
 

<div class="post-inner post-hover">
<div class="">

	


<div class="">


<table id="example1" class="display responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
		    <th style="width:15%">Date</th>
            <th style="width:70%">Document</th>
            <th style="width:15%">Click Here</th>
        </tr>
    </thead>
    <tbody>
	<?php
	$cur_dt=date('Y-m-d');
	 $qry = $DB_con->query("select * from announcement where display='Y' order by an_order desc");
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
		$date=date('M d, Y',strtotime($row['an_update_date']));
		
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
		else
			$icon="";
		?>
        <tr >
		 <td align="left"><?php echo $date; ?></td>
           <td align="left"><?php echo $row['an_text'].' '.$new; ?></td>
		   <?php if($row['an_label']!='link'){?>
          <td valign="middle" > <form method="POST" action="admin/view_pdf.php"   target="_blank">
    
	<input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['an_id']); ?>"/>
	  <input type="hidden" name="page" id="page" value='<?php echo base64_encode("A"); ?>' />
   	   <button type="submit"   style="cursor: pointer;background-color: white;border: white;"><?php echo $icon;?><br><?php echo '('.$row['an_pdf_size'].') '.$row['an_pdf_lanuage'];?></button>
	   </form></td>
		   <?php } else {
			   if($row['external_link']=='Y'){
				   $alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$row['ann_link']."', '_blank');}})";
				$tab='href="#" onclick="'.$alt.'"';?>
				<td align="center" ><a <?php echo $tab;?>  ><span style='text-align:center;cursor: pointer;font-weight:bold'>View</span></a></td>
			  <?php }else {?>
		   <td align="center" ><a href="<?php echo $row['ann_link'];?>"  target="_blank"><span style='text-align:center;cursor: pointer;font-weight:bold'>View</span></a></td>
			   <?php }}	?>
		   
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
	 $('#example1 thead th').each(function () {
        var title = $(this).text();
		if(title!="Click Here")
        $(this).html(title+'<br><input type="text" id="'+title+'" placeholder="Search ' + title + '" size="12"/>');
    });
    var table = $('#example1').DataTable({
		"ordering":false,
		pagingType: 'simple',
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.header()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
	
</script>
