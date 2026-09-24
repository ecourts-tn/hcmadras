
<?php
require('config/dbconfig.php');

	$parent_menu = array();
	$sub_menu = array();
	$no=0;
	$qryMenu = "SELECT * FROM mhc_menu WHERE menu='M' AND display='Y' AND set_menu='FM' ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
	//error_log($qryMenu);
	$resMenu = $DB_con->query($qryMenu);
	while ($rowMenu = $resMenu->fetchObject()) {
		 
		if ($rowMenu->menu_parent_id == 0) {
			$parent_menu[$rowMenu->menu_id]['page_name'] = $rowMenu->page_name;
			$parent_menu[$rowMenu->menu_id]['page_url'] = $rowMenu->page_url;
			$parent_menu[$rowMenu->menu_id]['main_menu_order'] = $rowMenu->main_menu_order;
			$parent_menu[$rowMenu->menu_id]['menu_tab'] = $rowMenu->menu_tab;
			$parent_menu[$rowMenu->menu_id]['menu_id'] = $rowMenu->menu_id;
			$parent_menu[$rowMenu->menu_id]['external'] = $rowMenu->external;
			//echo "<script>console.log('parent_menu=".var_dump($parent_menu)."');</script>"; 												

		} else {
			if(empty($rowMenu->sub_parent_menu_id)){
			$sub_menu[$rowMenu->menu_id]['menu_parent_id'] = $rowMenu->menu_parent_id;
			$sub_menu[$rowMenu->menu_id]['page_name'] = $rowMenu->page_name;
			$sub_menu[$rowMenu->menu_id]['page_url'] = $rowMenu->page_url;
			$sub_menu[$rowMenu->menu_id]['sub_menu_order'] = $rowMenu->sub_menu_order;
			$sub_menu[$rowMenu->menu_id]['sub_sub_menu_order'] = $rowMenu->sub_sub_menu_order;
			$sub_menu[$rowMenu->menu_id]['menu_tab'] = $rowMenu->menu_tab;
			$sub_menu[$rowMenu->menu_id]['menu_id'] = $rowMenu->menu_id;
			$sub_menu[$rowMenu->menu_id]['external'] = $rowMenu->external;	
			}
			 if($rowMenu->sub_parent_menu_id==0)
			{
			
			$sub_menu[$rowMenu->menu_id]['menu_sub_parent_id'] = $rowMenu->sub_parent_menu_id;
			}
			else if ($rowMenu->sub_parent_menu_id!=0&&!empty($rowMenu->sub_parent_menu_id))
			{	
			$sub_pmenu[$rowMenu->menu_id]['menu_parent_id'] = $rowMenu->menu_parent_id;
			$sub_pmenu[$rowMenu->menu_id]['menu_sub_parent_id'] = $rowMenu->sub_parent_menu_id;
			$sub_pmenu[$rowMenu->menu_id]['page_name'] = $rowMenu->page_name;
			$sub_pmenu[$rowMenu->menu_id]['page_url'] = $rowMenu->page_url;
			$sub_pmenu[$rowMenu->menu_id]['sub_menu_order'] = $rowMenu->sub_menu_order;
			$sub_pmenu[$rowMenu->menu_id]['sub_sub_menu_order'] = $rowMenu->sub_sub_menu_order;
			$sub_pmenu[$rowMenu->menu_id]['menu_tab'] = $rowMenu->menu_tab;
			$sub_pmenu[$rowMenu->menu_id]['menu_id'] = $rowMenu->menu_id;
			$sub_pmenu[$rowMenu->menu_id]['external'] = $rowMenu->external;
			}
			//echo "<script>console.log('sub_menu=".var_dump($sub_menu)."');</script>";									 
			
			if (empty($parent_menu[$rowMenu->menu_parent_id]['count'])) {
				$parent_menu[$rowMenu->menu_parent_id]['count'] = 0;
			}
			$parent_menu[$rowMenu->menu_parent_id]['count']++;
			
			//echo "<script>console.log('sub_menu=".$parent_menu[$rowMenu->menu_parent_id]['count']."');</script>";
			
			$qrySubMenu = "SELECT * FROM mhc_menu WHERE  menu='M' AND display='Y' AND menu_id = '".$rowMenu->menu_parent_id."'";
			$resSubMenu = $DB_con->query($qrySubMenu);
			$rowSubMenu = $resSubMenu->fetchObject(); 
			if (array_key_exists($rowSubMenu->menu_id,$parent_menu))	{
				$parent_menu[$rowSubMenu->menu_id]['page_name'] = $rowSubMenu->page_name;
				$parent_menu[$rowSubMenu->menu_id]['page_url'] = $rowSubMenu->page_url;
				$parent_menu[$rowSubMenu->menu_id]['main_menu_order'] = $rowSubMenu->main_menu_order;
				$parent_menu[$rowSubMenu->menu_id]['menu_tab'] = $rowSubMenu->menu_tab;
				$parent_menu[$rowSubMenu->menu_id]['menu_id'] = $rowSubMenu->menu_id;
				$parent_menu[$rowSubMenu->menu_id]['external'] = $rowSubMenu->external;														   
				$parent_menu[$rowMenu->menu_parent_id]['count'] = 1;
				
				//echo "<script>console.log('parent_menu of sub array =".var_dump($parent_menu)."');</script>";	
			}
		}
	}
	
	
	
		function cmp($a, $b) {
			$p1 = $a['main_menu_order'];
			$p2 = $b['main_menu_order'];
			return (float)$p1 > (float)$p2;
		}
		uasort($parent_menu, "cmp");
		
		function cmp_sub($a, $b) {
			$p1 = $a['sub_menu_order'];
			$p2 = $b['sub_menu_order'];
			return (float)$p1 > (float)$p2;
		}
		uasort($sub_menu, "cmp_sub");
		function cmp_sub_sub($a, $b) {
			$p1 = $a['sub_sub_menu_order'];
			$p2 = $b['sub_sub_menu_order'];
			return (float)$p1 > (float)$p2;
		}
		uasort($sub_pmenu, "cmp_sub_sub");

	
	function dyn_menu($parent_array, $sub_array,$sub_parray,$page_id) {
		
    $menu = '<ul id="menu-header" class="nav group menu"><li id="menu-item-4046" class="menu-item menu-item-type-custom menu-item-object-custom  menu-item-4046 '.$page_id.'"><a href="index.php" title="Home page" >Home</a></li>';
    foreach ($parent_array as $pkey => $pval) {
		
		if($pval['menu_tab']=='Y')
			{

		if($pval['page_url']=='#')
			$tab='href="'.$pval['page_url'].'"';
		else if($pval['menu_tab']=='Y' and $pval['external']=='N'  )
			{
				$tab='href="'.$pval['page_url'].'" target="_blank"';
				
			}
		else if($pval['menu_tab']=='Y' and $pval['external']=='Y'  )
		{
				$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$pval['page_url']."', '_blank');}})";
				$tab='href="#" onclick="'.$alt.'"';
		}
			}
			else
			{
				$tab='href="'.$pval['page_url'].'"';
			}
			
			if(base64_decode($page_id)==$pkey)
		{
			$act_status='current_page_item';
		}
		else
		{
			$act_status='';
		}
			//id="menu-item-4044
			//id="'.$pval['menu_id'].'"
        if (!empty($pval['count'])) {
            $menu .= '<li id="prnt_'.$pval['menu_id'].'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044 '.$act_status.'"><a  '.$tab.' title="'.$pval['page_name'].' page" >'.$pval['page_name'].'</a>';
           // $menu .= '<li><a href="#subPages'.$pkey.'" data-toggle="collapse" class="collapsed"><span>'.$pval['page_name'].'</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>';
        } else {
            $menu .= '<li id="prnt_'.$pval['menu_id'].'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044 '.$act_status.'"><a  '.$tab.' title="'.$pval['page_name'].' page" >'.$pval['page_name'].'</a></li>';
           // $menu .= '<li><a href="'.$pval['page_url'].'">'.$pval['page_name'].'</span></a></li>';
        }
		
        if (!empty($pval['count'])) {
			
           $menu .= '<ul class="sub-menu" >';
             foreach ($sub_array as $sval) {
		
				//echo $sval['menu_id']. "---" .$sval['page_url']."<br>";
				if($sval['menu_tab']=='Y' and $sval['external']=='N'  )
			{
				$tab1='href="'.$sval['page_url'].'" target="_blank"';
			}
		else if($sval['menu_tab']=='Y' and $sval['external']=='Y'  )
			{
				$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay){window.open('".$sval['page_url']."', '_blank');}})";
				//"?".md5('page_id')."=".base64_encode($pkey)
				$tab1='href="#" onclick="'.$alt.'"';
			}
			else
			{
				$tab1='href="'.$sval['page_url'].'"';
			}
                if ($pkey == $sval['menu_parent_id']) {
					$no++;
                    //$menu .= '<li><a href="'.$sval['page_url'].'?'.md5('page_id').'='.base64_encode($pkey).'" class="" '.$tab1.'  title="'.$sval['page_name'].' page"  >'.$sval['page_name'].'</a>';
					$menu .= '<li id="'.$pval['menu_id'].'M'.$no.'"><a '.$tab1.'  class=""   title="'.$sval['page_name'].' page"  >'.$sval['page_name'].'</a>';
					if($sval['menu_sub_parent_id']!=0)
					$menu.='</li>';
                    //$menu .= '<li id="menu-item-4044" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044"><a href="#">'.$pval['page_name'].'</a></li>';
					if($sval['menu_sub_parent_id']==0&&!is_null($sval['menu_sub_parent_id']))
					{
						$menu .= '<ul class="sub-menu" >';
						foreach($sub_parray as $spval)
						{
							if($spval['menu_tab']=='Y' and $spval['external']=='N'  )
			{
				$tab2='href="'.$spval['page_url'].'" target="_blank"';
			}
		else if($spval['menu_tab']=='Y' and $spval['external']=='Y'  )
			{
				$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$spval['page_url']."', '_blank');}})";
				$tab2='href="#" onclick="'.$alt.'"';
			}
			else
			{
				//$tab2='';
				$tab2='href="'.$spval['page_url'].'"';
			}
							if($spval['menu_sub_parent_id']==$sval['menu_id'])
							{
								//$menu .= '<li><a href="'.$spval['page_url'].'?'.md5('page_id').'='.base64_encode($pkey).'" class="" '.$tab2.'  title="'.$spval['page_name'].' page"  >'.$spval['page_name'].'</a></li>';
								 $menu .= '<li><a  '.$tab2.' title="'.$spval['page_name'].' page" >'.$spval['page_name'].'</a></li>';
								
							}
						}
						$menu .= '</ul></li></li>';
					}
                }
            }
            $menu .= '</ul></li>';
        }
    }
    $menu .= '</ul>';
	
    return $menu;
}
	

?>

	<?php echo dyn_menu($parent_menu, $sub_menu,$sub_pmenu,$page_id);?>	
				

