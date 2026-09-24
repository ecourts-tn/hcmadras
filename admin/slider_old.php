<?php 
include 'include/header.php';
include 'function/slid_fun.php';
$slid_fun =new SLIDFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$bench=htmlspecialchars(filter_input(INPUT_POST, 'bench', FILTER_SANITIZE_STRING));
				$up_date=htmlspecialchars(filter_input(INPUT_POST, 'up_date', FILTER_SANITIZE_STRING));	
				echo"haii". $slider_name=htmlspecialchars(filter_input(INPUT_POST, 'slider_name', FILTER_SANITIZE_STRING));
					$slider_ord=htmlspecialchars(filter_input(INPUT_POST, 'slider_ord', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));	
					
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
 
		$image_name=time().'.'.$extension;
		$slid_img="upload/".$image_name;
 
		$copied = copy($_FILES['slider_img']['tmp_name'], $slid_img);
		if (!$copied) 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull!</h3>';
			$mhc_user=$_SESSION['user_session'];	
var_dump($bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user)		;	
if($slid_fun->slider_register($bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user))
{
	$error=' successfull!</h3>';
							//$slid_fun->redirect("slider_management.php?joined&CheckString=".$chkstr); 
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
		
     $del_id= base64_decode($_GET['remove']);
		


		if($slid_fun->slid_Delete($del_id)) 
            {
	    
          $slid_fun->redirect("down_management.php?joined2&CheckString=".$chkstr);
			 
            }
			
	}
	 	try
{
	
$Get_down_details= $slid_fun->downdata($chkstr);
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Images Successfully Register</strong>
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
                                              <option value="MHC">Principal Bench</option>
											   <option value="MDU">Madurai Bench</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Title

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Slider Title</label>
                                            <input class="form-control" id="slider_name" name="slider_name" type="text" placeholder="Slider name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Downloads Title

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Slider Images</label>
											 <div class="custom-file">
                                        <input class="custom-file-input" id="slider_img" name="slider_img" type="file" aria-describedby="inputGroupFileAddon01" required="required">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Slider.

                                            </div>
                                            
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Slider Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="slider_ord" name="slider_ord" type="text" placeholder="Slider Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required="required" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Slider Order.

                                                </div>
                                            </div>
                                        </div>
										
                                        <!--<div class="col-md-8 form-group mb-3">
                                            <label for="validationTooltip02">Uploads Documents</label>
											  <div class="panel-body">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
        <td rowspan="1">Sl.NO</td>
		<td rowspan="1">Slider Name</td>
        <td rowspan="1">Slider Images</td>
        <td rowspan="1">Slider Order</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		     <td>
			1
		    </td>
		     <td>
			 <input type="text" class="form-control" name="slider_name[]" id="slider_name"  value="" placeholder="Slider Name"  />
		   
		    
			</td>
			<td>
		   <input type="file" class="form-control" name="slider_img[]" id="slider_img"  value="" placeholder="Slider Image"  />
		    
			</td>
            <td>
		   <input type="text" class="form-control" name="slider_ord[]" id="slider_ord"  value="" placeholder="Slider Order"  />
			</td>
            <td>
		    <select class="form-control" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y">Yes</option>
											   <option value="N">No</option>
                                            </select>
			</td>
         </tr>
						
					</tr>
                    <tr id='addr1'></tr>
				</tbody>
			    </table>
				  <a id="add_row" class="btn btn-success pull-left" style="color:white">Add Row</a><a id='delete_row' class="btn btn-danger pull-right" style="float:right;color:white">Delete Row</a></br></br></br></br>

  
  </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Documents.

                                            </div>
                                            
                                        </div>-->
										
										
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
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Downloads Title</th>
												<th>Downloads Url</th>
                                                <th>Uploads Date</th>
                                                <th>Downloads Order</th>
                                                <th>Downloads Icon</th>
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
												<th>Downloads Url</th>
                                                <th>Uploads Date</th>
                                                <th>Downloads Order</th>
                                                <th>Downloads Icon</th>
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
				
			

/*  var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='slider_name[]' id='slider_name' type='text' placeholder='Slider Name' class='form-control'/></td><td><input name='slider_img[]' id='slider_img' type='file' placeholder='Slider Image' class='form-control'/></td><td><input name='slider_ord[]' id='slider_ord' type='text' placeholder='Slider Order' class='form-control' /></td><td><select name='to_dt[]' id='to_dt' type='text' placeholder='To Year' class='form-control' ><option value=''>Choose<option><option value='Y'>Yes<option><option value='N'>NO<option></select></td>");

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
	 }); */
	 
	 
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
   else if(chkbadchar(theform.slider_name.value)==false )
   {
     swal("Enter a Valid  Slider Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#slider_name').val('');
         theform.slider_name.focus();
    return false;
   }
 
  
   else if(isNumber(theform.slider_ord.value)==false )
    {
		swal("Enter a Valid  Slider Order.", "", "error");
		$('#slider_ord').val('');
         theform.slider_ord.focus();
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