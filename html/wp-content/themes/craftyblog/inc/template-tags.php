<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package enlighten
 */

/**
 * Return trimmed content
 */
function enlighten_get_trimmed_content() {
	$content = get_the_content();
	$trimmed_content = wp_trim_words( $content, 20, ' ... <p class="read-more"><a href="'. get_permalink() .'"> Read More...</a></p>' );
	return $trimmed_content;
}

/**
 * Echo trimmed content
 */
function enlighten_trimmed_content() {
	echo enlighten_get_trimmed_content();
}

if ( ! function_exists( 'enlighten_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function enlighten_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'enlighten' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'enlighten' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'enlighten' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'enlighten_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function enlighten_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'enlighten' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'enlighten' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'enlighten' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'enlighten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function enlighten_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'n/j' ) ),
		esc_html( get_the_date( 'n/j' ) ),
		esc_attr( get_the_modified_date( 'n/j' ) ),
		esc_html( get_the_modified_date( 'n/j' ) )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'enlighten' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'enlighten_categories' ) ) :

function enlighten_categories() {
	if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list( __( ', ', 'enlighten' ) );
		if ( $categories_list && enlighten_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '%1$s', 'enlighten' ) . '</span>', $categories_list );
		}
	}
}
endif;


if ( ! function_exists( 'enlighten_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function enlighten_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'enlighten' ) );
		if ( $categories_list && enlighten_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in: %1$s', 'enlighten' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'enlighten' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged: %1$s', 'enlighten' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_home() && ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'enlighten' ), __( '1 Comment', 'enlighten' ), __( '% Comments', 'enlighten' ) );
		echo '</span>';
	}

	edit_post_link( __( '(Edit this post)', 'enlighten' ), '<div class="edit-link">', '</div>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function enlighten_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'enlighten_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'enlighten_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so enlighten_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so enlighten_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in enlighten_categorized_blog.
 */
function enlighten_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'enlighten_categories' );
}
add_action( 'edit_category', 'enlighten_category_transient_flusher' );
add_action( 'save_post',     'enlighten_category_transient_flusher' );

function enlighten_show_category_children_only() {
	foreach((get_the_category()) as $category) {
		if ($category->category_parent  != 0) {
			echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr(strip_tags($category->name)) . '" ' . '>' . $category->name.'</a> ';
		}
	}
}

function enlighten_categories() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'meh' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">' . __( '%1$s', 'enlighten' ) . '</span>', $categories_list );
		}
	}

}

function enlighten_count_post_views($postID) {
	$count_key = 'enlighten_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Social Media Theme Mods Template tag

function enlighten_social_media() {
	$twitter   = get_theme_mod( 'twitter' );
	$facebook  = get_theme_mod( 'facebook' );
	$vimeo     = get_theme_mod( 'vimeo' );
	$youtube   = get_theme_mod( 'youtube' );
	$pinterest = get_theme_mod( 'pinterest' );
	$instagram = get_theme_mod( 'instagram' );
	$rss       = get_theme_mod( 'rss' );

	if ( $twitter || $facebook || $vimeo || $youtube || $pinterest || $instagram || $rss ) {?>

		<aside class="social-media widget">
			<h3 class="widget-title"><?php _e( 'Follow Us', 'enlighten' ); ?></h3>
		<?php }?>

	<?php  if( $twitter != '' ) { ?>
		<span class="twitter social-icon"><a href="<?php echo get_theme_mod( 'twitter' ); ?>">
				<span class="genericon genericon-twitter"></span></a></span>
	<?php }?>

		<?php if ( $facebook != '' ) { ?>

			<span class="facebook social-icon"><a href="<?php echo get_theme_mod( 'facebook' ); ?>">
					<span class="genericon genericon-facebook-alt"></span></a></span>

		<?php } ?>

		<?php if ( $vimeo != '' ) { ?>

			<span class="vimeo social-icon"><a href="<?php echo get_theme_mod( 'vimeo' ); ?>">
					<span class="genericon genericon-vimeo"></span></a></span>

		<?php } ?>

		<?php if ( $youtube != '' ) { ?>

			<span class="youtube social-icon"><a href="<?php echo get_theme_mod( 'youtube' ); ?>">
					<span class="genericon genericon-youtube"></span></a></span>

		<?php } ?>

		<?php if ( $pinterest != '' ) { ?>

			<span class="pinterest social-icon"><a href="<?php echo get_theme_mod( 'pinterest' ); ?>">
					<span class="genericon genericon-pinterest"></span></a></span>

		<?php } ?>

		<?php if ( $instagram != '' ) { ?>

			<span class="instagram social-icon"><a href="<?php echo get_theme_mod( 'instagram' ); ?>">
					<span class="genericon genericon-instagram"></span></a></span>

		<?php } ?>

		<?php if ( $rss != '' ) { ?>

			<span class="rss social-icon"><a href="<?php echo get_theme_mod( 'rss' ); ?>">
					<span class="genericon genericon-feed"></span></a></span>

		<?php } ?>

		<?php if ( $twitter || $facebook || $vimeo || $youtube || $pinterest || $instagram || $rss ) { ?>

			</aside>

		<?php
		}
	}

// Featured Post on the home page.

function enlighten_featured_post() {

	$featured = get_theme_mod( 'tags_dropdown_setting' );

	$args = array(
		'posts_per_page' => 1,
		'tag_id'         => $featured,
		'orderby'       => 'date',
		'order'         => 'DESC'
	);

	$featured_post = new WP_Query( $args );
	if(is_home() && !is_paged()) {
		?>
		<div id="featured-content">

			<?php if ( $featured_post->have_posts() ) : ?>

				<?php while ( $featured_post->have_posts() ) : $featured_post->the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="post-image"><?php echo the_post_thumbnail( 'crafty-featured' ); ?></div>
						<header class="entry-header">
							<h5 class="section-title"><?php _e( 'Artist Feature', 'enlighten' ); ?></h5>
							<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

							<div class="entry-meta">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"
								   rel="bookmark"><?php _e( 'Read More', 'enlighten' ); ?></a>
							</div>
						</header>
					</article><!-- #post-## -->
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php wp_reset_postdata();
	}
}