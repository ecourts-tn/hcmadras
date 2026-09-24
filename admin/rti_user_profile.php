<?php
include 'include/header.php';
include 'function/profile_fun.php';
$profile_fun =new PROFILEFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);
define ("MAX_SIZE","1000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$errors=0;
	if(isset($_POST['submit'])) {
		
		
try
		{
				$name=htmlspecialchars(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
					$dob=htmlspecialchars(filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING));
					$email_id=htmlspecialchars(filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING));
					$gender=htmlspecialchars(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING));
					$proof_type=htmlspecialchars(filter_input(INPUT_POST, 'proof_type', FILTER_SANITIZE_STRING));
					$profession=htmlspecialchars(filter_input(INPUT_POST, 'profession', FILTER_SANITIZE_STRING));
					$lives_in=htmlspecialchars(filter_input(INPUT_POST, 'lives_in', FILTER_SANITIZE_STRING));
					$address=htmlspecialchars(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
					
					$rti_user=$_SESSION['user_session'];
					$rti_menu_id=87;
					
					$dob_date=date('Y-m-d',strtotime($dob));
				
					$image1=stripslashes($_FILES['photo']['name']);
					$image2=stripslashes($_FILES['proof_img']['name']);
					
					  if(empty($name))
   {
      
      $error = "Enter your  Name !";
   }
 else if(!empty($name) && $validator->chkbadchar($name) == false)
 {
  $error= "Please enter valid Name";
 }
				 else if(empty($dob_date))
   {
      
      $error = "Enter your Date of Birth !";
   }
else if(!empty($dob_date) && $validator->chkbadchar($dob_date) == false)
 {
  $error= "Please enter valid Date of Birth";
 }
else if(empty($email_id))
 {
  $error= "Please enter Email Id";
 }
 else if($validator->chkbadchar($email_id) == false)
 {
  $error= "Please enter valid Email Id ";
 }
 

  else if(empty($gender))
   {
      
      $error = "Enter your Gender !";
   }
 else if(!empty($gender) && $validator->chkbadchar($gender) == false)
 {
  $error = "Please enter valid Gender ";
 }
 else if(empty($proof_type))
   {
      
      $error = "Enter your Id Proof Type !";
   }
 else if(!empty($proof_type) && $validator->chkbadchar($proof_type) == false)
 {
  $error = "Please enter valid Id Proof Type ";
 }
  else if(empty($profession))
   {
      
      $error = "Enter your Profession !";
   }
 else if(!empty($profession) && $validator->chkbadchar($profession) == false)
 {
  $error = "Please enter valid Profession ";
 }
  else if(empty($lives_in))
   {
      
      $error = "Enter your Lives In !";
   }
 else if(!empty($lives_in) && $validator->chkbadchar($lives_in) == false)
 {
  $error = "Please enter valid Lives In ";
 }
  else if(empty($image1))
   {
      
      $error = "Upload your Photo !";
   }
 else if(!empty($image1) && $validator->chkbadchar($image1) == false)
 {
  $error= "Please Upload valid Photo";
 }
  else if(empty($image2))
   {
      
      $error = "Upload your Upload Proof Image !";
   }
 else if(!empty($image2) && $validator->chkbadchar($image2) == false)
 {
  $error= "Please Upload valid  Upload Proof Image";
 }
 else
 {
			
		
					clearstatcache(true);
					
						$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['photo']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Photo JPG Only!';
}
else
{

					if ($image1) 
{
	$filename = stripslashes($_FILES['photo']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	
	if (($extension != "JPG") && ($extension != "jpg")) 
	{

		$error='Upload Photo JPG Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['photo']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 


$binary_photo = file_get_contents($_FILES["photo"]["tmp_name"]);
					$img_thmp = pg_escape_bytea($binary_photo);

 
		
		if ($img_thmp=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';
	
			
				$allowed_types1 = array ('image/jpeg','image/jpg');
$fileInfo1 = finfo_open(FILEINFO_MIME_TYPE);
$detected_type1 = finfo_file( $fileInfo1, $_FILES['proof_img']['tmp_name'] );
if ( !in_array($detected_type1, $allowed_types1) ) {
		$error='Upload Documents JPG Only!';
}
else
{

					if ($image2) 
{
	$filename2 = stripslashes($_FILES['proof_img']['name']);
	$extension2 = getExtension($filename2);
	$extension2 = strtolower($extension2);
	
	if (($extension2 != "JPG") && ($extension2 != "jpg")) 
	{

		$error='Upload Documents JPG Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['proof_img']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 


$binary_photo2 = file_get_contents($_FILES["proof_img"]["tmp_name"]);
					$proof_img = pg_escape_bytea($binary_photo2);

 
		
		if ($proof_img=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';			
			
if($profile_fun->profile_update($rti_user,$rti_menu_id,$name,$dob_date,$email_id,$img_thmp,$gender,$proof_type,$proof_img,$profession,$lives_in,$address,$page_id,$ip,$log_fun))
{
							$profile_fun->redirect("rti_user_profile.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
						} 
						
	}
	}
}
}
	}
	}
}
 }
		
 }
						}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
	

	 	try
{
	
$Get_video_details= $profile_fun->videodata($chkstr,$bd22,$page_id);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
?>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>User Profile</h1>
                    <ul>
                        <li><a href="">Pages</a></li>
                        <li>User Profile</li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="card user-profile o-hidden mb-4">
				<?php
				if($_SESSION['profile_status']=='N')
						{
							
				
				?>
                    <div class="header-cover" style="background-image: url('images/2019-06-15_115415.6724320000.jpg')"></div>
                    <div class="user-info"><img class="profile-picture avatar-lg mb-2" src="images/2048px-User_icon_2.svg.png" alt="" />
                        <p class="m-0 text-24">Welcome <?php echo $_SESSION['user_name']; ?></p>
                        <p class="text-muted m-0">Build your profile after that Ready to use</p>
                    </div>
					<?php
						}
						else
						{
							$edit=$_SESSION['user_session'];
							 $stmt = $DB_con->prepare("SELECT  * FROM mhc_rti_users where rti_user_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
  if(is_null($editRow['dob']))
 {
	 $dob='';
 }
 else
 {
	 $dob=date('F d, Y',strtotime($editRow['dob']));	
 }
 
 if($editRow['id_proof_type']==1)
 {
	 $type='Aadhar Card';
 }
 else if($editRow['id_proof_type']==2)
 {
	 $type='Pan Card';
 }
 else if($editRow['id_proof_type']==3)
 {
	 $type='Voter Id';
 }
  else if($editRow['id_proof_type']==4)
 {
	 $type='Driving Licence';
 }
 else
 {
	  $type='';
 }
						?>
						<div class="header-cover" style="background-image: url('images/2019-06-15_115415.6724320000.jpg')"></div>
                    <div class="user-info"><img class="profile-picture avatar-lg mb-2" src="view_image.php?img_id=<?php echo  base64_encode($editRow['rti_user_id']);?>&page=<?php echo  base64_encode('RTI');?>" alt="" />
                        <p class="m-0 text-24">Welcome <?php echo $_SESSION['full_name']; ?></p>
                        <p class="text-muted m-0">Your profile</p>
                    </div>
						<?php
						}
						?>
                    <div class="card-body">
                        <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
						<?php
				if($_SESSION['profile_status']=='N')
						{
				?>
                            <li class="nav-item"><a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">Build  your profile</a></li>
							<?php
						}
						else
						{
						?>
                            <li class="nav-item"><a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a></li>
							<?php
						}
						?>
                            
                        </ul>
                        <div class="tab-content" id="profileTabContent">
							<?php
				if($_SESSION['profile_status']=='N')
						{
				?>
                            <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">New Profile Registration Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Profile Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Profile Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Profile Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter Your Full Name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Full Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Date of Birth</label>
                                            <input class="form-control" id="dob" name="dob" type="text" placeholder="Enter Your Birth Date"   autocomplete="off" />
                                            <div class="invalid-tooltip">
                                              Enter Your Birth Date

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Email Id</label>
                                            <input class="form-control" id="email_id" name="email_id" type="email" placeholder=" Enter Your Email Id "  required="required"  autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Email Id 

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Photo</label>
                                           
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="photo" name="photo" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Photo.

                                            </div>
											
                                        </div>
										
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Gender</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="gender" id="gender" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Male">Male</option>
											   <option value="Female">Female</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Id Proof Type</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="proof_type" id="proof_type" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                             <option value="1">Aadhar Card</option>
                                  <option value="2">Pan Card</option>
                                  <option value="3">Voter Id</option>
                                  <option value="4">Driving Licence</option>  
											 
                                            </select>
                                            </div>
                                        </div>
										 <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Upload Id Proof</label>
                                           
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="proof_img" name="proof_img" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Id Proof.

                                            </div>
											
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Profession</label>
                                            <div class="input-group">
                                                
                                                 <input class="form-control " name="profession" id="profession" required="required" autocomplete="off" placeholder=" Enter Your Profession">
                                                
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Lives In</label>
                                            <div class="input-group">
                                                
                                                 <input class="form-control " name="lives_in" id="lives_in" required="required" autocomplete="off" placeholder=" Enter Your Lives In">
                                                
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Address</label>
                                           <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Textarea</span>
									</div>
                                    <textarea class="form-control" aria-label="With textarea"placeholder=" Enter Your Full Address" name="address" id="address"></textarea>
                                </div>
                                        </div>
                                    </div>
                                    
                                    <input  class="btn btn-primary" name="submit" id="submit" type="submit" value="submit"/>
                                </form>
                            </div>
                        </div>
						
                    </div>
                            </div>
							<?php
						}
						else
						{
									?>
                            <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <h4>Personal Information</h4>
                                <p>  
                                </p>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4 col-6">
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i>Name</p><span><?php echo $editRow['full_name'];?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Mobile No</p><span><?php echo $editRow['mobile_no'];?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Lives In</p><span><?php echo $editRow['lives_in'];?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p><span><?php echo $dob;?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p><span><?php echo $editRow['gender'];?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Id Proof Type</p><span><?php echo $type;?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession</p><span><?php echo $editRow['profession'];?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> E-mail</p><span><?php echo $editRow['email_id'];?></span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Address</p><span><?php echo $editRow['address'];?></span>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <h4>Proof Document</h4>
                                <p class="mb-4"></p>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center"><img class="" src="view_image.php?img_id=<?php echo  base64_encode($editRow['rti_user_id']);?>&page=<?php echo  base64_encode('RTID');?>" alt="" />
                                    </div>
                                    
                                    
                                    
                                   
                                    
                                </div>
                            </div>
                            <?php
						}
						?>
                            
                        </div>
                    </div>
                </div><!-- end of main-content -->
            </div><!-- Footer Start -->
            <?php
			include 'include/footer.php';
			?>