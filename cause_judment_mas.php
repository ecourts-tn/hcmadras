<?php 
require('config/dbconfig.php');
require('config/dbconfig_status.php');
include"header_per.php";

require_once 'securimage.php';

?>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 200;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 99999;
  cursor: pointer;
  overflow: hidden;
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
	#pdf_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#caseno_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#party_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	
	#judge_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#orddate_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	#pdf_captcha_img{padding:5px 0px 0px 20px}
	#caseno_captcha_img{padding:5px 0px 0px 20px}
	#party_captcha_img{padding:5px 0px 0px 20px}
	#judge_captcha_img{padding:5px 0px 0px 20px}
	#orddate_captcha_img{padding:5px 0px 0px 20px}
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
  width:300px; 
  }


}

/* Screen larger than 900px? 3 columns */
@media (min-width: 900px) {
  .card { grid-template-columns: repeat(3, 1fr);font-size:15px;width: 300px; }
}
.center1 {
    margin: auto;
    width: 100%;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	background-color:white;
}

.hideform {
    display: none;
}
table.dataTable.nowrap th, table.dataTable.nowrap td {
white-space:normal !important;
}
.submit_cap
{
    background: #26abd3;
    color: #fff;
    padding: 8px 14px;
    font-weight: 600;
    display: inline-block;
    border: none;
    cursor: pointer;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
.card3 {
 
  color: white;
  padding: 1rem;
  height: 1.5rem;
  font-size:18px;
     font-weight: bold;
	  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  border:1px solid black;
  background:#42B7E3
}

</style>
 <link href="css/responsive_tab.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css">

<div id="overlay" >
<div class="center1 ">
   <div id="wrapper">
	<div class="pad group">
					<div class="post-title"  align="center">
						<div class="card3" align="center"><i class=""></i>&nbsp;&nbsp;MADRAS HIGH COURT JUDGMENT</div>
						</div>
						 <button id="close" style="float: right;" onclick='close_overlay()'>X</button>
							<form action="#" method="post" id="pdf_cap" class="commentform comment-form">
							<label >Please enter Captcha<span class="required">*</span></label>
    <div style="clear:both;"></div>	
<?php	
										    $options5 = array(
											'input_id'   => 'pdf_captcha',
											'input_name' => 'pdf_captcha',
											'image_id'   => 'pdf_captcha_img',
											'namespace'  => 'pdfform'
										    );
										    echo Securimage::getCaptchaHtml($options5);													  
										?><div style="clear:both;"></div>	
										<div id='pdf_captcha_err' align= 'center' style='color:red;font-size:20px; font-weight: bold;'></div>
										<input type="hidden" name="curr_pdf_rec" id="curr_pdf_rec"  >
										<input type="hidden" name="curr_pdf_tab" id="curr_pdf_tab"  >
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="pdf_submit" class="submit_cap" value="SUBMIT">
										</p>
										<div style="clear:both;"></div></div></div>
										
									 </form>	
</div></div>

	<div class="container" id="page" >
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
				   <div class="content">
					<div class="pad group">
					<div class="post-title"  align="center">
						<div class="card" align="center"><i class=""></i>&nbsp;&nbsp;MADRAS HIGH COURT JUDGMENT</div>
						</div>
                       <ul class="nav-tabs responsive md-tabs" id="myTab">
						<li class="test-class active waves-effect">
						  <a class="deco-none red-class" href="#resp-tab1"><span class="glyphicon glyphicon-cog"></span> Case No Search</a></li>
						<li class="test-class"><a href="#resp-tab2"><span class="glyphicon glyphicon-headphones"></span> Party Wise Search</a></li>
						<li><a class="deco-none" href="#resp-tab3"><span class="glyphicon glyphicon-folder-open"></span>Judge Wise Search</a></li>
						<li><a class="deco-none" href="#resp-tab4"><span class="glyphicon glyphicon-folder-open"></span>Order Date Wise Search</a></li>
						<div style="clear:both;"></div>
					  </ul>

					  <div class="tab-content" style="float:left;width:100%;">
						<div class="tab-pane active" id="resp-tab1">
						   <h2 class="post-title" align="center">THE JUDGMENTS INFORMATION SYSTEM [ Case No Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="casenosearch" class="commentform comment-form">					
										<p class="comment-form-author">
										  <!--<label for="author">Case Type <span class="required">*</span></label>
										  <input type="text" name="case_type_name" id="case_type_name" class="form-control" placeholder="Case type" autocomplete="off" >
										  <input type="hidden" name="RegCase_type" id="RegCase_type"   class="form-control">-->
										  
										  <label for="RegCase_type">Case Type <span class="required">*</span></label>
										  <select type="text" name="RegCase_type" id="RegCase_type" class="form-control" placeholder="Case type" autocomplete="off" required>
										  <option value="">choose Case Type</option>
										   <?php  $stmt = $HCMAS_DB->prepare("SELECT case_type,type_name,full_form FROM case_type_t where display='Y' ORDER BY type_name");
											 $stmt->execute();
											while ($row = $stmt->fetch()) 
											{
												echo '<option value="'.$row['case_type'].'">'.$row['type_name'].'_'.$row['full_form'].'</option>';
											}
											?>
											</select>										  
										</p>
										
										<p class="comment-form-author">
										   <label for="RegCase_no">Case No <span class="required">*</span></label> 
										   <input type="text" class="form-control" id="RegCase_no" name="RegCase_no" placeholder="Case No" autocomplete="off" oninput="return isNumber(event)" onblur='splCharValidate_num(this)'>
										</p>
										
										<p class="comment-form-author">
										   <label for="RegCase_year">Year <span class="required">*</span></label> 
										   <input type="text" class="form-control" maxlength="4" id="RegCase_year" name="RegCase_year" placeholder="Year"  autocomplete="off"  oninput="return isNumber(event)" onblur='splCharValidate_num(this)'>
										</p>						
										<div style="clear:both;"></div>				
                                        <?php	
										    $options = array(
											'input_id'   => 'caseno_captcha',
											'input_name' => 'caseno_captcha',
											'image_id'   => 'caseno_captcha_img',
											'namespace'  => 'casenoform'
										    );
										    echo Securimage::getCaptchaHtml($options);													  
										?>
										
										
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit1" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->			
								</div>
								
								<div class="" id="caseno_search_result" align="center" > 
								</div>
								
						</div>
						<div class="tab-pane" id="resp-tab2">
						  <h2 class="post-title" align="center">THE JUDGMENTS INFORMATION SYSTEM [Party Name Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="partysearch" class="commentform comment-form">					
										<p class="comment-form-author">
										  <label for="party_name">Party Name<span class="required">*</span></label>
										  <input type="text" name="party_name" id="party_name" class="form-control" placeholder="Enter Pet./Res.Name" autocomplete="off" required oninput="return onlyAlphabets(event)" onblur='splCharValidate_alpha(this)'>
										  
										  
										  <input class="form-check-input" type="radio" name="party_type" id="inlineRadio1" value="1" style="float: left; margin: 11px 0px; " checked>
										  <label class="form-check-label" for="inlineRadio1" style="float: left;padding-left: 6px;cursor:pointer;">Petitioner</label>

                                          <input class="form-check-input" type="radio" name="party_type" id="inlineRadio2" value="2" style="float: left; margin: 11px 0px 0px 30px">
										  <label class="form-check-label" for="inlineRadio2" style="float: left;padding-left: 6px; cursor:pointer;">Respondent</label>
										  										  
										
										</p>										
																		

                                        <p class="comment-form-author">
										  <label for="from_date">Date Range : From<span class="required">*</span></label>
										  <input type="text" name="from_date" id="from_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" required>
										</p>
                                        <p class="comment-form-author">
										  <label for="to_date">Date Range : To<span class="required">*</span></label>
										  <input type="text" name="to_date" id="to_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" required>
										</p>										
										
										<p style="clear:both;"></p>
										<?php	
										    $options2 = array(
											'input_id'   => 'party_captcha',
											'input_name' => 'party_captcha',
											'image_id'   => 'party_captcha_img',
											'namespace'  => 'partyform'
										    );
										    echo Securimage::getCaptchaHtml($options2);													  
										?>
																														
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit2" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
								
								<div class="" id="party_search_result" align="center"> 
								</div>
						</div>
						<div class="tab-pane" id="resp-tab3">
						        <h2 class="post-title" align="center">THE JUDGMENTS INFORMATION SYSTEM [Judge Wise Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="judgesearch" class="commentform comment-form">					
										<p class="comment-form-author">
										  <label for="judge_name">Judge Name<span class="required">*</span></label>
														<!---				  	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
											<script type="text/javascript" src="js/jquery.js"></script>
											<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
										  <script>
	 									   $('#judge_name').keypress(function(event) {
        // Get the ASCII code of the pressed key
        const keyCode = event.which;
 
        // Regex: Allow only a-z (97-122) and A-Z (65-90)
        // keyCode 0 = special keys (e.g., backspace, delete)
        const isLetter = (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122);
 
        // If not a letter and not a special key, block the input
        if (!isLetter && keyCode !== 0) {
            event.preventDefault(); // Prevent the key from being entered
            return false;
        }
    }); 
				 */						

				 
										   j= jQuery.noConflict( true );
										   $( function() {
											   
j("#judge_name").autocomplete("fetchjudgeData.php", {});

});

</script>---->
<script>
				$( function() {

  $( "#judge_name" ).autocomplete({
     source: function( request, response ) {
        // Fetch data
        $.ajax({
             url: "fetchjudgeData.php",
             type: 'post',
             dataType: "json",
             data: {
                  search: request.term
             },
             success: function( data ) {
                  response( data );
             }
        });
     },
     select: function (event, ui) {
         // Set selection
         $('#judge_name').val(ui.item.label); // display the selected text
         $('#judge_name').val(ui.item.value); // save selected id to input
         return false;
     },
     focus: function(event, ui){
         $( "#judge_name" ).val( ui.item.label );
         $( "#judge_id" ).val( ui.item.value );
         return false;
     },
  });

});
function split( val ) {
   return val.split( /,\s*/ );
}
function extractLast( term ) {
   return split( term ).pop();
}		
</script>				  
										  <input type="text" name="judge_name" id="judge_name" class="form-control" placeholder="Judge Name" autocomplete="off" required onblur='splCharValidate_alpha(this)' >
										</p>																	
										
										<p class="comment-form-author">
										  <label for="jud_from_date">Date Range : From<span class="required">*</span></label>
										  <input type="text" name="jud_from_date" id="jud_from_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" required>
										</p>
                                        <p class="comment-form-author">
										  <label for="jud_to_date">Date Range : To<span class="required">*</span></label>
										  <input type="text" name="jud_to_date" id="jud_to_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" required>
										</p>
																														
										<?php	
										    $options3 = array(
											'input_id'   => 'judge_captcha',
											'input_name' => 'judge_captcha',
											'image_id'   => 'judge_captcha_img',
											'namespace'  => 'judgeform'
										    );
										    echo Securimage::getCaptchaHtml($options3);													  
										?>
																														
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit3" class="submit" value="SEARCH">
										</p>
										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
								
								<div class="" id="judge_search_result" align="center"> 
								</div>
								
						</div>
						
						<div class="tab-pane" id="resp-tab4">
						
						    <h2 class="post-title" align="center">THE JUDGMENTS INFORMATION SYSTEM [Order Date Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="order_datesearch" class="commentform comment-form">					
									
										<p class="comment-form-author">
										  <label for="order_date">Order Date<span class="required">*</span></label>
										  <input type="text" name="order_date" id="order_date" class="form-control datepicker" placeholder="YYYY-MM-DD" autocomplete="off" required>
										</p>
																				
										<p style="clear:both;"></p>
										<?php	
										    $options4 = array(
											'input_id'   => 'orddate_captcha',
											'input_name' => 'orddate_captcha',
											'image_id'   => 'orddate_captcha_img',
											'namespace'  => 'orddateform'
										    );
										    echo Securimage::getCaptchaHtml($options4);													  
										?>
                                       												
										<div style="clear:both;"></div>
										
										<p class="form-submit" style="margin: 20px auto; text-align:center;">
										  <input name="submit" type="submit" id="submit4" class="submit" value="SEARCH">
										</p>

										<div style="clear:both;"></div>
										
									 </form>	
									 <div style="clear:both;"></div>
									</div><!-- #respond -->
					
								</div>
								
								<div class="" id="orddate_search_result" align="center"> 
								</div>
						
						</div>
						
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
	
	  <script>
	
	    // NUMBER VALIDATION
		function isNumber(evt) {
			/*evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;*/
			var charCode = evt.data.charCodeAt(0);
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				event.target.value=event.target.value.replace(/[^0-9]/g, "");
				return false;
			}
			return true;
		
		}
		
		// CHARACTER VALIDATION (ALLOWED SPACE)
		function onlyAlphabets(event) {
			
			 var inputValue= event.data.charCodeAt(0);
			//if(!(inputValue>=65 && inputValue<=90 ) && inputValue!=190 && inputValue!=110){
			if((!(inputValue >= 65 && inputValue <= 123) && (inputValue != 32 && inputValue != 0 && inputValue != 46))||(inputValue>=91 && inputValue<=97)){
			
				event.target.value=event.target.value.replace(/[^a-zA-Z .]/g, "");
			}
		}
		function splCharValidate_alpha(id_val) {
			 var inputValue= document.getElementById(id_val.id);
			inputValue.value=inputValue.value.replace(/[^a-zA-Z .]/g, "");
			
		}
		function splCharValidate_num(id_val) {
			 var inputValue= document.getElementById(id_val.id);
			inputValue.value=inputValue.value.replace(/[^0-9]/g, "");
			
		}
	
	    $(document).ready( function () {               
			//		
			$( 'ul.nav-tabs  a' ).click( function ( e ) {
			  e.preventDefault();
			   $( this ).tab( 'show' );
			});
			( function( $ ) {
			  // Test for making sure event are maintained
			 /* $( '.js-alert-test' ).click( function () {
				alert( 'Button Clicked: Event was maintained' );
			  } );*/
			  fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
		  } )( jQuery );


			 // AUTOCOMPLETE CASE TYPE SCRIPT
			var availableTags = <?php include('filterCaseTypeAll.php'); ?>;
			$("#case_type_name").autocomplete({
				
				source: availableTags,
				autoFocus:true,
				select: function( event, ui ) {
					$( '#RegCase_type' ).val( ui.item.id );   
													
				}
			});
			
			
			// DATEPICKER	
				$( ".datepicker" ).datepicker({
				  dateFormat: "yy-mm-dd",
                  maxDate:new Date(),
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
				
				
				
				//
				/* $("#AEAllocation").validate({
					  rules: {
					  ae_distribution_from_dt: "required",
					  ae_distribution_to_dt: { 
						required:true,
						checkDate:true,
					  },
					  section_cd: { 				
						checkSection:true,
					  },
					  
					  },			 
					  messages: {
					  ae_distribution_from_dt: "Please select From Date",
					  ae_distribution_to_dt: {
						required: "Please select To Date",
						checkDate: "TO date must greater than FROM date"
					  },
					  section_cd: {				
						checkSection: "Please Select Section"
					  },
						  
					 },
					  submitHandler: function (form) {
                         document.form.submit();						  
							
					}
					
			}); */
				
	  
		
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
$("#pdf_cap").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
				
		pdf_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		
		pdf_captcha: {
			required: "Please provide a Captcha",
			minlength: "Your Captcha must be at least 6 characters long",
			maxlength: "Your Captcha must not be more than 6 characters long"
		}
	},
	// Make sure the form is submitted to the destination defined
	// in the "action" attribute of the form when valid
	submitHandler: function(form) {
		
		//REFRESH CAPTCHA
		
		//$("#caseno_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
				
		var posting = $.post( "pdf_captcha_action.php", { pdf_captcha:$("#pdf_captcha").val()});
		posting.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			/*$("#caseno_search_result").html(data);
			
			// CAPTCHA REFRESH
			caseno_captcha_img_audioObj.refresh();
			document.getElementById('caseno_captcha_img').src = '/securimage_show.php?namespace=casenoform&' + Math.random();
			*/
			if(data=='1'){
				var cur_rec=$('#curr_pdf_rec').val();
				var cur_tab=$('#curr_pdf_tab').val();
				$('#pdf_captcha').val('');
				$('#pdf_captcha_err').html('');
				pdf_captcha_img_audioObj.refresh();
			document.getElementById('pdf_captcha_img').src = '/securimage_show.php?namespace=pdfform&' + Math.random();
				document.getElementById("overlay").style.display = "none";
				var temp="pdf_capt_sub_"+cur_tab+"_"+cur_rec;
				document.getElementById(temp).submit();
				$('#curr_pdf_rec').val('');
				$('#curr_pdf_tab').val('');
			}
			if(data=='0'){
				$('#pdf_captcha').val('');
				$('#pdf_captcha_err').html('Captcha not matching');
			pdf_captcha_img_audioObj.refresh();
			document.getElementById('pdf_captcha_img').src = '/securimage_show.php?namespace=pdfform&' + Math.random();
			
			}
		});
	}
});

$("#casenosearch").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		RegCase_type:{			
			required :true,			
		},
        RegCase_no:{			
			required :true,			
		},
        RegCase_year:{			
			required :true,			
		},		
		caseno_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		RegCase_type: {
			required: "Please enter Case Type"
			
		},
		RegCase_no: {
			required: "Please enter Case No"
			
		},
		RegCase_year: {
			required: "Please enter Year"
			
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
		
		//REFRESH CAPTCHA
		
		$("#caseno_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
				
		var posting = $.post( "cause_judment_action.php", { RegCase_type:$("#RegCase_type").val(),RegCase_no:$("#RegCase_no").val(),RegCase_year:$("#RegCase_year").val(),caseno_captcha:$("#caseno_captcha").val()});
		posting.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			$("#caseno_search_result").html(data);
			
			// CAPTCHA REFRESH
			caseno_captcha_img_audioObj.refresh();
			document.getElementById('caseno_captcha_img').src = '/securimage_show.php?namespace=casenoform&' + Math.random();
			
		});
	}
});

