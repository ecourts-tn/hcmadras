

<?php  include "header.php";
require('config/dbconfig.php');
?>
<style>
div b{
	font-weight:600;
}

</style>


<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
			<article class="group post-1222 page type-page status-publish hentry">
				
									
				<div class="entry excerpt">
 
<?php 
					  $stmt=$DB_con->prepare("SELECT * FROM mhc_menu_content WHERE title = 'HELP'");
					  $stmt->execute();
					  if($row=$stmt->fetch())
					  {					 
								$data=htmlspecialchars_decode($row['m_desc'], ENT_QUOTES);
								$data1=str_replace("view_image.php","admin/view_image.php",$data);								  
echo str_replace("view_pdf.php","admin/view_pdf.php",$data1);
					  }
					  ?>
	</div><!--/.pad-->
</div><!--/.content-->
</div>

	<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

