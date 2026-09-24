<?php include"header.php";
require('config/dbconfig.php');
?>
<style>




@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
  
	
 
font-weight: bold;
}
main {
  max-width: 1098px;
  margin: 30px auto;
	background: #f2f2f2;
	padding: 30px;
	box-shadow: 0 3px 5px rgba(0,0,0,0.2);
}
input[name=css-tabs] {
  display: none;
}
a {
	color: #F29A77;
}
#tabs {
	padding: 0 0 0 50px;
	width: calc(100% + 50px);
	margin-left: -50px;
	background: #2B2A28;
	height: 80px;
	border-bottom: 5px solid #EB4E01;
	box-shadow: 0 3px 5px rgba(0,0,0,0.2);
	color: white;
}
#tabs::before {
	content: "";
	display: block;
	position: absolute;
	z-index: -100;
	width: 100%;
	left: 0;
	margin-top: 16px;
	height: 80px;
	background: #2B2A28;
	border-bottom: 5px solid #EB4E01;
}
#tabs::after {
	content: "";
	display: block;
	position: absolute;
	z-index: 0;
	height: 80px;
	width: 155px;
	background: #EB4E01;
	transition: transform 400ms;
}
#tabs label {
	position: relative;
	z-index: 100;
	display: block;
	float: left;
  font-size: 11px;
	text-transform: uppercase;
	text-align: center;
	width: 155px;
	height: 100%;
	border-right: 1px dotted #575654;
	cursor: pointer;
}
#tabs label:first-child {
	border-left: 1px dotted #575654;
}
#tabs label::before {
	content: "";
	display: block;
	height: 30px;
	width: 30px;
	background-position: center;
	background-repeat: no-repeat;
	background-size: contain;
	filter: invert(40%);
	margin: 10px auto;
}
#tab1::before {
	background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/106891/paper-plane.png);
}
#tab2::before {
	background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/106891/big-cloud.png);
}


#radio1:checked ~ #tabs #tab1::before, #radio2:checked ~ #tabs #tab2::before{
	filter: invert(100%);
}
#radio1:checked ~ #tabs::after {
	
}
#radio2:checked ~ #tabs::after {
	transform: translateX(156px);
}
#radio3:checked ~ #tabs::after {
	transform: translateX(314px);
}
#radio4:checked ~ #tabs::after {
	transform: translateX(468px);
}
#radio5:checked ~ #tabs::after {
	transform: translateX(626px);
}
#radio6:checked ~ #tabs::after {
	transform: translateX(781px);
}
#radio7:checked ~ #tabs::after {
	transform: translateX(937px);
}
#content {
	position: relative;
	height: 500px;
}
#content::before {
	content: "";
	display: block;
	position: absolute;
	width: 0;
	height: 0;
	margin-left: -50px;
	border-top: 8px solid #000;
	border-right: 10px solid #000;
	border-left: 10px solid transparent;
	border-bottom: 8px solid transparent;
}
#content::after {
	content: "";
	display: block;
	position: absolute;
	width: 0;
	height: 0;
	margin-left: calc(100% + 30px);
	border-top: 8px solid #000;
	border-left: 10px solid #000;
	border-right: 10px solid transparent;
	border-bottom: 8px solid transparent;
}
#content section {
	position: absolute;
	transform: translateY(50px);
	opacity: 0;
	transition: transform 500ms, opacity 500ms;
}
#radio1:checked ~ #content #content1, #radio2:checked ~ #content #content2 {
	transform: translateY(0);
	opacity: 1;
}










/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
  font-family: initial;
  font-weight: bold;
}

#Court {background-color: red;}
#Judge {background-color: green;}

input[type=text], select, textarea {
  width: 30%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;

}



input[type=text], select, textarea {
  width: 30%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;

}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}







	</style>

	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
	<div class="pad group">
	<main>
	<h1 style='text-align:center;font-size:xxx-large;margin-bottom: 28px;'>Transfer Posting</h1>
	<input id="radio1" type="radio" name="css-tabs" checked>
	<input id="radio2" type="radio" name="css-tabs">

	<div id="tabs">
		<label id="tab1" for="radio1">Transfer Posting <?php echo date('Y') ?></label>
		<label id="tab2" for="radio2">Transfer Posting Archives</label>
		
	</div>
	<div id="content">
		<section id="content1">
				
	

<?php include "transfer_posting_cur.php";?>

		</section>
	<section id="content2">
			 
<?php include "transfer_posting_archives.php";?>
		</section>
			
		
			
		
			
	</div>
	
</main>
		
				
	</div><!--/.pad-->
	
</div><!--/.content-->

<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; ?>