
	
<div class="sidebar s2">
	
	<a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>
	
	<div class="sidebar-content">
		
			
		<div id="alxposts-4" class="widget widget_alx_posts">
			<br>
<h3 class="group"><span><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcements</span></h3>
<ul class="alx-posts group thumbs-enabled">
	<?php 

$cur_dt=date('Y-m-d');
$date=date_create($cur_dt);
date_sub($date,date_interval_create_from_date_string("7 days"));
$prev_dt= date_format($date,"Y-m-d");
	//echo "SELECT * FROM announcement";
	/*$qry_u="select an_id,an_text,an_icon_img,an_update_date,an_new_icon,'A' as title from announcement where display='Y' and an_update_date between '".$prev_dt."' and '".$cur_dt."' union select doc_id as an_id,doc_title as an_text,doc_icon as an_icon_img, doc_f_date as an_update_date,doc_new_icon as an_new_icon,'D' as title from mhc_document where display='Y' and  doc_f_date between '".$prev_dt."' and '".$cur_dt."' union select  an_id, concat(a.an_text,'-',name) as an_text, an_icon_img, an_update_date, an_new_icon, title from(select transfer_id as an_id, concat('Not.-',notification_no,'/',notification_year,'-',name) as an_text,'pdf' as an_icon_img,transfer_date as an_update_date,new_icon as an_new_icon,'T' as title,transfer_type from(select * from mhc_transfer tr where tr.display='Y'  and transfer_date  between '".$prev_dt."' and '".$cur_dt."')b inner join drop_down d on (transfer_cadre = value ) where d.page_id='63' and d.display='Y')a inner join drop_down dd on (a.transfer_type= value ) where dd.display='Y' and dd.page_id='63' union  select rules_id as an_id, rules_title as an_text,'pdf' as an_icon_img,upload_date as an_update_date,rules_new_icon as an_new_icon,'R' as title  from mhc_rules where display='Y' and upload_date between '".$prev_dt."' and '".$cur_dt."' order by  an_update_date desc,title ";
	*/
