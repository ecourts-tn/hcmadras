<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 30000);

include 'include/header.php';
include 'default_pasword_check.php';
include 'function/home_fun.php';
$home_fun =new HMEFUN($DB_con);

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
				$photo_title=htmlspecialchars(filter_input(INPUT_POST, 'photo_title', FILTER_SANITIZE_STRING));
					
					$file_type=htmlspecialchars(filter_input(INPUT_POST, 'file_type', FILTER_SANITIZE_STRING));
					
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
					$mhc_user=$_SESSION['user_session'];
				
					
					
					
			
				
					
					  if(empty($photo_title))
   {
      
      $error = "Enter your Photo Name !";
   }
 else if(!empty($photo_title) && $validator->chkbadchar($photo_title) == false)
 {
  $error= "Please enter valid Photo Name";
 }

  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
 else if(empty($file_type))
   {
      
      $error = "Enter your File type !";
   }
 else
 {
			
	  if($_FILES["photo"]["name"] != '')
				{
					clearstatcache(true);
						$image1=$_FILES['photo']['name'];
						$allowed_types = array ('image/jpeg','image/jpg','application/pdf');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['photo']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG/PDF Only!';
}
else
{
					if ($image1) 
{
	$filename = stripslashes($_FILES['photo']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg") && ($extension != "PDF") && ($extension != "pdf")) 
	{
		$error='Upload Documents JPG/PDF Only!';
		
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
		
						
						
if($home_fun->home_photo_reg($photo_title,$img_thmp,$display,$file_type,$mhc_user,$bd22,$page_id,$ip,$log_fun))
{
	unset($error);
				$home_fun->redirect("home_gallery_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			
		 
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
	
	 //Delete row
	if (isset($_GET['remove']))
		{
		
   $del_id=$_GET['remove'];
	$page_id=$_GET['page_id'];	
		


		if($home_fun->home_gallery_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $home_fun->redirect("home_gallery_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_home_photo_details= $home_fun->home_photo_data($chkstr,$bd22,$page_id);
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
                                <div class="card-title">Home Documents Registration Form
								<?php if(!isset($_GET['revert'])){?>
								<p style="float:right"><a class="btn btn-primary text-white " href="home_management.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id'); ?>=<?php echo $page_id ?>">Back</a></p>
								<?php }else {?>
								<p style="float:right"><a class="btn btn-primary text-white " href="menu_content_management.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id'); ?>=<?php echo $page_id ?>">Back</a></p>
								<?php }?>
								</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Title</label>
                                            <input class="form-control" id="photo_title" name="photo_title" type="text" placeholder="Photo name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Photo Name

                                            </div>
                                        </div>
                                      
									
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Upload Images/Docs</label>
                                           
                                    <div class="">
                                        <input class="form-control" id="photo" name="photo" type="file" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Photo.

                                            </div>
                                        </div>
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Upload File Type</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="file_type" id="file_type" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="JPG">JPG</option>
											   <option value="PDF">PDF</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control" name="display" id="display" required="required" autocomplete="off" >
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
                                <h4 class="card-title mb-3">Home Documents Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Name</th>
                                                <th>Images / Docs </th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_home_photo_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											    <th>Sl.No</th>
                                                <th>Name</th>
                                                <th>Images / Docs </th>
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
 
     <!--   <div id="zoom_controls">  
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
	
    
     if(chkbadchar(theform.photo_title.value)==false )
   {
     swal("Enter a Valid  Photo Title.", "", "error");

		$('#photo_title').val('');
         theform.photo_title.focus();
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

if (Extension == "JPG" || Extension == "jpg" || Extension == "jpeg" || Extension == "pdf" || Extension == "PDF") {

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
        return false;
        return true;
    }
	    $(document).ready(function() {

			
			 var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input type='text' name='name[]' id='name"+ (i+1) +"' type='text' placeholder='Enter Name' class='form-control'/></td><td><input name='photo_img[]' id='photo_img' type='file' placeholder='Intercom Number' class='form-control Number' /></td><td><select name='display_val[]' id='display_val' type='text' placeholder='Display' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='No'>No</option></select></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
	  
	  
			
      i++; 
	  
		
			
	  	$('.date-picker').datepicker({
					autoclose: true,
					format:'dd-mm-yyyy',
					todayHighlight: true
				})
				
					
  });
   $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });
        });
		
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


					
					
	  $.get('home_gallery_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			
				function ViewRow(id) {
				if ( 'undefined' != typeof id ) {
					
			 //$('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=T" width="100%" height="500px"></iframe>');
			 
			   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page=<?php echo base64_encode("H") ?>').then((pdf) => {
      
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