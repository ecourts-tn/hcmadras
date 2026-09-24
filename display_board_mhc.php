<?php 
require('config/dbconfig_status.php');
include"header.php";?>
<style>
/* FontAwesome for working BootSnippet :> */


#team {
    background: #eee !important;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #ea061b;
    border-color: #71010b;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #ea061b;
    border-color: #71010b;
	font-size: 20px;
	font-weight: bold;
}

section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}

#team .card {
    border: none;
    background: #ffffff;
}

.image-flip:hover .backside,
.image-flip.hover .backside {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
    border-radius: .25rem;
}

.image-flip:hover .frontside,
.image-flip.hover .frontside {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform: perspective(1000px);
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
}

.backside {
    position: absolute;
    top: 0;
    left: 0;
    background: white;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
}

.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    min-height: 312px;
}

.backside .card a {
    font-size: 18px;
    color: #007b5e !important;
}

.frontside .card .card-title,
.backside .card .card-title {
    color: #007b5e !important;
}
.card-title{ height:70px;}
.card-title1{ color: #007b5e !important;margin-bottom: 25px;
font-size: 25px;
}

.frontside .card .card-body img {
    width: 120px;
   /*  height: 120px */;
    border-radius: 50%;
	margin-bottom: 10px;
}
.card-body{height:400px;}


</style>

<script>
	function display_ct6() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
x1 =   hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
document.getElementById('ct6').innerHTML = x1;
display_c6();
 }
 function display_c6(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct6()',refresh)
}
display_c6()
	</script>
<link href="css/bootstrap.min1.css" rel="stylesheet" id="bootstrap-css">

	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="">
<div class="">
	
<div class="">
		
				
			<article class="group post-1222 page type-page status-publish hentry">
				
									
				
<section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1"><?php echo date("d/m/Y");?> High Court of Madras Display board <span  id='ct6'></span> <input class="btn btn-default" style="
    background-color: #d00707;
    font-size: 20px;
    color: white;
    font-weight: bold;cursor: pointer;" type="button" value="Refresh" onclick="window.location.href='display_board_mhc.php'"></h5>
		 
        <div class="row">
            <!-- Team member -->
			  <?php
$Crr_dt=date('Y-m-d');
//$Crr_dt=date('2023-05-11');
//echo "SELECT * FROM currentcourt where cur_date='".$Crr_dt."'  order by court asc";
   $qry_display = $DISPLAY_con->query("SELECT *,currentcourt.court as courtmain FROM currentcourt inner join court_no on court_no.court_no=currentcourt.court where cur_date='".$Crr_dt."'  order by court_no.court asc");

