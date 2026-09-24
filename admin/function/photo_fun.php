<?php
class PHOTOFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function photo_register($photo_title,$photo_year,$img_thmp,$display,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
            
			
			   
			   $sql2= "INSERT INTO mhc_photo(photo_title,photo_year,photo_thm,display,mhc_user) VALUES('$photo_title','$photo_year','$img_thmp','$display','$mhc_user')returning photo_id";
			   $stmt = pg_query($bd22,$sql2);
			   if($stmt)
			{
				
				$row = pg_fetch_object($stmt);
				$record_id=$row -> photo_id;
				$message='Added New Photos';
				$action="INSERT INTO mhc_photo(photo_title,photo_year,photo_thm,display,mhc_user) VALUES('$photo_title','$photo_year','$img_thmp','$display','$mhc_user')";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

  public function photos_reg($photo_id,$photo_name,$base64_doc_up,$photo_display,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
            
			
			   
			   $sql2= "INSERT INTO photo_gallery(photo_id,img_title,images,display) VALUES('$photo_id','$photo_name','$base64_doc_up','$photo_display')returning gallery_id";
			   $stmt = pg_query($bd22,$sql2);
			    if($stmt)
			{
				$row = pg_fetch_object($stmt);
				$record_id=$row -> gallery_id;
				$message='Added Gallery Photos';
				$action="INSERT INTO photo_gallery(photo_id,img_title,images,display) VALUES('$photo_id','$photo_name','base64_doc_up','$photo_display')";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	
	public function photo_update($edit_id,$photo_title,$photo_year,$img_thmp,$display,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
   
         
		    if($img_thmp!='')
		    {
				
			   
			    $sql2= "UPDATE mhc_photo SET photo_title='$photo_title',photo_year='$photo_year',display='$display',photo_thm='$img_thmp',mhc_user='$mhc_user' WHERE photo_id ='$edit_id'";
			   $stmt = pg_query($bd22,$sql2);
			   if($stmt)
			{
				
				$record_id=$edit_id;
				$message='Update Photos';
				$action="UPDATE mhc_photo SET photo_title='$photo_title',photo_year='$photo_year',display='$display',photo_thm='$img_thmp',mhc_user='$mhc_user' WHERE photo_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		    }
			else
			{
				$sql2= "UPDATE mhc_photo SET photo_title='$photo_title',photo_year='$photo_year',display='$display',mhc_user='$mhc_user' WHERE photo_id ='$edit_id'";
			    $stmt = pg_query($bd22,$sql2);
				   if($stmt)
			{
				
				$record_id=$edit_id;
				$message='Update  Photos';
				$action="UPDATE mhc_photo SET photo_title='$photo_title',photo_year='$photo_year',display='$display',mhc_user='$mhc_user' WHERE photo_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			}
		  
           return $stmt; 
		   
		   
		   
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function gallery_update($gallery_id,$photo_id,$photo_name,$base64_doc_up,$photo_display,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
                if($gallery_id!='')
				{
         //error_log('ehaiiiiiiiii'.$gallery_id);
		    if($base64_doc_up!='')
		    {
				///error_log('ehaiiiiiiiii'.$base64_doc_up);
			 
			    $sql2= "UPDATE photo_gallery SET img_title='$photo_name',display='$photo_display',images='$base64_doc_up' WHERE gallery_id ='$gallery_id'";
			   $stmt = pg_query($bd22,$sql2);
			      if($stmt)
			{
				
				$record_id=$gallery_id;
				$message='Update Gallery Photos';
				$action="UPDATE photo_gallery SET img_title='$photo_name',display='$photo_display',images='base64_doc_up' WHERE gallery_id ='$gallery_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		    }
			else
			{
				// error_log('shaiiiiiiiii'.$base64_doc_up);
				$sql2= "UPDATE photo_gallery SET img_title='$photo_name',display='$photo_display' WHERE gallery_id ='$gallery_id'";
			    $stmt = pg_query($bd22,$sql2);
				if($stmt)
			{
				
				$record_id=$gallery_id;
				$message='Update Gallery Photos';
				$action="UPDATE photo_gallery SET img_title='$photo_name',display='$photo_display' WHERE gallery_id ='$gallery_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			}
				}
				else
				{
					$sql2= "INSERT INTO photo_gallery(photo_id,img_title,images,display) VALUES('$photo_id','$photo_name','$base64_doc_up','$photo_display')returning gallery_id";
			   $stmt = pg_query($bd22,$sql2);
			   	if($stmt)
			{
				
				$row = pg_fetch_object($stmt);
				$record_id=$row -> gallery_id;
				$message='Added Gallery Images';
				$action="INSERT INTO photo_gallery(photo_id,img_title,images,display) VALUES('$photo_id','$photo_name','base64_doc_up','$photo_display')";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
			}
           return $stmt; 
				}
		  
           return $stmt; 
		   
		   
		   
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function photo_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_photo WHERE photo_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
		  {
			  
				
				$record_id=$del_id;
				$message='Delete Photos';
				$action="DELETE FROM mhc_photo WHERE photo_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			
			
			  $stmt2 =  $this->db->prepare("DELETE FROM photo_gallery WHERE photo_id=:del_id");
          $stmt2->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt2->execute())
		  {
			  $record_id=$del_id;
				$message='Delete Gallery Photos ';
				$action="DELETE FROM photo_gallery WHERE photo_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
		  }
		  }
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function photodata($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				
					 $stmt = $this->db->prepare("select * from mhc_photo ORDER BY photo_id ASC");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
								/* $id_proof_img = pg_unescape_bytea($row['photo_thm']);
								$extension ='jpg';
								$fileId = $row['photo_id'].'test';
								$filename1 = $fileId . '.' .$extension;
								$fileHandle = fopen($filename1, 'w');
								fwrite($fileHandle, $id_proof_img);
								fclose($fileHandle); */
					
					   $enctype_id=base64_encode($row['photo_id']);
					
					$img='<img src="view_image.php?img_id='.trim(base64_encode($row['photo_id'])).'&page='.base64_encode('P').'" width="50" height="50"/>';
					
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
                          <td>'.$row['photo_title'].'</td>                         
                          <td>'.$row['photo_year'].'</td>                         
                          <td>'.$img.'</td>
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="photo_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                           <a href="javascript:removeRow('.$row['photo_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
