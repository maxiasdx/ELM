	//ipad and iphone
	var deviceAgent = navigator.userAgent.toLowerCase(),
    	agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    
	//STICKY WIDGET
	//$("#sidebar li.widget:last-child,#secondarySidebar li.widget:last-child, #crumbs").sticky({ topSpacing: -4, bottomSpacing: 210, className: 'sticky'});
	
	//PRETTY PHOTO
	function prettyPhotoFunc(){
	$("a[href$='jpg'],a[href$='png'],a[href$='gif']").attr({rel: "prettyPhoto"});
	$(".gallery-icon > a[href$='jpg'],.gallery-icon > a[href$='png'],.gallery-icon > a[href$='gif']").attr({rel: "prettyPhoto[pp_gal]"});
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal', // fast/slow/normal 
		opacity: 0.810, // Value betwee 0 and 1 
		show_title: false, // true/false 
		allow_resize: true, // true/false 
		overlay_gallery: false,
		counter_separator_label: ' of ', // The separator for the gallery counter 1 "of" 2 
		//theme: 'light_square', // light_rounded / dark_rounded / light_square / dark_square 
		hideflash: true, // Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto 
		modal: false // If set to true, only the close button will close the window 
	});
	}
	prettyPhotoFunc();

	//AJAX PAGINATION
	$(".postPages a").live('click',function() {    
		var url = $(this).attr('href'),
			height = $("#entryContainer").outerHeight(),
			entryTop = $(".posttitle").offset().top -70,
			entry = $(".entry");
				
		$("#entryContainer").css({height:height});	
		
		$("html,body").animate({scrollTop:entryTop},800);
		
    	entry.fadeOut(500,function(){
    		$("#entryContainer").html("<div id='pageLoading'>Loading...</div>").load(url + " .entry",'', function() {
        		entry.hide().fadeIn(500);
        		$(this).css({height:"auto"});
        		prettyPhotoFunc();
       		});
    	});
    	return false;
	});
	
	//SCROLL TO COMMENTS
	$('.commentsLink').click(function(){
		var commentTop = $("#commentsection").offset().top + 5 - 40;
		$("html,body").animate({scrollTop:commentTop},800);
		return false;
	});
	
	//CRUMBS FUNCTION
	function showCrumbs(){
		$("#crumbs span").each(function() {
			var delayAmount = $(this).index() * 150;
    		$(this).delay(delayAmount).animate({top:"0px"},500);
		});
	}
	//WHEN PAGE LOADS
	$(window).load(function(){
		//SHOW CRUMBS
		$('#crumbs #loading').delay(200).fadeOut(200,function(){
			showCrumbs();
		});
	});

	//REMOVE TITLE ATTRIBUTE
	$("#dropmenu a").removeAttr("title");
	
	//MENU
	$("#dropmenu ul a").hover(function(){
		$(this).stop(true,true).animate({paddingLeft:"5px"},100);
	},function(){
		$(this).stop(true,true).animate({paddingLeft:"0px"},200);
	});	
	
	//HEADER SEARCH
    if (agentID) {
    	$("#headerSearch").addClass('mobileOs');
    } else {
    	var headerSearch = $('#headerSearch input[type="text"]');
		$("#headerSearch").hover(function(){
			headerSearch.stop(true,true).fadeIn(100);
		},function(){
			headerSearch.stop(true,true).delay(800).fadeOut(350);
		});		
	}
	
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
				