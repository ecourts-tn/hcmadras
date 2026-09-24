<?php 
session_start(); 


require('config/dbconfig.php');
include "header.php";
include 'fun_class.php';
$getdata =new GETDETAILS($HCMAS_DB);

require_once 'securimage.php';
?>
<style>
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
	
	#contact_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#comments_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	
	#cnr_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#contact_captcha_img{padding:5px 0px 0px 20px}
	#comments_captcha_img{padding:5px 0px 0px 20px}
	#cnr_captcha_img{padding:5px 0px 0px 20px}
	
	@media only screen and (max-width: 479px)
	{
		table td {
			display: block!important;
            text-align: revert!important;          	
		}
		
		table th {
			display: block!important;
            text-align: left!important;
            padding: 15px;	
            font-weight:bold;
            font-size: .8em;			
		}
		
		
	}
	td.hidden-lg,td.hidden-md{ font-weight:bold;}
	
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
	<script>
	

      </script>
	<div class="container" id="page">
		<div class="container-inner">
			<div class="main">
				<div class="main-inner group">
					<div class="content">
						<div class="pad group">
						<div class="post-title"  align="center">
						<div class="card" align="center"><i class=""></i>&nbsp;&nbsp;MADRAS HIGH COURT CASE STATUS</div>
						</div>
						
							<ul class="nav-tabs responsive md-tabs" id="myTab">
								<li class="test-class active waves-effect">
									<a class="deco-none red-class" href="#resp-tab1"><span class="glyphicon glyphicon-cog"></span> Case No. Search</a>
								</li>
								<li class="test-class"><a href="#resp-tab2"><span class="glyphicon glyphicon-headphones"></span> Filing No. Wise Search</a></li>
								<li><a class="deco-none" href="#resp-tab3"><span class="glyphicon glyphicon-folder-open"></span> CNR No. Search</a></li>
								<div style="clear:both;"></div>
							</ul>
							<div class="tab-content" style="float:left;width:100%;">
								<div class="tab-pane active" id="resp-tab1">
									<h2 class="post-title" align="center">  CASE STATUS [ Case No Search ] </h2>
									<div id="comments" class="themeform">
									   <!-- comments open, no comments -->					
										<div id="respond" class="comment-respond">

											<form action="" method="post" id="caseno_searchform"  class="commentform comment-form">
											
												<p class="comment-form-author">
													<label for="case_type_name">Case Type <span class="required">*</span></label>
													<input type="text" name="case_type_name" id="case_type_name" class="form-control" placeholder="Case type" autocomplete="off" >
													<input type="hidden" name="RegCase_type" id="RegCase_type"   class="regcase_numbr form-control">
												</p>
												
												<p class="comment-form-author">
													<label for="RegCase_no">Case No <span class="required">*</span></label> 
													<input type="text" class="form-control" id="RegCase_no" name="RegCase_no" placeholder="Case No" autocomplete="off" onkeypress="return isNumber(event)" required >
												</p>
												
												<p class="comment-form-author">
													<label for="RegCase_year">Year <span class="required">*</span></label> 
													<input type="text" class="form-control" maxlength="4" id="RegCase_year" name="RegCase_year" placeholder="Year" onkeypress="return isNumber(event)" autocomplete="off" required >
												</p>
												<div class="ref">														
													<?php
													
													
													
													  $options1 = array(
														'input_id'   => 'caseno_captcha',     // ID of the text input field
														'input_name' => 'caseno_captcha',        // name of the captcha text field for POST
														'image_id'   => 'contact_captcha_img', // ID of the captcha image
														'namespace'  => 'contact'          // error (or success) to display to the user above text t
													);
													echo Securimage::getCaptchaHtml($options1);													  
													?>
												</div>
												
												<p class="comment-form-author caseno_submit">
													  
													<input name="submit" type="submit" id="submit" class="submit" value="SEARCH"> 
												</p>
												 
												 
												
												<div style="clear:both;"></div>
											</form>
											<div style="clear:both;"></div>
										</div>
									   <!-- #respond -->	
									</div>
									
									 										 
									<div class="" id="caseno_search_result" align="center">  
									

									</div>
									
										
								</div>
								<div class="tab-pane" id="resp-tab2">
									<h2 class="post-title" align="center"> CASE STATUS [ Filing No Search ]   </h2>
									<div id="comments" class="themeform">
										<!-- comments open, no comments -->					
										<div id="respond" class="comment-respond">
											<form action="" method="post" id="filingno_searchform" class="commentform comment-form">
												<p class="comment-form-author">
													<label for="case_type_name_filing">Case Type <span class="required">*</span></label>
													<input type="text" name="case_type_name2" id="case_type_name_filing" class=" form-control " placeholder="Case type" autocomplete="off" required>
													<input type="hidden" name="RegCase_type2 " id="RegCase_type2"   class="regcase_numbr form-control">
												</p>
												<p class="comment-form-author">
													<label for="RegCase_no2">Filing No <span class="required">*</span></label> 
													<input type="text" class="form-control" id="RegCase_no2" name="RegCase_no2" placeholder="Filing No" onkeypress="return isNumber(event)"  autocomplete="off" required >
												</p>
												<p class="comment-form-author">
													<label for="RegCase_year2">Year <span class="required">*</span></label> 
													<input type="text" class="form-control" maxlength="4" id="RegCase_year2" name="RegCase_year2" placeholder="Year" onkeypress="return isNumber(event)"  autocomplete="off" required >
												</p>
												<?php								
												
													$options2 = array(
														'input_id'   => 'filing_captcha',
														'input_name' => 'filing_captcha',
														'image_id'   => 'comments_captcha_img',
														'namespace'  => 'comments'
													);
													echo Securimage::getCaptchaHtml($options2);													  
													?>
												
												<p class="comment-form-author caseno_submit">
													  
													<input name="submit" type="submit" id="submit" class="submit" value="SEARCH"> 
												</p>
												<div style="clear:both;"></div>
											</form>
											<div style="clear:both;"></div>
										</div>
										<!-- #respond -->
									</div>
									
									
									<div class="" id="filingno_search_result" align="center"> 
									</div>
									
								</div>
								<div class="tab-pane" id="resp-tab3">
									<h2 class="post-title" align="center"> CASE STATUS [ CNR No Search ]  </h2>
									<div id="comments" class="themeform">
										<!-- comments open, no comments -->					
										<div id="respond" class="comment-respond">
											<form action="" method="post" id="cnr_searchform" class="commentform comment-form">
												<p class="comment-form-author">
													<label for="case_type_name_cnr"> CNR No. <span class="required">*</span></label>
													<input type="text" name="case_type_name_cnr" id="case_type_name_cnr" class=" form-control" placeholder="CNR No." autocomplete="off" required>
													 
												</p>
												<br><br><br><br>
												<!--<p class="comment-form-author">
													<label for="email" class="captca_label" >Captcha <span class="required">*</span></label> 
													<img src="captcha_cnrno.php" id="captcha_cnr_image">
													<a id="cnrno_cap_reload" href="#" class="btn btn-danger bdrs-50p p-15 lh-0"><i class="fa fa-refresh"></i></a> 
													<input type="text" class="form-control" maxlength="6" id="cnrno_captcha" name="cnrno_captcha" placeholder="Captcha"  autocomplete="off" required >
												</p>-->
												
												<?php								
												
													$options3 = array(
														'input_id'   => 'cnr_captcha',
														'input_name' => 'cnr_captcha',
														'image_id'   => 'cnr_captcha_img',
														'namespace'  => 'cnrform'
													);
													echo Securimage::getCaptchaHtml($options3);													  
													?>
												
												<p class="comment-form-author cnr_submit">
													
													<input name="submit" type="submit" id="submit" class="submit" value="SEARCH"> 
												</p> 
												 
												 
												<div style="clear:both;"></div>
											</form>
											<div style="clear:both;"></div>
										</div>
								   <!-- #respond -->
									</div>
									<div class="" id="cnrno_search_result" align="center">
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
    <link rel='stylesheet' id='roboto-condensed-css'  href='css/ressponsiveDatatablenew.css' type='text/css' media='all' />
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.js"></script>	  
	<script src="js/responsive-tabs.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.responsive.js"></script>
