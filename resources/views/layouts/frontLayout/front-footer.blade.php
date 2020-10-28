

<script>
           
	///////////////// fixed menu on scroll for desktop
	if ($(window).width() > 992) {
	  $(window).scroll(function(){  
		 if ($(this).scrollTop() > 280) {
			$('#navbar_top').addClass("fixed-top");
			// add padding top to show content behind navbar
			$('body').css('padding-top', $('.navbar').outerHeight() + 'px');
		  }else{
			$('#navbar_top').removeClass("fixed-top");
			 // remove padding top from body
			$('body').css('padding-top', '0');
		  }   
	  });
	} // end if 
	if ($(window).width() < 992) {
	  $(window).scroll(function(){  
		 if ($(this).scrollTop() > 280) {
			$('#navbar_top').addClass("fixed-top mob-header");
			// add padding top to show content behind navbar
			$('body').css('padding-top', $('.navbar').outerHeight() + 'px');
		  }else{
			$('#navbar_top').removeClass("fixed-top mob-header");
			 // remove padding top from body
			$('body').css('padding-top', '0');
		  }   
	  });
	} // end if 
	$(document).ready(function(){
		$('.other-cities').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 5000,
			dots: false,
			pauseOnHover: false,
			
			responsive: 
			[
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				},
				{
				  breakpoint: 550,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
			slidesToShow: 2.5
				  }
				}
			]
			
			
		});
		var currentSlide = $('.other-cities').slick('slickCurrentSlide');
	  $('.slick-prev').toggle(currentSlide != 0);
	  $('.slick-next').toggle(currentSlide != 2);
	  
	  $('.other-cities').one('afterChange', function() {
		$('.slick-prev,.slick-next').show();
	  });
	
	
	  // Top bikers slider
	  $('.top-riders-slider').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 5000,
			dots: false,
			pauseOnHover: false,
			
			responsive: 
			[
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				},
				{
				  breakpoint: 550,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
			slidesToShow: 2.1
				  }
				}
			]
			
			
		});
		var currentSlide = $('.top-riders-slider').slick('slickCurrentSlide');
	  $('.slick-prev').toggle(currentSlide != 0);
	  $('.slick-next').toggle(currentSlide != 2);
	  
	  $('.top-riders-slider').one('afterChange', function() {
		$('.slick-prev,.slick-next').show();
	  });
	
	  // top group slider 
	  $('.top-group-slider').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 5000,
			dots: false,
			pauseOnHover: false,
			
			responsive: 
			[
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				},
				{
				  breakpoint: 550,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
			
			
		});
		var currentSlide = $('.top-group-slider').slick('slickCurrentSlide');
	  $('.slick-prev').toggle(currentSlide != 0);
	  $('.slick-next').toggle(currentSlide != 2);
	  
	  $('.top-group-slider').one('afterChange', function() {
		$('.slick-prev,.slick-next').show();
	  });
	
	  // Upcomming events 
	  $('.events-details').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 5000,
			dots: false,
			pauseOnHover: false,
			
			responsive: 
			[
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				},
				{
				  breakpoint: 550,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
			slidesToShow: 1.1
				  }
				}
			]
			
			
		});
		var currentSlide = $('.events-details').slick('slickCurrentSlide');
	  $('.slick-prev').toggle(currentSlide != 0);
	  $('.slick-next').toggle(currentSlide != 2);
	  
	  $('.events-details').one('afterChange', function() {
		$('.slick-prev,.slick-next').show();
	  });
		// document ready  
	});
	</script>
	
	
