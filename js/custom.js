
jQuery(document).ready(function () {
	var $ = jQuery.noConflict();
	$('.slider_area').carouFredSel({
		prev      : '#prev-slider',
		next      : '#next-slider',
		responsive: true,
		width     : '100%',
		height    : '280',
		scroll    : {
			items       : 1,
			pauseOnHover: true
		},
		items     : {
			width  : 250,
			visible: {
				min: 4,
				max: 4
			}
		}
	});
	if(location.hash.lastIndexOf('page_') != -1){
		var pageid = location.hash.slice(6);
		var siteurl = $(document.body).attr('data-siteurl');
		var ajax = siteurl+'?ajaxPage='+pageid.trim();
		$.get(ajax, function (data) {
			$('#post_ajax').html(data);
			$('.link_institucional').removeClass('atual');
			$('#bt-'+pageid).addClass('atual');
		})
	}
	$('.link_institucional').on('click', function(){
		var pageid = $(this).attr('data-id');
		var siteurl = $(document.body).attr('data-siteurl');
		var ajax = siteurl+'?ajaxPage='+pageid.trim();
		$.get(ajax, function (data) {
			$('#post_ajax').html(data);
			$('.link_institucional').removeClass('atual');
			$('#bt-'+pageid).addClass('atual');
			location.hash = 'page_'+pageid;
			$('html, body').animate({
				scrollTop: $('#post_ajax').offset().top
			}, 500);
		})
	});
	$('#slider2').carouFredSel({
		prev      : '#prev-slider',
		next      : '#next-slider',
		responsive: true,
		width     : '100%',
		scroll    : {
			items       : 1,
			pauseOnHover: true
		},
		items     : {
			width  : 250,
			visible: {
				min: 1,
				max: 4
			}
		}
	});
	jQuery(".tabContents").hide(); // Hide all tab content divs by default
	jQuery(".tabContents:first").show(); // Show the first div of tab content by default

	jQuery(".tabContaier ul li a").on('click',function () { //Fire the click event
		var id = $(this).attr('data-id');
		var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id;
		$.get(post_link, function (data) {
			$('#tab'+id).html(data);
			$('.slider_area').trigger("destroy");
			$('.slider_area').carouFredSel({
				prev      : '#prev-slider',
				next      : '#next-slider',
				responsive: true,
				width     : '100%',
				scroll    : {
					items       : 1,
					pauseOnHover: true
				},
				items     : {
					width  : 250,
					visible: {
						min: 4,
						max: 4
					}
				}
			});
		});
		var activeTab = jQuery(this).attr("href"); // Catch the click link
		jQuery(".tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
		jQuery(this).addClass("active"); // set clicked link to highlight state
		jQuery(".tabContents").hide(); // hide currently visible tab content div
		$('#tab'+id).show();
		jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.

		return false; //prevent page scrolling on tab click
	});
	jQuery('.nav ul li').on('mouseover', function () {
		jQuery('.nav ul li ul').each(function () {
			jQuery(this).css('display', 'none');
		});
		jQuery(this).find('ul').css('display', 'block');
	});
	jQuery('.nav ul li ul').on('mouseout', function () {
		jQuery(this).css('display', 'none');
	});
	jQuery(".publicacoes-link").on('click', function () {
		$('.publicacoes-link').each(function () {
			$(this).removeClass('ativo');
		})
		$(this).addClass('ativo');
		var post_link = $(this).attr("data-link");
		$.get(post_link, function (data) {
			$('#slider2').html(" ");
			$('#hide-ajax').html(data);
			$('#slider2').trigger("destroy");
			$('#slider2').carouFredSel({
				prev      : '#prev-slider',
				next      : '#next-slider',
				responsive: true,
				width     : '100%',
				scroll    : {
					items       : 1,
					pauseOnHover: true
				},
				items     : {
					width  : 250,
					visible: {
						min: 4,
						max: 4
					}
				}
			});
		});
		return false;
	});
});