<?php 
include 'include/header.php';
include 'function/menu_content_fun.php';
$m_content =new MNCFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);


	if(isset($_POST['submit'])) {
		
	//var_dump('haiiiiiiiiiiiiiiiii');
try
		{
				$title=htmlspecialchars(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
				$desc=htmlentities($desc, ENT_QUOTES);	
		
						$mhc_user=$_SESSION['user_session'];
				/* 	if($_FILES["img_thmp"]["name"] != '')
					{
						clearstatcache(true);
						$binary_photo = file_get_contents($_FILES["img_thmp"]["tmp_name"]);
						$img_thmp = pg_escape_bytea($binary_photo);
					}
					else
					{
						$img_thmp ="";
					} */	
					//error_log($img_thmp);
					if($title=='')
					{
						 $error = "Enter your title !";
					}
					if($desc=='')
					{					
						 $error = "Enter your Description !";
					}
					else
					{
							$image1=$_FILES['img_thmp']['name'];
					if ($image1) 
{
	$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['img_thmp']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG Only!';
}
else
{
	$filename = stripslashes($_FILES['img_thmp']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg")) 
	{
		$error='Upload Documents JPG Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['img_thmp']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
		$binary_photo = file_get_contents($_FILES["img_thmp"]["tmp_name"]);
					$img_thmp = pg_escape_bytea($binary_photo);

 
		
		if ($img_thmp=='') 
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
$img_thmp ="";
}
						if($m_content->menu_content_update($edit_id,$title,$desc,$display,$mhc_user,$bd22,$page_id,$ip,$log_fun))
                        {
							$m_content->redirect("menu_content_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
		
		
		
		$sql1 ="select * from mhc_menu_content where h_id='$edit'";
		$exe1 = pg_query($bd22,$sql1);
		$sno=1;
		$editRow = pg_fetch_array($exe1);
		
		
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
                                <div class="card-title">Menu Content Update Form</div>
							<?php
				if(isset($error))
            {
              
                  ?>
				  <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize"> <?php echo $error; ?>!</strong> 
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
                 
                  <?php
               
            }
           
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								 <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['h_id']); }?>" >
                                    <div class="form-row">
									<div class="col-md-9 form-group mb-9">
                                            <label for="validationTooltip01">Title</label>
											<select class="form-control" id="title" required="required" name="title" autocomplete="off" style="height:34px;" >       
	 <?php
												 if(isset($_GET['edit_id']))
	{
								if($_SESSION['roll']!='A')	{			
$select_qry = $DB_con->query("select * from  mhc_document_type where display='Y' and show_page='M' and ".$_SESSION['dept']."=any(dept_no)");
while($row = $select_qry->fetch())
{
	
	 if(trim($editRow['title']," ")==trim($row['doc_value']," "))
	 echo "<option value=".$row['doc_value']." SELECTED >".$row['doc_name']." </option>";
	else
		echo "<option value=".$row['doc_value']." >".$row['doc_name']." </option>";
	
}
}
else
{
	$select_qry = $DB_con->query("SELECT doc_name,doc_value FROM mhc_document_type where  show_page='M' and  display='Y' order by doc_name");
while($row = $select_qry->fetch())
{
	//echo "<script>alert('".$editRow['doc_show_page']."-->".$row['doc_value']."');</script>";
	 if(trim($editRow['title']," ")==trim($row['doc_value']," "))
		 {//echo "<script>alert('inside if');</script>";
		echo "<option value=".$row['doc_value']." SELECTED >".$row['doc_name']." </option>";
		 }
	else
		{//echo "<script>alert('inside if');</script>";
		echo "<option value=".$row['doc_value']." >".$row['doc_name']." </option>";
		}
}}
}
?>

											
                                              <!--  <option value="RTI"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='RTI'){ echo "SELECTED"; }}?>>RTI</option>
                                                <option value="Disclamier"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='Disclamier'){ echo "SELECTED"; }}?>>Disclamier</option>
												 <option value="Forms"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='Forms'){ echo "SELECTED"; }}?>>Forms</option>
                                                <option value="FAQ"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='FAQ'){ echo "SELECTED"; }}?>>FAQ</option>
												 <option value="TAC"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='TAC'){ echo "SELECTED"; }}?>>Terms and Conditions</option>
                                                <option value="Website_Policies"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='Website_Policies'){ echo "SELECTED"; }}?>>Website Policies</option>
												 <option value="Help"<?php  if(isset($_GET['edit_id'])){ if($editRow['title']=='Help'){ echo "SELECTED"; }}?>>Help</option>-->
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                               Enter Your Title

                                            </div>
                                        </div>
										
									   <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip05">Display</label>
											<select class="form-control" id="display" required="required" name="display" autocomplete="off" style="height:34px;" >                                                
                                                <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
                                                <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Display.

                                            </div>
                                        </div>
										
										
                                        										
                                        	
                                        	   <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Photo & Document Management</h4>
                               <p style="float:right"> <a class="btn btn-primary text-white " href="home_gallery_management.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id')?>=<?php echo $page_id ?>">Add Images / Docs</a></p>
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
                                    </div>
                                   <div class="form-row">
                                        <div class="col-md-12 form-group mb-12">                                            
										<div class="input-group">  
										<label for="validationTooltip03">Description </label>										
                                           <textarea class="content form-control" id="desc" name="desc" aria-label="With textarea" required="required"><?php  if(isset($_GET['edit_id'])){ echo(html_entity_decode($editRow['m_desc'])); }?></textarea>
                                        </div>
                                          
                                            <div class="invalid-tooltip">
                                                Please provide Description.

                                            </div>
                                        </div>
										</div>
										
                                    <input  class="btn btn-primary" name="submit" id="submit" value="submit" type="submit" />
                                </form>
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
 
        <div id="zoom_controls">  
            <button id="zoom_in">+</button>
            <button id="zoom_out">-</button>
        </div>
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
	
     if((theform.title.value)==false )
   {
     swal("Enter a Valid Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#pre_name').val('');
         theform.title.focus();
    return false;
   }
    else if((theform.desc.value)==false )
   {
     swal("Enter a Valid  Description.", "", "error");
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
 
        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });
 
        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
        });
				 $('.bd-example-modal-lg').modal('show')
			
					
				} else alert('Unknown row id.');
			}
			</script>