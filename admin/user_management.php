<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/user_fun.php';


$user_fun =new USERFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);


	if(isset($_POST['submit'])) {
		if(isset($_GET['joined']))
			unset($_GET['joined']);
		else if (isset($_GET['joined1']))
			unset($_GET['joined1']);
			else if (isset($_GET['joined2']))
				unset($_GET['joined2']);
		
		$options = [
			'cost' => 11,
			//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$enctype_pass= password_hash($password, PASSWORD_BCRYPT, $options);
			if(!$last_name)
			$last_name='';
		
		$full_name=$first_name.' '.$last_name;
try
		{
				$user_name=htmlspecialchars(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING));
					$mobile=htmlspecialchars(filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING));
					$email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
					
					$status=htmlspecialchars(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING));
					$dept=htmlspecialchars(filter_input(INPUT_POST, 'dept', FILTER_SANITIZE_STRING));
					$court_type=htmlspecialchars(filter_input(INPUT_POST, 'court_type', FILTER_SANITIZE_STRING));
					$dist=htmlspecialchars(filter_input(INPUT_POST, 'dist', FILTER_SANITIZE_STRING));
					$roll=htmlspecialchars(filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_STRING));
					$designation=htmlspecialchars(filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_STRING));
					
				$menu_list = trim(implode(',',array_unique($_POST['menu_list'])));
					  if(empty($full_name))
   {
      
      $error = "Enter your First Name !";
   }
 else if(!empty($full_name) && $validator->chkbadchar($full_name) == false)
 {
  $error= "Please enter valid First Name";
 }
				 else if(empty($user_name))
   {
      
      $error = "Enter your First Name !";
   }
 else if(!empty($user_name) && $validator->chkbadchar($user_name) == false)
 {
  $error= "Please enter valid First Name";
 }
 else if(empty($mobile))
   {
      
      $error = "Enter your Mobile Number !";
   }
 else if(!empty($mobile) && $validator->chkbadchar($mobile) == false)
 {
  $error= "Please enter valid Mobile Number ";
 }
 else if(!empty($mobile) && $validator->test_datatype($mobile,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Mobile Number";
 }
  else if(empty($email_id))
   {
      
      $error = "Enter your Email id !";
   }
 else if(!filter_var(trim($email_id), FILTER_VALIDATE_EMAIL))
 {
  $error= "Please enter valid Email id ";
 }
 else if(empty($password))
   {
      
      $error = "Enter your Password !";
   }
 else if(!empty($password) && $validator->chkbadchar($password) == false)
 {
  $error = "Please enter valid Password ";
 }
  else if(empty($designation))
   {
      
      $error = "Enter your Designation !";
   }
 else if(!empty($designation) && $validator->chkbadchar($designation) == false)
 {
  $error = "Please enter valid Designation ";
 }
  else if(empty($status))
   {
      
      $error = "Enter your Status !";
   }
 else if(!empty($status) && $validator->chkbadchar($status) == false)
 {
  $error = "Please enter valid Status ";
 }
   else if(empty($roll))
   {
      
      $error = "Enter your Role !";
   }
 else if(!empty($roll) && $validator->chkbadchar($roll) == false)
 {
  $error = "Please enter valid Role ";
 }
    else if(empty($dept))
   {
      
      $error = "Select valid Department !";
   }
  else if(empty($court_type))
   {
      
      $error = "Select valid court type !";
   }
  
   else if(!empty($court_type)&&$court_type=='D'&&empty($dist))
   {
      
      $error = "Select valid court type !";
   }
 else
 {
			
			$stmt = $DB_con->prepare("SELECT * FROM mhc_users WHERE username=:user_name  OR mobile=:mobile OR email_id=:email_id");
					$stmt->execute(array(':user_name'=>$user_name,':mobile'=>$mobile,':email_id'=>$email_id));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						if($row['username']==$user_name)
						{
					   $error= 'Username Already Exit';
						}
						else if($row['mobile']==$mobile)
						{
					   $error= 'Mobile No Already Exit';
						}
						else if($row['email_id']==$email_id)
						{
					   $error= 'Email Id Already Exit';
						}
					}
					else
					{
if($user_fun->user_register($full_name,$user_name,$enctype_pass,$mobile,$email_id,$designation,$status,$roll,$menu_list,$mhc_user,$page_id,$ip,$log_fun,$dept,$court_type,$dist))
{							unset($error);
							$user_fun->redirect("user_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
						} 
		}
 }
						}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
	
	 //Delete row
	if (isset($_GET['remove']))
		{
		
     $del_id=$_GET['remove'];
     $page_id=$_GET['page_id'];
		


		if($user_fun->user_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $user_fun->redirect("user_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_user_details= $user_fun->userdata($chkstr,$page_id);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
 ?>
<style>
 .multiselect-container{
	 max-height:200px !important;
 }

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
                                <div class="card-title">New User Registration Form</div>
								<?php
				if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
				  <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize"> <?php echo $error; ?>!</strong> 
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
                 
                  <?php
               }
            }
           
			 else if(isset($_GET['joined']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New User Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">User Details Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">User Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }else if(isset($_GET['joined4']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">User Password Reset Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">First name</label>
                                            <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your First Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Last name</label>
                                            <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Last name"  onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Last Name

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Mobile</label>
                                            <input class="form-control Number" id="mobile" name="mobile" type="text" placeholder="Enter Mobile Number" maxlength="10"  required="required" onchange="CheckMob()" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Mobile Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control" id="user_name" name="user_name" type="text" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required="required" onchange="CheckUsername()" autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid username.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipPassword">Password</label>
                                            <div class="input-group" id='pwd' >
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control" id="password" name="password" type="Password" placeholder="Password" onclick="pwdPopup()" onfocusout="pwdPopup1()" onchange="CheckPassword()"  aria-describedby="validationTooltipPasswordPrepend" required="required" autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please provide a strong password.

                                                </div>
	<span class="popuptext" id="myPopup">Password must be at least 8 characters or atmost 15 characters, containing at least 1 number, 1 lowercase, 1 uppercase letter and atleast one of the following special character from @$._</span>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipemailidPrepend">Email Id</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control" id="email_id" name="email_id" type="email" placeholder="Email Id" aria-describedby="validationTooltipemailidPrepend" required="required" onchange="CheckEmail()" autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid Email Id.

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
									<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Court Type</label>
											<select class="form-control form-control-rounded" name="court_type" id="court_type" required="required" onchange='enable_dist()' autocomplete="off" >
                                              
		   	   <option value="">Choose</option>
			    <?php
				$cond="";
				if($_SESSION['court_type']=='D')
					$cond= " and value='D' ";
$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='court_type'  and display='Y' ".$cond." order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
								echo "<option value='".$m['value']."'>".$m['name']."</option>";}}
?>
</select>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Court type.

                                            </div>
                                        </div>
										  <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">District</label>
											<select class="form-control form-control-rounded" id="dist"  name="dist" autocomplete="off" disabled >
                                                 <option value='0'>Choose</option>
												 <?php
												 $cond="";
												 
				if($_SESSION['usr_dist']!=0)
					$cond= " and dist_code='".$_SESSION['usr_dist']."' ";
$dist_qry="SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y' ".$cond;
										/*if($_SESSION['roll']=='U')
											$dist_qry.= "and dist_code='".$dist."'";*/
										$dist_qry.=" ORDER BY dist_name "; 
										$dist_data = $DB_con->prepare($dist_qry);
					$dist_data->execute();
					if($dist_data->rowCount() > 0){
						while($dist1=$dist_data->fetch()){
							echo '<option value="'.$dist1['dist_code'].'">'.$dist1['dist_name'].'</option>';
						}
						
					}			
?>
                                           
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid district.

                                            </div>
                                        </div>
									<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Department</label>
											<select class="form-control form-control-rounded" name="dept" id="dept" required="required" autocomplete="off" >
                                              
		   	   <option value="">Choose</option>
			    <?php
$select_qry = $DB_con->query("SELECT * FROM departments where display='Y' order by depart");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['sno'].">".$row['depart']." </option>";
}

?>
</select>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Department.

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Designation</label>
                                            <input class="form-control" id="designation" name="designation" type="text" placeholder="Designation" required="required" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                                Please provide a valid Designation.

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip04">Status</label>
											<select class="form-control form-control-rounded" name="status" id="status" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
												<option value="A">Approved</option>
                                                <option value="N">Not Approved</option>
                                            </select>
                                           
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Role</label>
											<select class="form-control form-control-rounded" id="validationTooltip05" required="required" name="roll" autocomplete="off" >
                                                 <option value="">Choose</option>
												 <?php
												 $cond="";
												if($_SESSION['roll']!='A')
					$cond= " and value='".$_SESSION['roll']."' ";
$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='role'  and display='Y' ".$cond." order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
								echo "<option value='".$m['value']."'>".$m['name']."</option>";}}
