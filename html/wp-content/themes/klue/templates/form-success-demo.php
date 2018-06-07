<?php /* Template Name: Form Success Page: Demo Form */ ?><!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Thanks for Your Interest in Klue</title>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets-home2/css-dist/main.css">
		<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/css-built/main.css' type='text/css' media='all' />
	</head>
    <body class="fullscreen-message">

		<section class="fullscreen-message__message-content" style="margin: 10% 20px 80px 20px;">
			<?php if(get_field('demo-form-success-heading')): ?><h1 class="heading"><?php the_field('demo-form-success-heading'); ?></h1><?php endif; ?>
			<?php if(get_field('demo-form-success-text')): ?><p class="subheading subheading--message-content" style="margin: 0 auto; padding: 0; line-height: 1"><?php the_field('demo-form-success-text'); ?></p><?php endif; ?>
			<?php if(get_field('demo-form-success-btn-text')): ?><a href="/"><button class="button button--white-solid" style="margin 1em auto; width:  300px; margin-top: 2em;"><?php the_field('demo-form-success-btn-text'); ?></button></a><?php endif; ?>
			<?php if(get_field('demo-form-success-btn-text-2')): ?><a href="/download-resources"><button class="button button--white-solid" style="margin 0 auto; width:  300px; margin-top: 1em;"><?php the_field('demo-form-success-btn-text-2'); ?></button></a><?php endif; ?>
		</section>

		<?php include get_template_directory() . '/template-includes/footer-tracking.php'; ?>
    </body>
</html>
