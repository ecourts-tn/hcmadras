<?php  
include "header_per_test.php";

if(isset($_GET['sear']))
{
	 $sear = $_GET['sear'];
}
else
{
	 $sear ="";
}
?>



<style>


input[type=button].btn-block, input[type=reset].btn-block, input[type=submit].btn-block {
    width: 100%}
.fade {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}
.fade.in {
    opacity: 1;
}

.collapse p{text-align:justify;background: azure;}
.txt_block{
	padding: 10px;
	background: azure;
	margin-top: 10px;
	
}
.collapse {
    display: none;	
	
}
.collapse.in {
    display: block;
}
tr.collapse.in {
    display: table-row;
}
tbody.collapse.in {
    display: table-row-group;
}
.collapsing {
    position: relative;
    height: 0;
    overflow: hidden;
    -webkit-transition-property: height, visibility;
    -o-transition-property: height, visibility;
    transition-property: height, visibility;
    -webkit-transition-duration: .35s;
    -o-transition-duration: .35s;
    transition-duration: .35s;
    -webkit-transition-timing-function: ease;
    -o-transition-timing-function: ease;
    transition-timing-function: ease;
}
.caret {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: 2px;
    vertical-align: middle;
    border-top: 4px dashed;
    border-top: 4px solid\9;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
}


@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    /* font-size: 1.3em; */
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
   /*  border-bottom: 1px solid #ddd;
    display: block;
   /*  font-size: .8em; 
    text-align: right; */
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
  
  .col-md-4{		
		float:left;
		width:20%
	}
	
	.col-md-6{		
	    float:left;
		width:80%
	}
	
	#table_id td{ 
	    text-align:inherit!important; 
		width:95%;
	}
	
    .judge_container{
		margin-top: 20px;
		margin-left: 20px;
	}
	
	.count_text{
		float: left;
        width: 5%;
	}
	.jname_text{
		float: left;
		width: 80%;		
		margin-top: 0px;
		line-height: 20px;
		margin-left: 15px;
	}
  
}

#accordian {
	width: 100%;
	/*margin-left: 300px;*/
	/*color: white;*/
	/*Some cool shadow and glow effect*/
	box-shadow: 0 5px 15px 1px rgba(0, 0, 0, 0.6), 
	/*	0 0 200px 1px rgba(255, 255, 255, 0.5);
	margin-top: 20px;

	margin-bottom: 0;
	margin-left: auto;*/
	font-family: "Roboto Condensed", Arial, sans-serif;
	/*background-color: #32373e;*/
	
}
/*heading styles*/
#accordian h3 {
	/* font-size: 15px; */
	line-height: 34px;
padding-bottom:10px;
	/*padding: 0 10px;*/
	cursor: pointer;
	/*background: #5F9EA0;-/	/*fallback for browsers not supporting gradients*/
	border-top-style: outset;
	border-right-style: outset;
	border-bottom-style: outset;
	border-left-style: outset;	/*background: #003040; 
	background: linear-gradient(#003040, #002535);*/
}
/*heading hover effect*/
#accordian h3:hover {
	text-shadow: 0 0 1px rgba(255, 255, 255, 0.7);
}
/*iconfont styles*/
#accordian h3 span {
	/* font-size: 20px; */
	
	/*margin-right: 10px;*/
	
}
/*list items*/
#accordian li {
	list-style-type: none;
	margin-bottom: 10px;
}
#accordian li  a{
	color: white;
	text-decoration: none;
	
}
/*links*/
#accordian ul ul li  {
	width:98%;
	color: #333;
	text-decoration: none;
	/* font-size: 15px; */
	line-height: 27px;
	display: block;
	padding: 0 2px;
	/*transition for smooth hover animation*/
	transition: all 0.15s;
	 text-align: justify;
	 border: 5px solid #e6e6e6;
	 	background-color: #EFF2E3;
		font-weight:400;
		
}
/*hover effect on links*/
/* #accordian ul ul li a:hover {
	border-left: 5px solid lightgreen;
	background-color: #EFF2E3;
	color: #ddd6d6;
	font-weight: bolder;
} */
/*Lets hide the non active LIs by default*/
#accordian ul ul {
	display: none;
}
#accordian li.active ul {
	display: block;
}

@media screen and (min-width: 993px) {
	.jname {
		margin-top: 30px;
		margin-left: 30px;
		position: absolute;
		font-weight: 400;
	}
	
	.col-md-4{		
		float:left;
	}
	
	.col-md-6{		
	    float:left;
	}
	
	#table_id td{ 
	    text-align:inherit!important; 
		width:95%;
	}
	
    .judge_container{
		margin-top: 20px;
		margin-left: 20px;
	}
	
	.count_text{
		float: left;
        width: 5%;
	}
	.jname_text{
		float: left;
		width: 85%;		
		margin-top: 0px;
		line-height: 20px;
		margin-left: 10px;
	}
	
	
}

