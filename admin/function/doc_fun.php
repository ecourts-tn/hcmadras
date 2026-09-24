<?php
class DOCFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function doc_register($doc_title,$doc_pdf,$doc_size,$doc_lan,$date_up,$date_to,$doc_order,$doc_bench,$new,$doc_page,$icon_img,$display,$mhc_user,$doc_o_type,$page_id,$ip,$log_fun)
    {
       try
       {
   
        /*    error_log("INSERT INTO mhc_document(
           	doc_title,doc_size, doc_lan,doc_f_date,doc_to_date,doc_order,doc_bench,doc_new_icon,doc_show_page,doc_icon,
			display,mhc_user,order_type) 
						VALUES($doc_title,$doc_size,$doc_lan,$date_up,$date_to,
						$doc_order,$doc_bench,$new,
						$doc_page,$icon_img,$display,$mhc_user,$doc_o_type)"); */
			$stmt = $this->db->prepare("INSERT INTO mhc_document(
           	doc_title,doc_size, doc_lan,doc_f_date,doc_to_date,doc_order,doc_bench,doc_new_icon,doc_show_page,doc_icon,
			display,mhc_user,order_type) 
						VALUES(:doc_title,:doc_size,:doc_lan,:date_up,:date_to,
						:doc_order,:doc_bench,:new,
						:doc_page,:icon_img,:display,:mhc_user,:doc_o_type) returning doc_id");	
			  
			$stmt->bindparam(":doc_title", $doc_title);  
			
			$stmt->bindparam(":doc_size", $doc_size); 
			$stmt->bindparam(":doc_lan", $doc_lan); 
			$stmt->bindparam(":date_up", $date_up);
			$stmt->bindparam(":date_to", $date_to);				
			$stmt->bindparam(":doc_order", $doc_order);	 	 
			$stmt->bindparam(":doc_bench", $doc_bench);	 	 
			$stmt->bindparam(":new", $new);	 	 
			$stmt->bindparam(":doc_page", $doc_page);	 	 
			$stmt->bindparam(":icon_img", $icon_img);	 	 
			$stmt->bindparam(":display", $display);	 	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":doc_o_type", $doc_o_type);	 	 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['doc_id'];
				
				
				$stmt1 = $this->db->prepare("INSERT INTO document_files(
           	document_id, doc_pdf_file) 
						VALUES(:record_id,:doc_pdf)");	
				$stmt1->bindparam(":record_id", $record_id);
				$stmt1->bindparam(":doc_pdf", $doc_pdf);
				$stmt1->execute();
				$message='Added New Document';
				$action="INSERT INTO mhc_document(
           	doc_title,doc_size, doc_lan,doc_f_date,doc_to_date,doc_order,doc_bench,doc_new_icon,doc_show_page,doc_icon,
			display,mhc_user,order_type) 
						VALUES($doc_title,$doc_size,$doc_lan,$date_up,$date_to,
						$doc_order,$doc_bench,$new,
						$doc_page,$icon_img,$display,$mhc_user,$doc_o_type)";
						
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
	
	 public function doc_update($edit_id,$doc_title,$doc_lan,$date_up,$date_to,$doc_order,$doc_bench,$new,$doc_page,$icon_img,$display,$mhc_user,$doc_o_type,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_document
   SET  doc_title=:doc_title,doc_lan=:doc_lan,
   doc_f_date=:date_up,doc_to_date=:date_to,doc_order=:doc_order,doc_bench=:doc_bench,doc_new_icon=:new,
   doc_show_page=:doc_page,doc_icon=:icon_img,display=:display,mhc_user=:mhc_user,order_type=:doc_o_type
 WHERE doc_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			
			$stmt->bindparam(":doc_title", $doc_title);
			
			$stmt->bindparam(":doc_lan", $doc_lan);	 
			$stmt->bindparam(":date_up", $date_up);	 
			$stmt->bindparam(":date_to", $date_to);	 
			$stmt->bindparam(":doc_order", $doc_order);	 
			$stmt->bindparam(":doc_bench", $doc_bench);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":doc_page", $doc_page);	 
			$stmt->bindparam(":icon_img", $icon_img);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":doc_o_type", $doc_o_type);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Document';
				$action="UPDATE mhc_document
   SET  doc_title=$doc_title,doc_lan=$doc_lan,
   doc_f_date=$date_up,doc_to_date=$date_to,doc_order=$doc_order,doc_bench=$doc_bench,doc_new_icon=$new,
   doc_show_page=$doc_page,doc_icon=$icon_img,display=$display,mhc_user=$mhc_user,order_type=$doc_o_type
 WHERE doc_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

	 public function doc_update1($edit_id,$doc_title,$doc_pdf,$doc_size,$doc_lan,$date_up,$date_to,$doc_order,$doc_bench,$new,$doc_page,$display,$mhc_user,$doc_o_type,$page_id,$ip,$log_fun)
    {
       try
       {
   
          $stmt = $this->db->prepare("UPDATE mhc_document
   SET  doc_title=:doc_title,doc_size=:doc_size, doc_lan=:doc_lan,
   doc_f_date=:date_up,doc_to_date=:date_to,doc_order=:doc_order,doc_bench=:doc_bench,doc_new_icon=:new,
   doc_show_page=:doc_page,display=:display,mhc_user=:mhc_user,order_type=:doc_o_type
 WHERE doc_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			
			$stmt->bindparam(":doc_title", $doc_title);
			
			$stmt->bindparam(":doc_size", $doc_size); 
			$stmt->bindparam(":doc_lan", $doc_lan);	 
			$stmt->bindparam(":date_up", $date_up);	 
			$stmt->bindparam(":date_to", $date_to);	 
			$stmt->bindparam(":doc_order", $doc_order);	 
			$stmt->bindparam(":doc_bench", $doc_bench);	 
			$stmt->bindparam(":new", $new);	 
			$stmt->bindparam(":doc_page", $doc_page);	 
				 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			$stmt->bindparam(":doc_o_type", $doc_o_type);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				
				  $stmt1 = $this->db->prepare("UPDATE document_files
   SET  doc_pdf_file=:doc_pdf
 WHERE document_id =:edit_id");
            
			$stmt1->bindValue(':edit_id', $edit_id); 
			$stmt1->bindparam(":doc_pdf", $doc_pdf); 
			$stmt1->execute();
			
				$message='Update Document';
				$action="UPDATE mhc_document
   SET  doc_title=$doc_title,doc_pdf_file='file update',doc_size=$doc_size, doc_lan=$doc_lan,
   doc_f_date=$date_up,doc_to_date=$date_to,doc_order=$doc_order,doc_bench=$doc_bench,doc_new_icon=$new,
   doc_show_page=$doc_page,display=$display,mhc_user=$mhc_user,order_type=$doc_o_type
 WHERE doc_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	

	
 public function doc_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_document WHERE doc_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$stmt1 =  $this->db->prepare("DELETE FROM document_files WHERE document_id=:del_id");
          $stmt1->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         $stmt1->execute();
				$message='Delete Document';
				$action="DELETE FROM mhc_document WHERE doc_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function docdata($chkstr,$page_id,$doc_show_page_str)
	{
		
		
		try {
			$dd_arr=array();
			$dd = $this->db->prepare("select * from drop_down where page_id=".base64_decode($page_id)."   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
			$sp_arr=array();
			$sp = $this->db->prepare("SELECT * FROM mhc_document_type where show_page='D' and display='Y'");
				 
				 $sp->execute();	
			while ($sp_row = $sp->fetch()) {
				$sp_arr[$sp_row['doc_value']]=$sp_row['doc_name'];
			}
			
				$GetData ='';
				 $stmt = $this->db->prepare("SELECT * FROM mhc_document where doc_show_page in (".$doc_show_page_str.") order by doc_id desc");
				 
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
						$photo='<img src="'.$row['doc_icon'].'" weight="50" height="50" />';
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					
					
					$enctype_id=base64_encode($row['doc_id']);
					
					$dated=date('d-m-Y',strtotime($row['doc_f_date']));
					//$pdf='<iframe src='.$row['doc_pdf_file'].' style="width:100%;height:100px;" ></iframe>';
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.htmlspecialchars_decode($row['doc_title']).'</td>
                          <td><form method="POST" action="view_pdf.php" target="_blank">
						  <input type="hidden" name="pdf_id" id="pdf_id" value="'.base64_encode($row['doc_id']).'"/>
						  <input type="hidden" name="page" id="page" value="'.base64_encode("D").'" />
						   <button type="submit" name="submit" id="submit"  style="cursor: pointer;" class="btn btn-primary" >View Document</button>
						  </form></td>
                          <td>'.$dated.'</td>
                          <td>'.$dd_arr[$row['doc_bench']].'</td>
                           <td>'.$sp_arr[$row['doc_show_page']].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="doc_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['doc_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
