


$( document ).ready(function() {
var ninjaFormsResourcesListener = Marionette.Object.extend({

    initialize: function() {
      this.listenTo( Backbone.Radio.channel( 'forms' ), 'submit:response', this.actionSubmit );
    },

    actionSubmit: function( response ) {
      console.log(response.data.form_id);
      var errors = response.errors;
      if(response.data.form_id == '6' && errors == false && dlUrl !== "") {
        document.location.href = "/file-downloader.php?fileName="+dlUrl;
      }else if(response.data.form_id == '7' && errors == false) {
        $('#modal__video').toggle();
        $('#modal__videoPlayer').toggle();
      }
    },

});
  var dlUrl = "";
  new ninjaFormsResourcesListener;


  // var video = $("#header-video").get(0);
  // video.addEventListener("ended", function() {
  //   this.currentTime = 8.1;
  //   this.play();
  // });

  $('ul li.team__member:not(:last-child)').click(function(event) {
    event.preventDefault();
    console.log('team__member clicked: '+$(this));
    $(this).find('.modal').toggle();
  });
  $('.modal__closer').click(function (event) {
    event.preventDefault();
    $(this).parent().find('.modal').toggle();
    $('body').removeClass('modal__demo--on');

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
  $('.button--info').click(function() {
    event.preventDefault();
    $('#modal__videoPlayer').toggle();
    $('body').toggleClass('modal__demo--on');
  });

  var vidsrc ="";
  $(document).click(function(event) {
      if (!$(event.target).closest(".modal").length) {
        // saves the current iframe source
        vidsrc = $frame.attr('src');
        // sets the source to nothing, stopping the video
        
        $('#modal__videoPlayer').toggle();
        $("#modal__videoSrc").attr('src',''); 
        $('body').removeClass('modal__demo--on');
        $('.nf-response-msg').hide();
      }
  });

  $('.button--ebook').click(function() {
    event.preventDefault();
    dlUrl = $(this).attr('data-location');
    $('#modal__ebook').toggle();
     $('#nf-field-31').val(dlUrl);
    $('body').toggleClass('modal__demo--on');
  });

  $('#modal__ebook__form').submit(function(e){
      event.preventDefault();
      var fileUrl = $(this).attr('data-location');
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
    $('body').toggleClass('modal__demo--on');
  });

  $('.modal__close').click(function() {
    event.preventDefault();
    $(this).closest('.modal').toggle();
    $('body').removeClass('modal__demo--on');
    $('.nf-response-msg').hide();
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
