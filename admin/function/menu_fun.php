<?php


class MENUFUN
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
	
//User Register
	
	 public function menu_register($page_name,$page_url,$category,$main_order,$sub_order,$sub_sub_order,$display,$menu,$class_fun,$menu_tab,$set_menu,$mhc_user,$page_id,$ip,$log_fun,$sub_category,$external,$menu_user)
    {
       try
       {

				if(!is_null($sub_category))
				{
					MENUFUN::submenu_update($sub_category,$mhc_user,$page_id,$ip,$log_fun);
					}
			
			$stmt = $this->db->prepare("INSERT INTO mhc_menu(
           	page_name, page_url,menu_parent_id, main_menu_order,sub_menu_order,sub_sub_menu_order,display,menu,class_fun,menu_tab,set_menu,sub_parent_menu_id,external,menu_user) 
						VALUES(:page_name,:page_url,:category,:main_order,:sub_order,:sub_sub_order,:display,:menu,:class_fun,:menu_tab,:set_menu,:sub_category,:external,:menu_user) returning menu_id ");	
			$stmt->bindparam(":page_name", $page_name);  
			$stmt->bindparam(":page_url", $page_url);
			$stmt->bindparam(":category", $category); 
			$stmt->bindparam(":main_order", $main_order); 
			$stmt->bindparam(":sub_order", $sub_order);	 
			$stmt->bindparam(":sub_sub_order", $sub_sub_order);	 
			$stmt->bindparam(":display", $display);	 	 
			$stmt->bindparam(":menu", $menu);	 	 
			$stmt->bindparam(":class_fun", $class_fun);	 	 
			$stmt->bindparam(":menu_tab", $menu_tab);	 	 
			$stmt->bindparam(":set_menu", $set_menu);
			$stmt->bindparam(":sub_category", $sub_category);
	
			$stmt->bindparam(":external", $external);	
			$stmt->bindparam(":menu_user", $menu_user);			
			if($stmt->execute())
			{	
				$row = $stmt->fetch();
				$record_id=$row['menu_id'];
				$message='Add New Menu';
				$action="INSERT INTO mhc_menu(
           	page_name, page_url,menu_parent_id, main_menu_order,sub_menu_order,display,menu,class_fun,menu_tab,set_menu,sub_parent_menu_id,external,menu_user) 
						VALUES($page_name,$page_url,$category,$main_order,$sub_order,$sub_sub_order,$display,$menu,$class_fun,$menu_tab,$set_menu,$sub_category,$external,$menu_user) ";
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
	
	public function menu_update($edit_id,$page_name,$page_url,$menu_parent_id,$main_menu_order,$sub_menu_order,$sub_sub_menu_order,$display,$menu,$class_fun,$menu_tab,$set_menu,$mhc_user,$page_id,$ip,$log_fun,$sub_parent_menu_id,$external,$menu_user)

    {
		
       try
       {
		   if(!is_null($sub_parent_menu_id))
				{
					MENUFUN::submenu_update($sub_parent_menu_id,$mhc_user,$page_id,$ip,$log_fun);
					
				}
			else{
				$stmt1 = $this->db->prepare("SELECT count(*) FROM mhc_menu WHERE display='Y' and sub_parent_menu_id = '".$edit_id."'");
				 $stmt1->execute();				 
				$row_count= $stmt1->fetchColumn(); 
				if($row_count>0)
				{
					$sub_parent_menu_id=0;
				}
			}
   
           $stmt = $this->db->prepare("UPDATE mhc_menu
   SET  page_name=:page_name,page_url=:page_url,menu_parent_id=:menu_parent_id,main_menu_order=:main_menu_order, sub_menu_order=:sub_menu_order,sub_sub_menu_order=:sub_sub_menu_order,
   display=:display,menu=:menu,class_fun=:class_fun,menu_tab=:menu_tab,set_menu=:set_menu,sub_parent_menu_id=:sub_parent_menu_id,external=:external,menu_user=:menu_user 
 WHERE menu_id =:edit_id");
            
			$stmt->bindValue(':edit_id', $edit_id); 
			$stmt->bindparam(":page_name", $page_name);
			$stmt->bindparam(":page_url", $page_url);
			$stmt->bindparam(":menu_parent_id", $menu_parent_id); 
			$stmt->bindparam(":main_menu_order", $main_menu_order); 
			$stmt->bindparam(":sub_menu_order", $sub_menu_order);	
			$stmt->bindparam(":sub_sub_menu_order", $sub_sub_menu_order);			
			$stmt->bindparam(":display", $display);	 
			$stmt->bindparam(":menu", $menu);	 
			$stmt->bindparam(":class_fun", $class_fun);	 
			$stmt->bindparam(":menu_tab", $menu_tab);	 
			$stmt->bindparam(":set_menu", $set_menu);	 
			$stmt->bindparam(":sub_parent_menu_id", $sub_parent_menu_id); 
			$stmt->bindparam(":external", $external);
			$stmt->bindparam(":menu_user", $menu_user);
				if($stmt->execute())
			{
				
				$record_id=$edit_id;
				$message='Update Menu Record';
				$action="UPDATE mhc_menu
   SET  page_name=$page_name,page_url=$page_url,menu_parent_id=$menu_parent_id,main_menu_order=$main_menu_order, sub_menu_order=$sub_menu_order,sub_sub_menu_order=$sub_sub_menu_order,
   display=$display,menu=$menu,class_fun=$class_fun,menu_tab=$menu_tab,set_menu=$set_menu, sub_parent_menu_id=$sub_parent_menu_id,external=$external,menu_user=$menu_user 
 WHERE menu_id =$edit_id";
						
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
						
						
						
			}
						
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   
    }
 public function menu_Delete($del_id,$mhc_user,$page_id,$ip,$log_fun)
    {
		
       try
       {
		   
 		  
		   
 		  $stmt =  $this->db->prepare("DELETE FROM mhc_menu WHERE menu_id=:del_id");
          $stmt->bindValue(':del_id', $del_id, PDO::PARAM_STR);
          if($stmt->execute())
			{
				
				$record_id=$del_id;
				$message='Delete Menu Record';
				$action="DELETE FROM mhc_menu WHERE menu_id=$del_id";
						
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
		
		
		try {
			
			
				$GetData ='';
				

				 $stmt = $this->db->prepare("SELECT * FROM mhc_menu order by menu_id desc");
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
					
					$enctype_id=base64_encode($row['menu_id']);
					if($row['menu_parent_id']!=0)
					{
						$menu_parent_id=$row['menu_parent_id'];
						$menu_cat=$this->db->prepare("SELECT page_name FROM mhc_menu  where menu_id=:menu_parent_id");
					//error_log("sql:".$uptaddrsql);
					
					$menu_cat->execute(array(':menu_parent_id'=>$menu_parent_id));
					$menu_row= $menu_cat->fetch(PDO::FETCH_ASSOC);
					$category=$menu_row['page_name'];
					}
					else
					{
						$category='';
					}
						$GetData.='						
						<tr>
						<td>'.$sno.'</td>
                          <td>'.$row['page_name'].'</td>
                          <td>'.$row['page_url'].'</td>
                          <td>'.$category.'</td>
                          <td>'.$row['main_menu_order'].'</td>
                          <td>'.$row['sub_menu_order'].'</td>
						  <td>'.$row['sub_sub_menu_order'].'</td>
                          <td>'.$display.'</td>
                          <td class="text-right">
                            <a href="menu_management_edit.php?edit_id='.$enctype_id.'&CheckString='.$chkstr.'&'.md5('page_id').'='.$page_id.'" class="btn btn-info m-1"><i class="i-Pen-2"></i></a>
                            <a href="javascript:removeRow('.$row['menu_id'].')" class="btn btn-danger m-1"><i class="i-Folder-Trash"></i></a>
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
   
 public function submenu_update($sub_category,$mhc_user,$page_id,$ip,$log_fun)
{
	
	try
       {
		   $zero=0;
           $stmt = $this->db->prepare("UPDATE mhc_menu
   SET  sub_parent_menu_id=0 
 WHERE menu_id =:edit_id");
          // $stmt->bindValue(':value', $zero); 
			$stmt->bindValue(':edit_id', $sub_category); 
				if($stmt->execute())
			{
				
				$record_id=$sub_category;
				$message='Update Sub Menu Record';
				$action="UPDATE mhc_menu
   SET  sub_parent_menu_id=0
 WHERE menu_id =$sub_category";
						$logs=$log_fun->user_logs($mhc_user,$page_id,$ip,$message,$action,$record_id);
				$ret_value= true;		
						
			}
						
			return $ret_value;
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
   }
 
}
?>
