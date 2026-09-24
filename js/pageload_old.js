var jq = $.noConflict();
 jq(document).ready(function() {
	 
	 indexdata(30);
	 
	/*  jq.post("home.php", { },
				function(data)
				{
				jq(".content").html(data);	
				});
	 */
	
	/* jq('.mas').click(function(){ 
alert("hai");		
var id_val=30;		
				jq.post("home.php", {},
				function(data)
				{
					jq(".content").html(data);	
				});
      
    }); */
            /*     jq('.mdu').click(function(){ 
//alert("hai");				
				jq.post("mdu_a.php", { },
				function(data)
				{
					jq(".content").html(data);	
				
				});
      
    });
	
	  jq('.med').click(function(){ 
//alert("hai");				
				jq.post("mediation_a.php", { },
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    });
	 jq('.lib').click(function(){ 
//alert("hai");				
				jq.post("judges_library_a.php", { },
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    });
	 jq('.jua').click(function(){ 
//alert("hai");				
				jq.post("tnsja_a.php", { },
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    });
	 jq('.tnlsa').click(function(){ 
//alert("hai");				
				jq.post("tnlsa_a.php", { },
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    });
	
	  jq('.sub_c').click(function(){ 
//alert("hai");				
				jq.post("subcourt.php", { },
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    }); */ 
	
/* 		  jq('.anno').click(function(k){ 
alert(k);				
				jq.post("announcement_pdf.php", {},
				function(data)
				{
					jq(".content").html(data);	
					
				});
      
    }); */
	
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
			
			
			function indexdata(id) {
				if ( 'undefined' != typeof id ) {
			
					$.ajax({
				
				method: "POST",
				url: "home.php",
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
						id:id
				},
				success: function(data)
				{
						$('.content').html(data)
				}
					}).fail(function() { alert('Unable to fetch data, please try again later.') });
					
				} else alert('Unknown row id.');
			}