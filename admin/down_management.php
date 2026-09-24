<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'default_pasword_check.php';
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
					$down_order=htmlspecialchars(filter_input(INPUT_POST, 'down_order', FILTER_SANITIZE_STRING));
					$down_type=htmlspecialchars(filter_input(INPUT_POST, 'down_type', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
				    $down_url='';
					
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
		else if(empty($_FILES['down_pdf1']['name'])&&$_POST['down_type']!="link")
 {
  $error = "Please upload your file";
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
$allowed_types = array ('application/pdf','application/x-font-ttf','application/x-rar-compressed','application/x-zip-compressed','application/zip','application/x-rar','application/x-bzip','application/x-bzip2','application/x-7z-compressed','application/gzip','application/vnd.rar','font/ttf','font/sfnt');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['down_pdf1']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents PDF Only!';
}
else
{
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
$down_url="";
 
	}}}}	
		if ($down_pdf==''&&$down_url=="") 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';
	

if($date_up)
$date_up=date('Y-m-d',strtotime($down_date));
else
	$date_up=date("Y-m-d");

	$mhc_user=$_SESSION['user_session'];		
if($down_fun->down_register($down_title,$down_pdf,$date_up,$down_type,$down_url,$down_order,$detected_type,$filename,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun))
{
	unset($error);
							$down_fun->redirect("down_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
						} 
					/*	}
	}
}
	}*/
}
	}
/*}
 }
		
 }*/
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
		


		if($down_fun->down_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $down_fun->redirect("down_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_down_details= $down_fun->downdata($chkstr,$page_id);
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
                                <div class="card-title">New Downloads Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Downloads Record Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Download Updated Successfully</strong>
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
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Downloads Title</label>
                                            <input class="form-control" id="down_title" name="down_title" type="text" placeholder="Downloads name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Title

                                            </div>
                                        </div>
										 <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Document Type</label>
											 <div class="custom-file">
                                        <select class="form-control form-control-rounded" id="down_type" name="down_type" aria-describedby="inputGroupFileAddon01" onchange="return setUploadType()">
										<option value="">Choose</option>
										<option value="pdf">PDF</option>
										<option value="link">LINK</option>
										<option value="other">TTF / ZIP / RAR</option>
										</select>
                                       
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02" id="down_pdf_link">Uploads Documents</label>
											 <div class="custom-file">
                                        <input class="custom-file-label" id="down_pdf1" name="down_pdf1" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
										<input class="custom-file-label" id="down_pdf2" name="down_pdf2" type="text" aria-describedby="inputGroupFileAddon01" style="display:none" onchange="return ValidateFileUpload()">
                                       
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>
									<!--		<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Icon</label>
											 <div class="custom-file">
                                        <input class="custom-file-label" id="icon" name="icon" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload1()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Icon.

                                            </div>
                                            
                                        </div> -->
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="down_date" name="down_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Downloads on.

                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div  class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Downloads Url</label>
                                             <input class="form-control" id="down_url" name="down_url" type="text" placeholder="Downloads Url"   autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Url

                                            </div>
                                        </div> -->
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Downloads Order</label>
                                            <div class="input-group">
                                                	 <?php 
												$stmt1 = $DB_con->prepare("SELECT max(down_order)+1 as order FROM mhc_downloads");
					$stmt1->execute();
					if($stmt1->rowCount() > 0){
						$row1=$stmt1->fetch();
						if(is_null($row1['order']))
							$d_order=1;
						else
							$d_order=$row1['order'];
					}				?>
                                                <input class="form-control Number" id="down_order" name="down_order" value="<?php echo $d_order;?>" type="text" placeholder="Downloads Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Downloads Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername"> Language</label>
                                             <select class="form-control" id="lang" name="lang" type="text" placeholder=" Language"   autocomplete="off" >
											 <option value="">Choose</option>
                                              <option value="English">English</option>
											   <option value="Tamil">Tamil</option>
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
                                              <option value="Y">Yes</option>
											   <option value="N">No</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltipUsername">Suport OS</label>
                                            <div class="input-group">
                                                
                                                 <input class="form-control" name="app_os" id="app_os" required="required" autocomplete="off" >
                                                
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
                                <h4 class="card-title mb-3">Downloads Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Downloads Title</th>
												<!--<th>Downloads Url</th> -->
                                                <th>Uploads Date</th>
                                                <th>Downloads Documents</th>
                                                <!--<th>Downloads Icon</th>-->
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_down_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											     <th>Sl.No</th>
                                                <th>Downloads Title</th>
												<!--<th>Downloads Url</th>-->
                                                <th>Uploads Date</th>
                                                <th>Downloads Documents</th>
                                                <!--<th>Downloads Icon</th>-->
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
 
     <!--   <div id="zoom_controls">  
            <button id="zoom_in">+</button>
            <button id="zoom_out">-</button>
        </div>-->
    </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                              <!--  <button class="btn btn-primary ml-2" type="button">Save changes</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			<?php include 'include/footer.php' ?>
			
			<script>
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
  
   if(chkbadchar(theform.down_date.value)==false )
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
    else if(chkbadchar(theform.down_type.value)==false )
   {
     swal("Enter a Valid  Download Type.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#down_type').val('');
         theform.down_type.focus();
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


					
					
	  $.get('down_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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
	function setUploadType()
	{
		var type=$("#down_type").val();
		if(type=="link")
		{
			$("input[name=down_pdf1]").css('display','none');
			$("input[name=down_pdf2]").css('display','block');
			$("#down_pdf_link").text("Link");
		}
		else{
			$("input[name=down_pdf2]").css('display','none');
			$("input[name=down_pdf1]").css('display','block');
			$("#down_pdf_link").text("Upload Document");
		}
			
	}
		function ViewRow(id) {
				if ( 'undefined' != typeof id ) {
					
					
			// $('#pdf_doc').html('<iframe src="view_pdf.php?pdf_id='+id+'&page=O" width="100%" height="500px"></iframe>');
			   var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('view_pdf.php?pdf_id='+btoa(id)+'&page=<?php echo base64_encode("O") ?>').then((pdf) => {
      
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
			</script>