@media screen and (max-width: 992px) {
	
	
	.col-md-4{		
		float:left;
		width:20%
	}
	
	.col-md-6{		
	    float:left;
		width:80%
	}
	
	#table_id td{ 
	    text-align:inherit!important; 
		width:95%;
	}
	
    .judge_container{
		margin-top: 20px;
		margin-left: 20px;
	}
	
	.count_text{
		float: left;
        width: 5%;
	}
	.jname_text{
		float: left;
		width: 80%;		
		margin-top: 0px;
		line-height: 20px;
		margin-left: 15px;
	}
	
	#accordian {
	width: 100%;
	margin-left: 0px;
	/*color: white;*/
	/*Some cool shadow and glow effect*/
	box-shadow: 0 5px 15px 1px rgba(0, 0, 0, 0.6), 
	/*	0 0 200px 1px rgba(255, 255, 255, 0.5);
	margin-top: 20px;

	margin-bottom: 0;
	margin-left: auto;*/
	font-family: "Roboto Condensed", Arial, sans-serif;
	/*background-color: #32373e;*/
	
}
		
		
	#accordian h3 {
	/* font-size: 20px; */
	line-height: 34px;
	padding-bottom:50px;
	/*padding: 0 10px;*/
	cursor: pointer;
	/*background: #5F9EA0;-/	/*fallback for browsers not supporting gradients*/
	border-top-style: outset;
	border-right-style: outset;
	border-bottom-style: outset;
	border-left-style: outset;	/*background: #003040; 
	background: linear-gradient(#003040, #002535);*/
}
	#accordian h3 span {
	/* font-size: 15px; */
	margin-right: 10px;
	
}

/* .jname{
	margin-top:20px; 
	margin-left:20px;
	position:absolute;
	font-weight:300;
	
} */

#accordian ul ul li  {
	
	
	color: #333;
	text-decoration: none;
	/* font-size: 15px; */
	line-height: 27px;
	display: block;
	padding: 0 15px;
	/*transition for smooth hover animation*/
	transition: all 0.15s;
	 text-align: justify;
	 border: 5px solid #e6e6e6;
	 	background-color: #EFF2E3;
		font-weight:400;
		width:90%;
		
}

}
/*DEGGERGE --*/
/*.table-1 td{
		background:#daeff5;
		width: -webkit-fill-available;
	}
.table-1 {
	border:1px solid black;
}*/

 #table_id2 table td{
		background:#daeff5;
		width: -webkit-fill-available;
	}

@media only screen and (max-width: 479px)
{
	
	.jname{
		padding-top:20px; 
		margin-left:30px;		
		font-weight:300;		
	}
	
	table td {
		text-align:centre;
		display:inline-block;
		position: relative;		
	}
	
	.popover{
		height:500px;		
	    overflow-y:scroll;
	}
	
	.col-md-4{
		width:30%;
		float:left;
	}
	
	.col-md-6{
		width:70%; 
	    float:left;
	}
	
	#table_id td{ 
	    text-align:inherit!important; 
		width:95%;
	}
	
    .judge_container{
		margin-top: 20px;
	}
	
	.count_text{
		float: left;
        width: 5%;
	}
	.jname_text{
		float: left;
		width: 80%;
		padding-left: 10px;
		margin-top: -7px;
		line-height: 20px;
	}
	
}

@media screen and (max-width: 600px) {
		
		
		#accordian {
	width: 80%;
	margin-left: 0px;
	/*color: white;*/
	/*Some cool shadow and glow effect*/
	box-shadow: 0 5px 15px 1px rgba(0, 0, 0, 0.6), 
	/*	0 0 200px 1px rgba(255, 255, 255, 0.5);
	margin-top: 20px;

	margin-bottom: 0;
	margin-left: auto;*/
	font-family: "Roboto Condensed", Arial, sans-serif;
	/*background-color: #32373e;*/
	
}
		
		
	#accordian h3 {
	/* font-size: 20px; */
	line-height: 34px;
	padding-bottom:50px;
	/*padding: 0 10px;*/
	cursor: pointer;
	/*background: #5F9EA0;-/	/*fallback for browsers not supporting gradients*/
	border-top-style: outset;
	border-right-style: outset;
	border-bottom-style: outset;
	border-left-style: outset;	/*background: #003040; 
	background: linear-gradient(#003040, #002535);*/
}
	#accordian h3 span {
	/* font-size: 15px; */
	margin-right: 10px;
	
}

