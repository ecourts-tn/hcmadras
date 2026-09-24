<?php 
	$menu_page_id=array();
	$parent_menu = array();
	$sub_menu = array();
	if(isset($_SESSION['uMenu']) && trim($_SESSION['uMenu']) != "") {
		$menuList = "'".implode("','",explode(',',$_SESSION['uMenu']))."'";
	} else {
		$menuList = "'0'";
	}
	
	$qryMenu = "SELECT * FROM mhc_menu WHERE menu_id IN ($menuList) and set_menu='BM' and display='Y' ORDER BY main_menu_order,sub_menu_order ASC";
	//error_log($qryMenu);
	$resMenu = $DB_con->query($qryMenu);
	while ($rowMenu = $resMenu->fetchObject()) {
		$menu_page_id[]=$rowMenu->menu_id;
		if ($rowMenu->menu_parent_id == 0) {
			$parent_menu[$rowMenu->menu_id]['page_name'] = $rowMenu->page_name;
			$parent_menu[$rowMenu->menu_id]['page_url'] = $rowMenu->page_url;
			$parent_menu[$rowMenu->menu_id]['main_menu_order'] = $rowMenu->main_menu_order;
			$parent_menu[$rowMenu->menu_id]['class_fun'] = $rowMenu->class_fun;

		} else {
			$sub_menu[$rowMenu->menu_id]['menu_parent_id'] = $rowMenu->menu_parent_id;
			$sub_menu[$rowMenu->menu_id]['page_name'] = $rowMenu->page_name;
			$sub_menu[$rowMenu->menu_id]['page_url'] = $rowMenu->page_url;
			$sub_menu[$rowMenu->menu_id]['sub_menu_order'] = $rowMenu->sub_menu_order;
			$sub_menu[$rowMenu->menu_id]['class_fun'] = $rowMenu->class_fun;
			
			if (empty($parent_menu[$rowMenu->menu_parent_id]['count'])) {
				$parent_menu[$rowMenu->menu_parent_id]['count'] = 0;
			}
			$parent_menu[$rowMenu->menu_parent_id]['count']++;
			
			$qrySubMenu = "SELECT * FROM mhc_menu WHERE menu_id = '".$rowMenu->menu_parent_id."'";
			$resSubMenu = $DB_con->query($qrySubMenu);
			$rowSubMenu = $resSubMenu->fetchObject(); 
			if (array_key_exists($rowSubMenu->menu_id,$parent_menu))	{
				$parent_menu[$rowSubMenu->menu_id]['page_name'] = $rowSubMenu->page_name;
				$parent_menu[$rowSubMenu->menu_id]['page_url'] = $rowSubMenu->page_url;
				$parent_menu[$rowSubMenu->menu_id]['main_menu_order'] = $rowSubMenu->main_menu_order;
				$parent_menu[$rowSubMenu->menu_id]['class_fun'] = $rowSubMenu->class_fun;
				$parent_menu[$rowMenu->menu_parent_id]['count'] = 1;
			}
		}
	}
	//print_r($parent_menu);
	
	
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

	
	function dyn_menu($parent_array, $sub_array,$chkstr,$page_id) {
    $menu = '<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true"><ul class="navigation-left"><li class="nav-item '.$page_id.'"><a class="nav-item-hold" href="dashboard.php?CheckString='.$chkstr.'" ><i class="nav-icon i-Bar-Chart"></i> <span class="nav-text">Dashboard</span></a><div class="triangle"></div></li>';
    foreach ($parent_array as $pkey => $pval) {
		//echo "<br> $pkey => $pval";
		if(base64_decode($page_id)==$pkey)
		{
			$act_status='active';
		}
		else
		{
			$act_status='';
		}
		
		
        if (!empty($pval['count'])) {
            $menu .= '<li class="nav-item '.$act_status.'" data-item="'.$pkey.'"><a href="'.$pval['page_url'].'"  class="nav-item-hold" ><span>'.$pval['page_name'].'</span> <i class="nav-icon '.$pval['class_fun'].'"></i></a><div class="triangle"></div></li>';
        } else {
            $menu .= '<li class="nav-item '.$act_status.'"><a class="nav-item-hold" href="'.$pval['page_url'].'?CheckString='.$chkstr.'&&'.md5('page_id').'='.base64_encode($pkey).'"><i class="nav-icon '.$pval['class_fun'].'"></i><span class="nav-text">'.$pval['page_name'].'</span></a><div class="triangle"></div></li>';
        }
		
        if (!empty($pval['count'])) {
            $menu .= '<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true"><ul class="childNav" data-parent="'.$pkey.'">';
            foreach ($sub_array as $sval) {
                if ($pkey == $sval['menu_parent_id']) {
                    $menu .= '<li class="nav-item"><a href="'.$sval['page_url'].'?CheckString='.$chkstr.'&&'.md5('page_id').'='.base64_encode($pkey).'" class=""><i class="nav-icon '.$sval['class_fun'].'"></i><span class="item-name">'.$sval['page_name'].'</span></a></li>';
                }
            }
            $menu .= '</ul></div>';
        }
		
		
    }
    $menu .= '</ul></div>';
    return $menu;
}
	 //$url="https://www.hcmadras.tn.nic.in/hcmadras/admin/user_management.php?CheckString=$2y$11$3FRrT5C1IbJWPPwbjkJrFO.0VT4A.HihJfZdxzU4yIExzU/Pmh5pe";
/*	$url=filter_var($_SERVER['REQUEST_URI'],FILTER_SANITIZE_STRING);
	$url_temp=explode('.php?',$url);
	 $url_temp1=explode("admin/",$url_temp[0]);
	 $pg_name=$url_temp1[1].".php";
	 
	 $page_id_data=$menu_page_id[$pg_name];
	 $page_id_data=base64_encode($page_id_data);
	 echo $pg_name."--".$page_id_data;
	 //echo $pg_name."=".$pg_id;
	*/
	//print_r( $menu_page_id);
	 echo dyn_menu($parent_menu, $sub_menu,$chkstr,$page_id);
	 
	
?>

				