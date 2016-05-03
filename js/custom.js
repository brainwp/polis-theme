/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
jQuery(document).ready(function () {
    var $ = jQuery.noConflict();
    $('.slider_area').carouFredSel({
        prev: '#prev-biblioteca-series',
        next: '#next-biblioteca-series',
        responsive: true,
        width: '100%',
        scroll: {
            items: 1,
            pauseOnHover: true
        },
        items: {
            width: 250,
            visible: {
                min: 3,
                max: 4
            }
        }
    });

    $(function () {
        $('.popup-modal').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#username',
            modal: true
        });
        $.magnificPopup.open({
            items: {
                src: '#modal',
                type:'inline'
            },
            modal: true
        });
        $(document).on('click', '.img', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    });

    if ($(window).width() >= 700) {
        $('.slider_documentos').carouFredSel({
            prev: '#prev-biblioteca-docs',
            next: '#next-biblioteca-docs',
            responsive: true,
            width: '100%',
            height: '280',
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 4,
                    max: 4
                },
                height: 400
            }
        });
    }
    if ($(window).width() >= 700) {
        $('.slider_institucional').carouFredSel({
            prev: '#prev-biblioteca-institucionais',
            next: '#next-biblioteca-institucionais',
            responsive: true,
            width: '100%',
            height: '280',
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 4,
                    max: 4
                },
                height: 400
            }
        });
    }

    $('.create_head').each(function () {
        var content = $(this).html();
        var slug = $(this).attr('data-term-slug');
        var _id = $(this).attr('data-id');
        $('.tab-pane').each(function () {
            var id = Math.floor((Math.random() * 999999) + 1);
            $('<header class="head-' + slug + '" data-slug="' + slug + '" id="' + id + '">' + content + '</header>').appendTo(this);
            $('<div class="col-md-12 search-container container-' + slug + '" data-slug="' + slug + '" data-header="' + id + '"></div>').appendTo(this);
        });
    });
    $('.item_search').each(function () {
        var content = $(this).html();
        var area = $(this).attr('data-area-slug');
        var slug = $(this).attr('data-term-slug');
        if (slug.length == 0) {
            slug = 'none';
        }
        //$('#tab-'+area+' .container-'+slug+'').append('<div class="col-md-12 content>'+content+'</div>');
        $('<div class="col-md-12 content">' + content + '</div>').appendTo('#tab-' + area + ' > .search-container.container-' + slug + '');
        console.log('#tab-' + area + ' .container-' + slug + '');
    });
    $('.nav-tabs li').each(function () {
        var tab = $(this).attr('data-tab-element');
        if ($(tab).length == 0) {
            $(this).remove();
            $(tab).remove();
        }
    });
    $('.biblioteca-main .pagination a').on('click', function (e) {
        e.preventDefault();
        var _href = $(this).attr('href');
        var _elem = $('.nav-tabs li.active').attr('data-tab-element').replace('#', '');
        window.location.href = _href + '#' + _elem;
    });
    if (location.hash.lastIndexOf('tab-') != -1) {
        var _elem = 'li[data-tab-element="' + location.hash + '"]' + ' a';
        if ($(_elem).length > 0) {
            $(_elem).trigger('click');
        }
        else {
            $('.nav-tabs li:first a').trigger('click');
        }
        console.log(_elem);
    }
    else {
        $('.nav-tabs li:first a').trigger('click');
    }

    $('.working-container').css('display', 'block');
    if (location.hash.lastIndexOf('page_') != -1) {
        var pageid = location.hash.slice(6);
        var siteurl = $(document.body).attr('data-siteurl');
        var ajax = siteurl + '?ajaxPage=' + pageid.trim() + '&idioma=ptbr';
        $.get(ajax, function (data) {
            $('#tab-ptbr').html(data);
            $('.link_institucional').removeClass('atual');
            $('#bt-' + pageid).addClass('atual');
        })
        var ajax = siteurl + '?ajaxPage=' + pageid.trim() + '&idioma=es';
        $.get(ajax, function (data) {
            $('#tab-es').html(data);
            $('.tabs-idioma li').each(function(){
                var elem = $(this).attr('data-tab-element');
                if($(elem + ' h1').length < 1){
                    $(elem).css('display','none');
                    $(this).css('display','none');
                }
            });
        });
    }
    $('.link_institucional').on('click', function () {
        var pageid = $(this).attr('data-id');
        var siteurl = $(document.body).attr('data-siteurl');
        var ajax = siteurl + '?ajaxPage=' + pageid.trim() + '&idioma=ptbr';
        $.get(ajax, function (data) {
            $('#tab-ptbr').html(data);
            $('.link_institucional').removeClass('atual');
            $('#bt-' + pageid).addClass('atual');
            location.hash = 'page_' + pageid;
            $('html, body').animate({
                scrollTop: $('#post_ajax').offset().top - 160
            }, 500);
        });
        var ajax = siteurl + '?ajaxPage=' + pageid.trim() + '&idioma=es';
        $.get(ajax, function (data) {
            $('#tab-es').html(data);
            $('.tabs-idioma li').each(function(){
                var elem = $(this).attr('data-tab-element');
                if($(elem + ' h1').length < 1){
                    $(elem).css('display','none');
                    $(this).css('display','none');
                }
            });
        });

    });
    $('.tabs-idioma li').each(function(){
        var elem = $(this).attr('data-tab-element');
        if($(elem + ' h1').length < 1){
            $(elem).css('display','none');
            $(this).css('display','none');
        }
    });
    if ($(window).width() > 700) {
        $('#slider2').carouFredSel({
            prev: '#prev-publicacao',
            next: '#next-publicacao',
            responsive: true,
            width: '100%',
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 5
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('#noticias-slider-atividades').carouFredSel({
            prev: '#noticias-prev-slider',
            next: '#noticias-next-slider',
            responsive: true,
            width: '100%',
            height: 400,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    var _first = $('#first').attr('data-first');
    console.log(_first)
    if ($(window).width() > 700) {
        $('#noticias-slider-' + _first).carouFredSel({
            prev: '#noticias-prev-slider-' + _first,
            next: '#noticias-next-slider-' + _first,
            responsive: true,
            width: '100%',
            height: 400,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('#publicacoes-slider-' + _first).carouFredSel({
            prev: '#publicacoes-prev-slider-' + _first,
            next: '#publicacoes-next-slider-' + _first,
            responsive: true,
            width: '100%',
            height: 340,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('.publicacoes-slider').carouFredSel({
            prev: '#prev-biblioteca-series',
            next: '#next-biblioteca-series',
            responsive: true,
            width: '100%',
            height: 450,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 200,
                visible: {
                    min: 1,
                    max: 5
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('.documentos-slider').carouFredSel({
            prev: '#prev-biblioteca-documentos',
            next: '#next-biblioteca-documentos',
            responsive: true,
            width: '100%',
            height: 340,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('.institucionais-slider').carouFredSel({
            prev: '#prev-biblioteca-institucionais',
            next: '#next-biblioteca-institucionais',
            responsive: true,
            width: '100%',
            height: 340,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    if ($(window).width() > 700) {
        $('#acoes-slider-' + _first).carouFredSel({
            prev: '#acoes-prev-slider-' + _first,
            next: '#acoes-next-slider-' + _first,
            responsive: true,
            width: '100%',
            height: 390,
            scroll: {
                items: 1,
                pauseOnHover: true
            },
            items: {
                width: 250,
                visible: {
                    min: 1,
                    max: 4
                }
            }
        });
    }
    var area_click = function (elem) {
        console.log(elem);
        var id = $(elem).attr('data-id');
        var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=noticias';
        $.get(post_link, function (data) {
            $('#noticias-slider-' + id).trigger('destroy');
            $('#ajax-noticias').html(data);
            $('#noticias-slider-' + id).html('');
            if ($(window).width() > 700) {
                $('#noticias-slider-' + id).carouFredSel({
                    prev: '#noticias-prev-slider-' + id,
                    next: '#noticias-next-slider-' + id,
                    responsive: true,
                    width: '100%',
                    height: 400,
                    scroll: {
                        items: 1,
                        pauseOnHover: true
                    },
                    items: {
                        width: 250,
                        visible: {
                            min: 1,
                            max: 4
                        }
                    }
                });
                $('.ajax-item-noticias').each(function () {
                    var content = $(this).html();
                    var item = '<li class="item item-slider noticias">' + content + '</li>'
                    $('#noticias-slider-' + id).trigger('insertItem', [item, 1, false]);
                });
            }
            else {
                $('#noticias-slider-' + id).html(data);
            }
        });
        var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=publicacoes';
        $.get(post_link, function (data) {
            $('#ajax-publicacoes').html(data);
            $('#publicacoes-slider-' + id).trigger('destroy');
            $('#publicacoes-slider-' + id).html('');
            if ($(window).width() > 700) {
                $('#publicacoes-slider-' + id).carouFredSel({
                    prev: '#publicacoes-prev-slider-' + id,
                    next: '#publicacoes-next-slider-' + id,
                    responsive: true,
                    width: '100%',
                    height: 340,
                    scroll: {
                        items: 1,
                        pauseOnHover: true
                    },
                    items: {
                        width: 250,
                        visible: {
                            min: 1,
                            max: 4
                        }
                    }
                });
                $('.ajax-item-publicacoes').each(function () {
                    var content = $(this).html();
                    var item = '<li class="item item-slider publicacoes">' + content + '</li>';
                    $('#publicacoes-slider-' + id).trigger('insertItem', [item, 1, false]);
                });
            }
            else {
                $('#publicacoes-slider-' + id).html(data);
            }
        });
        var post_link = $(document.body).attr('data-siteurl') + '/?areaAjax=' + $('#main').attr('data-slug') + '&areaCatAjax=' + id + '&areaSlider=acoes';
        $.get(post_link, function (data) {
            $('#acoes-slider-' + id).trigger('destroy');
            $('#acoes-slider-' + id).html('');
            $('#ajax-acoes').html(data);
            if ($(window).width() > 700) {
                $('#acoes-slider-' + id).carouFredSel({
                    prev: '#acoes-prev-slider-' + id,
                    next: '#acoes-next-slider-' + id,
                    responsive: true,
                    width: '100%',
                    height: 390,
                    scroll: {
                        items: 1,
                        pauseOnHover: true
                    },
                    items: {
                        width: 250,
                        visible: {
                            min: 1,
                            max: 4
                        }
                    }
                });
                $('.ajax-item-acoes').each(function () {
                    var content = $(this).html();
                    var item = '<li class="item item-slider">' + content + '</li>';
                    $('#acoes-slider-' + id).trigger('insertItem', [item, 1, false]);
                });
            }
            else {
                $('#acoes-slider-' + id).html(data);
            }
        });
        var activeTab = jQuery(this).attr("href"); // Catch the click link
        jQuery(".tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
        jQuery(elem).addClass("active"); // set clicked link to highlight state
        jQuery(".tabContents").hide(); // hide currently visible tab content div
        $('#area_' + id).show();
        jQuery(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
        $('#ajax-acoes').html("");
        $('#ajax-publicacoes').html("");
        $('#ajax-noticias').html("");
        return false; //prevent page scrolling on tab click
    }
    $(".tabContents").hide(); // Hide all tab content divs by defau
    jQuery(".tabContaier ul li a").on('click', function () { //Fire the click event
        area_click($(this));
    });
    $('.nav ul li').on('mouseover', function () {
        $('.nav ul li ul').css('display', 'none');
        $(this).find('ul').css('display', 'block');
    });
    $('.nav ul li ul').on('mouseout', function () {
        $(this).css('display', 'none');
    });
    $(".publicacoes-link").on('click', function () {
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
                prev: '#prev-slider',
                next: '#next-slider',
                responsive: true,
                width: '100%',
                scroll: {
                    items: 1,
                    pauseOnHover: true
                },
                items: {
                    width: 250,
                    visible: {
                        min: 4,
                        max: 4
                    }
                }
            });
        });
        location.hash = 'area_' + id;
        return false;
    });
    $('#busca-biblioteca-bt').on('click', function () {
        $('#busca-biblioteca').submit();
    });
    $('#busca-biblioteca').on('submit', function (e) {
        if ($('#area-input').val().trim() == '') {
            e.preventDefault();
            var siteurl = $(document.body).attr('data-siteurl');
            var ajax_req = siteurl + '?isBibliotecaCountAjax=true&key=' + $('#key').val() + '&tipo=' + $('#select_tipo').val() + '&cat=' + $('#select_cat').val() + '&anomin=' + $('#select_anomin').val() + '&anomax=' + $('#select_anomax').val();
            var ajax_req = encodeURI(ajax_req);
            $('#ajax-counter').load(ajax_req);
            $('html, body').animate({
                scrollTop: $('#biblioteca-require-position').offset().top
            }, 300);
            $('#biblioteca-require').fadeIn('slow');
        }
    });
    $(document).on("click", ".envia-area", function () {
        var area = $(this).attr('data-area');
        $('#area-input').val(area);
        $('#busca-biblioteca').submit();
        $('#area-input').val('');
    });
    $(document).on("click", ".bt-categorias", function () {
        var cat = $(this).attr('data-categoria');
        $('#categoria-hidden').val(cat);
        $('#busca-biblioteca-mini').submit();
    });

    $('#busca-biblioteca-mini-bt').on('click', function () {
        $('#busca-biblioteca-mini').submit();
    });
    var _ajax = '?isAjaxSubCount=true&key=' + $('#key').val() + '&categoria=' + $('#categoria-hidden').val() + '&area=' + $('#area-hidden').val();
    $('#ajax-biblioteca-sub-count').load($(document.body).attr('data-siteurl') + '/' + _ajax, function () {
        if ($(window).width() < 710) {
            var size = $(document.body).find('#counter-sub-count').attr('data-counter');
            $('#ajax-biblioteca-sub-count').css('height', size + 'px');
        }
    });
    /*if ($(window).width() >= 700) {
     $(document.body).css('background', 'transparent');
     $('#map-bg').contents().find('#mp-embed-bar').remove();
     $('#map-bg').css('height', $(document).height() + 'px');
     $('#map-bg').css('width', $(document).width() + 'px');
     $('#map-bg').css('display', 'block');
     function initialize() {
     var mapOptions = {
     center: new google.maps.LatLng(-23.544891, -46.644645),
     zoom: 20,
     mapTypeId: google.maps.MapTypeId.ROADMAP,
     disableDefaultUI: true,
     scrollwheel: false,
     navigationControl: false,
     mapTypeControl: false
     }
     var styles = {
     elementType: "labels",
     stylers: [
     {visibility: "off"}
     ],
     featureType: "poi",
     stylers: [
     {visibility: "off"}
     ]
     }
     var map = new google.maps.Map(document.getElementById('map-bg'),
     mapOptions);
     map.setOptions({styles: styles});
     var contentString = '<p><b>Instituto Polis</b></p>' + '<p>Rua Araújo, 124, Vila Buarque, São Paulo - SP</p></p>Tel. (11) 2174-6800</p>'
     var infowindow = new google.maps.InfoWindow({
     });
        $(document.body).css('background', 'transparent');
        $('#map-bg').contents().find('#mp-embed-bar').remove();
        $('#map-bg').css('height', $(document).height() + 'px');
        $('#map-bg').css('width', $(document).width() + 'px');
        $('#map-bg').css('display', 'block');
        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(-23.544891, -46.644645),
                zoom: 20,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                scrollwheel: false,
                navigationControl: false,
                mapTypeControl: false
            }
            var styles = {
                elementType: "labels",
                stylers: [
                    {visibility: "off"}
                ],
                featureType: "poi",
                stylers: [
                    {visibility: "off"}
                ]
            }
            var map = new google.maps.Map(document.getElementById('map-bg'),
                mapOptions);
            map.setOptions({styles: styles});
            var contentString = '<p><b>Instituto Polis</b></p>' + '<p>Rua Araújo, 124, Vila Buarque, São Paulo - SP</p></p>Tel. (11) 2174-6800</p>'
            var infowindow = new google.maps.InfoWindow({
            });

     var marker = new google.maps.Marker({
     position: new google.maps.LatLng(-23.544891, -46.644645),
     map: map,
     title: 'Polis',
     icon: 'http://brasawp.art.br/polis/wp-content/themes/polis-theme/img/logo.png'
     });
     google.maps.event.addListener(marker, 'click', function () {
     infowindow.setContent(contentString);
     infowindow.open(map, marker);
     });

     }

        google.maps.event.addDomListener(window, 'load', initialize);
    }
    */
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(
            document.createTextNode(
                "@-ms-viewport{width:auto!important}"
            )
        );
        document.getElementsByTagName("head")[0].
            appendChild(msViewportStyle);
    }
    if ($(window).width() < 700) {
        $('#nav div ul').tinyNav({
            header: 'Menu'
        });
    }
    if ($('#search_key_validate').attr('data-validate') == 'true') {
        if ($('#area-input').val().trim() == '') {
            $('#busca-biblioteca-bt').trigger('click');
        }
    }
    $('#header-search-bt').on('click', function () {
        $('#header-search-form').submit();
    });

    var sticky_width = $('.container.shadow').width();
    $('nav.sticky').css('width', sticky_width + 'px');

    var stickyNavTop = $('#nav').offset().top;
    if ($('#nav').attr('data-inload') == 'false') {
        var stickyNav = function () {
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                var data_sticky = $('nav.nav').attr('data-sticky');
                if (data_sticky != 'true') {
                    $('nav.nav').addClass('sticky');
                    $('nav.nav img').fadeIn();
                    $('nav.nav').attr('data-sticky', 'true');
                    $('nav.nav').css('width', sticky_width + 'px');
                    if ($('#wpadminbar').length > 0 && $(window).width() >= 700) {
                       $('nav.nav').css('margin-top', '32px');
                    }
                }
            } else {
                $('nav.nav').attr('data-sticky', 'false');
                $('nav.nav img').fadeOut();
                $('nav.nav').removeClass('sticky');
                $('nav.nav').removeAttr('style');
            }
        }


        //stickyNav();

        $(window).scroll(function () {
            stickyNav();
        });
    }
    if ($('#nav').attr('data-inload') == 'true') {
        $('nav.nav img').fadeIn();
        $('nav.nav').addClass('sticky');
        $('nav.nav').css('position', 'relative');

        var stickyNav = function () {
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                var data_sticky = $('nav.nav').attr('data-sticky');
                if (data_sticky != 'true') {
                    // $('nav.nav img').fadeIn();
                    $('nav.nav').attr('data-sticky', 'true');
                    $('nav.nav').css('position', 'fixed');
                    $('nav.nav').css('width', sticky_width + 'px');
                    if ($('#wpadminbar').length > 0 && $(window).width() >= 700) {
                        $('nav.nav').css('top', '46px');
                    }
                }
            } else {
                $('nav.nav').attr('data-sticky', 'false');
                $('nav.nav').removeAttr('style');
                $('nav.nav').css('position', 'relative');
            }
        }


        //stickyNav();

        $(window).scroll(function () {
            stickyNav();
        });
    }
    //area
    if (location.hash.lastIndexOf('area_') != -1) {
        var area = location.hash.slice(6);
        //var _elem = 'a[href="#tab'+area+'"]';
        var _elem = 'a[href="#area_' + area + '"]';
        console.log('area:' + _elem);
        if ($(_elem).length > 0) {
            //alert('chegou aqui?');
            $(_elem).trigger('click');
        }
        else {
            $(".tabContents:first").show(); // Show the first div of tab content by default
        }
    }
    else {
        $(".tabContents:first").show(); // Show the first div of tab content by default
    }

    function isElementVisible(elementToBeChecked)
    {
        var TopView = $(window).scrollTop();
        var BotView = TopView + $(window).height();
        var TopElement = $(elementToBeChecked).offset().top;
        var BotElement = TopElement + $(elementToBeChecked).height();
        return ((BotElement <= BotView) && (TopElement >= TopView));
    }

    if($('#equipe_load').attr('data-ajax') == 'true'){
        //ajax equipe
        var equipe_area_atual = 'reforma-urbana';

        var ajax = siteurl + '?ajaxEquipe=true&query=' +equipe_area_atual;
        $.get(ajax, function (data) {
            $(data).appendTo('#equipe_load').hide().fadeIn('slow');
            //$('#load_ajax_icon').css('display','none');
        })
        var ajax = siteurl + '?ajaxEquipe=true&query=democracia-e-participacao';
        $.get(ajax, function (data) {
            $(data).appendTo('#equipe_load').hide().fadeIn('fast');
            console.log('reforma' +data)
            $('#load_ajax_icon').css('display','none');
        });
        equipe_area_atual = 'democracia-e-participacao';
    }
    $(window).scroll(function(e){
        var is_view = isElementVisible('#footer');
        if(is_view) {
            if(equipe_area_atual == 'reforma-urbana'){
                $('#load_ajax_icon').css('display','block');
                var ajax = siteurl + '?ajaxEquipe=true&query=democracia-e-participacao';
                $.get(ajax, function (data) {
                    $(data).appendTo('#equipe_load').hide().fadeIn('fast');
                    console.log('reforma' +data)
                    $('#load_ajax_icon').css('display','none');
                });
                equipe_area_atual = 'democracia-e-participacao';
            }
            if(equipe_area_atual == 'democracia-e-participacao'){
                $('#load_ajax_icon').css('display','block');
                var ajax = siteurl + '?ajaxEquipe=true&query=inclusao-e-sustentabilidade';
                $.get(ajax, function (data) {
                    $(data).appendTo('#equipe_load').hide().fadeIn('fast');
                    console.log('democracia' +data)
                    $('#load_ajax_icon').css('display','none');
                });
                equipe_area_atual = 'inclusao-e-sustentabilidade';
            }
            if(equipe_area_atual == 'inclusao-e-sustentabilidade'){
                $('#load_ajax_icon').css('display','block');
                var ajax = siteurl + '?ajaxEquipe=true&query=cidadania-cultural';
                $.get(ajax, function (data) {
                    $(data).appendTo('#equipe_load').hide().fadeIn('fast');
                    console.log('inclusao' +data)
                    $('#load_ajax_icon').css('display','none');
                });
                equipe_area_atual = 'cidadania-cultural';
            }
            if(equipe_area_atual == 'cidadania-cultural'){
                $('#load_ajax_icon').css('display','block');
                var ajax = siteurl + '?ajaxEquipe=true&query=Institucional';
                $.get(ajax, function (data) {
                    $(data).appendTo('#equipe_load').hide().fadeIn('fast');
                    console.log('cidadania' +data)
                    $('#load_ajax_icon').css('display','none');
                });
                equipe_area_atual = 'Institucional';
            }
            if(equipe_area_atual == 'Institucional'){
                $('#load_ajax_icon').css('display','block');
                var ajax = siteurl + '?ajaxEquipe=true&query=Outro';
                $.get(ajax, function (data) {
                    $(data).appendTo('#equipe_load').hide().fadeIn('fast');
                    console.log('Institucional' +data)
                    $('#load_ajax_icon').css('display','none');
                });
                equipe_area_atual = false;
            }
        }
    });
    //home animation
    $( 'body.home .hover' ).on('mouseover', function(e){
        if ( $(window).width() < 760 ) {
            return;
        }

        $elem = $(this);
        $('body.home .hover.active').removeClass('active');
        $elem.addClass('active');
        $('.content.atuacao').css('background-image', 'url('+$elem.attr('data-bg')+')');
        $('.body.home .hover').each( function(){

            if ( ! $(this).hasClass('active') ) {
                $( this ).animate({ opacity: 0.40 }, 2000, function() {});
            }
            else {
                $( this ).animate({ opacity: 1 }, 2000, function() {});
            }
        });
    });
    $( 'body.home .content.atuacao' ).on('mouseout', function(e){
        if ( $(window).width() < 760 ) {
            return;
        }
        $(this).removeAttr( 'style' );
        $('.hover').addClass('active');
    });

    $('body.home .hover').on('click', function(e){
        window.location = $(this).attr('data-href');
    });
});