<?php  
include "header.php";

require('config/dbconfig.php');

//$bench=$_GET['bench'];

?>
<style>

#output_segment{
	display:flex;
	font-weight:bold;
	padding: 20px;
	background: #ffffff;
	width:90%;
	height:100%;
	 border:2px solid #A7C7E7;
}
.container1 {
  display: flex;
  gap: 20px;
  padding: 20px;
}

/* Segment card style */
.segment {
  flex: 1;
  padding: 20px;
  border-radius: 16px;
  background: #ffffff;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

/* Optional colors */
.left {
  background: #f9f9f9;
  border:2px solid #A7C7E7;
}
.right {
  background: #eef5ff;
  border:2px solid #A7C7E7;
}


@media (max-width: 768px) {
  .container1 {
    flex-direction: column;
  }
}
</style>

<div class="container1">
  <div class="segment left">
  <div class="container-inner">	
<!--<div class="content">
-->
<div class="pad group">

		<h2 class="post-title" align="center">BAR COUNCIL ELECTION</h2><br>
	<div >
					

<table id="example" class="display responsive" cellspacing="0" width="100%">
  <caption></caption>
  <thead>
    <tr align="center">
      <th style="width:5%">S.No.</th>
      <th style="width:25%">Date</th>
      <th style="width:60%" >Title</th>  	  
      <th style="width:10%" >View</th>  	  
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
    $curr_dt=date('Y-m-d');
  //$bench='J01IQycsJ01EVScsJ1RIQyc=';
 $qry = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='J' and doc_bench in ('MHC','MDU','THC') order by  doc_f_date desc,doc_order desc");
while($row = $qry->fetch())
{
	
		if($row['doc_new_icon']=='Y')
		{
			if($row['doc_to_date']){
			if($row['doc_to_date']>=$curr_dt)
				$new='<img src="images/new.gif"/ width="20" height="20">';
			}
			else
				$new='';
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
      <td style="width:5%"><?php echo $i; ?></td>
      <td style="width:25%"><?php echo date('d-m-Y', strtotime($row['doc_f_date'])); ?></td>
      <td style="width:60%" align="left"><?php echo $row['doc_title'].$new; ?></td>
      <td style="width:10%">
	  <a href="javascript:getpdf2(<?php echo $row['doc_id'];?>,'<?php echo 'D';?>');" rel="bookmark"  onclick="document.getElementById('top')
   .scrollIntoView({ behavior: 'smooth' }); ">
               <?php echo $icon;?></a></td>     
      
      
	  
	  
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
<!--</div>-->
  </div> </div>
<div id="top"></div>
  <div  class="segment right">
  <div class="content">

<div class="pad group">
   <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
        </div>
      
 </div>  
  </div>
</div>  </div>
</div>

	

<?php include "footer.php"; ?>
