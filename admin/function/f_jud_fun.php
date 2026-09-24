<?php
class FJUDFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function f_jud_register($pre_name,$jud_name,$jud_app_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$bd22,$mhc_user,$page_id,$ip,$log_fun,$fj_fyr,$fj_tyr)
    {
       try
       {
           
			$stmt = $this->db->prepare("INSERT INTO former_judges(
           	j_prefix, j_name,j_app,j_ret,j_photo,j_sen,j_display,fj_fyr,fj_tyr) 
						VALUES(:pre_name,:jud_name,:jud_app_dt, :jud_rel_dt,
						:dp_image,:jud_pri,:display,:fj_fyr,:fj_tyr)returning j_id ");	
			$stmt->bindparam(":pre_name", $pre_name);  
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":jud_app_dt", $jud_app_dt); 	 
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":jud_pri", $jud_pri);	 
			$stmt->bindparam(":display", $display);	  
			$stmt->bindparam(":fj_fyr", $fj_fyr);	
			$stmt->bindparam(":fj_tyr", $fj_tyr);				
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['j_id'];
				$message='Added Former Judges Details';
				$action="INSERT INTO former_judges(
           	j_prefix, j_name, j_app,j_ret,j_photo,j_sen,j_display,fj_fyr,fj_tyr) 
						VALUES($pre_name,$jud_name,$jud_app_dt, $jud_rel_dt,
						$dp_image,$jud_pri,$display,$fj_fyr,$fj_tyr)";
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
			}
			
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }


	
	
	 public function f_jud_update($edit_id,$pre_name,$jud_name,$jud_app_dt,$jud_rel_dt,$display,$dp_image,$jud_pri,$bd22,$mhc_user,$page_id,$ip,$log_fun,$fj_fyr,$fj_tyr,$def_chk)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE former_judges
   SET  j_prefix=:pre_name,j_name=:jud_name,j_app=:jud_app_dt,
   j_ret=:jud_rel_dt,j_display=:display, j_photo=:dp_image,j_sen=:jud_pri,fj_fyr=:fj_fyr,fj_tyr=:fj_tyr WHERE j_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":pre_name", $pre_name);
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":jud_app_dt", $jud_app_dt);  
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":jud_pri", $jud_pri);	 
			$stmt->bindparam(":fj_fyr", $fj_fyr);	
			$stmt->bindparam(":fj_tyr", $fj_tyr);	
			if($stmt->execute())
			{
				$record_id=$edit_id;
				$message='Update Former Judges Details and Default flag='.$def_chk;
				$action="UPDATE former_judges
   SET  j_prefix=$pre_name,j_name=$jud_name,j_app=$jud_app_dt,
   j_ret=$jud_rel_dt,j_display=$display,
   j_photo=$dp_image,j_sen=$jud_pri,fj_fyr=$fj_fyr,fj_tyr= $fj_tyr
 WHERE j_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
			}

			   
			   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function f_jud_update1($edit_id,$pre_name,$jud_name,$jud_app_dt,$jud_rel_dt,$display,$jud_pri,$bd22,$mhc_user,$page_id,$ip,$log_fun,$fj_fyr,$fj_tyr,$def_chk)
    {
       try
       {
   
            $stmt = $this->db->prepare("UPDATE former_judges SET j_prefix=:pre_name,j_name=:jud_name,j_app=:jud_app_dt,j_ret=:jud_rel_dt,j_display=:display,j_sen=:jud_pri,fj_fyr=:fj_fyr,fj_tyr=:fj_tyr  WHERE j_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":pre_name", $pre_name);
			$stmt->bindparam(":jud_name", $jud_name);
			$stmt->bindparam(":jud_app_dt", $jud_app_dt);  
			$stmt->bindparam(":jud_rel_dt", $jud_rel_dt);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":jud_pri", $jud_pri);	 	 
			$stmt->bindparam(":fj_fyr", $fj_fyr);	
			$stmt->bindparam(":fj_tyr", $fj_tyr);	
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Former Judges Details and Default flag='.$def_chk;
				$action="UPDATE judges
   SET  j_prefix=$pre_name,j_name=$jud_name,j_app=$jud_app_dt,j_ret=$jud_rel_dt,j_display=$display,
   j_sen=$jud_pri,fj_fyr=$fj_fyr,fj_tyr= $fj_tyr WHERE j_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			
		
			
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 public function f_jud_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM former_judges WHERE j_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
		  {
		  $record_id=$del_id;
				$message='Delete Former Judges Record';
				$action="DELETE FROM former_judges WHERE j_id=$del_id ";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
		  }
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function f_juddata($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $sql1 = "SELECT * FROM former_judges ORDER BY j_sen desc";
					$exe1 = pg_query($bd22,$sql1);
							$sno=1;
							while($row = pg_fetch_array($exe1))
							{
					
								
								
					$photo='<img src="view_image.php?img_id='.base64_encode($row['j_id']).'&page='.base64_encode('FJ').'" weight="50" height="50" />';
					
					$name=$row['j_prefix'].'.'.$row['j_name'];
					if($row['j_display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					$period='';
					if( !is_null($row['fj_fyr']) and $row['fj_fyr']!='' )
						$period=$row['fj_fyr'];
					$period.='-';
					if( !is_null($row['fj_tyr']) and $row['fj_tyr']!='' )
						$period.=$row['fj_tyr'];
						
					$enctype_id=base64_encode($row['j_id']);
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$photo.'</td>
                          <td>'.$name.'</td>
						  <td>'.$period.'</td>
                          <td>'.$display.'</td>
						  <td>'.$row['j_sen'].'</td>
                          <td class="text-right">
                            <a href="f_jud_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
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
