/* Carregamento dos produtos das categorias via Ajax */
$(document).ready(function(){
	/*$.ajax({
        url: "http://localhost/wp-content/themes/carpigiani-theme/single-home.php",
        type: "POST",
        data: data,
        cache: false,
        success: function (data) {

            jQuery('#my-holding-ctn').html(data);

        }
    })*/

    /*$.ajaxSetup({cache:false});
    $(".trick").click(function(){
        var post_id = $(this).attr("rel");
        alert(post_id);
        $("#single-home-container").html("loading...");
        $("#single-home-container").load(post_id);
        //$("#single-home-container").load("http://<?php echo $_SERVER[HTTP_HOST]; ?>/single-home/",{id:post_id});
        //$("#single-home-container").load("http://<?php bloginfo('template_uri') ?>/single-home/",{id:post_id});

    return false;
    });*/

/* START | Menu de Categorias */
/*$(function() {
    var $links = $('.nav-menu-toogle .active-toggle');
    $links.click(function(){
        $('.sub-category-hide').fadeOut(300);
        $('ul#child-' + $(this).data('category')).slideToggle('slow');
    });
});*/
/* END | Menu de Categorias */

});
