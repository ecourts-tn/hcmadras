<?php  
include "header.php";
if(isset($_GET['sear']))
{
	 $sear = $_GET['sear'];
}
else
{
	 $sear ="";
}
?>


<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
 <style>
      #canvas_container {
          width: auto;
          height: auto;
          overflow: auto;
      }
 
      #canvas_container {
        background: #333;
        text-align: center;
        border: solid 3px;
      }
  </style>
<div class="pad group">

		<h2 class="post-title" align="center">Former Hon'ble Judges</h2><br>
	<div class="entry" align="center" id="content">
					
 <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
        </div>
 
        <div id="navigation_controls">
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number" onkeypress="return validateData(event)"/>
            <button id="go_next">Next</button>
        </div>
 
        <!--<div id="zoom_controls">  
            <button id="zoom_in">+</button>
            <button id="zoom_out">-</button>
        </div>-->
    </div>

  <?php

 $qry = $DB_con->query(" select * from judges_doc where j_doc_display='Y' and j_jud_id='217' and j_doc_type='F' ");
if($row = $qry->fetch())
{
	
	$id=base64_encode($row['j_doc_id']);
		$page_val=base64_encode('J');
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







