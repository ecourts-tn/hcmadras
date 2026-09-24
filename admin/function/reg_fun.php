<?php
class REGFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function reg_register($reg_name,$reg_app_date,$reg_rel_date,$designation,$cont_no,$fax_no,$place,$display,$dp_image,$reg_pri,$pre_name,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO registrars(
           	reg_app, reg_rel,reg_name, reg_desig,reg_place,reg_pl_sen,display,reg_photo,reg_contact_no,reg_fax_no,reg_prefix) 
						VALUES(:reg_app_date,:reg_rel_date,:reg_name,:designation,:place,:reg_pri,:display,
						:dp_image,:cont_no,:fax_no,:pre_name)returning reg_id");	
			$stmt->bindparam(":reg_app_date", $reg_app_date);  
			$stmt->bindparam(":reg_rel_date", $reg_rel_date);
			$stmt->bindparam(":reg_name", $reg_name); 
			$stmt->bindparam(":designation", $designation); 
			$stmt->bindparam(":place", $place); 
			$stmt->bindparam(":reg_pri", $reg_pri);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":cont_no", $cont_no);	 
			$stmt->bindparam(":fax_no", $fax_no);	 
			$stmt->bindparam(":pre_name", $pre_name);	 
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['reg_id'];
				$message='Added Register Details';
				$action="INSERT INTO registrars(
           	reg_app, reg_rel,reg_name, reg_desig,reg_place,reg_pl_sen,display,reg_photo,reg_contact_no,reg_fax_no,reg_prefix) 
						VALUES($reg_app_date,$reg_rel_date,$reg_name,$designation,$place,$reg_pri,$display,
						'dp_image',$cont_no,$fax_no,$pre_name)";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
							
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

 
	
	
	 public function reg_update($edit_id,$reg_name,$reg_app_date,$reg_rel_date,$designation,$cont_no,$fax_no,$place,$display,$dp_image,$reg_pri,$pre_name,$mhc_user,$page_id,$ip,$log_fun,$def_chk)
    {
       try
       {
   
   /*   $bd22 = pg_pconnect("host=192.168.45.100 port=5432 dbname=hcmadras user=postgres") or die("Opps some thing went wrong");
		  
				$sql2= "UPDATE registrars
   SET  reg_name='$reg_name',reg_app='$reg_app_date',reg_rel='$reg_rel_date',reg_desig='$designation',
   reg_contact_no='$cont_no',reg_fax_no='$fax_no',reg_place='$place',display='$display',
   reg_photo='$dp_image',reg_pl_sen='$reg_pri',reg_prefix='$pre_name'
 WHERE reg_id ='$edit_id'";
			    $stmt = pg_query($bd22,$sql2); */
			
           $stmt = $this->db->prepare("UPDATE registrars
   SET  reg_name=:reg_name,reg_app=:reg_app_date,reg_rel=:reg_rel_date,reg_desig=:designation,
   reg_contact_no=:cont_no,reg_fax_no=:fax_no,reg_place=:place,display=:display,
   reg_photo=:dp_image,reg_pl_sen=:reg_pri,reg_prefix=:pre_name
 WHERE reg_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":reg_name", $reg_name);
			$stmt->bindparam(":reg_app_date", $reg_app_date);
			$stmt->bindparam(":reg_rel_date", $reg_rel_date); 
			$stmt->bindparam(":designation", $designation); 
			$stmt->bindparam(":cont_no", $cont_no);	 
			$stmt->bindparam(":fax_no", $fax_no);	 
			$stmt->bindparam(":place", $place);	 
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":dp_image", $dp_image);	 
			$stmt->bindparam(":reg_pri", $reg_pri);	 
			$stmt->bindparam(":pre_name", $pre_name);	 
 
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Register Details and Default flag='.$def_chk;
				$action="UPDATE registrars
   SET  reg_name=$reg_name,reg_app=$reg_app_date,reg_rel=$reg_rel_date,reg_desig=$designation,
   reg_contact_no=$cont_no,reg_fax_no=$fax_no,reg_place=$place,display=$display,
   reg_photo='dp_image',reg_pl_sen=$reg_pri,reg_prefix=$pre_name
 WHERE reg_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function reg_update1($edit_id,$reg_name,$reg_app_date,$reg_rel_date,$designation,$cont_no,$fax_no,$place,$display,$reg_pri,$pre_name,$mhc_user,$page_id,$ip,$log_fun,$def_chk)
    {
       try
       {
   
           $stmt = $this->db->prepare("UPDATE registrars
   SET  reg_name=:reg_name,reg_app=:reg_app_date,reg_rel=:reg_rel_date,reg_desig=:designation,
   reg_contact_no=:cont_no,reg_fax_no=:fax_no,reg_place=:place,display=:display,
   reg_pl_sen=:reg_pri,reg_prefix=:pre_name
 WHERE reg_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":reg_name", $reg_name);
			$stmt->bindparam(":reg_app_date", $reg_app_date);
			$stmt->bindparam(":reg_rel_date", $reg_rel_date); 
			$stmt->bindparam(":designation", $designation); 
			$stmt->bindparam(":cont_no", $cont_no);	 
			$stmt->bindparam(":fax_no", $fax_no);	 
			$stmt->bindparam(":place", $place);	 
			$stmt->bindparam(":display", $display);	 
			 
			$stmt->bindparam(":reg_pri", $reg_pri);	 
			$stmt->bindparam(":pre_name", $pre_name);	 
 
				if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Register Details and Default flag='.$def_chk;
				$action="UPDATE registrars
   SET  reg_name=$reg_name,reg_app=$reg_app_date,reg_rel=$reg_rel_date,reg_desig=$designation,
   reg_contact_no=$cont_no,reg_fax_no=$fax_no,reg_place=$place,display=$display,
   reg_pl_sen=$reg_pri,reg_prefix=$pre_name
 WHERE reg_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function reg_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM registrars WHERE reg_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         	if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Register Details';
				$action="DELETE FROM registrars WHERE reg_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function regdata($chkstr,$page_id)
	{
		$dd_arr=array();
			$dd = $this->db->prepare("select * from drop_down where page_id=".base64_decode($page_id)."   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM registrars ORDER BY reg_pl_sen ASC,display desc");
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
					$photo='<img src="view_image.php?img_id='.base64_encode($row['reg_id']).'&page='.base64_encode('R').'" weight="50" height="50" />';
					$name=$row['reg_prefix'].'.'.$row['reg_name'];
					if($row['display']=='Y')
					{
						$display='<button class="btn btn-success btn-sm">Yes<div class="ripple-container"></div></button>';
					}
					else
					{
						$display='<button class="btn btn-warning btn-sm">No<div class="ripple-container"></div></button>';
					}
				
					$select_qry = $this->db->prepare("select sno,desig from officer_designation where display='Y' and sno=:reg_desig order by sno asc");
					$select_qry->bindParam(':reg_desig',$row['reg_desig']);
					$select_qry->execute();
					$get_row = $select_qry->fetch();
	


					$enctype_id=base64_encode($row['reg_id']);
					$date=date('d-m-Y',strtotime($row['reg_app']));
				$reg_contact_no=explode(',',$row['reg_contact_no']);
				$contact='';
				foreach($reg_contact_no as $cont_no)
				{
					$contact .=$cont_no.'<br>';
				}
				$reg_fax_no=explode(',',$row['reg_fax_no']);
				$fax='';
				foreach($reg_fax_no as $fax_no)
				{
					$fax .=$fax_no.'<br>';
				}
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$photo.'</td>
                          <td>'.$name.'</td>
                          <td>'.$get_row['desig'].'</td>
                          <td>'.$contact.'</td>
                          <td>'.$fax.'</td>
                          <td>'.$date.'</td>
                          <td>'.$dd_arr[$row['reg_place']].'</td>
                          <td>'.$display.'</td>
						  <td>'.$row['reg_pl_sen'].'</td>
                          <td class="text-right">
                            <a href="reg_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                             <a href="javascript:removeRow('.$row['reg_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
