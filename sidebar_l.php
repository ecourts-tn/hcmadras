<?php 
include "config/dbconfig.php";
?>
<div class="sidebar s1 light">
		
		<a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>
		
		<div class="sidebar-content">
			
						
						
			<div id="alxtabs-3" class="widget widget_alx_tabs">
<br>
<h3 class="group"><span><i class="fa fa-star" aria-hidden="true"></i> About Us</span></h3>


	<div class="alx-tabs-container">


		
						
			<ul id="tab-recent-3" class="alx-tab group thumbs-enabled">
				
				
				
				<?php
				 $qry = $DB_con->query("select * from mhc_homepage where display='Y' order by page_order ASC");
while($row = $qry->fetch())
{
	
	//$data= htmlspecialchars_decode($result2['home_desc'], ENT_QUOTES);	
	//$string2 = substr($data, 0, 100);
	
	
	if($row['page_url']!='#')
	{
		if($row['external']=='Y'){
		$alt="swal({title:'Alert',text:'External Website that opens in a new window',type:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$row['page_url']."', '_blank');}})";
				$tab='href="#" onclick="'.$alt.'"';
		
		$data_value='<a '.$tab.' title="'.$row['home_title'].' page " >
															<img width="160" height="160"  src="admin/view_image.php?img_id='.base64_encode($row['h_id']).'&page='.base64_encode('HT').'"  class="attachment-alx-small size-alx-small wp-post-image" alt="'.$row['home_title'].'" /></a>';
		$data_value1='<p class="tab-item-category"><br><a '.$tab.' rel="category tag"   title="'.$row['home_title'].' page2" >'.$row['home_title'].'</p>
						<p class="tab-item-title" style="color: black;">'.$row['short_desc'].' </p></a>
						<p class="tab-item-date"></p>';
		}
		else
		{
				$tab='href="'.$row['page_url'].'" ';
		if($row['ntab']=="N")
		$data_value='<a '.$tab.' title="'.$row['home_title'].' page " >
	
															<img width="160" height="160"  src="admin/view_image.php?img_id='.base64_encode($row['h_id']).'&page='.base64_encode('HT').'"  class="attachment-alx-small size-alx-small wp-post-image" alt="'.$row['home_title'].'" /></a>';
		else
			$data_value='<a '.$tab.' title="'.$row['home_title'].' page " target="_blank">
	
															<img width="160" height="160"  src="admin/view_image.php?img_id='.base64_encode($row['h_id']).'&page='.base64_encode('HT').'"  class="attachment-alx-small size-alx-small wp-post-image" alt="'.$row['home_title'].'" /></a>';
			
		$data_value1='<p class="tab-item-category"><br><a '.$tab.' rel="category tag"   title="'.$row['home_title'].' page2" >'.$row['home_title'].'</p>
						<p class="tab-item-title" style="color: black;">'.$row['short_desc'].' </p></a>
						<p class="tab-item-date"></p>';
		}
	}
	else
	{
		$data_value='<a href="javascript:homedata('.$row['h_id'].')" title="'.$row['home_title'].' page">
															<img width="160" height="160"  src="admin/view_image.php?img_id='.base64_encode($row['h_id']).'&page='.base64_encode('HT').'"  class="attachment-alx-small size-alx-small wp-post-image" alt="'.$row['home_title'].'" /></a>';
		$data_value1='<p class="tab-item-category"><br><a href="javascript:homedata('.$row['h_id'].')" rel="category tag"   title="'.$row['home_title'].'" >'.$row['home_title'].'</p>
						<p class="tab-item-title" style="color: black;">'.$row['short_desc'].'</p></a> 
						<p class="tab-item-date"></p>';
	}
	
	

?>
				
								<li>

										<div class="tab-item-thumbnail">
									<?php
									echo $data_value;

?>									
						
					</div>
					
					<div class="tab-item-inner group">
					<?php
									echo $data_value1;

?>									
					
											</div>

				</li>
				
				<?php
				}
				?>
								<!--<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)" class="jua">
															<img width="160" height="160" title="Judicial Academy" src="images/jace.jpg" class="attachment-alx-small size-alx-small wp-post-image" alt=""/>																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><br><a href="javascript:void(0)" rel="category tag" class="jua" id="back-to-top" rel="bookmark">Judicial Academy</a></p>
						<p class="tab-item-title"><a href="javascript:void(0)" rel="category tag" class="jua" id="back-to-top" rel="bookmark">Ever since its establishment in the year...</a></p>
						<p class="tab-item-date"></p>					</div>

				</li>
								<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)" class="med">
					<img width="160" height="160" src="images/med.jpg" title="Mediation and Conciliation Centre" class="attachment-alx-small size-alx-small wp-post-image" alt=""/>																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><a href="javascript:void(0)" rel="category tag" class="med" id="back-to-top">Mediation and Conciliation Centre</a></p>
						<p class="tab-item-title"><a href="javascript:void(0)" rel="category tag" class="med" id="back-to-top">The Tamil Nadu Mediation and Conciliation...</a></p>
						<p class="tab-item-date"></p>					</div>

				</li>
								<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)" class="tnlsa">
															<img width="160" height="160" src="images/tnlsa.jpg" title="Legal Services Authority" class="attachment-alx-small size-alx-small wp-post-image" alt="" />																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><br><a href="javascript:void(0)" rel="category tag" class="tnlsa" id="back-to-top">Legal Services Authority</a></p>
						<p class="tab-item-title"><a href="javascript:void(0)" rel="category tag" class="tnlsa" id="back-to-top">The Tamil Nadu State Legal Services...</a></p>
						<p class="tab-item-date"></p>					</div>

				</li>
								<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)">
															<img width="160" height="160" src="images/arbit1.jpg" title="Arbitration Centre" class="attachment-alx-small size-alx-small wp-post-image" alt=""  />																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><br><a href="javascript:void(0)" rel="category tag" id="back-to-top" class="med">Arbitration Centre</a></p>
						<p class="tab-item-title"></p>
						<p class="tab-item-date"></p>					</div>

				</li>
								<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)" class="lib">
															<img width="160" height="160" src="images/mhcpp46.jpg" title="Judges Library" class="attachment-alx-small size-alx-small wp-post-image" alt=""  />																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><br><a href="javascript:void(0)" rel="category tag" id="back-to-top" class="lib">Judges Library</a></p>	
						<p class="tab-item-title"></p>
						<p class="tab-item-date"></p>					</div>

				</li>
					<li>

										<div class="tab-item-thumbnail">
						<a href="javascript:void(0)">
															<img width="160" height="160" src="images/sub1.jpg" title="Subordinate Courts" class="attachment-alx-small size-alx-small wp-post-image" alt=""  />																																		</a>
					</div>
					
					<div class="tab-item-inner group">
						<p class="tab-item-category"><br><a href="https://districts.ecourts.gov.in/tn" rel="category tag" target="_Blank" >Subordinate Courts</a></p>	
						<p class="tab-item-title"></p>
						<p class="tab-item-date"></p>					</div>

				</li>-->
											</ul>

		

		
						

		

		
			
			<ul id="tab-comments-3" class="alx-tab group avatars-enabled">
								<li>

											

				</li>
							</ul>

		
			</div>

