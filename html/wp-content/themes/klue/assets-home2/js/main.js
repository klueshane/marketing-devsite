(function($) {
  var video = document.getElementById("header-video");

  video.addEventListener("ended", function() {
    this.currentTime = 8.1;
    this.play();
  });

  $(".button--nav").click(function(event) {
    event.preventDefault();
    $("html").toggleClass("nav-overlay--on").toggleClass("nav-overlay--off");      // Change nav from hidden to mobile view, but dont show it
    setTimeout( function() {    // Fade in nav
      $("html").toggleClass("nav-overlay--show");
    }, 100);
  });

  $('.slideshow').slick({
    dots: false,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
  });

  $("#header-video").get(0).play();
  $("#secondary-video__video").get(0).play();

  //outdatedBrowser({ bgColor: '#f25648', color: '#ffffff', lowerThan: 'borderImage', languagePath: '/js/vendor/outdatedbrowser/lang/en.html' }) })
})(window.jQuery);
