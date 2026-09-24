<?php 

include 'include/header.php';
include 'function/feedback_fun.php';

$changeHeader=false;
$fd='';$td='';
$feedback_fun =new FEEDBACKFUN($DB_con);
	 	try
{
	
$Get_feedback_details= $feedback_fun->feedback_data(null,null);
}
catch(PDOException $e)
     {
        echo $e->getMessage();
     }
include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		$changeHeader=true;
		$fd=$from_dt;
		$td=$to_dt;
try
		{
				$from_dt=htmlspecialchars(filter_input(INPUT_POST, 'from_date', FILTER_SANITIZE_STRING));
					$to_dt=htmlspecialchars(filter_input(INPUT_POST, 'to_date', FILTER_SANITIZE_STRING));
					
					
					
					  if(empty($from_dt))
   {
      
      $error = "Select from date!";
   }
 else if(!empty($from_dt) && $validator->chkbadchar($from_dt) == false)
 {
  $error= "Please select valid from date";
 }
				 else if(empty($to_dt))
   {
      
      $error = "Select to date!";
   }


 else if($validator->chkbadchar($to_dt) == false&&!empty($to_dt) )
 {
  $error= "Please select valid to date";
 }
 
 else
 {
	 $from_dt=implode('-',array_reverse(explode('-',$from_dt)));
	 $to_dt=implode('-',array_reverse(explode('-',$to_dt)));
$Get_feedback_details=$feedback_fun->feedback_data($from_dt,$to_dt);
{
				
						} 
		
 }
						}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}

	

 ?>
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>Feedback Report</h1>
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
                              <!--  <div class="card-title">New Menu Registration Form</div>-->
							
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="validationTooltip01">From Date</label>
                                            <input class="form-control datepicker" id="from_date" name="from_date" type="text" placeholder="Select from date" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Select from date

                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="validationTooltip02">To Date</label>
                                            <input class="form-control datepicker" id="to_date" name="to_date" type="text" placeholder="Select to date" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                            <div class="invalid-tooltip">
                                              Select to date

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
							<?php if($changeHeader){ 
                               echo ' <h4 class="card-title mb-3">Feedback Report </h4>';
							} 
							else{
							   echo ' <h4 class="card-title mb-3">Feedback Report (latest 100 feedbacks)</h4>';
							 }?>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Date</th>
												<th>User mobile no & mail id</th>
                                                <th>Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_feedback_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											    <th>Sl.No</th>
                                                <th>Date</th>
												<th>User mobile no & mail id</th>
                                                <th>Feedback</th>
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
			function Validator(theform)
{
    
    if(chkbadchar(theform.from_date.value)==false||theform.from_date.value=='' )
   {
     swal("Select from date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#from_date').val('');
         theform.from_date.focus();
    return false;
   }
  
  else if(chkbadchar(theform.to_date.value)==false||theform.to_date.value=='' )
   {
     swal("Select to date.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#to_date').val('');
         theform.to_date.focus();
    return false;
   }
    
}


			</script>