/* .jname{
	margin-top:20px; 
	margin-left:20px;
	position: absolute;	
	font-weight:300;
	
}
 */
#accordian ul ul li  {
	color: #333;
	text-decoration: none;
	/* font-size: 15px; */
	line-height: 27px;
	display: block;
	padding: 0 15px;
	/*transition for smooth hover animation*/
	transition: all 0.15s;
	 text-align: justify;
	 border: 5px solid #e6e6e6;
	 	background-color: #EFF2E3;
		font-weight:400;
		width:265px;
		
}
}


.fontco{
	
	/* font-size:20px; */ color:#e8471c; 
	margin-right: 10px;
   content: counter(item);
   background: #a62e2e;
  /*border-radius: 100%;*/
   color: white;
   width: 1.2em;
   text-align: center;
   display: inline-block;"
	
}


.profont {
	
	/* font-size:12px; */ color:#cb0909; margin-left:35px;font-weight: bold;
}
}
#table_id{border-top:none!important; border-bottom:none!important;}
#judge_thumb{border-radius: 50%!important; vertical-align: middle;}
#table_id .collapse{
	padding: 10px;
    background: azure;
    margin-top: 10px;
}
	
#table_id {border-collapse: separate;
    border-spacing: 0 1em;}	
table.dataTable thead th, table.dataTable thead td{border-top:none!important; border-bottom:none!important;}

#table_id2 .odd td{background:/*#eee;*/box-shadow: -1px 11px 5px -5px rgba(0,0,0,0.75);
-webkit-box-shadow: -1px 6px 3px -5px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 6px 3px -5px rgba(0,0,0,0.75);}

.even td{background:#fff;box-shadow: -1px 6px 3px -5px rgba(0,0,0,0.75);
-webkit-box-shadow: -1px 6px 3px -5px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 6px 3px -5px rgba(0,0,0,0.75);}

.popover {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1060;
    display: none;
    max-width: 100%;
	
    padding: 1px;    
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: justify;    
    letter-spacing: normal;
    word-break: normal;
    word-spacing: normal;
    word-wrap: normal;
    white-space: normal;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 6px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    line-break: auto
}

.popover.top {
    margin-top: -10px
}

.popover.right {
    margin-left: 10px
}

.popover.bottom {
    margin-top: 10px
}

.popover.left {
    margin-left: -10px
}

.popover-title {
    padding: 8px 14px;
    margin: 0;
    font-size: 14px;
    background-color: #f7f7f7;
    border-bottom: 1px solid #ebebeb;
    border-radius: 5px 5px 0 0
}

.popover-content {
    padding: 9px 14px
}

.popover>.arrow,
.popover>.arrow:after {
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid
}

.popover>.arrow {
    border-width: 11px
}

.popover>.arrow:after {
    content: "";
    border-width: 10px
}

.popover.top>.arrow {
    bottom: -11px;
    left: 50%;
    margin-left: -11px;
    border-top-color: #999;
    border-top-color: rgba(0, 0, 0, .25);
    border-bottom-width: 0
}

.popover.top>.arrow:after {
    bottom: 1px;
    margin-left: -10px;
    content: " ";
    border-top-color: #fff;
    border-bottom-width: 0
}

.popover.right>.arrow {
    top: 50%;
    left: -11px;
    margin-top: -11px;
    border-right-color: #999;
    border-right-color: rgba(0, 0, 0, .25);
    border-left-width: 0
}

.popover.right>.arrow:after {
    bottom: -10px;
    left: 1px;
    content: " ";
    border-right-color: #fff;
    border-left-width: 0
}

.popover.bottom>.arrow {
    top: -11px;
    left: 50%;
    margin-left: -11px;
    border-top-width: 0;
    border-bottom-color: #999;
    border-bottom-color: rgba(0, 0, 0, .25)
}

.popover.bottom>.arrow:after {
    top: 1px;
    margin-left: -10px;
    content: " ";
    border-top-width: 0;
    border-bottom-color: #fff
}

.popover.left>.arrow {
    top: 50%;
    right: -11px;
    margin-top: -11px;
    border-right-width: 0;
    border-left-color: #999;
    border-left-color: rgba(0, 0, 0, .25)
}

.popover.left>.arrow:after {
    right: 1px;
    bottom: -10px;
    content: " ";
    border-right-width: 0;
    border-left-color: #fff
}
.popover-content div{text-align:center;}


