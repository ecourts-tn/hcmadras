<?php 
include 'include/header.php';
include 'function/imp_link_fun.php';
$imp_fun =new IMPLINKFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	
try
		{

		 
		 //Other Period
		 
			$link_title=$_POST['imp_title'];
			$link_url=$_POST['imp_url'];
			$link_display=$_POST['display'];


 
		
					  if(empty($link_title))
   {
      
      $error = "Enter your IMPORTANT LINK TITLE !";
   }
 else if(empty($link_url))
   {
      
      $error = "Enter your IMPORTANT LINK TITLE!";
   }



  else if(empty($link_display))
   {
      
      $error = "Enter your Display!";
   }
 else if(!empty($link_display) && $validator->chkbadchar($link_display) == false)
 {
  $error = "Please enter valid Display ";
 }

 else
 {

$mhc_user=$_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM mhc_importan_link WHERE  importan_link_url=:link_url");
					$stmt->execute(array(':link_url'=>$link_url));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						
					   $error= "Link Already Exists";
					} else{

 if($imp_fun->links_update($edit_id,$link_title,$link_url,$link_display,$mhc_user,$page_id,$ip,$log_fun)) 
            {
				 $imp_fun->redirect("important_link.php?joined1&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
					
    
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
 $stmt = $DB_con->prepare("SELECT  * FROM mhc_importan_link where importan_link_id=:id");
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
                                <div class="card-title">New Important Links </div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Important Links</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Important Links Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Important Links Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    
                                   <input type="hidden" name="edit_id" value="<?php  if(isset($_GET['edit_id'])){ print($editRow['importan_link_id']); }?>" >
									
											<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">		
            
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
      
        <td rowspan="1">Links Title</td>
        <td rowspan="1">Links Url</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		 
		  
            <td>
		   <input type="text" class="form-control" name="imp_title" id="imp_title"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['importan_link_title']); }?>" placeholder="Enter Links Title"  />
			</td>
            <td>
		 <input type="text" class="form-control" name="imp_url" id="imp_url"  value="<?php  if(isset($_GET['edit_id'])){ print($editRow['importan_link_url']); }?>" placeholder="Enter Links Url"  />
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
			
        $(document).ready(function() {
            $('.content').richText();
			
			 var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='imp_title[]' id='imp_title' type='text' placeholder='Links Title' class='form-control' /></td><td><input name='imp_url[]' id='imp_url' type='text' placeholder='Links Url' class='form-control' /></td><td><select name='display[]' id='display' type='text' placeholder='Display' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='No'>No</option></select></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
	  
	  
			
      i++; 
	  

				
					
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

			function Validator(theform)
{
	
     if(!(theform.imp_title.value) )
   {
     swal("Enter a Valid  Link Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#imp_title').val('');
         theform.imp_title.focus();
    return false;
   }
    else if(!(theform.imp_url.value) )
   {
     swal("Enter a Valid  Link Url.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#imp_url').val('');
         theform.imp_url.focus();
    return false;
   }
 
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
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


					
					
	  $.get('importan_link.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			</script>