//PARTY WISE
$("#partysearch").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		party_name:{			
			required :true,	
			minlength: 3,			
		},
        from_date:{			
			required :true,			
		},
        to_date:{			
			required :true,			
		},		
		party_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		party_name: {
			required: "Please enter atleast 3 characters in Party Name"
			
		},
		jud_from_date: {
			required: "Please enter From Date"
			
		},
		jud_to_date: {
			required: "Please enter To Date"
			
		},
		party_captcha: {
			required: "Please provide a Captcha",
			minlength: "Your Captcha must be at least 6 characters long",
			maxlength: "Your Captcha must not be more than 6 characters long"
		}
	},
	// Make sure the form is submitted to the destination defined
	// in the "action" attribute of the form when valid
	submitHandler: function(form) {
		
		//REFRESH CAPTCHA
		
		$("#party_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
		
		var party_type = $('input[name="party_type"]:checked').val();
		
		var posting = $.post( "cause_judment_action.php", { party_name:$("#party_name").val(),from_date:$("#from_date").val(),to_date:$("#to_date").val(),party_captcha:$("#party_captcha").val(),party_type:party_type});
		posting.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			$("#party_search_result").html(data);
			
			//CAPTCHA REFRESH
			party_captcha_img_audioObj.refresh();
			document.getElementById('party_captcha_img').src = '/securimage_show.php?namespace=partyform&' + Math.random();
			
		});
		
		
	}
});

