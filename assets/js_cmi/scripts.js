
function scroll_to(clicked_link, nav_height) {
	var element_class = clicked_link.attr('href').replace('#', '.');
	var scroll_to = 0;
	if(element_class != '.top-content') {
		element_class += '-container';
		scroll_to = $(element_class).offset().top - nav_height;
	}
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}


jQuery(document).ready(function() {	

	//Function to disable Flutter Wave Pay button if all fields are not inputted

	$("#submit").prop('disabled', true);

		$(".form-control").keyup(function(){

			

			if ($('#name').val().trim() != '' || $('#email').val().trim() != '' || $('#number').val().trim() != '' ) {
				$("#submit").prop('disabled', false);
			}
			
			if ($('#name').val().trim() == '' || $('#email').val().trim() == '' || $('#number').val().trim() == '' ) {
				$("#submit").prop('disabled', true);
				//alert("Please Fill All FIleds");
			}
			
		});

		$("#number").keyup(function () {
			if($.isNumeric($('#number').val()) == false || $('#number').val().trim().length < 11) {
				$("#submit").prop('disabled', true);
				$('#error').html("Please Insert the correct number");
			}else{
				$('#error').empty();
			}
			
		});

		

//Carousel Multiple scrip continued
	/*
	    Navigation
	*/
	$('a.scroll-link').on('click', function(e) {
		e.preventDefault();
		scroll_to($(this), $('nav').outerHeight());
	});
	
    /*
        Background
    */
    $('.section-4-container').backstretch("assets/img/backgrounds/bg.jpg");
    
    /*
	    Wow
	*/
	new WOW().init();
	
	/*
	    Carousel
	*/
	$('#carousel-example').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('.carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('.carousel-item').eq(i).appendTo('.carousel-inner');
	            }
	            else {
	                $('.carousel-item').eq(0).appendTo('.carousel-inner');
	            }
	        }
	    }
	});
	
});
