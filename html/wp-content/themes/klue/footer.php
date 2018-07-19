

<section class="footer">
  <a class="footer__logo" href="/">Klue</a>
  <a class="button button--green-solid button--demo" href="#">Request a demo</a>
  <ul class="footer__footer-nav">
    <?php $current_path = trim(explode('?', strtolower($_SERVER['REQUEST_URI']))[0], '/'); ?>
    <li class="footer-nav__item"><a href="/">Home</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'about' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/about/">About Us</a></li>
    <li class="footer-nav__item <?php echo /* blog section */is_home() || is_post_type_archive('post') || is_singular('post') ? 'header-nav__header-nav-item--current' : ''; ?>"><a href="/blog/">Blog</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'resources' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/competitive-strategy-resources">Resources</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'jobs' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/jobs/">Jobs</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'contact' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/contact/">Contact</a></li>
    <li class="footer-nav__item"><a href="https://kluein.github.io/media-resources/">Media Kit</a></li>
    <li class="footer-nav__item"><a href="https://app.klue.com/privacy">Privacy</a></li>
  </ul>

  <ul class="footer__sociallist">
    <li class="footer__socialitem"><a class="footer__socialicon footer__socialicon--mail" href="mailto:info@klue.com"></a></li>
    <li class="footer__socialitem"><a class="footer__socialicon footer__socialicon--angellist" href="https://angel.co/klue"></a></li>
    <li class="footer__socialitem"><a class="footer__socialicon footer__socialicon--twitter" href="https://twitter.com/kluein"></a></li>
    <li class="footer__socialitem"><a class="footer__socialicon footer__socialicon--linkedin" href="https://ca.linkedin.com/company/klue"></a></li>
  </ul>

  <p class="footer__love">Made with <span class="icon-love"></span> in Vancouver.</p>
  <p class="footer__legal">&copy; <?php echo date('Y') ?> Klue Labs Vancouver, BC</p>
</section>

<section id="modal__ebook" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Sign up for access</h1>
      <a class="modal__close" href="">Close</a>
    </div>
    <form class="modal__form" id="modal__ebook__form">
      <input class="modal__input" type="text" placeholder="Name" name="name">
      <input class="modal__input" type="email" placeholder="Email (required)" name="email" required>
      <input class="modal__input" type="text" placeholder="Company (required)" name="company" required>
      <button class="modal__submit button button--green-solid">Submit</button>
    </form>
  </div>
</section>

<section id="modal__webinar" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Sign up for access</h1>
      <a class="modal__close" href="">Close</a>
    </div>
    <form class="modal__form">
      <input type="hidden" name="_nonce" value="b5902f0223">
      <input class="modal__input" type="text" placeholder="Name" name="name">
      <input class="modal__input" type="email" placeholder="Email (required)" name="email" required>
      <input class="modal__input" type="text" placeholder="Company (required)" name="company" required>
      <button class="modal__submit button button--green-solid">Submit</button>
    </form>
  </div>
</section>

<section id="modal__demo" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Request a Demo</h1>
      <p class="modal__description">Submit this form and one of our analysts will be in touch soon.</p>
      <a class="modal__close" href="">Close</a>
    </div>
<?php echo(do_shortcode('[ninja_form id=4]')); ?>
  </div>
</section>
<section id="modal__info" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Learn More about Klue</h1>
      <p class="modal__description"></p>
      <a class="modal__close" href="">Close</a>
    </div>
<?php echo(do_shortcode('[ninja_form id=5]')); ?>
  </div>
</section>

<section id="modal__subscribe" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Subscribe for updates!</h1>
      <p class="modal__description"></p>
      <a class="modal__close" href="">Close</a>
    </div>

<form action="https://klue.us12.list-manage.com/subscribe/post?u=b3835188496e62097ff380c7c&amp;id=62ef371bfd" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate modal__form" target="_blank" novalidate>

<input type="email" value="" name="EMAIL" class="modal__input" placeholder="Email (required)" id="mce-EMAIL" required>
<div id="mce-responses" class="clear">
    <div class="response" id="mce-error-response" style="display:none"></div>
    <div class="response" id="mce-success-response" style="display:none"></div>
  </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b3835188496e62097ff380c7c_62ef371bfd" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="modal__submit button button--green-solid"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->
  </div>
</section>

<div id="outdated"></div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/dragscroll.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js?v=<? echo rand(100,900);?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/outdatedbrowser/outdatedbrowser.min.js"></script>
<script type="text/javascript" async="" src="https://widget.intercom.io/widget/h0y3k5hw"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47988303-5', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>
