<?php 
include 'include/header.php';
include 'function/video_fun.php';
$video_fun =new VIDEOFUN($DB_con);

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
				$video_title=htmlspecialchars(filter_input(INPUT_POST, 'video_title', FILTER_SANITIZE_STRING));
					$video_url=htmlspecialchars(filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_STRING));
					$video_order=htmlspecialchars(filter_input(INPUT_POST, 'video_order', FILTER_SANITIZE_STRING));
					$video_type=htmlspecialchars(filter_input(INPUT_POST, 'video_type', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
					$mhc_user=$_SESSION['user_session'];
					$cur_date=date('Y-m-d');
					  if($_FILES["photo"]["name"] != '')
				{
					clearstatcache(true);
								$image1=$_FILES['photo']['name'];
								$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['photo']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG Only!';
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
		$error='Upload Documents JPG Only!';
		
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
	}
	}
}
}
				}
				else
				{
					$img_thmp ="";
				}
				
					
					  if(empty($video_title))
   {
      
      $error = "Enter your Video Name !";
   }
 else if(!empty($video_title) && $validator->chkbadchar($video_title) == false)
 {
  $error= "Please enter valid Video Name";
 }
				 else if(empty($video_url))
   {
      
      $error = "Enter your Video URL !";
   }


 else if($validator->chkbadchar($video_order) == false)
 {
  $error= "Please enter valid Video Order ";
 }
 else if($validator->test_datatype($video_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Video Order ";
 }

  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
 
 else
 {
			
			
						
						
if($video_fun->video_update($edit_id,$video_title,$video_url,$video_order,$video_type,$img_thmp,$display,$mhc_user,$cur_date,$bd22,$page_id,$ip,$log_fun))
{
						unset($error);
						$video_fun->redirect("video_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
	
	$sql1 ="select * from mhc_videos where video_id='$edit'";
		$exe1 = pg_query($bd22,$sql1);
		$sno=1;
		$editRow = pg_fetch_array($exe1);
		
			/* $id_proof_img = pg_unescape_bytea($editRow['video_image']);
			$extension ='jpg';
			$fileId = $editRow['video_id'].'test';
			$filename1 = $fileId . '.' .$extension;
			$fileHandle = fopen($filename1, 'w');
			fwrite($fileHandle, $id_proof_img);
			fclose($fileHandle); */

 
 
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
                                <div class="card-title">New Video Update Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Video Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Video Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Video Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								 <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['video_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Video Title</label>
                                            <input class="form-control" id="video_title" name="video_title" type="text" placeholder="Video name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['video_title']); }?>" />
                                            <div class="invalid-tooltip">
                                               Enter Your Video Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Video Url</label>
                                            <input class="form-control" id="video_url" name="video_url" type="text" placeholder="Video Url"   autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['video_url']); }?>"/>
                                            <div class="invalid-tooltip">
                                               Enter Your Video Url

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Video Order</label>
                                            <input class="form-control Number" id="video_order" name="video_order" type="text" placeholder="Enter Video Order" maxlength="2"  required="required"  autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['video_order']); }?>"/>
                                            <div class="invalid-tooltip">
                                               Enter Your Video Order 

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
											
										    <br>
										    <img src="view_image.php?img_id=<?php echo base64_encode($editRow['video_id']);?>&page=<?php echo base64_encode('V');?>" width="100" height="75" style="border:1px solid #ccc; padding:4px;" />
                                      
                                        </div>
										
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
											   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Video</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="video_type" id="video_type" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="M"<?php  if(isset($_GET['edit_id'])){ if($editRow['video_type']=='M'){ echo "SELECTED"; }}?>>Main Video</option>
											   <option value="S"<?php  if(isset($_GET['edit_id'])){ if($editRow['video_type']=='S'){ echo "SELECTED"; }}?>>Sub Video</option>
											 <option value="F"<?php  if(isset($_GET['edit_id'])){ if($editRow['video_type']=='F'){ echo "SELECTED"; }}?>>e-Filing</option>
                                            </select>
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
	
    
    if(chkbadchar(theform.video_title.value)==false )
   {
     swal("Enter a Valid  Video Title.", "", "error");

		$('#video_title').val('');
         theform.video_title.focus();
    return false;
   }
  
  else if(chkbadchar(theform.video_order.value)==false )
   {
     swal("Enter a Valid  Video Order.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#video_order').val('');
         theform.video_order.focus();
    return false;
   }

    else if(chkbadchar(theform.video_type.value)==false )
   {
     swal("Enter a Valid  video type.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#video_type').val('');
         theform.video_type.focus();
    return false;
   }
 
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#display').val('');
         theform.display.focus();
    return false;
   }
   
    
}

 function ValidateFileUpload() {
        var fuData = document.getElementById('photo');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#photo').val('');
         $('#photo').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "JPG" || Extension == "jpg") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        //$('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
	 swal("Photo only allows file type of JPG", "", "error");
	 $('#photo').val('');
         $('#photo').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
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
       // return false;
        return true;
    }
			</script>