jQuery(function() {

	jQuery("#archive-wrapper").css('min-height','200px');

	jQuery("#archive-browser select").change(function() {
	
		jQuery("#archive-pot").empty().html("<div style='text-align: center; padding: 30px;'><img src=\"/wp/wp-content/themes/employmentlaw/images/ajax-loader-elaw.gif\"></div>");
	
		var dateArray = jQuery("#month-choice").val().split("/");
		var y = dateArray[3];
		var m = dateArray[4];
		var c = jQuery("#cat").val();
		jQuery.ajax({
		
			url: "/archives-getter/",
			dataType: "html",
			type: "POST",
			data: ({
				"employment_y": y,
				"employment_m" : m,
				"employment_c" : c
			}),
			success: function(data) {
				jQuery("#archive-pot").html(data);
				/*
				jQuery("#archive-wrapper").animate({
					height: jQuery("#archives-table tr").length * 50					
				}); */
			
			}
			
		});
			
	});

});