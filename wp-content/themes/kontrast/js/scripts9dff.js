/*
	scripts.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Alexander "Alx" Agnarson, http://alx.media
*/

"use strict";

jQuery(document).ready(function($) {

/*  Toggle header search
/* ------------------------------------ */
	$('.toggle-search').on('click', function() {
		$('.toggle-search').toggleClass('active');
		$('.search-expand').fadeToggle(250);
            setTimeout(function(){
                $('.search-expand input').focus();
            }, 300);
	});
	
/*  Scroll to top
/* ------------------------------------ */
	$('a#back-to-top').on('click', function() {
		$('html, body').animate({scrollTop:0},'slow');
		return false;
	});
	
/*  Tabs widget
/* ------------------------------------ */	
	(function() {
		var $tabsNav       = $('.alx-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.alx-tabs-container');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
			.addClass('active');
			
			$this.parent().next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		}).children( window.location.hash ? 'a[href="' + window.location.hash + '"]' : 'a:first' ).trigger('click');

	})();
	
/*  Comments / pingbacks tabs
/* ------------------------------------ */	
	$('.comment-tabs li').on('click', function() {
		$('.comment-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.comment-tab').hide();
		var selected_tab = $(this).find('a').attr('href');
		$(selected_tab).fadeIn();
		return false;
	});

/*  Table odd row class
/* ------------------------------------ */
	$('table tr:odd').addClass('alt');

/*  Sidebar collapse
/* ------------------------------------ */
	$('body').addClass('s1-collapse');
	$('body').addClass('s2-collapse');
	
	$('.s1 .sidebar-toggle').on('click', function() {
		$('body').toggleClass('s1-collapse').toggleClass('s1-expand');
		if ($('body').is('.s2-expand')) { 
			$('body').toggleClass('s2-expand').toggleClass('s2-collapse');
		}
	});
	$('.s2 .sidebar-toggle').on('click', function() {
		$('body').toggleClass('s2-collapse').toggleClass('s2-expand');
		if ($('body').is('.s1-expand')) { 
			$('body').toggleClass('s1-expand').toggleClass('s1-collapse');
		}
	});

/*  Dropdown menu animation
/* ------------------------------------ */

/*$(document).ready(function(){

  $('.nav li').on("click", function(e){

   // $(this).next('ul').toggle();

   // e.stopPropagation();

   // e.preventDefault();

  });

});*/
//$(document).ready(function() {
	$('.nav ul.sub-menu').hide();
//});
	

	/*$('.nav li').hover( 
		function() {
			$(this).children('ul.sub-menu').slideDown('fast');
		}, 
		function() {
			$(this).children('ul.sub-menu').hide();
		}
	);*/
	var old_menu="";
	var temp="";
	var rem_m="";
	var prev="";
	var open_flag=0;
	function test(cur_menu)
	{
		temp=old_menu.toString() ;
		if(cur_menu.indexOf("M")!=-1)
			rem_m="prnt_"+cur_menu.substring(0,cur_menu.indexOf('M'));
		
		if(temp!=''&&cur_menu.indexOf("M")==-1&&temp.indexOf("M")==-1&&temp!=cur_menu){
			$("#"+temp).children('ul.sub-menu').hide();
		}
		else if(temp!=''&&cur_menu.indexOf("M")!=-1&&temp==rem_m&&temp!=cur_menu){
			//$("#"+rem_m).children('ul.sub-menu').hide();
		}
		else if(temp!=''&&temp.indexOf("M")!=-1&&cur_menu.indexOf("M")!=-1&&temp!=cur_menu)
		{
			$("#"+temp).children('ul.sub-menu').hide();
		}
		else if(temp!=''&&rem_m!=''&&temp.indexOf("M")!=-1&&cur_menu.indexOf("M")==-1&&temp!=cur_menu)
		{
			$("#"+temp).children('ul.sub-menu').hide();
			$("#"+rem_m).children('ul.sub-menu').hide();
		}
		else if(temp!=''&&temp==cur_menu)
		{ 
			if(open_flag==1)
			open_flag=0;
		 else
			open_flag=1;
			$("#"+cur_menu).children('ul.sub-menu').hide();
		}
			//alert("testing");
		old_menu=cur_menu;
		return open_flag;
	}
	
	$('.nav li').click( 
		function(e) {
			//alert ($(this).attr("id"));
			var n_open_flag;
			e.stopPropagation();
			prev=old_menu;
			if(typeof ($(this).attr("id")) !== 'undefined')
			n_open_flag=test($(this).attr("id"));
			//$(this).children('ul.sub-menu').hide();
			if(prev!=old_menu||prev==""||n_open_flag%2==0)
			{
			$(this).children('ul.sub-menu').slideDown('fast');
			}
			/*else if (prev==old_menu&&open_flag%2!=0)
			{
				open_flag=0;
			}*/
		/*else if (prev==old_menu&&open_flag==1)
		{
			$(this).children('ul.sub-menu').slideDown('fast');
			open_flag=0
		}*/

			
		});
		/*$('.nav li').hover( 
		function() {
			$(this).children('ul.sub-menu').slideDown('fast');
		}, 
		function() {
			//alert ($(this).attr("id"));
			if(typeof ($(this).attr("id")) !== 'undefined')
			test($(this).attr("id"));
		});*/
	
/*  Fitvids
/* ------------------------------------ */
	function responsiveVideo() {
			if ( $().fitVids ) {
				$('#wrapper').fitVids();
			}	
		}
		
	responsiveVideo();
	
/*  Mobile menu smooth toggle height
/* ------------------------------------ */	
	$('.nav-toggle').on('click', function() {
		slide($('.nav-wrap .nav', $(this).parent()));
	});
	 
	function slide(content) {
		var wrapper = content.parent();
		var contentHeight = content.outerHeight(true);
		var wrapperHeight = wrapper.height();
	 
		wrapper.toggleClass('expand');
		if (wrapper.hasClass('expand')) {
		setTimeout(function() {
			wrapper.addClass('transition').css('height', contentHeight);
		}, 10);
	}
	else {
		setTimeout(function() {
			wrapper.css('height', wrapperHeight);
			setTimeout(function() {
			wrapper.addClass('transition').css('height', 0);
			}, 10);
		}, 10);
	}
	 
	wrapper.one('transitionEnd webkitTransitionEnd transitionend oTransitionEnd msTransitionEnd', function() {
		if(wrapper.hasClass('open')) {
			wrapper.removeClass('transition').css('height', 'auto');
		}
	});
	}
	
});
/*(document).ready(function(){

  $('.dropdown-submenu a').on("click", function(e){

    $(this).next('ul').toggle();

    e.stopPropagation();

    e.preventDefault();

  });

});*/