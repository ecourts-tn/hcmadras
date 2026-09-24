<?php 
include 'include/header.php';

include 'function/user_fun.php';
$user_fun =new USERFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
	
		
		$full_name=$first_name;
try
		{
				
					$mobile=htmlspecialchars(filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING));
					$email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
					
					$status=htmlspecialchars(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING));
					$dept=htmlspecialchars(filter_input(INPUT_POST, 'dept', FILTER_SANITIZE_STRING));
					$court_type=htmlspecialchars(filter_input(INPUT_POST, 'court_type', FILTER_SANITIZE_STRING));
					$roll=htmlspecialchars(filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_STRING));
					$designation=htmlspecialchars(filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_STRING));
					
						$menu_list = trim(implode(',',array_unique($_POST['menu_list'])));
						
						//$menu_list=trim($menu_list1);
					  if(empty($full_name))
   {
      
      $error = "Enter your First Name !";
   }
 else if(!empty($full_name) && $validator->chkbadchar($full_name) == false)
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
   else if(empty($dept))
   {
      
      $error = "Please select valid Department !";
   }
   else if(empty($court_type))
   {
      
      $error = "Please select valid court type !";
   }
   else if(!empty($court_type)&&$court_type=='D'&&empty($dist))
   {
      
      $error = "Select valid court type !";
   }
   else if(empty($roll))
   {
      
      $error = "Enter your Role !";
   }
 else if(!empty($roll) && $validator->chkbadchar($roll) == false)
 {
  $error = "Please enter valid Role ";
 }
 else
 {
			
		
if($user_fun->user_update($edit_id,$full_name,$mobile,$email_id,$designation,$status,$roll,$menu_list,$mhc_user,$page_id,$ip,$log_fun,$dept,$court_type,$dist))
{
							unset($error);
							$user_fun->redirect("user_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
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
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
$menu_list=explode(',',$editRow['menu_id']);
}
 ?>
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
                                <div class="card-title"> User Edit Form</div>
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
           
			?>
		<style>	
		
		.multiselect-container{
	 max-height:200px !important;
 }
 </style>
               <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
			   <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['mhc_user_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Name</label>
                                            <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['full_name']); }?>" />
                                            <div class="invalid-tooltip">
                                               Enter Your  Name

                                            </div>
                                        </div>
                                        
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Mobile</label>
                                            <input class="form-control Number" id="mobile" name="mobile" type="text" placeholder="Enter Mobile Number" maxlength="10"  required="required" onchange="CheckMob()" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['mobile']); }?>"/>
                                            <div class="invalid-tooltip">
                                               Enter Your Mobile Name

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipemailidPrepend">Email Id</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control" id="email_id" name="email_id" type="email" placeholder="Email Id" aria-describedby="validationTooltipemailidPrepend" required="required" onchange="CheckEmail()" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['email_id']); }?>"/>
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid Email Id.

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control" id="user_name" name="user_name" type="text" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required="required" onchange="CheckUsername()" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['username']); }?>" readonly />
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid username.

                                                </div>
                                            </div>
                                        </div>
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
								if($editRow['court_type']==$m['value'])
									echo "<option value='".$m['value']."' selected >".$m['name']."</option>";
								else
									echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}
?>
</select>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Court type.

                                            </div>
                                        </div>
										  <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">District</label>
											<select class="form-control form-control-rounded" id="dist"  name="dist" autocomplete="off" <?php if($editRow['court_type']=='H') echo "disabled";?> >
                                                 <option value="0">Choose</option>
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
								if($editRow['dist_id']==$dist1['dist_code'])
									echo "<option value='".$dist1['dist_code']."' selected >".$dist1['dist_name']."</option>";
								else
							echo '<option value="'.$dist1['dist_code'].'">'.$dist1['dist_name'].'</option>';
						}
						
					}			
?>
                                           
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid district.

                                            </div>
                                        </div>
										
										
										
                                    </div>
                                    <div class="form-row">
									<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip04">Department</label>
											<select class="form-control form-control-rounded" name="dept" id="dept" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
												 <?php
$select_qry = $DB_con->query("SELECT * FROM departments where display='Y' order by depart");
while($row = $select_qry->fetch())
{
	if(isset($_GET['edit_id']))
	{
		if($editRow['dept']==$row['sno'])
			echo "<option value=".$row['sno']." SELECTED>".$row['depart']." </option>";
		else
			echo "<option value=".$row['sno'].">".$row['depart']." </option>";
	}
	
}

?>
											</select>
                                           
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.

                                            </div>
                                        </div>
									<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Designation</label>
                                            <input class="form-control" id="designation" name="designation" type="text" placeholder="Designation" required="required" onKeyPress="return ValidateAlpha(event);" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['designation']); }?>"/>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Designation.

                                            </div>
                                        </div>
                                         <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip04">Status</label>
											<select class="form-control form-control-rounded" name="status" id="status" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                                <option value="A"<?php  if(isset($_GET['edit_id'])){ if($editRow['status']=='A'){ echo "SELECTED"; }}?>>Approved</option>
                                                <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['status']=='N'){ echo "SELECTED"; }}?>>Not Approved</option>
                                            </select>
                                           
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.

                                            </div>
                                        </div>
                                       
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Role</label>
											<select class="form-control form-control-rounded" id="validationTooltip05" required="required" name="roll" autocomplete="off" >
                                                 <option value="0">Choose</option>
												  <?php
												   $cond="";
												if($_SESSION['roll']!='A')
					$cond= " and value='".$_SESSION['roll']."' ";
$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='role'  and display='Y' ".$cond." order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
								if($editRow['roll']==$m['value'])
									echo "<option value='".$m['value']."' selected >".$m['name']."</option>";
								else
									echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}
?>
                                               
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid zip.

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Menu Assign</label>
											<select class="form-control multiselect-ui" id="menu_list_id"  required="required" name="menu_list[]" autocomplete="off" multiple>
                                                 
												 
                                            
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid zip.

                                            </div>
                                        </div>
                                    </div>
                                    <input  class="btn btn-primary" name="submit" id="submit" value="submit" type="submit" />
                                </form>
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
    //alert("Enter a Valid  First Name.");
		$('#work_status').val('');
         theform.work_status.focus();
    return false;
   }
    else if(chkbadchar(theform.dept.value)==false )
   {
     swal("Select a Valid  Department", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#dept').val('');
         theform.dept.focus();
    return false;
   }
    else if(chkbadchar(theform.court_type.value)==false )
   {
     swal("Select a valid  court type", "", "error");
    //alert("Enter a Valid  First Name.");
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
   }
    else if(theform.dist.value==false &&(theform.court_type.value)!=''&&(theform.court_type.value)=='D')
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
					$('#mobile').focus();
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
					$('#email_id').focus();
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
			var id='<?php echo $_GET['edit_id']; ?>';
			$.post("action.php", {court_ty: btoa(court_ty),role:role,id:id,action:'getMenusEdit'}, function(result){
	$("#menu_list_id").html(result);
	$("#menu_list_id").multiselect('rebuild');
	});
		}
		$(document).ready(function(){
			var role='<?php echo $_SESSION['roll']; ?>';
			var id='<?php echo $_GET['edit_id']; ?>';
			var court_ty=$('#court_type').val();
			$.post("action.php", {court_ty: btoa(court_ty),role:role,id:id,action:'getMenusEdit'}, function(result){
			
	$("#menu_list_id").html(result);
	$("#menu_list_id").multiselect('rebuild');
	});
			});
		
	</script>