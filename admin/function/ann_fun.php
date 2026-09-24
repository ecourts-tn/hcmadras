<?php
class ANNFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function ann_register($ann_lable,$ann_title,$ann_pdf,$ann_size,$date_up,$exp_dt,$ann_lan,$ann_order,$display,$new,$mhc_user,$icon_img,$page_id,$ip,$log_fun,$ann_link,$elink)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO announcement(
           	an_label, an_text, an_pdf_size,an_pdf_lanuage,an_update_date,an_new_icon,an_archive,display,updateuser,an_order,
			an_icon_img,ann_link,external_link) 
						VALUES(:ann_lable,:ann_title,:ann_size,:ann_lan,:date_up,:new,:exp_dt,:display,
						:mhc_user,:ann_order,:icon_img,:ann_link,:elink)returning an_id");	
			$stmt->bindparam(":ann_lable", $ann_lable);  
			$stmt->bindparam(":ann_title", $ann_title);
			
			$stmt->bindparam(":ann_size", $ann_size); 
			$stmt->bindparam(":ann_lan", $ann_lan);	 
			$stmt->bindparam(":date_up", $date_up);	 	 
			$stmt->bindparam(":new", $new);	 	 
			$stmt->bindparam(":exp_dt", $exp_dt);	 	 
			$stmt->bindparam(":display", $display);	 	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":ann_order", $ann_order);	 	 
			$stmt->bindparam(":icon_img", $icon_img);	
			$stmt->bindparam(":ann_link", $ann_link);
			$stmt->bindparam(":elink", $elink);			
			if($stmt->execute())
			{
				
				$row = $stmt->fetch();
				$record_id=$row['an_id'];
				
					$stmt1 = $this->db->prepare("INSERT INTO announcement_file(
           	announc_id,an_pdf) 
						VALUES(:record_id,:ann_pdf)");	
			$stmt1->bindparam(":record_id", $record_id);  
			$stmt1->bindparam(":ann_pdf", $ann_pdf);
			$stmt1->execute();	
				$message='Added Announcements Details';
				$action="INSERT INTO announcement(
           	an_label, an_text,an_pdf, an_pdf_size,an_pdf_lanuage,an_update_date,an_new_icon,an_archive,display,updateuser,an_order,
			an_icon_img,ann_link,external_link) 
						VALUES($ann_lable,$ann_title,'file',$ann_size,$ann_lan,$date_up,$new,$exp_dt,$display,
						$mhc_user,$ann_order,$icon_img,$ann_link,$elink)";
						
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
	
	 public function ann_update($edit_id,$ann_lable,$ann_title,$ann_size,$date_up,$exp_dt,$ann_lan,$ann_order,$display,$new,$mhc_user,$icon_img,$page_id,$ip,$log_fun,$ann_link,$elink)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE announcement
   SET  an_label=:ann_lable,an_text=:ann_title, an_pdf_lanuage=:ann_lan,
   an_update_date=:date_up,an_new_icon=:new,an_archive=:exp_dt,display=:display,updateuser=:mhc_user,
   an_order=:ann_order,an_icon_img=:icon_img,ann_link=:ann_link,external_link=:elink 
 WHERE an_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":ann_lable", $ann_lable);
			$stmt->bindparam(":ann_title", $ann_title);
			$stmt->bindparam(":ann_lan", $ann_lan);	 
			$stmt->bindparam(":date_up", $date_up);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":exp_dt", $exp_dt);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":ann_order", $ann_order);	 
			$stmt->bindparam(":icon_img", $icon_img);	
			$stmt->bindparam(":ann_link", $ann_link);			
			$stmt->bindparam(":elink", $elink);
				if($stmt->execute())
			{
				
				$record_id=$edit_id;
				if($ann_lable=="link"){
				$ann_pdf='';
				$stmt1 = $this->db->prepare("UPDATE announcement_file SET an_pdf=:ann_pdf WHERE announc_id =:edit_id");
				$stmt1->bindValue(':edit_id', $edit_id); 
				$stmt1->bindparam(":ann_pdf", $ann_pdf); 
				$stmt1->execute();
				} 
				$message='Update Announcements Details';
				$action="UPDATE announcement
   SET  an_label=$ann_lable,an_text=$ann_title, an_pdf_lanuage=$ann_lan,
   an_update_date=$date_up,an_new_icon=$new,an_archive=$exp_dt,display=$display,updateuser=$mhc_user,
   an_order=$ann_order,an_icon_img=$icon_img,ann_link=$ann_link,external_link=$elink  
 WHERE an_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function ann_update1($edit_id,$ann_lable,$ann_title,$ann_pdf,$ann_size,$date_up,$exp_dt,$ann_lan,$ann_order,$display,$new,$mhc_user,$icon_img,$page_id,$ip,$log_fun,$ann_link,$elink)
    {
       try
       {
			
           $stmt = $this->db->prepare("UPDATE announcement
   SET  an_label=:ann_lable,an_text=:ann_title,an_pdf_size=:ann_size, an_pdf_lanuage=:ann_lan,
   an_update_date=:date_up,an_new_icon=:new,an_archive=:exp_dt,display=:display,updateuser=:mhc_user,
   an_order=:ann_order,an_icon_img=:icon_img,ann_link=:ann_link,external_link=:elink  
 WHERE an_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":ann_lable", $ann_lable);
			$stmt->bindparam(":ann_title", $ann_title);
			
			$stmt->bindparam(":ann_size", $ann_size); 
			$stmt->bindparam(":ann_lan", $ann_lan);	 
			$stmt->bindparam(":date_up", $date_up);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":exp_dt", $exp_dt);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":ann_order", $ann_order);	 
			$stmt->bindparam(":icon_img", $icon_img);	
			$stmt->bindparam(":ann_link", $ann_link);
			$stmt->bindparam(":elink", $elink);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				
				 $stmt1 = $this->db->prepare("UPDATE announcement_file SET an_pdf=:ann_pdf WHERE announc_id =:edit_id");
            
			$stmt1->bindValue(':edit_id', $edit_id); 
			$stmt1->bindparam(":ann_pdf", $ann_pdf); 
			$stmt1->execute();
				
				$message='Update Announcements Details';
				$action="UPDATE announcement
   SET  an_label=$ann_lable,an_text=$ann_title,an_pdf='file upload',an_pdf_size=$ann_size, an_pdf_lanuage=$ann_lan,
   an_update_date=$date_up,an_new_icon=$new,an_archive=$exp_dt,display=$display,updateuser=$mhc_user,
   an_order=$ann_order,an_icon_img=$icon_img,ann_link=$ann_link,external_link=$elink 
 WHERE an_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	
 public function ann_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM announcement WHERE an_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
			{
				
				$record_id=$del_id;
				
				$stmt1 =  $this->db->prepare("DELETE FROM announcement_file WHERE announc_id=:del_id");
				$stmt1->bindValue(':del_id', $del_id, PDO::PARAM_STR);
				$stmt1->execute();
         
				$message='Delete Announcements Details';
				$action="DELETE FROM announcement WHERE an_id=$del_id";
						
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
				

				 $stmt = $this->db->prepare("SELECT * FROM announcement order by an_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
						
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					
					$enctype_id=base64_encode($row['an_id']);
					
					$dated=date('d-m-Y',strtotime($row['an_update_date']));
				//	$pdf='<iframe src='.$row['an_pdf'].' style="width:100%;height:100px;" ></iframe>';
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['an_text'].'</td>';
						 if($row['an_label']=='link'){
							$GetData.='<td><a href="'.$row['ann_link'].'" target="_blank"> <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >Open Link</button>	</a></td>'; 
						 }
						 else{
                      $GetData.='	  <td><form method="POST" action="view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['an_id']).'"/>
	  <input type="hidden" name="page" id="page" value="'.base64_encode("A").'" />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
	  </form>
						 </td>';}
						 $GetData.='	
                          <td>'.$dated.'</td>
                          <td>'.$row['an_order'].'</td>
                       
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="anno_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['an_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
