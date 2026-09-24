
<?php
header("cache-control: no-cache, no-store, must-revalidate");  
header("pragma: no-cache");
header('expires: 0');
header('Content-Type:text/html; charset=UTF-8');

header('X-Frame-Options: SAMEORIGIN'); 
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
/* header("Content-Security-Policy: default-src 'self';script-src 'self';script-src 'self'; style-src 'self';img-src 'self';frame-src 'self' ;"); */
header("Content-Security-Policy:".
        "connect-src 'self' ;". // XMLHttpRequest (AJAX request), WebSocket or EventSource.
        // "default-src 'self' data:  'unsafe-hashes' 'unsafe-eval'".// Default policy for loading html elements
        "frame-ancestors 'self' ;". //allow parent framing - this one blocks click jacking and ui redress
      // "frame-src 'self';". // vaid sources for frames // vaid sources for frames
        "media-src 'self' *.example.com;". // vaid sources for media (audio and video html tags src)
        "object-src 'none'; ". // valid object embed and applet tags src
        "report-uri data: 'unsafe-inline' 'unsafe-hashes' 'unsafe-eval'". //A URL that will get raw json data in post that lets you know what was violated and blocked
        "script-src 'self' 'unsafe-inline' https://ssl.google-analytics.com/ga.js ;". // allows js from self, jquery and google analytics.  Inline allows inline js
        "style-src 'self' 'unsafe-inline';");
