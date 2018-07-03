
$( document ).ready(function() {

  // var video = $("#header-video").get(0);
  // video.addEventListener("ended", function() {
  //   this.currentTime = 8.1;
  //   this.play();
  // });

  $('.team__member').click(function(event) {
    console.log('team__member clicked: '+$(this));
    $(this).find('.modal').css('display','block');
  });
  $('page-template-about > .modal__close').click(function (event) {
    $(this).parent().css('display','none');
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

  $('.contact__chat').click(function() {
    event.preventDefault();
    Intercom('show');
  });


  outdatedBrowser({ bgColor: '#f25648', color: '#ffffff', lowerThan: 'borderImage', languagePath: '/js/vendor/outdatedbrowser/lang/en.html' });
  responsiveVideo("#header-video");

  $('.button--demo').click(function() {
    event.preventDefault();
    $('#modal__demo').toggle();
    $('body').toggleClass('modal__demo--on');
  });

  $('.button--ebook').click(function() {
    event.preventDefault();
    var $location = $(this).attr('data-location');
    $('#modal__ebook').toggle();
    $('#modal__ebook').attr('data-location',$location)
    $('body').toggleClass('modal__demo--on');
  });

  $('.button--webinar').click(function() {
    event.preventDefault();
    var $location = $(this).attr('data-location');
    $('#modal__webinar').toggle();
    $('#modal__webinar').attr('data-location',$location)
    $('body').toggleClass('modal__demo--on');
  });

  $('.button--subscribe').click(function() {
    event.preventDefault();
    $('#modal__subscribe').toggle();
    $('body').toggleClass('modal__subscribe--on');
  });

  $('.modal__close').click(function() {
    event.preventDefault();
    $(this).closest('.modal').toggle();
    $('body').toggleClass('modal__demo--on');
  });



  // Variable to hold request
  var request;

  // Bind to the submit event of our form
  $("#modal__webinar").submit(function(event){
      var $location = $(this).attr("data-location");
      $('.modal__form').html("<h1 class='modal__success'>Request Sent</h1>");

      setTimeout(
        function()
        {
        window.location.href = $location;
      }, 2000);
      // Prevent default posting of form - put here to work in case of errors
      event.preventDefault();
  });


  $('.intro__video').click(function(e) {
    e.preventDefault();
    var video = $(this).attr('data-video');
    var html = '<iframe class="intro__video" src="' + video + '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=true" width="643" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    $(this).html(html);
  });


  $('.blognav__catlist').dragscrollable({ dragSelector:'.catlist__link', acceptPropagatedEvent: true });

});


function responsiveVideo(e){
  var videoName = $(e).attr('video-name');

  if ($(window).width() < 800) {
    $(e).append("<source type='video/mp4' src='/img/" + videoName + "-mobile.mp4' />");
    $(e).append("<source type='video/webm' src='/img/" + videoName + "-mobile.webm' />");
  } else {
    $(e).append("<source type='video/mp4' src='/img/" + videoName + ".mp4' />");
    $(e).append("<source type='video/webm' src='/img/" + videoName + ".webm' />");
  }
}