while ($row_display = $qry_display->fetch())
	{
		  if($row_display['lc']=='Y')
	  {
	   $list='List over';
	  }
	  else
	  {
	  if($row_display['list']==0)
	  {
	  $list1='';
	  }
	  else
	  {
	  $list1='/L'.$row_display['list'];
	  }
	  
	  $list=$row_display['item'].$list1;
	  }
	  
	  if(isset($row_display['item'])&& $row_display['item']!=0)
	  {
		  //var_dump("SELECT casetype,caseno,year,bench_id FROM causelist where cause_date='".$row_display['cur_date']."' and court_no='".$row_display['courtmain']."' and item_no='".$row_display['item']."' and list_no='".$row_display['list']."'");
		
			$court=$row_display['courtmain'];
		
	   $sql4=$DISPLAY_con->query("SELECT casetype,caseno,year,bench_id FROM causelist where cause_date='".$row_display['cur_date']."' and court_no='".$court."' and item_no='".$row_display['item']."' and list_no='".$row_display['list']."'");
	   
		$row3=$sql4->fetch();
				
	   $case_det=$row3['casetype'].'.'.$row3['caseno'].'/'.$row3['year'];
	$bench_id =$row3['bench_id'];
	$cur_dt=date('Y-m-d');

					/* $vc_link_qry=$VC_con->query("SELECT meeting_link FROM tn_vc_det WHERE bench_id = '".$bench_id ."' and court_det='MHC' AND to_date >= '".$cur_dt."' LIMIT 1");
					
					if($vc_link_qry->rowCount()>0){
					$vc_link_data=$vc_link_qry->fetch();
					$vc_link=$vc_link_data['meeting_link'];
					$case='<a href="#" style="padding:10px" class="btn btn-primary btn-sm" onclick="swal({title:\'Alert\',text:\'External Website that opens in a new window\',type:\'info\'}).then(function() {window.open(\''.$vc_link.'\', \'_blank\');})">'.$case_det.'</a>';
					}
					else{
						$vc_link='#';
						 $case='<a href="'.$vc_link.'" style="padding:10px" class="btn btn-primary btn-sm">'.$case_det.'</a>';
					}
	 */
	
	 // $case='<a href="'.$vc_link.'" style="padding:10px" class="btn btn-primary btn-sm">'.$case_det.'</a>';
	  $case='<a href="#" style="padding:10px" class="btn btn-primary btn-sm">'.$case_det.'</a>';
	  }
	  else
	  {
		   $case='';
		    
			
			 $sql4=$DISPLAY_con->query("SELECT casetype,caseno,year,bench_id FROM causelist where cause_date='".$row_display['cur_date']."' and court_no='".$row_display['courtmain']."'  ");
	   
		$row3=$sql4->fetch();
		$bench_id =$row3['bench_id'];
	  }
	  
	  // $bench_id =$row3['bench_id'];
	  
	  
			//JUDEGE 
			if($bench_id!='')
			{
					$sql2="SELECT * FROM judge_t WHERE court_no = '".$bench_id."' order by judge_priority asc";
					$judge_name="";
					$res2=$HCMAS_DB->query($sql2);
					$row_count = $res2->rowCount()-1;
$count=0;
$jud_img='';
					while($info2 = $res2->fetch())
					{
						
						$judge_code=$info2['judge_code'];
						
						$sql3="SELECT * FROM judge_name_t WHERE judge_code = '".$judge_code."'";
						//echo $sql3;
						$res3=$HCMAS_DB->query($sql3);
						$info3=$res3->fetch();
						$judge_name.=str_replace("Honourable","Hon'ble",$info3['judge_name']);
						if($row_count!=$count)		
						{
							$judge_name.=' and ';
						}
						$count++;
						if($judge_code==97||$judge_code==85)
						{//$judge_code=111;
							$temp_type="";
							if($judge_code==97)
								$temp_type="ACJ";
							else 
								$temp_type="CJ";
						$que="SELECT jud_code FROM judges WHERE j_page = 'PJ' AND j_type = '".$temp_type."' and j_display='Y'";
						$que_res=$DB_con->query($que);
						$que_info=$que_res->fetch();
						$judge_code=$que_info['jud_code'];
						}
						$jud_img .='<img class="img-fluid" style="width: 120px;border-radius: 50%;margin-bottom: 10px;" src="admin/view_image.php?jud_code='.base64_encode($judge_code).'&&page='.base64_encode('J').'&view_cd='.base64_encode('P').'" alt="card image" style="width:75px;height:100px"">  ';
					}
					
			}
			else
			{
				$judge_name='';
				$jud_img='';
			}
					$court_no=$row_display['courtmain'];
					
					if($judge_name!='' and $jud_img!='')
					{
		?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div style="border: none;background: #ffffff;min-height: 312px; font-size: 18px;color: #007b5e !important;">
                                <div style="height:400px;text-align:center;">
								 <h4 style="color: #007b5e !important;"><?php echo $judge_name;  ?></h4>
								 <p  style="font-size: 26px;font-weight: bold;">Court No : <?php echo $court_no;  ?> </p>
								 <p><br></p>
                                    <p><?php echo $jud_img;?></p>
                                   
                                    
									<!--<h4 class="card-title1">Item No : <?php echo $list ?></h4>-->
									<h4  style="color: #007b5e !important;margin-bottom: 25px;
font-size: 25px;">Item No : <?php echo $list ?></h4>
                                    <?php echo $case; ?>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
			
            <!-- ./Team member -->
			<?php
					}
}
?>
           
       

        </div>
    </div>
</section>
 
					<div class="clear"></div>
				
				
			</article>
			
	
				
	</div><!--/.pad-->
	
</div><!--/.content-->


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<br>
	<?php include "footer.php"; ?>