<?php
include 'config/dbconfig.php';
  $stmt = $DB_con->prepare("SELECT * FROM registrars ORDER BY reg_pl_sen ASC");
				 $stmt->execute();				 
				$sno=1;
				//$output=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					/* $data[] = $row; */
					
					$photo='<img src="/'.$row['reg_photo'].'/" weight="50" height="50" />';
					$name=$row['reg_prefix'].'.'.$row['reg_name'];
					if($row['display']=='Y')
					{
						$display='Yes';
					}
					else
					{
						$display='No';
					}
					if($row['reg_place']=='MHC')
					{
						$place='Madras High Court';
					}
					else
					{
						$place='Madurai Bench';
					}
				
					$date=date('d-m-Y',strtotime($row['reg_app']));
					
						//$data['reg_id']=$row['reg_id'];					
						//$data['sno']=$sno;					
						//$data['photo']=$photo;					
						$data['name']=$name;				
												
						//$data['date']=$date;				
						$data['place']=$place;				
									
						$data['reg_pl_sen']=$row['reg_pl_sen'];				
						
                     
						$sno++;
						
						
						
					}

  echo json_encode($data);
/* {
  "data": [
    {
      "company": "OVERPLEX", 
      "place": "EUA", 
      "name": "Cannon Morin", 
      "order": 1
    }, 
    {
      "company": "UNDERTAP", 
      "place": "China", 
      "name": "Neva Allison", 
      "order": 2
    }, 
    {
      "company": "CORIANDER", 
      "place": "Spain", 
      "name": "Rodriquez Gentry", 
      "order": 3
    }, 
    {
      "company": "CORIANDER", 
      "place": "Spain", 
      "name": "Rodriquez Gentry", 
      "order": 4
    }, 
    {
      "company": "UNDERTAP", 
      "place": "China", 
      "name": "Neva Allison", 
      "order": 5
    }
  ]
} */
?>