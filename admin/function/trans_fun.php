<?php
class TRANSFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function trans_register($cadre,$type,$not_no,$not_year,$trans_pdf,$trans_size,$trans_lan,$trans_order,$trans_dt,$new,$display,$icon_img,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_transfer(
           	transfer_cadre,transfer_type, notification_no,notification_year, trans_doc_size,trans_doc_lan,transfer_order,transfer_date,new_icon,display,icon,mhc_user) 
						VALUES(:cadre,:type,:not_no,:not_year,:trans_size,
						:trans_lan,
						:trans_order,:trans_dt,:new,
						:display,:icon_img,:mhc_user)returning transfer_id");	
			$stmt->bindparam(":cadre", $cadre);  
			$stmt->bindparam(":type", $type);  
			$stmt->bindparam(":not_no", $not_no);
			$stmt->bindparam(":not_year", $not_year); 
			
			$stmt->bindparam(":trans_size", $trans_size);
			$stmt->bindparam(":trans_lan", $trans_lan);				
			$stmt->bindparam(":trans_order", $trans_order);	 	 
			$stmt->bindparam(":trans_dt", $trans_dt);	 	 
			$stmt->bindparam(":new", $new);	 	 
			$stmt->bindparam(":display", $display);	 	 
			$stmt->bindparam(":icon_img", $icon_img);	 	  
			$stmt->bindparam(":mhc_user", $mhc_user);	 	  	 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['transfer_id'];
				
					$stmt1 = $this->db->prepare("INSERT INTO transfer_files(
           	trans_id, trans_doc) 
						VALUES(:record_id,:trans_pdf)");	
			$stmt1->bindparam(":record_id", $record_id);  
			$stmt1->bindparam(":trans_pdf", $trans_pdf); 
			$stmt1->execute();
			
				$message='Added Transfer Document';
				$action="INSERT INTO mhc_transfer(
           	transfer_cadre,transfer_type, notification_no,notification_year, trans_doc,trans_doc_size,trans_doc_lan,transfer_order,transfer_date,new_icon,display,icon,mhc_user) 
						VALUES($cadre,$type,$not_no,$not_year,'data files',$trans_size,
						$trans_lan,
						$trans_order,$trans_dt,$new,
						$display,$icon_img,$mhc_user)";
						
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
	
	 public function trans_update($edit_id,$cadre,$type,$not_no,$not_year,$trans_pdf,$trans_size,$trans_lan,$trans_order,$trans_dt,$new,$display,$icon_img,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
		   
		    if($trans_pdf=='')
			{
	  $stmt = $this->db->prepare("UPDATE mhc_transfer
   SET  transfer_cadre=:cadre,transfer_type=:type,notification_no=:not_no,
   notification_year=:not_year, trans_doc_lan=:trans_lan,transfer_order=:trans_order,
   transfer_date=:trans_dt,new_icon=:new,
   display=:display,icon=:icon_img,mhc_user=:mhc_user
 WHERE transfer_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":cadre", $cadre);
			$stmt->bindparam(":type", $type);
			$stmt->bindparam(":not_no", $not_no); 
			$stmt->bindparam(":not_year", $not_year); 
				 
			$stmt->bindparam(":trans_lan", $trans_lan);	 
			$stmt->bindparam(":trans_order", $trans_order);	 
			$stmt->bindparam(":trans_dt", $trans_dt);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":icon_img", $icon_img);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 		
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Transfer Document';
				$action="UPDATE mhc_transfer
   SET  transfer_cadre=:cadre,transfer_type=:type,notification_no=:not_no,
   notification_year=:not_year,
   trans_doc_lan=:trans_lan,transfer_order=:trans_order,
   transfer_date=:trans_dt,new_icon=:new,
   display=:display,mhc_user=:mhc_user
 WHERE transfer_id =:edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			}
			else
			{
           $stmt = $this->db->prepare("UPDATE mhc_transfer
   SET  transfer_cadre=:cadre,transfer_type=:type,notification_no=:not_no,
   notification_year=:not_year,
   trans_doc_size=:trans_size,trans_doc_lan=:trans_lan,transfer_order=:trans_order,
   transfer_date=:trans_dt,new_icon=:new,
   display=:display,icon=:icon_img,mhc_user=:mhc_user
 WHERE transfer_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":cadre", $cadre);
			$stmt->bindparam(":type", $type);
			$stmt->bindparam(":not_no", $not_no); 
			$stmt->bindparam(":not_year", $not_year); 
			 
			$stmt->bindparam(":trans_size", $trans_size);	 
			$stmt->bindparam(":trans_lan", $trans_lan);	 
			$stmt->bindparam(":trans_order", $trans_order);	 
			$stmt->bindparam(":trans_dt", $trans_dt);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":icon_img", $icon_img);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 		
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				
				$stmt1 = $this->db->prepare("UPDATE transfer_files
   SET  trans_doc=:trans_pdf, create_modify= now()  
 WHERE trans_id =:edit_id");
            
			$stmt1->bindValue(':edit_id', $edit_id); 
			$stmt1->bindparam(":trans_pdf", $trans_pdf);
			$stmt1->execute();
			
				$message='Update Transfer Document';
				$action="UPDATE mhc_transfer
   SET  transfer_cadre=:cadre,transfer_type=:type,notification_no=:not_no,
   notification_year=:not_year, trans_doc='files data',
   trans_doc_size=:trans_size,trans_doc_lan=:trans_lan,transfer_order=:trans_order,
   transfer_date=:trans_dt,new_icon=:new,
   display=:display,mhc_user=:mhc_user
 WHERE transfer_id =:edit_id";
						
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
	
	
	

	
 public function trans_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_transfer WHERE transfer_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
			{
				
				$record_id=$del_id;
				
				$stmt1 =  $this->db->prepare("DELETE FROM transfer_files WHERE trans_id=:del_id");
				$stmt1->bindValue(':del_id', $del_id, PDO::PARAM_STR);
				$stmt1->execute();
			  
				$message='Delete Transfer Document';
				$action="DELETE FROM mhc_transfer WHERE transfer_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function trans_data($chkstr,$page_id)
	{
		$dd_arr=array();
			$dd = $this->db->prepare("select * from drop_down where page_id=".base64_decode($page_id)."   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_transfer order by transfer_id desc");
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
					if($row['new_icon']=='Y')
					{
						$new='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$new='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					
				
					
					$enctype_id=base64_encode($row['transfer_id']);
					
					$transfer_date=date('d-m-Y',strtotime($row['transfer_date']));
					
					$noti='<form method="POST" action="view_pdf.php" target="_blank">
	  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['transfer_id']).'"/>
	  <input type="hidden" name="page" id="page" value="'.base64_encode("T").'" />
	   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >'.$row['notification_no'].'/'.$row['notification_year'].'</button>
	  </form></a>';
					
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$dd_arr[$row['transfer_cadre']].'</td>
                          <td>'.$dd_arr[$row['transfer_type']].'</td>
                          <td>'.$noti.'</td>
                          <td>'.$transfer_date.'</td>
                           <td>'.$new.'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="transfer_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['transfer_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
