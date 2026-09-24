<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'default_pasword_check.php';
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
      
      $error = "Enter your Notification Language !";
   }
 else if(!empty($trans_lan) && $validator->chkbadchar($trans_lan) == false)
 {
  $error= "Please enter valid Notification Language";
 }
else if(empty($trans_order))
   {
  $error= "Please enter valid Notification Order ";
 }
 else if($validator->test_datatype($trans_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric Notification Order ";
 }
 else if(empty($trans_dt))
   {
      
      $error = "Enter upload date!";
   }
 else if(!empty($trans_dt) && $validator->chkbadchar($trans_dt) == false)
 {
  $error= "Please enter valid upload date";
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
 else if(empty($icon_img))
   {
      
      $error = "Enter your Icon !";
   }
 else if(!empty($icon_img) && $validator->chkbadchar($icon_img) == false)
 {
  $error = "Please enter valid Icon ";
 }
 else if (empty($_FILES['trans_pdf']['name']))
 {
	 $error = "Please upload your file "; 
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
	
								
$allowed_types = array ('application/pdf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['trans_pdf']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{
if ($image1) 
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

	


		if($trans_fun->trans_register($cadre,$type,$not_no,$not_year,$trans_pdf,$trans_size,$trans_lan,$trans_order,$trans_dt,$new,$display,$icon_img,$mhc_user,$page_id,$ip,$log_fun))
{
							unset($error);
							$trans_fun->redirect("transfer_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
	
	 //Delete row
	if (isset($_GET['remove']))
		{
		
     $del_id=$_GET['remove'];
		$page_id=$_GET['page_id'];	


		if($trans_fun->trans_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $trans_fun->redirect("transfer_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_trans_details= $trans_fun->trans_data($chkstr,$page_id);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
 ?>
 <script>
 function max_det()
			{
					var year=$("#not_year").val();
					
					var year_max = $.post( "action.php", { action:"get_max_trans_order",not_year:$("#not_year").val()});
		year_max.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			
			data++;
				
			$("#trans_order").val(data);
		});
			}
 </script>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize"> Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize"> Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Cadre</label>
                                            <select class="form-control" id="cadre" name="cadre" type="text" placeholder="Cadre name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" >
											<option value="">Choose</option>
											 <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='crade'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
                                              <!-- <option value="DJ" >District Judge</option>
											   <option value="CJ" >Civil Judge</option>
											   <option value="SJ">Senior Civil Judge</option>
											   <option value="AJ" >Additional Judge</option>-->
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
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='type'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
											
											<!--<option value="T">Transfer</option>
											<option value="P">Postings</option>
											<option value="R">Promotion</option>
                                               <option value="TP"  >Transfer and Postings</option>
											   <option value="PP">Promotion and Postings</option>
											   <option value="PT">Promotion, Transfer and Postings </option>-->
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Type

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Notifications No</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="not_no" name="not_no" type="text" placeholder="Notifications No" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Notifications No .

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Notifications Year</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="not_year" name="not_year" type="text" placeholder="Notifications Year" aria-describedby="validationTooltipPasswordPrepend" onfocusout="max_det()"   autocomplete="off"  />
												<!--!@#$%^&onfocusout="max_det()"@@#-->
                                                <div class="invalid-tooltip">
                                                    Please Enter Notifications Year .

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Transfer Documents</label>
											 <div class="custom-file">
											 <input class="form-control custom-file-label" id="trans_pdf" name="trans_pdf" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                        <!--<input class="custom-file-input" id="trans_pdf" name="trans_pdf" type="file" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
									
										
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Transfer Language</label>
                                             <select class="form-control" id="trans_lan" name="trans_lan" type="text" placeholder="Transfer Language"   autocomplete="off" >
											 
                                                <option value="">Choose</option>
                                               <option value="English" >English</option>
											   <option value="Tamil">Tamil</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Rules Language

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Transfer Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="trans_order" name="trans_order" type="text" placeholder="Transfer Order" aria-describedby="validationTooltipPasswordPrepend"   autocomplete="off" />
												
                                                <div class="invalid-tooltip">
                                                    Please Enter Transfer Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="trans_date" name="trans_date" type="text"  placeholder="Transfer on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
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
                                              <option value="Y">Yes</option>
											   <option value="N" >No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y" >Yes</option>
											   <option value="N">No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											  <div class="input-group">
                                        <select class="form-control" name="icon" id="icon" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="PDF" >Pdf Icon</option>
											   <option value="XLS">Excel Icon</option>
											   <option value="IMG">Image  Icon</option>
											   <option value="DOW">Downloads Icon</option>
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
					 <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Transfer Posting Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Cadre</th>
												<th>Type</th>
                                                <th>Notifications</th>
                                                <th>Transfer On</th>
                                                <th>New</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_trans_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											     <th>Sl.No</th>
                                                 <th>Cadre</th>
												<th>Type</th>
                                                <th>Notifications</th>
                                                <th>Transfer On</th>
                                                <th>New</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of main-content -->
				 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				   <style>
      #canvas_container {
          width: 750px;
          height: 500px;
          overflow: auto;
      }
 
      #canvas_container {
        background: #333;
        text-align: center;
        border: solid 3px;
      }
  </style>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Documents View</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                               <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
        </div>
 
        <div id="navigation_controls">
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number"/>
            <button id="go_next">Next</button>
        </div>
 
       <!-- <div id="zoom_controls">  
            <button id="zoom_in">+</button>
            <button id="zoom_out">-</button>
        </div>-->
    </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                               
                            </div>
                        </div>
                    </div>
                </div>
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
	
		function ViewRow(id) {
				if ( 'undefined' != typeof id ) {
					
			 //$('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=T" width="100%" height="500px"></iframe>');
			 
			   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page=<?php echo base64_encode("T") ?>').then((pdf) => {
      
            myState.pdf = pdf;
            render();
 
        });
 
        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
          
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
      
                var viewport = page.getViewport(myState.zoom);
 
                canvas.width = viewport.width;
                canvas.height = viewport.height;
          
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }
 
           document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1) 
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == myState.pdf._pdfInfo.numPages) 
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
          
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                document.getElementById('current_page').valueAsNumber;
                                  
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
				else if(desiredPage > myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = myState.pdf._pdfInfo.numPages;
                    document.getElementById("current_page").value = myState.pdf._pdfInfo.numPages;
                    render();
                }
				else if(desiredPage < 1) {
                    myState.currentPage = 1;
                    document.getElementById("current_page").value = 1;
                    render();
                }
            }
        });
 
       /* document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });
 
        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
        });*/
				 $('.bd-example-modal-lg').modal('show')
			
					
				} else alert('Unknown row id.');
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


					
					
	  $.get('transfer_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			
			</script>