<script>
     function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
	    $(document).ready(function(){
		
		})
	 
	    //captcha reset
		$('#caseno_cap_reload').on('click',function(e){
			
			e.preventDefault();
			d = new Date();
			var src = $("img#captcha_caseno_img").attr("src");
			src = src.split(/[?#]/)[0];
			$("img#captcha_caseno_img").attr("src", src+'?'+d.getTime());
		  
		});
		
		$('#filingno_cap_reload').on('click',function(e){
			
			e.preventDefault();
			d = new Date();
			var src = $("img#captcha_fill_img").attr("src");
			src = src.split(/[?#]/)[0];
			$("img#captcha_fill_img").attr("src", src+'?'+d.getTime());
		  
		});
		
		
		$('#cnrno_cap_reload').on('click',function(e){
			
			e.preventDefault();
			d = new Date();
			var src = $("img#captcha_cnr_image").attr("src");
			src = src.split(/[?#]/)[0];
			$("img#captcha_cnr_image").attr("src", src+'?'+d.getTime());
		  
		});
		
	//captcha reset	
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
	  
	var availableTags = <?php include('filterCaseTypeAll.php'); ?>;
		
	$("#case_type_name,#case_type_name_filing").autocomplete({
		
		source: availableTags,
		autoFocus:true,
		select: function( event, ui ) {
			
			
			$(this).parent().find('input.regcase_numbr').val(ui.item.id);
			 
			  
		}
	});
		
		
		
	//*******case no. search start****	
	
	$("#caseno_searchform").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			//case_type_name: "required",
			RegCase_type: "required",
			RegCase_no: "required",
			RegCase_year: {
				required: true,
				minlength:4,
				maxlength:4
			},
			caseno_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			//case_type_name: "Please select the case type",
			RegCase_type: "Please select the case type",
			
			RegCase_no: "Please enter the case no.",
			RegCase_year: {
				required: "Please enter a year",		
				minlength: "The year shuould be in four digit",
				maxlength: "The year shuould be in four digit"
			},
			caseno_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {			
			
			$("#caseno_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
			
			var posting = $.post( "case_status_result_ftp.php", { case_nme:$("#RegCase_type").val(), case_no :$("#RegCase_no").val(), case_year:$("#RegCase_year").val(),caseno_captcha:$("#caseno_captcha").val()});
			posting.done(function( data ) {
				
                // FOR REFRESH CAPTCHA				
				 contact_captcha_img_audioObj.refresh(); 
				 document.getElementById('contact_captcha_img').src = '/securimage_show.php?namespace=contact&' + Math.random();
				 $("#caseno_captcha").val("");
				
				$("#caseno_search_result").html(data);
								
				
								 
			});
			
			
		}
	});
	//********case no. search ends****	
	
	//******* filing no. search start****	
	
	$("#filingno_searchform").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			RegCase_type: "required",
			RegCase_no: "required",
			RegCase_year: {
				required: true,
				minlength:4,
				maxlength:4
			},
			filing_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			RegCase_type: "Please select the case type",
			RegCase_no: "Please enter the case no.",
			RegCase_year: {
				required: "Please enter a year",		
				minlength: "The year shuould be in four digit",
				maxlength: "The year shuould be in four digit"
			},
			filing_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			$("#filingno_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
			var posting = $.post( "case_status_filing_result.php", { fil_case_nme:$("#RegCase_type2").val(), fil_case_no :$("#RegCase_no2").val(), fil_case_year:$("#RegCase_year2").val(),filing_captcha:$("#filing_captcha").val()});
			posting.done(function( data ) {
				
				// FOR REFRESH CAPTCHA				
				comments_captcha_img_audioObj.refresh(); 
				document.getElementById('comments_captcha_img').src = '/securimage_show.php?namespace=comments&' + Math.random();				
				$("#filing_captcha").val("");
				$("#filingno_search_result").html(data);	
				
			});
			
			
		}
	});
	//********filing no. search ends****	
	
	
	
	//regex for password
	jQuery.validator.addMethod("check_cnrno",function (value, element){
		
		 
		//var password_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,16}$/;
		var password_regex = /^HCMA[0-9]{12}$/;
		var passwrd = $("#case_type_name_cnr").val();
		 	
		 
		if(password_regex.test(passwrd))
		{
			return true;
		} else {
			 return false;
		} 
	},
		"CNR No. doesn't meet the requirement");
	
	//regex for password
	
	
	
	
	//******* cnr no. search start****	
	
	$("#cnr_searchform").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			case_type_name_cnr:{
				check_cnrno :true,
				required :true,
				minlength:16,
				maxlength:16
				
			},				
			cnrno_captcha: {
				required: true,
				minlength: 6,
				maxlength: 6
			}
		},
		// Specify validation error messages
		messages: {
			case_type_name_cnr: "",
			case_type_name_cnr: {
				required: "Please enter the CNR No.",
				minlength: "Your CNR No. must be at least 16 characters long",
				maxlength: "Your CNR No. must not be more than 16 characters long"
			},
			cnr_captcha: {
				required: "Please provide a Captcha",
				minlength: "Your Captcha must be at least 6 characters long",
				maxlength: "Your Captcha must not be more than 6 characters long"
			}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			
			$("#cnrno_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
			
			var posting = $.post( "case_status_cnr_result.php", { cnrno_case_nme:$("#case_type_name_cnr").val(),cnrno_captcha:$("#cnr_captcha").val()});
			posting.done(function( data ) {
								
				// FOR REFRESH CAPTCHA
				cnr_captcha_img_audioObj.refresh(); 
				document.getElementById('cnr_captcha_img').src = '/securimage_show.php?namespace=cnrform&' + Math.random();
				$("#cnr_captcha").val("");
				$("#cnrno_search_result").html(data);
				
			});
			
			
		}
	});
	//******** cnr no. search ends ****
	$(document).ready(function() {
		
		$('#caseno_captcha,#filing_captcha,#cnr_captcha').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && ( keycode == 8 || keycode == 37 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
	  });
	  
</script>