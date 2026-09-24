<?php  
include "header.php";

?>
	
<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
 <style>
     p{
          text-align:justify
      }
 
      #canvas_container {
        background: #333;
        text-align: center;
        border: solid 3px;
      }
	.divbold{
		font-weight:bold;
		font-size:20px;
		color:#26abd3;
		}
  </style>
<div class="pad group">

		<h2 class="post-title" align="center">Sesquicentennial Celebrations</h2><br>
	<div class="entry" align="center" id="content">
					
 <div >
        <p >
	  As we march into the 150th year, we invite the jurists, students and public alike in join the us in celebrating 150 years of Madras High Court. Your contributions, in the form of articles, old photographs or resource materials etc., are invited. The selected articles will find a place in the Website under the Heading Articles. 
      <br><br>
      The Madras High Court, in its sojourn in the last 149 years, has left an imprint to be followed by other judicial bodies. The judgments of the Madras High Court are famous for their analysis of facts of a given case and also for the insight. 
<br><br>
      Many a stalwart had occupied the high chairs of Judgeship of the Madras High Court and some of them had risen to occupy the high chair of the Chief Justice of India and Judge of the Supreme Court of India. Some of our advocates have adorned the chair of the President of India and some of them became the Union Ministers and State Ministers. Some of our advocates are practising as Senior Advocates in the Supreme Court of India. All of them contributed a lot in making the Madras High Court one of the premier judicial institution in India and the World. 
<br><br>
      The precincts of the Madras High Court is famous for its vast area as it is the second largest Judicial Structure in the world next only to the Courts in London. Once it was a lung space for the city environment but over the years, due to population growth, its lung space shrunk. However, the Judges of the Madras High Court make every possible effort to increase the greenery of the High Court by planting more trees. 
<br><br>
      The advocates of yesteryears, who had practised in the Madras High Court, had made huge contribution in the freedom struggle even at the cost of their practice. The Madras High Court had also played a major role in the social justice front and is still, by its judgments, upholding the spirit of the Constitution of India in the social justice front. </p>
	  
	<div style="align-items: center;display: flex;justify-content: center; "><span style="font-weight:bold;font-size:15px">Inaugural Ceremony : </span> <img src="images/video.png" width='30' height='30'><a href="https://webcast.gov.in/jwplayer/vod.html?hlsurl=//playhls.media.nic.in/vod/hcmadras/media/hcmadras.mp4/index.m3u8&image=//webcast.gov.in/uploads/events/76fe69c398bb740c_150chennai.jpg&autostart=true" alt="inaugural_video" target="_blank">Valedictory Function Of Sesquicentennial
150 Year Celebration Of Madras High Court 08th September, 2012</a> </div><br>
     
    </div>
	
	<div>
	 <a id="invite"></a> 
	  <h4>Invitation</h4>
				 <br><img src="images/invitation1.jpg" alt="Invitation" title="invitation"  width="430" height="335"> <br><br>
				 
	 <div style="align-items: center;display: flex;justify-content: center; "> <img src="images/tsong.jpg" width='40' height='40'  />&nbsp;<!--<a href="audios/hcsong.mp3"  alt="Theme song" > --><span class="divbold">Theme Song </span> <!--</a>-->
	&nbsp;&nbsp; <audio controls>
  <source src="audios/hcsong.mp3" type="audio/mpeg">
</audio></div><br>	
      <h6>Lectures</h6>
	  Lectures on Sesquicentennial Celebrations by  Mr. K. Parasaran, Senior Advocate. <br><br>
	<!--  <img src="images/lect.jpg" width='20' height='20'><a href="audios/para-A.mp3" alt="part1">Part-A</a>-->
	<div style="align-items: center;display: flex;justify-content: center; "><span class="divbold">Part-A </span>&nbsp;&nbsp;  <audio controls>
  <source src="audios/para-A.mp3" type="audio/mpeg">
</audio></div><br><div style="align-items: center;display: flex;justify-content: center; ">
<span class="divbold">Part-B </span> &nbsp;&nbsp; 
<audio controls>
  <source src="audios/para-B.mp3" type="audio/mpeg">
</audio></div>
	  <br>
	 <!-- <img src="images/lect.jpg" width='20' height='20'><a href="audios/para-B.mp3" alt="part2">Part-B</a>-->
	  <br><h4>Literature and Tablet Stones</h4>
	   <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
        </div>
 
        <div id="navigation_controls">
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number" onkeypress="return validateData(event)"/>
            <button id="go_next">Next</button>
        </div>
 
       
    </div>
	<br>
	 <h4>MADRAS HIGH COURT ADVOCATES ASSOCIATION - THE LAW DAY CHARTER</h4>
	  <p  >
	 We hold that Law is the Common heritage and trust of mankind, that administration of justice is more of the most fundamental functions of the State, adn that Judges and Lawyers owe their allegiance, by the traditions, training and tenets of their noble profession, to the cause and quest of Justice. 
     <br><br>
     We believe that the discipline of Law is indespensably essential for the authoritative and peaceful resolution of all conflicts, for ensuring orderly developement of society, for maintaining rule of law, for promoting social justice, for safeguarding liberty and for protecting basic human rights and fundamental freedoms. 
	<br><br>
     We affirm that the independence and impartiality of judiciary and the freedom and independence of the legal profession constitute the sheet-anchor of social order, individual freedom and equal justice in our society. 
	<br><br>
     We acknowledge the social responsibilities and the professional obligations of law in public interest and public service. 
	<br><br>
     We emphasize, in particular, the need to ensure equal and universal access of the people to the system of justice, especially for the poor, the weak, the deprived and the downtrodden, the need for legal literacy and legal aid, and the need for social audit and evaluation of laws and for scientific, rational and pragmatic law reform. 
	<br><br>
     We pledge and dedicate ourselves on this, the LAW DAY, to the permises and postulates of this proclamation.
	 </p>
	</div>

  <?php

 $qry = $DB_con->query("SELECT *FROM home_gallery WHERE h_gallery_id = '52'");
if($row = $qry->fetch())
{
	
	$id=base64_encode($row['h_gallery_id']);
		$page_val=base64_encode('H');
		?>
		
		<script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('admin/view_pdf.php?pdf_id=<?php echo $id; ?>&page=<?php echo $page_val; ?>').then((pdf) => {
      
            myState.pdf = pdf;
            render();
 
        });
 
        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
          
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
      
                var viewport = page.getViewport(myState.zoom);
 
                canvas.width = viewport.width;
                canvas.height = viewport.height;
          
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }
 
        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1) 
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage >= myState.pdf._pdfInfo.numPages) 
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
          
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
          
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                document.getElementById('current_page').valueAsNumber;
                                  
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });
 
     function validateData(e)
	 {
		  var charCode = (e.which) ? e.which : e.keyCode;
          if (  (charCode >=48 && charCode <=57))
             return true;	
		 return false;
	 }
    </script>
		
  
    <?php
	
}

?>
  
					<div class="clear"></div>
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
