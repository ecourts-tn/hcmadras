<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/menu_fun.php';


$menu_fun =new MENUFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
		
try
		{
				$page_name=htmlspecialchars(filter_input(INPUT_POST, 'page_name', FILTER_SANITIZE_STRING));
					$page_url=htmlspecialchars(filter_input(INPUT_POST, 'page_url', FILTER_SANITIZE_STRING));
					$main_order=htmlspecialchars(filter_input(INPUT_POST, 'main_order', FILTER_SANITIZE_STRING));
					$category=htmlspecialchars(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING));
					$sub_category=htmlspecialchars(filter_input(INPUT_POST, 'sub_category', FILTER_SANITIZE_STRING));
					$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
					$menu_user=htmlspecialchars(filter_input(INPUT_POST, 'menu_user', FILTER_SANITIZE_STRING));
					
					
					  if(empty($page_name))
   {
      
      $error = "Enter your Page Name !";
   }
 else if(!empty($page_name) && $validator->chkbadchar($page_name) == false)
 {
  $error= "Please enter valid Page Name";
 }
				 else if(empty($page_url))
   {
      
      $error = "Enter your Page URL !";
   }


 else if($validator->chkbadchar($main_order) == false)
 {
  $error= "Please enter valid Main Menu Order ";
 }
 else if($validator->test_datatype($main_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Main Menu Order ";
 }
 else if($validator->chkbadchar($sub_order) == false)
 {
  $error= "Please enter valid Sub Menu Order ";
 }
 else if($validator->test_datatype($sub_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Sub Menu Order ";
 }
  else if($validator->chkbadchar($sub_sub_order) == false)
 {
  $error= "Please enter valid Sub-Sub Menu Order ";
 }
 else if($validator->test_datatype($sub_sub_order,"[^0-9]") == false)
 {
  $error= "Please enter valid  Numeric  Sub-Sub Menu Order ";
 }

 else if($validator->chkbadchar($category) == false)
 {
  $error = "Please enter valid Category ";
 }
  else if($validator->chkbadchar($sub_category) == false)
 {
  $error = "Please enter valid sub_category ";
 }
  else if(empty($display))
   {
      
      $error = "Enter your Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please enter valid Display ";
 }
  else if(empty($menu_user))
   {
      
      $error = "Select valid menu user !";
   }
 
 else
 {
			
			
						if($category!='')
						{
							$menu_parent_id=$category;
						}
						else
						{
							$menu_parent_id=0;
						}
						if($sub_category!='')
						{
							$sub_parent_menu_id=$sub_category;
						}
						else
						{
							$sub_parent_menu_id=NULL;
						}
						if($main_order!='')
						{
							$main_menu_order=$main_order;
						}
						else
						{
							$main_menu_order=0;
						}
						if($sub_order!='')
						{
							$sub_menu_order=$sub_order;
						}
						else
						{
							$sub_menu_order=0;
						}
						if($sub_sub_order!='')
						{
							$sub_sub_menu_order=$sub_sub_order;
						}
						else
						{
							$sub_sub_menu_order=0;
						}
						
if($menu_fun->menu_register($page_name,$page_url,$menu_parent_id,$main_menu_order,$sub_menu_order,$sub_sub_menu_order,$display,$menu,$class_fun,$menu_tab,$set_menu,$mhc_user,$page_id,$ip,$log_fun,$sub_parent_menu_id,$external,$menu_user))
{
				unset($error);
				$menu_fun->redirect("menu_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
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


		if($menu_fun->menu_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
        $menu_fun->redirect("menu_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_menu_details= $menu_fun->userdata($chkstr,$page_id);
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
                                <div class="card-title">New Menu Registration Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Menu Added Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Menu Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Menu Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip01">Page Name</label>
                                            <input class="form-control" id="page_name" name="page_name" type="text" placeholder="Page name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Page Name

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Page Url</label>
                                            <input class="form-control" id="page_url" name="page_url" type="text" placeholder="Page Url"   autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Page Url

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-4">
                                            <label for="validationTooltipUsername">Set Menu</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control" name="set_menu" id="set_menu" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="FM">Front End Menu</option>
											   <option value="BM">Back End Menu</option>
											  
                                            </select>
                                            </div>
                                        </div>
										
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Category</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                               <select class="form-control form-control-rounded" name="category" id="category"  autocomplete="off" >
                                                <option value="0">Choose</option>
                                             <?php
											 $qry_menu = $DB_con->query("select menu_id,page_name from mhc_menu where menu_parent_id='0' order by menu_id asc");
while($row_menu = $qry_menu->fetch())
{
echo "<option value=".$row_menu['menu_id'].">".$row_menu['page_name']." </option>";
}
											 ?>
                                            </select>
                                                <div class="invalid-tooltip">
                                                    Please choose a Category.

                                                </div>
                                            </div>
                                        </div>
										 <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Sub Category</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                               <select class="form-control form-control-rounded" name="sub_category" id="sub_category"  autocomplete="off" >
                                                <option value="">Choose</option>
                                             <?php
											 $qry_menu = $DB_con->query("select menu_id,page_name from mhc_menu where menu_parent_id!='0' AND (
SUB_PARENT_MENU_ID IS NULL or SUB_PARENT_MENU_ID =0) order by menu_id asc");
while($row_menu = $qry_menu->fetch())
{
echo "<option value=".$row_menu['menu_id'].">".$row_menu['page_name']." </option>";
}
											 ?>
                                            </select>
                                                <div class="invalid-tooltip">
                                                    Please choose a sub_category.

                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-2 form-group mb-3">
                                            <label id='mmenu' for="validationTooltip02">Main Menu Order</label>
											 <label id='smmenu' style='display:none' for="validationTooltip02">Main Menu Order</label>
                                            <input class="form-control Number" id="main_order" name="main_order" type="text" placeholder="Enter Main Menu Order" maxlength="2"  required="required"  autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Main Menu Order 

                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Sub Menu Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="sub_order" name="sub_order" type="text" placeholder="Sub Menu Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Sub Menu Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Sub-Sub Menu Order</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control Number" id="sub_sub_order" name="sub_sub_order" type="text" placeholder="Sub_Sub Menu Order" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Sub_Sub Menu Order.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Lift Side Menu Class Fun</label>
                                            <div class="input-group">
                                                
                                                <input class="form-control" id="class_fun" name="class_fun" type="text" placeholder="Class Fun" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please Enter Class Menu Function.

                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Menu</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control" name="menu" id="menu" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
												 <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='menu'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
                                            
											   
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Menu Open New Tab</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="menu_tab" id="menu_tab" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y">Yes</option>
											   <option value="N" SELECTED>No</option>
											  
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Display</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="display" id="display" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y" SELECTED>Yes</option>
											   <option value="N" >No</option>
                                            </select>
                                            </div>
                                        </div>
										
										<div class="col-md-2 form-group mb-3">
                                            <label for="validationTooltipUsername">Internal/External</label>
                                            <div class="input-group">
                                                
                                                 <select class="form-control form-control-rounded" name="external" id="external" required="required" autocomplete="off" >
                                                <option value="">Choose</option>
                                              <option value="Y" >External</option>
											   <option value="N" SELECTED>Internal</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Menu used by</label>
											<select class="form-control form-control-rounded" id="menu_user" required="required" name="menu_user" autocomplete="off" >
                                                 <option value="">Choose</option>
												 <?php
$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='menu_user'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
								echo "<option value='".$m['value']."'>".$m['name']."</option>";}}
?>
                                           
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid menu user.

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
                                <h4 class="card-title mb-3">Menu Management</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
                                                <th>Page Name</th>
												<th>Page Url</th>
                                                <th>Category</th>
                                                <th>Main Menu Order</th>
                                                <th>Sub Menu Order</th>
												<th>Sub-Sub Menu Order</th>
												<th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_menu_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                           <tr>
											    <th>Sl.No</th>
                                                <th>Page Name</th>
												<th>Page Url</th>
                                                <th>Category</th>
                                                <th>Main Menu Order</th>
                                                <th>Sub Menu Order</th>
												<th>Sub-Sub Menu Order</th>
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
	
    
    if(chkbadchar(theform.page_name.value)==false )
   {
     swal("Enter a Valid  Page Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#page_name').val('');
         theform.page_name.focus();
    return false;
   }
  
   if(chkbadchar(theform.main_order.value)==false )
   {
     swal("Enter a Valid  Main Menu Order.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#main_order').val('');
         theform.main_order.focus();
    return false;
   }
   else if(chkbadchar(theform.sub_order.value)==false )
   {
     swal("Enter a Valid  Sub Menu Order.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#sub_order').val('');
         theform.sub_order.focus();
    return false;
   }
   else if(isNumber(theform.sub_order.value)==false )
    {
		swal("Enter a Valid  Sub Menu Order.", "", "error");
		$('#sub_order').val('');
         theform.sub_order.focus();
    return false;
    }
	   else if(chkbadchar(theform.sub_sub_order.value)==false )
   {
     swal("Enter a Valid  Sub-Sub Menu Order.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#sub_sub_order').val('');
         theform.sub_sub_order.focus();
    return false;
   }
   else if(isNumber(theform.sub_sub_order.value)==false )
    {
		swal("Enter a Valid  Sub-Sub Menu Order.", "", "error");
		$('#sub_sub_order').val('');
         theform.sub_sub_order.focus();
    return false;
    }
    else if(chkbadchar(theform.category.value)==false )
   {
     swal("Enter a Valid  Category.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#category').val('');
         theform.category.focus();
    return false;
   }
    else if(chkbadchar(theform.sub_category.value)==false )
   {
     swal("Enter a Valid Sub Category.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#sub_category').val('');
         theform.sub_category.focus();
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
    else if(chkbadchar(theform.menu_user.value)==false )
   {
     swal("Enter a valid menu user", "", "error");
    //alert("Enter a Valid  Department.");
		$('#menu_user').val('');
         theform.menu_user.focus();
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
	
		function removeRow(id) {
			
	  if ( 'undefined' != typeof id ) {
		  
	
	 swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: true
},
function(){


					
					
	  $.get('menu_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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