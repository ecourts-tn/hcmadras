<?php
class HOLIDAYFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function holiday_add($holiday_title,$holiday_year,$holiday_from,$holiday_to,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_holiday(
           	holidayname, year,holiday_from_date,holiday_to_date,display,mhc_user) 
						VALUES(:holiday_title,:holiday_year,:holiday_from,
						:holiday_to,:display,:mhc_user)returning holiday_id");	
			$stmt->bindparam(":holiday_title", $holiday_title);  
			$stmt->bindparam(":holiday_year", $holiday_year);
			$stmt->bindparam(":holiday_from", $holiday_from);
			$stmt->bindparam(":holiday_to", $holiday_to);
			$stmt->bindparam(":display", $display); 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
				 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['holiday_id'];
				$message='Added New Holiday';
				$action="INSERT INTO mhc_holiday(
           	holidayname, year,holiday_from_date,holiday_to_date,display,mhc_user) 
						VALUES($holiday_title,$holiday_year,$holiday_from,
						$holiday_to,$display,$mhc_user)";
						
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
	
	 public function holiday_update($edit_id,$holiday_title,$holiday_year,$holiday_from,$holiday_to,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_holiday
   SET  holidayname=:holiday_title,year=:holiday_year,holiday_from_date=:holiday_from,holiday_to_date=:holiday_to,display=:display,mhc_user=:mhc_user
 WHERE holiday_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":holiday_title", $holiday_title);
			$stmt->bindparam(":holiday_year", $holiday_year);
			$stmt->bindparam(":holiday_from", $holiday_from);
			$stmt->bindparam(":holiday_to", $holiday_to);
			$stmt->bindparam(":display", $display); 
			$stmt->bindparam(":mhc_user", $mhc_user);	 
			 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Important Link';
				$action="UPDATE mhc_holiday
   SET  holidayname=$holiday_title,year=$holiday_year,holiday_from_date=$holiday_from,holiday_to_date=$holiday_to,display=$display,mhc_user=$mhc_user
 WHERE holiday_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function holiday_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_holiday WHERE holiday_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Holiday Record';
				$action="DELETE FROM mhc_holiday WHERE holiday_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function holidaydata($chkstr,$page_id)
	{
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_holiday order by holiday_id desc");
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
					
					if($row['holiday_from_date']!='')
					{
						$from_date=date('Y-m-d',strtotime($row['holiday_from_date']));
					}
					else
					{
						$from_date='';
					}
					
					if($row['holiday_to_date']!='')
					{
						$to_date=date('Y-m-d',strtotime($row['holiday_to_date']));
					}
					else
					{
						$to_date='';
					}
					
					$enctype_id=base64_encode($row['holiday_id']);
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['holidayname'].'</td>
                          <td>'.$row['year'].'</td>
                          <td>'.$from_date.'</td>
                          <td>'.$to_date.'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="holiday_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['holiday_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
