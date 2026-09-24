<?php
class DJVCFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function vc_register($dist_id,$court_code,$from_date,$to_date,$vc_link,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
			$stmt = $this->db->prepare("INSERT INTO mhc_dj_vc(
           	dist_id, court_code,from_date, to_date,display,mhc_user,vc_link) 
						VALUES(:dist_id,:court_code,:from_date,:to_date,:display,:mhc_user,:vc_link)returning vc_id");	
			$stmt->bindparam(":dist_id", $dist_id);  
			$stmt->bindparam(":court_code", $court_code);
			$stmt->bindparam(":from_date", $from_date); 
			$stmt->bindparam(":to_date", $to_date); 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":mhc_user", $mhc_user);	 	 
			$stmt->bindparam(":vc_link", $vc_link);	 		
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['vc_id'];
				$message='Added DJ VC link Details';
				$action="INSERT INTO mhc_dj_vc(
           	dist_id, court_code,down_type,from_date, to_date,display,mhc_user,vc_link) 
						VALUES($dist_id,'$court_code',$from_date,$to_date,$display,$mhc_user)";
						
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
	
	 public function vc_update($edit_id,$dist_id,$court_code,$from_date,$to_date,$vc_link,$display,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_dj_vc
   SET  dist_id=:dist_id,court_code=:court_code,from_date=:from_date,to_date=:to_date, display=:display,vc_link=:vc_link WHERE vc_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":dist_id", $dist_id);
			$stmt->bindparam(":court_code", $court_code);
			$stmt->bindparam(":from_date", $from_date); 
			$stmt->bindparam(":to_date", $to_date); 	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":vc_link", $vc_link);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update DJ VC Details';
				$action="UPDATE mhc_dj_vc
   SET  dist_id=$dist_id,court_code=$court_code,from_date=$from_date,to_date=$to_date,
   display=$display WHERE vc_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	public function vc_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_dj_vc WHERE vc_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete DJ VC link Record';
				$action="DELETE FROM mhc_dj_vc WHERE vc_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function vcdata($chkstr,$page_id,$dist)
	{
		
		
		try {
			$court_name=array();
			$district=array();
			$d_stmt = $this->db->prepare("SELECT dist_code, dist_name FROM district_t WHERE state_id IN (33,34) and display='Y' ORDER BY dist_name ");
				 $d_stmt->execute();	
				 while ($row1 = $d_stmt->fetch()) {
					 $district[$row1['dist_code']]=$row1['dist_name'];
				 }
			$c_stmt = $this->db->prepare("SELECT court_code,court_name FROM court_det WHERE  disp = 'Y' and court_end is null");
				 $c_stmt->execute();
				 while ($row2 = $c_stmt->fetch()) {
					 $court_name[$row2['court_code']]=$row2['court_name'];
				 }
				$GetData ='';
				
				$tmp_stmt="SELECT * FROM mhc_dj_vc ";
				if($dist!='A')
				$tmp_stmt.= "where dist_id=:dist_id  ";
				$tmp_stmt.="order by vc_id desc";
				 $stmt = $this->db->prepare($tmp_stmt);
				 if($dist!='A'){
						$stmt->bindParam(':dist_id',$dist);
				 }
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
					
					
					
					$enctype_id=base64_encode($row['vc_id']);
					
					
					$fdated=date('d-m-Y',strtotime($row['from_date']));
					$tdated=date('d-m-Y',strtotime($row['to_date']));
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$district[$row['dist_id']].'</td>
                          <td>'.$court_name[$row['court_code']].'</td>
                          <td>'.$fdated.'</td>
						   <td>'.$tdated.'</td>
						   <td>'.$row['vc_link'].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="dj_vclink_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['vc_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