[data-content] { table th,td{ border:1px solid #333;}


	</style>

 

	 <script>
	$(document).ready(function(){
//	$("#content").hide();
	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})

$(document).ready( function () {
	
	//
    
	
	
	$('#table_id2').DataTable(
	{
		"ordering":false,
				drawCallback: function() {
					/*   $.fn.popover.Constructor.Default.whiteList.table = [];
    $.fn.popover.Constructor.Default.whiteList.tr = [];
    $.fn.popover.Constructor.Default.whiteList.td = [];
    $.fn.popover.Constructor.Default.whiteList.th = []; */
			$("[data-toggle=popover]").popover({
				sanitize: false,
				
			  });
			
		  }

	});
	
	$('#table_id2').DataTable().search("<?php echo $sear;?>").draw();
	
	//$('[data-toggle="popover"]').popover();
	
} );

</script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
<h2 class="post-title" align="center">Hon'ble Judges</h2><br>
 
 <table id="table_id2"  >
    <thead>
        <tr>
		<td>
		</td>
            <!---<th>Present Hon'ble Judges</th>--->            
        </tr>
    </thead>
    <tbody>
	
	    <?php 	
		$cur=date('Y-m-d');
		//$sno=1;
	$sql1 = $DB_con->query("select * from judges where j_display='Y'  and  j_page='PJ' and j_ret>='".$cur."' order by j_sen asc limit 1");
			
							$sno=1;
							while($row_jud = $sql1->fetch())
							{
								
	$hon="Hon'ble ";
			$sen=$row_jud['j_sen'];
			
			$prefi=$row_jud['j_prefix'];
	$name=$row_jud['j_name'];
$profile=$row_jud['j_profile'];
	$coram=$row_jud['j_coram'];
	$j_type=$row_jud['j_type'];
	if($j_type=='CJ')
	{
		$fjudge=', Chief Justice';
		
	}
	else if($j_type=='ACJ')
	{
		$fjudge=', Acting Chief Justice';
		
	}
	else
	{
		
		$fjudge='';
	}
		/* $id_proof_img = pg_unescape_bytea($row_jud['j_photo']);
								$extension ='jpg';
								$fileId = $row_jud['j_id'].'test';
								$filename1 = $fileId . '.' .$extension;
								$fileHandle = fopen($filename1, 'w');
								fwrite($fileHandle, $id_proof_img);
								fclose($fileHandle); */


	  ?>
	   
        <tr>
            		
           <td>
		   <a name="<?php echo $row_jud['j_id']?>jud"></a>
		   <div class="col-md-4">		   
		   <a tabindex="0" class="prof_pic" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="<b><?php echo $hon.$prefi.".Justice ".$name.$fjudge; ?> </b> " 
   data-content="<div><img src='admin/view_image.php?img_id=<?php echo base64_encode($row_jud['j_id']);?>&page=<?php echo base64_encode('J'); ?>'  width='250' height='250' align='center'></div> <p><?php echo nl2br($row_jud['j_profile']);?></p><br/><button type='button' class='btn btn-primary' data-toggle='popover' style='float:center'>Close</button>"><img style="cursor: pointer;" width="75" height="75" src="admin/view_image.php?img_id=<?php echo base64_encode($row_jud['j_id'])?>&page_id=<?php echo base64_encode('PJ'); ?>&page=<?php echo base64_encode('J'); ?>" title="Click to Enlarge" alt="<?php echo $hon.$prefi.".Justice ".$name.$fjudge; ?>" id="judge_thumb" /></a>
            </div> 
        
			<div class="col-md-6">
			  <div class="judge_container">
				<div class="count_text"><font class="fontco"><?php echo $sno; ?></font></div>				
				<div class="jname_text"><?php echo $hon.$prefi.".Justice ".$name.$fjudge; ?></div>	
				<?php 
				if(strip_tags(html_entity_decode($profile))) {?>
                <font class="profont" data-toggle="collapse" data-target="#<?php echo $row_jud['j_id'];?>" style="cursor: pointer;">Profile</font>				
			  </div>
			</div>
		
		   <div style="clear:both;"></div>
		   <div id="<?php echo $row_jud['j_id'];?>" class="collapse txt_block">
		        <div style="clear:both;"></div>
				<p style="background: azure;"><?php echo nl2br(html_entity_decode($row_jud['j_profile']));?></p>
		   </div>
		<?php }
else
		{ ?>
			<font class="profont" data-toggle="collapse" ></font>	
			<?php
		}?>		   
		   </td>		 
        </tr>
		
       
		<?php
		$sno++;
}
 

  ?>
  
 
    </tbody>
</table>
 
 
 

	</div><!--/.pad-->
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

