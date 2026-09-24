
<?php


require('config/dbconfig.php');

	$parent_menu1 = array();
	$sub_menu1 = array();
	$sub_pmenu1 = array();
	$no=0;
	$qryMenu1 = "SELECT * FROM mhc_menu WHERE menu='S' AND display='Y' AND set_menu='FM' ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
	//error_log($qryMenu1);
	$resMenu1 = $DB_con->query($qryMenu1);
	while ($rowMenu1 = $resMenu1->fetchObject()) {
		
		if ($rowMenu1->menu_parent_id == 0) {
			$parent_menu1[$rowMenu1->menu_id]['page_name'] = $rowMenu1->page_name;
			$parent_menu1[$rowMenu1->menu_id]['page_url'] = $rowMenu1->page_url;
			$parent_menu1[$rowMenu1->menu_id]['main_menu_order'] = $rowMenu1->main_menu_order;
			$parent_menu1[$rowMenu1->menu_id]['menu_tab'] = $rowMenu1->menu_tab;
			$parent_menu1[$rowMenu1->menu_id]['menu_id'] = $rowMenu1->menu_id;
			$parent_menu1[$rowMenu1->menu_id]['external'] = $rowMenu1->external;

		} else {
			if(empty($rowMenu1->sub_parent_menu_id)){
			$sub_menu1[$rowMenu1->menu_id]['menu_parent_id'] = $rowMenu1->menu_parent_id;
			$sub_menu1[$rowMenu1->menu_id]['page_name'] = $rowMenu1->page_name;
			$sub_menu1[$rowMenu1->menu_id]['page_url'] = $rowMenu1->page_url;
			$sub_menu1[$rowMenu1->menu_id]['sub_menu_order'] = $rowMenu1->sub_menu_order;
			$sub_menu1[$rowMenu1->menu_id]['sub_sub_menu_order'] = $rowMenu1->sub_sub_menu_order;
			$sub_menu1[$rowMenu1->menu_id]['menu_tab'] = $rowMenu1->menu_tab;
			$sub_menu1[$rowMenu1->menu_id]['menu_id'] = $rowMenu1->menu_id;
			$sub_menu1[$rowMenu1->menu_id]['external'] = $rowMenu1->external;
			}
			if($rowMenu1->sub_parent_menu_id==0)
			{
			
			$sub_menu1[$rowMenu1->menu_id]['menu_sub_parent_id'] = $rowMenu1->sub_parent_menu_id;
			}
			else if ($rowMenu1->sub_parent_menu_id!=0&&!empty($rowMenu1->sub_parent_menu_id))
			{	
			$sub_pmenu1[$rowMenu1->menu_id]['menu_parent_id'] = $rowMenu1->menu_parent_id;
			$sub_pmenu1[$rowMenu1->menu_id]['menu_sub_parent_id'] = $rowMenu1->sub_parent_menu_id;
			$sub_pmenu1[$rowMenu1->menu_id]['page_name'] = $rowMenu1->page_name;
			$sub_pmenu1[$rowMenu1->menu_id]['page_url'] = $rowMenu1->page_url;
			$sub_pmenu1[$rowMenu1->menu_id]['sub_menu_order'] = $rowMenu1->sub_menu_order;
			$sub_pmenu1[$rowMenu1->menu_id]['sub_sub_menu_order'] = $rowMenu1->sub_sub_menu_order;
			$sub_pmenu1[$rowMenu1->menu_id]['menu_tab'] = $rowMenu1->menu_tab;
			$sub_pmenu1[$rowMenu1->menu_id]['menu_id'] = $rowMenu1->menu_id;
			$sub_pmenu1[$rowMenu1->menu_id]['external'] = $rowMenu1->external;
			}
			//echo "<script>console.log('sub_menu=".var_dump($sub_menu)."');</script>";									 
			
			if (empty($parent_menu1[$rowMenu1->menu_parent_id]['count'])) {
				$parent_menu1[$rowMenu1->menu_parent_id]['count'] = 0;
			}
			$parent_menu1[$rowMenu1->menu_parent_id]['count']++;
			
			$qrySubMenu1 = "SELECT * FROM mhc_menu WHERE  menu='S' AND display='Y' AND menu_id = '".$rowMenu1->menu_parent_id."'";
			$resSubMenu1 = $DB_con->query($qrySubMenu1);
			$rowSubMenu1 = $resSubMenu1->fetchObject(); 
			if (array_key_exists($rowSubMenu1->menu_id,$parent_menu1))	{
				$parent_menu1[$rowSubMenu1->menu_id]['page_name'] = $rowSubMenu1->page_name;
				$parent_menu1[$rowSubMenu1->menu_id]['page_url'] = $rowSubMenu1->page_url;
				$parent_menu1[$rowSubMenu1->menu_id]['main_menu_order'] = $rowSubMenu1->main_menu_order;
				$parent_menu1[$rowSubMenu1->menu_id]['menu_tab'] = $rowSubMenu1->menu_tab;
				$parent_menu1[$rowSubMenu1->menu_id]['external'] = $rowSubMenu1->external;
				$parent_menu1[$rowMenu1->menu_parent_id]['count'] = 1;
			}
		}
	}
	
	
	
		function cmp1($c, $d) {
			$p3 = $c['main_menu_order'];
			$p4 = $d['main_menu_order'];
			return (float)$p3 > (float)$p4;
		}
		uasort($parent_menu1, "cmp1");
		
		function cmp_sub1($c, $d) {
			$p3 = $c['sub_menu_order'];
			$p4 = $d['sub_menu_order'];
			return (float)$p3 > (float)$p4;
		}
		uasort($sub_menu1, "cmp_sub1");
		function cmp_sub1_sub($c, $d) {
			$p3 = $c['sub_sub_menu_order'];
			$p4 = $d['sub_sub_menu_order'];
			return (float)$p3 > (float)$p4;
		}
	uasort($sub_pmenu1, "cmp_sub1_sub");

	
	function dyn_menu1($parent_array1, $sub_array1,$sub_parray1) {
		
    $menu1 = '<ul id="menu-header" class="nav group menu">';
    foreach ($parent_array1 as $pkey1 => $pval1) {
		if($pval1['menu_tab']=='Y')
			{
				if($pval1['external']=='Y')
				{
					$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay) {window.open('".$pval1['page_url']."', '_blank');}})";
					$tab='href="#" onclick="'.$alt.'"';
				}
				else
				{
					$tab='href="'.$pval1['page_url'].'" target="_blank"';
				}
				
			
			}
			else
			{
				$tab='href="'.$pval1['page_url'].'"';
			}
        if (!empty($pval1['count'])) {
			
			
            $menu1 .= '<li id="prnt_'.$pval1['menu_id'].'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044"><a  '.$tab.'  title="'.$pval1['page_name'].' page">'.$pval1['page_name'].'</a>';
           // $menu .= '<li><a href="#subPages'.$pkey.'" data-toggle="collapse" class="collapsed"><span>'.$pval['page_name'].'</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>';
        } else {
			
            $menu1 .= '<li id="prnt_'.$pval1['menu_id'].'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044"><a  '.$tab.' title="'.$pval1['page_name'].' page">'.$pval1['page_name'].'</a></li>';
           // $menu .= '<li><a href="'.$pval['page_url'].'">'.$pval['page_name'].'</span></a></li>';
        }
		
        if (!empty($pval1['count'])) {
           $menu1 .= '<ul class="sub-menu">';
            foreach ($sub_array1 as $sval1) {
				if($sval1['menu_tab']=='Y')
			{
				if($sval1['external']=='Y')
				{
				$alt1="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay){window.open('".$sval1['page_url']."', '_blank');}})";
				$tab1='href="#" onclick="'.$alt1.'"';
				}
				else
				{  
					$tab1='href="'.$sval1['page_url'].'" target="_blank"';
				}
			}
			else
			{
				$tab1='href="'.$sval1['page_url'].'"';
			}
			
                if ($pkey1 == $sval1['menu_parent_id']) {
					$no++;
                    $menu1 .= '<li id="'.$pval1['menu_id'].'M'.$no.'"><a '.$tab1.' class="" title="'.$sval1['page_name'].' page">'.$sval1['page_name'].'</a>';//</li>
                    //$menu .= '<li id="menu-item-4044" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4044"><a href="#">'.$pval['page_name'].'</a></li>';
					if($sval1['menu_sub_parent_id']!=0)
					$menu1.='</li>';
				if($sval1['menu_sub_parent_id']==0&&!is_null($sval1['menu_sub_parent_id']))
					{
						$menu1 .= '<ul class="sub-menu">';
						foreach($sub_parray1 as $spval1)
						{
							if($spval1['menu_tab']=='Y' and $spval1['external']=='N'  )
			{
				$tab2='href="'.$spval1['page_url'].'" target="_blank"';
			}
		else if($spval1['menu_tab']=='Y' and $spval1['external']=='Y'  )
			{
				$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then((isOkay)=>{if (isOkay){window.open('".$spval1['page_url']."', '_blank');}})";
				$tab2='href="#" onclick="'.$alt.'"';
			}
			else
			{
				//$tab2='';
				$tab2='href="'.$spval1['page_url'].'"';
			}
							if($spval1['menu_sub_parent_id']==$sval1['menu_id'])
							{
								//$menu .= '<li><a href="'.$spval['page_url'].'?'.md5('page_id').'='.base64_encode($pkey).'" class="" '.$tab2.'  title="'.$spval['page_name'].' page"  >'.$spval['page_name'].'</a></li>';
								 $menu1 .= '<li><a  '.$tab2.' title="'.$spval1['page_name'].' page" >'.$spval1['page_name'].'</a></li>';
								
							}
						}
						$menu1 .= '</ul></li></li>';
					}
                }
            }
            $menu1 .= '</ul></li>';
        }
    }
    $menu1 .= '</ul>';
    return $menu1;
}
	

?>

	<?php echo dyn_menu1($parent_menu1, $sub_menu1,$sub_pmenu1);?>	
				
			
