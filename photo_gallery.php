<?php include"header.php";?>
<style>
.main-inner {
    position: relative;
min-height: 600px; }
.col-3cm .main-inner {
    background:none;
	padding-left: 0;
padding-right: 0;
}

.col-3cm .main {
background:None; }

.card {
 
  color: white;
  padding: 1rem;
  height: 2rem;
  font-size:20px;
   background-image: url("images/bg_b.jpg");
}
.card:hover
{
	/*background:#ed4518;*/
	    
   
    background: #f77300;

 
  } 
  
.cards {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-gap: 0.5rem;
}

/* Screen larger than 600px? 2 column */
@media (min-width: 600px) {
  .cards { grid-template-columns: repeat(2, 1fr); }


}

/* Screen larger than 900px? 3 columns */
@media (min-width: 900px) {
  .cards { grid-template-columns: repeat(3, 1fr); }
}


.gallery-title
{
    font-size: 36px;
    color: #0e0e0e;
    text-align: center;
    font-weight: 500;
    margin-bottom: 70px;
	line-height:40px;
}
.gallery-title:after {
    content: "";
    position: absolute;
    width: 7.5%;
    left: 46.5%;
    height: 45px;
    border-bottom: 1px solid #5e5e5e;
}
.filter-button
{
    font-size: 18px;
    border: 1px solid #42B32F;
    border-radius: 5px;
    text-align: center;
    color: #0a0a0a;
    margin-bottom: 30px;
    margin-right: 5px;
	padding:5px;
}
.filter-button:hover
{
    font-size: 18px;
    border: 1px solid #42B32F;
    border-radius: 5px;
    text-align: center;
    color: #ffffff;
    background-color: #42B32F;

}
.btn-default:active .filter-button:active
{
    background-color: #42B32F;
    color: white;
}

.port-image
{
    width: 100%;
}

.gallery_product
{
    margin-bottom: 30px;
}
*{
	padding:0;
	margin:0;
    -webkit-transition: 1s;
    transition: 1s;
}
.clrd-font{
	background: #FF512F;
	background: -webkit-linear-gradient(to right, #F09819, #FF512F);
	background: linear-gradient(to right, #F09819, #FF512F);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
}
.btn-primary {
	background-color:transparent;
	color: #fff;
	border: 2px solid #fff;
	font-size:20px;
	text-transform: uppercase;
	border-radius: 0px;	
}
.btn-primary:hover {
	background-color:transparent;
	border-color: #d6962c;
	color: #d6962c;
	border-radius: 20px;
}

.click-btn{padding: 3px 8px;}

.single_portfolio_text{
	display:inline-block;
	padding:0;
	position:relative;
	overflow:hidden;
}

.single_portfolio_text img{border:1px solid #ddd; padding:5px; border-radius:5px;}


.single_portfolio_text:hover .portfolio_images_overlay{
	top:5%;
	left: 5%;
}

.portfolio_images_overlay{
	width: 75%;
	height: 90%;
	background: rgba(0, 0, 0, 0.8);
	padding: 20px;
	margin: 0 auto;
	top: -100%;
	left: 5%;
	position: absolute;
	transition:.6s;
	
}
.portfolio_images_overlay h6{
	text-transform: uppercase;
	color: #fff;
	font-size: 30px;
	font-weight: 900;
	border: 2px solid #fff;	
	text-align:center;
	line-height: 40px;
	
}

.portfolio_images_overlay .product_price{
	font-size: 35px;
	color: #fff;
	font-weight:800;
	line-height:30px;
}
.portfolio_images_overlay .product_price i{
    margin-right: -10px;
}
.zoom{
	width: 200px;
    height: 200px;
    position: absolute;
    bottom: -100px;
    right: -100px;
    border-radius: 50%;

	background: #FF512F;
	background: -webkit-linear-gradient(to right, #F09819, #FF512F);
	background: linear-gradient(to right, #F09819, #FF512F);
    box-shadow:0px 0px 0px 10px rgba(0,0,0,0.5);
	opacity:0.9;
}
.zoom:before {
	content: "\f00e";
    font-family: FontAwesome;
    color: rgba(255, 255, 255, 0.5);
    font-size: 70px;
    padding-right: 20px;
    position: absolute;
    top: 10px;
    left: 30px;
}


	</style>
	<link href="css/boost.css" rel="stylesheet" id="bootstrap-css">
		
	
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
<div class="pad group">
		
			
									
				 <div class="container">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Madras High Court Photo Gallery</h1>
        </div>

        <div align="center">
            <button class="btn btn-default filter-button" data-filter="all">All</button>
			
			<?php
			$qry = $DB_con->query("select distinct photo_year from mhc_photo where display='Y'   ORDER BY photo_year ASC");
while($row = $qry->fetch())
{
			?>
            <button class="btn btn-default filter-button" data-filter="<?php echo $row['photo_year'] ?>"><?php echo $row['photo_year'] ?></button>
			<?php
}
?>
           <!-- <button class="btn btn-default filter-button" data-filter="sprinkle">2019</button>
            <button class="btn btn-default filter-button" data-filter="spray">2020</button>
            <button class="btn btn-default filter-button" data-filter="irrigation">2021</button>-->
        </div>
        <br/>

	<!--<div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
							<img src="http://i.imgur.com/PUeaHfC.png" alt="" />
							<div class="portfolio_images_overlay text-center">
								<h6 class="clrd-font">Italian Source Mushroom</h6>
								<p class="clrd-font product_price"> <i class="fa fa-usd clrd-font" aria-hidden="true"></i> 12</p>
								<a href="#" class="btn btn-primary">Click here</a>
							</div>
							<a class="fancybox" rel="ligthbox" href="http://i.imgur.com/PUeaHfC.png">
								<div class="zoom"></div>
							</a>
					</div>-->

					<?php
			$qry2 = $DB_con->query("select photo_id,photo_year,photo_title from mhc_photo where display='Y'   ORDER BY photo_year ASC");
while($row2 = $qry2->fetch())
{
			?>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 single_portfolio_text filter <?php echo $row2['photo_year'] ?>">
                <img src="admin/view_image.php?img_id=<?php echo base64_encode($row2['photo_id']) ?>&page=<?php echo base64_encode('P');?>" class="img-responsive" alt="<?php echo $row2['photo_title'] ?>" style="height: 300px;
    width: 400px;">
				<div class="portfolio_images_overlay text-center">
								<h6 class="clrd-font"><?php echo $row2['photo_title'] ?></h6>
								</br>
								<a href="photo_gallery_view.php?photo_id=<?php echo base64_encode($row2['photo_id']) ?>" title="<?php echo $row2['photo_title'] ?>" class="btn btn-primary click-btn">Click here</a>
							</div>
            </div>
<?php
}
?>
            <!--<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>-->
        </div>
    </div>
				
			
			
	
				
	</div><!--/.pad-->
	
</div><!--/.content-->


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<br>
<script>
$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
$(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
</script>
	<?php include "footer.php"; ?>