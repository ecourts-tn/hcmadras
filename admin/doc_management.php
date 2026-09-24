<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/doc_fun.php';
$doc_fun =new DOCFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
$doc_show_page;

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {

		
try
		{
			
				$doc_title=htmlspecialchars(filter_input(INPUT_POST, 'doc_title', FILTER_SANITIZE_STRING));
					$doc_size=htmlspecialchars(filter_input(INPUT_POST, 'doc_size', FILTER_SANITIZE_STRING));
					$doc_lan=htmlspecialchars(filter_input(INPUT_POST, 'doc_lan', FILTER_SANITIZE_STRING));
					$doc_f_date=htmlspecialchars(filter_input(INPUT_POST, 'doc_f_date', FILTER_SANITIZE_STRING));
					$doc_t_date=htmlspecialchars(filter_input(INPUT_POST, 'doc_t_date', FILTER_SANITIZE_STRING));
					$doc_order=htmlspecialchars(filter_input(INPUT_POST, 'doc_order', FILTER_SANITIZE_STRING));
					$doc_bench=htmlspecialchars(filter_input(INPUT_POST, 'doc_bench', FILTER_SANITIZE_STRING));
					$new=htmlspecialchars(filter_input(INPUT_POST, 'new', FILTER_SANITIZE_STRING));
					$doc_page=htmlspecialchars(filter_input(INPUT_POST, 'doc_page', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					$doc_o_type=htmlspecialchars(filter_input(INPUT_POST, 'doc_o_type', FILTER_SANITIZE_STRING));
					$icon_img=htmlspecialchars(filter_input(INPUT_POST, 'icon', FILTER_SANITIZE_STRING));
					$image1=stripslashes($_FILES['doc_pdf']['name']);
	if($doc_f_date)
	$date_up=date('Y-m-d',strtotime($doc_f_date));
	else
	$date_up=date("Y-m-d");
	if($doc_t_date)
	{
	$date_to=date('Y-m-d',strtotime($doc_t_date));	
	}
	else
	{
		$date_to=NULL;
	}
	$mhc_user=$_SESSION['user_session'];
			  if(empty($icon_img))
   {
      $error = "Enter your Documents Icon !";
   }
 else if(!empty($icon_img) && $validator->chkbadchar($icon_img) == false)
 {
  $error= "Please enter valid Documents Icon";
 }
					else  if(empty($doc_title))
   {
      $error = "Enter your Documents Title !";
   }

 
  else if(empty($doc_lan))
   {
      $error = "Enter your Documents Language !";
   }
 else if(!empty($doc_lan) && $validator->chkbadchar($doc_lan) == false)
 {
  $error= "Please enter valid Documents Language";
 }
else if(empty($doc_order))
   {
  $error= "Please enter valid Documents Order ";
 }
 else if($validator->test_datatype($doc_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Documents Order ";
 }
 else if(empty($doc_bench))
   {
      
      $error = "Enter your Bench!";
   }
 else if(!empty($doc_bench) && $validator->chkbadchar($doc_bench) == false)
 {
  $error= "Please enter valid Bench";
 }
else if(empty($new))
   {
      $error = "Enter your New Icon !";
   }
 else if(!empty($new) && $validator->chkbadchar($new) == false)
 {
  $error= "Please enter valid New Icon";
 }
 else if(empty($doc_page))
   {
      $error = "Enter your Page !";
   }
 else if(!empty($doc_page) && $validator->chkbadchar($doc_page) == false)
 {
  $error= "Please enter valid Page";
 }
  else if(empty($display))
   {
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }

 else if(!empty($doc_o_type) && $validator->chkbadchar($doc_o_type) == false)
 {
  $error = "Please enter valid Order Type ";
 }
  else if(empty($_FILES['doc_pdf']['tmp_name']))
 {
  $error = "Please upload your file";
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
$detected_type = finfo_file( $fileInfo, $_FILES['doc_pdf']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{

if ($image1) 
{
	$filename = stripslashes($_FILES['doc_pdf']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "PDF") && ($extension != "pdf")) 
	{
		$error='Upload Documents PDF Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['doc_pdf']['tmp_name']);
 
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

$doc_size= formatSizeUnits($size1);
		$binary_bar = file_get_contents($_FILES["doc_pdf"]["tmp_name"]);
$doc_pdf = pg_escape_bytea($binary_bar);
if ($doc_pdf=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{



		if($doc_fun->doc_register($doc_title,$doc_pdf,$doc_size,$doc_lan,$date_up,$date_to,$doc_order,$doc_bench,$new,$doc_page,$icon_img,$display,$mhc_user,$doc_o_type,$page_id,$ip,$log_fun))
{							unset($error);
							$doc_fun->redirect("doc_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
		


		if($doc_fun->doc_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $doc_fun->redirect("doc_management.php?joined2&CheckString=".$chkstr);
			 
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
                                <div class="card-title">New Documents Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Documents Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Documents Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Documents Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
									<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Document Show Page</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="doc_page" id="doc_page" required="required" onchange = "max_ord()" autocomplete="off" >
                                                <option value="">Choose</option>
												 <?php
								if($_SESSION['roll']!='A')	{			
$select_qry = $DB_con->query("select * from  mhc_document_type where display='Y' and show_page='D' and ".$_SESSION['dept']."=any(dept_no)");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['doc_value'].">".$row['doc_name']." </option>";
$doc_show_page[]="'".$row['doc_value']."'";

}}
else
{
	$select_qry = $DB_con->query("SELECT doc_name,doc_value FROM mhc_document_type where display='Y'  and show_page='D' order by doc_name");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['doc_value'].">".$row['doc_name']." </option>";
$doc_show_page[]="'".$row['doc_value']."'";
}}

$doc_show_page_str=implode(",",$doc_show_page);
try
{
	
$Get_doc_details= $doc_fun->docdata($chkstr,$page_id,$doc_show_page_str);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
?>
                                             
                                            </select>
											</div>
                                        </div>
											<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Bench</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control " name="doc_bench" id="doc_bench" required="required" autocomplete="off" >
                                                <option value="" selected disabled>Choose</option>
                                              
											  <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='bench'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
											  
											 <!--  <option value="MHC" SELECTED>Madras High Court</option>
											 <option value="MDU">Madurai Bench</option>
											   <option value="SUB" >Subordinate Court</option>
											   <option value="THC">Principal Seat & Madurai Bench</option>-->
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="validationTooltip01">Documents Title</label>
                                            <input class="form-control" id="doc_title" name="doc_title" type="text" placeholder="Documents name"  required="required" aria-describedby="validationTooltipFirstPrepend" autocomplete="off" />
											<span id='show_frmt' style='display:none'><span style='color:red'>Format: Case details - order date </span><span style='color:green'>(eg: CS.1/1990 - 09-01-1990)</span></span>
                                            <div class="invalid-tooltip">
                                               Enter Your Documents Title

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Documents Upload</label>
											 <div class="custom-file">
                                        <input class="custom-file-label" id="doc_pdf" name="doc_pdf" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
										
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Documents Language</label>
                                             <select class="form-control" id="doc_lan" name="doc_lan" type="text" placeholder="Documents Language"   autocomplete="off" >
											 <option value="">Choose</option>
                                               <option value="English" >English</option>
											   <option value="Tamil">Tamil</option>
											    </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Documents Language

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Uploads From Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="doc_f_date" name="doc_f_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Documents on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">To Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="doc_t_date" name="doc_t_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Documents on.

                                                </div>
                                            </div>
                                        </div>
                                        
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Documents Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="doc_order" name="doc_order" type="text" placeholder="Documents Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Documents Order.

                                                </div>
                                            </div>
                                        </div>
									
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">New</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="new" id="new" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y">Yes</option>
											   <option value="N" >No</option>
                                            </select>
                                            </div>
                                        </div>
										
											<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											 <div class="input-group">
                                        <select class="form-control" name="icon" id="icon" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="PDF" SELECTED>Pdf Icon</option>
											   <option value="XLS">Excel Icon</option>
											   <option value="IMG">Image  Icon</option>
											   <option value="DOW">Downloads Icon</option>
                                            </select>
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Icon.

                                            </div>
                                            
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y" >Yes</option>
											   <option value="N">No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Order Type</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="doc_o_type" id="doc_o_type" required="required" autocomplete="off" >
                                                <option value="" selected disabled>Choose</option>
												<?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='order_type'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
                                            <!--  <option value="SA">Sitting Arrangements</option>
											   <option value="SO">Standing Orders</option>
											    <option value="NO" >None</option>-->
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
                                <h4 class="card-title mb-3">Documents Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Documents Title</th>
												<th>Documents File</th>
                                                <th>Uploads Date</th>
                                                <th>Bench</th>
                                                <th>Documents Types</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_doc_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											     <th>Sl.No</th>
                                                 <th>Documents Title</th>
												<th>Documents File</th>
                                                <th>Uploads Date</th>
                                                <th>Bench</th>
                                                <th>Documents Types</th>
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
			
			 function max_ord()
			{
					var page_val=$("#doc_page").val();
					if (page_val=='R')
						$('#show_frmt').css('display','block');
					else
						$('#show_frmt').css('display','none');
					var ord_max = $.post( "action.php", { action:"get_max_page_order",page_val:page_val});
		ord_max.done(function( data ) {						
		    //$("#orddate_captcha").val("");
			data++;
				
			$("#doc_order").val(data);
		});
			
			}
			
			function Validator(theform)
{
	
     if(chkbadchar(theform.doc_lable.value)==false )
   {
     swal("Enter a Valid  Documents Lable.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_lable').val('');
         theform.doc_lable.focus();
    return false;
   }
    if(chkbadchar(theform.doc_title.value)==false )
   {
     swal("Enter a Valid  Documents Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_title').val('');
         theform.doc_title.focus();
    return false;
   }
   else if(chkbadchar(theform.doc_size.value)==false )
   {
     swal("Enter a Valid  Documents Size.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_size').val('');
         theform.doc_size.focus();
    return false;
   }
     else if(chkbadchar(theform.doc_lan.value)==false )
   {
     swal("Enter a Valid  Documents Language.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_lan').val('');
         theform.doc_lan.focus();
    return false;
   }
  else if(chkbadchar(theform.doc_f_date.value)==false )
   {
     swal("Enter a Valid  Upload Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_f_date').val('');
         theform.doc_f_date.focus();
    return false;
   }
   else if(chkbadchar(theform.doc_t_date.value)==false )
   {
     swal("Enter a Valid  Documents To Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_t_date').val('');
         theform.doc_t_date.focus();
    return false;
   }
   else if(isNumber(theform.doc_order.value)==false )
    {
		swal("Enter a Valid  Documents Order.", "", "error");
		$('#doc_order').val('');
         theform.doc_order.focus();
    return false;
    }
	 else if(chkbadchar(theform.bench.value)==false )
   {
     swal("Enter a Valid  Documents Bench.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#bench').val('');
         theform.bench.focus();
    return false;
   }
    else if(chkbadchar(theform.doc_page.value)==false )
   {
     swal("Enter a Valid  Documents Page.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#doc_page').val('');
         theform.doc_page.focus();
    return false;
   }
   else if(chkbadchar(theform.new.value)==false )
   {
     swal("Enter a Valid  Documents New Icon.", "", "error");
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
        var fuData = document.getElementById('doc_pdf');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#doc_pdf').val('');
         $('#doc_pdf').focus();

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
	 $('#doc_pdf').val('');
         $('#doc_pdf').focus();
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


					
					
	  $.get('doc_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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
					
			 //$('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=D" width="100%" height="500px"></iframe>');
				 	   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page='+btoa('D')).then((pdf) => {
      
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
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
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
			
					
				} else alert('Unknown row id.');
			}
			</script>