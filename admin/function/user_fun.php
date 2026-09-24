<?php
class USERFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function user_register($full_name,$user_name,$enctype_pass,$mobile,$email_id,$designation,$status,$roll,$menu_list,$mhc_user,$page_id,$ip,$log_fun,$dept,$court_type,$dist)
    {
		if($court_type!='D')
			$dist='0';
		$def_pwd='Y';
       try
       {
   
           
			$stmt = $this->db->prepare("INSERT INTO mhc_users(
           	username, password,full_name, designation,status,roll,mobile,email_id,menu_id,dept,court_type,dist_id,default_pass) 
						VALUES(:user_name,:enctype_pass,:full_name,:designation,:status,:roll,
						:mobile,:email_id,:menu_list,:dept,:court_type,:dist,:def_pwd) returning mhc_user_id ");	
			$stmt->bindparam(":user_name", $user_name);  
			$stmt->bindparam(":enctype_pass", $enctype_pass);
			$stmt->bindparam(":full_name", $full_name); 
			$stmt->bindparam(":designation", $designation); 
			$stmt->bindparam(":status", $status);	 
			$stmt->bindparam(":roll", $roll);	 
			$stmt->bindparam(":mobile", $mobile);	 
			$stmt->bindparam(":email_id", $email_id);	 
			$stmt->bindparam(":menu_list", $menu_list);	
			$stmt->bindparam(":dept", $dept);	
			$stmt->bindparam(":court_type", $court_type);	
			$stmt->bindparam(":dist", $dist);	
			$stmt->bindparam(":def_pwd", $def_pwd);				
			if($stmt->execute())
			{
				$row = $stmt->fetch();
				$record_id=$row['mhc_user_id'];
				$message='Add New User';
				$action="INSERT INTO mhc_users(
           	username, password,full_name, designation,status,roll,mobile,email_id,menu_id,dept,court_type,dist) 
						VALUES('$user_name','$enctype_pass','$full_name','$designation','$status','$roll',
						'$mobile','$email_id','$menu_list','$dept','$court_type','$dist','$def_pwd')";
						
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
	
	 public function user_update($edit_id,$full_name,$mobile,$email_id,$designation,$status,$roll,$menu_list,$mhc_user,$page_id,$ip,$log_fun,$dept,$court_type,$dist)
    {
		if($court_type!='D')
			$dist='0';
       try
       {
   
           $stmt = $this->db->prepare("UPDATE mhc_users
   SET  full_name=:full_name,designation=:designation,mobile=:mobile,email_id=:email_id,status=:status,
   roll=:roll,menu_id=:menu_list,dept=:dept,court_type=:court_type,dist_id=:dist 
 WHERE mhc_user_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":full_name", $full_name);
			$stmt->bindparam(":designation", $designation);
			$stmt->bindparam(":mobile", $mobile); 
			$stmt->bindparam(":email_id", $email_id); 
			$stmt->bindparam(":status", $status);	 
			$stmt->bindparam(":roll", $roll);	 
			$stmt->bindparam(":menu_list", $menu_list);	 
			$stmt->bindparam(":dept", $dept);
			$stmt->bindparam(":court_type", $court_type);
			$stmt->bindparam(":dist", $dist);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update User Record';
				$action="UPDATE mhc_users
   SET  full_name=$full_name,designation=$designation,mobile=$mobile,email_id=$email_id,status=$status,
   roll=$roll,menu_id=$menu_list,dept=$dept,court_type=$court_type,dist_id=$dist 
 WHERE mhc_user_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function user_update_pwd($edit_id,$new_pwd,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
			$def_pwd='N';
           $stmt = $this->db->prepare("UPDATE mhc_users
   SET  password=:new_pwd,default_pass=:def_pwd WHERE mhc_user_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":new_pwd", $new_pwd);
			$stmt->bindparam(":def_pwd", $def_pwd);
			if($stmt->execute())
			{
				$record_id=$edit_id;
				$message='Change User Password';
				$action="UPDATE mhc_users
   SET  password='new_pwd',default_pass='$def_pwd' WHERE mhc_user_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	 public function user_reset_pwd($edit_id,$new_pwd,$mhc_user,$page_id,$ip,$log_fun)
    {
       try
       {
			$def_pwd='Y';
           $stmt = $this->db->prepare("UPDATE mhc_users
   SET  password=:new_pwd,default_pass=:def_pwd WHERE mhc_user_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":new_pwd", $new_pwd);
			$stmt->bindparam(":def_pwd", $def_pwd);
			if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Reset User Password';
				$action="UPDATE mhc_users
   SET  password='new_pwd',default_pass='$def_pwd' WHERE mhc_user_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 public function user_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_users WHERE mhc_user_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
         if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete User Record';
				$action="DELETE FROM mhc_users WHERE mhc_user_id=$del_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
		  
		
   
           return $stmt; 
       }
	  catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		public function userdata($chkstr,$page_id)
	{
		$dd_arr=array();
			$dd = $this->db->prepare("select * from drop_down where page_id=".base64_decode($page_id)."   and display='Y'");
				 
				 $dd->execute();	
			while ($dd_row = $dd->fetch()) {
				$dd_arr[$dd_row['value']]=$dd_row['name'];
			}
		
		try {
			
			
				$GetData ='';
				
				if($_SESSION['roll']=='A')
				 $stmt = $this->db->prepare("SELECT mhc_user_id, username, password, full_name, designation, status, roll, session_id, login_flag, create_dt, mobile, email_id, menu_id, dept,depart,court_type 
FROM mhc_users inner join departments on dept=sno order by mhc_user_id desc ");
				else{
					 $stmt = $this->db->prepare("SELECT mhc_user_id, username, password, full_name, designation, status, roll, session_id, login_flag, create_dt, mobile, email_id, menu_id, dept,depart,court_type 
FROM mhc_users inner join departments on dept=sno where dist_id in (select dist_id from mhc_users where mhc_user_id=:mhc_user_id )order by mhc_user_id desc ");
					$stmt->bindparam(':mhc_user_id',$_SESSION['user_session']);
				}
				 $stmt->execute();				 
				$sno=1;
				while ($row = $stmt->fetch()) {
					
					
					
					if($row['status']=='A')
					{
						$approved_flag='<button class="btn btn-success btn-sm">Approved<div class="ripple-container"></div></button>';
					}
					else
					{
						$approved_flag='<button class="btn btn-warning btn-sm">Not Approved<div class="ripple-container"></div></button>';
					}
					
					$enctype_id=base64_encode($row['mhc_user_id']);
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['full_name'].'</td>
						  <td>'.$row['depart'].'</td>
                          <td>'.$row['designation'].'</td>
                          <td>'.$row['username'].'</td>
                          <td>'.$row['mobile'].'</td>
                          <td>'.$row['email_id'].'</td>
				<td>'.$dd_arr[$row['roll']].'<br>('.$dd_arr[$row['court_type']].')</td>
                          <td>'.$approved_flag.'</td>
                          <td class="text-right">
                            <a href="user_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>';
							if($_SESSION['roll']=='A'){
							$GetData.='<a href="user_management_resetpwd.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-gray-600 m-1"><i class="i-Repeat-2"></i></a>
                            <a href="javascript:removeRow('.$row['mhc_user_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>';
							}
                         $GetData.=' </td>
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
