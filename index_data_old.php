<style>

.entry b{font-weight:bold;}
</style>
<?php 
include "config/dbconfig.php";
 if(isset($_POST['id']))
						   {
						   $home_qry = $DB_con->query("select h_id,page from mhc_homepage where display='Y' and h_id='".$_POST['id']."'");
						   }
						   else
						   {
							 $home_qry = $DB_con->query("select h_id,page from mhc_homepage where display='Y' and page='H'");   
						   }
		$home_row = $home_qry->fetch();
		$h_id=$home_row['h_id'];
			if(trim($home_row['page'])=='H') {
		?>
					
		
<div class="page-title pad group">

			<h2>&nbsp;&nbsp;Welcome to Madras High Court</h2>

	
</div>
	<div class="pad group">
		
		

	<div class="featured flexslider" id="flexslider-featured">
		<ul class="slides">
		<?php 
		$qry = $DB_con->query("select slider_id from mhc_sliders where slider_display='Y' order by slider_order asc");
		while($row = $qry->fetch())
		{
		?>
				<li>
					<article id="post-3810" class="group post-3810 post type-post status-publish format-image has-post-thumbnail hentry category-travel post_format-post-format-image">	
						<div class="post-inner post-hover">		
							<div class="post-thumbnail">
								<a href="index.php" title="Madras High Court <?php echo$row['slider_id'];?>" alt="<?php echo $row['slider_id'];?>">
									<img width="720" height="340" alt="Madras High Court <?php echo $row['slider_id'];?>" src="admin/view_image.php?img_id=<?php echo$row['slider_id'];?>&page=S"/>
								</a>							
							</div><!--/.post-thumbnail-->
						</div><!--/.post-thumbnail-->
					</article><!--/.post-->
				</li>
				
		<?php
		}
		?>						
		</ul>
		<div style="clear:both;"></div>
		
	</div><!--/.featured-->
<article id="post-3766" class="group post-3766 post type-post status-publish format-image has-post-thumbnail hentry category-featured post_format-post-format-image" style="margin-top:-50px;">	
	                <div class="post-inner post-hover">		
	
						<?php
						
						   if(isset($_POST['id']))
						   {
							$sql1 ="select * from mhc_homepage where display='Y' and h_id ='".$_POST['id']."'";
						   }
						   else
						   {
							   $sql1 ="select * from mhc_homepage where display='Y' and h_id ='30'";
						   }
							$exe1 = pg_query($bd22,$sql1);
							$sno=1;
							while($result2 = pg_fetch_array($exe1))
							{
								
								
								
						?>
							
						
						<div class="entry excerpt">	

                            <!--<img src="<?php //echo $result2['h_id']."test.jpg";?>" width="175" height="100"/>-->
						
							<p>
							<?php			
								  $data= htmlspecialchars_decode($result2['home_desc'], ENT_QUOTES);	
echo str_replace("view_image.php","admin/view_image.php",$data)								  
							?>
							</p>			
		                </div><!--/.entry--><br>
						<?php } ?>
					</div><!--/.post-inner-->	
                </article><!--/.post-->									

	</div><!--/.pad-->
<?php
			}
			else
			{
		?>
<!--/.page-title-->

<br><br>
		<div class="pad group">
					
						
								
				<article id="post-3766" class="group post-3766 post type-post status-publish format-image has-post-thumbnail hentry category-featured post_format-post-format-image" style="margin-top:-50px;">	
	                <div class="post-inner post-hover">		
	
						<?php
						
						   if(isset($_POST['id']))
						   {
							$sql1 ="select * from mhc_homepage where display='Y' and h_id ='".$_POST['id']."'";
						   }
						   else
						   {
							   $sql1 ="select * from mhc_homepage where display='Y' and h_id ='30'";
						   }
							$exe1 = pg_query($bd22,$sql1);
							$sno=1;
							while($result2 = pg_fetch_array($exe1))
							{
								
								
								
						?>
							
						
						<div class="entry excerpt">	

                            <!--<img src="<?php //echo $result2['h_id']."test.jpg";?>" width="175" height="100"/>-->
						
							<p>
							<?php			
								  $data= htmlspecialchars_decode($result2['home_desc'], ENT_QUOTES);	
echo str_replace("view_image.php","admin/view_image.php",$data)								  
							?>
							</p>			
		                </div><!--/.entry--><br>
						<?php } ?>
					</div><!--/.post-inner-->	
                </article><!--/.post-->									

	</div><!--/.pad-->
	<?php
			}
			?>
	
	
	<script type='text/javascript' src='wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
<script type='text/javascript' src='wp-content/themes/kontrast/js/jquery.flexslider.min9dff.js?ver=5.3.2'></script>
	<script type='text/javascript'>

			jQuery(document).ready(function(){
				var firstImage = jQuery("#flexslider-featured").find("img").filter(":first"),
				   checkforloaded = setInterval(function() {
					   var image = firstImage.get(0);
					   /* if (image.complete || image.readyState == "complete" || image.readyState == 4) { */
						   clearInterval(checkforloaded);
						   jQuery("#flexslider-featured").flexslider({
							   animation: "slide",
								useCSS: false, // Fix iPad flickering issue
								directionNav: true,
								controlNav: true,
								pauseOnHover: true,
								animationSpeed: 400,
								smoothHeight: true,
								touch: false,
								slideshow: true,
								slideshowSpeed: 7000,
						   });
					   /* } */
				   }, 20);
				   
				   
				   
			   });
			
</script>