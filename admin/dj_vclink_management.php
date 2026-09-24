<?php 
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/dj_vclink_fun.php';


$djvc_fun =new DJVCFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();
extract($_POST);
if($_SESSION['roll']=='U'){
			$status='A';
			$court_type='D';
			$get_code_qry=$DB_con->prepare("select dist_id from mhc_users where mhc_user_id=:user and court_type=:court_type and status=:status");
			$get_code_qry->bindParam(':user',$mhc_user);
			$get_code_qry->bindParam(':court_type',$court_type);
			$get_code_qry->bindParam(':status',$status);
			$get_code_qry->execute();
			if($get_code_qry->rowCount()>0)
				while ($get_code=$get_code_qry->fetch())
				{$dist=$get_code['dist_id'];
					//$court=$get_code['court_code'];
				}
			}
			else
			{
				//$court='A';
				$dist='A';
			}
	if(isset($_POST['submit'])) {
		
		
try
		{
					$dist_id=htmlspecialchars(filter_input(INPUT_POST, 'dist_id', FILTER_SANITIZE_STRING));
					$court_code=htmlspecialchars(filter_input(INPUT_POST, 'court_code', FILTER_SANITIZE_STRING));
					$from_date=htmlspecialchars(filter_input(INPUT_POST, 'from_date', FILTER_SANITIZE_STRING));
					$to_date=htmlspecialchars(filter_input(INPUT_POST, 'to_date', FILTER_SANITIZE_STRING));
					$vc_link=htmlspecialchars(filter_input(INPUT_POST, 'vc_link', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					
if(empty($dist_id))
   {
      
      $error = "Select your district !";
   }
 else if(!empty($dist_id) && $validator->chkbadchar($dist_id) == false)
 {
  $error= "Please select valid district";
 }
 if(empty($court_code))
   {
      
      $error = "Select your court !";
   }
 else if(!empty($court_code) && $validator->chkbadchar($court_code) == false)
 {
  $error= "Please select valid court";
 }
else if(empty($from_date))
   {
  $error= "Please enter valid from date ";
 }
 else if(empty($to_date))
   {
  $error= "Please enter valid to date ";
 }

  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(empty($vc_link))
 {
  $error = "Please enter VC link";
 }
 /* else if(!empty($vc_link) && $validator->chkbadchar($vc_link) == false)
 {
  $error= "Please select valid court";
 }*/
 else
 {
	
if($from_date)
$from_date=date('Y-m-d',strtotime($from_date));
if($to_date)
$to_date=date('Y-m-d',strtotime($to_date));

	$mhc_user=$_SESSION['user_session'];		
if($djvc_fun->vc_register($dist_id,$court_code,$from_date,$to_date,$vc_link,$display,$mhc_user,$page_id,$ip,$log_fun))
{
	//unset($error);
							$djvc_fun->redirect("dj_vclink_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
						} 
					/*	}
	}
}
	}*/

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
		


		if($djvc_fun->vc_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $djvc_fun->redirect("dj_vclink_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_down_details= $djvc_fun->vcdata($chkstr,$page_id,$dist);
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
                                <div class="card-title">District Judiciary VC Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize"> Record Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Record Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Record Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">District</label>
                                             <select class="form-control form-control-rounded" id="dist_id" name="dist_id" aria-describedby="inputGroupFileAddon01" onchange="return getCourtName()" required>
										<option value="">Choose</option>
										<?php
										$dist_qry="SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y'";
										if($_SESSION['roll']=='U')
											$dist_qry.= "and dist_code='".$dist."'";
										$dist_qry.=" ORDER BY dist_name "; 
										$dist_data = $DB_con->prepare($dist_qry);
					$dist_data->execute();
					if($dist_data->rowCount() > 0){
						while($dist1=$dist_data->fetch()){
							echo '<option value="'.$dist1['dist_code'].'">'.$dist1['dist_name'].'</option>';
						}
						
					}			
										?>
										
										</select>
										<div class="invalid-tooltip">
                                               Please select your district

                                            </div>
                                        </div>
										 <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Court Name</label>
											 <div class="custom-file">
                                        <select class="form-control form-control-rounded" id="court_code" name="court_code" aria-describedby="inputGroupFileAddon01" required >
										<option value="">Choose</option>
										<?php
										
										?>
										</select>
                                        <div class="invalid-tooltip">
                                                Please select your court.

                                            </div>
                                    </div>
                                           
                                            
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">From Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="from_date" name="from_date" type="text" placeholder="From date" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required />
                                                <div class="invalid-tooltip">
                                                    Please choose from date.

                                                </div>
                                            </div>
                                        </div>
									
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">To Date</label>
                                         <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="to_date" name="to_date" type="text" placeholder="To date" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required />
                                                <div class="invalid-tooltip">
                                                    Please choose to date.

                                                </div>
                                            </div>
                                        </div>
                                       
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">VC link</label>
                                            <div class="input-group">
                                             
                                                <input class="form-control " id="vc_link" name="vc_link" value="" type="text" placeholder="Enter VC Link" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" required />
                                                <div class="invalid-tooltip">
                                                    Please Enter VC Link.

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
											<div class="invalid-tooltip">
                                                    Please select display.

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
                                <h4 class="card-title mb-3">VC Links</h4>
                                <p style="float:right"style="float:right"><a class="btn btn-primary text-white " href="dj_vc_download_template.php?dist_id=<?php echo base64_encode($dist); ?>&CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id'); ?>=<?php echo $page_id ?>">Download Template</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered responsive" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sno</th>
                                                <th>District</th>
                                                <th>Court Name</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
												<th>VC Link</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_down_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											    <th>Sno</th>
                                                <th>District</th>
                                                <th>Court Name</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
												<th>VC Link</th>
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
			
			<script>
			function Validator(theform)
{
	
    
    if(chkbadchar(theform.dist_id.value)==false )
   {
     swal("Please select district.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#dist_id').val('');
         theform.dist_id.focus();
    return false;
   }
  
   if(chkbadchar(theform.court_code.value)==false )
   {
     swal("Please select your court.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#court_code').val('');
         theform.court_code.focus();
    return false;
   }
  
   else if(chkbadchar(theform.from_date.value)==false )
    {
		swal("Enter a valid  from date.", "", "error");
		$('#from_date').val('');
         theform.from_date.focus();
    return false;
    }
	 else if(chkbadchar(theform.to_date.value)==false )
    {
		swal("Enter a valid  to date.", "", "error");
		$('#to_date').val('');
         theform.to_date.focus();
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
    else if(!(theform.vc_link.value))
   {
     swal("Enter a VC link.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#vc_link').val('');
         theform.vc_link.focus();
    return false;
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


					
					
	  $.get('dj_vclink_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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
	function getCourtName()
	{
		var dist=$("#dist_id").val();
		var court_code='';
		var option="";
		$.ajax({
			method:"POST",
			url:"get_data.php",
			data:{action:'getCourtName1',dist_id:dist,court_code:court_code},
			success:function(data){
				
				console.log(data);
				$('#court_code').html(data);
			}
			
		});
			
	}
		
			</script>