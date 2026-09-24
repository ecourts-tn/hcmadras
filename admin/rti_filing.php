<?php 
include 'include/header.php';
include 'function/reg_fun.php';
$reg_fun =new REGFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	
try
		{
				$reg_name=htmlspecialchars(filter_input(INPUT_POST, 'reg_name', FILTER_SANITIZE_STRING));
				$designation=htmlspecialchars(filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_STRING));
				$cont_no=htmlspecialchars(filter_input(INPUT_POST, 'cont_no', FILTER_SANITIZE_STRING));
				$fax_no=htmlspecialchars(filter_input(INPUT_POST, 'fax_no', FILTER_SANITIZE_STRING));
				$place=htmlspecialchars(filter_input(INPUT_POST, 'place', FILTER_SANITIZE_STRING));
				$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
					if($_POST['reg_app_date']!='')
					{
						$reg_app_date=date('Y-m-d',strtotime($_POST['reg_app_date']));
					}
					else
					{
						$reg_app_date='';
					}
					if($_POST['reg_rel_date']!='')
					{
						$reg_rel_date=date('Y-m-d',strtotime($_POST['reg_rel_date']));
					}
					else
					{
						$reg_rel_date=NULL;
					}
			
			$cont_no=implode(',',$_POST['cont_no']);
			$fax_no=implode(',',$_POST['fax_no']);
					  if(empty($reg_name))
   {
      
      $error = "Enter your Registrar Name !";
   }
 else if(!empty($reg_name) && $validator->chkbadchar($reg_name) == false)
 {
  $error= "Please enter valid Registrar Name";
 }
 else if(empty($designation))
   {
      
      $error = "Enter your Designation !";
   }
 else if(!empty($designation) && $validator->chkbadchar($designation) == false)
 {
  $error = "Please enter valid Designation ";
 }

 else if($validator->chkbadchar($cont_no) == false)
 {
  $error= "Please enter valid Contact Number ";
 }

  else if($validator->chkbadchar($fax_no) == false)
   {
      
      $error = "Enter your valid Fax No!";
   }

 else if(empty($reg_app_date))
   {
      
      $error = "Enter your Registrar Appointed Date !";
   }
 else if(!empty($reg_app_date) && $validator->chkbadchar($reg_app_date) == false)
 {
  $error = "Please enter valid Registrar Appointed Date ";
 }
  else if(empty($place))
   {
      
      $error = "Enter your Place !";
   }
 else if(!empty($place) && $validator->chkbadchar($place) == false)
 {
  $error = "Please enter valid Place ";
 }
   else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
 
  else if(empty($reg_pri))
   {
      
      $error = "Enter your Registrar Priorty !";
   }
 else if(!empty($reg_pri) && $validator->chkbadchar($reg_pri) == false)
 {
  $error = "Please enter valid Registrar Priorty ";
 }
  else if(empty($pre_name))
   {
      
      $error = "Enter your Prefix Name !";
   }
 else if(!empty($pre_name) && $validator->chkbadchar($pre_name) == false)
 {
  $error = "Please enter valid Prefix Name ";
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
$image1=$_FILES['photo']['name'];
$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['photo']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG Only!';
}
else
{
if ($image1) 
{
	$filename = stripslashes($_FILES['photo']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg")) 
	{
		$error='Upload Photo JPG Only!';
		
	}
	else
	{
		$size1=filesize($_FILES['photo']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 
	
$binary_bar = file_get_contents($_FILES["photo"]["tmp_name"]);
$dp_image = pg_escape_bytea($binary_bar);

 
		
		if ($dp_image=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
			/* $stmt = $DB_con->prepare("SELECT * FROM registrars WHERE  reg_contact_no=:cont_no OR reg_fax_no=:fax_no");
					$stmt->execute(array(':cont_no'=>$cont_no,':fax_no'=>$fax_no));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						if($row['reg_contact_no']==$cont_no)
						{
					   $error= 'Contact Already Exists';
						}
						else if($row['fax_no']==$fax_no)
						{
					   $error= 'Fax No Already Exists';
						}
						
					}
					else
					{
						} */
if($reg_fun->reg_register($reg_name,$reg_app_date,$reg_rel_date,$designation,$cont_no,$fax_no,$place,$display,$dp_image,$reg_pri,$pre_name,$mhc_user,$page_id,$ip,$log_fun))
{
							$reg_fun->redirect("reg_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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
		


		if($reg_fun->reg_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $reg_fun->redirect("reg_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
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
                                <div class="card-title">RTI Filing Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Registrar Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Registrar Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Registrar Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
									<div class="col-md-2 form-group mb-1">
                                            <label for="validationTooltip01">Prefix Name</label>
                                            <input class="form-control" id="pre_name" name="pre_name" type="text" placeholder="Prefix name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Registrar Name

                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip01">Registrar Name</label>
                                            <input class="form-control" id="reg_name" name="reg_name" type="text" placeholder="Registrar name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Registrar Name

                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip02">Designation</label>
                                            <select class="form-control" id="designation" name="designation" type="text" placeholder="Designation"  required="required" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
											 <option value="">Choose</option>
											 <?php
											 $select_qry = $DB_con->query("select sno,desig from officer_designation where display='Y' order by sno asc");
while($row = $select_qry->fetch())
{
echo "<option value=".$row['sno'].">".$row['desig']." </option>";
}

?>
                                                
												</select>
                                            <div class="invalid-tooltip">
                                               Enter Your Designation

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Contact No</label>
											 <div class="form-group multiple-form-group input-group">
                       
                        <input type="text" name="cont_no[]" class="form-control Number" placeholder="Enter Contact Number" maxlength="8"    autocomplete="off">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </span>
                    </div>
                                            <!--<input class="form-control Number" id="cont_no" name="cont_no" type="text" placeholder="Enter Contact Number" maxlength="8"  required="required"  autocomplete="off" />-->
                                            <div class="invalid-tooltip">
                                               Enter Your Contact No

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Registrar  Appointed on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control datepicker" id="reg_app_date" name="reg_app_date" type="text" placeholder="Registrar  Appointed on" aria-describedby="validationTooltipUsernamePrepend" required="required"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Registrar  Appointed on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Registrar Relieved on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="reg_rel_date" name="reg_rel_date" type="text" placeholder="Registrar Relieved on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Registrar Relieved on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipemailidPrepend">Fax No</label>
                                            <div class="input-group">
                                                <div class="form-group multiple-form-group input-group">
                       
                        <input type="text" name="fax_no[]" class="form-control Number" placeholder="Fax No" aria-describedby="validationTooltipemailidPrepend"  autocomplete="off" maxlength="8">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </span>
                    </div>
                                                <!--<input class="form-control Number" id="fax_no" name="fax_no" type="text" placeholder="Fax No" aria-describedby="validationTooltipemailidPrepend" required="required"  autocomplete="off" maxlength="8" />-->
                                                <div class="invalid-tooltip">
                                                    Please choose a unique and valid Fax No.

                                                </div>
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
                                            <label for="validationTooltip04">Place</label>
											<select class="form-control" name="place" id="place" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                                <option value="MHC">Madras High Court</option>
                                                <option value="MDU">Madurai Bench</option>
                                            </select>
                                           
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.

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
									<div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Registrar Priorty</label>
                                            <input class="form-control Number" id="reg_pri" name="reg_pri" type="text" placeholder="Registrar Priorty" required="required"  autocomplete="off" maxlength='2' />
                                            <div class="invalid-tooltip">
                                                Please provide a valid Registrar Priorty.

                                            </div>
                                        </div>
										</div>
                                    <input  class="btn btn-primary" name="submit" id="submit" value="submit" type="submit" />
                                </form>
                            </div>
                        </div>
						
                    </div>
					
                </div><!-- end of main-content -->
				
            </div>
			
			<?php include 'include/footer.php' ?>
			
			<script>
			(function ($) {
    $(function () {

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-success btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.find('.concept').text('Phone');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }
			$('.Number').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }

            $formGroup.remove();
        };

      /*   var selectFormGroup = function (event) {
            event.preventDefault();

            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();

            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        } */

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);
        //$(document).on('click', '.dropdown-menu a', selectFormGroup);

		
		
    });
})(jQuery);
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.reg_name.value)==false )
   {
     swal("Enter a Valid  Registrar Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#reg_name').val('');
         theform.reg_name.focus();
    return false;
   }
   if(chkbadchar(theform.reg_app_date.value)==false )
   {
     swal("Enter a Valid  Registrar  Appointed on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#reg_app_date').val('');
         theform.reg_app_date.focus();
    return false;
   }
   if(chkbadchar(theform.reg_rel_date.value)==false )
   {
     swal("Enter a Valid  Registrar Relieved on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#reg_rel_date').val('');
         theform.reg_rel_date.focus();
    return false;
   }
   else if(chkbadchar(theform.cont_no.value)==false )
   {
     swal("Enter a Valid  Contact Number.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#cont_no').val('');
         theform.cont_no.focus();
    return false;
   }
   else if(isNumber(theform.cont_no.value)==false )
    {
		swal("Enter a Valid  Contact Number.", "", "error");
		$('#cont_no').val('');
         theform.cont_no.focus();
    return false;
    }
    else if(chkbadchar(theform.fax_no.value)==false )
   {
     swal("Enter a Valid  Fax No.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#fax_no').val('');
         theform.fax_no.focus();
    return false;
   }
  else if(isNumber(theform.fax_no.value)==false )
    {
		swal("Enter a Valid  Fax Number.", "", "error");
		$('#fax_no').val('');
         theform.fax_no.focus();
    return false;
    }
   else if(chkbadchar(theform.designation.value)==false )
   {
     swal("Enter a Valid  Designation", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#designation').val('');
         theform.designation.focus();
    return false;
   }
   else if(chkbadchar(theform.place.value)==false )
   {
     swal("Enter a Valid  Place", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#place').val('');
         theform.place.focus();
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
	 $('#photo').val('');
         $('#photo').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
  function CheckCont()
	{
		
		var cont_no=$('#cont_no').val();
		
		//alert(state_id);
		if(cont_no!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "get_data.php",
			data: {
				action:'contacchk',
				cont_num:cont_no
				},
				success: function(data)
				{	
				if(data == 1) {	
				swal("Contact Number Already Exists. Try again!!", "", "error");
				$('#cont_no').val('');
				$('#cont_no').focus();	
					
				}
				else if(data == 2)
				{
					$('#cont_no').focus();
				}
				else
				{
					swal(data, "", "error");
				$('#cont_no').val('');
				$('#cont_no').focus();	
				}			
				} 
			});
		}
		
	}
	function CheckFaxno()
	{
		
		var fax_no=$('#fax_no').val();
		
		//alert(state_id);
		if(fax_no!="")
		{
			
			$.ajax({ 
			method: "POST",
			url: "get_data.php",
			data: {
				action:'faxnochk',
				fax_num:fax_no
				},
				success: function(data)
				{	
				if(data == 1) {	
				swal("Fax Number Already Exists. Try again!!", "", "error");
				$('#fax_no').val('');
				$('#fax_no').focus();	
					
				}
				else if(data == 2)
				{
					$('#fax_no').focus();
				}
				else
				{
					swal(data, "", "error");
				$('#fax_no').val('');
				$('#fax_no').focus();	
				}
							
				} 
			});
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


					
					
	  $.get('reg_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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