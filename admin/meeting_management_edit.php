<?php 
include 'include/header.php';
include 'function/meeting_fun.php';
$meeting_fun =new MEETINGFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
define ("MAX_SIZE","1000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$meeting_title=htmlspecialchars(filter_input(INPUT_POST, 'meeting_title', FILTER_SANITIZE_STRING));
				$meeting_date=date('Y-m-d', strtotime($_POST['meeting_date']));
				$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
				
					$meeting_judges=implode(',',$_POST['jud_list']);
					$mhc_user=$_SESSION['user_session'];
					
					
					
					  if($_FILES["meeting_file"]["name"] != '')
				{
					clearstatcache(true);
					$image1=$_FILES['meeting_file']['name'];
								
								$allowed_types = array ('application/pdf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['meeting_file']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{
					if ($image1) 
{
	$filename = stripslashes($_FILES['meeting_file']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "PDF") && ($extension != "pdf")) 
	{
		$error='Upload Documents PDF Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['meeting_file']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 

$meeting_file = file_get_contents($_FILES["meeting_file"]["tmp_name"]);
					$img_thmp = pg_escape_bytea($meeting_file);

		
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
				
					
	 if(empty($meeting_title))
   {
      
      $error = "Enter your Meeting Title !";
   }
 else if(!empty($meeting_title) && $validator->chkbadchar($meeting_title) == false)
 {
  $error= "Please enter valid Meeting Title";
 }
 else if(empty($meeting_judges))
{
      
      $error = "Enter your Meeting Judges !";
	  
}

else if(empty($meeting_date))
{
      
      $error = "Enter your Meeting Date !";
	  
}
else if($validator->chkbadchar($meeting_date) == false)
 {
  $error= "Please enter valid Meeting Date ";
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
			
			
	
if($meeting_fun->meeting_update($edit_id,$meeting_title,$meeting_judges,$meeting_date,$img_thmp,$display,$mhc_user,$page_id,$ip,$log_fun))
{
	
	$meeting_fun->redirect("meeting_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 

			
		 
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_metting_files where files_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

 if(is_null($editRow['meeting_date']))
 {
	 $meeting_date='';
 }
 else
 {
	 $meeting_date=date('d-m-Y',strtotime($editRow['meeting_date']));
 }
 $jud_data=explode(',',$editRow['meeting_judges']);
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
                                <div class="card-title">Meeting Management Update Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Meeting File Successfully Uploaded</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Photo Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Photo Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								<input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['files_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip01">Meeting Title</label>
                                            <input class="form-control" id="meeting_title" name="meeting_title" type="text" placeholder="Meeting name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['meeting_title']); }?>" />
                                            <div class="invalid-tooltip">
                                               Enter Your Meeting Title

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Meeting Judges</label>
                                           
                                             <select class="form-control form-control multiselect-ui" id="jud_list" required="required" name="jud_list[]" autocomplete="off" multiple>
                                                
												
												 <?php
										

$jud_qry = $DB_con->query("select j_id,j_name,j_coram,j_prefix from judges where j_page='PJ' AND j_display='Y' order by j_sen asc"); 
										while($jud_result = $jud_qry->fetch()){
											
											
											$hon="Hon'ble ";
											$prefi=$jud_result['j_prefix'];
			
											$coram=$jud_result['j_coram'];
											$name=$jud_result['j_name'];
											
	if($coram=='CJ')
	{
		$fjudge=', Chief Justice';
		
	}else
	{
		
		$fjudge='';
	}
	
	$jud_name=$coram."-".$hon.$prefi.".Justice ".$name.$fjudge;

	if(in_array($jud_result['j_id'],$jud_data))
	{
		
		echo "<option value='".$jud_result['j_id']."' SELECTED>".$jud_name."</option>";
		
	
	}
	else
	{
		echo "<option value='".$jud_result['j_id']."'>".$jud_name."</option>";
	}
	
										}
											 ?>
                                            
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Meeting Judges

                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Meeting Date</label>
                                            <input class="form-control datepicker" name="meeting_date" id="meeting_date" required="required" autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($meeting_date); }?>" />
                                             
                                            <div class="invalid-tooltip">
                                               Enter Your Meeting Date

                                            </div>
                                        </div>
									
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Meeting File Upload</label>
                                           
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="meeting_file" name="meeting_file" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                      
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Meeting File.

                                            </div>
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
											<div class="invalid-tooltip">
                                                Please provide a Display
                                            </div>
                                        </div>
										
										<div class="col-md-12 form-group mb-12">		
            
				  
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
					 $( function() {
    $( ".datepicker" ).datepicker({
		dateFormat:'d-m-yy'
	});
  } );
			function Validator(theform)
{
	
    
     if(chkbadchar(theform.meeting_title.value)==false )
   {
     swal("Enter a Valid  Meeting Title.", "", "error");

		$('#meeting_title').val('');
         theform.meeting_title.focus();
    return false;
   }
   else if(chkbadchar(theform.jud_list.value)==false )
   {
     swal("Enter a Valid  Judges Details.", "", "error");

		$('#jud_list').val('');
         theform.jud_list.focus();
    return false;
   }
    else if(chkbadchar(theform.jud_list.value)==false )
   {
     swal("Enter a Valid  Judges Details.", "", "error");

		$('#jud_list').val('');
         theform.jud_list.focus();
    return false;
   }
  else if(chkbadchar(theform.meeting_date.value)==false )
   {
     swal("Enter a Valid Meeting Date.", "", "error");

		$('#meeting_date').val('');
         theform.meeting_date.focus();
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
        var fuData = document.getElementById('meeting_file');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#meeting_file').val('');
         $('#meeting_file').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "PDF" || Extension == "pdf") {

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
	 swal("Document only allows file type of PDF", "", "error");
	 $('#meeting_file').val('');
         $('#meeting_file').focus();
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
        return false;
        return true;
    }
	    
		
		
			</script>
				<script>

		 $(function() {
			 
    $('.multiselect-ui').multiselect({
		

 		includeSelectAllOption: true,
            maxHeight: 350,
            dropUp: false
    });
	
});

		
		
	</script>