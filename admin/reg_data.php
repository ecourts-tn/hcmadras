<?php
include 'config/dbconfig.php';
$GetData='';
 $stmt = $DB_con->prepare("SELECT * FROM registrars ORDER BY reg_pl_sen ASC");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
					$photo='<img src="'.$row['reg_photo'].'" weight="50" height="50" />';
					$name=$row['reg_prefix'].'.'.$row['reg_name'];
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
					if($row['reg_place']=='MHC')
					{
						$place='Madras High Court';
					}
					else
					{
						$place='Madurai Bench';
					}
					$enctype_id=base64_encode($row['reg_id']);
					$date=date('d-m-Y',strtotime($row['reg_app']));
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$photo.'</td>
                          <td>'.$name.'</td>
                          <td>'.$row['reg_desig'].'</td>
                          <td>'.$row['reg_contact_no'].'</td>
                          <td>'.$row['reg_fax_no'].'</td>
                          <td>'.$date.'</td>
                          <td>'.$place.'</td>
                          <td>'.$display.'</td>
						  <td>'.$row['reg_pl_sen'].'</td>
                         
                        </tr>';
						$sno++;
					}
					echo $GetData;
?>