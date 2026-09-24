<?php //$myd = date('Y/m/d');
$myd = '2020-01-23';
 include"header.php";?>
<style>
.entry table th,td {
    border: 1px solid #ccc;
}

	</style>
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
	<div class="pad group">		

	<h2 class="post-title" align="center" title="Screen Reader Access">Screen Reader Access</h2>
	<p>
	  The Madras High Court website complies with World Wide Web Consortium (W3C) Web Content Accessibility Guidelines (WCAG) 2.0 level AA. This will enable people with visual impairments access the website using assistive technologies, such as screen readers. The information of the website is accessible with different screen readers, such as JAWS, NVDA, SAFA, Supernova and Window-Eyes.
	</p>
	<br><br>	
	<p>Following table lists the information about different screen readers:</p>
	<br>	
	
	
	<div class="entry" align="center">		
	<table width="100%">
	  <caption></caption>
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">Screen Reader</th>
		  <th scope="col">Website </th>
		  <th scope="col">Free / Commercial</th>		
		</tr>
	  </thead>
	  <tbody>
	  
	    <tr class="">
		  <td data-label="S.No.">1</td>
		  <td data-label="Rule" title=" Non Visual Desktop Access (NVDA)" align='left'> Non Visual Desktop Access (NVDA)</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay) {window.open("http://www.nvda-project.org/", "_blank");}});' target="_blank">http://www.nvda-project.org/</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">2</td>
		  <td data-label="Rule" align='left' title=" System Access To Go"> System Access To Go</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay){window.open("http://www.satogo.com/", "_blank");}});' target="_blank">http://www.satogo.com/</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">3</td>
		  <td data-label="Rule" align='left' title=" Screen Access For All (SAFA)"> Screen Access For All (SAFA)</td>
		  <td data-label="Size" align='left'><a  onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay){window.open("http://www.nabdelhi.org/NAB_SAFA.htm", "_blank");}});' target="_blank">http://www.nabdelhi.org/NAB_SAFA.htm</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">4</td>
		  <td data-label="Rule" align='left' title=" WebAnywhere">   WebAnywhere</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay) {window.open("http://webanywhere.cs.washington.edu/wa.php", "_blank");}});' target="_blank">http://webanywhere.cs.washington.edu/wa.php</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">5</td>
		  <td data-label="Rule" align='left' title=" Hal">   Hal</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay){window.open("http://www.yourdolphin.co.uk/productdetail.asp?id=5", "_blank");}});' target="_blank">http://www.yourdolphin.co.uk/productdetail.asp?id=5</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">6</td>
		  <td data-label="Rule" align='left' title=" JAWS">   JAWS</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay) {window.open("http://www.freedomscientific.com/jaws-hq.asp", "_blank");}});' target="_blank">http://www.freedomscientific.com/jaws-hq.asp</a></td>
		  <td data-label="Size">Free</td>
		</tr>
		<tr><td colspan="4" height="3"></td></tr>
		<tr class="">
		  <td data-label="S.No.">7</td>
		  <td data-label="Rule" align='left' title=" Thunder">     Thunder</td>
		  <td data-label="Size" align='left'><a onclick='swal({title:"Alert",text:"External Website that opens in a new window",type:"info"}).then((isOkay)=>{if (isOkay) {window.open("http://www.screenreader.net/index.php?pageid=2", "_blank");}});' target="_blank">http://www.screenreader.net/index.php?pageid=2</a></td>
		  <td data-label="Size">Free</td>
		</tr>
	  </tbody>
	</table>
<div class="clear"></div>
</div>
	
		
	</div><!--/.pad-->
	
</div><!--/.content-->

<script>
function test()
{
	var val=swal("Are you sure you want to do this?", {  
  buttons: ["oh no!", "oh yes!"],  
});   

}
</script>


<?php include "sidebar_l.php";?>

<?php include "sidebar_r.php";?>
	


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; ?>
	
	