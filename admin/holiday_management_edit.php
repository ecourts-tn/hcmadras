<?php 
include 'include/header.php';
include 'function/holiday_fun.php';
$holiday_fun =new HOLIDAYFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$holiday_title=htmlspecialchars(filter_input(INPUT_POST, 'holiday_title', FILTER_SANITIZE_STRING));
					$holiday_year=htmlspecialchars(filter_input(INPUT_POST, 'holiday_year', FILTER_SANITIZE_STRING));
					$holiday_f_date=htmlspecialchars(filter_input(INPUT_POST, 'holiday_f_date', FILTER_SANITIZE_STRING));
					$holiday_t_date=htmlspecialchars(filter_input(INPUT_POST, 'holiday_t_date', FILTER_SANITIZE_STRING));
					
					
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
					$mhc_user=$_SESSION['user_session'];
					$cur_date=date('Y-m-d');
					  if($holiday_f_date!= '')
				{
					$holiday_from=date('Y-m-d',strtotime($holiday_f_date));
				}
				else
				{
					$holiday_from =NULL;
				}
				if($holiday_t_date!= '')
				{
					$holiday_to=date('Y-m-d',strtotime($holiday_t_date));
				}
				else
				{
					$holiday_to =NULL;
				}
				
					
					  if(empty($holiday_title))
   {
      
      $error = "Enter your Holiday Name !";
   }

				 else if(empty($holiday_year))
   {
      
      $error = "Enter your Holiday Year !";
   }


 else if($validator->chkbadchar($holiday_year) == false)
 {
  $error= "Please enter valid Holiday Year ";
 }
 else if($validator->test_datatype($holiday_year,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Holiday Year ";
 }
 else if($validator->chkbadchar($holiday_from) == false)
 {
  $error= "Please enter valid Holiday From date ";
 }
  else if($validator->chkbadchar($holiday_to) == false)
 {
  $error= "Please enter valid Holiday To date ";
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
			
			
						
						
if($holiday_fun->holiday_update($edit_id,$holiday_title,$holiday_year,$holiday_from,$holiday_to,$display,$mhc_user,$page_id,$ip,$log_fun))
{
					unset($error);		
			  $holiday_fun->redirect("holiday_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			
			
		 
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_holiday where holiday_id=:id");
 $stmt->execute(array(':id' => $edit));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

 if(is_null($editRow['holiday_from_date']))
 {
	 $holiday_from_date='';
 }
 else
 {
	 $holiday_from_date=date('d-m-Y',strtotime($editRow['holiday_from_date']));
 }
  if(is_null($editRow['holiday_to_date']))
 {
	 $holiday_to_date='';
 }
 else
 {
	 $holiday_to_date=date('d-m-Y',strtotime($editRow['holiday_to_date']));
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
                                <div class="card-title">New Holiday Registration Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Holiday Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Holiday Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Holiday Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
								<input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['holiday_id']); }?>" />
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Holiday Title</label>
                                            <input class="form-control" id="holiday_title" name="holiday_title" type="text" placeholder="Holiday name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['holidayname']); }?>" />
                                            <div class="invalid-tooltip">
                                               Enter Your Holiday Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Holiday Year</label>
                                            <select class="form-control" name="holiday_year" id="holiday_year" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                             <?php
											 $currently_selected =$editRow['year']; 
  // Year to start available options at
  $earliest_year = 1950; 
  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
  $latest_year = date('Y')+1; 


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
									
                                       <div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Holiday From Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="holiday_f_date" name="holiday_f_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($holiday_from_date); }?>"/>
                                                <div class="invalid-tooltip">
                                                    Please choose a Holiday on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltip02">Holiday To Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="holiday_t_date" name="holiday_t_date" type="text" placeholder="Downloads on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" value="<?php  if(isset($_GET['edit_id'])){ print($holiday_to_date); }?>"/>
                                                <div class="invalid-tooltip">
                                                    Please choose a Holiday To Date.

                                                </div>
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
	
    
     if(chkbadchar(theform.holiday_year.value)==false )
   {
     swal("Enter a Valid  Holiday Year.", "", "error");

		$('#holiday_year').val('');
         theform.holiday_year.focus();
    return false;
   }
    else if(chkbadchar(theform.holiday_f_date.value)==false )
   {
     swal("Enter a Valid  Holiday From Date.", "", "error");

		$('#holiday_f_date').val('');
         theform.holiday_f_date.focus();
    return false;
   }
    else if(chkbadchar(theform.holiday_t_date.value)==false )
   {
     swal("Enter a Valid  Holiday To Date.", "", "error");

		$('#holiday_t_date').val('');
         theform.holiday_t_date.focus();
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


	
$('.Number').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
				event.preventDefault();
			}
		});
		function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32 && keyCode != 39)
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


					
					
	  $.get('holiday_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			</script>