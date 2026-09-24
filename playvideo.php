<?php 

include"header.php";
include 'fun_class.php';
$getdata =new GETDETAILS($HCMAS_DB);

require_once 'securimage.php';
$filename=base64_decode($_GET['f']);
?>
<style>
.imgcard
{
	font-size: 10px;
    font-weight: bold;
    position: absolute;
    background: rgba(0, 0, 0, 0.4);
    color: #fff;
    padding: 8px;
    line-height: 16px;
    bottom: 0px;
    height: 40px;
}
</style>
	<link href="css/responsive_tab.css" rel="stylesheet">

	  <!-- <link rel="stylesheet" href="css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
    
    <link rel="stylesheet" href="assets/css/style.css">
	<div class="container" id="page">
		<div class="container-inner">
			<div class="main">
				<div class="main-inner group">
					<div class="content">
						<div class="pad group">
							<div class="container-fluid video-player" >
        <div class="container">
            <div class="screen embed-responsive embed-responsive-16by9" style="height:500px">
			 <iframe id="screen" src="videos/<?php echo $filename.'.mp4'?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen style="height:100%"></iframe>
			
            </div>

          
			</div>
			</div>
							
						</div>
					</div>
				</div>
			 <!--/.main-inner-->
			</div>
		  <!--/.main-->
		</div>
	   <!--/.container-inner-->
	</div>
	<!--/.container-->
	
<?php include "footer.php"; ?>

	<script src="js/responsive-tabs.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>


  
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.yu2fvl.js"></script>
    <script src="assets/js/main.js"></script>