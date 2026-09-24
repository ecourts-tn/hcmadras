<?php //$myd = date('Y/m/d');
$myd = '2020-01-23';
require('config/dbconfig_status.php');
 include"header.php";?>
<style>
@media (max-width: 479px) {
	.fc-border-separate td{display:revert!important;width:15%;}
	
}
</style>
	<div class="container" id="page">
		<div class="container-inner">			
			<div class="main">
				<div class="main-inner group">
<div class="content">
	
	<div class="pad group">		
<link href='x_full_calendar/fullcalendar1.css' rel='stylesheet' />
<link href='x_full_calendar/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='x_full_calendar/jquery/jquery-1.10.2.js'></script>
<script src='x_full_calendar/jquery/jquery-ui.custom.min.js'></script>
<script src='x_full_calendar/fullcalendar.js'></script>
		
<script>

<?php
$holiday_query2 = $HCMAS_DB->query("select * from holiday_t");
while($holiday_result2 = $holiday_query2->fetch())
{
?>
    $('.fc-day[data-date="<?php echo $holiday_result2['holidaydate'];?>"]').addClass("test");
	
<?php } ?>


   function myFunction()
   {
	  // var CalDate="February 2023";
	   var CalDate = $(".fc-header-title").find('h2').text();
	   var id_number = parseInt(CalDate.replace(/[^0-9.]/g, ""));
	  
	    $.ajax({
			type: "POST",
			url: "get_holidays.php",
			data: { param:btoa(CalDate),type:btoa("holiday_list") }
		  }).done(function( msg ) {
				$(".calc_holiday").html(msg);
		});

        $.ajax({
			type: "POST",
			url: "get_holidays.php",
			data: { param: btoa(CalDate),type:"holiday_note" }
		  }).done(function( msg ) {
				$(".calc_note").html(msg);
		});
		
	   
   }

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		
		
		/*  className colors
		
		className: default(transparent), important(red), chill(pink), success(green), info(blue)
		
		*/		
		
		  
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		var calendar =  $('#calendar').fullCalendar({
			
			
			
			header: {
				left: 'title',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',
			
			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			
			dayRender: function (date, cell) {
				
				/*var today = new Date("2021-05-01");
				var end = new Date("2021-05-31");
				//end.setDate(today.getDate()+7);

				 if (date.getDate() === today.getDate()) {
					cell.css("background-color", "red");
				} */
				<?php
				$holiday_query22 = $DB_con->query("select * from mhc_holiday");
				while($holiday_result22 = $holiday_query22->fetch())
				{	
				?>				
					var startdt = new Date("<?php echo $holiday_result22['holiday_from_date'];?>");
					var enddt = new Date("<?php echo $holiday_result22['holiday_to_date'];?>");
					startdt.setDate(startdt.getDate()-1);
				
				if(date >= startdt && date <= enddt) {
					  cell.css("background-color", "#A0DB9B");
					  cell.css("color", "#333");
				}
				<?php } ?>

				

			},
			
	
			
			
              
			
		});
		
		// GET HOLIDAYS FROM DB !important
		var CalDate1 = $(".fc-header-title").find('h2').text();
		//var CalDate1="February 2023";
		//alert(CalDate1);
		$.ajax({
			type: "POST",
			url: "get_holidays.php",
			data: { param: btoa(CalDate1),type:btoa("holiday_list") }
		  }).done(function( msg ) {
				$(".calc_holiday").html(msg);
		});
		
		$.ajax({
			type: "POST",
			url: "get_holidays.php",
			data: { param:btoa(CalDate1),type:"holiday_note" }
		  }).done(function( msg ) {
				$(".calc_note").html(msg);
		});
		

	});
	function changeBGColor() {
  var cols =     document.getElementsByClassName('col1');
  for(i=0; i<cols.length; i++) {
    cols[i].style.backgroundColor =    'blue';
  }
}





	
</script>
	<style>

    .alx-tab.thumbs-enabled li{padding-left:0!important}
	#calendar {
/* 		float: right; */
        margin: 0 auto;
		width: 630px;
		background-color: #FFFFFF;
		  border-radius: 6px;
        box-shadow: 0 1px 20px 9px #d2dbde;
		}
	<?php
$holiday_query1 = $HCMAS_DB->query("select * from holiday_t");
while($holiday_result1 = $holiday_query1->fetch())
{
?>	
	.fc-day[data-date^="<?php echo $holiday_result1['holidaydate'];?>"] {
	  color: red !important;
	}
<?php
}	
?>

</style>	
		<div id='wrap'>

<div id='calendar'></div>

<div style='clear:both'></div>
</div>

		
	</div><!--/.pad-->
	
</div><!--/.content-->


<div class="sidebar s1 light">
		
		<a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>
		
		<div class="sidebar-content">
			
						
<div id="alxtabs-3" class="widget widget_alx_tabs">
<br>
<h3 class="group"><span>Note</span></h3>
	<div class="alx-tabs-container">
			<ul id="tab-recent-3" class="alx-tab group thumbs-enabled calc_note">
			
			    <?php
				
				?>
				
			</ul>
	
			
			<ul id="tab-comments-3" class="alx-tab group avatars-enabled">
				<li>
				</li>
			</ul>

		
			</div>

</div>

</div>	<!--/.sidebar-content-->

</div><!--/.sidebar-->



<div class="sidebar s2">
	
	<a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>
	
	<div class="sidebar-content">
		
			
		<div id="alxposts-4" class="widget widget_alx_posts calc_holiday">
		<br>
<?php
 //include "sidebar_r.php";
?>

</div>
</div>
</div>
	


				</div><!--/.main-inner-->
			</div><!--/.main-->
		</div><!--/.container-inner-->
	</div><!--/.container-->

	<?php include "footer.php"; ?>
	
	<script>
	
	</script>