    <footer class="footer primary">
    	<div class="wrap">
		    <div class="footer-content">
		    	<div class="inner">
			    	<?php global $mt_journal; ?>
			    	<img src="<?php echo $mt_journal['opt_media']['thumbnail']; ?>" />
			    	<?php echo $mt_journal['footer-text']; ?>
		    	</div>
		    </div>
		    <div class="inner">
		    <?php 
		    	$fb_link = $mt_journal['facebook_link'];
		    	$tw_link = $mt_journal['twitter_link'];
		    	$li_link = $mt_journal['linkedin_link'];
		    	$google_link = $mt_journal['google_link'];
		    	$insta_link = $mt_journal['instagram_link'];
		    ?>
		    <div class="social-icons">
			    <?php if ($tw_link) { ?>
			    	<a href="<?php echo $tw_link; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			    <?php } ?>
			    <?php if ($li_link) { ?>
			    	<a href="<?php echo $li_link; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			    <?php } ?>
			    <?php if ($google_link) { ?>
			    	<a href="<?php echo $google_link; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			    <?php } ?>
			    <?php if ($fb_link) { ?>
			    	<a href="<?php echo $fb_link; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			    <?php } ?>
			    <?php if ($insta_link) { ?>
			    	<a href="<?php echo $insta_link; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
			    <?php } ?>
		    </div>
		    <div class="logo">
		    	HOSTED BY <a href="http://mediatemple.net/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/mt-logo-wide-black.png" /></a>
		    </div>
		    <div class="logo">
		    	POWERED BY <a href="http://wordpress.org/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/wordpress-logo.png" /></a>
		    </div>
		    </div>
    	</div>
    </footer>

<!--</END WRAPPER-->		
		<?php wp_footer(); ?>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.8.3.min.js"><\/script>')
        </script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
        
	</body>

</html>