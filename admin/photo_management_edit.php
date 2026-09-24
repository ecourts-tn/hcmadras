<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);

include 'include/header.php';
include 'function/photo_fun.php';
$photo_fun =new PHOTOFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
define ("MAX_SIZE","1000"); 
extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$photo_title=htmlspecialchars(filter_input(INPUT_POST, 'photo_title', FILTER_SANITIZE_STRING));
					$photo_year=htmlspecialchars(filter_input(INPUT_POST, 'photo_year', FILTER_SANITIZE_STRING));
					
					
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
					$mhc_user=$_SESSION['user_session'];
					$cur_date=date('Y-m-d');
					  if($_FILES["photo"]["name"] != '')
				{
					clearstatcache(true);
				
					
					$image1=$_FILES['photo']['name'];
					if ($image1) 
{
	$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file( $fileInfo, $_FILES['photo']['tmp_name'] );
if ( !in_array($detected_type, $allowed_types) ) {
		$error='Upload Documents JPG Only!';
}
else
{
	$filename = stripslashes($_FILES['photo']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg")) 
	{
		$error='Upload Documents JPG Only!';
		
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
		$error='';
	}
	}
}
}
				}
				else
				{
					$img_thmp ="";
				}
				
					
					  if(empty($photo_title))
   {
      
      $error = "Enter your Photo Name !";
   }
 else if(!empty($photo_title) && $validator->chkbadchar($photo_title) == false)
 {
  $error= "Please enter valid Photo Name";
 }
				 else if(empty($photo_year))
   {
      
      $error = "Enter your Photo Year !";
   }


 else if($validator->chkbadchar($photo_year) == false)
 {
  $error= "Please enter valid Photo Year ";
 }
 else if($validator->test_datatype($photo_year,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Photo Year ";
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
			
			
					
if($photo_fun->photo_update($edit_id,$photo_title,$photo_year,$img_thmp,$display,$mhc_user,$bd22,$page_id,$ip,$log_fun))
{
							
		 $photo_id=$edit_id;
		 $ga_edit_id=$_POST['ga_edit_id'];
		 
		 $name=$_POST['name'];
			 $img=$_FILES['photo_img']['tmp_name'];
			 $img_name=$_FILES['photo_img']['name'];
			 $display_val=$_POST['display_val'];
		  if($photo_id!='' && $name!=''  && $display_val!='')
	{
		$error1=array();
for ($i = 0; $i < count($name); $i++) 
{

	  $gallery_id=$ga_edit_id[$i];
	  $photo_name=$name[$i];
//error_log($gallery_id);
  $photo_display=$display_val[$i];
  $images=$img[$i];
$images_name=$img_name[$i];

$error1[$i]='Error in Photo '.$img_name[$i].' - ';
 if($images!='')
 {	
	 $allowed_types1 = array ('image/jpeg','image/jpg');
$fileInfo1 = finfo_open(FILEINFO_MIME_TYPE);
$detected_type1 = finfo_file( $fileInfo1, $img[$i]);
if ( !in_array($detected_type1, $allowed_types1) ) {
		$error1[$i].='Upload Documents JPG Only!';	
}
else
{
$filename = stripslashes($images_name);	
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg")) 
	{
		$error1[$i].='Upload Documents image Only!';
	}
	else
	{
		$size1=filesize($img[$i]);
		if ($size1 > MAX_SIZE*1024)
		{
			$error1[$i].='You have exceeded the size limit!';
		}
 $binary_bar1 = file_get_contents($images);
$base64_doc_up = pg_escape_bytea($binary_bar1);

		
		if ($base64_doc_up=='') 
		{
			$error1[$i].='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error1[$i]='';
	}
	}
 }
 }
 else
 {
	 $error1[$i]='';
	 $base64_doc_up='';
 }

		if($error1[$i]==''){
 $photo_fun->gallery_update($gallery_id,$photo_id,$photo_name,$base64_doc_up,$photo_display,$mhc_user,$bd22,$page_id,$ip,$log_fun);
		}
            
  
			  }
			   $redirect_flag=0;
			  for($j=0;$j<count($error1);$j++)
			  {
				  if($error1[$j]!='')
				  {
					  $error.=$error1[$j].'<br>';
				  }
				  else{
					  $error.=($j+1).' '.$img_name[$j].' uploaded successfully<br>';
					  $redirect_flag++;
				  }
			  }
			  if($redirect_flag==count($error1))
			  {	 
				unset($error);
			  $photo_fun->redirect("photo_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			  }
			}
			
		 
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_photo where photo_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

 
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
                                <div class="card-title">New Photo Gallery Registration Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Photo Successfully Register</strong>
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
								<input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['photo_id']); }?>" >
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Photo Title</label>
                                            <input class="form-control" id="photo_title" name="photo_title" type="text" placeholder="Photo name"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['photo_title']); }?>" required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Video Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Photo Year</label>
                                            <select class="form-control" name="photo_year" id="photo_year" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                             <?php
											  $currently_selected =$editRow['photo_year']; 
  // Year to start available options at
  $earliest_year = 1950; 
  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
  $latest_year = date('Y'); 


  // Loops over each int[year] from current year, back to the $earliest_year [1950]
  foreach ( range( $latest_year, $earliest_year ) as $i ) {
    // Prints the option with the next year in range.

    print '<option value="'.$i.'"'.($i == $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
  }
											 ?>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Video Url

                                            </div>
                                        </div>
									
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Photo Thumbnail</label>
                                           <img src="view_image.php?img_id=<?php echo  base64_encode($editRow['photo_id'])?>&page=<?php echo  base64_encode('P')?>" width="50" height="50" />
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="photo" name="photo" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                        
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Photo.

                                            </div>
                                        </div>
										
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                               <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
											   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
                                            </select>
                                            </div>
                                        </div>
										
										<div class="col-md-12 form-group mb-12">		
            
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
        <td rowspan="1">Sl.NO</td>
        <td rowspan="1">Title</td>
        <td rowspan="1">Photo</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
				<?php
				$ed_id=$editRow['photo_id'];
 $sql2 ="select * from photo_gallery where photo_id='$edit'";
		$exe2 = pg_query($bd22,$sql2);
		$i=0;
		if(pg_num_rows($exe2) > 0)
		{
		while($editRow2 = pg_fetch_array($exe2))
		{
?>	
<tr id='addr<?php echo $i;?>'>
		     <td>
			<?php echo $i+1;?>
			<input type="hidden" name="ga_edit_id[]" id='ga_edit_id' value="<?php  if(isset($_GET['edit_id'])){ print($editRow2['gallery_id']); }?>" />
			<input type='hidden' value='M' id='mod_ins' name='mod_ins[]'></input>
		    </td>
		     <td>
		     <input type="text" class="form-control" name="name[]" id="name"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow2['img_title']); }?>" placeholder="Enter Name"  />
		   
			</td>
            <td>
		   <input type="file" class="form-control" name="photo_img[]" id="photo_img"  value="" placeholder="Enter "  />
		   <img src="view_image.php?img_id=<?php echo  base64_encode($editRow2['gallery_id'])?>&page=<?php echo  base64_encode('G')?>" width="100" height="50" alt="image" />
			</td>
          
			
			
			 <td>
		   <select type="text" class="form-control" name="display_val[]" id="display_val"   placeholder="Display"  >
		   <option value="">Choose</option>
		   <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow2['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
			<option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow2['display']=='N'){ echo "SELECTED"; }}?>>No</option>
		   </select>
		   
			</td>
         </tr>
						
					</tr>
                    <tr id='addr<?php echo $i+1;?>'></tr>
<?php
$i++;
		}
		}
		else
		{
?>			
   
        <tr id='addr0'>
		     <td>
			1
				<input type="hidden" name="ga_edit_id[]" id='ga_edit_id' value="" />
				<input type="hidden" value="I" id="mod_ins" name="mod_ins[]"/>
		    </td>
		     <td>
		     <input type="text" class="form-control" name="name[]" id="name"  value="" placeholder="Enter Name"  />
		   
			</td>
            <td>
		   <input type="file" class="form-control" name="photo_img[]" id="photo_img"  value="" placeholder="Enter " onchange="return ValidateFileUpload1()" />
			</td>
          
			
			
			 <td>
		   <select type="text" class="form-control" name="display_val[]" id="display_val"  value="" placeholder="Display"  >
		   <option value="">Choose</option>
		   <option value="Y">Yes</option>
		   <option value="N">No</option>
		   </select>
		   
			</td>
         </tr>
						
					</tr>
                    <tr id='addr1'></tr>
					 <?php
		}
		?>
				</tbody>
			    </table>
				  <a id="add_row" class="btn btn-success pull-left" style="color:white">Add Row</a><a id='delete_row' class="btn btn-danger pull-right" style="float:right;color:white">Delete Row</a></br></br></br></br>

  
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
   
   else if(theform.mod_ins.length>0){
   for(var x=0;x<theform.mod_ins.length;x++)
   {
   if(theform.name[x].value!="")
   {
	  if(theform.display_val[x].value=="")
	   {
		   swal("Select display value in row no:"+(x+1), "", "error");
		   theform.display_val[x].focus();
			return false;
	   }
	   else
	   {
		   if(theform.mod_ins[x].value=='I')
		   {
			   if(theform.photo_img[x].value=="")
	   {
		   swal("select a photo to upload in row no:"+(x+1), "", "error");
		   theform.photo_img[x].focus();
			return false;
	   }
		   }
	   }
   }  
   else{
	   if(theform.display_val[x].value!="")
	   {
		    swal("Enter photo title in row no:"+(x+1), "", "error");
			theform.name[x].focus();
			return false;
	   }
	   if(theform.mod_ins[x].value=='I')
		   {
			   if(theform.photo_img[x].value!="")
	   {
		    swal("Enter photo title in row no:"+(x+1), "", "error");
			theform.name[x].focus();
			return false;
	   }
		   }
  
   }
   }
   }
   else if(theform.mod_ins.value!="")
   {
		   
	if(theform.name.value!="")
   {
	   if(theform.display_val[x].value=="")
	   {
		   swal("Select display value in row no:"+(x+1), "", "error");
		   theform.display_val[x].focus();
			return false;
	   }
	   
	   else
	   {
		   if(theform.mod_ins.value=='I')
		   {
			   if(theform.photo_img.value=="")
	   {
		   swal("select a photo to upload in row no:1", "", "error");
		   theform.doc.focus();
			return false;
	   }
		   }
	   }
   }  
   else{
	   if(theform.display_val.value!="")
	   {
		    swal("Enter photo title in row no: 1", "", "error");
			theform.doc_type.focus();
			return false;
	   }
	   if(theform.mod_ins.value=='I')
		   {
			   if(theform.photo_img.value!="")
	   {
		    swal("Enter photo title in row no: 1", "", "error");
			theform.doc_type.focus();
			return false;
	   }
		   }
  
   }
		   
		   
		
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
	function ValidateFileUpload1() {
        var fuData = document.getElementById('photo_img');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#photo_img').val('');
         $('#photo_img').focus();

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
	 $('#photo_img').val('');
         $('#photo_img').focus();
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

			
			 var i=<?php if($i!=0){echo $i;}else{ echo '1'; } ?>;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) + " <input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/></td> </td><td><input type='hidden' name='ga_edit_id[]' id='ga_edit_id"+ (i+1) +"' value='' /><input type='text' name='name[]' id='name' type='text' placeholder='Enter Name' class='form-control'/></td><td><input name='photo_img[]' id='photo_img' type='file' placeholder='Intercom Number' class='form-control Number' /></td><td><select name='display_val[]' id='display_val' type='text' placeholder='Display' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='No'>No</option></select></td>");

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
			</script>