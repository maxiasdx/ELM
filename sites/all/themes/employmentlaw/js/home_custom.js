	//ipad and iphone
	var deviceAgent = navigator.userAgent.toLowerCase(),
    	agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    
	//STICKY WIDGET
	//$("#sidebar li.widget:last-child,#secondarySidebar li.widget:last-child, #crumbs").sticky({ topSpacing: -4, bottomSpacing: 210, className: 'sticky'});
	
	//CRUMBS FUNCTION
	function showCrumbs(){
		$(".crumbs a").each(function() {
			var delayAmount = $(this).index() * 150;
    		$(this).delay(delayAmount).animate({top:"0px"},500);
		});
	}
	//WHEN PAGE LOADS
	$(window).load(function(){
		//SHOW CRUMBS
		$('.crumbs #loading').delay(200).fadeOut(200,function(){
			showCrumbs();
		});
	});

	//REMOVE TITLE ATTRIBUTE
	/*$("#dropmenu a").removeAttr("title");
	
	//MENU
	$("#dropmenu ul a").hover(function(){
		$(this).stop(true,true).animate({paddingLeft:"5px"},100);
	},function(){
		$(this).stop(true,true).animate({paddingLeft:"0px"},200);
	});*/
	
	//HEADER SEARCH
    if (agentID) {
    	$("#headerSearch").addClass('mobileOs');
    } else {}
	
$(document).ready(function(){
	//GRAB H1 TAG AND COPY IT INTO ITEM LIST
	var newsItems = $('.cn_preview').find('.cn_content');
	newsItems.each(function(){
		$(this).find('img,h2').clone().appendTo($(this).parents('.cn_wrapper').find('.cn_list')).wrapAll('<div class="cn_item">');
	});
	$(window).load(function(){
		$('.cn_list').addClass('afterLoad');
		$('.cn_item').each(function(){
			var loadMe = $(this).index();
			$(this).delay(250*loadMe).fadeIn(250,function(){
				$('.cn_item:first-child').click();
			});
		});
	});


	//CLICKING NEWS LIST ANIMATIONS
	$('.cn_wrapper').each(function(){
		var $cn_list 	= $(this).find('.cn_list'),
			$items 		= $cn_list.find('.cn_item'),
			$cn_preview = $(this).find('.cn_preview'),
			current		= 1;
			
		$items.each(function(i){
			var $item = $(this);
			$item.data('idx',i+1);
			
			$item.bind('click',function(){
				var $this 		= $(this);
				$cn_list.find('.selected').removeClass('selected');
				$this.addClass('selected');
				var idx			= $(this).data('idx');
				var $current 	= $cn_preview.find('.cn_content:nth-child('+current+')');
				var $next		= $cn_preview.find('.cn_content:nth-child('+idx+')');
				
				if(idx > current){
					$current.stop().animate({'top':'-550px'},500,function(){
						$(this).css({'top':'550px'});
					});
					$next.css({'top':'550px'}).stop().animate({'top':'0px'},500);
				}
				else if(idx < current){
					$current.stop().animate({'top':'550px'},500,function(){
						$(this).css({'top':'550px'});
					});
					$next.css({'top':'-550px'}).stop().animate({'top':'0px'},500);
				}
				current = idx;
				return false;
			});
		});
	});	
});