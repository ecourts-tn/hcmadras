

<?php  
include "header.php";
require('config/dbconfig.php');
$qry = $DB_con->query("SELECT reg_prefix,reg_name,reg_place 
FROM registrars
WHERE reg_desig = '1' AND display = 'Y' AND reg_place = 'MHC'
union 
SELECT reg_prefix,reg_name,reg_place 
FROM registrars
WHERE reg_desig = '255' AND display = 'Y' AND reg_place = 'MDU'
order by reg_place desc");
$mhc_r="-";
$mdu_r="-";
while($row = $qry->fetch())
{
	if($row['reg_place']=='MHC')
		$mhc_r=$row['reg_prefix'].". ".$row['reg_name'];
	
	if($row['reg_place']=='MDU')
		$mdu_r=$row['reg_prefix'].". ".$row['reg_name'];
	
}
?>



<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">
	<h2 class="post-title" align="center">Contact us</h2><br>
	<div align="center">
<p><h3>Madras High Court</h3>
<br><p><i>
<?php echo $mhc_r;?><i><br>
Registrar General<br>
Madras High Court<br>
Chennai-600104<br>
(Tel) 91 - 044 -25301349<br>
(Fax) 91 - 044 -25341829<br>
regrgenl(at)nic(dot)in</p> 
<br><br>
	<p><h3>Madurai Bench</h3>
	<p><?php echo $mdu_r;?><br>
	Additional Registrar General<br>
Madurai<br>
(Tel) 91-0452 - 2433075<br>
(Fax) 91-0452-2433333<br>
mdubench(at)nic(dot)in </p><br><br>
<p>
   <h3> Office hours:</h3><br>
    Monday - Friday 10:00 a.m. - 5:45 p.m. Saturday & Sunday Holiday
</p>
</div>
</div><!--/.content-->
</div>

	<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

