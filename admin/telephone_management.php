<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/telephone_fun.php';

$tele_fun =new TELEFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	
try
		{
				
				$name=$_POST['name'];
			 $inter_com=$_POST['inter_com'];
			 $type=$_POST['type'];
			 $display=$_POST['display'];
			 $bench=$_POST['bench'];
			 $order_id=$_POST['order_id'];
			 	$error1=array();
		 if($name!='')
	{

for ($i = 0; $i < count($name); $i++) 
{

	  $os_name=$name[$i];
  $intercom_no=$inter_com[$i];
  $typed=$type[$i];
  $display1=$display[$i];
  $bench1=$bench[$i];
  $order_id1=$order_id[$i];


 
		
					  if(empty($os_name))
   {
      
       $error1[$i] = "Enter your OFFICERS Name / SECTIONS Name  !";
   }
 else if(!empty($os_name) && $validator->chkbadchar($os_name) == false)
 {
    $error1[$i]= "Please enter valid Officers Name / Sections Name ";
 }
/* else if(empty($intercom_no))
   {
      
      $error = "Enter your Intercom Number!";
   }*/
 else if(!empty($intercom_no) && $validator->chkbadchar($intercom_no) == false)
 {
  $error1[$i] = "Please enter valid Intercom Number";
 }
 else if(empty($typed))
   {
      
      $error1[$i] = "Enter your Type!";
   }
 else if(!empty($typed) && $validator->chkbadchar($typed) == false)
 {
    $error1[$i]= "Please enter valid Type";
 }

  else if(empty($display1))
   {
      
        $error1[$i] = "Enter your Display!";
   }
 else if(!empty($display1) && $validator->chkbadchar($display1) == false)
 {
    $error1[$i] = "Please enter valid Display ";
 }
     else if(empty($bench1))
   {
      
       $error1[$i]= "Enter your Bench!";
   }
 else if(!empty($bench1) && $validator->chkbadchar($bench1) == false)
 {
    $error1[$i]= "Please enter valid Bench ";
 }
   else if(empty($order_id1))
   {
      
       $error1[$i]= "Enter your Order!";
   }
 else if(!empty($order_id1) && $validator->chkbadchar($order_id1) == false)
 {
    $error1[$i] = "Please enter valid Order ";
 }

 else
 {

$mhc_user=$_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM mhc_telephone_diary WHERE  intercom_no=:intercom_no");
					$stmt->execute(array(':intercom_no'=>$intercom_no));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						
					    $error1[$i]= "Telephone Number Already Exists";
						
						
						
					}
					else
					{
						$error1[$i]='';
$tele_fun->tele_register($os_name,$intercom_no,$typed,$display1,$mhc_user,$page_id,$ip,$log_fun,$bench1,$order_id1);
            /*{
				$tele_fun->redirect("telephone_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			}*/
					
			  }
			  
			}
		 
		 
		 
						 
		}
		$redirect_flag=0;
		 $error='';
			  for($j=0;$j<count($error1);$j++)
			  {
				  if($error1[$j]!='')
				  {
					  $error.=($j+1).". ".$inter_com[$j].' - '.$error1[$j].'<br>';
				  }
				  else{
					  $error.=($j+1).". ".$inter_com[$j].' - Record added successfully<br>';
					  $redirect_flag++;
				  }
			  }
			  if($redirect_flag==count($error1))
			  {	 unset($error);
					$tele_fun->redirect("telephone_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			
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
		


		if($tele_fun->tele_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $tele_fun->redirect("telephone_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_tele_details= $tele_fun->teledata($chkstr,$page_id);
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
                                <div class="card-title">New Telephone Directory Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Telephone Number Added Successfully</strong>
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
                                    
                                  
									
											<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">		
            
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
        <td rowspan="1">Sl</td>
		<td rowspan="1">Type</td>
        <td rowspan="1">Officers /Sections Name </td>
        <td rowspan="1">Intercom No</td>
		<td rowspan="1">Bench</td>
		<td rowspan="1">Order</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		     <td>
			1 <input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/>
		    </td>
			<td>
		    <select type="text" class="form-control" name="type[]" id="type-1"  value="" placeholder="Type" onchange="getlist(this)" >
		   <option value="">Choose</option>
		   <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='type'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>

		 
		   </select>
			</td>
		     <td>
		     <select type="text" class="form-control" name="name[]" id="name-1"  value="" placeholder="Enter Name"  />
		   	 
</select>
			</td>
            <td>
		   <input type="text" class="form-control Number" name="inter_com[]" id="inter_com-1"  value="" placeholder="Enter Intercom Number"  />
			</td>
           <td>
		    <select type="text" class="form-control" name="bench[]" id="bench-1"  value="" placeholder="Bench" >
		   <option value="">Choose</option>
		   <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='bench'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>

		 
		   </select>
			</td>
			 <td>
			 <input type="text" class="form-control Number" name="order_id[]" id="order_id-1"  value="" placeholder="Enter Order"  />
		     
		   	 

			</td>
			
			
			 <td>
		   <select type="text" class="form-control" name="display[]" id="display-1"  value="" placeholder="Display"  >
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
                                <h4 class="card-title mb-3">Telephone Details</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="tele_management_order.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id'); ?>=<?php echo $page_id ?>">Ordering</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>Officers Name/Sections Name </th>
                                                <th>Intercom No</th>
                                                <th>Type</th>
												<th>Bench</th>
                                               <th>Display</th>
												
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_tele_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											    <th>Sl</th>
												<th>Officers Name/Sections Name </th>
                                                <th>Intercom No</th>
                                                <th>Type</th>
												<th>Bench</th>
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
			
        $(document).ready(function() {
            $('.content').richText();
			
			 var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"<input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/></td><td><select name='type[]' id='type-'"+(i+1)+" type='text' placeholder='Type' class='form-control' onchange='getlist(this)'><option value=''>Choose</option> <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='type'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?></select></td><td><select type='text' name='name[]' id='name-'"+(i+1)+" type='text' placeholder='Enter Name' class='form-control'><option value=''>Choose</option></select></td><td><input name='inter_com[]' id='inter_com-'"+(i+1)+" type='text' placeholder='Intercom Number' class='form-control Number' /></td><td><select name='bench[]' id='bench-'"+(i+1)+" type='text' placeholder='Bench' class='form-control' '><option value=''>Choose</option> <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='bench'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?></select></td><td><input name='order_id[]' id='order_id-'"+(i+1)+" type='text' placeholder='Order' class='form-control Number' /></td><td><select name='display[]' id='display-'"+(i+1)+" type='text' placeholder='Display' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='N'>No</option></select></td>");

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
  /*  else if(chkbadchar(theform.inter_com.value)==false )
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
   else if(theform.mod_ins.length>0){
   for(var x=0;x<theform.mod_ins.length;x++)
   {
   if(theform.name[x].value!="")
   {
	   if(theform.display[x].value=="")
	   {
		   swal("Select a valid display in row no:"+(x+1), "", "error");
		    theform.display[x].focus();
			return false;
	   }
	   
	   else if(theform.type[x].value=="")
	   {
		   swal("Select valid type in row no:"+(x+1), "", "error");
		   theform.type[x].focus();
			return false;
	   }
	   else if(theform.bench[x].value=="")
	   {
		   swal("Select valid bench in row no:"+(x+1), "", "error");
		   theform.bench[x].focus();
			return false;
	   }
	   else if(theform.order_id[x].value=="")
	   {
		   swal("Enter valid order in row no:"+(x+1), "", "error");
		   theform.order_id[x].focus();
			return false;
	   }
		   
   }  
   else{
	   if(theform.display[x].value!=""||theform.type[x].value!=""||theform.bench[x].value!=""||theform.order_id[x].value!="")
	   {
		    swal("Select name in row no:"+(x+1), "", "error");
			theform.name[x].focus();
			return false;
	   }
	   
  
   }
   }
   }
   else if(theform.mod_ins.value!="")
   {
		   
	if(theform.name.value!="")
   {
	   if(theform.display.value=="")
	   {
		   swal("Select a valid display  in row no: 1", "", "error");
		    theform.display.focus();
			return false;
	   }
	   else if(theform.type.value=="")
	   {
		   swal("Select type in row no: 1", "", "error");
		   theform.type.focus();
			return false;
	   }
	    else if(theform.bench.value=="")
	   {
		   swal("Select bench in row no: 1", "", "error");
		   theform.bench.focus();
			return false;
	   }
	    else if(theform.order_id.value=="")
	   {
		   swal("Enter order in row no: 1", "", "error");
		   theform.order_id.focus();
			return false;
	   }
	 
		   }
		     else{
	   if(theform.display.value!=""||theform.type[x].value!=""||theform.bench[x].value!=""||theform.order_id[x].value!="")
	   {
		    swal("Select name in row no: 1", "", "error");
			theform.name.focus();
			return false;
	   }
	   
  
   }
	   
   }
  
    
}

	
$('.Number').keypress(function (event) {
				var keycode = event.which;
			if (!(event.shiftKey == false && (keycode == 46 || keycode==44  || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
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
	var sp_val=ob_id.split('-');
	var id=$('#'+ob_id).val();
	$.post("action.php", {id: btoa(id),action:'getList'}, function(result){
	$("#name-"+sp_val[1]).html(result);
	});
}
			</script>