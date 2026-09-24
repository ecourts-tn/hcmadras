<script>
function updatedashboard(val)
{
	
	alert("hao");
	$(".content").html("<div align='center'><br><br><br><img src='images/loader.gif'/></div>");
	
	function(data)
	{
		$(".content").html(data);
			};
}

</script>