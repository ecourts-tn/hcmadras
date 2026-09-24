<?php 
include 'include/header.php';
include 'function/jud_fun.php';
$jud_fun =new JUDFUN($DB_con);

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
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Modify Seniority</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="jud_management.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id')?>=<?php echo $page_id ?>" >Back</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table1" style="width:100%">
                                        <thead>
                                            <tr>
											   
											
                                                <th>Name</th>
												<th>Coram</th>							
												<th>Display</th>
												<th>Seniorty</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
											   
										
                                                <th>Name</th>
												<th>Coram</th>
												<th>Display</th>
												<th>Seniorty</th>
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

$(document).ready(function(){


 load_data();

 function load_data()
 {
	// alert("haiiiiiii");
	 
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{action:'jud_data'},
   dataType:'json',
   success:function(data)
   {
    var html = '';
    for(var count = 0; count < data.length; count++)
    {
     html += '<tr id="'+data[count].j_id+'">';
     html += '<td>'+data[count].j_name+'</td>';
     html += '<td>'+data[count].j_coram+'</td>';
     html += '<td>'+data[count].j_display+'</td>';
     html += '<td>'+data[count].j_sen+'</td>';
     
     html += '</tr>';
    }
    $('tbody').html(html);
	//alert(html);
   }
  })
 }

 $('tbody').sortable({
  placeholder : "ui-state-highlight",
  update : function(event, ui)
  {
   var page_id_array = new Array();
   $('tbody tr').each(function(){
    page_id_array.push($(this).attr('id'));
   });
//alert(page_id_array);
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{page_id_array:page_id_array, action:'jud_update'},
    success:function()
    {
		swal("Your work has been Update Sucessfully!", "", "success")
		//swal("Your work has been Update Sucessfully", "", "sucess");
     load_data();
    }
   })
  }
 });

});
 
	

			</script>