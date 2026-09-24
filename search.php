<?php  
include "header.php";

require('config/dbconfig.php');
?>
<script>



function match(text){
	
	
	if(text!=undefined)
	{
	   var text_search = text;	
	}	
	else
	{
		var text_search = $("#search_for").val();
	}
	
	//alert($("#search_for").val());
	
	$("#search_result").html("<img src='images/spinner1.gif' style='display: block;  margin-left: auto;  margin-right: auto;  width: 50%;'   />");
	
	$.ajax({
		type: "POST",
		url: "getSearch.php",
		data: { search_for: text_search,type:"1" }
	  }).done(function( msg ) {
			//alert(msg);
			$("#search_result").html(msg);
	});
		
}

<?php
$search="";
  if(isset($_POST["search"]) and $_POST["search"]!='')
  {
	if(preg_match_all("/[(?\/)]/i",$_POST['search'],$matches))
	{
		$search="Invalid Search";
		
	}
	else
	{
		$search=$_POST['search'];
		?>
		match("<?php echo $_POST["search"];?>");
		<?php
	}
  ?>
    
  <?php
  
  }
?>

</script>
<style>
.submit
{
background: #26abd3;
color: #fff;
padding: 8px 14px;
font-weight: 600;
display: inline-block;
border: none;
cursor: pointer;
-webkit-border-radius: 3px;
border-radius: 3px;
}
</style>
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<div class="pad group">

		<h2 class="post-title" align="center">Search</h2><br>
	<div class="themeform">
    <form name="search" method="post" id="request" >
	  <input type="text" name="search_for" id="search_for" style="width:80%;float: left;" value="<?php echo $search;?>" placeholder="To search type and hit enter">
	  <input type="button" name="search" id="search" class="submit" value="Search" onclick="match()" style="float: left; margin-left: 10px;">
	</form>
   
   <div class="clear"></div>
   
    <div id="search_result">
	<?php
	if($search=="Invalid Search")
	{
		echo "<div align='center'>".$search."</div>";
	}
	?>
	</div>
   
				</div>
</div>
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

