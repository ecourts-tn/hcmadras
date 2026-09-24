<?php


class FEEDBACKFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

		public function feedback_data($from_dt,$to_dt)
	{
		
		
		try {
			
			
				$GetData ='';
				
				if(!is_null($from_dt)&&!is_null($to_dt))
					$stmt = $this->db->prepare("SELECT mail_id,mobile_no,feedback_msg,TO_CHAR(date(create_modify),'DD-MM-YYY') as dt FROM mhc_feedback where  date(create_modify) between '".$from_dt."' and '".$to_dt."' order by feedback_id ");
				else
					 $stmt = $this->db->prepare("SELECT mail_id,mobile_no,feedback_msg,TO_CHAR(date(create_modify),'DD-MM-YYY') as dt FROM mhc_feedback order by feedback_id desc limit 100");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['dt'].'</td>
                          <td>'.$row['mobile_no'].'<br>'.$row['mail_id'].'</td>
                          <td>'.$row['feedback_msg'].'</td>
                        </tr>';
						$sno++;
					}

					return $GetData;	
			

		} catch (PDOException $e) {

			return $e->getMessage();

		}
	
	} 



 
}
?>
