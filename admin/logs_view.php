<?php 
include 'include/header.php';
ini_set('memory_limit', '-1'); // unlimited memory limit
ini_set('max_execution_time', 3000);



	
	
	 	try
{
	
$logs_details= $log_fun->log_data();
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
                    <h1>Logs</h1>
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
                                <h4 class="card-title mb-3">Logs Details</h4>
                                
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>User</th>
                                                <th>IP</th>
                                                <th>Page</th>
												<th>Record Id</th>
                                                <th>Message</th>
												<th>Action Query</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $logs_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											   <th>Sl.No</th>
												<th>User</th>
												<th>IP</th>
                                                <th>Page</th>
												<th>Record Id</th>
                                                <th>Message</th>
												<th>Action Query</th>
                                                <th>Date</th>
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
			

