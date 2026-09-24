<?php
class RULESFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function rules_register($rules_title,$doc_pdf,$rules_size,$date_up,$rules_lan,$new,$rules_order,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_rules(
           	rules_title, rules_pdf_file,rules_size, upload_date,rules_lan,rules_new_icon,rules_order,mhc_user,display) 
						VALUES(:rules_title,:doc_pdf,:rules_size,:date_up,:rules_lan,:new,:rules_order,:mhc_user,
						:display)returning rules_id");	
			$stmt->bindparam(":rules_title", $rules_title);  
			$stmt->bindparam(":doc_pdf", $doc_pdf);
			$stmt->bindparam(":rules_size", $rules_size); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":rules_lan", $rules_lan);	 
			$stmt->bindparam(":new", $new);	 	 
			$stmt->bindparam(":rules_order", $rules_order);	 	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":display", $display);	 	 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['rules_id'];
				$message='Added Rules Document';
				$action="INSERT INTO mhc_rules(
           	rules_title, rules_pdf_file,rules_size, upload_date,rules_lan,rules_new_icon,rules_order,mhc_user,display) 
						VALUES($rules_title,'doc_pdf',$rules_size,$date_up,$rules_lan,$new,$rules_order,$mhc_user,
						$display)";
						
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
	
	 public function rules_update($edit_id,$rules_title,$doc_pdf,$rules_size,$date_up,$rules_lan,$new,$rules_order,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_rules
   SET  rules_title=:rules_title,rules_pdf_file=:doc_pdf,rules_size=:rules_size,upload_date=:date_up, rules_lan=:rules_lan,rules_new_icon=:new,
   display=:display,rules_order=:rules_order,mhc_user=:mhc_user
 WHERE rules_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":rules_title", $rules_title);
			$stmt->bindparam(":doc_pdf", $doc_pdf);
			$stmt->bindparam(":rules_size", $rules_size); 
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":rules_lan", $rules_lan);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":rules_order", $rules_order);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			if($stmt->execute())
			{
			
				$record_id=$edit_id;
				$message='Update Rules Details';
				$action="UPDATE mhc_rules
   SET  rules_title=$rules_title,rules_pdf_file='doc_pdf',rules_size=$rules_size,upload_date=$date_up, rules_lan=$rules_lan,rules_new_icon=$new,
   display=$display,rules_order=$rules_order,mhc_user=$mhc_user
 WHERE rules_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	 public function rules_update1($edit_id,$rules_title,$date_up,$rules_lan,$new,$rules_order,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_rules
   SET  rules_title=:rules_title,upload_date=:date_up, rules_lan=:rules_lan,rules_new_icon=:new,
   display=:display,rules_order=:rules_order,mhc_user=:mhc_user
 WHERE rules_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":rules_title", $rules_title);			
			$stmt->bindparam(":date_up", $date_up); 
			$stmt->bindparam(":rules_lan", $rules_lan);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":rules_order", $rules_order);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
				if($stmt->execute())
			{
			
				$record_id=$edit_id;
				$message='Update Rules Details';
				$action="UPDATE mhc_rules
   SET  rules_title=$rules_title,upload_date=$date_up, rules_lan=$rules_lan,rules_new_icon=$new,
   display=$display,rules_order=$rules_order,mhc_user=$mhc_user
 WHERE rules_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	
	
 public function rules_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_rules WHERE rules_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
			{
			
				$record_id=$del_id;
				$message='Delete Rules Record';
				$action="DELETE FROM mhc_rules WHERE rules_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function rulesdata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_rules order by rules_id desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
						//$photo='<img src="'.$row['icon'].'" weight="50" height="50" />';
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					if($row['rules_new_icon']=='Y')
					{
						$new='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$new='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					$enctype_id=base64_encode($row['rules_id']);
					
					$dated=date('d-m-Y',strtotime($row['upload_date']));
					$pdf='<iframe src='.$row['rules_pdf_file'].' style="width:100%;height:100px;" ></iframe>';
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['rules_title'].'</td>
                          <td><form method="POST" action="view_pdf.php" target="_blank">
						  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['rules_id']).'"/>
						  <input type="hidden" name="page" id="page" value="'.base64_encode("R").'" />
						   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
						  </form>
						  
						 </td>
                          <td>'.$dated.'</td>
                          <td>'.$row['rules_order'].'</td>
                          <td>'.$new.'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="rules_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['rules_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
