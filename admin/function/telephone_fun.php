<?php
class TELEFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function tele_register($os_name,$intercom_no,$typed,$display1,$mhc_user,$page_id,$ip,$log_fun,$bench,$order_id)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_telephone_diary(
           	name, intercom_no,type,display,mhc_user,bench,order_id) 
						VALUES(:os_name,:intercom_no,:typed,:display1,:mhc_user,:bench,:order_id)returning telephone_id");	
			$stmt->bindparam(":os_name", $os_name);  
			$stmt->bindparam(":intercom_no", $intercom_no);
			$stmt->bindparam(":typed", $typed); 
			$stmt->bindparam(":display1", $display1); 
			$stmt->bindparam(":mhc_user", $mhc_user);	
			$stmt->bindparam(":bench", $bench);
			$stmt->bindparam(":order_id", $order_id);			
				 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['telephone_id'];
				$message='Added New Telephone Number';
				$action="INSERT INTO mhc_telephone_diary(
           	name, intercom_no,type,display,mhc_user,bench,order_id) 
						VALUES($os_name,$intercom_no,$typed,$display1,$mhc_user,$bench,$order_id)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
			 //return $stmt; 
			 return $action;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	//Judge Committee
	
	 public function tele_update($edit_id,$os_name,$intercom_no,$typed,$display1,$mhc_user,$page_id,$ip,$log_fun,$bench,$order_id)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_telephone_diary
   SET  name=:os_name,intercom_no=:intercom_no,type=:typed,display=:display1,mhc_user=:mhc_user,bench=:bench,order_id=:order_id  WHERE telephone_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":os_name", $os_name);
			$stmt->bindparam(":intercom_no", $intercom_no);
			$stmt->bindparam(":typed", $typed); 
			$stmt->bindparam(":display1", $display1); 
			$stmt->bindparam(":mhc_user", $mhc_user);
			$stmt->bindparam(":bench", $bench);
			$stmt->bindparam(":order_id", $order_id);				
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Telephone Number';
				$action="UPDATE mhc_telephone_diary
   SET  name=$os_name,intercom_no=$intercom_no,type=$typed,display=$display1,mhc_user=$mhc_user,bench=$bench,order_id=$order_id WHERE telephone_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function tele_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_telephone_diary WHERE telephone_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Telephone Number';
				$action="DELETE FROM mhc_telephone_diary WHERE telephone_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function teledata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_telephone_diary");
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
					if($row['type']=='O')
					{
						$type='OFFICER';
						$select_qry = $this->db->prepare("select sno,desig from officer_designation where display='Y' and sno=:name order by sno asc");
						$select_qry->bindParam(':name',$row['name']);
						$select_qry->execute();
					$get_row = $select_qry->fetch();
					$name=$get_row['desig'];
					}
					else
					{
						$type='SECTIONS';
						$select_qry = $this->db->prepare("select sno,depart from departments where display='Y' and sno=:name order by sno asc");
						$select_qry->bindParam(':name',$row['name']);
						$select_qry->execute();
					$get_row = $select_qry->fetch();
					$name=$get_row['depart'];
					}
					$enctype_id=base64_encode($row['telephone_id']);
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$name.'</td>
                          <td>'.$row['intercom_no'].'</td>
                          <td>'.$type.'</td>
                         <td>'.$row['bench'].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="tele_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['telephone_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
