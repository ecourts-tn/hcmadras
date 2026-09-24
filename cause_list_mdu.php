<?php 
require('config/dbconfig.php');
require('config/dbconfig_status.php');
include"header_per.php";
include 'fun_class_mdu.php';
require_once 'securimage.php';
$getdata =new GETDETAILS($MDU_HCMAS_DB);
?>
<style>
.main-inner {
    position: relative;
min-height: 600px; }
.col-3cm .main-inner {
    background:none;
	padding-left: 0;
padding-right: 0;
}
	.error{
		color:#820e0e !important;
	}
	
	.caseno_submit{
		padding-top: 38px;
	}
	
	
	.cnr_submit{
		padding-top: 38px;
	}
	
	.captca_label{
		float:left;
		margin-right:20px;
	}
	
	 
	
	
	@media  (max-width: 991px)  
	{
		.cnr_submit,.caseno_submit {
			padding-top: 0px;
		}
		
		  
		
	}
	
	#courtno_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#judgename_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	
	#aorno_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#advname_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#caseno_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#partyname_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#entirecause_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#courtno_captcha_img{padding:5px 0px 0px 20px}
	#judgename_captcha_img{padding:5px 0px 0px 20px}
	#aorno_captcha_img{padding:5px 0px 0px 20px}
	#advname_captcha_img{padding:5px 0px 0px 20px}
	#caseno_captcha_img{padding:5px 0px 0px 20px}
	#partyname_captcha_img{padding:5px 0px 0px 20px}
	#entirecause_captcha_img{padding:5px 0px 0px 20px}
	
.card {
 
  color: black;
  padding: 1rem;
  height: 2rem;
  font-size:20px;
  font-weight: bold;
}
 
  .cards {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-gap: 0.5rem;
}
/* Screen larger than 600px? 2 column */
@media (min-width: 600px) {
  .card { 
  grid-template-columns: repeat(2, 1fr);
  font-size:15px;
  width:300px!important; 
  }


}

