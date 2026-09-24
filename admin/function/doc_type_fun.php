<?php


class DOCTYPEFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function doc_type_register($name,$doc_name,$doc_value,$display1,$show_page,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
	$temp="{".$name."}";
			$stmt = $this->db->prepare("INSERT INTO mhc_document_type(
           	dept_no, doc_name,doc_value,display,mhc_user,show_page) 
						VALUES(:name,:doc_name,:doc_value,:display1,:mhc_user,:show_page)returning doc_type_id");	
			$stmt->bindparam(":name",$temp);  
			$stmt->bindparam(":doc_name", $doc_name);
			$stmt->bindparam(":doc_value", $doc_value); 
			$stmt->bindparam(":display1", $display1); 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
		    $stmt->bindparam(":show_page", $show_page);	 
		if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['doc_type_id'];
				$message='Added Document-Section Mapping';
				$action="INSERT INTO mhc_document_type(
           dept_no, doc_name,doc_value,display,mhc_user,show_page) 
						VALUES($name,$doc_name,$doc_value,$display1,$mhc_user,$show_page)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
							
   
           return $stmt; 
		 //  echo "<script>alert('".$stmt."');</script>";
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	//Judge Committee
	
	 public function doc_type_update($edit_id,$name,$doc_name,$doc_value,$display1,$show_page,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   $temp="{".$name."}";
           $stmt = $this->db->prepare("UPDATE mhc_document_type
   SET  dept_no=:name,doc_name=:doc_name,doc_value=:doc_value,display=:display1,mhc_user=:mhc_user,show_page=:show_page 
 WHERE doc_type_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":name", $temp);
			$stmt->bindparam(":doc_name", $doc_name);
			$stmt->bindparam(":doc_value", $doc_value); 
			$stmt->bindparam(":display1", $display1); 
			$stmt->bindparam(":mhc_user", $mhc_user);	
			$stmt->bindparam(":show_page", $show_page);			
			 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Updated Document-Section Mapping';
				$action="UPDATE mhc_document_type
   SET  dept_no=$name,doc_name=$doc_name,doc_value=$doc_value,display=$display1,mhc_user=$mhc_user,show_page=$show_page 
 WHERE doc_type_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function doc_type_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_document_type WHERE doc_type_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Deleted Document-Section Mapping';
				$action="DELETE FROM mhc_document_type WHERE doc_type_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function doc_type_data($chkstr,$page_id)
	{
		
		$dd_arr=array();
			$dd = $this->db->prepare("select * from drop_down where page_id=".base64_decode($page_id)."   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT doc_type_id, dept_no, doc_name, doc_value,show_page,display FROM mhc_document_type ");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					 $stmt1 = $this->db->prepare("select STRING_AGG(depart,',') as sec from departments where sno in (select  unnest(dept_no) from mhc_document_type where doc_value='".$row['doc_value']."')");
					$stmt1->execute();
					if ($row1 = $stmt1->fetch()) {
						$sec=$row1['sec'];
					}
					
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">NO<div class="ripple-container"></div></button>';
					}
				
					
					$enctype_id=base64_encode($row['doc_type_id']);
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['doc_name'].'</td>
                          <td>'.$row['doc_value'].'</td>
                          <td>'.$sec.'</td>
						  <td>'.$dd_arr[$row['show_page']].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="doc_type_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['doc_type_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
