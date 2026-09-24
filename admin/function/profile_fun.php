<?php

 
class PROFILEFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
	  
    }
	
//User Register

	public function profile_update($rti_user,$rti_menu_id,$name,$dob_date,$email_id,$img_thmp,$gender,$proof_type,$proof_img,$profession,$lives_in,$address,$page_id,$ip,$log_fun)
    {
       try
       {
   
        $profile_status='Y';
		    if($img_thmp!='')
		    {
			$stmt = $this->db->prepare("UPDATE mhc_rti_users SET menu_id=:rti_menu_id,full_name=:name,dob=:dob_date,email_id=:email_id,photo=:img_thmp,gender=:gender,id_proof_type=:proof_type,upload_id_proof=:proof_img,profession=:profession ,lives_in=:lives_in,address=:address,profile_status=:profile_status WHERE rti_user_id =:rti_user");
			$stmt->bindValue(':rti_user', $rti_user);			
			$stmt->bindparam(":rti_menu_id", $rti_menu_id);			
			$stmt->bindparam(":name", $name);	 			
			$stmt->bindparam(":dob_date", $dob_date);	 			
			$stmt->bindparam(":email_id", $email_id);	 			
			$stmt->bindparam(":img_thmp", $img_thmp);	 			
			$stmt->bindparam(":gender", $gender);	 			
			$stmt->bindparam(":proof_type", $proof_type);	 			
			$stmt->bindparam(":proof_img", $proof_img);	 			
			$stmt->bindparam(":profession", $profession);	 			
			$stmt->bindparam(":lives_in", $lives_in);	 			
			$stmt->bindparam(":address", $address);	 			
			$stmt->bindparam(":profile_status", $profile_status);	 			
			if($stmt->execute())
			{
				$record_id=$rti_user;
				$message='Update RTI User';
				$action="UPDATE mhc_rti_users SET menu_id=$rti_menu_id,full_name=$name,dob=$dob_date,email_id=$email_id,photo=$img_thmp,gender=$gender,id_proof_type=$proof_type,upload_id_proof=$proof_img,profession=$profession ,lives_in=$lives_in,address=$address,profile_status=$profile_status WHERE rti_user_id =$rti_user";
						
						$logs=$log_fun->user_logs($rti_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			    
		    }
			
           return $stmt; 
		   
		   
		   
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
 public function video_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_videos WHERE video_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Videos';
				$action="DELETE FROM mhc_videos WHERE video_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function videodata($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				
							
							 $stmt = $this->db->prepare("SELECT * FROM mhc_videos");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
								/* $id_proof_img = pg_unescape_bytea($row['video_image']);
								$extension ='jpg';
								$fileId = $row['video_id'].'test';
								$filename1 = $fileId . '.' .$extension;
								$fileHandle = fopen($filename1, 'w');
								fwrite($fileHandle, $id_proof_img);
								fclose($fileHandle); */
								
								$img='<img src="view_image.php?img_id='.trim(base64_encode($row['video_id'])).'&page='.base64_encode('V').'" width="50" height="50"/>';
					   $enctype_id=base64_encode($row['video_id']);
					
						if($row['display']=='Y')
						{
							$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
						}
						else
						{
							$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
						}
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['video_title'].'</td>                         
                          <td>'.$row['video_url'].'</td>                         
                          <td>'.$img.'</td>
                          <td>'.$row['video_order'].'</td>
                          <td>'.$row['video_type'].'</td>
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="video_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['video_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
