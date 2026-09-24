<?php  
include "header.php";

?>




<style>

.odd td{background:#eee;}
#j_name{
	height:30px;
}

	</style>


	 <script>
	$(document).ready(function(){
//	$("#content").hide();
	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})

/*$(document).ready( function () {
	
	// 
	
	$('#table_id2').DataTable(
	{
		"ordering":false,
				drawCallback: function() {
					/*   $.fn.popover.Constructor.Default.whiteList.table = [];
    $.fn.popover.Constructor.Default.whiteList.tr = [];
    $.fn.popover.Constructor.Default.whiteList.td = [];
    $.fn.popover.Constructor.Default.whiteList.th = []; */
			/*$("[data-toggle=popover]").popover({
				sanitize: false,
				
			  });
			
		  }

	});
	
	//$('[data-toggle="popover"]').popover();
	
} );*/
function getDocNames()
{
	var j_id=$('#j_name').val();
	$.post("j_speechesMethod.php", {jud_id: btoa(j_id)}, function(result){
	$("#doc_view").html(result);
	$('#table_id2').DataTable();
	});
}

      </script>
	  
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">

<h2 class="post-title" align="center">Speeches Of Honourable Judges</h2><br>
<div> <center>
<label style='font-weight: bold;'>Select Hon'ble Judge Name</label>

											<select class="form-control" id="j_name" required="required" id="j_name" name="j_name" autocomplete="off" onchange="getDocNames()">
                                                 <option value="" selected disabled>Select Name</option>
												<?php $sql1 ="SELECT judges.j_sen,judges.j_id, judges.j_name, judges.j_prefix,  judges.j_coram, judges.j_type
FROM judges 
INNER JOIN judges_doc ON judges.j_id=judges_doc.j_jud_id 
 and judges.j_display='Y' AND judges_doc.j_doc_display='Y'
 AND judges_doc.j_doc_type='S'  GROUP BY judges_doc.j_jud_id,judges.j_sen,judges.j_id, judges.j_name, 
judges.j_prefix, judges.j_coram, judges.j_type ORDER BY judges.j_id, judges.j_sen";
	$exe1 = pg_query($bd22,$sql1);
	while($row_jud = pg_fetch_array($exe1))
							{
	
	$hon="Hon'ble ";
			$sen=$row_jud['j_sen'];
			
			$prefi=$row_jud['j_prefix'];
	$name=ucwords(strtolower($row_jud['j_name']));


	$coram=$row_jud['j_coram'];
	$j_type=$row_jud['j_type'];
	if($j_type=='CJI')
	{
		$fjudge=', Chief Justice of India';
		
	}
	else if($j_type=='CJ')
	{
		$fjudge=', Chief Justice';
		
	}else if($j_type=='ACJ')
	{
		$fjudge=', Acting Chief Justice';
		
	}else
	{
		
		$fjudge='';
	}
	?>
                                                <option value="<?php echo $row_jud['j_id']; ?>"><?php echo $hon.$prefi.".Justice ".$name.$fjudge; ?></option>
							<?php }?>
                                            </select></center></div>
											<br><br>
                                            <div class='popover-content' id="doc_view">
                                               

                                            </div>
 
 

	<!--/.pad-->
</div><!--/.content-->



<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>

				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->
<?php include "footer.php"; ?>

