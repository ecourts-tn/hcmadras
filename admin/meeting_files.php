<?php 
include 'include/header.php';

?>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1 class="mr-2">Meeting Files</h1>
                    
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                   
                   
                   
                   
                    <!-- finance-->
                    
                    
                    <!-- table-->
                   
                    <div class="col-lg-4 col-md-6 col-xl-4 mt-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="ul-widget__head">
                                    <div class="ul-widget__head-label">
                                        <h3 class="ul-widget__head-title">Meeting Files</h3>
                                    </div>
                                    <div class="ul-widget__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#__g-widget4-tab1-content" role="tab" aria-selected="true">Today</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#__g-widget4-tab2-content" role="tab" aria-selected="false">Archive </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ul-widget__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="__g-widget4-tab1-content">
										
													 
                                            <div class="ul-widget1">
											<?php
											$cur=date('Y-m-d');
											
											//and meeting_date='".$cur."'
											 $qry_c_files = $DB_con->query("select * from mhc_metting_files where display='Y'  and meeting_date='".$cur."' order by files_id asc");
while($row_c_files = $qry_c_files->fetch())
{


?>
                                                <div class="ul-widget4__item ul-widget4__users">
                                                    <div class="ul-widget4__img"><img id="userDropdown" src="images/pdf.png" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                                    <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#"><?php echo $row_c_files['meeting_title'] ?></a><span class="ul-widget2__username" href="#"><?php echo date('d-m-Y',strtotime($row_c_files['meeting_date'])); ?></span></div>
                                                    <div class="ul-widget4__actions">
                                                        <a class="btn btn-primary"  href="download.php?pdf_id=<?php echo $row_c_files['files_id']?>&page=M"><i class="i-Data-Download text-32 mr-3"></i></a>
                                                    </div>
                                                </div>
                                          <?php
										  }
										  ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="__g-widget4-tab2-content">
                                            <div class="ul-widget1">
                                               <?php
											$cur=date('Y-m-d');
											
											//and meeting_date='".$cur."'
											 $qry_files = $DB_con->query("select * from mhc_metting_files where display='Y'  and meeting_date<'".$cur."' order by files_id asc");
while($row_files = $qry_files->fetch())
{


?>
                                                <div class="ul-widget4__item ul-widget4__users">
                                                    <div class="ul-widget4__img"><img id="userDropdown" src="images/pdf.png" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                                    <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#"><?php echo $row_files['meeting_title'] ?></a><span class="ul-widget2__username" href="#"><?php echo date('d-m-Y',strtotime($row_files['meeting_date'])); ?></span></div>
                                                    <div class="ul-widget4__actions">
                                                        <a class="btn btn-primary"  href="download.php?pdf_id=<?php echo $row_files['files_id']?>&page=M"><i class="i-Data-Download text-32 mr-3"></i></a>
                                                    </div>
                                                </div>
                                          <?php
										  }
										  ?>
                                               
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mask-form-->
               
                    <!-- sales-status-->
             
                </div>
               
                <!-- end of row-->
                <!-- end of main-content -->
            </div><!-- Footer Start -->
          
            <!-- fotter end -->
       
	<?php include 'include/footer.php' ?>
   