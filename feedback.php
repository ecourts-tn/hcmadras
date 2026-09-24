<?php  
include "header.php";

require('config/dbconfig.php');
?>
<style type="text/css">
.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:170px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:right;
    display:table-column;
    width:350px;
	text-align:justify;
	padding: 10px;
 
}
@media only screen and (max-width: 1025px){
	
	
	.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:150px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:right;
    display:table-column;
    width:300px;
	text-align:left;
	padding: 10px;
 
}
	
	
}
@media only screen and (max-width: 719px){
	
	
	.table2 {
	width:auto;
    border:1px solid #f2f2f2;

    border-spacing:5px;
	
	
}
.Row {
	display:table-row;
    width:auto;
}

.Cell1 {
    float:left;
    display:table-column;
    width:120px;
 	text-align:left;
	background-color:#f1f1f1;
	font-size: 0.9em;
	padding: 10px;
}
.Cell2 {
    float:left;
    display:table-column;
    width:200px;
	text-align:justify;
	font-size: 0.9em;
	padding: 10px;
 
}
	
	
}

@media only screen and (max-width: 768px)
{
	 .Cell1{width:93%;}
	 .Cell2{width:93%;}
}
</style>
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
<div class="pad group">
<div id="comments" class="themeform">
	
	
					<!-- comments open, no comments -->
			
		
		<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">Feedback Form</h3>
		<form action="#" method="post" id="commentform" class="comment-form" autocomplete="off">
		
		<p class="comment-form-url">
		
		<label for="author">E-Mail<span style="color:red"> *</span></label>
		<input id="email_id" name="email_id" type="email" value="" size="30" maxlength="245" required='required' autocomplete="off"/>
		<label for="author">Mobile no.<span style="color:red"> *</span></label>
		<input id="mob_no" name="mob_no" type="email" value="" size="30" maxlength="10" required='required' autocomplete="off"/>
		<button name="otp" type="button" id="otp" class="submit" onclick="GetOTP()" style="background: aqua;border: double;">Get OTP
		</button></p><div id='otp_tmp'></div>
<p class="comment-form-url">
<label for="url">Mobile OTP<span style="color:red"> *</span></label> 
<input id="mail_otp" name="mail_otp" type="text" value=""  maxlength="6" autocomplete="off" onchange="OTPcheck()"/>
</p>
<p class="comment-form-url">
<label for="url">Enter Your Feedback<span style="color:red"> *</span></label> 
<textarea id="feedbackmsg" name="feedbackmsg" type="text" value="" size="30" maxlength="200" autocomplete="off"></textarea>
</p>




<p class="comment-form-cookies-consent">
<label for="wp-comment-cookies-consent">
<?php ?></label>
</p>
<p class="form-submit"><button name="submit" type="button" id="submit" class="submit"  onclick="feedback_msg()" style="background: aqua;border: double;">Submit</button>

</p></form>	</div><!-- #respond -->
	
</div><!--/#comments-->			
			
				
</div>
</div><!--/.main-inner-->
<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
</div>
	<?php include "footer.php"; ?>
<script>
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function GetOTP()
	{
		
		var mail_id=$('#email_id').val();
		var mob=$('#mob_no').val();
		if(!(isEmail(mail_id)))
		{
			swal("Enter valid e-mail ID","","error");
			return false;
		}
		//alert(state_id);
		if(mail_id!=""&&mob.length==10)
		{
			$('#email_id').attr('readonly',true);
			$('#mob_no').attr('readonly',true);
			$.ajax({ 
			method: "POST",
			url: "action.php",
			data: {
				action:'sendotp',
				email_id:mail_id,
				mob:mob
				},
				success: function(data)
				{	
				if(data==2)
				{
					swal("Something Went Worng","","error"); 
				}
				else
				{
					$('#otp_tmp').html(data);
				swal("Sucessfully OTP sent your mobile number","","info"); 	
				}				
				} 
			});
		}
		else
		{ if(mail_id=="")
			swal("Please Enter Your Mail id","","error"); 
		if(mob.length!=10)
			swal("Please Enter Your Mobile Number","","error"); 
		}
		
	}
	function OTPcheck()
	{
		var mob_no=$('#mob_no').val();
		var mail_id=$('#email_id').val();
		var mail_otp=$('#mail_otp').val();
		
		
		//alert(state_id);
		if(mail_id!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "action.php",
			data: {
				action:'otpcheck',
				email_id:mail_id,mobile_otp:mail_otp,mob_no:mob_no
				},
				success: function(data)
				{	
				if(data==2)
				{
					swal("Worng OTP","","error"); 
					$('#mail_otp').val('');
					$('#feedbackmsg').val('');
				}
								
				},
error:function(data)				
{alert(data);}
			});
		}
		else
		{
			swal("Please Enter Your Mail id","","error"); 
		}
		
	}
	function feedback_msg()
	{
		
		var mail_id=$('#email_id').val();
		var mobile_otp=$('#mail_otp').val();
		var mob_no=$('#mob_no').val();
		var feedbackmsg=$.trim($('#feedbackmsg').val());
		
		
		//alert(feedbackmsg);
		if(mail_id=="")
			swal("Please Enter Your Mail id",'','error'); 
		else if(mob_no.length!=10)
			swal("Please Enter Your Mobile Number",'','error');
		else if(feedbackmsg=="")
			swal("Please Enter Your Feedback",'','error');
		else if(mobile_otp=="")
			swal("Please Enter Mobile OTP",'','error');
		else
		{
			
			$.ajax({ 
			method: "POST",
			url: "action.php",
			data: {
				action:'feedback_msg',
				email_id:mail_id,mobile_otp:mobile_otp,feedback_msg:feedbackmsg,mob_no:mob_no
				},
				success: function(data)
				{	
				if(data==2)
				{
					swal("Something Went Worng","","error"); 
					//$('#mail_otp').val('');
				}
				else if(data==1)
				{
				//alert("Your feedback sucessfully sent"); 	
				swal('Your feedback sucessfully sent','','success').then(function() {location.reload();});
				}
else
{
	swal('Something went wrong','','error').then(function() {location.reload();});
}	
				} 
			});
		}
		
		
	}
	  $(document).ready(function() {
		
		$('#mail_otp,#mob_no').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && ( keycode == 8 || keycode == 37 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
	  });
</script>
