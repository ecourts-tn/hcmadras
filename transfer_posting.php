<?php 
include"header.php";

?>
<style>
.col-3cm .main-inner {
    background:#fff;

}
#header {
    padding-bottom: 0px;
}
.content {
    
    border-top:none;}
	
.main-inner {
    position: relative;
min-height: 600px; }


.col-3cm .main {
background:None; }



.tabs {
	list-style: none;
	margin-top: 20px;
	margin-right: 0;
	margin-bottom: 0;
	margin-left:0%;   
	text-decoration: none;
			width:100%;
			display:block;
			
    }
		
		.tabs a {
	/* Make them block level
		     and only as wide as they need */
	float: left;
	width:300px;
	padding:5px 10px;
	/* Default colors */ 
	color: #FFFFFF;
	background: #222;
	/* Only round the top corners
	-webkit-border-top-left-radius: 15px;
	-webkit-border-top-right-radius: 15px;
	-moz-border-radius-topleft: 15px;
	-moz-border-radius-topright: 15px; 
	border-top-left-radius: 15px;
	border-top-right-radius: 15px;*/
	font-size: 16px;
	text-decoration: none;
	text-align:center;
		}
		.tabs .activere {
	/* Highest, active tab is on top */
	z-index: 3;
	text-decoration: none;
		}
		.tabs .activere a {
	/* Colors when tab is active 26abd3 #f0ddc4;*/
	 background: #26abd3;
	color: #f0ddc4;

	//text-decoration: underline;		  
		}
		.card {
 
  color: white;
  padding: 1rem;
  height: 1rem;
  font-size:20px;
   background-image: url("images/bg_b.jpg");
}
.card:hover
{
	/*background:#ed4518;*/
	    
   
    background: #26abd3;

 
  } 
.cards {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-gap: 0.5rem;
    font-weight: bold;
}
	</style>
	<script>
	
	
		function transfer()
		{
			$("#repcheck").html("<div align='center'><img src='images/loader.gif'/></div>");
			$.post("transfer_posting_cur.php/", { },
				function(data) {
				//alert(data);
					$("#repcheck").html(data);
				
			});
		}
	function archives()
		{
			$("#repcheck").html("<div align='center'><img src='images/loader.gif'/></div>");
			$.post("transfer_posting_archives.php/", { },
				function(data) {
				//alert(data);
					$("#repcheck").html(data);
				
			});
		}
		$(function() {
			$("#check li").click(function(e) {
			  e.preventDefault();
			  $("#check li").removeClass("activere");
			 $(this).addClass("activere");
			});
		});
	
	</script>
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
	<div class="pad group">
	<div class="cards" id="check">
 <ul class="tabs group" >
	  <li class="activere" ><a  href="javascript:void(0);" onclick="return transfer();"><div class="card"><i class="fa fa-university"></i>&nbsp;&nbsp;Transfer Posting <?php echo date('Y') ?></div></a></li> 
	 <li><a href="javascript:void(0);" onclick="return archives();"><div class="card"><i class="fa fa-gavel"></i>&nbsp;&nbsp;Transfer Posting Archives</div></a></li> 
	  
	  
	</ul></div>
		
	<div class="" align="center">
		<div id="repcheck">
	<br>
		<?php include "transfer_posting_cur.php";?>
		</div>			


					<div class="clear"></div>
				</div><!--/.entry-->			
		
			
		
				
	</div><!--/.pad-->
	
</div><!--/.content-->

<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; ?>
	
		