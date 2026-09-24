<?php
class SLIDFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function slider_register($bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user,$slider_url,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_sliders(
           	bench, slider_name,slider_img, slider_order,slider_up_date,slider_display,mhc_user,slider_url) 
						VALUES(:bench,:slider_name,:slid_img,:slider_ord,:up_date,:display,:mhc_user,:slider_url)returning slider_id");	
			$stmt->bindparam(":bench", $bench);  
			$stmt->bindparam(":slider_name", $slider_name);
			$stmt->bindparam(":slid_img", $slid_img); 
			$stmt->bindparam(":slider_ord", $slider_ord); 
			$stmt->bindparam(":up_date", $up_date);	 
			$stmt->bindparam(":display", $display);	 	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":slider_url", $slider_url);	 	 
			 	 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['slider_id'];
				$message='Added Slider Image';
				$action="INSERT INTO mhc_sliders(
           	bench, slider_name,slider_img, slider_order,slider_up_date,slider_display,mhc_user,slider_url) 
						VALUES($bench,$slider_name,'slid_img',$slider_ord,$up_date,$display,$mhc_user,$slider_url)";
						
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
	
	 public function slider_update($edit_id,$bench,$slider_name,$slid_img,$up_date,$slider_ord,$display,$mhc_user,$slider_url,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_sliders
   SET  bench=:bench,slider_name=:slider_name,slider_img=:slid_img,slider_order=:slider_ord, slider_up_date=:up_date,
   slider_display=:display,mhc_user=:mhc_user,slider_url=:slider_url
 WHERE slider_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":bench", $bench);
			$stmt->bindparam(":slider_name", $slider_name);
			$stmt->bindparam(":slid_img", $slid_img); 
			$stmt->bindparam(":slider_ord", $slider_ord); 
			$stmt->bindparam(":up_date", $up_date);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":slider_url", $slider_url);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Slider Details';
				$action="UPDATE mhc_sliders
   SET  bench=$bench,slider_name=$slider_name,slider_img='slid_img',slider_order=$slider_ord, slider_up_date=$up_date,
   slider_display=$display,mhc_user=$mhc_user,slider_url=$slider_url
 WHERE slider_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function slider_update1($edit_id,$bench,$slider_name,$up_date,$slider_ord,$display,$mhc_user,$slider_url,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_sliders
   SET  bench=:bench,slider_name=:slider_name,slider_order=:slider_ord, slider_up_date=:up_date,
   slider_display=:display,mhc_user=:mhc_user,slider_url=:slider_url
 WHERE slider_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":bench", $bench);
			$stmt->bindparam(":slider_name", $slider_name);
			
			$stmt->bindparam(":slider_ord", $slider_ord); 
			$stmt->bindparam(":up_date", $up_date);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":slider_url", $slider_url);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Slider Details';
				$action="UPDATE mhc_sliders
   SET  bench=$bench,slider_name=$slider_name,slider_order=$slider_ord, slider_up_date=$up_date,
   slider_display=$display,mhc_user=$mhc_user,slider_url=$slider_url
 WHERE slider_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
 public function slid_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_sliders WHERE slider_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Slider Record';
				$action="DELETE FROM mhc_sliders WHERE slider_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function sliddata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_sliders order by slider_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
						$photo='<img src="view_image.php?img_id='.base64_encode($row['slider_id']).'&page='.base64_encode('S').'" weight="50" height="50" />';
					if($row['slider_display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					
					$enctype_id=base64_encode($row['slider_id']);
					$dated=date('d-m-Y',strtotime($row['slider_up_date']));
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['slider_name'].'</td>
                          <td>'.$photo.'</td>
						  <td>'.$row['slider_order'].'</td>
                          <td>'.$dated.'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="slider_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['slider_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
