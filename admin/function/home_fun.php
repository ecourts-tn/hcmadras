<?php
class HMEFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function home_insert($title,$desc,$display,$img_thmp,$page_url,$short_des,$order,$page,$ntab,$external,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
            
		
		   
			   
			  
			   
			   $sql2= "INSERT INTO mhc_homepage(home_title,home_desc,display,thumb_img,page_url,short_desc,page_order,page,ntab,external) VALUES('$title','$desc','$display','$img_thmp','$page_url','$short_des','$order','$page','$ntab','$external')returning h_id";		  
 $stmt = pg_query($bd22,$sql2);
			      if($stmt)
			{
				
				$row = pg_fetch_object($stmt);
				$record_id=$row -> h_id;
				$message='Added New Home Details';
				$action="INSERT INTO mhc_homepage(home_title,home_desc,display,thumb_img,page_url,short_desc,page_order,page,ntab,external) VALUES('$title','$desc','$display','img_thmp','$page_url','$short_des','$order','$page','$ntab','$external')";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		    
           
		   
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	
	
	public function home_update($edit_id,$title,$desc,$display,$img_thmp,$page_url,$short_des,$order,$page,$ntab,$external,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
   
        
			
			
			$desc=pg_escape_string($bd22,$desc);
		    if($img_thmp!='')
		    {
				
				$sth = $this->db->prepare('UPDATE mhc_homepage SET  home_desc=:desc where  h_id =:edit_id');
$sth->bindParam(':desc', $desc);
$sth->bindParam(':edit_id', $edit_id);
$sth->execute();
			    $sql2= "UPDATE mhc_homepage SET home_title='$title',home_desc='$desc',display='$display',thumb_img='$img_thmp',page_url='$page_url', short_desc='$short_des', page_order='$order', page='$page',ntab='$ntab', external='$external' WHERE h_id ='$edit_id'";
			   $stmt = pg_query($bd22,$sql2);
			        if($stmt)
			{
				
				$record_id=$edit_id;
				$message='Update Home Details';
				$action="UPDATE mhc_homepage SET home_title='$title',home_desc='$desc',display='$display',thumb_img='img_thmp',page_url='$page_url', short_desc='$short_des', page_order='$order', page='$page',ntab='$ntab', external='$external' WHERE h_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		    }
			else
			{
				$sth = $this->db->prepare('UPDATE mhc_homepage SET  home_desc=:desc where h_id =:edit_id');
$sth->bindParam(':desc', $desc);
$sth->bindParam(':edit_id', $edit_id);
$sth->execute();																										  
				$sql2= "UPDATE mhc_homepage SET home_title='$title',home_desc='$desc',display='$display',page_url='$page_url', short_desc='$short_des', page_order='$order', page='$page',ntab='$ntab', external='$external' WHERE h_id ='$edit_id'";
			    $stmt = pg_query($bd22,$sql2);
				     if($stmt)
			{
				
				
				$record_id=$edit_id;
				$message='Update Home Details';
				$action="UPDATE mhc_homepage SET home_title='$title',home_desc='$desc',display='$display',page_url='$page_url', short_desc='$short_des', page_order='$order', page='$page',ntab='$ntab', external='$external' WHERE h_id ='$edit_id'";
						
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
	
 public function home_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_homepage WHERE h_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
		  {
			  $record_id=$edit_id;
				$message='Delete Home Details';
				$action="DELETE FROM mhc_homepage WHERE h_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
		  }
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function homedata($chkstr,$mhc_user,$page_id,$ip,$log_fun)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_homepage ORDER BY h_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					   $enctype_id=base64_encode($row['h_id']);
					
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
                          <td>'.$row['home_title'].'</td>                         
                          <td>'.$row['up_date'].'</td>                         
                          <td>'.html_entity_decode($row['home_desc']).'</td>
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="home_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                           <a href="javascript:removeRow('.$row['h_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
                          </td>
                        </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	} 
	
	
 public function home_photo_reg($photo_title,$img_thmp,$display,$file_type,$mhc_user,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
            
			
			   
			   $sql2= "INSERT INTO home_gallery(gallery_title,gallery_img,display,upload_type,mhc_user) VALUES('$photo_title','$img_thmp','$display','$file_type','$mhc_user')returning h_gallery_id";
			   $stmt = pg_query($bd22,$sql2);
			   if($stmt)
			{
				
				$row = pg_fetch_object($stmt);
				$record_id=$row -> h_gallery_id;
				$message='Added New Home Gallery Photos';
				$action="INSERT INTO home_gallery(gallery_title,gallery_img,display,upload_type,mhc_user) VALUES('$photo_title','img_thmp','$display','$file_type','$mhc_user')returning h_gallery_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function home_gallery_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM home_gallery WHERE h_gallery_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
		  {
			  
				
				$record_id=$del_id;
				$message='Delete Home Gallery Photos';
				$action="DELETE FROM home_gallery WHERE h_gallery_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
			
		  }
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	public function home_photo_data($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				
					 $stmt = $this->db->prepare("select * from home_gallery ORDER BY h_gallery_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
							
					
					   $enctype_id=base64_encode($row['h_gallery_id']);
					
					if($row['upload_type']=='JPG')
						{
					$img='<img src="view_image.php?img_id='.trim(base64_encode($row['h_gallery_id'])).'&page='.base64_encode('H').'" width="50" height="50"/>';
						}
						else
						{
							//$img='<a  href="javascript:ViewRow(' . $row['h_gallery_id'] . ')" class="btn btn-primary">Document View</a>';
							$img='
							<form method="POST" action="view_pdf.php" target="_blank">
						  <input type="hidden" name="pdf_id" id="pdf_id" value="'.$row['h_gallery_id'].'"/>
						  <input type="hidden" name="page" id="page" value="'.base64_encode("H").'" />
						   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
						  </form>';
						}
					
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
                          <td>'.$row['gallery_title'].'</td>                         
                                                
                          <td>'.$img.'</td>
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="home_gallery_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                           <a href="javascript:removeRow('.$row['h_gallery_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
                          </td>
                        </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	}
public function home_photo_data1($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				
					 $stmt = $this->db->prepare("select * from home_gallery ORDER BY h_gallery_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
							
					
					   $enctype_id=base64_encode($row['h_gallery_id']);
					
					if($row['upload_type']=='JPG')
						{
					$img='<img src="view_image.php?img_id='.trim(base64_encode($row['h_gallery_id'])).'&page='.base64_encode('H').'" width="50" height="50"/>';
					$url='view_image.php?img_id='.trim(base64_encode($row['h_gallery_id'])).'&page='.base64_encode('H');
						}
						else
						{
							//$img='<a  href="javascript:ViewRow(' . $row['h_gallery_id'] . ')" class="btn btn-primary">Document View</a>';
							$img='<form method="POST" action="view_pdf.php" target="_blank">
						  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['h_gallery_id']).'"/>
						  <input type="hidden" name="page" id="page" value="'.base64_encode("H").'" />
						   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
						  </form>';
							$url='view_pdf.php?pdf_id='.trim(base64_encode($row['h_gallery_id'])).'&page='.base64_encode('H');
						}
						
					
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
                          <td>'.$row['gallery_title'].'</td>                         
                                                
                          <td>'.$url.'</td>
                          <td>'.$img.'</td>
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="home_gallery_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                           
                          </td>
                        </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	} 
public function home_photo_update($edit_id,$photo_title,$img_thmp,$display,$mhc_user,$file_type,$bd22,$page_id,$ip,$log_fun)
    {
       try
       {
   
          
		    if($img_thmp!='')
		    {
			   
			    $sql2= "UPDATE home_gallery SET gallery_title='$photo_title',gallery_img='$img_thmp',display='$display',mhc_user='$mhc_user',upload_type='$file_type' WHERE h_gallery_id ='$edit_id'";
			   $stmt = pg_query($bd22,$sql2);
			      if($stmt)
			{
				
				$record_id=$edit_id;
				$message='Update Home Gallery Photos';
				$action="UPDATE home_gallery SET gallery_title='$photo_title',gallery_img='img_thmp',display='$display',mhc_user='$mhc_user',upload_type='$file_type' WHERE h_gallery_id ='$edit_id'";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		    }
			else
			{
				$sql2= "UPDATE home_gallery SET gallery_title='$photo_title',display='$display',mhc_user='$mhc_user',upload_type='$file_type' WHERE h_gallery_id ='$edit_id'";
			    $stmt = pg_query($bd22,$sql2);
				   if($stmt)
			{
				
				$record_id=$edit_id;
				$message='Update Home Gallery Record';
				$action="UPDATE home_gallery SET gallery_title='$photo_title',display='$display',mhc_user='$mhc_user',upload_type='$file_type' WHERE h_gallery_id ='$edit_id'";
						
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
public function redirect($url)
   {
		$delay = "0";
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
		
   }
}
?>
