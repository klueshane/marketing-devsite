<?php if (have_posts()) : ?>
	   
	<?php while (have_posts()) : the_post();
        $next_post = get_next_post();
        $previous_post = get_previous_post();
        $headline_color = get_post_meta( $post->ID, '_headline_color', true);
    ?>
		<article <?php post_class('single'); ?> id="post-<?php the_ID(); ?>">
            <?php if( has_post_thumbnail() ){
                $thumbnail_id = get_post_thumbnail_id( $post->ID );
                $large_thumb = wp_get_attachment_image_src($thumbnail_id, 'post-thumbnail');
                $tablet_thumb = wp_get_attachment_image_src($thumbnail_id, 'tablet');
                ?>
                <div class="feature-image">
                    <div data-picture data-alt="<?php echo trim(strip_tags( get_the_title($post->ID) )); ?>">
                        <div data-src="<?php echo $large_thumb[0]; ?>"></div>
                        <div data-src="<?php echo $tablet_thumb[0]; ?>" data-media="(max-width: 720px)"></div>

                        <!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
                        <noscript>
                            <img src="<?php echo $large_thumb[0]; ?>" alt="<?php echo trim(strip_tags( get_the_title($post->ID) )); ?>">
                        </noscript>
                    </div>
                    <?php if( $next_post ){ ?>
                        <a href="<?php echo $next_post->guid; ?>" title="Next story: &quot;<?php echo $next_post->post_title; ?>&quot;" class="next">
                            <span><i class="fa fa-angle-left"></i></span>
                        </a>
                    <?php } ?>

                    <?php if( $previous_post ){ ?>
                        <a href="<?php echo $previous_post->guid; ?>" title="Previous story: &quot;<?php echo $previous_post->post_title; ?>&quot;" class="prev">
                            <span><i class="fa fa-angle-right"></i></span>
                        </a>
                    <?php } ?>
                </div><!-- #feature-image -->
            <?php } ?>                    
            
            <div class="wrap">
                <h1<?php if( $headline_color && $headline_color != '#' ){ ?> style="color:<?php echo $headline_color; ?>"<?php } ?>><?php the_title(); ?></h1>

                <?php the_content(); ?>


                <nav class="posts-nav">

                    <?php edit_post_link( 'Edit', '<p>', '</p>' ); ?>
                </nav>
            </div><!-- #wrap -->

        </article>

    <?php endwhile; ?>
        
<?php else : ?>
    <article class="post not-found">
        <h1><?php _e( 'Nothing found.', 'shaken' ); ?>&hellip;</h1>
         <p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'shaken' ); ?></p>
	</article><!-- #post -->
<?php endif; ?>