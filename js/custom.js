	jQuery(document).ready(function(){
		var $ = jQuery.noConflict();
		$('#slider-news').carousel()
		jQuery(".tabContents").hide(); // Hide all tab content divs by default
		jQuery(".tabContents:first").show(); // Show the first div of tab content by default
		
		jQuery(".tabContaier ul li a").click(function(){ //Fire the click event
			
			var activeTab = jQuery(this).attr("href"); // Catch the click link
			jQuery(".tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
			jQuery(this).addClass("active"); // set clicked link to highlight state
			jQuery(".tabContents").hide(); // hide currently visible tab content div
			jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
			
			return false; //prevent page scrolling on tab click
		});
		jQuery('.nav ul li').on('mouseover', function(){
			jQuery('.nav ul li ul').each(function(){
				jQuery(this).css('display','none');
			});
			jQuery(this).find('ul').css('display','block');
		});
		jQuery('.nav ul li ul').on('mouseout', function(){
			jQuery(this).css('display','none');
		});
		jQuery(".publicacoes-link").on('click',function(){
			$('.publicacoes-link').each(function(){
				$(this).removeClass('ativo');
			})
			var post_link = $(this).attr("data-link");
			//alert(post_id);
			//$("#single-home-container").html("<div class='box'><span class='loader5'></span></div>");
			$('#slider-ajax').load(post_link);
			return false;
		});
	});