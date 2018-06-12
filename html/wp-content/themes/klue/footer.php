

<section class="footer">
  <a class="footer__logo" href="/">Klue</a>
  <a class="button button--green-solid button--demo" href="#">Request a demo</a>
  <ul class="footer__footer-nav">
    <?php $current_path = trim(explode('?', strtolower($_SERVER['REQUEST_URI']))[0], '/'); ?>
    <li class="footer-nav__item"><a href="/">Home</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'about' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/about/">About Us</a></li>
    <li class="footer-nav__item <?php echo /* blog section */is_home() || is_post_type_archive('post') || is_singular('post') ? 'header-nav__header-nav-item--current' : ''; ?>"><a href="/blog/">Blog</a></li>
    <li class="footer-nav__item <?php echo $current_path == 'resources' ? 'header-nav__header-nav-item--current"' : ''; ?>"><a href="/resources/">Resources</a></li>
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
  <p class="footer__legal">&copy; 2018 Klue Labs Vancouver, BC</p>
</section>

<section id="modal__ebook" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Sign up for access</h1>
      <a class="modal__close" href="">Close</a>
    </div>
    <form class="modal__form">
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
      <p class="modal__description"></p>
      <a class="modal__close" href="">Close</a>
    </div>
    <form class="modal__form">
      <input class="modal__input" type="text" placeholder="Name" name="name">
      <input class="modal__input" type="email" placeholder="Email (required)" name="email" required>
      <input class="modal__input" type="text" placeholder="Company (required)" name="company" required>
      <button class="modal__submit button button--green-solid">Submit</button>
    </form>
  </div>
</section>

<section id="modal__subscribe" class="modal">
  <div class="modal__container">
    <div class="modal__info">
      <h1 class="modal__heading">Subscribe for updates!</h1>
      <p class="modal__description"></p>
      <a class="modal__close" href="">Close</a>
    </div>
    <form class="modal__form">
      <input class="modal__input" type="text" placeholder="Name" name="name">
      <input class="modal__input" type="email" placeholder="Email (required)" name="email" required>
      <button class="modal__submit button button--green-solid">Submit</button>
    </form>
  </div>
</section>

<div id="outdated"></div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/dragscroll.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js?v=2"></script>
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
