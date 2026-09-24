<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/meeting_fun.php';
$meeting_fun =new MEETINGFUN($DB_con);

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
			
			
						
						
if($meeting_fun->meeting_register($meeting_title,$meeting_judges,$meeting_date,$img_thmp,$display,$mhc_user,$page_id,$ip,$log_fun))
{
	
	$meeting_fun->redirect("meeting_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 

			
		 
						} 
						}
	}
}
				}
}
		
 }
 else
	 $error="Please upload file!";
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
		


		if($meeting_fun->meeting_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $meeting_fun->redirect("photo_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_meeting_details= $meeting_fun->meetingdata($chkstr,$bd22,$page_id);
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
                                <div class="card-title">Meeting Management Form</div>
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
                                    <div class="form-row">
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip01">Meeting Title</label>
                                            <input class="form-control" id="meeting_title" name="meeting_title" type="text" placeholder="Meeting name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
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

	
											echo "<option value='".$jud_result['j_id']."'>".$jud_name."</option>";
											
										}
											 ?>
                                            
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Meeting Judges

                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Meeting Date</label>
                                            <input class="form-control datepicker" name="meeting_date" id="meeting_date" required="required" autocomplete="off" />
                                             
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
                                              <option value="Y">Yes</option>
											   <option value="N">No</option>
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
					 <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Meeting Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Meeting Title</th>
												<th>Meeting Judges</th>
                                                <th>Meeting Date</th>
												<th>Meeting File</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_meeting_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											    <th>Sl.No</th>
                                               <th>Meeting Title</th>
												<th>Meeting Judges</th>
                                                <th>Meeting Date</th>
                                                <th>Meeting File</th>
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
 
        <div id="navigation_controls" align='center'>
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number" min='1'/>
            <button id="go_next">Next</button>
        </div>
 
      <!--  <div id="zoom_controls" align='center'>  
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
function ViewRow(id) {
				if ( 'undefined' != typeof id ) {
					
			// $('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=M" width="100%" height="500px"></iframe>');
			 
        
			   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page=<?php echo base64_encode("M") ?>').then((pdf) => {
		
      
          //  myState.pdf = pdf;
          //  render();
			  if (this.pdf) {
            this.pdf.destroy();
        }
        
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
		   if(document.getElementById('current_page').valueAsNumber<myState.pdf._pdfInfo.numPages)
            myState.currentPage += 1;
		else
			return;
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
 
     /*   document.getElementById('zoom_in').addEventListener('click', (e) => {
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


					
					
	  $.get('meeting_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
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