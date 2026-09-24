<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/doc_type_fun.php';
$doc_type_fun =new DOCTYPEFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();



extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
try
		{
 //Other Period
		// $name_arr = trim(implode(',',array_unique($_POST['name'])));
			//$name_arr=$_POST['name'];
			

foreach ($_POST['name'] as $each_number) {
      $name_arr[] = (int) $each_number;
  }


			 $doc_name_arr=$_POST['doc_name'];
			 $doc_value_arr=$_POST['doc_value'];
			 $display=$_POST['display'];
			 $show_page=$_POST['show_page'];
		 if($doc_name_arr!='')
	{

//for ($i = 0; $i < count($name_arr); $i++) 
//{

	  $name=implode(',',$name_arr);
  $doc_name=strtoupper($doc_name_arr);
  $doc_value=strtoupper($doc_value_arr);
  $display1=$display;


 
		
					  if(empty($name))
   {
      $error = "Enter your Section Name  !";
   }
 else if(empty($doc_name))
   {
      
      $error = "Enter your Document Name!";
   }
 else if(empty($doc_value))
   {
      
      $error = "Enter your Document Type!";
   }
 else if(empty($display1))
   {
      
      $error = "Enter your Display!";
   }
 else if(!empty($display1) && $validator->chkbadchar($display1) == false)
 {
  $error = "Please enter valid Display ";
 } else if(empty($show_page))
   {
      
      $error = "Select Show Page Value!";
   }

 else
 {
$mhc_user=$_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM mhc_document_type WHERE show_page='".$show_page."' and ( doc_name=:doc_name or doc_value=:doc_value)");
					$stmt->execute(array(':doc_name'=>$doc_name,':doc_value'=>$doc_value));
				//	$stmt->execute(array(':doc_value'=>$doc_value));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						
					   $error= "Document Name or Document Value Already Exists";
						
					//$doc_type_fun->redirect("doc_type_management.php?error&CheckString=".$chkstr); 	
						
					}
					else
					{
if($doc_type_fun->doc_type_register($name,$doc_name,$doc_value,$display1,$show_page,$mhc_user,$page_id,$ip,$log_fun)) 
            {
				$doc_type_fun->redirect("doc_type_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			}
  
			 }
			  
			}
		 
		 
		 
						 
		//}
		//$doc_type_fun->redirect("doc_type_management.php?joined&CheckString=".$chkstr); 
 
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
		


		if($doc_type_fun->doc_type_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          $doc_type_fun->redirect("doc_type_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_doc_type_details= $doc_type_fun->doc_type_data($chkstr,$page_id);
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
                                <div class="card-title">Document - Section Mapping Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Record Added Successfully</strong>
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
                                        <div class="col-md-12 form-group mb-12">		
            
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
        <td rowspan="1">Document Name</td>
		<td rowspan="1">Document Value</td>
        <td rowspan="1">Section Name </td>
		<td rowspan="1">Show Page</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		     
		   
            <td>
		   <input type="text" class="form-control" name="doc_name" id="doc_name"  value="" placeholder="Enter Document name"  />
			</td>
            <td>
		    <input type="text" class="form-control" name="doc_value" id="doc_value"  value="" placeholder="Enter Document value"  />
			
			</td>
			  <td>
		     <select type="text" class="form-control form-control multiselect-ui" name="name[]" id="name"  value="" placeholder="Enter Name" multiple />
		   <!--	   <option value="">Choose</option>-->
			    <?php
$select_qry = $DB_con->query("SELECT * FROM departments  order by depart");
while($row = $select_qry->fetch())
{
//echo "<option value=".$row['sno'].">".$row['depart']." </option>";
//echo "<optgroup label='".$row['depart']."'>";
echo "<option value='".$row['sno']."'>".$row['depart']."</option>";
//echo "</optgroup>";
}

?>
</select>
			</td>
			<td> <select type="text" class="form-control" name="show_page" id="show_page"  value="" placeholder="Show Page"  >
		   <option value="">Choose</option>
		   <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='show_page'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
		   </select></td>
			 <td>
		   <select type="text" class="form-control" name="display" id="display"  value="" placeholder="Display"  >
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
				<!--  <a id="add_row" class="btn btn-success pull-left" style="color:white">Add Row</a><a id='delete_row' class="btn btn-danger pull-right" style="float:right;color:white">Delete Row</a></br>-->
				</br></br></br>

  
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
                                <h4 class="card-title mb-3">Document - Section Details</h4>
                                
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Document Name</th>
                                                <th>Document Value</th>
												<th>Sections Name </th>
												<th>Show Page</th>
                                                <th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_doc_type_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>Sl.No</th>
                                                <th>Document Name</th>
                                                <th>Document Value</th>
												<th>Sections Name </th>
												<th>Show Page</th>
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
     swal("Enter a Valid  Section.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#name').val('');
         theform.name.focus();
    return false;
   }
    else if(!theform.doc_name.value )
   {
     swal("Enter a Valid  Document Name.", "", "error");
    //alert("Enter a Valid  Document Name.");
		$('#doc_name').val('');
         theform.doc_name.focus();
    return false;
   }
   else if(chkbadchar(theform.doc_value.value)==false )
   {
     swal("Enter a Valid  Document Value", "", "error");
    //alert("Enter a Valid  Document Value.");
		$('#doc_value').val('');
         theform.doc_value.focus();
    return false;
   }
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
		$('#display').val('');
         theform.display.focus();
    return false;
   }
   else if(chkbadchar(theform.show_page.value)==false )
   {
     swal("Enter a Valid  Show Page.", "", "error");
    
		$('#show_page').val('');
         theform.show_page.focus();
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


					
					
	  $.get('doc_type_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
					 $(function() {
			 
    $('.multiselect-ui').multiselect({
		
       	enableClickableOptGroups: true,
 		includeSelectAllOption: true,
            maxHeight: 350,
			 maxwidth: 500,
            dropUp: false
    });
	
});
			</script>