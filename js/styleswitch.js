/**
* Styleswitch stylesheet switcher built on jQuery
* Under an Attribution, Share Alike License
* By Kelvin Luck ( http://www.kelvinluck.com/ )
**/

(function($)
{
	$(document).ready(function() {
	
		$('.styleswitch').click(function()
		{
			
			switchStylestyle(this.getAttribute("rel"));
			return false;
		});
		var c = readCookie('style');
		if (c) switchStylestyle(c);
				
		
	});

	function switchStylestyle(styleName)
	{
		$('link[rel*=style][title]').each(function(i) 
		{
			this.disabled = true;
			if (this.getAttribute('title') == styleName) this.disabled = false;
		});
		createCookie('style', styleName, 365);
		//alert(styleName);
	}
})(jQuery);
// cookie functions http://www.quirksmode.org/js/cookies.html
function createCookie(name,value,days)
{
	if (days)
	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name)
{
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function eraseCookie(name)
{
	createCookie(name,"",-1);
}
// /cookie functions
function  font_incr (){		
	var fontSize = $('body, .sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size');
	var currn_val = fontSize.replace('px','');
	if(currn_val<35){
		var newFontSize = parseInt(fontSize)+1;
		$('.sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size', (newFontSize-3)+'px');
		$('body').css('font-size', newFontSize+'px');
			}
	
	/* var fontSize1 = $('.sidebar .widget, .alx-posts .post-item-title').css('font-size');
	var currn_val1 = fontSize1.replace('px','');
	if(currn_val1<35){
		var newFontSize1 = parseInt(fontSize1)+1;
		$('.sidebar .widget,.alx-posts .post-item-title').css('font-size', newFontSize1+'px');
	} */
	
}

function  font_decr (){
	
	var fontSize = $('body, .sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size');
	var currn_val = fontSize.replace('px','');
	if(currn_val > 14 ){
		var newFontSize = parseInt(fontSize)-1;
		$('.sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size', (newFontSize-3)+'px');
		$('body').css('font-size', newFontSize+'px');	}

    /* var fontSize1 = $('.sidebar .widget, .alx-posts .post-item-title').css('font-size');
	var currn_val1 = fontSize1.replace('px','');
	if(currn_val1 > 14){
		var newFontSize1 = parseInt(fontSize1)-1;
		$('.sidebar .widget,.alx-posts .post-item-title').css('font-size', newFontSize1+'px');
	} */
	
}

function  font_default (){
	
	//location.reload();
	 var fontSize = $('body, .sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size');
	var newFontSize = 13;
	$('body').css('font-size', (newFontSize+3)+'px'); 
	$('.sidebar .widget, .alx-posts .post-item-title,.tab-item-category,.tab-item-comment').css('font-size',(newFontSize)+'px');
	
}

/* function blind()
{
	$(".container-inner, .sidebar").css("background-color","black");	
	$(".container-inner a,p,h2,h1,h3").css("color","white");
	$(".container-inner a").css("color","yellow");
	$(".site-title img").css("background-color","white");
} */