<?php 
include 'include/header.php';
include 'function/reg_fun.php';
$reg_fun =new REGFUN($DB_con);


	

	 	try
{
	
$Get_reg_details= $reg_fun->regdata($chkstr);
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
                        <div class="card text-left">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Registrar Details</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="reg_management.php?CheckString=<?php echo $chkstr; ?>" >Back</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="example" style="width:100%">
                                        <thead>
                                            <tr>
											   
											
                                                <th>Name</th>
												<th>Designation</th>
												<th>Place</th>
												
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
											   
										
                                                <th>Name</th>
												<th>Designation</th>
												<th>Place</th>
												
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
				  var table = $('#example').DataTable({
      'ajax': {
         'url': 'ids-arrays.txt'
      },
      'createdRow': function(row, data, dataIndex){
         $(row).attr('id', 'row-' + dataIndex);
      }
   });

   table.rowReordering();
			});		

			
			
			
	

			</script>