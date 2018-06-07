<?php

query_posts('posts_per_page=-1');

if (have_posts()) : ?>
	   
	<?php while (have_posts()) : the_post(); 
        $thumb_attr = array(
            'alt'   => trim(strip_tags( get_the_title($post->ID) )),
            'title' => trim(strip_tags( get_the_title($post->ID) ))
        );
    ?>
		
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php if( has_post_thumbnail() ){ ?>
                    <figure class="feature-image"><?php the_post_thumbnail( 'archive', $thumb_attr ); ?></figure>
                <?php } ?>
                
                <h3><?php the_title(); ?></h3>
            </a>

            <?php // edit_post_link( __('Edit', 'shaken') ); ?>

        </article>

    <?php endwhile; ?>
    
    <?php // Display pagination when applicable
    if ( !is_single() && $wp_query->max_num_pages > 1 ) : ?>
        <nav class="post-navigation">
            <?php if( get_next_posts_link() ){
                next_posts_link( __( 'Older posts', 'shaken' ) );
            } else {
                echo '<span class="old">'.__( 'Older posts', 'shaken' ).'</span>';
            } ?>
            
            <?php if( get_previous_posts_link() ){
                previous_posts_link( __( 'Newer posts', 'shaken' ) );
            } else {
                echo '<span class="new">'.__( 'Newer posts', 'shaken' ).'</span>';
            } ?>
        </nav>
    <?php endif; ?>
        
<?php else : ?>
    <article class="post not-found">
            <h1><?php _e( 'Nothing found.', 'shaken' ); ?>&hellip;</h1>
            <p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'shaken' ); ?></p>
	</article><!-- #post -->
<?php endif; ?>