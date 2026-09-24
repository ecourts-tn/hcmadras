
<?php
 include "off_lock.php";

if(!isset($login_session))
{
	header("Location: login.php");
}


if(isset($login_session))
{


 include "admin_header.php";
 
 
 
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
		
				Welcome to Madras High Court
				
				<?php echo $login_session; ?>
		
			
			</div><!--/.pad-->
	
</div><!--/.content-->


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; 

}

?>	
