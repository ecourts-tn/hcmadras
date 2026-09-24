<?php 
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/imp_link_fun.php';
$imp_fun =new IMPLINKFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);

	if(isset($_POST['submit'])) {
		
	$error1=array();
try
		{
				
					
					
	
	


			

		 
		 
		 //Other Period
		 
			$imp_title=$_POST['imp_title'];
			 $imp_url=$_POST['imp_url'];
			 $display=$_POST['display'];
			 
		 if($imp_title!='')
	{

for ($i = 0; $i < count($imp_title); $i++) 
{

	  $link_title=$imp_title[$i];
  $link_url=$imp_url[$i];
  $link_display=$display[$i];


 
		
					  if(empty($link_title))
   {
      
      $error1[$i] = "Enter your link title !";
   }

 else if(empty($link_url))
   {
      
      $error1[$i] = "Enter your link URL!";
   }



  else if(empty($link_display))
   {
      
      $error1[$i] = "Enter your Display!";
   }
 else if(!empty($link_display) && $validator->chkbadchar($link_display) == false)
 {
  $error1[$i] = "Please enter valid Display ";
 }

 else
 {

$mhc_user=$_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM mhc_importan_link WHERE  importan_link_url=:link_url");
					$stmt->execute(array(':link_url'=>$link_url));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						
					   $error1[$i]= "Link Already Exists";
						
						
						
					}
					else
					{
$error1[$i]='';
 $imp_fun->links_add($link_title,$link_url,$link_display,$mhc_user,$page_id,$ip,$log_fun);
          
			  }
			 // $imp_fun->redirect("important_link.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			}
		 
		 
		 
						 
		}
		 $redirect_flag=0;
		 $error='';
			  for($j=0;$j<count($error1);$j++)
			  {
				  if($error1[$j]!='')
				  {
					  $error.=($j+1).". ".$imp_title[$j].' '.$error1[$j].'<br>';
				  }
				  else{
					  $error.=($j+1).". ".$imp_title[$j].' Link added successfully<br>';
					  $redirect_flag++;
				  }
			  }
			  if($redirect_flag==count($error1))
			  {	 unset($error);
			 $imp_fun->redirect("important_link.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
			
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
		


		if($imp_fun->link_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
	    
          //$imp_fun->redirect("important_link.php?joined2&CheckString=".$chkstr."&page_id=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_link_details= $imp_fun->linkdata($chkstr,$page_id);
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Links Added Successfully</strong>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Links Deleted Successfully </strong>
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
        <td rowspan="1">Sl.NO</td>
        <td rowspan="1">Links Title</td>
        <td rowspan="1">Links Url</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		     <td>
			1 <input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/>
		    </td>
		  
            <td>
		   <input type="text" class="form-control" name="imp_title[]" id="imp_title"  value="" placeholder="Enter Links Title"  />
			</td>
            <td>
		 <input type="text" class="form-control" name="imp_url[]" id="imp_url"  value="" placeholder="Enter Links Url"  />
			</td>
			
			
			 <td>
		   <select type="text" class="form-control" name="display[]" id="display"  value="" placeholder="Display"  >
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
                                <h4 class="card-title mb-3">Link Details</h4>
                                
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>Links Title</th>
                                                <th>Links Url</th>
                                                
                                               <th>Display</th>
												
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_link_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											  <th>Sl.No</th>
												<th>Links Title</th>
                                                <th>Links Url</th>
                                                
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
      $('#addr'+i).html("<td>"+ (i+1) +"<input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/></td><td><input name='imp_title[]' id='imp_title' type='text' placeholder='Links Title' class='form-control' /></td><td><input name='imp_url[]' id='imp_url' type='text' placeholder='Links Url' class='form-control' /></td><td><select name='display[]' id='display' type='text' placeholder='Display' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='No'>No</option></select></td>");

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
	
     if(chkbadchar(theform.imp_title.value)==false )
   {
     swal("Enter a Valid  Link Title.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#imp_title').val('');
         theform.imp_title.focus();
    return false;
   }
  else if(chkbadchar(theform.imp_url.value)==false )
   {
     swal("Enter a Valid  Link URL.", "", "error");
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
    if(theform.mod_ins.length>0){
   for(var x=0;x<theform.mod_ins.length;x++)
   {
   if(theform.imp_title[x].value!="")
   {
	   if(theform.display[x].value=="")
	   {
		   swal("Select a valid display in row no:"+(x+1), "", "error");
		    theform.display[x].focus();
			return false;
	   }
	   
	   else if(theform.imp_url[x].value=="")
	   {
		   swal("Enter valid URL in row no:"+(x+1), "", "error");
		   theform.imp_url[x].focus();
			return false;
	   }
		   
   }  
   else{
	   if(theform.display[x].value!=""||theform.imp_url[x].value!="")
	   {
		    swal("Enter link title in row no:"+(x+1), "", "error");
			theform.imp_title[x].focus();
			return false;
	   }
	   
  
   }
   }
   }
   else if(theform.mod_ins.value!="")
   {
		   
	if(theform.imp_title.value!="")
   {
	   if(theform.display.value=="")
	   {
		   swal("Select a valid display  in row no: 1", "", "error");
		    theform.display.focus();
			return false;
	   }
	   else if(theform.imp_url.value=="")
	   {
		   swal("Enter URL in row no: 1", "", "error");
		   theform.imp_url.focus();
			return false;
	   }
	 
		   }
		     else{
	   if(theform.display.value!=""||theform.imp_url.value!="")
	   {
		    swal("Enter link title in row no: 1", "", "error");
			theform.imp_title.focus();
			return false;
	   }
	   
  
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


					
					
	  $.get('important_link.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
						 swal("Deleted!", "Your Record has been deleted.", "success");
								window.location.reload(); 		   
						  
					
						//$('a[data-id="row-' + id + '"]').parent().parent().remove();
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
    
  
	  
					});
			
					
				} else alert('Unknown row id.');
    
  
				
			}
			</script>