</div>

<div id="recent-comments-4" class="widget widget_recent_comments">
						
						<ul id="">
						<?php
							 $qry = $DB_con->query("SELECT * FROM mhc_menu WHERE menu='L' AND set_menu='FM' and display='Y' ORDER BY main_menu_order ASC");
while($row = $qry->fetch())
{
						?>
						<li><i class="fa <?php echo $row['class_fun']?>"></i>&nbsp;&nbsp;<a href="<?php echo $row['page_url']?>"  style="color:#646161; font-weight: bold;"  ><?php echo $row['page_name']?></a></li>
						<?php
}

?>
						
						<!--<li class=""><i class="fa fa-folder"></i>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:#646161; font-weight: bold; font-size:13px;" id="back-to-top" class="hc_ru">Rules</a></li>
						<li class=""><i class="fa fa-file"></i>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:#646161; font-weight: bold; font-size:13px;"id="back-to-top" class="hc_rti">RTI</a></li>
						<li class=""><i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:#646161; font-weight: bold; font-size:13px;" id="back-to-top" class="gen_sen">Gender Sensitization</a></li>
						<li class=""><i class="fa fa-forward"></i>&nbsp;&nbsp;<a href="#" style="color:#646161; font-weight: bold; font-size:13px;">Statistics of Commercial Court Cases</a></li>						
						<li class=""><i class="fa fa-calendar"></i>&nbsp;&nbsp;<a href="#" style="color:#646161; font-weight: bold; font-size:13px;">High Court Calendar</a></li>
						<li class=""><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:#646161; font-weight: bold; font-size:13px;"id="back-to-top" class="hc_publi">Publications</a></li>
						<li class=""><i class="fa fa-shield"></i>&nbsp;&nbsp;<a href="#" style="color:#646161; font-weight: bold; font-size:13px;">Security System</a></li>
						<li class=""><i class="fa fa-users"></i>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:#646161; font-weight: bold; font-size:13px;" id="back-to-top" class="hc_citizen">Citzen Charter</a></li>
						<li class=""><i class="fa fa-video-camera"></i>&nbsp;&nbsp;<a href="#" style="color:#646161; font-weight: bold; font-size:13px;">Webcasting</a></li>-->
						</ul>
						</div>

		
	</div>	<!--/.sidebar-content-->
		
	</div><!--/.sidebar-->
	