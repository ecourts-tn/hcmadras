<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/f_jud_fun.php';


$f_jud_fun =new FJUDFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	
try
		{
				$pre_name=htmlspecialchars(filter_input(INPUT_POST, 'pre_name', FILTER_SANITIZE_STRING));
				$jud_name=htmlspecialchars(filter_input(INPUT_POST, 'jud_name', FILTER_SANITIZE_STRING));
				$jud_app_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_app_date', FILTER_SANITIZE_STRING));
				$jud_rel_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_rel_date', FILTER_SANITIZE_STRING));
				$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
				$jud_pri=htmlspecialchars(filter_input(INPUT_POST, 'jud_pri', FILTER_SANITIZE_STRING));
				$fj_fyr=htmlspecialchars(filter_input(INPUT_POST, 'fj_fyr', FILTER_SANITIZE_STRING));
				$fj_tyr=htmlspecialchars(filter_input(INPUT_POST, 'fj_tyr', FILTER_SANITIZE_STRING));
				
					if($jud_app_date!='')
					{
						$jud_app_dt=date('Y-m-d',strtotime($jud_app_date));
					}
					else
					{
						$jud_app_dt=null;
					}
					if($jud_rel_date!='')
					{
						$jud_rel_dt=date('Y-m-d',strtotime($jud_rel_date));
					}
					else
					{
						$jud_rel_dt=NULL;
					}
			
					  if(empty($jud_name))
   {
      
      $error = "Enter your Judge's Name !";
   }
   else if(!empty($jud_name) && $validator->chkbadchar($jud_name) == false)
 {
  $error= "Enter your Judge's Name !";
 }

   else if(empty($display))
   {
      
      $error = "Please select Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please select valid Display ";
 }
  else if(empty($jud_pri))
   {
      
      $error = "Enter your Judge's Priority !";
   }
 else if(!empty($jud_pri) && $validator->chkbadchar($jud_pri) == false)
 {
  $error = "Please enter valid Judge's Priority ";
 }
  else if(empty($pre_name))
   {
      
      $error = "Enter your Prefix Name !";
   }
 else if(!empty($pre_name) && $validator->chkbadchar($pre_name) == false)
 {
  $error = "Please enter valid Prefix Name ";
 }
  else if(empty($fj_fyr))
   {
      
      $error = "Enter Service From Year !";
   }
 else if(!empty($fj_fyr) && $validator->chkbadchar($fj_fyr) == false)
 {
  $error = "Please enter valid Service From Year ";
 } else if(empty($fj_tyr))
   {
      
      $error = "Enter Service To Year!";
   }
 else if(!empty($fj_tyr) && $validator->chkbadchar($fj_tyr) == false)
 {
  $error = "Please enter valid Service To Year ";
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
if($_FILES['photo']['name'])
{
$image1=$_FILES['photo']['name'];
$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file($fileInfo, $_FILES['photo']['tmp_name'] );
$tmp=$_FILES["photo"]["tmp_name"];
}
else
{
	$image1="CJ.jpg";
	$allowed_types =array();
	$detected_type ='';

}

if (!in_array($detected_type, $allowed_types )&& $_FILES['photo']['name']) {
		$error='Please Upload Documents JPG Only!';
}
else
{
if ($image1) 
{
	$filename = stripslashes($image1);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg") && ($extension != "jpeg")) 
	{
		$error='Upload Documents JPG Only!';
		
	}
	else
	{
		if($_FILES['photo']['name'])
		{
			$size1=filesize($_FILES['photo']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 


$binary_bar = file_get_contents($_FILES["photo"]["tmp_name"]);
$dp_image = pg_escape_bytea($binary_bar);

		}
		else
		{
$binary_bar = file_get_contents("images/CJ.jpg");
$dp_image = pg_escape_bytea($binary_bar);

		
		}
		
		if ($dp_image=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull! for image</h3>';
	
					
if($f_jud_fun->f_jud_register($pre_name,$jud_name,$jud_app_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$bd22,$mhc_user,$page_id,$ip,$log_fun,$fj_fyr,$fj_tyr))
{
	unset($error);
					 $f_jud_fun->redirect("f_jud_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
				
			
			}
			else
			{
				//$jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
				//$jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr);			
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
		


		if($f_jud_fun->f_jud_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
          $f_jud_fun->redirect("f_jud_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_fjud_details= $f_jud_fun->f_juddata($chkstr,$bd22,$page_id);
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
                                <div class="card-title">Former Puisne Judges Entry Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Former Judge Added Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Former Judge Details Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Former Judge Detials Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
									<div class="col-md-1 form-group mb-1">
                                            <label for="validationTooltip01">Prefix Name</label>
                                            <input class="form-control" id="pre_name" name="pre_name" type="text" placeholder="Prefix"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Prefix Name

                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip01">Judge's Name</label>
                                            <input class="form-control" id="jud_name" name="jud_name" type="text" placeholder="Judge's name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Judge's Name

                                            </div>
                                        </div>
                                       
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Judge's Appointed on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_app_date" name="jud_app_date" type="text" placeholder="Judge's  Appointed on" aria-describedby="validationTooltipUsernamePrepend" autocomplete="off" />
                                               
                                            </div>
                                        </div>
                                       <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Judge's Relieved on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_rel_date" name="jud_rel_date" type="text" placeholder="Judge's Relieved on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                
                                            </div>
                                        </div>
										
										</div>
                                    <div class="form-row">
										
                                   
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Photo</label>
                                           
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="photo" name="photo" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                      
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Photo.

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                             <label for="validationTooltip03">Judge's Seniority</label>
											 <?php 
												$stmt1 = $DB_con->prepare("SELECT max(j_sen)+1 as order FROM former_judges");
					$stmt1->execute();
					if($stmt1->rowCount() > 0){
						$row1=$stmt1->fetch();
						if(is_null($row1['order']))
							$d_order=1;
						else
							$d_order=$row1['order'];
					}		?>
                                            <input class="form-control Number" id="jud_pri" name="jud_pri" type="text" placeholder="Judge's Priority" required="required"  autocomplete="off" value="<?php echo $d_order;?>"/>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge's Seniority.

                                            </div>
                                           
                                            
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Display</label>
											<select class="form-control" id="display" required="required" name="display" autocomplete="off" >
                                                 <option value="">Choose</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Display.

                                            </div>
                                        </div>
										  
									
										</div>
									<div class="form-row" >
									
                                    
                                        <div class="col-md-4 form-group mb-3" >
										 <label for="validationTooltip05">Service Year - From</label>
										  <div id='cj_from_yf' >
										  <div class="input-group" >
										  <input class="form-control Number" id="fj_fyr" name="fj_fyr" type="text" placeholder="YYYY" autocomplete="off" maxlength='4'  required="required"  />
										  <div class="invalid-tooltip">
                                                Please provide a valid Year.

                                            </div>
										  </div>
                                           
										</div>
										 
											</div>
										 <div class="col-md-4 form-group mb-3"  >
										 <label for="validationTooltip05">Service Year - To</label>
										  <div id='cj_to_yf'>
										  <div class="input-group" >
										  <input class="form-control Number" id="fj_tyr" name="fj_tyr" type="text" placeholder="YYYY" autocomplete="off" maxlength='4'  required="required"  />
										    <div class="invalid-tooltip">
                                                Please provide a valid Year.

                                            </div>
										  </div>
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
                                <h4 class="card-title mb-3">List of Former Puisne Judges</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="f_jud_management_order.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id')?>=<?php echo $page_id ?>">Ordering</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>Photo</th>
                                                <th>Judge Name</th>
                                                <th>Period</th>
												<th>Display</th>
												<th>Seniorty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_fjud_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											  <th>Sl.No</th>
												<th>Photo</th>
                                                <th>Judge Name</th>
                                                <th>Period</th>
												<th>Display</th>
												<th>Seniorty</th>
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
			

		
			
			<script>
			
			 $( function() {
    $( ".datepicker" ).datepicker({
		dateFormat:'d-m-yy'
	});
  } );
			function Validator(theform)
{
     if(!(theform.pre_name.value) )
   {
     swal("Enter a Valid  Judge's Prefix Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#pre_name').val('');
         theform.pre_name.focus();
    return false;
   }
    else if(!(theform.jud_name.value) )
   {
     swal("Enter a Valid  Judge's Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_name').val('');
         theform.jud_name.focus();
    return false;
   }
   
  else if(chkbadchar(theform.jud_app_date.value)==false )
   {
     swal("Enter a Valid  Judge's  Appointed on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_app_date').val('');
         theform.jud_app_date.focus();
    return false;
   }
 
   else if(chkbadchar(theform.jud_rel_date.value)==false )
   {
     swal("Enter a Valid  Judge's Relieved on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#reg_rel_date').val('');
         theform.reg_rel_date.focus();
    return false;
   }
   
   else if(isNumber(theform.jud_pri.value)==false )
    {
		swal("Enter a Valid  Judge's Priority.", "", "error");
		$('#jud_pri').val('');
         theform.jud_pri.focus();
    return false;
    }
  
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
		$('#display').val('');
         theform.display.focus();
    return false;
   }
   else if(chkbadchar(theform.fj_fyr.value)==false )
   {
     swal("Enter a Valid From Year.", "", "error");
    
		$('#fj_fyr').val('');
         theform.fj_fyr.focus();
    return false;
   }
   else if(chkbadchar(theform.fj_tyr.value)==false )
   {
     swal("Enter a Valid To Year.", "", "error");
    
		$('#fj_tyr').val('');
         theform.fj_tyr.focus();
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

if (Extension == "JPG" || Extension == "jpg") {

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

function removeRow(id) {
			
	  if ( 'undefined' != typeof id ) {
		  
	
	 swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this data!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){


					
					
	  $.get('f_jud_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			</script>