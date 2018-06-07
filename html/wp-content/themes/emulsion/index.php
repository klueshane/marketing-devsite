<?php get_header(); ?>
	<div class="slide-container">
		<div class="vignette"></div>
		<div id="intro-slide">
			<h1 class="site-name"><?php bloginfo( 'name' ); ?></h1>
			<a href="#" class="scroll down-arrow" data-section="projects">Down</a>
		</div>
	</div>
	<?php 
			$c = 0;
	    query_posts(array( 
	        'post_type' => 'project',
	        'showposts' => 100 
	    ) );  
	?>
	<?php if (have_posts()) : ?>
	<a name="projects" id="projects"></a>
	<div id="project-list">
		<?php while (have_posts()) : the_post(); ?>

			<div class="project-thumb" id="project-<?php the_ID(); ?>">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( 'portfolio-thumb' ); ?>
					<?php } ?>
					<h3><?php the_title(); ?></h3>
				</a>
				
			</div>

		<?php endwhile; ?>
	</div>
	<?php else : ?>
	<div class="content">
		<h2>Woops!</h2>
		<p>It looks like you're missing some projects, try going back to the dashboard and adding some.</p>
	</div>
	<?php endif; ?>

<?php get_footer(); ?>