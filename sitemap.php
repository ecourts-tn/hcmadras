<?php  
include "header.php";
include "config.php";


?>



<!------ Include the above in your HEAD tag ---------->


<style>
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, 
.tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:2px solid #000;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:2px solid #000;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #000;
    border-radius:3px;
    display:inline-block;
    padding:10px;
    text-decoration:none;
    cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:27px
}
.tree li span:hover {   
    border:2px solid #94a0b4;
    }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
    
#Web ul{padding:revert!important}	
.mmenu{background:#51a9b1; color:#000;}    
.mmenu a{color:#000; font-weight:bold;}
.submenu{background:#adebf1; color:#000;}
.submenu a{color:#000; font-weight:bold;}
.submenu1{background:#b9dee9; color:#000;}
.submenu1 a{color:#000; font-weight:bold;}


@media only screen and (max-width: 479px)
{
	table td {
		text-align: left!important;
        padding: 40px 0px;		
	}
}
</style>
<script>
</script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
<h2 class="post-title" align="center">Sitemap</h2><br>
 
 
<!---- START --->
<table style="width:100%;">
<tbody>
 <tr>
 
 <td >
<div class="tree">
<ul>



<li>
    <span style="background:#055a62;"><a href="index.php" title="index file" style="color:#fff; text-decoration:none;"><i class="fa fa-home"></i> HOME</a></span>
	<div id="Web" class="collapse show">
		<ul>
		
		<?php
		$qryMenu = "SELECT * FROM mhc_menu WHERE menu='M' AND display='Y' and menu_parent_id='0' ORDER BY main_menu_order,sub_menu_order ASC";
		//error_log($qryMenu);
		$resMenu = $DB_con->query($qryMenu);
		while ($rowMenu = $resMenu->fetchObject()) 	
		{	if($rowMenu->page_url!='#'){
			if($rowMenu->external!='Y')
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i> <a href="'.$rowMenu->page_url.'"> '.strtoupper($rowMenu->page_name).'</a></span>';
		else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowMenu->page_name).'</a></span>';
		}
		}
				else echo ' <li ><span class="mmenu"><i class="fa fa-link"></i><a> '.strtoupper($rowMenu->page_name).'</a></span>';
		
				echo '<ul>
					<div id="page1" class="collapse">';
					
					$qrySMenu = "SELECT * FROM mhc_menu WHERE menu='M' AND display='Y' and menu_parent_id ='$rowMenu->menu_id'  and (sub_parent_menu_id ='0' or sub_parent_menu_id is null ) ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
					//error_log($qryMenu);
					$resSMenu = $DB_con->query($qrySMenu);
					while ($rowSMenu = $resSMenu->fetchObject()) 
						//echo var_dump($rowSMenu);
					{	if(!is_null($rowSMenu->sub_parent_menu_id)&&$rowSMenu->sub_parent_menu_id==0)
					  {  
				  if($rowSMenu->external!='Y')
						echo '<li><span class="submenu"><i class="fa fa-link"></i><a href="'.$rowSMenu->page_url.'"> '.strtoupper($rowSMenu->page_name).'</a></span>';
					else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSMenu->page_name).'</a></span>';
		}
					
				  echo '<ul>
					<div id="page2" class="collapse">';
							$qrySSMenu = "SELECT * FROM mhc_menu WHERE menu='M' AND display='Y' and 
menu_parent_id ='$rowMenu->menu_id'  and sub_parent_menu_id ='$rowSMenu->menu_id'  ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
								//error_log($qryMenu);
							$resSSMenu = $DB_con->query($qrySSMenu);
								while ($rowSSMenu = $resSSMenu->fetchObject()) 
								{
									if($rowSSMenu->external!='Y')
									 echo '<li><span class="submenu1"><i class="fa fa-link"></i><a href="'.$rowSSMenu->page_url.'"> '.strtoupper($rowSSMenu->page_name).'</a></span></li>';
								 else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSSMenu->page_name).'</a></span>';
		}
								}
								echo '</div></ul></li>';
				  
				  }
						else
						{		
					if($rowSMenu->external!='Y')
					   echo '<li><span class="submenu"><i class="fa fa-link"></i><a href="'.$rowSMenu->page_url.'"> '.strtoupper($rowSMenu->page_name).'</a></span></li>';
					else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSMenu->page_name).'</a></span>';
		}
						}
						
					}
					echo '</div></ul>';
			
			
			
			echo '</li>';
		}
		?>
		
		 
		</ul>
	</div>
	
