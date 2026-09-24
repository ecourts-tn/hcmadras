<?php 

include"header.php";
include 'fun_class.php';
$getdata =new GETDETAILS($HCMAS_DB);

require_once 'securimage.php';
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
			<?php
						    
							$sql1 ="select * from mhc_videos where display='Y' and video_type ='M'";
							$exe1 = pg_query($bd22,$sql1);
							$sno=1;
							if($result2 = pg_fetch_array($exe1))
							{
								?>
                <iframe id="screen" src="<?php echo $result2['video_url'] ?>?rel=0" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen style="height:100%"></iframe>
					<?php
							}
							?>
            </div>

            <div class="play-list">
                <div class="owl-carousel owl-carousel4 owl-theme">
				<?php
						   
							$sql2 ="select * from mhc_videos where display='Y' and video_type ='S'";
							$exe2 = pg_query($bd22,$sql2);
							
							while($result3 = pg_fetch_array($exe2))
							{
							
								
								?>
                    <div>
                        <div class="card"><span class="imgcard" ><?php echo $result3['video_title'];?> </span><img  class="card-img link-img" data-link="<?php echo str_replace("https://youtu.be/","https://www.youtube.com/embed/",$result3['video_url']) ?>?rel=0" src="admin/view_image.php?img_id=<?php echo base64_encode($result3['video_id']);?>&page=<?php echo base64_encode('V')?>"
                                alt="" style='height: 120px;'>
                        </div>
                    </div>
					<?php
							}
							?>
                    <!--<div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/rMT8CffVFMk" src="images/vimg2.jpg"
                                alt="" style='height: 120px;'>

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/67lbBuIozXE" src="images/mdu_1.jpg"
                                alt="" style='height: 120px;'>

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/wkYUcMCNSNs" src="images/mdu_lib.jpg"
                                alt="" style='height: 120px;'>

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/7yoqm-kgKEk" src="images/jace.jpg"
                                alt="">

                        </div>
                    </div>-->
                </div>
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