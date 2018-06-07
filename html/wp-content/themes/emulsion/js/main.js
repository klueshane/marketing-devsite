$(window).scroll(function(i){
		var windowHeight = $(window).height();
    var scrollVar = $(window).scrollTop();
    $('h1.site-name').css({'opacity':( 100-scrollVar )/100});
    
    if (($('body').hasClass('home')) && (scrollVar > windowHeight - 100)) {
    	$('header.primary').removeClass('transparent');
    } else if($('body').hasClass('home')) {
	    $('header.primary').addClass('transparent');
    }
})

var $slider = $('.bxslider').bxSlider({
  pager: false
});

$(window).bind("load", function() {
   $('.slide-container').css('opacity',1);
});

$(document).ready(function() {
    
  $('.individual-list .project-thumb a').click(function(e){
    e.preventDefault();
    var slide_number = $(this).attr('data-slide');
    $slider.reloadSlider({
      startSlide: slide_number,
      pager: false,
      onSliderLoad: function(){
      	$('.bx-wrapper, .fullscreen-slider').css('opacity',1);
      }
    });
    $('.individual-list').hide();
    $('header.primary').addClass('transparent');
  });

  $('.return-sheet').click(function(e){
    e.preventDefault();
    $('.individual-list').show();
    $('.bx-wrapper, .fullscreen-slider').css('opacity',0);
    $('header.primary').removeClass('transparent');
  });
	 
	$("a.scroll").click(function(e) { 
	      // Prevent a page reload when a link is pressed
	    e.preventDefault(); 
	      // Call the scroll function
	    goToByScroll($(this).attr("data-section"));           
	});

	$('.mobile-icon').live('click', function(e){
		e.preventDefault();
		$('.mobile-nav').slideToggle();
	});
	
	if ($('body').hasClass('home')) {
		$('header.primary').addClass('transparent');
	}
});

$(window).resize(function(){
	var slide_number = $slider.getCurrentSlide();
	if($('.fullscreen-slider').css('opacity') == 0) {
	  $slider.reloadSlider({
	  	startSlide: slide_number,
	    pager: false,
	    onSliderLoad: function(){
	      $('.individual-list').show();
	      $('.bx-wrapper, .fullscreen-slider').css('opacity',0);
	    }
	  });
	} else {
	  $slider.reloadSlider({
	  	startSlide: slide_number,
	    pager: false,
	    onSliderLoad: function(){
	      $('.individual-list').hide();
	      $('.bx-wrapper, .fullscreen-slider').css('opacity',1);
	    }
	  });		
	}
  
  $('.mobile-nav').hide();
});

function goToByScroll(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
      // Scroll
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top - 55},
        'slow');
}
