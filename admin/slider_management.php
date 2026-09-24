<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/slid_fun.php';
$slid_fun =new SLIDFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		//echo $slider_title;
try
		{
				$bench=htmlspecialchars(filter_input(INPUT_POST, 'bench', FILTER_SANITIZE_STRING));
				$up_date=htmlspecialchars(filter_input(INPUT_POST, 'up_date', FILTER_SANITIZE_STRING));	
				$slider_name=htmlspecialchars(filter_input(INPUT_POST, 'slider_title', FILTER_SANITIZE_STRING));
					$slider_ord=htmlspecialchars(filter_input(INPUT_POST, 'slider_ord', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));	
					$slider_url=htmlspecialchars(filter_input(INPUT_POST, 'slider_url', FILTER_SANITIZE_STRING));	
					
					  if(empty($bench))
   {
      
      $error = "Select your Bench !";
   }
 else if(!empty($bench) && $validator->chkbadchar($bench) == false)
 {
  $error= "Please enter valid Bench Title";
 }
else  if(empty($slider_name))
   {
      
      $error = "Enter your Slider Name !";
   }
 else if(!empty($slider_name) && $validator->chkbadchar($slider_name) == false)
 {
  $error= "Please enter valid Slider Name";
 }
	 else if(empty($slider_ord))
   {
  $error= "Please enter valid Downloads Order ";
 }
 else if($validator->test_datatype($slider_ord,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Downloads Order ";
 }
 else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
  else if(empty($slider_url))
   {
      
      $error = "Enter your Slider URL !";
   }
 else if(!empty($slider_url) && $validator->chkbadchar($slider_url) == false)
 {
  $error = "Please enter valid Slider URL";
 }  else if(empty($_FILES['slider_img']['name']))
 {
  $error = "Please upload your file";
 }
 else
 {
	
	 
		$up_date=date('Y-m-d',strtotime($up_date));	
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

$image1=$_FILES['slider_img']['name'];
$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['slider_img']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG Only!';
}
else
{
	 if ($image1) 
{
	$filename = stripslashes($_FILES['slider_img']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg")) 
	{
		$error='Upload Documents JPG Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['slider_img']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 
$binary_bar = file_get_contents($_FILES["slider_img"]["tmp_name"]);
$slid_img = pg_escape_bytea($binary_bar);
if ($slid_img=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';
			$mhc_user=$_SESSION['user_session'];	
//var_dump($bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user);	
if($slid_fun->slider_register($bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user,$slider_url,$page_id,$ip,$log_fun))
{
	//$error=' successfull!</h3>';
							unset($error);
							$slid_fun->redirect("slider_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
		


		if($slid_fun->slid_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $slid_fun->redirect("slider_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_slid_details= $slid_fun->sliddata($chkstr,$page_id);
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
                                <div class="card-title">New Slider Images Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Images Added Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Images Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Images Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Bench</label>
                                           <select class="form-control form-control-rounded" name="bench" id="bench" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
												 <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='bench'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
                                            <!--  <option value="MHC">Principal Bench</option>
											   <option value="MDU">Madurai Bench</option>-->
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Title

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Slider Title</label>
                                            <input class="form-control" id="slider_title" name="slider_title" type="text" placeholder="Slider name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Slider Title

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Slider Images</label>
											 <div class="custom-file">
                                        <input class="custom-file-label" id="slider_img" name="slider_img" type="file" aria-describedby="inputGroupFileAddon01" required="required" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Slider.

                                            </div>
                                            
                                        </div>
										<div class="col-md-1 form-group mb-3">
                                            <label for="validationTooltipUsername">Slider Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="slider_ord" name="slider_ord" type="text" placeholder="Slider Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required="required" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Slider Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Slider URL</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control" id="slider_url" name="slider_url" type="text" placeholder="Slider URL" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required="required" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Slider URL.

                                                </div>
                                            </div>
                                        </div>
										
                                       
										
										
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="up_date" name="up_date" type="text" placeholder="Uploads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required="required"/>
                                                <div class="invalid-tooltip">
                                                    Please choose a Uploads on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y">Yes</option>
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
                                <h4 class="card-title mb-3">Slider Management</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="slider_management_order.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id') ?>=<?php echo base64_encode($page_id) ?>">Ordering</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Slider Title</th>
												 <th>Slider Image</th>
												 <th>Slider Order</th>
                                                <th>Uploads Date</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_slid_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											   <th>Sl.No</th>
                                                <th>Slider Title</th>
												 <th>Slider Image</th>
												 <th>Slider Order</th>
                                                 <th>Uploads Date</th>
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
				
            </div>
			
			<?php include 'include/footer.php' ?>
			 <script type="text/javascript" language="javascript" >
		
			$(document).ready(function() {
				$('.date-picker1').datepicker({
					autoclose: true,
					format:'dd-mm-yyyy',
					todayHighlight: true
				})
				
			


	 
	 
	 });
	 </script>
			<script>
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.bench.value)==false )
   {
     swal("Enter a Valid  Bench.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#bench').val('');
         theform.bench.focus();
    return false;
   }
   /* else if(chkbadchar(theform.slider_title.value)==false )
   {
     swal("Enter a Valid  Slider Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#slider_title').val('');
         theform.slider_title.focus();
    return false;
   } */
 
  
   else if(isNumber(theform.slider_ord.value)==false )
    {
		swal("Enter a Valid  Slider Order.", "", "error");
		$('#slider_ord').val('');
         theform.slider_ord.focus();
    return false;
    }
	 else if(chkbadchar(theform.slider_url.value)==false )
   {
     swal("Enter a Valid  Slider URL.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#slider_url').val('');
         theform.slider_url.focus();
    return false;
   }
	 else if(chkbadchar(theform.up_date.value)==false )
   {
     swal("Enter a Valid  Upload Date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#up_date').val('');
         theform.up_date.focus();
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
    else if(!$('#slider_img').val())
   {
     swal("Select a slider imgae.", "", "error");
    //alert("Select a slider imgae.");
		$('#slider_img').val('');
         theform.slider_img.focus();
    return false;
   }
    
}
function ValidateFileUpload() {
        var fuData = document.getElementById('slider_img');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#slider_img').val('');
         $('#slider_img').focus();

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
	 $('#slider_img').val('');
         $('#slider_img').focus();
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


					
					
	  $.get('slider_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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