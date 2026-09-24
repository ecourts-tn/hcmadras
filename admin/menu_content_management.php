<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/menu_content_fun.php';
$m_content =new MNCFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
$doc_show_page;
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
		
		
			 //echo "INSERT INTO mhc_homepage(home_title,home_desc) VALUES('$title','$desc')";
	
try
		{
			
				
				$title=htmlspecialchars(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));				
				$desc=htmlentities($desc, ENT_QUOTES);
				$mhc_user=$_SESSION['user_session'];								
              /*   if($_FILES["img_thmp"]["name"] != '')
				{
					clearstatcache(true);
					$binary_photo = file_get_contents($_FILES["img_thmp"]["tmp_name"]);
					$img_thmp = pg_escape_bytea($binary_photo);
				}
				else
				{
					$img_thmp ="";
				} */
				
					
				
				if(empty($title))
				   {
					  
					  $error = "Enter title !";
				   }
				 else if(empty($desc))
				 {
				  $error= "Please enter valid Description";
				 }
				 else if(empty($display))
				   {
					  $error = "Enter your Display !";
				   }
				 else if(!empty($display) && $validator->chkbadchar($display) == false)
				 {
				  $error = "Please enter valid Display";
				 }
				 else
				 {
		  // echo "<script>alert('display ".$display."');</script>";
		   
					if($m_content->menu_content_insert($title,$desc,$display,$mhc_user,$bd22,$page_id,$ip,$log_fun))
					{
					  $m_content->redirect("menu_content_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
		


		if($m_content->menu_content_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $m_content->redirect("menu_content_management.php?joined2&CheckString=".$chkstr);
			 
            }
			
	}

	 	 	try
{
	
$Get_home_photo_details= $m_content->menu_content_photo_data1($chkstr,$bd22,$page_id);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
 ?>
 <script>
 
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
                                <div class="card-title">Menu Content Management</div>
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
									
                                        <div class="col-md-9 form-group mb-6">
                                            <label for="validationTooltip01">Title</label>
											<select class="form-control" id="title" required="required" name="title" autocomplete="off" style="height:34px;" >
                                                 <option value="">Select Title</option>
								<?php		if($_SESSION['roll']!='A')	{			
$select_qry = $DB_con->query("select * from  mhc_document_type where display='Y' and show_page='M' and  ".$_SESSION['dept']."=any(dept_no)");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['doc_value'].">".$row['doc_name']." </option>";
$doc_show_page[]="'".$row['doc_value']."'";

}}
else
{
	$select_qry = $DB_con->query("SELECT doc_name,doc_value FROM mhc_document_type where display='Y' and show_page='M' order by doc_name");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['doc_value'].">".$row['doc_name']." </option>";
$doc_show_page[]="'".$row['doc_value']."'";
}}
$doc_show_page_str=implode(",",$doc_show_page);
	 	try
{
	
$Get_home_details= $m_content->menu_content_data($doc_show_page_str,$chkstr,$mhc_user,$page_id,$ip,$log_fun);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
	

?>
                                              <!--  <option value="RTI">RTI</option>
                                                <option value="Disclamier">Disclamier</option>
												<option value="Forms">Forms</option>
												<option value="FAQ">FAQ</option>
												<option value="TAC">Terms and Conditions</option>
												<option value="Website_Policies">Website Policies</option>
												<option value="Help">Help</option>-->
                                            </select>
                                            <div class="invalid-tooltip">
                                              Please enter Title

                                            </div>
                                        </div>
										
										<div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip05">Display</label>
											<select class="form-control" id="display" required="required" name="display" autocomplete="off" style="height:34px;" >
                                                 <option value="">Select Display</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Display.

                                            </div>
                                        </div>
																				
									</div>
                                     <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Photo & Document Management</h4>
                               <p style="float:right"> <a class="btn btn-primary text-white " href="home_gallery_management.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id'); ?>=<?php echo $page_id; ?>&revert=<?php echo md5('M'); ?>">Add Images / Docs</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered dataTable" id="deafult_ordering_table" style="width: 100%;" role="grid" aria-describedby="deafult_ordering_table_info" >
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>File Name</th>
                                                <th>File Url</th>
                                                <th>Images/Docs</th>
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
                                                <th>File Name</th>
                                                <th>File Url</th>
                                                <th>Images/Docs</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
									<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">
                                            <label for="validationTooltip03">Description </label>
											<div class="input-group">
                                              <textarea class="content form-control" id="desc" name="desc"  required="required"></textarea>
                                            </div>
                                          
                                            <div class="invalid-tooltip">
                                                Please provide a valid Description.

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
                                <h4 class="card-title mb-3">Menu Content Details</h4>
                               
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>												
                                                <th>Title</th>												
                                                <th>Description</th>												
                                                <th>Display</th>												
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_home_details; ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											    <th>Sl.No</th>												
                                                <th>Title</th>												
                                                <th>Description</th>
                                                <th>Display</th>																							
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of row-content -->
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
 
      <!--  <div id="zoom_controls">  
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
				
        $(document).ready(function() {
			
            $('.content').richText();
		
        });
		
 
			 $( function() {
    $( ".datepicker" ).datepicker({
		dateFormat:'d-m-yy'
	});
  } );
  
function Validator(theform)
{
	
	//alert();
	
   if(chkbadchar(theform.title.value)==false )
   {
     ("Enter a Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#title').val('');
         theform.title.focus();
    return false;
   }
   
   if((theform.desc.value)==false )
   {
     swal("Enter a Desc.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#desc').val('');
         theform.desc.focus();
    return false;
   }
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
		$('#display').val('');
         theform.display.focus();
    return false;
   }
    
}
function ValidateFileUpload() {
        var fuData = document.getElementById('img_thmp');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#img_thmp').val('');
         $('#img_thmp').focus();

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
	 $('#img_thmp').val('');
         $('#img_thmp').focus();
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
  text: "You will not be able to recover this file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){


					
					
	  $.get('menu_content_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			</script>
			