/* Screen larger than 900px? 3 columns */
@media (min-width: 900px) {
  .card { grid-template-columns: repeat(3, 1fr);font-size:15px;width: 300px; }
}
</style>
 <link href="css/responsive_tab.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css">

	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
				   <div class="content">
					<div class="pad group">
					<div class="post-title"  align="center">
						<div class="card" align="center"><i class=""></i>&nbsp;&nbsp;MADURAI BENCH CAUSE LIST</div>
						</div>
                       <ul class="nav-tabs responsive md-tabs" id="myTab">
						<li class="test-class active waves-effect">
						  <a class="deco-none red-class" href="#resp-tab1"><span class="glyphicon glyphicon-cog"></span> Court No Search</a></li>
						<li class="test-class"><a href="#resp-tab2"><span class="glyphicon glyphicon-headphones"></span> Hon'ble Judge Name Search</a></li>
						<li><a class="deco-none" href="#resp-tab3"><span class="glyphicon glyphicon-folder-open"></span>A.O.R. No Search</a></li>
						<li><a class="deco-none" href="#resp-tab4"><span class="glyphicon glyphicon-folder-open"></span>Advocate Name Search</a></li>
						<li><a class="deco-none" href="#resp-tab5"><span class="glyphicon glyphicon-folder-open"></span>Case No Search</a></li>
						<li><a class="deco-none" href="#resp-tab6"><span class="glyphicon glyphicon-folder-open"></span>Party Name Search</a></li>
						<!--<li><a class="deco-none" href="#resp-tab7"><span class="glyphicon glyphicon-folder-open"></span>Entire Cause List</a></li>-->
						<div style="clear:both;"></div>
					  </ul>

					  <div class="tab-content" style="float:left;width:100%;">
						<div class="tab-pane active" id="resp-tab1">
						   <h2 class="post-title" align="center">CAUSE LIST [Court No Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form  method="post" id="cause_list_court" class="commentform comment-form">	

										<p class="comment-form-author">
										  <label for="cause_list_dt1">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt1" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off" required onchange="getcourt();">
										</p>										
															
										<p class="comment-form-author">
										  <label for="court_no">Court NO<span class="required">*</span></label>
										  <select type="text" name="court_no" id="court_no" class="form-control"  autocomplete="off" required >
											<option value="" >Choose Court No</option>     
											   
											</select>

										</p>	
										
										<div style="clear:both;"></div>
										<?php	
										$options = array(
											'input_id'   => 'courtno_captcha',
											'input_name' => 'courtno_captcha',
											'image_id'   => 'courtno_captcha_img',
											'namespace'  => 'courtno'
										);
										echo Securimage::getCaptchaHtml($options);													  
										?>
																					
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->			
								</div>
								
								<div class="" id="cause_list_court_no_search" > </div>
								
						</div>
						<div class="tab-pane" id="resp-tab2">
						  <h2 class="post-title" align="center">CAUSE LIST [Hon'ble Judge Name Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form  method="post" id="cause_list_jud" class="commentform comment-form">		
									
									<p class="comment-form-author">
										  <label for="cause_list_dt2">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt2" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off" onchange="getCauseListValue()" required>
										</p>			
										<p class="comment-form-author">
										  <label for="jud_cd">Hon'ble Judge Name<span class="required">*</span></label>
										  <select type="text" name="jud_cd" id="jud_cd" class="form-control"  autocomplete="off" required>
										<option value="" >Choose Hon'ble Judge</option>
      
      
    </select>

										</p>										
										

                                        <div style="clear:both;"></div>
										<?php	
										$options2 = array(
											'input_id'   => 'judgename_captcha',
											'input_name' => 'judgename_captcha',
											'image_id'   => 'judgename_captcha_img',
											'namespace'  => 'judgename'
										);
										echo Securimage::getCaptchaHtml($options2);													  
										?>
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
								<div class="" id="cause_list_jud_search" > </div>
						</div>
						<div class="tab-pane" id="resp-tab3">
						        <h2 class="post-title" align="center">CAUSE LIST [Enrollment No Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form  method="post" id="cause_list_advcd" class="commentform comment-form">		
									<p class="comment-form-author">
										  <label for="cause_list_dt3">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt3" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off" required>
										</p>			
										<p class="comment-form-author">
										  <label for="enroll_id">Enrollment Id<span class="required">*</span></label>
										  <input type="text" name="enroll_id" id="enroll_id" class="form-control" placeholder="Enter Enrollment Id" autocomplete="off" required>
										  <span style="font-weight:bold;color:red!important">Format: MS/123/1900</span>
										</p>																	
										
										
										<div style="clear:both;"></div>
										<?php	
										$options3 = array(
											'input_id'   => 'aorno_captcha',
											'input_name' => 'aorno_captcha',
											'image_id'   => 'aorno_captcha_img',
											'namespace'  => 'aorno'
										);
										echo Securimage::getCaptchaHtml($options3);													  
										?>
										
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
								
								<div class="" id="cause_list_advcd_search" > </div>
						</div>
						
						<div class="tab-pane" id="resp-tab4">
						
						    <h2 class="post-title" align="center">CAUSE LIST [Advocate Name Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form  method="post" id="cause_list_adv_name" class="commentform comment-form">					
									
										<p class="comment-form-author">
										  <label for="cause_list_dt4">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt4" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off"  required>
										</p>
										
                                        	<p class="comment-form-author">
										  <label for="adv_name">Advocate Name<span class="required">*</span></label>
										  <input type="text" name="adv_name" id="adv_name" class="form-control" placeholder="Enter Advocate Name" autocomplete="off" required>
										  </p>
                                          
										<div style="clear:both;"></div>
										<?php	
										$options4 = array(
											'input_id'   => 'advname_captcha',
											'input_name' => 'advname_captcha',
											'image_id'   => 'advname_captcha_img',
											'namespace'  => 'advname'
										);
										echo Securimage::getCaptchaHtml($options4);													  
										?>
										 
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
							<div class="" id="cause_list_adv_search" > </div>
						</div>
						<div class="tab-pane" id="resp-tab5">
						
						    <h2 class="post-title" align="center">CAUSE LIST [Case No Wise Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form  method="post" id="cause_list_case" class="commentform comment-form">					
									
										<p class="comment-form-author">
										  <label for="cause_list_dt5">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt5" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off" required>
										</p>
                                        <p class="comment-form-author">
										  <label for="case_type">Case Type <span class="required">*</span></label>
										  <select type="text" name="case_type" id="case_type" class="form-control" placeholder="Case type" autocomplete="off" required>
										  <option value="">choose Case Type</option>
										   <?php  $stmt = $MDU_HCMAS_DB->prepare("SELECT case_type,type_name,full_form FROM case_type_t where display='Y' ORDER BY case_type");
				 $stmt->execute();				 
				
				while ($row = $stmt->fetch()) 
				{
					
						echo '<option value="'.$row['case_type'].'">'.$row['type_name'].'_'.$row['full_form'].'</option>';
					}
					?>
										  </select>
										 
										</p>
										
										<p class="comment-form-author">
										   <label for="case_no">Case No <span class="required">*</span></label> 
										   <input type="text" class="form-control" id="case_no" name="case_no" placeholder="Case No" autocomplete="off" required>
										</p>
										
										<div style="clear:both;"></div>

										
										<p class="comment-form-author">
										   <label for="case_year">Year <span class="required">*</span></label> 
										   <input type="text" class="form-control" maxlength="4" id="case_year" name="case_year" placeholder="Year"  autocomplete="off" required>
										</p>
										
										
										<div style="clear:both;"></div>
										<?php	
										$options5 = array(
											'input_id'   => 'caseno_captcha',
											'input_name' => 'caseno_captcha',
											'image_id'   => 'caseno_captcha_img',
											'namespace'  => 'caseno'
										);
										echo Securimage::getCaptchaHtml($options5);													  
										?>										
                                        										
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
						<div class="" id="cause_list_caseno_search" > </div>
						</div>
						<div class="tab-pane" id="resp-tab6">
						
						    <h2 class="post-title" align="center">CAUSE LIST [Party Name Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="partyname_list_case" class="commentform comment-form">					
									
										<p class="comment-form-author" >
										  <label for="cause_list_dt6">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt6" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off" required>
										</p>
                                        <p class="comment-form-author">
										  <label for="party_name">Party Name<span class="required">*</span></label>
										  <input type="text" name="party_name" id="party_name" class="form-control" placeholder="Enter Pet./Res.Name" autocomplete="off" required>
										</p>		
										  
										<div style="clear:both;"></div>
										<?php	
										$options6 = array(
											'input_id'   => 'partyname_captcha',
											'input_name' => 'partyname_captcha',
											'image_id'   => 'partyname_captcha_img',
											'namespace'  => 'partyname'
										);
										echo Securimage::getCaptchaHtml($options6);													  
										?> 
										
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
						        <div class="" id="partyname_search" > </div>
						</div>
					<!--	<div class="tab-pane" id="resp-tab7">
						
						    <h2 class="post-title" align="center">CAUSE LIST [Entire Cause List Search ]</h2>				
								<div id="comments" class="themeform">	
												
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="entire_list_case" class="commentform comment-form">					
									
										<p class="comment-form-author" >
										  <label for="cause_list_dt7">Cause List Date<span class="required">*</span></label>
										  <input type="text" name="cause_list_dt" id="cause_list_dt7" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off"  required>
										</p>
																				
										<div style="clear:both;"></div>
										<?php	/*
										$options7 = array(
											'input_id'   => 'entirecause_captcha',
											'input_name' => 'entirecause_captcha',
											'image_id'   => 'entirecause_captcha_img',
											'namespace'  => 'entirecause'
										);
										echo Securimage::getCaptchaHtml($options7);	*/												  
										?>
										                                        																	
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div>
					
								</div>
								
								<div class="" id="entire_cause_list_search" > </div>
						
						</div>-->
					  </div>				
					 
                    </div>
                 </div>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	
	 <?php include "footer.php"; ?>
	  <link rel='stylesheet' id='roboto-condensed-css'  href='css/ressponsiveDatatablenew.css' type='text/css' media='all' />
<script type='text/javascript' src='js/jquery-3.5.1.js'></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.js"></script>	  
	<script src="js/responsive-tabs.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.responsive.js"></script>
	
	<script type='text/javascript' src='js/jquery.dataTables.min.js'></script>
	<script type='text/javascript' src='js/dataTables.rowGroup.min.js'></script>
	<script>
	$(document).ready( function () {
      
          
		//		
		$( 'ul.nav-tabs  a' ).click( function ( e ) {
	  e.preventDefault();
	   $( this ).tab( 'show' );
	});
		
	( function( $ ) {
	  // Test for making sure event are maintained
	  $( '.js-alert-test' ).click( function () {
		alert( 'Button Clicked: Event was maintained' );
	  } );
	  fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
	} )( jQuery );
	  
	$.validator.setDefaults({ 
		ignore: [],
		// any other default options and/or rules
	});


         // AUTOCOMPLETE CASET TYPE SCRIPT
	
		
		
		// DATEPICKER	
		    $( ".datepicker" ).datepicker({
			  dateFormat: "dd-mm-yy",			  
			});
			$(".datepicker").attr('readonly','readonly');  
			
			// JUDGE DATE RANGE
			$("#jud_from_date").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-69:+0", //set the range of years
				dateFormat: 'yy-mm-dd',
				onClose: function (selectedDate, instance) {
					if (selectedDate != '') {
						$("#jud_to_date").datepicker("option", "minDate", selectedDate);
						var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
						date.setMonth(date.getMonth()+3);
						console.log(selectedDate, date);
						$("#jud_to_date").datepicker("option", "minDate", selectedDate);
						$("#jud_to_date").datepicker("option", "maxDate", date);
					}
				}
			});     

			$("#jud_to_date").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-69:+0", //set the range of years
				dateFormat: 'yy-mm-dd',
				onClose: function (selectedDate) {
					$("#jud_from_date").datepicker("option", "maxDate", selectedDate);
				}
			});
			
			// JUDGE DATE RANGE
			$("#from_date").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-69:+0", //set the range of years
				dateFormat: 'yy-mm-dd',
				onClose: function (selectedDate, instance) {
					if (selectedDate != '') {
						$("#to_date").datepicker("option", "minDate", selectedDate);
						var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
						date.setMonth(date.getMonth()+3);
						console.log(selectedDate, date);
						$("#to_date").datepicker("option", "minDate", selectedDate);
						$("#to_date").datepicker("option", "maxDate", date);
					}
				}
			});     

			$("#to_date").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-69:+0", //set the range of years
				dateFormat: 'yy-mm-dd',
				onClose: function (selectedDate) {
					$("#from_date").datepicker("option", "maxDate", selectedDate);
				}
			});
	  
		
	});
	$(function(){
	$('#captcha_reload').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image").attr("src", src+'?'+d.getTime());
	});
});
$(function(){
	$('#captcha_reload1').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image1").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image1").attr("src", src+'?'+d.getTime());
	});
});
$(function(){
	$('#captcha_reload2').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image2").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image2").attr("src", src+'?'+d.getTime());
	});
});

