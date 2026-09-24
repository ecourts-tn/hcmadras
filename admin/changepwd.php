<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);
include 'include/header.php'; //flag=1
/*$stmt = $DB_con->prepare("SELECT * FROM mhc_users WHERE mhc_user_id=:uname and status='A' and default_pass='Y'");
					$stmt->execute(array(':uname'=>$_SESSION['user_session']));
					if($stmt->rowCount() > 0){
						
						$_SESSION['default_pass_flag']='1';
						echo "Iam inn".$_SESSION['default_pass_flag'];
					}
					else
						$_SESSION['default_pass'] =='N';*/




include 'function/user_fun.php';
$user_fun =new USERFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
try
		{
			$options = [
			'cost' => 11,
			//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
				$id=base64_decode($_GET['edit_id']);
					$old_pwd=htmlspecialchars(filter_input(INPUT_POST, 'old_pwd', FILTER_SANITIZE_STRING));
					$new_pwd= password_hash($new_pwd, PASSWORD_BCRYPT, $options);
					
						
						//$menu_list=trim($menu_list1);
	if(empty($old_pwd))
   {
      
      $error = "Enter your Current Password!";
   }
 else if(!empty($old_pwd) && $validator->chkbadchar($old_pwd) == false)
 {
  $error= "Please enter your Current password";
 }

 else if(empty($new_pwd))
   {
      
      $error = "Enter your new password !";
   }
 else if(!empty($new_pwd) && $validator->chkbadchar($new_pwd) == false)
 {
  $error= "Please enter your new password";
 }
 else
 {
	 $stmt1 = $DB_con->prepare("SELECT  * FROM mhc_users where mhc_user_id=:id");
 $stmt1->execute(array(':id' => $id));
 $editRow1=$stmt1->FETCH(PDO::FETCH_ASSOC);
			
			if( password_verify($old_pwd,$editRow1['password']))
			{
				if($user_fun->user_update_pwd($edit_id,$new_pwd,$mhc_user,$page_id,$ip,$log_fun))
{							if($editRow1['default_pass']=='N')
							$user_fun->redirect('changepwd.php?edit_id='.base64_encode($_SESSION['user_session']).'&joined&CheckString='.$chkstr.'&'.md5("page_id").'='.$page_id);
						else
						{
							echo '<script>alert("You will be logged out from the portal now. Kindly login again")</script>';
							//echo "<script> swal({title:'Alert',text:'You will be logged out from the portal now. Kindly login again',icon:'info'}).then(function() {window.open('".$url."', 'self');})</script>";
							$url='logout.php';
							$delay = '0';
							echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
						}
							
						}
else
{
	$error='Error Occured';
}	
			}
			else
			{
				$error='Current Password is not correct';
			}

		
 }
						}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
	
	 if(isset($_GET['edit_id']))
{

	$edit=base64_decode($_GET['edit_id']);
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_users where mhc_user_id=:id");
 $stmt->bindValue(':id', $edit); 
 $stmt->execute();
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

}
 ?>
 <style>
 .popuptext {
  visibility: hidden;
  width: 250px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

 .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}
.hide {
  visibility: hidden;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
 </style>
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>Forms</h1>
                   <!-- <ul>
                        <li><a href="href">Forms</a></li>
                        <li>Validation</li>
                    </ul>-->
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                   
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Change Password</div>
								<?php
				if(isset($error))
            {
				  ?>
				  <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize"> <?php echo $error; ?>!</strong> 
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
                 
                  <?php
               
            }
           
			 else if(isset($_GET['joined']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Password Updated Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			
           
			?>
			
               <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
			   <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['mhc_user_id']); }?>" >
                                    <div class="form-row">
                                         <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control" id="user_name" name="user_name" type="text" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required="required" onchange="CheckUsername()" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['username']); }?>" readonly />
                                              
                                            </div>
                                        </div>
                                        
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip02">Current Password</label>
                                            <input class="form-control" id="old_pwd" name="old_pwd" type="Password" placeholder="Enter Current Password" required="required"  autocomplete="off"  />
                                            <div class="invalid-tooltip">
                                               Enter Your Current password

                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3" id='pwd'>
                                            <label for="validationTooltip02">New Password</label>
                                            <input class="form-control" id="new_pwd" name="new_pwd" type="password" placeholder="Enter New Password" required="required" onclick="pwdPopup(this)" onfocusout="pwdPopup1(this)" onchange="CheckPassword(this)" autocomplete="off"  />
                                            <div class="invalid-tooltip">
                                               Enter Your New password

                                            </div>
											<span class="popuptext" id="myPopup">Password must be at least 8 characters or atmost 15 characters, containing at least 1 number, 1 lowercase, 1 uppercase letter and atleast one of the following special character from @$._</span>
                                        </div>
										<div class="col-md-3 form-group mb-3" id='pwd1'>
                                            <label for="validationTooltip02">Confirm New Password</label>
                                            <input class="form-control" id="new_pwd1" name="new_pwd1" type="text" placeholder="Re-Enter New Password" required="required" onfocusout="pwdPopup1(this)" onclick="pwdPopup(this)"  onchange="CheckPassword(this)" autocomplete="off"  />
                                            <div class="invalid-tooltip">
                                               Re-Enter Your New password

                                            </div>
											<span class="popuptext" id="myPopup1">Password must be at least 8 characters or atmost 15 characters, containing at least 1 number, 1 lowercase, 1 uppercase letter and atleast one of the following special character from @$._</span>
                                        </div>
										
                                       
										
										
                                    </div>
                                   
                                    <input  class="btn btn-primary" name="submit" id="submit" value="submit" type="submit" />
                                </form>
                            </div>
                        </div>
						
                    </div>
					
                </div><!-- end of main-content -->
				
            </div>
			
			<?php include 'include/footer.php' ;
			?>
			
			<script>
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.old_pwd.value)==false )
   {
     swal("Enter a Current Password.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#old_pwd').val('');
         theform.old_pwd.focus();
    return false;
   }
   
  else if(chkbadchar(theform.new_pwd.value)==false )
   {
     swal("Enter New Password.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#new_pwd').val('');
         theform.new_pwd.focus();
    return false;
   }
   else if($('#new_pwd').val().length<8)
   {
     swal("New Password must contain 8 Characters", "", "error");
    //alert("Enter a Valid  First Name.");
         theform.new_pwd.focus();
    return false;
   }
    else if($('#new_pwd').val().length>15)
   {
     swal("New Password must contain less than 15 Characters", "", "error");
    //alert("Enter a Valid  First Name.");
         theform.new_pwd.focus();
    return false;
   }
   else if (!CheckPassword1(theform.new_pwd.value))
   {
	   swal("Enter a strong password.", "", "error");
		//alert("Enter a Valid  First Name.");
		$('#new_pwd').val('');
         theform.new_pwd.focus();
	   return false;
   }
   else if(chkbadchar(theform.new_pwd1.value)==false )
   {
     swal("Re-Enter a New Password.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#new_pwd1').val('');
         theform.new_pwd1.focus();
    return false;
   }
     else if($('#new_pwd1').val().length<8)
   {
     swal("Confirm Password must contain 8 Characters", "", "error");
    //alert("Enter a Valid  First Name.");
         theform.new_pwd1.focus();
    return false;
   }
    else if($('#new_pwd1').val().length>15)
   {
     swal("New Password must contain less than 15 Characters", "", "error");
    //alert("Enter a Valid  First Name.");
         theform.new_pwd1.focus();
    return false;
   }
   else if (!CheckPassword1(theform.new_pwd1.value))
   {
	   swal("Enter a strong password.", "", "error");
		//alert("Enter a Valid  First Name.");
		$('#new_pwd1').val('');
         theform.new_pwd1.focus();
	   return false;
   }
   else if($('#new_pwd1').val()!=$('#new_pwd').val())
    {
		swal("New Password and Confirm Password must be same", "", "error");
		$('#new_pwd1').val('');
         theform.new_pwd1.focus();
		 $('#new_pwd').val('');
         theform.new_pwd.focus();
    return false;
    }
	 else if($('#old_pwd').val()==$('#new_pwd').val())
    {
		swal("Old Password and New Password must not be same", "", "error");
		$('#old_pwd').val('');
         theform.old_pwd.focus();
		 $('#new_pwd').val('');
		  $('#new_pwd1').val('');
         theform.new_pwd.focus();
    return false;
    }
   
    
}

	

$('.Number').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
		function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
        return false;
        return true;
    }
	function pwdPopup(input)
	{
		if(input.id=='new_pwd')
		var popup = document.getElementById("myPopup");
	else
		var popup = document.getElementById("myPopup1");
	popup.classList.remove("hide");
		popup.classList.toggle("show");
	}
	function pwdPopup1(input)
	{
		if(input.id=='new_pwd')
		var popup1 = document.getElementById("myPopup");
	else
		var popup1 = document.getElementById("myPopup1");
		popup1.classList.remove("show");
		popup1.classList.toggle("hide");
	}
	function CheckPassword(input){
		var id_val=input.id;
		var pass=$('#'+id_val).val();
		 var re =new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$._])[A-Za-z\d@$._]{8,15}$/);
		 if(!re.test(pass))
		 {
			 swal("Please enter a strong password", "", "error");
			 return false;
		 }
		 else return true;
	}
	function CheckPassword1(input){
		var pass=input;
		 var re =new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$._])[A-Za-z\d@$._]{8,15}$/);
		 if(!re.test(pass))
		 {
			 swal("Please enter a strong password", "", "error");
			 return false;
		 }
		 else return true;
	}
			</script>
			
				