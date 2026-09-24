<?php
class IMPLINKFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function links_add($link_title,$link_url,$link_display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_importan_link(
           	importan_link_title, importan_link_url,display,mhc_user) 
						VALUES(:link_title,:link_url,:link_display,:mhc_user)returning importan_link_id");	
			$stmt->bindparam(":link_title", $link_title);  
			$stmt->bindparam(":link_url", $link_url);
			$stmt->bindparam(":link_display", $link_display); 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
				 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['importan_link_id'];
				$message='Added New Important Link';
				$action="INSERT INTO mhc_importan_link(
           	importan_link_title, importan_link_url,display,mhc_user) 
						VALUES($link_title,$link_url,$link_display,$mhc_user)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	//Judge Committee
	
	 public function links_update($edit_id,$link_title,$link_url,$link_display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_importan_link
   SET  importan_link_title=:link_title,importan_link_url=:link_url,display=:link_display,mhc_user=:mhc_user
 WHERE importan_link_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":link_title", $link_title);
			$stmt->bindparam(":link_url", $link_url);
			$stmt->bindparam(":link_display", $link_display); 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Important Link';
				$action="UPDATE mhc_importan_link
   SET  importan_link_title=$link_title,importan_link_url=$link_url,display=$link_display,mhc_user=$mhc_user
 WHERE importan_link_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function link_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_importan_link WHERE importan_link_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Important Link';
				$action="DELETE FROM mhc_importan_link WHERE importan_link_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function linkdata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_importan_link order by importan_link_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
					
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">NO<div class="ripple-container"></div></button>';
					}
					
					
					$enctype_id=base64_encode($row['importan_link_id']);
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['importan_link_title'].'</td>
                          <td>'.$row['importan_link_url'].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="important_link_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['importan_link_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
