<?php
include 'include/header.php';
include 'default_pasword_check.php';
include 'function/get_fun.php';
$get_data =new GETDATA($DB_con);	
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL);

if($_SESSION['roll']=='A')
{/*
$user_count = $get_data->getusercount();
$user_logs = $get_data->getuserlogs();
$user_hits = $get_data->getuserhits();
$jud_count = $get_data->getjudcount();
$user_hits_pd= $get_data->getuserhits_perDay();
$causeList_hits_pd= $get_data->getCauseListhits_perDay();
$judgment_hits_pd= $get_data->getJudgmentshits_perDay();
$causeStatus_hits_pd= $get_data->getCaseStatushits_perDay();*/
$page_hits=$get_data->getPageHits_perDay();

}
?>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1 class="mr-2">Dashboard</h1>
                   <!-- <ul>
                        <li><a href="">Dashboard</a></li>
                        <li>Version 1</li>
                    </ul>-->
                </div>
                <div class="separator-breadcrumb border-top"></div>
				<?php
					if($_SESSION['roll']=='A')
					{
						?>
                <div class="row">
                    <!-- ICON BG-->
					
                  <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Add-User"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Users</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"><?php echo $get_data->getusercount();?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Financial"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Logs</p>
                                   <a href='logs_view.php?CheckString=<?php echo $chkstr; ?>'> <p class="text-primary text-24 line-height-1 mb-2"><?php echo $get_data->getuserlogs();?></p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Money-2"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Judges</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"><?php echo $get_data->getjudcount();?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Overall Hits</p>
                                    <p class="text-primary text-24 line-height-1 mb-2" id='overall_hits'></p>
									<input id='but_hit' type='button' onclick='get_overall_hits()' value='Get Data' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<h4 class="mr-2">Hits per day</h4>
                   <!-- <ul>
                        <li><a href="">Dashboard</a></li>
                        <li>Version 1</li>
                    </ul>-->
					    <div class="separator-breadcrumb border-top"></div>
				   <div class="row">
                    <!-- ICON BG-->
					
                  <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Search-on-Cloud"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">MHC Website</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"><?php echo  $get_data->getuserhits_perDay();?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Folder-Search"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Case Status Page </p>
                                   <a href='logs_view.php?CheckString=<?php echo $chkstr; ?>'> <p class="text-primary text-24 line-height-1 mb-2"><?php echo $page_hits['https://hcmadras.tn.gov.in/case_status_mas.php']+$page_hits['https://hcmadras.tn.gov.in/case_status_mdu.php'];?></p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Data-Search"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Judgments Page</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"><?php echo $page_hits['https://hcmadras.tn.gov.in/cause_judment_mas.php']+$page_hits['https://hcmadras.tn.gov.in/cause_judment_mdu.php'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-File-Search"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Cause List Page</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"><?php  echo $page_hits['https://hcmadras.tn.gov.in/cause_list_mhc.php']+$page_hits['https://hcmadras.tn.gov.in/cause_list_mdu.php'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            
				<?php
					}
					else if($_SESSION['roll']=='R')
					{
						if($_SESSION['profile_status']=='N')
						{
							 
							 $url="rti_user_profile.php?CheckString=".$chkstr."&".md5('page_id')."=".$page_id;
							 $delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
						}
						else
						{
					?>
               <div class="row">
                   <div class="col-lg-6 col-md-12">
                        <!-- CARD ICON-->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon mb-4">
                                    <div class="card-body text-center"><i class="i-Data-Upload"></i>
                                        <p class="text-muted mt-2 mb-2">Today&apos;s Upload</p>
                                        <p class="text-primary text-24 line-height-1 m-0">21</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon mb-4">
                                    <div class="card-body text-center"><i class="i-Add-User"></i>
                                        <p class="text-muted mt-2 mb-2">New Users</p>
                                        <p class="text-primary text-24 line-height-1 m-0">21</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon mb-4">
                                    <div class="card-body text-center"><i class="i-Money-2"></i>
                                        <p class="text-muted mt-2 mb-2">Total sales</p>
                                        <p class="text-primary text-24 line-height-1 m-0">4021</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon-big mb-4">
                                    <div class="card-body text-center"><i class="i-Money-2"></i>
                                        <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon-big mb-4">
                                    <div class="card-body text-center"><i class="i-Gear"></i>
                                        <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="card card-icon-big mb-4">
                                    <div class="card-body text-center"><i class="i-Bell"></i>
                                        <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="card o-hidden mb-4">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="w-50 float-left card-title m-0">Appication Status</h3>
                                <div class="dropdown dropleft text-right w-50 float-right">
                                    <button class="btn bg-gray-100" id="dropdownMenuButton_table2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="nav-icon i-Gear-2"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_table2"><a class="dropdown-item" href="#">Add new user</a><a class="dropdown-item" href="#">View All users</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable-collapse text-center" id="sales_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Watch</td>
                                                <td>12-10-2019</td>
                                                <td>$30</td>
                                                <td><span class="badge badge-success">Delivered</span></td>
                                                <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Iphone</td>
                                                <td>23-10-2019</td>
                                                <td>$300</td>
                                                <td><span class="badge badge-info">Pending</span></td>
                                                <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Watch</td>
                                                <td>12-10-2019</td>
                                                <td>$30</td>
                                                <td><span class="badge badge-warning">Not Delivered</span></td>
                                                <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php
						}
			   }
			   ?>
                  
                      
                            
                 
                
            </div>
			<script>
			function get_overall_hits(){
	var year_max = $.post( "action.php", { action:"get_overall_hits"});
	$("#overall_hits").html("<div align='center'><img src='../images/spinner2.gif' width='75' height='50'/></div>");
		year_max.done(function( data ) {
		$("#overall_hits").html(data);
		});
	$('#but_hit').css('display','none');
			}
			</script>
			<?php
			include 'include/footer.php';
			?>