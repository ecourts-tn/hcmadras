<?php 
require('config/dbconfig.php');
require('config/dbconfig_status.php');
include"header.php";
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);*/
require_once 'securimage.php';

?>
<style>
.commentform select[type="text"]{
    max-width: 100% !important;
    width: 100%!important;
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
	
	
	#status_captcha_img_audio_controls{
		float: left!important;
        margin: 10px;
	}
	
	
	#status_captcha_img{padding:5px 0px 0px 20px}
	
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
  width: 80%;
  border:1px solid black;
  background:#42B7E3
}

</style>
 <link href="css/responsive_tab.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css">



	<div class="container" id="page" >
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
				   <div class="content">
					<div class="pad group">
						
                      
					  <div class="tab-content" style="float:left;width:100%;">
						
					
						<div class="tab-pane active"  id="resp-tab3">
						        <h2 class="post-title" align="center">CASE INFORMATION SYSTEM [ Filing Date Wise Search ]</h2>				
								<div id="comments" class="themeform">	
									<!-- comments open, no comments -->					
									<div id="respond" class="comment-respond">
									<form action="#" method="post" id="filingdt_search" class="commentform comment-form">					
										<p class="comment-form-author">
										 
										  <label for="section">Section <span class="required">*</span></label>
										  <select type="text" name="section" id="section" class="form-control" placeholder="Select Section" autocomplete="off" required>
										  <option value="">Choose section</option>
										   <?php  $stmt =  $DB_con->prepare("select * from drop_down where page_id=91 and col_nme='section'  and display='Y'  order by order_id asc");
											 $stmt->execute();
											while ($row = $stmt->fetch()) 
											{
												if($row['id']==63 || $row['id']==66 || $row['id']==65)
												echo '<option value="'.$row['value'].'">'.$row['name'].'</option>';
											}
											?>
											</select>	
										</p>																	
										
										<p class="comment-form-author">
										  <label for="from_date">From<span class="required">*</span></label>
										  <input type="text" name="from_date" id="from_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" required readonly >
										</p>
										 <p class="comment-form-author">
										  <label for="from_date">To<span class="required">*</span></label>
										  <input type="text" name="to_date" id="to_date" class="form-control " placeholder="YYYY-MM-DD" autocomplete="off" readonly required>
										</p>		
                                       <p style="clear:both;"></p>
																														
										<?php	
										    $options3 = array(
											'input_id'   => 'status_captcha',
											'input_name' => 'status_captcha',
											'image_id'   => 'status_captcha_img',
											'namespace'  => 'statusform'
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
								
								<div class="" id="status_search_result" align="center"> 
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

    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.js"></script>	  
	<script src="js/responsive-tabs.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	
	  <script>
	
	    // NUMBER VALIDATION
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
		
		// CHARACTER VALIDATION (ALLOWED SPACE)
		function onlyAlphabets(event) {
			var inputValue = event.charCode;
			if(!(inputValue >= 65 && inputValue <= 123) && (inputValue != 32 && inputValue != 0)){
				event.preventDefault();
			}
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
			/*var availableTags = <?php include('filterCaseTypeAll.php'); ?>;
			$("#case_type_name").autocomplete({
				
				source: availableTags,
				autoFocus:true,
				select: function( event, ui ) {
					$( '#RegCase_type' ).val( ui.item.id );   
													
				}
			});*/
			
			
			// DATEPICKER	
				$( ".datepicker" ).datepicker({
				  dateFormat: "yy-mm-dd",
                  maxDate:new Date(),
				});
				$(".datepicker").attr('readonly','readonly');  
				
				// JUDGE DATE RANGE
				$("#from_date").datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-69:+0", //set the range of years
					dateFormat: 'yy-mm-dd',
					onClose: function (selectedDate, instance) {
						if (selectedDate != '') {
							var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
							date.setMonth(date.getMonth()+3);
							console.log(selectedDate, date);
						}
					}
				}); 
				$("#to_date").datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-69:+0", //set the range of years
					dateFormat: 'yy-mm-dd',
					onClose: function (selectedDate, instance) {
						if (selectedDate != '') {
							var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
							date.setMonth(date.getMonth()+3);
							console.log(selectedDate, date);
						}
					}
				});				

				
				
				// JUDGE DATE RANGE
			/*	$("#from_date").datepicker({
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
				});     */

			/*	$("#to_date").datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-69:+0", //set the range of years
					dateFormat: 'yy-mm-dd',
					onClose: function (selectedDate) {
						$("#from_date").datepicker("option", "maxDate", selectedDate);
					}
				});*/
				
				
				
				//
				
	  
		
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


//JUDGEWISE SEARCH
$("#filingdt_search").validate({
	// Specify validation rules
	rules: {
		// The key name on the left side is the name attribute
		// of an input field. Validation rules are defined
		// on the right side
		section:{			
			required :true,
		},
       from_date:{			
			required :true,			
		},
		to_date:{			
			required:true,
			checkdate:true,
		},		
		status_captcha: {
			required: true,
			minlength: 6,
			maxlength: 6
		}
	},
	// Specify validation error messages
	messages: {		
		section: {
			required: "Please select section"
			
		},
		from_date: {
			required: "Please select From date"
			
		},
		to_date: {
			required: "Please select To date",
			checkdate: "Please select valid To Date not more than 10 days"
			
		},
		status_captcha: {
			required: "Please provide a Captcha",
			minlength: "Your Captcha must be at least 6 characters long",
			maxlength: "Your Captcha must not be more than 6 characters long"
		}
	},
	// Make sure the form is submitted to the destination defined
	// in the "action" attribute of the form when valid
	submitHandler: function(form) {
		
		//REFRESH CAPTCHA
		
		$("#status_search_result").html("<img src='images/spinner1.gif' align='center' width='300' height='300'/>");
		
		var posting = $.post( "get_filing_status.php", {action:'get_filing_status', section:$("#section").val(),from_date:$("#from_date").val(),to_date:$("#to_date").val(),status_captcha:$("#status_captcha").val()});
		posting.done(function( data ) {
		
		    //$("#orddate_captcha").val("");
			
			
			//CAPTCHA REFRESH
			status_captcha_img_audioObj.refresh();
			document.getElementById('status_captcha_img').src = '/securimage_show.php?namespace=statusform&' + Math.random();
			$("#status_captcha").val("");
			$("#status_search_result").html(data);
		});
		
		
	}
});



$(document).ready(function() {
		
		$('#status_captcha').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && ( keycode == 8 || keycode == 37 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
		jQuery.validator.addMethod("checkdate", function() {
					var flag = true;
					var from_date=$('#from_date').val();
					var to_date=$('#to_date').val();
					var fd = formatDate(from_date);
					var td = formatDate(to_date);
					var from_date=new Date(fd);
					var to_date=new Date(td);
					var milli_secs = to_date.getTime() - from_date.getTime();
					
					// Convert the milli seconds to Days 
					var days = milli_secs / (1000 * 3600 * 24);
					if(from_date <= to_date && days<=10)
					{
						flag = true;
					}
					else
					{
						flag = false;
					}
					return flag;
				}, "");
				function formatDate(dates) 
				{
					var myString = dates; //xml nodeValue from time element
					var array = new Array();
					
					//split string and store it into array
					array = myString.split('/');
					
					//from array concatenate into new date string format: "DD.MM.YYYY"
					var newDate = (array[2] + "-" + array[1] + "-" + array[0]);
					return newDate;
				}
		
	  });
	  
</script>