
/* Animate input search Header */
var next_move = "expand";
$(document).ready(function () {

	$(".wrapper-simple").click(function() {
	    console.log(next_move);
	    var css = {};
	    if (next_move == "expand") {
	        css = {
	            width: '300px',
	            /*height: '300px'*/
	        };
	        next_move = "shrink";
	    } else {
	        css = {
	            width: '300px',
	            /*height: '152px'*/
	        };     
	        //console.log('hi');
	        next_move = "expand";
	    }
	    $(this).animate(css, 200);
	});


	/*$('.wrapper-simple input[type=text]').css('background-color', '#008EC8');	
	$('.wrapper-simple input[type=submit]').toggle(function(){
	
		$('.wrapper-simple').animate({'width':'350px'})
		  $('.wrapper-simple input[type=text]').animate({'width': '250px'})
		  $('.wrapper-simple img').animate({'marginLeft': '2px'})
		  $(this).animate({'marginLeft':'22em'}).addClass('cancel');
		
		}, function() {
			
			$('.wrapper-simple').animate({'width':'60px'})
			$('.wrapper-simple input[type=text]').animate({'width': '1px'})
			$('.wrapper-simple img').animate({'marginLeft': '0'})
			//.end().find(this).animate({'marginLeft':'0'}).attr('value', '');
			$(this).animate({'marginLeft':'0'}).removeClass('cancel');
			
		}

	);*/

});