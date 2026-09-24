<?php
class JUDFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function jud_register($pre_name,$jud_name,$choram,$jud_app_dt,$jud_per_dt,$jud_ele_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$profile,$page,$bd22,$mhc_user,$page_id,$ip,$log_fun,$jud_code,$cj_fdt,$cj_tdt,$j_type)
    {
       try
       {
           
			$stmt = $this->db->prepare("INSERT INTO judges(
           	j_prefix, j_name,j_coram, j_app,j_per,j_elv,j_ret,j_photo,j_sen,j_display,j_profile,j_page,jud_code,cj_fdt,cj_tdt,j_type) 
						VALUES(:pre_name,:jud_name,:choram,:jud_app_dt,:jud_per_dt,:jud_ele_dt, :jud_rel_dt,
						:dp_image,:jud_pri,:display,:profile,:page,:jud_code,:cj_fdt,:cj_tdt,:j_type)returning j_id ");	
			$stmt->bindparam(":pre_name", $pre_name);  
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":choram", $choram); 
			$stmt->bindparam(":jud_app_dt", $jud_app_dt); 
			$stmt->bindparam(":jud_per_dt", $jud_per_dt); 
			$stmt->bindparam(":jud_ele_dt", $jud_ele_dt);	 
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":jud_pri", $jud_pri);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":profile", $profile);	 
			$stmt->bindparam(":page", $page);	 
			$stmt->bindparam(":jud_code", $jud_code);
			$stmt->bindparam(":cj_fdt", $cj_fdt);	
			$stmt->bindparam(":cj_tdt", $cj_tdt);
			$stmt->bindparam(":j_type", $j_type);				
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['j_id'];
				$message='Added Judges Details';
				$action="INSERT INTO judges(
           	j_prefix, j_name,j_coram, j_app,j_per,j_elv,j_ret,j_photo,j_sen,j_display,j_profile,j_page,jud_code,j_type) 
						VALUES($pre_name,$jud_name,$choram,$jud_app_dt,$jud_per_dt,$jud_ele_dt, $jud_rel_dt,
						'dp_image',$jud_pri,$display,$profile,$page,$jud_code,$cj_fdt,$cj_tdt,$j_type)";
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
			}
			
			/*  $sql2= "INSERT INTO judges(j_prefix, j_name,j_coram, j_app,j_per,j_elv,j_ret,j_photo,j_sen,j_display,j_profile,j_page) VALUES('$pre_name','$jud_name','$choram','$jud_app_dt','$jud_per_dt','$jud_ele_dt', '$jud_rel_dt',
						'$dp_image','$jud_pri','$display','$profile','$page')";
			   $stmt = pg_query($bd22,$sql2); */
							
  // echo "<script>alert('data saved".$stmt."');</script>";
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

  public function j_history($j_id,$document_type,$upload_date,$doc_file_size,$doc_file_lan,$base64_doc_up,$doc_doc_display,$bd22,$mhc_user,$page_id,$ip,$log_fun,$doc_file_name)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO judges_doc(
           	j_jud_id, j_doc_type,j_doc_up_date, j_doc_size,j_doc_lan,j_document,j_doc_display,j_doc_name) 
						VALUES(:j_id,:document_type,:upload_date,:doc_file_size,:doc_file_lan,:base64_doc_up,:doc_doc_display,:doc_file_name)returning j_doc_id");	
			$stmt->bindparam(":j_id", $j_id);  
			$stmt->bindparam(":document_type", $document_type);
			$stmt->bindparam(":upload_date", $upload_date);
			$stmt->bindparam(":doc_file_size", $doc_file_size); 
			$stmt->bindparam(":doc_file_lan", $doc_file_lan); 
			$stmt->bindparam(":base64_doc_up", $base64_doc_up); 
			$stmt->bindparam(":doc_doc_display", $doc_doc_display);	 
			$stmt->bindparam(":doc_file_name", $doc_file_name);				
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['j_doc_id'];
				$message='Added Judges Document Details';
				$action="INSERT INTO judges_doc(
           	j_jud_id, j_doc_type,j_doc_up_date, j_doc_size,j_doc_lan,j_doc_display,j_doc_name) 
						VALUES($j_id,$document_type,$upload_date,$doc_file_size,$doc_file_lan$doc_doc_display,$doc_file_name)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
				/* 	 $sql2= "INSERT INTO judges_doc(
           	j_jud_id, j_doc_type,j_doc_up_date, j_doc_size,j_doc_lan,j_document,j_doc_display) 
						VALUES('$j_id','$document_type','$upload_date','$doc_file_size','$doc_file_lan','$base64_doc_up','$doc_doc_display')";
			   $stmt = pg_query($bd22,$sql2);	 */	
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	
	 public function jud_update($edit_id,$pre_name,$jud_name,$coram,$jud_app_dt,$jud_per_dt,$jud_ele_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$profile,$pages,$bd22,$mhc_user,$page_id,$ip,$log_fun,$jud_code,$cj_fdt,$cj_tdt,$j_type,$def_chk)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE judges
   SET  j_prefix=:pre_name,j_name=:jud_name,j_coram=:coram,j_app=:jud_app_dt,
   j_per=:jud_per_dt,j_elv=:jud_ele_dt,j_ret=:jud_rel_dt,j_display=:display, j_photo=:dp_image,j_sen=:jud_pri,j_profile=:profile,j_page=:pages,jud_code=:jud_code, cj_fdt=:cj_fdt,cj_tdt=:cj_tdt,j_type=:j_type  WHERE j_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":pre_name", $pre_name);
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":coram", $coram); 
			$stmt->bindparam(":jud_app_dt", $jud_app_dt); 
			$stmt->bindparam(":jud_per_dt", $jud_per_dt);	 
			$stmt->bindparam(":jud_ele_dt", $jud_ele_dt);	 
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":jud_pri", $jud_pri);	 
			$stmt->bindparam(":profile", $profile);	 
			$stmt->bindparam(":pages", $pages);	 
			$stmt->bindparam(":jud_code", $jud_code);
			$stmt->bindparam(":cj_fdt", $cj_fdt);	
			$stmt->bindparam(":cj_tdt", $cj_tdt);				
			$stmt->bindparam(":j_type", $j_type);
			if($stmt->execute())
			{
				$record_id=$edit_id;
				$message='Update Judges Details and Default flag='.$def_chk;
				$action="UPDATE judges
   SET  j_prefix=$pre_name,j_name=$jud_name,j_coram=$coram,j_app=$jud_app_dt,
   j_per=$jud_per_dt,j_elv=$jud_ele_dt,j_ret=$jud_rel_dt,j_display=$display,
   j_photo='dp_image',j_sen=$jud_pri,j_profile=$profile,j_page=$pages,jud_code=$jud_code,cj_fdt=$cj_fdt,cj_tdt= $cj_tdt,j_type=$j_type 
 WHERE j_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
			}
						
 /*    $sql2= "UPDATE judges
   SET  j_prefix='$pre_name',j_name='$jud_name',j_coram='$coram',j_app='$jud_app_dt',
   j_per='$jud_per_dt',j_elv='$jud_ele_dt',j_ret='$jud_rel_dt',j_display='$display',
   j_photo='$dp_image',j_sen='$jud_pri',j_profile='$profile',j_page='$pages'
 WHERE j_id =$edit_id";
			   $stmt = pg_query($bd22,$sql2);	 */
			   
			   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function jud_update1($edit_id,$pre_name,$jud_name,$coram,$jud_app_dt,$jud_per_dt,$jud_ele_dt,$jud_rel_dt,$display,$jud_pri,$profile,$pages,$bd22,$mhc_user,$page_id,$ip,$log_fun,$jud_code,$cj_fdt,$cj_tdt,$j_type,$def_chk)
    {
       try
       {
   
            $stmt = $this->db->prepare("UPDATE judges
   SET  j_prefix=:pre_name,j_name=:jud_name,j_coram=:coram,j_app=:jud_app_dt,
   j_per=:jud_per_dt,j_elv=:jud_ele_dt,j_ret=:jud_rel_dt,j_display=:display,
   j_sen=:jud_pri,j_profile=:profile,j_page=:pages,jud_code=:jud_code,cj_fdt=:cj_fdt,cj_tdt=:cj_tdt ,j_type=:j_type  
 WHERE j_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":pre_name", $pre_name);
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":coram", $coram); 
			$stmt->bindparam(":jud_app_dt", $jud_app_dt); 
			$stmt->bindparam(":jud_per_dt", $jud_per_dt);	 
			$stmt->bindparam(":jud_ele_dt", $jud_ele_dt);	 
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":display", $display);	 
				 
			$stmt->bindparam(":jud_pri", $jud_pri);	 
			$stmt->bindparam(":profile", $profile);	 
			$stmt->bindparam(":pages", $pages);	 
			$stmt->bindparam(":jud_code", $jud_code);	 
			$stmt->bindparam(":cj_fdt", $cj_fdt);	
			$stmt->bindparam(":cj_tdt", $cj_tdt);	
			$stmt->bindparam(":j_type", $j_type);
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Judges Details and Default flag='.$def_chk;
				$action="UPDATE judges
   SET  j_prefix=$pre_name,j_name=$jud_name,j_coram=$coram,j_app=$jud_app_dt,
   j_per=$jud_per_dt,j_elv=$jud_ele_dt,j_ret=$jud_rel_dt,j_display=$display,
   j_sen=$jud_pri,j_profile=$profile,j_page=$pages,jud_code=$jud_code,cj_fdt=$cj_fdt,cj_tdt= $cj_tdt,j_type=$j_type
 WHERE j_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			
		/* 	error_log("UPDATE judgesSET  j_prefix='$pre_name',j_name='$jud_name',j_coram='$coram',j_app='$jud_app_dt',  j_per='$jud_per_dt',j_elv='$jud_ele_dt',j_ret='$jud_rel_dt',j_display='$display', j_sen='$jud_pri',j_profile='$profile',j_page='$pages' WHERE j_id =$edit_id");
			 $sql2= "UPDATE judges
   SET  j_prefix='$pre_name',j_name='$jud_name',j_coram='$coram',j_app='$jud_app_dt',
   j_per='$jud_per_dt',j_elv='$jud_ele_dt',j_ret='$jud_rel_dt',j_display='$display',
   j_sen='$jud_pri',j_profile='$profile',j_page='$pages'
 WHERE j_id =$edit_id";
			   $stmt = pg_query($bd22,$sql2);	 */
			
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function j_history_update($jud_doc_idd,$j_id,$document_type,$upload_date,$doc_file_size,$doc_file_lan,$base64_doc_up,$doc_doc_display,$bd22,$mhc_user,$page_id,$ip,$log_fun,$doc_file_name)
    {
       try
       {
  
		   		if($base64_doc_up!='')
			{
				
			$stmt = $this->db->prepare("UPDATE judges_doc SET
            j_doc_type=:document_type,j_doc_up_date=:upload_date, j_doc_size=:doc_file_size,j_doc_lan=:doc_file_lan,j_doc_name=:doc_file_name,j_document=:base64_doc_up,j_doc_display=:doc_doc_display WHERE j_doc_id =:jud_doc_idd");	
			$stmt->bindValue(':jud_doc_idd', $jud_doc_idd); 
			$stmt->bindparam(":document_type", $document_type);
			$stmt->bindparam(":upload_date", $upload_date);
			$stmt->bindparam(":doc_file_size", $doc_file_size); 
			$stmt->bindparam(":doc_file_lan", $doc_file_lan); 
			$stmt->bindparam(":base64_doc_up", $base64_doc_up); 
			$stmt->bindparam(":doc_doc_display", $doc_doc_display);	
			$stmt->bindparam(":doc_file_name", $doc_file_name);	 			
			if($stmt->execute())
			{
				
				$record_id=$jud_doc_idd;
				$message='Update Judges Document Upload Details';
				$action="UPDATE judges_doc SET
            j_doc_type=$document_type,j_doc_up_date=$upload_date, j_doc_size=$doc_file_size,j_doc_lan=$doc_file_lan,j_doc_name=$doc_file_name,j_doc_display=$doc_doc_display WHERE j_doc_id =$jud_doc_idd";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			
			}
			else
			{
				
			$stmt = $this->db->prepare("UPDATE judges_doc SET
            j_doc_type=:document_type,j_doc_up_date=:upload_date, j_doc_lan=:doc_file_lan,j_doc_name=:doc_file_name,j_doc_display=:doc_doc_display WHERE j_doc_id =:jud_doc_idd");	
			$stmt->bindValue(':jud_doc_idd', $jud_doc_idd); 
			$stmt->bindparam(":document_type", $document_type);
			$stmt->bindparam(":upload_date", $upload_date);
			$stmt->bindparam(":doc_file_lan", $doc_file_lan); 
			$stmt->bindparam(":doc_doc_display", $doc_doc_display);
			$stmt->bindparam(":doc_file_name", $doc_file_name);	 
			if($stmt->execute())
			{
				
				$record_id=$jud_doc_idd;
				$message='Update Judges Document Details';
				$action="UPDATE judges_doc SET
            j_doc_type=$document_type,j_doc_up_date=$upload_date, j_doc_lan=$doc_file_lan,j_doc_name=$doc_file_name,j_doc_display=$doc_doc_display WHERE j_doc_id =$jud_doc_idd";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			
			}
	 
			
			/* 
					if($base64_doc_up!='')
			{
					 $sql2= "UPDATE judges_doc SET
            j_doc_type='$document_type',j_doc_up_date='$upload_date', j_doc_size='$doc_file_size',j_doc_lan='$doc_file_lan',j_document='$base64_doc_up',j_doc_display='$doc_doc_display' WHERE j_doc_id =$jud_doc_idd AND j_jud_id=$j_id";
			}
			else
			{
				 $sql2= "UPDATE judges_doc SET
            j_doc_type='$document_type',j_doc_up_date='$upload_date', j_doc_lan='$doc_file_lan',j_doc_display='$doc_doc_display' WHERE j_doc_id =$jud_doc_idd AND j_jud_id=$j_id";
			}
			  	
			   $stmt = pg_query($bd22,$sql2);	 */	
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function jud_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM judges WHERE j_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
		  {
			  $stmt2 =  $this->db->prepare("DELETE FROM judges_doc WHERE j_jud_id=:del_id");
          $stmt2->bindValue(':del_id', $del_id, PDO::PARAM_STR);
		  $stmt2->execute();
		  $record_id=$del_id;
				$message='Delete Judges Record';
				$action="DELETE FROM judges WHERE j_id=$del_id and DELETE FROM judges_doc WHERE j_jud_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
		  }
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function juddata($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $sql1 = "SELECT * FROM judges ORDER BY j_sen ASC,j_id desc,j_display desc";
					$exe1 = pg_query($bd22,$sql1);
							$sno=1;
							while($row = pg_fetch_array($exe1))
							{
					
					/* $id_proof_img = pg_unescape_bytea($row['j_photo']);
								$extension ='jpg';
								$fileId = $row['j_id'].'test';
								$filename1 = $fileId . '.' .$extension;
								$fileHandle = fopen($filename1, 'w');
								fwrite($fileHandle, $id_proof_img);
								fclose($fileHandle); */
								
								
					$photo='<img src="view_image.php?img_id='.base64_encode($row['j_id']).'&page='.base64_encode('J').'" weight="50" height="50" />';
					
					$name=$row['j_prefix'].'.'.$row['j_name'];
					if($row['j_display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					
					$enctype_id=base64_encode($row['j_id']);
					if(is_null($row['j_app']))
					{
						$j_app='';
					}
					else
					{
						$j_app='Appointed On : '.date('d-m-Y',strtotime($row['j_app']));
					}
					if(is_null($row['j_per']))
					{
						$j_per='';
					}
					else
					{
						$j_per='Permanent On : '.date('d-m-Y',strtotime($row['j_per']));
					}
					if(is_null($row['j_elv']))
					{
						$j_elv='';
					}
					else
					{
						$j_elv='Elevation On : '.date('d-m-Y',strtotime($row['j_elv']));
					}
					if(is_null($row['j_ret']))
					{
						$j_ret='';
					}
					else
					{
						$j_ret='Relieved On : '.date('d-m-Y',strtotime($row['j_ret']));
					}
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$photo.'</td>
                          <td>'.$name.'</td>
                          <td style="text-align:justify">'.(html_entity_decode(strip_tags($row['j_coram']))).'</td>
                          <td>'.$j_app.'</br>'.$j_per.'</br>'.$j_elv.'</br>'.$j_ret.'</td>
                          
                          <td>'.html_entity_decode($row['j_profile']).'</td>
                          <td>'.$display.'</td>
						  <td>'.$row['j_sen'].'</td>
                          <td class="text-right">
                            <a href="jud_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                           <a href="javascript:removeRow('.$row['j_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
                          </td>
                        </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	} 

public function redirect($url)
   {
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
		
   }
}
?>
