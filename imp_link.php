<?php

 include"header.php";

?>

<style>
.col-3cm .main-inner {
    background:#fff;
	
}

.content {
    
    border-top:none;}
	



	</style>
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
	<div class="pad group">
		
				
		
			
			
<div id="comments" class="themeform">
	
	
					<!-- comments open, no comments -->
			
		
		<div id="respond" class="comment-respond">
		<h3 id="reply-title" style="text-align: center;"><u>Important Links</u></h3>
	
		
				 <?php
										

$link_qry = $DB_con->query("select importan_link_title,importan_link_url from mhc_importan_link where  display='Y' order by importan_link_id asc"); 
while($link_result = $link_qry->fetch()){
											
											?>
		<p class="themeform input">
		<label for="username"><a  onclick='swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {

	window.open(
  "<?php echo $link_result['importan_link_url'];?>",
  "_blank" 
);
}});'  ><span class="required">=></span> <?php echo $link_result['importan_link_title'] ?></a></label>
		</p>
		<?php
}
		?>
	</div><!-- #respond -->
	
</div><!--/#comments-->			
				
	</div><!--/.pad-->
	
</div><!--/.content-->
<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; ?>