</li>
</ul>

</div>
</td>

<td >
<div class="tree">
<ul>



<li>
    <span style="background:#055a62;"><a href="index.php" style="color:#fff; text-decoration:none;"><i class="fa fa-home"></i> HOME</a></span>
	<div id="Web" class="collapse show">
		<ul>
		
		<?php
		$qryMenu = "SELECT * FROM mhc_menu WHERE menu='S' AND display='Y' and menu_parent_id='0' ORDER BY main_menu_order,sub_menu_order ASC";
		//error_log($qryMenu);
		$resMenu = $DB_con->query($qryMenu);
		while ($rowMenu = $resMenu->fetchObject()) 
		{
			if($rowMenu->page_url!='#'){
				if($rowMenu->external!='Y')
				echo ' <li ><span class="mmenu"><i class="fa fa-link"></i> <a href="'.$rowMenu->page_url.'"> '.strtoupper($rowMenu->page_name).'</a></span>';
			else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowMenu->page_name).'</a></span>';
		}
			}
			else 
				echo ' <li ><span class="mmenu"><i class="fa fa-link"></i><a> '.strtoupper($rowMenu->page_name).'</a></span>'; 

						
				echo '<ul>
					<div id="page1" class="collapse">';
					
					$qrySMenu ="SELECT * FROM mhc_menu WHERE menu='S' AND display='Y' and menu_parent_id ='$rowMenu->menu_id'  and (sub_parent_menu_id ='0' or sub_parent_menu_id is null ) ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
					//error_log($qryMenu);
					$resSMenu = $DB_con->query($qrySMenu);
					while ($rowSMenu = $resSMenu->fetchObject()) 
					{	if(!is_null($rowSMenu->sub_parent_menu_id)&&$rowSMenu->sub_parent_menu_id==0)
					  {  
				  if($rowSMenu->external!='Y')
						echo '<li><span class="submenu"><i class="fa fa-link"></i><a href="'.$rowSMenu->page_url.'"> '.strtoupper($rowSMenu->page_name).'</a></span>';
					else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSMenu->page_name).'</a></span>';
		}
				  echo '<ul>
					<div id="page2" class="collapse">';
							$qrySSMenu = "SELECT * FROM mhc_menu WHERE menu='S' AND display='Y' and 
menu_parent_id ='$rowMenu->menu_id'  and sub_parent_menu_id ='$rowSMenu->menu_id'  ORDER BY main_menu_order,sub_menu_order,sub_sub_menu_order ASC";
								//error_log($qryMenu);
							$resSSMenu = $DB_con->query($qrySSMenu);
								while ($rowSSMenu = $resSSMenu->fetchObject()) 
								{
									if($rowSSMenu->external!='Y')
									 echo '<li><span class="submenu1"><i class="fa fa-link"></i><a href="'.$rowSSMenu->page_url.'"> '.strtoupper($rowSSMenu->page_name).'</a></span></li>';
									  else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSSMenu->page_name).'</a></span>';
		}
								}
								echo '</div></ul></li>';
				  
				  }
						else	{	
			if($rowSMenu->external!='Y')						
					   echo '<li><span class="submenu"><i class="fa fa-link"></i><a href="'.$rowSMenu->page_url.'"> '.strtoupper($rowSMenu->page_name).'</a></span></li>';
						else{
			$alt="swal({title:'Alert',text:'External Website that opens in a new window',icon:'info'}).then(function() {window.open('".$rowSMenu->page_url."', '_blank');})";
			echo ' <li ><span class="mmenu"><i class="fa fa-link"></i>  <a href="#"  onclick="'.$alt.'" >'.strtoupper($rowSMenu->page_name).'</a></span>';
		}
							
						}}
					echo '</div></ul>';
			
			
			
			echo '</li>';
		}
		?>
		
		 
		</ul>
	</div>
	
</li>
</ul>

</div>
</td>

</tr>
</tbody>
</table>

<!-- END -->
  
	</div><!--/.pad-->
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

