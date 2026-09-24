<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'function/trans_fun.php';
$trans_fun =new TRANSFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$cadre=htmlspecialchars(filter_input(INPUT_POST, 'cadre', FILTER_SANITIZE_STRING));
				$type=htmlspecialchars(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING));
					$not_no=htmlspecialchars(filter_input(INPUT_POST, 'not_no', FILTER_SANITIZE_STRING));
					$not_year=htmlspecialchars(filter_input(INPUT_POST, 'not_year', FILTER_SANITIZE_STRING));
					$trans_lan=htmlspecialchars(filter_input(INPUT_POST, 'trans_lan', FILTER_SANITIZE_STRING));
					$trans_order=htmlspecialchars(filter_input(INPUT_POST, 'trans_order', FILTER_SANITIZE_STRING));
					$trans_date=htmlspecialchars(filter_input(INPUT_POST, 'trans_date', FILTER_SANITIZE_STRING));
					$new=htmlspecialchars(filter_input(INPUT_POST, 'new', FILTER_SANITIZE_STRING));					
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					$icon_img=htmlspecialchars(filter_input(INPUT_POST, 'icon', FILTER_SANITIZE_STRING));
					
	$mhc_user=$_SESSION['user_session'];
	
	if($trans_date!='')
	{
	$trans_dt=date('Y-m-d',strtotime($trans_date));	
	}
	else
	{
		$trans_dt=NULL;
	}
	
	
	if(empty($cadre))
   {
      
      $error = "Enter your Cadre Lable !";
   }
 else if(!empty($cadre) && $validator->chkbadchar($cadre) == false)
 {
  $error= "Please enter valid Cadre Title";
 }
	else  if(empty($type))
   {
      
      $error = "Enter your Notification Type !";
   }
 else if(!empty($type) && $validator->chkbadchar($type) == false)
 {
  $error= "Please enter valid Notification Type";
 }
 	else  if(empty($not_no))
   {
      
      $error = "Enter your Notification No !";
   }
 else if(!empty($not_no) && $validator->chkbadchar($not_no) == false)
 {
  $error= "Please enter valid Notification No";
 }
  else if($validator->test_datatype($not_no,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Notification No ";
 }
 	else  if(empty($not_year))
   {
      
      $error = "Enter your Notification Year !";
   }
 else if(!empty($not_year) && $validator->chkbadchar($not_year) == false)
 {
  $error= "Please enter valid Notification Year";
 }
  else if($validator->test_datatype($not_year,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Notification Year ";
 }
  else if(empty($trans_lan))
   {
      
      $error = "Enter your Transfer Notification Language !";
   }
 else if(!empty($trans_lan) && $validator->chkbadchar($trans_lan) == false)
 {
  $error= "Please enter valid Transfer Notification Language";
 }
else if(empty($trans_order))
   {
  $error= "Please enter valid Transfer Notification Order ";
 }
 else if($validator->test_datatype($trans_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Transfer Notification Order ";
 }
 else if(empty($trans_dt))
   {
      
      $error = "Enter your Transfer On!";
   }
 else if(!empty($trans_dt) && $validator->chkbadchar($trans_dt) == false)
 {
  $error= "Please enter valid Transfer On";
 }
else if(empty($new))
   {
      
      $error = "Enter your New Icon !";
   }
 else if(!empty($new) && $validator->chkbadchar($new) == false)
 {
  $error= "Please enter valid New Icon";
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
$image1=$_FILES['trans_pdf']['name'];

if ($image1) 
{
	$allowed_types = array ('application/pdf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['trans_pdf']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{
	$filename = stripslashes($_FILES['trans_pdf']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "PDF") && ($extension != "pdf")) 
	{
		$error='Upload Documents PDF Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['trans_pdf']['tmp_name']);
 
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

$trans_size= formatSizeUnits($size1);
		$binary_bar = file_get_contents($_FILES["trans_pdf"]["tmp_name"]);
$trans_pdf = pg_escape_bytea($binary_bar);
if ($trans_pdf=='') 
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
else
{
	$trans_pdf='';
	$trans_size='';
}


		if($trans_fun->trans_update($edit_id,$cadre,$type,$not_no,$not_year,$trans_pdf,$trans_size,$trans_lan,$trans_order,$trans_dt,$new,$display,$icon_img,$mhc_user,$page_id,$ip,$log_fun))
{
							unset($error);
							$trans_fun->redirect("transfer_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_transfer where transfer_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
echo "gfqegfjhwhho".$editRow['transfer_type'];
 if(is_null($editRow['transfer_date']))
 {
	 $transfer_date='';
 }
 else
 {
	 $transfer_date=date('d-m-Y',strtotime($editRow['transfer_date']));
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
                                <div class="card-title">Transfer Posting Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Rules Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Rules Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Rules Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								<input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['transfer_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Cadre</label>
                                            <select class="form-control" id="cadre" name="cadre" type="text" placeholder="Cadre name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" >
											<option value="">Choose</option>
											
												<?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='crade' and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
												if(isset($_GET['edit_id'])){ if($editRow['transfer_cadre']==$m['value']){
												echo "<option value='".$m['value']."' selected>".$m['name']."</option>";}
												else{
												echo "<option value='".$m['value']."' >".$m['name']."</option>";}}
								}}?>	
                                             
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Cadre

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Type</label>
                                            <select class="form-control" id="type" name="type" type="text" placeholder="Type name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" >
											<option value="">Choose</option>
												<?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='type' and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
												if(isset($_GET['edit_id'])){ if(trim($editRow['transfer_type'])==$m['value']){
												echo "<option value='".$m['value']."' selected>".$m['name']."</option>";}
												else{
												echo "<option value='".$m['value']."' >".$m['name']."</option>";}}
								}}?>	
											
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Type

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Notifications No</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="not_no" name="not_no" type="text" placeholder="Notifications No" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['notification_no']); }?>" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Notifications No .

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Notifications Year</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="not_year" name="not_year" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['notification_year']); }?>" type="text" placeholder="Notifications Year" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Notifications Year .

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Transfer Documents</label>
											 <div class="custom-file">
											 <input class="form-control custom-file-label" id="trans_pdf" name="trans_pdf" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                       
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
									
										
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Transfer Language</label>
                                             <select class="form-control" id="trans_lan" name="trans_lan" type="text" placeholder="Transfer Language"   autocomplete="off" >
											 
                                                <option value="">Choose</option>
                                               <option value="English"<?php  if(isset($_GET['edit_id'])){ if($editRow['trans_doc_lan']=='English'){ echo "SELECTED"; }}?>>English</option>
											   <option value="Tamil"<?php  if(isset($_GET['edit_id'])){ if($editRow['trans_doc_lan']=='Tamil'){ echo "SELECTED"; }}?>>Tamil</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Rules Language

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Transfer Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="trans_order" name="trans_order" type="text"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['transfer_order']); }?>"  placeholder="Transfer Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Transfer Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="trans_date" name="trans_date" type="text"  value="<?php  if(isset($_GET['edit_id'])){ print($transfer_date); }?>"  placeholder="Transfer on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Transfer on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">New Icon</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="new" id="new" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['new_icon']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
											   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['new_icon']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
											   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											 <div class="input-group">
                                        <select class="form-control" name="icon" id="icon" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="PDF"<?php  if(isset($_GET['edit_id'])){ if($editRow['icon']=='PDF'){ echo "SELECTED"; }}?>>Pdf Icon</option>
											   <option value="XLS"<?php  if(isset($_GET['edit_id'])){ if($editRow['icon']=='XLS'){ echo "SELECTED"; }}?>>Excel Icon</option>
											   <option value="IMG"<?php  if(isset($_GET['edit_id'])){ if($editRow['icon']=='IMG'){ echo "SELECTED"; }}?>>Image  Icon</option>
											   <option value="DOW"<?php  if(isset($_GET['edit_id'])){ if($editRow['icon']=='DOW'){ echo "SELECTED"; }}?>>Downloads Icon</option>
                                            </select>
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Icon.

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
	
    
    if(chkbadchar(theform.cadre.value)==false )
   {
     swal("Enter a Valid  Cadre ", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#cadre').val('');
         theform.cadre.focus();
    return false;
   }
  
    else if(chkbadchar(theform.type.value)==false )
   {
     swal("Enter a Valid  Type ", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#type').val('');
         theform.type.focus();
    return false;
   }
    
    else if(chkbadchar(theform.not_no.value)==false )
   {
     swal("Enter a Valid  Notifications No ", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#not_no').val('');
         theform.not_no.focus();
    return false;
   }
    else if(chkbadchar(theform.not_year.value)==false )
   {
     swal("Enter a Valid  Notifications No ", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#not_year').val('');
         theform.not_year.focus();
    return false;
   }
    else if(chkbadchar(theform.trans_lan.value)==false )
   {
     swal("Enter a Valid  Transfer Language.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#trans_lan').val('');
         theform.trans_lan.focus();
    return false;
   }
    else if(isNumber(theform.trans_order.value)==false )
    {
		swal("Enter a Valid  Transfer Order.", "", "error");
		$('#trans_order').val('');
         theform.trans_order.focus();
    return false;
    }
  else if(chkbadchar(theform.trans_date.value)==false )
   {
     swal("Enter a Valid  Upload Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#trans_date').val('');
         theform.trans_date.focus();
    return false;
   }
  
  else if(chkbadchar(theform.new.value)==false )
   {
     swal("Enter a Valid  New Icon.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#new').val('');
         theform.new.focus();
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
        var fuData = document.getElementById('trans_pdf');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#trans_pdf').val('');
         $('#trans_pdf').focus();

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
	 $('#trans_pdf').val('');
         $('#trans_pdf').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
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