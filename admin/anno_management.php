<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting( E_ALL);

include 'include/header.php';
include 'default_pasword_check.php';

include 'function/ann_fun.php';




$ann_fun =new ANNFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$ann_lable=htmlspecialchars(filter_input(INPUT_POST, 'ann_lable', FILTER_SANITIZE_STRING));
				$ann_title=$_POST['ann_title'];
					$ann_pdf=htmlspecialchars(filter_input(INPUT_POST, 'ann_pdf', FILTER_SANITIZE_STRING));
					$upload_date=htmlspecialchars(filter_input(INPUT_POST, 'upload_date', FILTER_SANITIZE_STRING));
					$exp_date=htmlspecialchars(filter_input(INPUT_POST, 'exp_date', FILTER_SANITIZE_STRING));
					$ann_order=htmlspecialchars(filter_input(INPUT_POST, 'ann_order', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					$new=htmlspecialchars(filter_input(INPUT_POST, 'new', FILTER_SANITIZE_STRING));
					$icon_img=htmlspecialchars(filter_input(INPUT_POST, 'icon', FILTER_SANITIZE_STRING));
					$ann_link=htmlspecialchars(filter_input(INPUT_POST, 'ann_link', FILTER_SANITIZE_STRING));
					$elink=htmlspecialchars(filter_input(INPUT_POST, 'elink', FILTER_SANITIZE_STRING));
					
					  if(empty($ann_lable))
   {
      
      $error = "Enter your Announcements Lable !";
   }
 else if(!empty($ann_lable) && $validator->chkbadchar($ann_lable) == false)
 {
  $error= "Please enter valid Announcements Lable";
 }
 else if(empty($ann_title))
   {
      
      $error = "Enter your Announcements Title !";
   }

  else if(empty($upload_date))
   {
      
      $error = "Enter your Announcements Upload Date !";
   }
else if(empty($ann_order))
   {
  $error= "Please enter valid Announcements Order ";
 }
 else if($validator->test_datatype($ann_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Announcements Order ";
 }

  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
 else if(empty($_FILES['ann_pdf']['name'])&&$ann_lable!='link')
 {
  $error = "Please upload your file";
 }
 else if(empty($ann_link)&&$ann_lable=='link')
 {
  $error = "Please enter valid link";
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

$allowed_types = array ('application/pdf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
if($ann_lable!='link'){
$image1=$_FILES['ann_pdf']['name'];
$detected_type = finfo_file( $fileInfo, $_FILES['ann_pdf']['tmp_name'] );
}
else
{
	$image1='';
	$detected_type ='';
}
if ( !in_array($detected_type, $allowed_types) && $ann_lable!='link') {
		$error='Upload Documents PDF Only!';
}
else
{
if ($image1||$ann_link) 
{
	if($image1 && $ann_lable!='link'){
	$filename = stripslashes($_FILES['ann_pdf']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "PDF") && ($extension != "pdf")) 
	{
		$error='Upload Documents PDF Only!';
		//die();
	}
	else
	{
		$size1=filesize($_FILES['ann_pdf']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		//die();
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

$ann_size= formatSizeUnits($size1);

$binary_bar = file_get_contents($_FILES["ann_pdf"]["tmp_name"]);
$ann_pdf = pg_escape_bytea($binary_bar);
$ann_link='';
	}
	}
	else if ($ann_link && $ann_lable=='link')
	{
		$ann_pdf='';
		$ann_size='';
	}
		if ($ann_pdf==''&&$ann_lable!='link') 
		{
			$error='Copy unsuccessfull!</h3>';
			//die();
			
		}
		else if( $ann_link==''&&$ann_lable=='link')
		{
			$error='Copy unsuccessfull!</h3>';
		}
	else 
	{
		//$error='Copy successfull!</h3>';
if($upload_date)
$date_up=date('Y-m-d',strtotime($upload_date));
else
	$date_up=date("Y-m-d");
if($exp_date)
$exp_dt=date('Y-m-d',strtotime($exp_date));
else
{
	$date_exp=date_create($date_up);
date_add($date_exp,date_interval_create_from_date_string("7 days"));
$exp_dt= date_format($date_exp,"Y-m-d");
}

	$mhc_user=$_SESSION['user_session'];					
if($ann_fun->ann_register($ann_lable,$ann_title,$ann_pdf,$ann_size,$date_up,$exp_dt,$ann_lan,$ann_order,$display,$new,$mhc_user,$icon_img,$page_id,$ip,$log_fun,$ann_link,$elink))
{
							unset($error);
							$ann_fun->redirect("anno_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
						}
}
	}
}						
 }	
 }
						//}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
	
	 //Delete row
	if (isset($_GET['remove']))
		{
		
     $del_id=$_GET['remove'];
	$page_id=$_GET['page_id'];	
		


		if($ann_fun->ann_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $ann_fun->redirect("anno_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_ann_details= $ann_fun->downdata($chkstr,$page_id);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
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
                                <div class="card-title">New Announcements Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Announcement Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Announcement Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Announcement Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
									 <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip01">Announcements Lable</label>
                                            <select class="form-control" id="ann_lable" name="ann_lable" type="text" placeholder="Announcements name"  required="required" aria-describedby="validationTooltipFirstPrepend"  autocomplete="off" onchange='checkdata()'>
											<option value=""> Choose</option>
											<?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='lable'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
											<!--<option value="Notification"> Notification</option>
											<option value="Memorandum"> Memorandum</option>
											<option value="Circular"> Circular</option>
											<option value="Cause List"> Cause List</option>
											<option value="Other"> Other</option>-->
											</select>
                                            <div class="invalid-tooltip">
                                               Enter Your Announcements Lable

                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="validationTooltip01">Announcements Title</label>
                                            <input class="form-control" id="ann_title" name="ann_title" type="text" placeholder="Announcements name"  required="required" aria-describedby="validationTooltipFirstPrepend"  autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Announcements Title

                                            </div>
                                        </div>
										
                                        <div class="col-md-3 form-group mb-4">
										<div id='up_fld'>
                                            <label for="validationTooltip02">Upload Announcements</label>
											
											 <div class="custom-file">
                                        <input class="custom-file-label" id="ann_pdf" name="ann_pdf" onchange="return ValidateFileUpload()"  type="file" aria-describedby="inputGroupFileAddon01">
                                       
                                    </div>
									  <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div></div>
									<div id='link_fld' style='display:none'>
											 <label for="validationTooltip02">Enter Link</label>
											 <div>
                                        <input class="form-control" id="ann_link" name="ann_link"  type="text" aria-describedby="inputGroupFileAddon01" placeholder="Enter Link" autocomplete="off"/>
										</div>
                                         <div class="invalid-tooltip">
                                                Please provide a valid Data.

                                            </div>
                                    </div>
                                          
                                            
                                        </div>
										<div class="col-md-2 form-group mb-3" id='link_fld1' style='display:none'>
                                            <label for="elink">External Link</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="elink" id="elink" required="required" autocomplete="off" >
                                                <option value="" disabled >Choose</option>
                                              <option value="Y">Yes</option>
											   <option value="N" selected >No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											 <div class="input-group">
                                        <select class="form-control" name="icon" id="icon" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                             <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='icon'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
                                            </select>
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Icon.

                                            </div>
                                            
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="upload_date" name="upload_date"  type="text" placeholder="Announcements on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Uploads on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Expire Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="exp_date" name="exp_date" type="text" placeholder="Announcements on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Expire on.

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Announcements Language</label>
                                             <select class="form-control" id="ann_lan" name="ann_lan" type="text" placeholder="Announcements Language"   autocomplete="off" >
											 <option value="">Choose</option>
                                              <option value="English" >English</option>
											   <option value="Tamil">Tamil</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Announcements Language

                                            </div>
                                        </div>
										<div class="col-md-1 form-group mb-3">
                                            <label for="validationTooltipUsername">Order</label>
											 <?php 
												$stmt1 = $DB_con->prepare("SELECT max(an_order)+1 as order FROM announcement");
					$stmt1->execute();
					if($stmt1->rowCount() > 0){
						$row1=$stmt1->fetch();
						if(is_null($row1['order']))
							$a_order=1;
						else
							$a_order=$row1['order'];
					}				?>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="ann_order" name="ann_order" type="text" placeholder="Announcements Order" aria-describedby="validationTooltipPasswordPrepend" value="<?php echo $a_order; ?>" autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Downloads Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">New</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="new" id="new" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y">Yes</option>
											   <option value="N" >No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y" >Yes</option>
											   <option value="N">No</option>
                                            </select>
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
                                <h4 class="card-title mb-3">Announcements Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>Announcements Title</th>
                                                <th>Announcements File</th>
                                                <th>Uploads Date</th>
                                                <th>Announcements Order</th>
                                              
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_ann_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											   <th>Sl.No</th>
												<th>Announcements Title</th>
                                                <th>Announcements File</th>
                                                <th>Uploads Date</th>
                                                <th>Announcements Order</th>
                                              
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
                            <div class="modal-body" >
                               
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
	
    
	 if(chkbadchar(theform.ann_lable.value)==false )
   {
     swal("Enter a Valid  Announcements Lable.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#ann_lable').val('');
         theform.ann_lable.focus();
    return false;
   }
    else if(theform.ann_pdf.value=='' && (theform.ann_lable.value)!='link' )
   {
     swal("Enter a Valid  Documents .", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#ann_pdf').val('');
         theform.ann_pdf.focus();
    return false;
   }
   else if(chkbadchar(theform.ann_size.value)==false && (theform.ann_lable.value)!='link' )
   {
     swal("Enter a Valid  Documents Size.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#ann_size').val('');
         theform.ann_size.focus();
    return false;
   }
  else if(chkbadchar(theform.upload_date.value)==false )
   {
     swal("Enter a Valid  Upload Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#upload_date').val('');
         theform.upload_date.focus();
    return false;
   } 
   else if(chkbadchar(theform.exp_date.value)==false )
   {
     swal("Enter a Valid  Expire Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#exp_date').val('');
         theform.exp_date.focus();
    return false;
   }
   else if(chkbadchar(theform.ann_lan.value)==false )
   {
     swal("Enter a Valid  Announcements Language.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#ann_lan').val('');
         theform.ann_lan.focus();
    return false;
   }
  
   else if(isNumber(theform.ann_order.value)==false )
    {
		swal("Enter a Valid  Announcements Order.", "", "error");
		$('#ann_order').val('');
         theform.ann_order.focus();
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
   else if(chkbadchar(theform.ann_link.value)==false && (theform.ann_lable.value)=='link')
   {
     swal("Enter a valid  link.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#ann_link').val('');
         theform.ann_link.focus();
    return false;
   }
   
    
}

 function ValidateFileUpload() {
        var fuData = document.getElementById('ann_pdf');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#ann_pdf').val('');
         $('#ann_pdf').focus();

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
	 $('#ann_pdf').val('');
         $('#ann_pdf').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
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


					
					
	  $.get('anno_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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
	
	function ViewRow(id) {
				if ( 'undefined' != typeof id ) {
					
			 //$('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=A" width="100%" height="500px"></iframe>');
			 
			   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page=<?php echo base64_encode("A") ?>').then((pdf) => {
      
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
 
      /*  document.getElementById('zoom_in').addEventListener('click', (e) => {
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
			/* $.ajax({ 
			method: "POST",
			url: "get_pdf.php",
			data: {
				action:'photo',
				view_id:id
				},
				success: function(data)
				{
					
					if(data==2)
					{
						 swal("Something Went Worng", "", "error"); 
					}
					else{
						
				 $('#pdf_doc').html('<iframe src="admin'+data+'" width="100%" height="500px"></iframe>');
				 $('.bd-example-modal-lg').modal('show')
					}
				 
				} 
			}); */
					
				} else alert('Unknown row id.');
			}
			function checkdata()
			{
				var sel=$('#ann_lable').val();
				if(sel=='link')
				{
					$('#link_fld').css('display','block');
					$('#link_fld1').css('display','block');
					$('#up_fld').css('display','none');
					$('#ann_pdf').prop('required',false);
					$('#ann_link').prop('required',true);
					 $('#ann_pdf').val('');
				}
				else
					{
					$('#link_fld').css('display','none');
					$('#link_fld1').css('display','none');
					$('#up_fld').css('display','block');
					$('#ann_pdf').prop('required',true);
					$('#ann_link').prop('required',false);
					 $('#ann_link').val('');
				}
			}
			</script>