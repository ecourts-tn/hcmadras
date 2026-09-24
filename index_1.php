<?php 

 include "header.php";?>
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	<?php 	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
		error_reporting( E_ALL );  
include "index_data.php";	
	?>
</div><!--/.content-->
<?php 

include "sidebar_l.php";

ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
		error_reporting( E_ALL );  

?>

<?php include "sidebar_r.php";?>
				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>