//JUDGEWISE SEARCH
$("#judgesearch").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		judge_name:{			
			required :true,	
			minlength: 4
		},
        jud_from_date:{			
			required :true,			
		},
        jud_to_date:{			
			required :true,			
		},		
		judge_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		judge_name: {
			required: "Please enter minimum 4 characters in Judge Name"
			
		},
		jud_from_date: {
			required: "Please enter From Date"
			
		},
		jud_to_date: {
			required: "Please enter To Date"
			
		},
		judge_captcha: {
			required: "Please provide a Captcha",
			minlength: "Your Captcha must be at least 6 characters long",
			maxlength: "Your Captcha must not be more than 6 characters long"
		}
	},
	// Make sure the form is submitted to the destination defined
	// in the "action" attribute of the form when valid
	submitHandler: function(form) {
		
		//REFRESH CAPTCHA
		
		$("#judge_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
		
		var posting = $.post( "cause_judment_action.php", { judge_name:$("#judge_name").val(),jud_from_date:$("#jud_from_date").val(),jud_to_date:$("#jud_to_date").val(),judge_captcha:$("#judge_captcha").val()});
		posting.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			$("#judge_search_result").html(data);
			
			//CAPTCHA REFRESH
			judge_captcha_img_audioObj.refresh();
			document.getElementById('judge_captcha_img').src = '/securimage_show.php?namespace=judgeform&' + Math.random();
			
		});
		
		
	}
});

