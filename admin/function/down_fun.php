<?php
class DOWNFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function down_register($down_title,$down_pdf,$date_up,$down_type,$down_url,$down_order,$detected_type,$filename,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun)
    {
       try
       {
			$stmt = $this->db->prepare("INSERT INTO mhc_downloads(
           	down_title, down_file,down_url, upload_date,display,mhc_user,down_order,d_size,d_app,d_language,new_icon,down_type,down_file_name,mime_type) 
						VALUES(:down_title,:down_pdf,:down_url,:date_up,:display,:mhc_user,:down_order,:dow_size,:app_os,:lang,:new_icon,:down_type,:down_file_name,:mime_type)returning download_id");	
			$stmt->bindparam(":down_title", $down_title);  
			$stmt->bindparam(":down_pdf", $down_pdf);
			$stmt->bindparam(":down_url", $down_url); 
			$stmt->bindparam(":down_type", $down_type); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":down_order", $down_order);	 	 
			$stmt->bindparam(":dow_size", $dow_size);	 	 
			$stmt->bindparam(":app_os", $app_os);	 	 
			$stmt->bindparam(":lang", $lang);	 	 
			$stmt->bindparam(":new_icon", $new_icon);
			$stmt->bindparam(":down_file_name", $filename);
			$stmt->bindparam(":mime_type", $detected_type);			
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['download_id'];
				$message='Added Downloads Details';
				$action="INSERT INTO mhc_downloads(
           	down_title, down_file,down_type,down_url, upload_date,display,mhc_user,down_order,d_size,d_app,d_language,new_icon,down_file_name,mime_type) 
						VALUES($down_title,'down_pdf',$down_type,$down_url,$date_up,$display,$mhc_user,$down_order,$dow_size,$app_os,$lang,$new_icon,$filename,$detected_type)";
						
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
	
	 public function down_update($edit_id,$down_title,$doc_pdf,$icon_img,$date_up,$down_url,$down_order,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_downloads
   SET  down_title=:down_title,down_file=:doc_pdf,down_url=:down_url,upload_date=:date_up, icon=:icon_img,
   display=:display,down_order=:down_order,d_size=:dow_size,d_app=:app_os,
   d_language=:lang,new_icon=:new_icon
 WHERE download_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":down_title", $down_title);
			$stmt->bindparam(":doc_pdf", $doc_pdf);
			$stmt->bindparam(":down_url", $down_url); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":icon_img", $icon_img);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":down_order", $down_order);	 
			$stmt->bindparam(":dow_size", $dow_size);	 
			$stmt->bindparam(":app_os", $app_os);	 
			$stmt->bindparam(":lang", $lang);	 
			$stmt->bindparam(":new_icon", $new_icon);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Downloads Details';
				$action="UPDATE mhc_downloads
   SET  down_title=$down_title,down_file='doc_pdf',down_url=$down_url,upload_date=$date_up, icon=$icon_img,
   display=$display,down_order=$down_order,d_size=$dow_size,d_app=$app_os,
   d_language=$lang,new_icon=$new_icon
 WHERE download_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function down_update1($edit_id,$down_title,$doc_pdf,$date_up,$down_type,$down_url,$down_order,$filename,$detected_type,$display,$mhc_user,$dow_size,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_downloads
   SET  down_title=:down_title,down_file=:doc_pdf,down_url=:down_url,down_type=:down_type,upload_date=:date_up,
   display=:display,down_order=:down_order,d_size=:dow_size,d_app=:app_os,
   d_language=:lang,new_icon=:new_icon, down_file_name=:filename, mime_type=:detected_type 
 WHERE download_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":down_title", $down_title);
			$stmt->bindparam(":doc_pdf", $doc_pdf);
			$stmt->bindparam(":down_url", $down_url); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":down_type", $down_type); 	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":down_order", $down_order);	 
			$stmt->bindparam(":dow_size", $dow_size);	 
			$stmt->bindparam(":app_os", $app_os);	 
			$stmt->bindparam(":lang", $lang);	 
			$stmt->bindparam(":new_icon", $new_icon);
			$stmt->bindparam(":filename", $filename);
			$stmt->bindparam(":detected_type", $detected_type);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Downloads Details';
				$action="UPDATE mhc_downloads
   SET  down_title=$down_title,down_file='doc_pdf',down_url=$down_url,down_type=$down_type,upload_date=$date_up,
   display=$display,down_order=$down_order,d_size=$dow_size,d_app=$app_os,
   d_language=$lang,new_icon=$new_icon,down_file_name=$filename,mime_type=$detected_type 
 WHERE download_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function down_update2($edit_id,$down_title,$icon_img,$date_up,$down_url,$down_order,$display,$mhc_user,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_downloads
   SET  down_title=:down_title,down_url=:down_url,upload_date=:date_up, icon=:icon_img,
   display=:display,down_order=:down_order,d_app=:app_os,
   d_language=:lang,new_icon=:new_icon
 WHERE download_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":down_title", $down_title);
			
			$stmt->bindparam(":down_url", $down_url); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":icon_img", $icon_img);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":down_order", $down_order);	 
 $stmt->bindparam(":app_os", $app_os);	 
			$stmt->bindparam(":lang", $lang);	 
			$stmt->bindparam(":new_icon", $new_icon);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Downloads Details';
				$action="UPDATE mhc_downloads
   SET  down_title=$down_title,down_url=$down_url,upload_date=$date_up, icon=$icon_img,
   display=$display,down_order=$down_order,d_app=$app_os,
   d_language=$lang,new_icon=$new_icon
 WHERE download_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function down_update3($edit_id,$down_title,$date_up,$down_type,$down_url,$down_order,$display,$mhc_user,$app_os,$lang,$new_icon,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_downloads
   SET  down_title=:down_title,down_url=:down_url,down_type=:down_type,upload_date=:date_up, 
   display=:display,down_order=:down_order,d_app=:app_os,
   d_language=:lang,new_icon=:new_icon
 WHERE download_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":down_title", $down_title);
			$stmt->bindparam(":down_type", $down_type); 
			$stmt->bindparam(":down_url", $down_url); 
			$stmt->bindparam(":date_up", $date_up); 
				 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":down_order", $down_order);	 
			$stmt->bindparam(":app_os", $app_os);	 
			$stmt->bindparam(":lang", $lang);	 
			$stmt->bindparam(":new_icon", $new_icon);
		if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Downloads Details';
				$action="UPDATE mhc_downloads
   SET  down_title=$down_title,down_url=$down_url,upload_date=$date_up, down_type=$down_type,
   display=$display,down_order=$down_order,d_app=$app_os,
   d_language=$lang,new_icon=$new_icon
 WHERE download_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function down_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_downloads WHERE download_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Downloads Record';
				$action="DELETE FROM mhc_downloads WHERE download_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function downdata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_downloads order by download_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
						$photo='<img src="view_image.php?img_id='.base64_encode($row['download_id']).'&page='.base64_encode('O').'" weight="50" height="50" />';
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					/*if($row['down_type']=="link")
					{
						$view='<a  href="'.$row['down_url'].'" class="btn btn-primary" target="_blank">Open Link</a>';
					}
					else if($row['down_type']=="pdf")
					{
						$view='<a  href="view_pdf.php?pdf_id='.base64_encode($row['download_id']).'&page='.base64_encode('O').'" class="btn btn-primary" target="_blank">View Document</a>';
					}
					else
					{
						$view='<a  href="#" class="btn btn-primary" > Application File</a>';
					}*/
					if($row['down_type']=="link")
					{
						$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'},function() {window.open('".$row['down_url']."', '_blank');})";
						$view='<a  href="#" class="btn btn-primary" onclick="'.$alt.'">Open Link</a>';
						//$view='<a  href="'.$row['down_url'].'" class="btn btn-primary" target="_blank">Open Link</a>';
					}
					else if($row['down_type']=="pdf")
					{
						$view='<form method="POST" action="view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['download_id']).'"/>
	  <input type="hidden" name="page" id="page" value="'.base64_encode("O").'" />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
	  </form>';
					}
					else
					{
						$alt="swal({
  title: 'Are you sure?',
  text: 'Do you want to download this file!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonClass: 'btn-danger',
  confirmButtonText: 'Yes, download it!',
  closeOnConfirm: true
},
function(){
	window.open('../get_download.php?down_id=".$row['download_id']."', '_parent');
}	
);";
						$view='<a  href="#"  class="btn btn-primary" onclick="'.$alt.'" >Application File</a>';
						
					}
					$enctype_id=base64_encode($row['download_id']);
					
					$dated=date('d-m-Y',strtotime($row['upload_date']));
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['down_title'].'</td>
                          
                          <td>'.$dated.'</td>
                          <td>'.$view.'</td>
                          
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="down_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['download_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