?>
                                           
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid role.

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="menu_list_id">Menus</label>
											
											<select class="form-control form-control multiselect-ui" id="menu_list_id" required="required" name="menu_list[]" autocomplete="off" multiple>
                                              
												
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid menu.

                                            </div>
                                        </div>
										
                                    </div>
                                    <input  class="btn btn-primary" name="submit" id="submit" value="submit" type="submit" />
                                </form>
                            </div>
                        </div>
						
                    </div>
					 <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">User Details</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Name</th>
												<th>Department</th>
												<th>Designation</th>
                                                <th>Username</th>
                                                <th>Mobile No</th>
                                                <th>Email Id</th>
												<th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_user_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											  <th>Sl.No</th>
                                               <th>Name</th>
											   <th>Department</th>
												<th>Designation</th>
                                                <th>Username</th>
                                                <th>Mobile No</th>
                                                <th>Email Id</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of main-content -->
				
            </div>
			
			<?php include 'include/footer.php' ?>
			 
      
			<script>
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.first_name.value)==false )
   {
     swal("Enter a Valid  First Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#first_name').val('');
         theform.first_name.focus();
    return false;
   }
   if(chkbadchar(theform.last_name.value)==false )
   {
     swal("Enter a Valid  Last Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#last_name').val('');
         theform.last_name.focus();
    return false;
   }
   if(chkbadchar(theform.user_name.value)==false )
   {
     swal("Enter a Valid  User Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#user_name').val('');
         theform.user_name.focus();
    return false;
   }
   else if(chkbadchar(theform.mobile.value)==false )
   {
     swal("Enter a Valid  Mobile Number.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#mobile').val('');
         theform.mobile.focus();
    return false;
   }
   else if(isNumber(theform.mobile.value)==false )
    {
		swal("Enter a Valid  Mobile Number.", "", "error");
		$('#mobile').val('');
         theform.mobile.focus();
    return false;
    }
    else if(chkbadchar(theform.email_id.value)==false )
   {
     swal("Enter a Valid  Email ID.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#email_id').val('');
         theform.email_id.focus();
    return false;
   }
 
   else if(chkbadchar(theform.password.value)==false )
   {
     swal("Enter a Valid  password.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#password').val('');
         theform.password.focus();
    return false;
   }
   else if(chkbadchar(theform.designation.value)==false )
   {
     swal("Enter a Valid  Designation", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#designation').val('');
         theform.designation.focus();
    return false;
   }
   else if(chkbadchar(theform.status.value)==false )
   {
     swal("Enter a Valid  Status", "", "error");
    //alert("Enter a Valid  Status.");
		$('#work_status').val('');
         theform.work_status.focus();
    return false;
   }
   else if(chkbadchar(theform.dept.value)==false )
   {
     swal("Enter a valid department", "", "error");
    //alert("Enter a Valid  Department.");
		$('#dept').val('');
         theform.dept.focus();
    return false;
   }
   else if(chkbadchar(theform.court_type.value)==false )
   {
     swal("Enter a valid court type", "", "error");
    //alert("Enter a Valid  Department.");
		$('#court_type').val('');
         theform.court_type.focus();
    return false;
   }
  
   else if(chkbadchar(theform.dist.value)==false &&(theform.court_type.value)!=''&&(theform.court_type.value)=='D')
   {
     swal("Enter a valid district", "", "error");
    //alert("Enter a Valid  Department.");
		$('#dist').val('');
         theform.dist.focus();
    return false;
   }else if(theform.dist.value==false &&(theform.court_type.value)!=''&&(theform.court_type.value)=='D')
   {
     swal("Enter a valid district", "", "error");
    //alert("Enter a Valid  Department.");
		$('#dist').val('');
         theform.dist.focus();
    return false;
   }
   else if(chkbadchar(theform.roll.value)==false )
   {
     swal("Enter a Valid  Role.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#enroll').val('');
         theform.enroll.focus();
    return false;
   }
 else if(!CheckPassword())
	return false;
    
}
  function CheckMob()
	{
		
		var mobile=$('#mobile').val();
		
		//alert(state_id);
		if(mobile!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "get_data.php",
			data: {
				action:'mobilechk',
				mobile_no:mobile
				},
				success: function(data)
				{	
				if(data == 1) {	
				swal("Mobile Number Already Exists. Try again!!", "", "error");
				$('#mobile').val('');
				$('#mobile').focus();	
					
				}
				else if(data == 2)
				{
					//$('#mobile').focus();
				}
				else
				{
					swal(data, "", "error");
				$('#mobile').val('');
				$('#mobile').focus();	
				}			
				} 
			});
		}
		
}
	function pwdPopup()
	{
		var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
	}
	function pwdPopup1()
	{
		var popup1 = document.getElementById("myPopup");
		popup1.classList.remove("show");
		popup1.classList.toggle("hide");
	}
	function CheckPassword(){
		var pass=$('#password').val();
		 var re =new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$._])[A-Za-z\d@$._]{8,15}$/);
		 if(!re.test(pass))
		 {
			 swal("Please enter a strong password", "", "error");
			 return false;
		 }
		 else return true;
	}
	
	function CheckUsername()
	{
		
		var user_name=$('#user_name').val();
		
		//alert(state_id);
		if(user_name!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "get_data.php",
			data: {
				action:'usernamechk',
				username:user_name
				},
				success: function(data)
				{	
				if(data == 1) {	
				swal("Username Already Exists. Try again!!", "", "error");
				$('#user_name').val('');
				$('#user_name').focus();	
					
				}
				else if(data == 2)
				{
					//$('#user_name').focus();
				}
				else
				{
					swal(data, "", "error");
				$('#user_name').val('');
				$('#user_name').focus();	
				}
							
				} 
			});
		}
		
	}
	function CheckEmail()
	{
		
		var email_id=$('#email_id').val();
		
		//alert(state_id);
		if(email_id!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "get_data.php",
			data: {
				action:'emailchk',
				e_mail_id:email_id
				},
				success: function(data)
				{	
				if(data == 1) {	
				swal("Email Id Number Already Exists. Try again!!", "", "error");
				$('#email_id').val('');
				$('#email_id').focus();
					
				}
				else if(data == 2)
				{
					//$('#email_id').focus();
				}
				else
				{
					swal(data, "", "error");
				$('#email_id').val('');
				$('#email_id').focus();	
				}			
				} 
			});
		}
		
	}
	
		
	function removeRow(id) {
			
	  if ( 'undefined' != typeof id ) {
		  
	
	 swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){


					
					
	  $.get('user_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
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
			</script>
			
			<script>

		 $(function() {
			 
    $('.multiselect-ui').multiselect({
		
       	enableClickableOptGroups: true,
 		includeSelectAllOption: true,
            maxHeight: 350,
			 maxwidth: 500,
            dropUp: true
    });
	
});

		function enable_dist(){
			var court_ty=$('#court_type').val();
			if(court_ty=='D'){
			$('#dist').prop('disabled',false);
			$('#dist').prop('required',true);
			}
		else
		{
			$('#dist').val('0');
				$('#dist').prop('disabled',true);
				$('#dist').prop('required',false);
		}
		setMenu(court_ty);
		}
		function setMenu(court_ty){
			var role='<?php echo $_SESSION['roll']; ?>';
			$.post("action.php", {court_ty: btoa(court_ty),role:role,action:'getMenus'}, function(result){
				
	$("#menu_list_id").html(result);
	$("#menu_list_id").multiselect('rebuild');
	});
		}
		
	</script>