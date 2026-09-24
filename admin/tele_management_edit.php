<?php 
include 'include/header.php';
include 'function/telephone_fun.php';
$tele_fun =new TELEFUN($DB_con);


include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	
try
		{
			$edit_id=$_POST['edit_id'];
			$os_name=$_POST['name'];
			 $intercom_no=$_POST['inter_com'];
			 $typed=$_POST['type'];
			 $display1=$_POST['display'];
			$bench1=$_POST['bench'];
			 $order_id1=$_POST['order_id'];




 
		
					  if(empty($os_name))
   {
      
      $error = "Enter your OFFICERS Name / SECTIONS Name  !";
   }
 else if(!empty($os_name) && $validator->chkbadchar($os_name) == false)
 {
  $error= "Please enter valid OFFICERS Name / SECTIONS Name ";
 }
/* else if(empty($intercom_no))
   {
      
      $error = "Enter your Intercom Number!";
   }*/
 else if(!empty($intercom_no) && $validator->chkbadchar($intercom_no) == false)
 {
  $error = "Please enter valid Intercom Number";
 }
 else if(empty($typed))
   {
      
      $error = "Enter your Type!";
   }
 else if(!empty($typed) && $validator->chkbadchar($typed) == false)
 {
  $error= "Please enter valid Type";
 }

  else if(empty($display1))
   {
      
      $error = "Enter your Display!";
   }
 else if(!empty($display1) && $validator->chkbadchar($display1) == false)
 {
  $error = "Please enter valid Display ";
 }
  else if(empty($bench1))
   {
      
      $error = "Enter your Bench!";
   }
 else if(!empty($bench1) && $validator->chkbadchar($bench1) == false)
 {
  $error = "Please enter valid Bench ";
 }
   else if(empty($order_id1))
   {
      
      $error = "Enter your Order!";
   }
 else if(!empty($order_id1) && $validator->chkbadchar($order_id1) == false)
 {
  $error = "Please enter valid Order ";
 }
 
 else
 {

$mhc_user=$_SESSION['user_session'];

 if($tele_fun->tele_update($edit_id,$os_name,$intercom_no,$typed,$display1,$mhc_user,$page_id,$ip,$log_fun,$bench1,$order_id1)) 
            {
				
					$tele_fun->redirect("telephone_management.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
    
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_telephone_diary where telephone_id=:id");
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
                                <div class="card-title">Telephone Directory Update Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Telephone Number Successfully Register</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Telephone Number Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Telephone Number Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    
                                   <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['telephone_id']); }?>" >
									
											<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">		
            
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
       <td rowspan="1">Type</td>
        <td rowspan="1">Officers Name/Sections Name </td>
        <td rowspan="1">Intercom No</td>
		<td rowspan="1">Bench</td>
		<td rowspan="1">Order</td>
		<td rowspan="1">Display</td>
		
		
		
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		      <td>
		    <select type="text" class="form-control" name="type" id="type"  value="" placeholder="Type" onchange="getlist(this)"  >
		   <option value="">Choose</option>
		   <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='type' and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
												if(isset($_GET['edit_id'])){ if($editRow['type']==$m['value']){
												echo "<option value='".$m['value']."' selected>".$m['name']."</option>";}
												else{
												echo "<option value='".$m['value']."' >".$m['name']."</option>";}}
								}}?>	
		  
		   </select>
			</td>
		     <td>
		     <select type="text" class="form-control" name="name" id="name"  value="" placeholder="Enter Name"  />
			
		   	   <option value="">Choose</option>
			   <?php 
										if($editRow['type']=='O')
									$sq="SELECT sno,desig as value FROM officer_designation where display='Y' order by sno";
											else if ($editRow['type']=='S')
										$sq="SELECT sno,depart as value FROM departments where display='Y' order by sno";	
									
											$d_qry=$DB_con->prepare($sq);
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
												
												if(isset($_GET['edit_id'])){ if($editRow['name']==$m['sno']){
												echo "<option value='".$m['sno']."' selected>".$m['value']."</option>";}
												else{
												echo "<option value='".$m['sno']."' >".$m['value']."</option>";}}
								}}?>
</select>
		   
			</td>
            <td>
		   <input type="text" class="form-control Number" name="inter_com" id="inter_com"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['intercom_no']); }?>" placeholder="Enter Intercom Number"  />
			</td>
           <td>
		    <select type="text" class="form-control" name="bench" id="bench"  value="" placeholder="Bench" >
		   <option value="">Choose</option>
		   <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='bench' and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
												if(isset($_GET['edit_id'])){ if($editRow['bench']==$m['value']){
												echo "<option value='".$m['value']."' selected>".$m['name']."</option>";}
												else{
												echo "<option value='".$m['value']."' >".$m['name']."</option>";}}
								}}?>	
		  
		   </select>
			</td>
			<td>
		   <input type="text" class="form-control Number" name="order_id" id="order_id"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['order_id']); }?>" placeholder="Enter Order"  />
			</td>
			
			
			 <td>
		   <select type="text" class="form-control" name="display" id="display"  value="" placeholder="Display"  >
		   <option value="">Choose</option>
		   <option value="Y"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='Y'){ echo "SELECTED"; }}?>>Yes</option>
		   <option value="N"<?php  if(isset($_GET['edit_id'])){ if($editRow['display']=='N'){ echo "SELECTED"; }}?>>No</option>
		   </select>
		   
			</td>
				
         </tr>
						
					</tr>
                   
				</tbody>
			    </table>
				
  
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
			
			 $( function() {
    $( ".datepicker" ).datepicker({
		dateFormat:'d-m-yy'
	});
  } );
			function Validator(theform)
{
	
     if(chkbadchar(theform.name.value)==false )
   {
     swal("Enter a Valid  Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#name').val('');
         theform.name.focus();
    return false;
   }
   /* else if(chkbadchar(theform.inter_com.value)==false )
   {
     swal("Enter a Valid  Intecom Number.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#inter_com').val('');
         theform.inter_com.focus();
    return false;
   }*/
   else if(chkbadchar(theform.type.value)==false )
   {
     swal("Enter a Valid  Type", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#type').val('');
         theform.type.focus();
    return false;
   }
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
		$('#display').val('');
         theform.display.focus();
    return false;
   }
     else if(chkbadchar(theform.bench.value)==false )
   {
     swal("Enter a Valid  bench.", "", "error");
    
		$('#bench').val('');
         theform.bench.focus();
    return false;
   }
   else if(chkbadchar(theform.order_id.value)==false )
   {
     swal("Enter a Valid  Order.", "", "error");
    
		$('#order_id').val('');
         theform.order_id.focus();
    return false;
   }
  
    
}

	
$('.Number').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode==44 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
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
  text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){


					
					
	  $.get('telephone_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
				function getlist(ob)
{
	var ob_id=ob.id;
	var id=$('#'+ob_id).val();
	$.post("action.php", {id: btoa(id),action:'getList'}, function(result){
	$("#name").html(result);
	});
}
			</script>