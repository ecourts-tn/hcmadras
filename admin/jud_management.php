<?php 

include 'include/header.php';
include 'default_pasword_check.php';
include 'function/jud_fun.php';

$jud_fun =new JUDFUN($DB_con);

include_once('validationfiles/formvalidator.php'); 
$validator = new FormValidator();

extract($_POST);
//var_dump($_POST);
/* ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
	error_reporting( E_ALL );  */
	if(isset($_POST['submit'])) {
		
	
try
		{
				$pre_name=htmlspecialchars(filter_input(INPUT_POST, 'pre_name', FILTER_SANITIZE_STRING));
				$jud_name=htmlspecialchars(filter_input(INPUT_POST, 'jud_name', FILTER_SANITIZE_STRING));
				$Coram=htmlspecialchars(filter_input(INPUT_POST, 'Coram', FILTER_SANITIZE_STRING));
				$jud_app_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_app_date', FILTER_SANITIZE_STRING));
				$jud_per_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_per_date', FILTER_SANITIZE_STRING));
				$jud_ele_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_ele_date', FILTER_SANITIZE_STRING));
				$jud_rel_date=htmlspecialchars(filter_input(INPUT_POST, 'jud_rel_date', FILTER_SANITIZE_STRING));
				$profile=htmlentities($_POST['profile'], ENT_QUOTES);
				$j_type=htmlspecialchars(filter_input(INPUT_POST, 'j_type', FILTER_SANITIZE_STRING));
				$display=htmlspecialchars(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING));
				$jud_pri=htmlspecialchars(filter_input(INPUT_POST, 'jud_pri', FILTER_SANITIZE_STRING));
				$pages=htmlspecialchars(filter_input(INPUT_POST, 'pages', FILTER_SANITIZE_STRING));
					$jud_code=htmlspecialchars(filter_input(INPUT_POST, 'jud_code', FILTER_SANITIZE_STRING));
					if($jud_code=='85')
					{
						$p_fmt=htmlspecialchars(filter_input(INPUT_POST, 'period_format', FILTER_SANITIZE_STRING));
						if($p_fmt!=''&&$p_fmt=='date')
						{
							$cj_fd=htmlspecialchars(filter_input(INPUT_POST, 'cj_fd', FILTER_SANITIZE_STRING));
							$cj_fm=htmlspecialchars(filter_input(INPUT_POST, 'cj_fm', FILTER_SANITIZE_STRING));$cj_fy=htmlspecialchars(filter_input(INPUT_POST, 'cj_fy', FILTER_SANITIZE_STRING));
							$cj_fdt=$cj_fy.'-'.$cj_fm.'-'.$cj_fd;
							$cj_td=htmlspecialchars(filter_input(INPUT_POST, 'cj_td', FILTER_SANITIZE_STRING));
							$cj_tm=htmlspecialchars(filter_input(INPUT_POST, 'cj_tm', FILTER_SANITIZE_STRING));$cj_ty=htmlspecialchars(filter_input(INPUT_POST, 'cj_ty', FILTER_SANITIZE_STRING));
							$cj_tdt=$cj_ty.'-'.$cj_tm.'-'.$cj_td;
							
						}
						 if($p_fmt!=''&&$p_fmt=='year')
						{
							$cj_fyr=htmlspecialchars(filter_input(INPUT_POST, 'cj_fyr', FILTER_SANITIZE_STRING));
							$cj_fdt=$cj_fyr;
							$cj_tyr=htmlspecialchars(filter_input(INPUT_POST, 'cj_tyr', FILTER_SANITIZE_STRING));
							$cj_tdt=$cj_tyr;
						}
						
					}
					else
					{
						$cj_fdt='';
						$cj_tdt='';
					}
					
					if($jud_app_date!='')
					{
						$jud_app_dt=date('Y-m-d',strtotime($jud_app_date));
					}
					else
					{
						$jud_app_dt='';
					}
					if($jud_per_date!='')
					{
						$jud_per_dt=date('Y-m-d',strtotime($jud_per_date));
					}
					else
					{
						$jud_per_dt=NULL;
					}
					if($jud_ele_date!='')
					{
						$jud_ele_dt=date('Y-m-d',strtotime($jud_ele_date));
					}
					else
					{
						$jud_ele_dt=NULL;
					}
					if($jud_rel_date!='')
					{
						$jud_rel_dt=date('Y-m-d',strtotime($jud_rel_date));
					}
					else
					{
						$jud_rel_dt=NULL;
					}
			
					  if(empty($jud_name))
   {
      
      $error = "Enter your Judge's Name !";
   }

 else if(empty($coram))
   {
      
      $error = "Enter your Judge's Coram!";
   }
 else if(!empty($coram) && $validator->chkbadchar($coram) == false)
 {
  $error = "Please enter valid Judge's Coram";
 }
 else if(empty($jud_app_dt))
   {
      
      $error = "Enter your Judge's Appointed Date!";
   }
 else if(!empty($jud_app_dt) && $validator->chkbadchar($jud_app_dt) == false)
 {
  $error= "Please enter valid Judge's Appointed Date";
 }
 else if($validator->chkbadchar($jud_per_dt) == false)
 {
  $error= "Please enter valid Judge's Permanent Date";
 }

 else if($validator->chkbadchar($jud_ele_dt) == false)
 {
  $error = "Please enter valid Judge's Elevation Date ";
 }

 else if(!empty($jud_rel_dt) && $validator->chkbadchar($jud_rel_dt) == false)
 {
  $error = "Please enter valid Judge's Relieved Date ";
 }
   else if(empty($display))
   {
      
      $error = "Please select Display !";
   }
 else if(!empty($display) && $validator->chkbadchar($display) == false)
 {
  $error = "Please select valid Display ";
 }
 else if(empty($j_type))
   {
      
      $error = "Please select Judge type!";
   }
 else if(!empty($j_type) && $validator->chkbadchar($j_type) == false)
 {
  $error = "Please select Judge type";
 }
  else if(empty($jud_pri))
   {
      
      $error = "Enter your Judge's Priority !";
   }
 else if(!empty($jud_pri) && $validator->chkbadchar($jud_pri) == false)
 {
  $error = "Please enter valid Judge's Priority ";
 }
  else if(empty($pre_name))
   {
      
      $error = "Enter your Prefix Name !";
   }
 else if(!empty($pre_name) && $validator->chkbadchar($pre_name) == false)
 {
  $error = "Please enter valid Prefix Name ";
 }
  else if(empty($profile))
   {
      
      $error = "Enter your Profile !";
   }
 else if(empty($jud_code)&&$jud_code!=0)
   {
      
      $error = "Map your Judge Code !";
   }
 else if(!empty($jud_code) && $validator->chkbadchar($jud_code) == false)
 {
  $error = "Please enter valid Judge Code ";
 }
 else
 {
	
define ("MAX_SIZE","1000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
$errors=0;
if($_FILES['photo']['name'])
{
$image1=$_FILES['photo']['name'];
$allowed_types = array ('image/jpeg','image/jpg');
$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$detected_type = finfo_file($fileInfo, $_FILES['photo']['tmp_name'] );
$tmp=$_FILES["photo"]["tmp_name"];
}
else
{
	$image1="CJ.jpg";
	$allowed_types =array();
	$detected_type ='';

}

if (!in_array($detected_type, $allowed_types )&& $_FILES['photo']['name']) {
		$error='Please Upload Documents JPG Only!';
}
else
{
if ($image1) 
{
	$filename = stripslashes($image1);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "JPG") && ($extension != "jpg") && ($extension != "jpeg")) 
	{
		$error='Upload Documents JPG Only!';
		
	}
	else
	{
		if($_FILES['photo']['name'])
		{
			$size1=filesize($_FILES['photo']['tmp_name']);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 


$binary_bar = file_get_contents($_FILES["photo"]["tmp_name"]);
$dp_image = pg_escape_bytea($binary_bar);

		}
		else
		{
$binary_bar = file_get_contents("images/CJ.jpg");
$dp_image = pg_escape_bytea($binary_bar);

		
		}
		
		if ($dp_image=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull! for image</h3>';
	


			$stmt = $DB_con->prepare("SELECT * FROM judges WHERE  j_coram=:coram and j_app=:jud_app_dt");
					$stmt->execute(array(':coram'=>$coram,':jud_app_dt'=>$jud_app_dt));
					if($stmt->rowCount() > 0){
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
						if($row['j_app']==$jud_app_date)
						{
					   $error= "Judge's Already Exists";
						}
						
						
					}
					else
					{
if($jud_fun->jud_register($pre_name,$jud_name,$coram,$jud_app_dt,$jud_per_dt,$jud_ele_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$profile,$pages,$bd22,$mhc_user,$page_id,$ip,$log_fun,$jud_code,$cj_fdt,$cj_tdt,$j_type))
{
							//$jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr); 
							 $stmt = $DB_con->prepare("SELECT j_id FROM judges ORDER BY j_id DESC LIMIT 1");
				$stmt->execute();
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
		 $j_id=$row['j_id'];
		 //Other Period
			$mod_ins=$_POST['mod_ins'];
			$doc_type=$_POST['doc_type'];
			 $upload_dt=$_POST['upload_dt'];
			 $img=$_FILES['doc']['tmp_name'];
			 $img_pdf=$_FILES['doc']['name'];
			 $file_name=$_POST['doc_name'];
			 $file_lan=$_POST['file_lan'];
			 $doc_display=$_POST['doc_display'];
			// echo '<script>console.log('.print_r($_FILES['doc']).');</script>';
			
		 $temp=$j_id.'-'.$doc_type[0].'-'.var_dump($upload_dt);
		 if($j_id!='' && !empty($doc_type[0]) &&  !empty($upload_dt[0]))
	{

for ($i = 0; $i < count($doc_type); $i++) 
{
	  $document_type=$doc_type[$i];
  if($upload_dt[$i]!='')
  {
  $upload_date = date('Y-m-d',strtotime($upload_dt[$i]));
  }
  else
  {
	 $upload_dt =NULL; 
  }
 
  $images=$img[$i];
   $doc_mod_ins=$mod_ins[$i];

  $doc_file_lan=$file_lan[$i];
  $doc_doc_display=$doc_display[$i];
  $doc_file_name=$file_name[$i];
if ($images) 
{
	$filename1 = stripslashes($img_pdf[$i]);
	$extension1 = getExtension($filename1);
	$extension1 = strtolower($extension1);
	//$error='Upload Documents pdf Only! line 267 '.$_FILES['doc']." ".$images." ".$filename1." ".$extension1;
	if (($extension1 != "PDF") && ($extension1 != "pdf")) 
	{
		$error='Upload Documents pdf Only! line 267 ';
		
	}
	else
	{ 
		$size1=filesize($img[$i]);
 
		if ($size1 > MAX_SIZE*1024)
		{
			$error='You have exceeded the size limit!';
		
		}
 
 $binary_bar1 = file_get_contents($images);
$base64_doc_up = pg_escape_bytea($binary_bar1);

 
		
		if ($base64_doc_up=='') 
		{
			$error='Copy unsuccessfull!</h3>';
			
		}
	else 
	{
		$error='Copy successfull! for pdf</h3>';
	
 $byte=filesize($images);
     

$doc_file_size= formatSizeUnits($byte);


 

	$allowed_types1 = array ('application/pdf');
$fileInfo1 = finfo_open(FILEINFO_MIME_TYPE);
$detected_type1 = finfo_file($fileInfo1, $img[$i]);
if (!in_array($detected_type1, $allowed_types1) ) {
	
		$error='Upload Documents PDF Only! line 335';
}
else
{
if(!empty($upload_date)&& !empty($doc_file_name)&& !empty($doc_file_lan)&& !empty($doc_doc_display)&& !empty($document_type)&&!empty($base64_doc_up))
	
 if($jud_fun->j_history($j_id,$document_type,$upload_date,$doc_file_size,$doc_file_lan,$base64_doc_up,$doc_doc_display,$bd22,$mhc_user,$page_id,$ip,$log_fun,$doc_file_name)) 
            {
				//echo "sucess";
				unset($error);
					 $jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id); 
    
			}
	}
  }
	}
}
			  }
			 
			}
			else
			{
				unset($error);
				$jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
				//$jud_fun->redirect("jud_management.php?joined&CheckString=".$chkstr);			
			}
		 
		 
		 
						} 
		}
		}
	}
}
 }
 
	}
						}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
	 //Delete row
	if (isset($_GET['remove']))
		{
		
      $del_id=$_GET['remove'];
	$page_id=$_GET['page_id'];	
		


		if($jud_fun->jud_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)) 
            {
          $jud_fun->redirect("jud_management.php?joined2&CheckString=".$chkstr."&".md5('page_id')."=".$page_id);
			 
            }
			
	}
	 	try
{
	
$Get_jud_details= $jud_fun->juddata($chkstr,$bd22,$page_id);
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
                                <div class="card-title">New Judge's Registration Form</div>
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
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">New Judge's Added Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined1']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Judge's Updated Successfully</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			 else if(isset($_GET['joined2']))
            {
                 ?>
				 <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Judge's Deleted Successfully </strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
				 
				 <?php
            }
			?>
                                <form class="needs-validation" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" onSubmit="return Validator(this)">
                                    <div class="form-row">
									<div class="col-md-2 form-group mb-1">
                                            <label for="validationTooltip01">Prefix Name</label>
                                            <input class="form-control" id="pre_name" name="pre_name" type="text" placeholder="Prefix name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Prefix Name

                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip01">Judge's Name</label>
                                            <input class="form-control" id="jud_name" name="jud_name" type="text" placeholder="Judge's name"  required="required" aria-describedby="validationTooltipFirstPrepend" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Judge's Name

                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label for="validationTooltip02">Judge's Coram</label>
                                            <input class="form-control" id="coram" name="coram" type="text" placeholder="Judge's Coram"  required="required" onKeyPress="return ValidateAlpha(event);" autocomplete="off" />
                                            <div class="invalid-tooltip">
                                               Enter Your Judge's Coram

                                            </div>
                                        </div>
										 <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Judge Type </label>
											<select class="form-control" id="j_type" required="required" name="j_type" autocomplete="off" >
                                                 <option value="">Choose</option>
												 <option value="CJI">Hon'ble Chief Justice of India</option>
                                                <option value="CJ">Hon'ble Chief Justice</option>
                                                <option value="ACJ">Hon'ble Acting Chief Justice</option>
												<option value="J">Hon'ble Judge</option>
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge type.

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip02">Judge's Appointed on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_app_date" name="jud_app_date" type="text" placeholder="Judge's  Appointed on" aria-describedby="validationTooltipUsernamePrepend" required="required"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Judge's  Appointed on.

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Judge's  Permanent on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipUsernamePrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_per_date" name="jud_per_date" type="text" placeholder="Judge's  permanent on" aria-describedby="validationTooltipUsernamePrepend" required="required"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Judge's  permanent on.

                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Judge's Elevation on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_ele_date" name="jud_ele_date" type="text" placeholder="Judge's Elevation on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Judge's Elevation on.

                                                </div>
                                            </div>
                                        </div> 
										</div>
                                    <div class="form-row">
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltipUsername">Judge's Relieved on</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text" id="validationTooltipPasswordPrepend">@</span></div>
                                                <input class="form-control datepicker" id="jud_rel_date" name="jud_rel_date" type="text" placeholder="Judge's Relieved on" aria-describedby="validationTooltipPasswordPrepend"  autocomplete="off" />
                                                <div class="invalid-tooltip">
                                                    Please choose a Judge's Relieved on.

                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip03">Photo</label>
                                           
                                    <div class="custom-file">
                                        <input class="custom-file-label" id="photo" name="photo" type="file" aria-describedby="inputGroupFileAddon01" onchange="return ValidateFileUpload()">
                                      
                                    </div>
                                            <div class="invalid-tooltip">
                                                Please provide a valid Photo.

                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                             <label for="validationTooltip03">Judge's Priority</label>
                                            <input class="form-control Number" id="jud_pri" name="jud_pri" type="text" placeholder="Judge's Priority" required="required"  autocomplete="off" maxlength='2' />
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge's Priority.

                                            </div>
                                           
                                            
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Display</label>
											<select class="form-control" id="display" required="required" name="display" autocomplete="off" >
                                                 <option value="">Choose</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Display.

                                            </div>
                                        </div>
										  <div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Judge Pages</label>
											<select class="form-control" id="pages" required="required" name="pages" autocomplete="off" >
                                                 <option value="">Choose</option>
										 <?php 
											
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='judge_pages'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>			 
												 
                                               <!-- <option value="PJ">Present Judges</option>
                                                <option value="FC">Former CJ</option>
                                                <option value="FJ">Former Judges</option>
                                                <option value="TJ">Transfer Judges</option>
                                                <option value="SJ">Speeches Judges</option>
                                                <option value="AJ">Assets  Judges</option>-->
												
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge Pages.

                                            </div>
                                        </div>
										<div class="col-md-4 form-group mb-3">
                                            <label for="validationTooltip05">Map Judge Code</label>
											<select class="form-control" id="jud_code" required="required" name="jud_code" onchange='showPeriod()' autocomplete="off" >
                                                 <option value="">Choose</option>
                                               <?php
							    $sql3="SELECT * FROM judge_name_t WHERE jto_dt IS NULL ORDER BY judge_code";
						$res3=$HCMAS_DB->query($sql3);
						while($info3=$res3->fetch())
						{
							
								echo '<option value="'.$info3['judge_code'].'">'.$info3['short_judge_name'].'-'.$info3['judge_name'].'</option>';
							
											
						} 
							echo '<option value="0" >Rtd.-Former Judge</option>';
						?>
												
												
                                            </select>
                                            
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge Code.

                                            </div>
                                        </div>
										</div>
									<div class="form-row" >
										<div class="col-md-4 form-group mb-3" id='period' style="display:none">
                                            <label for="validationTooltip05">Period</label>
											<div>
											<input type="radio" value='date' id='date' name='period_format' onclick='showPeriodFormat()'>Date Format</input> 
											<input type="radio" value='year' id='year' name='period_format' onclick='showPeriodFormat()'>Year Format</input> 
											 <div class="invalid-tooltip">
                                                Please select period format.

                                            </div>
											</div>
										  
										</div>
                                    
                                        <div class="col-md-4 form-group mb-3" id='cj_from_date' style='display:none'>
										 <label for="validationTooltip05">Judge as CJ from date</label>
										 <div id='cj_from_df' style='display:none'>
										<div class="input-group" >
										  <input class="form-control Number" id="cj_fd" name="cj_fd"  type="text" placeholder="DD" autocomplete="off" maxlength='2' onfocusout='formatDM(this)' />&nbsp;/&nbsp;
										  <input class="form-control Number" id="cj_fm" name="cj_fm" type="text" placeholder="MM" autocomplete="off" maxlength='2' onfocusout='formatDM(this)' />&nbsp;/&nbsp;
										  <input class="form-control Number" id="cj_fy" name="cj_fy" type="text" placeholder="YYYY" autocomplete="off" maxlength='4'  />
										  <div class="invalid-tooltip">
                                                Please provide a valid date. </div>
										  </div></div>
										  <div id='cj_from_yf' style='display:none'>
										  <div class="input-group" >
										  <input class="form-control Number" id="cj_fyr" name="cj_fyr" type="text" placeholder="YYYY" autocomplete="off" maxlength='4' />
										  <div class="invalid-tooltip">
                                                Please provide a valid date.

                                            </div>
										  </div>
                                           
										</div>
										 
											</div>
										 <div class="col-md-4 form-group mb-3" id='cj_to_date' style='display:none'>
										 <label for="validationTooltip05">Judge as CJ relieved date</label>
										 <div id='cj_to_df' style='display:none'>
										<div class="input-group">
										  <input class="form-control Number" id="cj_td" name="cj_td"  type="text" placeholder="DD" autocomplete="off" maxlength='2' onfocusout='formatDM(this)' />&nbsp;/&nbsp;
										  <input class="form-control Number" id="cj_tm" name="cj_tm" type="text" placeholder="MM" autocomplete="off" maxlength='2' onfocusout='formatDM(this)'/>&nbsp;/&nbsp;
										  <input class="form-control Number" id="cj_ty" name="cj_ty" type="text" placeholder="YYYY" autocomplete="off" maxlength='4' />
										    <div class="invalid-tooltip">
                                                Please provide a valid date.
												</div>
										  </div></div>
										  <div id='cj_to_yf' style='display:none'>
										  <div class="input-group" >
										  <input class="form-control Number" id="cj_tyr" name="cj_tyr" type="text" placeholder="YYYY" autocomplete="off" maxlength='4' />
										    <div class="invalid-tooltip">
                                                Please provide a valid date.

                                            </div>
										  </div>
                                          </div>
										</div>
										</div>
									
									<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">
                                            <label for="validationTooltip03">Judge's Description </label>
											<div class="input-group">
                                    
                                    <textarea class="content form-control" id="profile" name="profile"  required="required"></textarea>
                                </div>
                                          
                                            <div class="invalid-tooltip">
                                                Please provide a valid Judge's Description.

                                            </div>
                                        </div>
							
  
               
             
										</div>
											<div class="form-row">
                                        <div class="col-md-12 form-group mb-12">		
            <label for="validationTooltip03">Judge's Documents </label>
				  <div class="">
  <table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					  <tr>
        <td rowspan="1">Sl.NO</td>
        <td rowspan="1">Documents Type</td>
        <td rowspan="1">Upload Date</td>
		<td rowspan="1">Document Name</td>
		<td rowspan="1">Upload Documents</td>
		<td rowspan="1">File Language</td>
		<td rowspan="1">Display</td>
    </tr>
   
				</thead>
				<tbody>
					
					
   
        <tr id='addr0'>
		     <td>
			1 <input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/>
		    </td>
		     <td>
		   <select type="text" class="form-control" name="doc_type[]" id="doc_type"  value="" placeholder="Judge Name"  >
		   <option value="">Choose</option>
		   	 <?php 
											echo "";
											$d_qry=$DB_con->prepare("select * from drop_down where page_id=".base64_decode($page_id)." and col_nme='judge_doc'  and display='Y' order by order_id");
											$d_qry->execute();
								if($d_qry->rowCount() > 0){
											while($m=$d_qry->fetch()){
													echo "<option value='".$m['value']."'>".$m['name']."</option>";
								}}?>
		   
		   <!--<option value="A">Assets of Judges</option>
		   <option value="S">Speeches by Judges</option>
		   <option value="F">Former Judges</option>-->
		   </select>
		   
			</td>
            <td>
		   <input type="text" class="form-control datepicker" name="upload_dt[]" id="upload_dt"  value="" placeholder="Upload Date"  />
			</td>
			<td>
		    <input class="form-control" id="doc_name" name="doc_name[]" type="text" placeholder="Document Name"/>
			</td>
            <td>
		    <input class="form-control" id="doc" name="doc[]" type="file" onchange="return ValidateFileUpload1()"/>
			</td>
			
			<td>
		   <select type="text" class="form-control " name="file_lan[]" id="file_lan"  value="" placeholder="File Language"  >
		    <option value="">Choose</option>
		   <option value="English">English</option>
		   <option value="Tamil">Tamil</option>
		   </select>
			</td>
			 <td>
		   <select type="text" class="form-control" name="doc_display[]" id="doc_display"  value="" placeholder="Judge Name"  >
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
                                <h4 class="card-title mb-3">List of Hon'ble Judges</h4>
                                <p style="float:right"> <a class="btn btn-primary text-white " href="jud_management_order.php?CheckString=<?php echo $chkstr; ?>&<?php echo md5('page_id')?>=<?php echo $page_id ?>">Ordering</a></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                            <tr>
											    <th>Sl.No</th>
												<th>Photo</th>
                                                <th>Judge's Name</th>
												<th>Judge's Coram</th>
                                                <th>Date</th>
                                                <th>Profile</th>
												<th>Display</th>
												<th>Seniorty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $Get_jud_details ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											  <th>Sl.No</th>
												<th>Photo</th>
                                                <th>Judge's Name</th>
												<th>Judge's Coram</th>
                                                <th>Date</th>
                                                <th>Profile</th>
												<th>Display</th>
												<th>Seniorty</th>
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
      $('#addr'+i).html("<td>"+ (i+1) +"<input type='hidden' value='I' id='mod_ins' name='mod_ins[]'/></td><td><select name='doc_type[]' id='doc_type' type='text' placeholder='Documents Type' class='form-control'><option value=''>Choose</option><option value='A'>Assets of Judges</option><option value='S'>Speeches by Judges</option><option value='F'>Former Judges</option></select></td><td><input name='upload_dt[]' id='upload_dt' type='text' placeholder='Signed Date' class='form-control date-picker' /></td><td><input  name='doc_name[]' id='doc_name' type='text' placeholder='Document Name' class='form-control'/></td><td><input  name='doc[]' id='doc' type='file' placeholder='File' class='form-control' onchange='return ValidateFileUpload"+ (i+1) +"()'/></td><td><select name='file_lan[]' id='file_lan' type='text' placeholder='File Language' class='form-control' ><option value=''>Choose</option><option value='English'>English</option><option value='Tamil'>Tamil</option><td><select name='doc_display[]' id='doc_display' type='text' placeholder='Documents Type' class='form-control'><option value=''>Choose</option><option value='Y'>Yes</option><option value='No'>No</option></select></td></td>");

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
		
		   function ValidateFileUpload2() {
        var fuData = document.getElementById('doc');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#doc').val('');
         $('#doc').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "PDF" || Extension == "pdf") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        //$('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
	 swal("Document only allows file type of PDF", "", "error");
	 $('#doc').val('');
         $('#doc').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
	function showPeriod()
	{
		var mapJcode=$('#jud_code').val();
		if(mapJcode=='85')
		{
			$('#period').css("display", "block");
			$("[name='period_format']").prop("required", true);
			showPeriodFormat();
		}
		else
			
			{
				$("[name='period_format']").prop("required", false);
				$('#period').css("display", "none")
				$('#cj_from_date').css("display", "none");
				$('#cj_to_date').css("display", "none");
				$("input[type=radio][name=period_format]").prop('checked', false);
				$("[name='cj_fd']").val('');
				$("[name='cj_fm']").val('');
				$("[name='cj_fy']").val('');
				$("[name='cj_td']").val('');
				$("[name='cj_tm']").val('');
				$("[name='cj_ty']").val('');
				$("[name='cj_tyr']").val('');
				$("[name='cj_fyr']").val('');
				showPeriodFormat();
			}
			
		
	}
	function showPeriodFormat()
	{
		var format=$('input[name="period_format"]:checked').val();
		if(format=='date')
		{
			$('#cj_from_date').css("display", "block");
			$('#cj_to_date').css("display", "block");
			$('#cj_from_df').css("display", "block");
			$('#cj_to_df').css("display", "block");
			$('#cj_from_yf').css("display", "none");
			$('#cj_to_yf').css("display", "none");
			$("[name='cj_fd']").prop("required", true);
			$("[name='cj_fm']").prop("required", true);
			$("[name='cj_fy']").prop("required", true);
			$("[name='cj_td']").prop("required", true);
			$("[name='cj_tm']").prop("required", true);
			$("[name='cj_ty']").prop("required", true);
			$("[name='cj_tyr']").prop("required", false);
			$("[name='cj_fyr']").prop("required", false);
		}
		else if (format=='year')
		{
			$('#cj_from_date').css("display", "block");
			$('#cj_to_date').css("display", "block");
			$('#cj_from_yf').css("display", "block");
			$('#cj_to_yf').css("display", "block");
			$('#cj_from_df').css("display", "none");
			$('#cj_to_df').css("display", "none");
			$("[name='cj_fd']").prop("required", false);
			$("[name='cj_fm']").prop("required", false);
			$("[name='cj_fy']").prop("required", false);
			$("[name='cj_td']").prop("required", false);
			$("[name='cj_tm']").prop("required", false);
			$("[name='cj_ty']").prop("required", false);
			$("[name='cj_tyr']").prop("required", true);
			$("[name='cj_fyr']").prop("required", true);
		}
		else
		{
			$("[name='cj_fd']").prop("required", false);
			$("[name='cj_fm']").prop("required", false);
			$("[name='cj_fy']").prop("required", false);
			$("[name='cj_td']").prop("required", false);
			$("[name='cj_tm']").prop("required", false);
			$("[name='cj_ty']").prop("required", false);
			$("[name='cj_tyr']").prop("required", false);
			$("[name='cj_fyr']").prop("required", false);
		}
		
		
	}
        </script>
			<script>
			
			 $( function() {
    $( ".datepicker" ).datepicker({
		dateFormat:'d-m-yy'
	});
  } );
			function Validator(theform)
{
     if(!(theform.pre_name.value) )
   {
     swal("Enter a Valid  Judge's Prefix Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#pre_name').val('');
         theform.pre_name.focus();
    return false;
   }
    else if(!(theform.jud_name.value) )
   {
     swal("Enter a Valid  Judge's Name.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_name').val('');
         theform.jud_name.focus();
    return false;
   }
   else if(chkbadchar(theform.coram.value)==false )
   {
     swal("Enter a Valid  Judge's coram", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#coram').val('');
         theform.coram.focus();
    return false;
   }
  else if(chkbadchar(theform.jud_app_date.value)==false )
   {
     swal("Enter a Valid  Judge's  Appointed on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_app_date').val('');
         theform.jud_app_date.focus();
    return false;
   }
   else if(chkbadchar(theform.jud_per_date.value)==false )
   {
     swal("Enter a Valid  Judge's  Permanent on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_per_date').val('');
         theform.jud_per_date.focus();
    return false;
   }
    else if(chkbadchar(theform.jud_ele_date.value)==false )
   {
     swal("Enter a Valid  Judge's  Elevation on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#jud_ele_date').val('');
         theform.jud_ele_date.focus();
    return false;
   }
   else if(chkbadchar(theform.jud_rel_date.value)==false )
   {
     swal("Enter a Valid  Judge's Relieved on.", "", "error");
    //alert("Enter a Valid  First Name.");
		$('#reg_rel_date').val('');
         theform.reg_rel_date.focus();
    return false;
   }
   
   else if(isNumber(theform.jud_pri.value)==false )
    {
		swal("Enter a Valid  Judge's Priority.", "", "error");
		$('#jud_pri').val('');
         theform.jud_pri.focus();
    return false;
    }
   /* else if(chkbadchar(theform.profile.value)==false )
   {
     swal("Enter a Valid  Profile", "", "error");
   
		$('#profile').val('');
         theform.profile.focus();
    return false;
   } */
    else if(chkbadchar(theform.j_type.value)==false )
   {
     swal("Enter a valid  Judge type.", "", "error");
    
		$('#j_type').val('');
         theform.j_type.focus();
    return false;
   }
   else if(chkbadchar(theform.display.value)==false )
   {
     swal("Enter a Valid  Display.", "", "error");
    
		$('#display').val('');
         theform.display.focus();
    return false;
   }
     else if (theform.jud_code.value=='85'&& !document.getElementById('date').checked && !document.getElementById('year').checked)
  {
	  swal("Please select period format.","","error");
	  theform.date.focus();
	  theform.year.focus();
	  return false;
  }
  else if (theform.jud_code.value=='85'&&document.getElementById('date').checked)
  {
	  if(theform.cj_fd.value==''||parseInt(theform.cj_fd.value)==0||parseInt(theform.cj_fd.value)>31)
	  {
		  swal("Please enter valid date in CJ from date.","","error");
		  theform.cj_fd.focus();
		  return false;
	  }
	  else if(theform.cj_fm.value==''||parseInt(theform.cj_fm.value)==0||parseInt(theform.cj_fm.value)>12)
	  {
		  swal("Please enter valid month in CJ from date.","","error");
		  theform.cj_fm.focus();
		  return false;
	  }
	   else if(theform.cj_fy.value==''||parseInt(theform.cj_fy.value)==0||parseInt(theform.cj_fy.value)>new Date().getFullYear()||parseInt(theform.cj_fy.value).toString().length<4)
	  {
		  swal("Please enter valid year in CJ from date.","","error");
		  theform.cj_fy.focus();
		  return false;
	  }
	  	else if(theform.cj_td.value==''||parseInt(theform.cj_td.value)==0||parseInt(theform.cj_td.value)>31)
	  {
		  swal("Please enter valid date in CJ to date.","","error");
		  theform.cj_td.focus();
		  return false;
	  }
	  else if(theform.cj_tm.value==''||parseInt(theform.cj_tm.value)==0||parseInt(theform.cj_tm.value)>12)
	  {
		  swal("Please enter valid month in CJ to date.","","error");
		  theform.cj_tm.focus();
		  return false;
	  }
	   else if(theform.cj_ty.value==''||parseInt(theform.cj_ty.value)==0||parseInt(theform.cj_ty.value)>new Date().getFullYear()||parseInt(theform.cj_ty.value).toString().length<4 )
	  {
		  swal("Please enter valid year in CJ to date.","","error");
		  theform.cj_ty.focus();
		  return false;
	  }
	  else if(theform.cj_ty.value!='')
	  {
		 temp= validateDate(parseInt(theform.cj_td.value),parseInt(theform.cj_tm.value),parseInt(theform.cj_ty.value));
		 if(temp!=true)
		 {
			swal(temp+"in CJ to date.","","error");
			theform.cj_td.focus();
			theform.cj_tm.focus();
			theform.cj_ty.focus();
			return false;
		 }
	  }
	  else if(theform.cj_fy.value!='')
	  {
		 temp= validateDate(parseInt(theform.cj_fd.value),parseInt(theform.cj_fm.value),parseInt(theform.cj_fy.value));
		 if(temp!=true)
		 {
			swal(temp+"in CJ from date.","","error");
			theform.cj_fd.focus();
			theform.cj_fm.focus();
			theform.cj_fy.focus();
			return false;
		 }
	  }
	  
  }
    else if (theform.jud_code.value=='85'&&document.getElementById('year').checked )
  {
	  if(theform.cj_fyr.value==''||parseInt(theform.cj_fyr.value)==0||parseInt(theform.cj_fm.value)>new Date().getFullYear()||parseInt(theform.cj_fyr.value).toString().length<4)
	  {
		  swal("Please enter valid year in CJ from date.","","error");
		  theform.cj_fyr.focus();
		  return false;
	  }
	   else if(theform.cj_tyr.value==''||parseInt(theform.cj_tyr.value)==0||parseInt(theform.cj_tyr.value)>new Date().getFullYear()||parseInt(theform.cj_tyr.value).toString().length<4 )
	  {
		  swal("Please enter valid year in CJ to date.","","error");
		  theform.cj_tyr.focus();
		  return false;
	  }
  }
  
 else if(theform.mod_ins.length>0){
   for(var x=0;x<theform.mod_ins.length;x++)
   {
   if(theform.doc_type[x].value!="")
   {
	   if(theform.upload_dt[x].value=="")
	   {
		   swal("Enter document upload date in row no:"+(x+1), "", "error");
		    theform.upload_dt[x].focus();
			return false;
	   }
	   else if(theform.doc_name[x].value=="")
	   {
		   swal("Enter document name in row no:"+(x+1), "", "error");
		   theform.doc_name[x].focus();
			return false;
	   }
	    else if(theform.file_lan[x].value=="")
	   {
		   swal("select document language in row no:"+(x+1), "", "error");
		   theform.file_lan[x].focus();
			return false;
	   }
	    else if(theform.doc_display[x].value=="")
	   {
		   swal("select document display value in row no:"+(x+1), "", "error");
		   theform.doc_display[x].focus();
			return false;
	   }
	   else if(theform.doc[x].value=="")
	   {
		   swal("select document to upload in row no:"+(x+1), "", "error");
		   theform.doc[x].focus();
			return false;
	   }
		   
   }  
   else{
	   if(theform.upload_dt[x].value!=""||theform.doc_name[x].value!=""||theform.file_lan[x].value!=""||theform.doc_display[x].value!=""||theform.doc[x].value!="")
	   {
		    swal("select document type in row no:"+(x+1), "", "error");
			theform.doc_type[x].focus();
			return false;
	   }
	   
  
   }
   }
   }
   else if(theform.mod_ins.value!="")
   {
		   
	if(theform.doc_type.value!="")
   {
	   if(theform.upload_dt.value=="")
	   {
		   swal("Enter document upload date in row no: 1", "", "error");
		    theform.upload_dt.focus();
			return false;
	   }
	   else if(theform.doc_name.value=="")
	   {
		   swal("Enter document name in row no: 1", "", "error");
		   theform.doc_name.focus();
			return false;
	   }
	    else if(theform.file_lan.value=="")
	   {
		   swal("select document language in row no: 1", "", "error");
		   theform.file_lan.focus();
			return false;
	   }
	    else if(theform.doc_display.value=="")
	   {
		   swal("select document display value in row no: 1", "", "error");
		   theform.doc_display.focus();
			return false;
	   }
	   else if(theform.doc.value=="")
	   {
		   swal("select document to upload in row no:1", "", "error");
		   theform.doc.focus();
			return false;
	   }
		   }
		     else{
	   if(theform.upload_dt.value!=""||theform.doc_name.value!=""||theform.file_lan.value!=""||theform.doc_display.value!=""||theform.doc.value!="")
	   {
		    swal("select document type in row no: 1", "", "error");
			theform.doc_type.focus();
			return false;
	   }
	   
  
   }
	   
   }  

		
		   
		
   }
    

function ValidateFileUpload() {
	
        var fuData = document.getElementById('photo');
        var FileUploadPath = fuData.value;
	
//To check if user upload any file
        if (FileUploadPath == '') {
           
			 swal("Please upload an image", "", "error");
	 $('#photo').val('');
         $('#photo').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "JPG" || Extension == "jpg") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        //$('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
	 swal("Photo only allows file type of JPG", "", "error");
	 $('#photo').val('');
         $('#photo').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
 function ValidateFileName() {
	 var file_name=$('f_nme').val();
	 if(file_name.length>100)
	 {
		 swal("File name exceeds 100 characters", "", "error"); 
	 }
	else if(file_name.length==0)
	{
		swal("Please enter file name", "", "error"); 
	}
	else	
	return true;
 }
 function ValidateFileUpload1() {
        var fuData = document.getElementById('doc');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            
			 swal("Please upload an PDF", "", "error");
	 $('#doc').val('');
         $('#doc').focus();

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "PDF" || Extension == "pdf") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        //$('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
	 swal("Document only allows file type of PDF", "", "error");
	 $('#doc').val('');
         $('#doc').focus();
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
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


					
					
	  $.get('jud_management.php?page_id=<?php echo $page_id ?>&remove=' + id, function(data) {
						
					
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

	function validateDate(day,month,year)
	{
		 let ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		if(month==1||month>2)
		{
			if (day > ListofDays[month - 1]) {   
                return "Please enter valid date ";
            }
			else
				return true;
		}
		else if (month == 2) {
            let leapYear = false;
            if ((!(year % 4) && year % 100) || !(year % 400)) leapYear = true;
            if ((leapYear == false) && (day >= 29)) 
				return "Entered year is not a leap year ";
            else
                if ((leapYear == true) && (day > 29)) {
                    return "Please enter valid date ";
                }
				else return true;
        }
		else
		return true;
	}
	function formatDM(dm)
	{
		var data=dm.value;
		$(dm).val(data.padStart(2,'0'));
		return true;
		
		
	}
			</script>