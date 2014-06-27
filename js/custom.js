jQuery(document).ready(function () {
	var $ = jQuery.noConflict();
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
				min: 3,
				max: 3
			}
		}
	});
	if($(window).width() >= 700){
		$('.slider_documentos').carouFredSel({
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
				},
				height: 400
			}
		});
	}
	$('.create_head').each(function(){
		var content = $(this).html();
		var slug = $(this).attr('data-term-slug');
		var _id = $(this).attr('data-id');
		$('.tab-pane').each(function(){
			var id = Math.floor((Math.random() * 999999) + 1);
			$('<header class="head-'+slug+'" data-slug="'+slug+'" id="'+id+'">'+content+'</header>').appendTo(this);
			$('<div class="col-md-12 search-container container-'+slug+'" data-slug="'+slug+'" data-header="'+id+'"></div>').appendTo(this);
		});
	});
	$('.item_search').each(function(){
		var content = $(this).html();
		var area = $(this).attr('data-area-slug');
		var slug = $(this).attr('data-term-slug');
		if (slug.length == 0){
			slug = 'none';
		}
		//$('#tab-'+area+' .container-'+slug+'').append('<div class="col-md-12 content>'+content+'</div>');
		$('<div class="col-md-12 content">'+content+'</div>').appendTo('#tab-'+area+' > .search-container.container-'+slug+'');
		console.log('#tab-'+area+' .container-'+slug+'');
	});
	$('.nav-tabs li').each(function(){
		var tab = $(this).attr('data-tab-element');
		if( $(tab).length == 0 ){
			$(this).remove();
			$(tab).remove();
		}
	});
	$('.nav-tabs li:first a').trigger('click');
	$('.working-container').css('display','block');
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
		prev      : '#prev-publicacao',
		next      : '#next-publicacao',
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
	var _first = $('#first').attr('data-first');
	console.log(_first)
	$('#noticias-slider-'+_first).carouFredSel({
		prev      : '#noticias-prev-slider-'+_first,
		next      : '#noticias-next-slider-'+_first,
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
				max: 5
			}
		}
	});
	$('#publicacoes-slider-'+_first).carouFredSel({
		prev      : '#publicacoes-prev-slider-'+_first,
		next      : '#publicacoes-next-slider-'+_first,
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
	$('#acoes-slider-'+_first).carouFredSel({
		prev      : '#acoes-prev-slider-'+_first,
		next      : '#acoes-next-slider-'+_first,
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
	jQuery(".tabContents").hide(); // Hide all tab content divs by default
	jQuery(".tabContents:first").show(); // Show the first div of tab content by default

	jQuery(".tabContaier ul li a").on('click',function () { //Fire the click event
		var id = $(this).attr('data-id');
		var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=noticias';
		$.get(post_link, function (data) {
			$('#noticias-slider-'+id).trigger('destroy');
			$('#ajax-noticias').html(data);
			$('#noticias-slider-'+id).html('');
			$('#noticias-slider-'+id).carouFredSel({
				prev      : '#noticias-prev-slider-'+id,
				next      : '#noticias-next-slider-'+id,
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
			$('.ajax-item-noticias').each(function(){
				var content = $(this).html();
				var item = '<li class="item">'+content+'</li>'
				$('#noticias-slider-'+id).trigger( 'insertItem', [item, 1, false] );
			});
		});
		var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=publicacoes';
		$.get(post_link, function (data) {
			$('#ajax-publicacoes').html(data);
			$('#publicacoes-slider-'+id).trigger('destroy');
			$('#publicacoes-slider-'+id).html('');
			$('#publicacoes-slider-'+id).carouFredSel({
				prev      : '#publicacoes-prev-slider-'+id,
				next      : '#publicacoes-next-slider-'+id,
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
						max: 5
					}
				}
			});
			$('.ajax-item-publicacoes').each(function(){
				var content = $(this).html();
				var item = '<li class="item">'+content+'</li>';
				$('#publicacoes-slider-'+id).trigger( 'insertItem', [item, 1, false] );
			});
		});
		var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=acoes';
		$.get(post_link, function (data) {
			$('#acoes-slider-'+id).trigger('destroy');
			$('#acoes-slider-'+id).html('');
			$('#ajax-acoes').html(data);
			$('#acoes-slider-'+id).carouFredSel({
				prev      : '#acoes-prev-slider-'+id,
				next      : '#acoes-next-slider-'+id,
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
			$('.ajax-item-acoes').each(function(){
				var content = $(this).html();
				var item = '<li class="item">'+content+'</li>';
				$('#acoes-slider-'+id).trigger( 'insertItem', [item, 1, false] );
			});
		});
		var activeTab = jQuery(this).attr("href"); // Catch the click link
		jQuery(".tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
		jQuery(this).addClass("active"); // set clicked link to highlight state
		jQuery(".tabContents").hide(); // hide currently visible tab content div
		$('#tab'+id).show();
		jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
		$('#ajax-acoes').html("");
		$('#ajax-publicacoes').html("");
		$('#ajax-noticias').html("");
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
	$('#busca-biblioteca-bt').on('click', function(){
		$('#busca-biblioteca').submit();
	});
	$('#busca-biblioteca').on('submit', function(e){
		if( $('#area-input').val().trim() == '' ){
			e.preventDefault();
			var siteurl = $(document.body).attr('data-siteurl');
			var ajax_req = siteurl + '?isBibliotecaCountAjax=true&key='+$('#key').val()+'&tipo='+$('#select_tipo').val()+'&categoria='+$('#select_cat').val()+'&anomin='+$('#select_anomin').val()+'&anomax='+$('#select_anomax').val();
			$('#ajax-counter').load(ajax_req);
            $('html, body').animate({
                scrollTop: $('#biblioteca-require-position').offset().top
            }, 300);
            $('#biblioteca-require').fadeIn('slow');
		}
	});
    $(document).on("click", ".envia-area", function(){
        var area = $(this).attr('data-area');
        $('#area-input').val(area);
        $('#busca-biblioteca').submit();
    });
    $(document).on("click", ".bt-categorias", function(){
        var cat = $(this).attr('data-categoria');
        $('#categoria-hidden').val(cat);
        $('#busca-biblioteca-mini').submit();
    });

    $('#busca-biblioteca-mini-bt').on('click', function(){
        $('#busca-biblioteca-mini').submit();
    });
    var _ajax = '?isAjaxSubCount=true&key='+$('#key').val()+'&categoria='+$('#categoria-hidden').val()+'&area='+$('#area-hidden').val();
    $('#ajax-biblioteca-sub-count').load($(document.body).attr('data-siteurl') + '/' + _ajax);
});