$(function(){
	$('#captcha_reload3').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image3").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image3").attr("src", src+'?'+d.getTime());
	});
});
$(function(){
	$('#captcha_reload4').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image4").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image4").attr("src", src+'?'+d.getTime());
	});
});
$(function(){
	$('#captcha_reload5').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image5").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image5").attr("src", src+'?'+d.getTime());
	});
});
$(function(){
	$('#captcha_reload6').on('click',function(e){
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image6").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image6").attr("src", src+'?'+d.getTime());
	});
});
	$("#cause_list_court").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt1: "required",
			court_no: "required",
			courtno_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt1: "Please select the Cause List Date",
			court_no: "Please select the Court No",
			courtno_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			// REFRESH CAPTCHA				
			
			$("#cause_list_court_no_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			var posting = $.post( "cause_list_court_mdu.php", { cause_list_dt:$("#cause_list_dt1").val(), court_no :$("#court_no").val(),courtno_captcha:$("#courtno_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				courtno_captcha_img_audioObj.refresh();
			document.getElementById('courtno_captcha_img').src = '/securimage_show.php?namespace=courtno&' + Math.random();
			
				$("#cause_list_court_no_search").html(data);
				
			});
			
			
		}
	});
	$("#cause_list_jud").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt2: "required",
			jud_cd: "required",
			judgename_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt2: "Please select the Cause List Date",
			jud_cd: "Please select the Judge Name",
			judgename_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			// REFRESH CAPTCHA				
			
			$("#cause_list_jud_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			var posting = $.post( "cause_list_jud_mdu.php", { cause_list_dt:$("#cause_list_dt2").val(), jud_cd :$("#jud_cd").val(),judgename_captcha:$("#judgename_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				judgename_captcha_img_audioObj.refresh(); 
			document.getElementById('judgename_captcha_img').src = '/securimage_show.php?namespace=judgename&' + Math.random();
			
				$("#cause_list_jud_search").html(data);
			});
			
			
		}
	});
	
	
		$("#cause_list_advcd").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt3: "required",
			enroll_id: "required",
			aorno_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt3: "Please select the Cause List Date",
			enroll_id: "Please select the Enrollment Id",
			aorno_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			$("#cause_list_advcd_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			
			// REFRESH CAPTCHA
			
			var posting = $.post( "cause_list_advcd_mdu.php", { cause_list_dt:$("#cause_list_dt3").val(), enroll_id :$("#enroll_id").val(),aorno_captcha:$("#aorno_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				aorno_captcha_img_audioObj.refresh();
			document.getElementById('aorno_captcha_img').src = '/securimage_show.php?namespace=aorno&' + Math.random();
			
				$("#cause_list_advcd_search").html(data);
			});
			
			
		}
	});
	
	$("#cause_list_adv_name").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt4: "required",
			adv_name: {required: true,
			minlength: 4
			},
			advname_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt4: "Please select the Cause List Date",
			adv_name: {
			required:"Please enter Advocate name",
			minlength:"Please enter minimum 4 characters in Advocate name"},
			advname_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			$("#cause_list_adv_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			
			// REFRESH CAPTCHA
			
			var posting = $.post( "cause_list_adv_name_mdu.php", { cause_list_dt:$("#cause_list_dt4").val(), adv_name :$("#adv_name").val(),advname_captcha:$("#advname_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				advname_captcha_img_audioObj.refresh(); 
			document.getElementById('advname_captcha_img').src = '/securimage_show.php?namespace=advname&' + Math.random();
			
				$("#cause_list_adv_search").html(data);
			});
			
			
		}
	});
	$("#cause_list_case").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt5: "required",
			case_type: "required",
			case_no: "required",
			case_year: "required",
			caseno_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt4: "Please select the Cause List Date",
			case_type: "Please select the Case type",
			case_no: "Please select the Case No",
			case_year: "Please select the Case Year",
			caseno_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			$("#cause_list_caseno_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			
			// REFRESH CAPTCHA
			
			var posting = $.post( "cause_list_case_mdu.php", { cause_list_dt:$("#cause_list_dt5").val(), case_type :$("#case_type").val(),case_no :$("#case_no").val(),case_year :$("#case_year").val(),caseno_captcha:$("#caseno_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				caseno_captcha_img_audioObj.refresh(); 
			document.getElementById('caseno_captcha_img').src = '/securimage_show.php?namespace=caseno&' + Math.random();
			
				$("#cause_list_caseno_search").html(data);
			});
			
			
		}
	});
	
	
	$("#partyname_list_case").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt6: "required",
			party_name:  {
			required: true,
			minlength: 4,
			},					
			partyname_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt6: "Please select the Cause List Date",
			party_name: {
				required:"Please Enter Party Name",	
				minlength: "Please enter atleast 4 characters in Party Name",
			},			
			partyname_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			$("#partyname_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			
						
			var posting = $.post( "cause_list_party_name_mdu.php", { cause_list_dt:$("#cause_list_dt6").val(), party_name :$("#party_name").val(),partyname_captcha:$("#partyname_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				
				// REFRESH CAPTCHA
			partyname_captcha_img_audioObj.refresh();
			document.getElementById('partyname_captcha_img').src = '/securimage_show.php?namespace=partyname&' + Math.random();
				$("#partyname_search").html(data);
				
			});
			
			
		}
	});
	
	
	$("#entire_list_case").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			cause_list_dt7: "required",					
			entirecause_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			cause_list_dt7: "Please select the Cause List Date",				
			entirecause_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			$("#entire_cause_list_search").html("<div align='center'><img src='images/spinner1.gif' width='300' height='300'/></div>");
			
						
			var posting = $.post( "cause_list_entire_mdu.php", { cause_list_dt:$("#cause_list_dt7").val(), entirecause_captcha:$("#entirecause_captcha").val(),submit:$("#submit").val()});
			posting.done(function( data ) {
				
				
			// REFRESH CAPTCHA
			entirecause_captcha_img_audioObj.refresh();
			document.getElementById('entirecause_captcha_img').src = '/securimage_show.php?namespace=entirecause&' + Math.random();
				$("#entire_cause_list_search").html(data);
			});
			
			
		}
	});
	
	function getcourt() {
		
		var cause_list_date=$('#cause_list_dt1').val();
		
				if (cause_list_date!='') {
			
					$.ajax({
				
				method: "POST",
				url: "action.php",
				data: {
					action:'getmducourt',
						cause_list_dt:cause_list_date
				},
				success: function(data)
				{
						
					
						
						$('#court_no').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}
			
function getCauseListValue()
	{
		if($("#cause_list_dt2").val()){
			$("#jud_cd").html('');
		var jud_list=$.post("get_jud_list.php",{getCauseListValue:true,bench:'MDU',cause_date:$("#cause_list_dt2").val()});
		jud_list.done(function( data ) {		
			
		$("#jud_cd").append(data);
		});
		}
		
	
		
		
	}
	$(document).ready(function() {
		
		$('#courtno_captcha,#judgename_captcha,#aorno_captcha,#advname_captcha,#caseno_captcha,#partyname_captcha,#entirecause_captcha').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && ( keycode == 8 || keycode == 37 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
	  });
	  
</script>

