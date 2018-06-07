<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package portfolio
 */

if ( ! function_exists( 'wp_portfolio_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function wp_portfolio_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'portfolio' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'portfolio' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'portfolio' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'wp_portfolio_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function wp_portfolio_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'portfolio' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'portfolio' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'portfolio' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'wp_portfolio_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wp_portfolio_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'portfolio' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	//echo $posted_on;

}
endif;

if ( ! function_exists( 'wp_portfolio_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wp_portfolio_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'portfolio' ) );
		if ( $categories_list && wp_portfolio_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'portfolio' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'portfolio' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'portfolio' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'portfolio' ), __( '1 Comment', 'portfolio' ), __( '% Comments', 'portfolio' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'portfolio' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wp_portfolio_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wp_portfolio_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wp_portfolio_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wp_portfolio_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wp_portfolio_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wp_portfolio_categorized_blog.
 */
function wp_portfolio_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'wp_portfolio_categories' );
}
add_action( 'edit_category', 'wp_portfolio_category_transient_flusher' );
add_action( 'save_post',     'wp_portfolio_category_transient_flusher' );

// Social Media Theme Mods Template tag

function wpp_social_media() {
	$twitter   		= get_theme_mod( 'twitter' );
	$instagram   	= get_theme_mod( 'instagram' );
	$facebook  		= get_theme_mod( 'facebook' );
	$vimeo     		= get_theme_mod( 'vimeo' );
	$youtube   		= get_theme_mod( 'youtube' );
	$pinterest 		= get_theme_mod( 'pinterest' );
	$linkedin   	= get_theme_mod( 'linkedin' );
	$rss       		= get_theme_mod( 'rss' );

	?>
	<div class="social-media">
		<ul>

	<?php  if( $twitter != '' ) { ?>
		<li class="twitter social-icon"><a href="<?php echo get_theme_mod( 'twitter' ); ?>">
				<span class="genericon genericon-twitter"></span></a></li>
	<?php }?>

	<?php if ( $instagram != '' ) { ?>

		<li class="instagram social-icon"><a href="<?php echo get_theme_mod( 'instagram' ); ?>">
				<span class="genericon genericon-instagram"></span></a></li>

	<?php } ?>

	<?php if ( $facebook != '' ) { ?>

		<li class="facebook social-icon"><a href="<?php echo get_theme_mod( 'facebook' ); ?>">
				<span class="genericon genericon-facebook-alt"></span></a></li>

	<?php } ?>

	<?php if ( $vimeo != '' ) { ?>

		<li class="vimeo social-icon"><a href="<?php echo get_theme_mod( 'vimeo' ); ?>">
				<span class="genericon genericon-vimeo"></span></a></li>

	<?php } ?>

	<?php if ( $youtube != '' ) { ?>

		<li class="youtube social-icon"><a href="<?php echo get_theme_mod( 'youtube' ); ?>">
				<span class="genericon genericon-youtube"></span></a></li>

	<?php } ?>

	<?php if ( $pinterest != '' ) { ?>

		<li class="pinterest social-icon"><a href="<?php echo get_theme_mod( 'pinterest' ); ?>">
				<span class="genericon genericon-pinterest"></span></a></li>

	<?php } ?>

	<?php if ( $linkedin != '' ) { ?>

		<li class="linkedin social-icon"><a href="<?php echo get_theme_mod( 'linkedin' ); ?>">
				<span class="genericon genericon-linkedin"></span></a></li>

	<?php } ?>


	<?php if ( $rss != '' ) { ?>

		<li class="rss social-icon"><a href="<?php echo get_theme_mod( 'rss' ); ?>">
				<span class="genericon genericon-rss"></span></a></li>

	<?php }?>
			</ul>

		</div>
<?php }

function wpp_homepage_grid() { ?>
			<?php $homegrid = new WP_Query( array( 
				'posts_per_page' => 9, 
				'post_type' => 'portfolio' 
				) );

	while ( $homegrid->have_posts() ) : $homegrid->the_post();?>
			<div class="post"><a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'home-portfolio' );?></a></div>
		<?php
	endwhile;
	return;
	wp_reset_postdata();
}
