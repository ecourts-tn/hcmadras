<?php

 
class MEETINGFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
	  
    }
	
//User Register
	
	 public function meeting_register($meeting_title,$meeting_judges,$meeting_date,$img_thmp,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
            
		   
			$stmt = $this->db->prepare("INSERT INTO mhc_metting_files(meeting_title,meeting_judges,meeting_date,meeting_file,display,mhc_user) VALUES(:meeting_title,:meeting_judges,:meeting_date,:img_thmp,:display,:mhc_user)returning files_id");				
			$stmt->bindparam(":meeting_title", $meeting_title);			
			$stmt->bindparam(":meeting_judges", $meeting_judges);	 			
			$stmt->bindparam(":meeting_date", $meeting_date);	 			
			$stmt->bindparam(":img_thmp", $img_thmp);	 			
			$stmt->bindparam(":display", $display);	 			 			
			$stmt->bindparam(":mhc_user", $mhc_user);	 			
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['files_id'];
				$message='Added Meeting Files';
				$action="INSERT INTO mhc_metting_files(meeting_title,meeting_judges,meeting_date,meeting_file,display,mhc_user)VALUES($meeting_title,$meeting_judges,$meeting_date,$img_thmp,$display,$mhc_user)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	
	
	public function meeting_update($edit_id,$meeting_title,$meeting_judges,$meeting_date,$img_thmp,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
        
		    if($img_thmp!='')
		    {
			$stmt = $this->db->prepare("UPDATE mhc_metting_files SET meeting_title=:meeting_title,meeting_judges=:meeting_judges,meeting_date=:meeting_date,meeting_file=:img_thmp,display=:display,mhc_user=:mhc_user WHERE files_id =:edit_id");
			$stmt->bindValue(':edit_id', $edit_id);			
			$stmt->bindparam(":meeting_title", $meeting_title);			
			$stmt->bindparam(":meeting_judges", $meeting_judges);	 			
			$stmt->bindparam(":meeting_date", $meeting_date);	 			
			$stmt->bindparam(":img_thmp", $img_thmp);	 				
			$stmt->bindparam(":display", $display);	 			
			$stmt->bindparam(":mhc_user", $mhc_user);	 			
			if($stmt->execute())
			{
				$record_id=$edit_id;
				$message='Update Meeting Files';
				$action="UPDATE mhc_metting_files SET meeting_title=$meeting_title,meeting_judges=$meeting_judges,meeting_date=$meeting_date,meeting_file=$img_thmp,display=$display,mhc_user=$mhc_user WHERE files_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			    
		    }
			else
			{
				$stmt = $this->db->prepare("UPDATE mhc_metting_files SET meeting_title=:meeting_title,meeting_judges=:meeting_judges,meeting_date=:meeting_date,display=:display,mhc_user=:mhc_user WHERE files_id =:edit_id");
			$stmt->bindValue(':edit_id', $edit_id);			
			$stmt->bindparam(":meeting_title", $meeting_title);			
			$stmt->bindparam(":meeting_judges", $meeting_judges);	 			
			$stmt->bindparam(":meeting_date", $meeting_date);	 			
				 				
			$stmt->bindparam(":display", $display);	 			
			$stmt->bindparam(":mhc_user", $mhc_user);		 			
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Videos';
				$action="UPDATE mhc_metting_files SET meeting_title=$meeting_title,meeting_judges=$meeting_judges,meeting_date=$meeting_date,display=$display,mhc_user=$mhc_user WHERE files_id =$edit_id";
						
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
	
 public function meeting_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_metting_files WHERE files_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Meeting Files';
				$action="DELETE FROM mhc_metting_files WHERE files_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function meetingdata($chkstr,$bd22,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				
							
							 $stmt = $this->db->prepare("SELECT * FROM mhc_metting_files");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
								
								
								//$img='<img src="pdf_image.php?img_id='.trim($row['files_id']).'&page=M" width="50" height="50"/>';
								
								
					   $enctype_id=base64_encode($row['files_id']);
					
						if($row['display']=='Y')
						{
							$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
						}
						else
						{
							$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
						}
						$jud_data=explode(',',$row['meeting_judges']);
						$jud_name='';
						foreach($jud_data as $key)
						{
							//error_log("select j_id,j_name,j_coram,j_prefix from judges where j_page='PJ' AND j_display='Y' and j_id='".$key."' order by j_sen asc");
						$jud_qry = $this->db->prepare("select j_id,j_name,j_coram,j_prefix from judges where j_page='PJ' AND j_display='Y' and j_id=:key order by j_sen asc"); 
						$jud_qry->bindParam(':key',$key);
						$jud_qry->execute();
										$jud_result = $jud_qry->fetch();
										
										$hon="Hon'ble ";
											$prefi=$jud_result['j_prefix'];
			
											$coram=$jud_result['j_coram'];
											$name=$jud_result['j_name'];
											
	if($coram=='CJ')
	{
		$fjudge=', Chief Justice';
		
	}else
	{
		
		$fjudge='';
	}
	
	$jud_name .=$hon.$prefi.".Justice ".$name.$fjudge.',</br>';
	
										
										
										}
										
										
										
										$meeting_date=date('d-m-Y',strtotime($row['meeting_date']));
										//$meeting_file='<a  href="javascript:ViewRow(' . $row['files_id'] . ')" class="btn btn-primary">Meeting Files</a>';
										$meeting_file='<a  href="view_pdf.php?pdf_id='.base64_encode($row['files_id']).'&page='.base64_encode('M').'" class="btn btn-primary" target="_blank">Meeting Files</a>';
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['meeting_title'].'</td>                         
                          <td>'. trim($jud_name) .'</td>                         
                          <td>'.$meeting_date.'</td>
                          <td>'.$meeting_file.'</td>
      
                          <td>'.$display.'</td>						  
                          <td class="text-right">
                            <a href="meeting_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['files_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