// ORDER DATE SEARCH
$("#order_datesearch").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		order_date:{			
			required :true,			
		},				
		orddate_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		order_date: {
			required: "Please Select Order Date"
			
		},
		orddate_captcha: {
			required: "Please provide a Captcha",
			minlength: "Your Captcha must be at least 6 characters long",
			maxlength: "Your Captcha must not be more than 6 characters long"
		}
	},
	// Make sure the form is submitted to the destination defined
	// in the "action" attribute of the form when valid
	submitHandler: function(form) {
		
		//REFRESH CAPTCHA
		
		$("#orddate_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
		
		var posting = $.post( "cause_judment_action.php", { order_date:$("#order_date").val(),orddate_captcha:$("#orddate_captcha").val()});
		posting.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			$("#orddate_search_result").html(data);
			
			// CAPTCHA REFRESH			
			orddate_captcha_img_audioObj.refresh();
			document.getElementById('orddate_captcha_img').src = '/securimage_show.php?namespace=orddateform&' + Math.random();
			
		});
		
		
	}
});
/*function validateJLen()
{
	var j_name=$("#judge_name").val();
	if(j_name.length<4)
		alert("Please enter more than 4 characters in judge name ");
}*/
$(document).ready(function() {
		
		$('#caseno_captcha,#party_captcha,#judge_captcha,#orddate_captcha').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && ( keycode == 8 || keycode == 37 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
	  });
	  function open_overlay(tab,sno)
	{
		$('#pdf_captcha').val('');
		$('#pdf_captcha_err').html('');
		$('#curr_pdf_rec').val(sno);
		$('#curr_pdf_tab').val(tab);
		document.getElementById("overlay").style.display = "block";
		 
	}
	function close_overlay()
	{
		$('#curr_pdf_rec').val('');
		$('#pdf_captcha').val('');
		$('#curr_pdf_tab').val('');
		$('#pdf_captcha_err').html('');
		pdf_captcha_img_audioObj.refresh();
		document.getElementById('pdf_captcha_img').src = '/securimage_show.php?namespace=pdfform&' + Math.random();
		document.getElementById("overlay").style.display = "none";
	}
</script>