ini_set( 'session.cookie_httponly', 1 );
ini_set( 'session.cookie_httponly', 1 );
//ini_set ('session.use_trans_sid',0);
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
include "config/dbconfig.php";
//$cur_year= date("Y");				
if(isset($_POST['search_for']) and $_POST['search_for']!='' and trim($_POST['search_for']," ")!="")
{
	
  

?>
<br><br>
<h4 class="post-title" align="center">Search Results</h4>
<div class="entry" align="center" id="content">
					
<table width="100%">    
  <tbody>      
	
<?php
	if(preg_match_all("/[(?\/)]/i",$_POST['search_for'],$matches))
	{
		$invalid_characters = implode(",",$matches[0]);
		
		?>
		 <tr>
          <td colspan="3" style="color:red;">Invalid Characters in Search</td>
	    </tr>
		<?php
	}
	else
	{
		$search_for1= trim($_POST['search_for']," ");	
		$search_for= str_replace(" ", "%", $search_for1);
    // HOME PAGE TABLE	
	//$qry0 = $DB_con->prepare("select * from mhc_homepage where (home_title ilike :search_for or home_desc ilike :search_for or short_desc ilike :search_for ) and display='Y' order by page_order");
	
	$display='Y';
	$search_for='%'.$search_for.'%';
	$qry0=$DB_con->prepare("select * from mhc_homepage where (home_title ilike :search_for or home_desc ilike :search_for or short_desc ilike :search_for ) and display= :dis order by page_order");
	$qry0->bindParam(':search_for',$search_for);
	$qry0->bindParam(':dis',$display);
	$qry0->execute();
	$i=1;
	if($qry0->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>HOME PAGE</td></tr>";
	}
	while($row0 = $qry0->fetch())
	{
		if($row0['page_url']=='#')
		{
			$page_url = 'href="javascript:homedata('.$row0['h_id'].')"';
		}
		else
		{
			$page_url ='href="'.$row0['page_url'].'" target="_blank"';
			
		}
	?>   	
	<tr>
      <td data-label="S.No."><?php echo $i;?></td>
      <td data-label="Rule" colspan="2" align="left"><a <?php echo $page_url;?> rel="category tag" id="back-to-top" ><?php echo $row0['home_title'];?></a></a></td> 
      <td></td>
	</tr>
	<?php
	$i++;
	}
	$i=$i;

	// ANNOUNCEMENT TABLE	
	$qry = $DB_con->prepare("select * from announcement where an_text ilike :search_for and display='Y' order by an_update_date DESC");
	$qry->bindParam(':search_for',$search_for);
	$qry->execute();
	//$i=1;
	if($qry->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>ANNOUNCEMENT</td></tr>";
	}
	while($row = $qry->fetch())
	{
	?>   	
	<tr>
      <td data-label="S.No."><?php echo $i;?></td>
	  <td>
	  <form method="POST" action="admin/view_pdf.php"   target="_blank">
	<input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row['an_id']);?>" />
	  <input type="hidden" name="page" id="page1"  value ="<?php echo base64_encode('A'); ?>" />
   	   <button type="submit"   style="cursor: pointer;background:white;color:#26abd3;font-weight:300;font-family:'Roboto Condensed', Arial, sans-serif;font-size:16px;text-align:left;float:left" align='left'><?php echo $row['an_text']; ?></button>
	   </form></td>
    
      <td></td>
	</tr>
	<?php
	$i++;
	}
	$i=$i;
	// MENU TABLE	
	$qry2 = $DB_con->prepare("select * from mhc_menu where page_name ilike :search_for and display='Y' and set_menu!='BM'");
	$qry2->bindParam(':search_for',$search_for);
	$qry2->execute();
	if($qry2->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>MENU</td></tr>";
	}
	
	while($row2 = $qry2->fetch())
	{

    ?> 
    <tr>
      <td data-label="S.No."><?php echo $i;?></td> 	
      <td data-label="Rule"  colspan="2" align="left"> <a href="<?php echo $row2['page_url']; ?>"><?php echo $row2['page_name']; ?></a></td>     		
	  <td></td>
	</tr>
	<?php
	    $str = 'a';        
		$qry2A = $DB_con->query("select * from mhc_menu where menu_parent_id='".$row2['menu_id']."'");
		while($row2A = $qry2A->fetch())
		{
			
		?> 
		<tr>		  
		  <td data-label="Rule" colspan="3" align="left">
		   <a href="<?php echo $row2A['page_url']; ?>" style="color:red;padding-left:4em;"><?php echo "(".$str.") " .$row2A['page_name']; ?></a></td> 
		</tr>
	<?php
	     ++$str;
		}
	$i++;
	}
	$i=$i;
	
	// DOCUMENT TABLE	
	$qry3 = $DB_con->prepare("select * from mhc_document where doc_title ilike :search_for and display='Y'");
	$qry3->bindParam(':search_for',$search_for);
	$qry3->execute();
	if($qry3->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>DOCUMENT</td></tr>";
	}
	
	while($row3 = $qry3->fetch())
	{		
		
	?>
 
    <tr >
      <td data-label="S.No."><?php echo $i;?></td>
      <td data-label="Rule" align="left">
	   <form method="POST" action="admin/view_pdf.php"   target="_blank">
		<input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row3['doc_id']);?>" />
	  <input type="hidden" name="page" id="page1"  value ='<?php echo base64_encode("D"); ?>' />
   	   <button type="submit"   style="cursor: pointer;background:white;color:#26abd3;font-weight:300;font-family:'Roboto Condensed', Arial, sans-serif;font-size:16px;text-align:left;float:left" align='left'><?php echo $row3['doc_title']; ?></button><img src="images/pdf.png" style="width:30px; height:30px; padding-left:2px;">
	   </form>
	  </td>
      <td data-label="Rule" align="left"></td>
	</tr>	
	
	<?php
	$i++;
	}
	$i=$i;
	
	// DOWNLOADS TABLE	
	$qry4 = $DB_con->prepare("select * from mhc_downloads where down_title ilike :search_for and display='Y' and down_type='pdf' ");
	$qry4->bindParam(':search_for',$search_for);
	$qry4->execute();
	if($qry4->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>DOWNLOADS</td></tr>";
	}	
	while($row4 = $qry4->fetch())
	{		
		
	?>
 
    <tr >
      <td data-label="S.No."><?php echo $i;?></td>
      <td data-label="Rule" colspan="3" align="left">
	   <form method="POST" action="admin/view_pdf.php"   target="_blank">
		<input type="hidden" name='pdf_id' id="pdf_id" value="<?php echo base64_encode($row4['download_id']);?>" />
	  <input type="hidden" name="page" id="page1"  value ='<?php echo base64_encode("O"); ?>' />
   	   <button type="submit"   style="cursor: pointer;background:white;color:#26abd3;font-weight:300;font-family:'Roboto Condensed', Arial, sans-serif;font-size:16px;text-align:left;float:left" align='left'><?php echo $row4['down_title']." (".$row4['d_language'].")"; ?></button>
	   </form>
	  
	  </td>
      <td></td>
	</tr>	
	
	<?php
	$i++;
	}
	
	// JUDGES TABLE	
	$qry5 = $DB_con->prepare("select * from judges where (j_name ilike :search_for or j_coram ilike :search_for or j_profile ilike :search_for) and j_display='Y' order by j_id");
	$qry5->bindParam(':search_for',$search_for);
	$qry5->execute();
	if($qry5->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>JUDGES</td></tr>";
	}
	
	while($row5 = $qry5->fetch())
	{	
	?>
 
    <tr>
      <td data-label="S.No."><?php echo $i;?></td>
	  
	  <?php 
	  if($row5['j_page']=='PJ')
	  {
	  ?>  	  
      <td data-label="Rule" colspan="3" align="left"><a href="present_judges.php?sear=<?php echo $row5['j_name']; ?>" target="_blank"><?php echo $row5['j_name']; ?></a></td>
	  <?php 
	  } 
	  else if($row5['j_page']=='FJ' or $row5['j_page']=='TJ')
	  {
	  ?>  	  
      <td data-label="Rule" colspan="3" align="left"><a href="former_judges.php?sear=<?php echo $row5['j_name']; ?>" target="_blank"><?php echo $row5['j_name']; ?></a></td>
	  <?php 	  
	  }
	  else if($row5['j_page']=='FC')
	  {
	  ?>  	  
      <td data-label="Rule" colspan="3" align="left"><a href="former_cj.php?sear=<?php echo $row5['j_name']; ?>" target="_blank"><?php echo $row5['j_name']; ?></a></td>
	  <?php 	  
	  }
	  ?>
      <td></td>
	</tr>	
	
	<?php
	$i++;
	}
	// REGISTRARS TABLE	
	$qry6 = $DB_con->prepare("select * from registrars where (reg_name ilike :search_for) and display='Y' order by reg_id");
	$qry6->bindParam(':search_for',$search_for);
	$qry6->execute();
	if($qry6->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>REGISTRARS</td></tr>";
	}
	
	while($row6 = $qry6->fetch())
	{	
	?>
 
    <tr>
      <td data-label="S.No."><?php echo $i;?></td>
	  
	  <?php 
	  if($row6['reg_place']=='MDU')
	  {
	  ?>  	  
      <td data-label="Rule" colspan="3" align="left"><a href="registrars_mdu.php?sear=<?php echo $row6['reg_name']; ?>" target="_blank"><?php echo $row6['reg_name']; ?></a></td>
	  <?php 
	  } 
	  else if($row6['reg_place']=='MHC')
	  {
	  ?>  	  
      <td data-label="Rule" colspan="3" align="left"><a href="registrars.php?sear=<?php echo $row6['reg_name']; ?>" target="_blank"><?php echo $row6['reg_name']; ?></a></td>
	  <?php 	  
	  }	 
	  ?>
      <td></td>
	</tr>	
	
	<?php
	$i++;
	}
	// VIDEO TABLE	
	$qry7 = $DB_con->prepare("select * from mhc_videos where video_title ilike :search_for and display='Y'");
	$qry7->bindParam(':search_for',$search_for);
	$qry7->execute();
	if($qry7->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>VIDEOS</td></tr>";
	}
	
	while($row7 = $qry7->fetch())
	{	
	?> 
    <tr>
      <td data-label="S.No."><?php echo $i;?></td>
      <td data-label="Rule" colspan="3" align="left"><a href="webcasting.php" target="_blank"><?php echo $row7['video_title']; ?></a></td>
      <td></td>
	</tr>	
	
	<?php
	$i++;
	}
	
	// REGISTRARS BY DESIGNATION TABLE	
	
	//echo "select *,A.desig,A.display from officer_designation A LEFT JOIN registrars B ON cast(B.reg_desig as integer)=A.sno where A.desig ilike '%$search_for%' and B.display='Y'";
	
	$qry8 = $DB_con->prepare("select *,A.desig,A.display from officer_designation A LEFT JOIN registrars B ON cast(B.reg_desig as integer)=A.sno where A.desig ilike :search_for and B.display='Y' order by A.sno");
	$qry8->bindParam(':search_for',$search_for);
	$qry8->execute();
	if($qry8->rowCount()>=1)
	{
		echo "<tr><td colspan='3' style='text-align:left;font-weight:bold;'>REGISTRARS BY DESIGNATION</td></tr>";
	}
	
	while($row8 = $qry8->fetch())
	{	
	?> 
    <tr>
      <td data-label="S.No."><?php echo $i;?></td>
	  <?php
	   if($row8['reg_place']=='MHC')
	   {
	   ?>
      <td data-label="Rule" colspan="3" align="left"><a href="registrars.php" target="_blank"><?php echo $row8['reg_name']; ?></a></td>
	   <?php
	   } 
	   if($row8['reg_place']=='MDU')
	   {
	   ?>
      <td data-label="Rule" colspan="3" align="left"><a href="registrars_mdu.php" target="_blank"><?php echo $row8['reg_name']; ?></a></td>
	   <?php
	   }
	   ?>
	   
      <td></td>
	</tr>	
	
	<?php
	$i++;
	}
	
	if($i==1)
	{
		?>
	    <tr>
          <td colspan="3" style="color:red;">NO RESULTS FOUND</td>
	    </tr>
		<?php
	}
	
	?>
</ul>
	<?php
	}
}
else
{
	echo "<div style='color:red; text-align:center; font-weight:bold; margin-top:90px;'>NO RESULTS FOUND</div>";
}
?>
