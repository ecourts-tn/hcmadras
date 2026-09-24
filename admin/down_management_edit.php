<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'function/down_fun.php';
$down_fun =new DOWNFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$down_title=htmlspecialchars(filter_input(INPUT_POST, 'down_title', FILTER_SANITIZE_STRING));
					//$down_url=htmlspecialchars(filter_input(INPUT_POST, 'down_url', FILTER_SANITIZE_STRING));
					$down_url='';
					$down_order=htmlspecialchars(filter_input(INPUT_POST, 'down_order', FILTER_SANITIZE_STRING));
					$down_type=htmlspecialchars(filter_input(INPUT_POST, 'down_type', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					if($date_up)
$date_up=date('Y-m-d',strtotime($down_date));
else
	$date_up=date("Y-m-d");
	$mhc_user=$_SESSION['user_session'];
					
					  if(empty($down_title))
   {
      
      $error = "Enter your Downloads Title !";
   }
 else if(!empty($down_title) && $validator->chkbadchar($down_title) == false)
 {
  $error= "Please enter valid Downloads Title";
 }
else if(empty($down_order))
   {
  $error= "Please enter valid Downloads Order ";
 }
 else if($validator->test_datatype($down_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Downloads Order ";
 }

  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(empty($down_type))
 {
  $error = "Please enter valid Download Type ";
 }
 else if(empty($_POST['down_pdf2'])&&$_POST['down_type']=="link")
 {
  $error = "Please enter the link";
 }
 else
 {
	 

		if($down_type=="link")	{	
	$down_url=$_POST['down_pdf2'];
	$dow_size="";
	$down_pdf="";
	$detected_type="";
	$filename="";
	}
	else
	{	

$down_url="";
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
$image1=$_FILES['down_pdf1']['name'];


if ($image1) 
{
	
	$filename = stripslashes($_FILES['down_pdf1']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "PDF") && ($extension != "pdf")&&($extension != "ZIP") && ($extension != "zip")&&($extension != "ttf") && ($extension != "TTF")&&($extension != "rar") && ($extension != "RAR"))
	{
		$error='Upload Documents PDF Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['down_pdf1']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 
function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

$dow_size= formatSizeUnits($size1);

$binary_bar = file_get_contents($_FILES["down_pdf1"]["tmp_name"]);
$down_pdf = pg_escape_bytea($binary_bar);

 
		
		if ($down_pdf=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';
	}
	}
}
else
{
	
	$down_pdf='';
}
	}




if(($down_pdf!='' &&$down_type!="link"))
{
	
	$allowed_types = array('application/pdf','application/x-font-ttf','application/x-rar-compressed','application/x-zip-compressed','application/zip','application/x-rar','application/x-bzip','application/x-bzip2','application/x-7z-compressed','application/gzip','application/vnd.rar','font/ttf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['down_pdf1']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{
	
	if($down_fun->down_update1($edit_id,$down_title,$down_pdf,$date_up,$down_type,$down_url,$down_order,$filename,$detected_type,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun))
{
							unset($error);
							$down_fun->redirect("down_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
}
}
 
}

else if($down_pdf==''&&$down_type!="link")
{
	
		if($down_fun->down_update3($edit_id,$down_title,$date_up,$down_type,$down_url,$down_order,$display,$mhc_user,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun))
{
							unset($error);
							$down_fun->redirect("down_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
}
}	
else{
	
	if($down_fun->down_update1($edit_id,$down_title,$down_pdf,$date_up,$down_type,$down_url,$down_order,$filename,$detected_type,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun))
{
							unset($error);
							$down_fun->redirect("down_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
}
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_downloads where download_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

 if(is_null($editRow['upload_date']))
 {
	 $upload_date='';
 }
 else
 {
	 $upload_date=date('d-m-Y',strtotime($editRow['upload_date']));
 }
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
                                <div class="card-title">Downloads Form - Edit</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Downloads Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Downloads Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Downloads Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								<input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['download_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Downloads Title</label>
                                            <input class="form-control" id="down_title" name="down_title" type="text" placeholder="Downloads name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['down_title']); }?>" />
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Title

                                            </div>
                                        </div> <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Document Type</label>
											 <div class="custom-file">
                                        <select class="form-control form-control-rounded" id="down_type" name="down_type" aria-describedby="inputGroupFileAddon01" onchange="return setUploadType()">
										
										<option value="">Choose</option>
										<option value="pdf"<?php  if(isset($_GET['edit_id'])){ if($editRow['down_type']=='pdf'){ echo "SELECTED"; }}?>>PDF</option>
										<option value="link"<?php  if(isset($_GET['edit_id'])){ if($editRow['down_type']=='link'){ echo "SELECTED"; }}?>>LINK</option>
										<option value="other"<?php  if(isset($_GET['edit_id'])){ if($editRow['down_type']=='other'){ echo "SELECTED"; }}?>>TTF / ZIP / RAR</option>
										</select>
                                       
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
										 <div>
										<label for="validationTooltip02" id="down_pdf_link" name='down_pdf_link2' style="display:none">Link</label>
										<input class="form-control" id="down_pdf2" name="down_pdf2" type="text" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()" style="display:none" value="<?php echo $editRow['down_url'];?>"/></div> 
										 <div>
										 <label for="validationTooltip02" id="down_pdf_link" name='down_pdf_link1' >Upload Document</label>
											<!--<a href="<?php  if(isset($_GET['edit_id'])){ echo "view_pdf.php?pdf_id=".base64_encode($editRow['download_id'])."&page=".base64_encode('O');}?>" target='_blank' name="down_pdf3" ><img src="images/pdf.png" width="50" height="50" id="down_pdf4" /></a>-->
											<span id="down_pdf4" style="font-weight:700;color:blue"><?php echo "Last uploaded file: ".$editRow['down_file_name']; ?></span>
											 <div class="custom-file">
                                        <input class="custom-file-label" id="down_pdf1" name="down_pdf1" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()"/></div> </div>
										
										 <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
									<!--	<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											<img src="view_image.php?img_id=<?php echo base64_encode($editRow['download_id']);?>&page=<?php echo base64_encode('O');?>" width="50" height="50" />
											 <div class="custom-file">
                                        <input class="custom-file-label" id="icon" name="icon" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload1()">
                                       
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Icon.

                                            </div>
                                            
                                        </div>-->
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="down_date" name="down_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($upload_date); }?>" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Downloads on.

                                                </div>
                                            </div>
                                        </div>
                                       <!-- <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Downloads Url</label>
                                             <input class="form-control" id="down_url" name="down_url" type="text" placeholder="Downloads Url"   autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['down_url']); }?>"/>
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Url

                                            </div>
                                        </div>-->
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Downloads Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="down_order" name="down_order" type="text" placeholder="Downloads Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['down_order']); }?>"/>
                                                <div class="invalid-tooltip">
                                                    Please Enter Downloads Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername"> Language</label>
                                             <select class="form-control" id="lang" name="lang" type="text" placeholder=" Language"   autocomplete="off" >
											 <option value="">Choose</option>
                                              <option value="English"<?php  if(isset($_GET['edit_id'])){ if($editRow['d_language']=='English'){ echo "SELECTED"; }}?>>English</option>
											   <option value="Tamil"<?php  if(isset($_GET['edit_id'])){ if($editRow['d_language']=='Tamil'){ echo "SELECTED"; }}?>>Tamil</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your  Language

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">New Icon</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="new_icon" id="new_icon" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['new_icon']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
											   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['new_icon']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Suport OS</label>
                                            <div class="input-group">
                                                
                                                 <input class="form-control" name="app_os" id="app_os" required="required" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['d_app']); }?>" autocomplete="off" >
                                                
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                               <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
                                                <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
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
			$(document).ready(function(){
				if(($("#down_type").val())!="link")
				{
					$("input[name=down_pdf3]").css('display','block');
					$("input[name=down_pdf1]").css('display','block');
					$("#down_pdf4").css('display','block');
					$("input[name=down_pdf2]").css('display','none');
					$("label[name=down_pdf_link1]").css('display','block');
					$("label[name=down_pdf_link2]").css('display','none');
				}
				else
				{
					$("input[name=down_pdf3]").css('display','none');
					$("input[name=down_pdf2]").css('display','block');
					$("input[name=down_pdf1]").css('display','none');
					$("#down_pdf4").css('display','none');
					$("label[name=down_pdf_link1]").css('display','none');
					$("label[name=down_pdf_link2]").css('display','block');
				}
			});
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.down_title.value)==false )
   {
     swal("Enter a Valid  Downloads Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#down_title').val('');
         theform.down_title.focus();
    return false;
   }
   else if(chkbadchar(theform.down_date.value)==false )
   {
     swal("Enter a Valid  Upload Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#down_date').val('');
         theform.down_date.focus();
    return false;
   }
   else if(isNumber(theform.down_order.value)==false )
    {
		swal("Enter a Valid  Downloads Order.", "", "error");
		$('#down_order').val('');
         theform.down_order.focus();
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
	if($('#down_type').val()!="link"){
        var fuData = document.getElementById('down_pdf1');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#down_pdf1').val('');
         $('#down_pdf1').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "PDF" || Extension == "pdf"||Extension == "RAR" || Extension == "rar"||Extension == "ZIP" || Extension == "zip"||Extension == "ttf" || Extension == "TTF") {

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
	 $('#down_pdf1').val('');
         $('#down_pdf1').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
	}}
	else
	{
		if($('#down_pdf2').val()=="")
			swal("Please enter the Link", "", "error");
	}
    }
	function ValidateFileUpload1() {
        var fuData = document.getElementById('icon');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#icon').val('');
         $('#icon').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "JPG" || Extension == "jpg" || Extension == "jpeg") {

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
	 $('#icon').val('');
         $('#icon').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
	function setUploadType()
	{
		var type=$("#down_type").val();
		if(type=="link")
		{
			$("label[name=down_pdf_link1]").css('display','none');
			$("label[name=down_pdf_link2]").css('display','block');
			$("input[name=down_pdf1]").css('display','none');
			$("input[name=down_pdf2]").css('display','block');
			$("input[name=down_pdf3]").css('display','none');
			$("#down_pdf4").css('display','none');
		}
		else{
			$("label[name=down_pdf_link2]").css('display','none');
			$("label[name=down_pdf_link1]").css('display','block');
			$("input[name=down_pdf2]").css('display','none');
			$("input[name=down_pdf1]").css('display','block');
			$("input[name=down_pdf3]").css('display','block');
			$("#down_pdf4").css('display','block');
		}
			
	}
	/* function CheckUsername()
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
					$('#user_name').focus();
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
		
	} */
	
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