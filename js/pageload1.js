//var jq = $.noConflict();
 $(document).ready(function() {
	 
	 //indexdata(30);

	
});

function getpdf(id) {
	
	
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "announcement_pdf.php",
				data: {
					action:'getpdf',
						id:id
				},
				success: function(data)
				{
						
					
						
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}
			function getpdf2(id,title) {
				
	
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "announcement_pdf.php",
				data: {
					action:'getpdf2',
						id:id,
						title:title
				},
				success: function(data)
				{
					
						
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}
function getpdf1(id) {
	
	
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "announcement_pdf.php",
				data: {
					action:'docpdf',
						id:id
				},
				success: function(data)
				{
						
					
						
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}
			
			function indexdata(id) {
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "index_data.php",
				data: {
					action:'getpdf',
						id:id
				},
				success: function(data)
				{
						
					
						
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}
			
						
						
						function homedata(id) {
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "index_data.php",
				data: {
					action:'getpdf',
						id:btoa(id)
				},
				success: function(data)
				{
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}