$qry_u="select  a.* from (select an_label as label,ann_link as link,external_link as elink, an_id,an_text,an_icon_img,an_update_date,an_new_icon,'A' as title,af.create_modify from announcement a inner join announcement_file af on an_id=announc_id  where display='Y' and an_update_date between '".$prev_dt."' and '".$cur_dt."' 	union select '' as label,'' as link,'' as elink,doc_id as an_id,doc_title as an_text,doc_icon as an_icon_img, doc_f_date as an_update_date,doc_new_icon as an_new_icon,'D' as title,create_modify from mhc_document where doc_show_page in( 'S','T') and display='Y' and  doc_f_date between '".$prev_dt."' and '".$cur_dt."')a order by  an_update_date desc ,create_modify  desc ";
	$qry = $DB_con->query($qry_u);
	while($row = $qry->fetch())
{
	
		if($row['an_new_icon']=='Y')
		{
        $new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
		}
		else
		{
		$new='';
		}	
		$date=date('F d, Y',strtotime($row['an_update_date']));	
			
	if($row['an_icon_img']=='PDF'||$row['an_icon_img']=='pdf')
		{
        $icon='<img src="admin/images/pdf.png" alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left "/>';
		}
		else if($row['an_icon_img']=='XLS'||$row['an_icon_img']=='xls')
		{
		$icon='<img  src="admin/images/xlsx.png" alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else if($row['an_icon_img']=='IMG'||$row['an_icon_img']=='img')
		{
		$icon='<img  src="admin/images/img.png" alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else if($row['an_icon_img']=='DOW'||$row['an_icon_img']=='dow')
		{
		$icon='<img  src="admin/images/img.png" alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else $icon="";
	
	  ?>
	
			
			<li>
				
			<div class="post-item-inner group">
				<p class="post-item-title"><?php echo $icon ?>
				<?php if($row['label']!='link'){?>
				<a href="javascript:getpdf2(<?php echo $row['an_id'];?>,'<?php echo $row['title'];?>');" rel="bookmark">
               <?php echo $row['an_text']; ?></a>
				<?php }
				else {
					 if($row['elink']=='Y'){
				   $alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$row['link']."', '_blank');})";
				$tab='href="#" onclick="'.$alt.'"';?>
				<a <?php echo $tab;?> rel="bookmark" >
			  <?php }else {?>
		  <a href="<?php echo $row['link'];?>" rel="bookmark" target="_blank">
			   <?php }
					?>
				
				
				<?php  echo $row['an_text']; ?></a><?php }?>
<span style="position:absolute;width:30px;"><?php echo $new;?></span>	</p>
				<p class="post-item-date"><?php echo $date; ?></p>	</div>

		</li>
			
		<?php  } ?>
		<li>
		<div class="tab-item-avatar">
			<a href="announcement_grid.php" >more ...</a>	
		</div>
		</li>
		</ul>
		<!--/.alx-posts-->

</div>

			<div id="alxtabs-4" class="widget widget_alx_tabs">
<br>
<h3 class="group"><span><i class="fa fa-envelope-open" aria-hidden="true"></i> Sitting  / Standing Orders</span></h3>
	<div class="alx-tabs-container">


		

		
<ul class="alx-posts group thumbs-enabled">
		
			
	<?php 
$cur_dt=date('Y-m-d');
$date=date_create($cur_dt);
date_sub($date,date_interval_create_from_date_string("8 days"));
$check_dt= date_format($date,"Y-m-d");

  $i=1;
	// $qry1 = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='S' and doc_new_icon='Y' and ( doc_to_date>='".$cur_dt."'  or  doc_to_date is null) order by doc_order,doc_f_date DESC");
	
	$qry1 = $DB_con->query("select * from mhc_document where display='Y' and doc_show_page='S' and  doc_to_date>='".$cur_dt."' and doc_f_date<='".$check_dt."' order by doc_order desc,doc_f_date DESC Limit 4");
while($row1 = $qry1->fetch())
{
	
		if($row1['doc_new_icon']=='Y')
		{
        $new='<img src="images/new.gif"/ alt="new icon" width="20" height="20">';
		}
		else
		{
		$new='';
		}	
		$dated=date('F d, Y',strtotime($row1['doc_f_date']));
		
		$title =$row1['doc_title'].' - ('.$row1['doc_size'].') '.$row1['doc_lan'];
		
	if($row1['doc_icon']=='PDF'||$row1['doc_icon']=='pdf')
		{
        $icon1='<img src="admin/images/pdf.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else if($row1['doc_icon']=='XLS'||$row1['doc_icon']=='xls')
		{
		$icon1='<img  src="admin/images/xlsx.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else if($row1['doc_icon']=='IMG'||$row1['doc_icon']=='img')
		{
		$icon1='<img  src="admin/images/img.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
		else if($row1['doc_icon']=='DOW'||$row1['doc_icon']=='dow')
		{
		$icon1='<img  src="admin/images/img.png"/ alt="PDF file that opens in new window" style="width:35px!important;
    height:30px!important;float: left"/>';
		}
	
	  ?>
	
			
			<li>
				
			<div class="post-item-inner group">
				<p class="post-item-title"><a href="javascript:getpdf1(<?php echo $row1['doc_id'];?>);" rel="bookmark"><?php echo $icon1 ?>
<?php echo $title; ?></a><span style="position:absolute;width:30px;"><?php echo $new;?></span>	</p>
				<p class="post-item-date"><?php echo $dated; ?></p>	</div>

		</li>
			
		<?php  } ?>
		
					
		
	
	
	
			<li>

				
				
						<div class="tab-item-avatar">
						<a href="sitting_arrangements.php" />more ...</a>	
			
		</div>

		</li>
					</ul><!--/.alx-posts-->

		
			</div>

</div>	
							
			<div id="alxtabs-4" class="widget widget_alx_tabs">
<br>
<h3 class="group"><span><i class="fa fa-download" aria-hidden="true"></i> Downloads</span></h3>
	<div class="alx-tabs-container">


		

		

		
			
			<ul id="tab-comments-4" class="alx-tab group avatars-enabled">
			
				<?php 


	//echo "SELECT * FROM announcement";
	 $qry2 = $DB_con->query("select * from mhc_downloads where display='Y' order by download_id desc LIMIT 3");
while($row2 = $qry2->fetch())
{
	
				if($row2['new_icon']=='Y')
		{
        $new='<img src="images/new.gif"/ alt="new icon" style="width:35px!important;
    height:25px!important;"/>';
		}
		else
		{
		$new='';
		}	
		$date=date('F d, Y',strtotime($row2['upload_date']));	
		if($row2['down_type']=="link")
					{
						$view='<a  href="'.$row2['down_url'].'" class="btn btn-primary" target="_blank"><img src="admin/images/download_icon.jpg"  class="avatar avatar-96 photo" width="96" height="96" alt="'. $row2['down_title'] .'"></a>';
					}
					else if($row2['down_type']=="pdf")
					{
						 $view="<form method='POST' action='admin/view_pdf.php'   target='_blank'>	<input type='hidden' name='pdf_id' id='pdf_id' value='".base64_encode($row2['download_id'])."'/>	  <input type='hidden' name='page' id='page' value='".base64_encode('O')."' />   	   <button type='submit'   style='cursor: pointer;background-color: white;border: white;' ><img src='admin/images/download_icon.jpg'  class='avatar avatar-96 photo' width='96' height='96' alt='". $row2['down_title'] ."'></button>	   </form>";
	   
	   
	   
						//$view='<a  href="admin/view_pdf.php?pdf_id='.base64_encode($row2['download_id']).'&page='.base64_encode('O').'" class="btn btn-primary" target="_blank"><img src="admin/images/download_icon.jpg"  class="avatar avatar-96 photo" width="96" height="96" alt="'. $row2['down_title'] .'"></a>';
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
	window.open('get_download.php?down_id=".$row2['download_id']."', '_parent');
}});";
						$view='<a  href="#"  class="btn btn-primary" onclick="'.$alt.'" ><img src="admin/images/download_icon.jpg" alt="'. $row2['down_title'] .'  class="avatar avatar-96 photo" width="96" height="96""></a>';
						
					}	
	
	
	  ?>
				<li>

				
					<div class="tab-item-avatar">
					<?php echo $view;?>
							
						</div>
						
						<div class="tab-item-inner group">
														
							<div class="tab-item-comment"><?php echo $row2['down_title']; ?><br>(<?php echo $row2['d_size']; ?>)(<?php echo $row2['d_language']; ?>)<?php echo $new;?><br>for <?php echo $row2['d_app']; ?><br><?php echo $date;?></div>

						</div>
			
		

		</li>
				<?php  } ?>
		
	
	
	
			<li>

				
				
						<div class="tab-item-avatar">
						<a href="downloads_grid.php" />more ...</a>	
			
		</div>

		</li>
					</ul><!--/.alx-posts-->

		
			</div>

</div>				


		
		<!--<div id="alxposts-3" class="widget widget_alx_posts">
		<br>
<h3 class="group"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Location</span></h3>

<ul class="alx-posts group thumbs-enabled">
				<li>

						<div class="post-item-thumbnail">
<div class="mapouter"><div class="gmap_canvas"><iframe width="396" height="315" id="gmap_canvas" src="https://maps.google.com/maps?q=madras%20high%20court%20parrys&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/" title="google map" ></a></div><style>.mapouter{position:relative;text-align:right;height:315px;width:396px;}.gmap_canvas {overflow:hidden;background:none!important;height:315px;width:396px;}</style></div>
		
		</div>

		</li>
		</ul>
		</div>-->
		
	</div><!--/.sidebar-content-->
	
</div><!--/.sidebar-->	
