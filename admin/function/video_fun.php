<?php

 
class VIDEOFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
	  
    }
	
//User Register
	
	 public function video_register($video_title,$video_url,$video_order,$video_type,$img_thmp,$display,$mhc_user,$cur_date,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
            
			
			   
			  /*  $sql2= "INSERT INTO mhc_videos(video_title,video_url,video_order,video_image,video_date,video_type,display,updateuser) VALUES('$video_title','$video_url','$video_order','$img_thmp','$cur_date','$video_type','$display','$mhc_user')";
			   $stmt = pg_query($bd22,$sql2); */
		    
           
		   /*  echo "INSERT INTO mhc_homepage(home_title,home_desc,display,thumb_img) VALUES('$title','$desc','$display','$thumb_img')"; */
		   
			$stmt = $this->db->prepare("INSERT INTO mhc_videos(video_title,video_url,video_order,video_image,video_date,video_type,display,updateuser) VALUES(:video_title,:video_url,:video_order,:img_thmp,:cur_date,:video_type,:display,:mhc_user)returning video_id");				
			$stmt->bindparam(":video_title", $video_title);			
			$stmt->bindparam(":video_url", $video_url);	 			
			$stmt->bindparam(":video_order", $video_order);	 			
			$stmt->bindparam(":img_thmp", $img_thmp);	 			
			$stmt->bindparam(":cur_date", $cur_date);	 			
			$stmt->bindparam(":video_type", $video_type);	 			
			$stmt->bindparam(":display", $display);	 			
			$stmt->bindparam(":mhc_user", $mhc_user);	 			
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['video_id'];
				$message='Added New Videos';
				$action="INSERT INTO mhc_videos(video_title,video_url,video_order,video_image,video_date,video_type,display,updateuser) VALUES($video_title,$video_url,$video_order,'img_thmp',$cur_date,$video_type,$display,$mhc_user)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	
	
	public function video_update($edit_id,$video_title,$video_url,$video_order,$video_type,$img_thmp,$display,$mhc_user,$cur_date,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
   
        
		    if($img_thmp!='')
		    {
			$stmt = $this->db->prepare("UPDATE mhc_videos SET video_title=:video_title,video_url=:video_url,video_order=:video_order,video_type=:video_type,display=:display,video_image=:img_thmp,updateuser=:mhc_user WHERE video_id =:edit_id");
			$stmt->bindValue(':edit_id', $edit_id);			
			$stmt->bindparam(":video_title", $video_title);			
			$stmt->bindparam(":video_url", $video_url);	 			
			$stmt->bindparam(":video_order", $video_order);	 			
			$stmt->bindparam(":img_thmp", $img_thmp);	 			
				 			
			$stmt->bindparam(":video_type", $video_type);	 			
			$stmt->bindparam(":display", $display);	 			
			$stmt->bindparam(":mhc_user", $mhc_user);	 			
			if($stmt->execute())
			{
				$record_id=$edit_id;
				$message='Update Videos';
				$action="UPDATE mhc_videos SET video_title='$video_title',video_url='$video_url',video_order='$video_order',video_type='$video_type',display='$display',video_image='img_thmp',updateuser='$mhc_user' WHERE video_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			    /* $sql2= "UPDATE mhc_videos SET video_title='$video_title',video_url='$video_url',video_order='$video_order',video_type='$video_type',display='$display',video_image='$img_thmp' WHERE video_id ='$edit_id'";
			   $stmt = pg_query($bd22,$sql2); */
		    }
			else
			{
				$stmt = $this->db->prepare("UPDATE mhc_videos SET video_title=:video_title,video_url=:video_url,video_order=:video_order,video_type=:video_type,display=:display,updateuser=:mhc_user WHERE video_id =:edit_id");
			$stmt->bindValue(':edit_id', $edit_id);			
			$stmt->bindparam(":video_title", $video_title);			
			$stmt->bindparam(":video_url", $video_url);	 			
			$stmt->bindparam(":video_order", $video_order);	 			
			 			
			 			
			$stmt->bindparam(":video_type", $video_type);	 			
			$stmt->bindparam(":display", $display);	 			
			$stmt->bindparam(":mhc_user", $mhc_user);	 			
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Videos';
				$action="UPDATE mhc_videos SET video_title='$video_title',video_url='$video_url',video_order='$video_order',video_type='$video_type',display='$display',updateuser='$mhc_user' WHERE video_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
				/* $sql2= "UPDATE mhc_videos SET video_title='$video_title',video_url='$video_url',video_order='$video_order',video_type='$video_type',display='$display' WHERE video_id ='$edit_id'";
			    $stmt = pg_query($bd22,$sql2); */
			}
		  
		   
		   
		  
           /* $stmt = $this->db->prepare("UPDATE mhc_homepage SET  home_title=:title,home_desc=:desc,display=:display WHERE h_id =:edit_id");            
		   $stmt->bindValue(':edit_id', $edit_id); 			
		   $stmt->bindparam(":title", $title);			
		   $stmt->bindparam(":desc", $desc);	 
		   $stmt->bindparam(":display", $display);	 
		   $stmt->execute();*/ 
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
				

				
							
							 $stmt = $this->db->prepare("SELECT * FROM mhc_videos order by video_id desc");
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
