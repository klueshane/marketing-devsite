<?php
define("TITLE", "Klue | " . get_the_title());
#define("DESCRIPTION", "my description");
?>
<?php get_header(); ?>

<?php the_post(); # need this so wordpress can internally reference the post, so wordpress post functions below can work ?>


<section class="blogbody">

	<div class="blogbody__main">

		<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'largest');
		?>
			<div class="blogbody__headings">

				<p class="blogbody__category">News</p>
				
				<h1 class="blogbody__title"><?php the_title(); ?></h1>
				
				<p class="blogbody__date"><?php echo get_the_date(); ?> by <?php echo get_the_author(); ?></p>
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p class="blogbody__breadcrumbs" id="breadcrumbs">','</p>');
					}
				?><p class="blogbody__date"><?php the_tags(); ?></p>

				<div class="blogbody__sociallinks blogbody__sociallinks--top">
					<a class="sociallinks__item sociallinks__item--facebook" href="https://facebook.com/sharer/sharer.php?p[url]=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>" target="_blank" ></a>
					<a class="sociallinks__item sociallinks__item--twitter" href="https://twitter.com/intent/tweet/?text=<?php echo get_the_title(); ?>&url=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>" target="_blank"></a>
					<a class="sociallinks__item sociallinks__item--linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>&amp;title=<?php echo get_the_title(); ?>" target="_blank"></a>
				</div>
			</div>
			<div class="blogbody__content">
				<?php if (!empty($thumb_url)) { ?> <div class="blogbody__background" style="background-image: url(<?php echo $thumb_url[0];?>"></div><? } ?>
				<?php if (!empty($thumb_url)) { ?> <img class="blogbody__image" src="<?php echo $thumb_url[0];?>"> <? } ?>
				<?php the_content(); ?>

				<div class="blogbody__sociallinks blogbody__sociallinks--bottom">
					<a class="sociallinks__item sociallinks__item--facebook" href="https://facebook.com/sharer/sharer.php?p[url]=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>" target="_blank" ></a>
					<a class="sociallinks__item sociallinks__item--twitter" href="https://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>" target="_blank"></a>
					<a class="sociallinks__item sociallinks__item--linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(DOMAIN . $_SERVER['REQUEST_URI']); ?>&amp;title=<?php echo get_the_title(); ?>" target="_blank"></a>
				</div>
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					}
				?>
			</div>
		</div>

	</div>
</section>


<section class="related">
	<a class="button button--green button--blogitems" href="/blog/">Back to Blog</a>
	<h1 class="blogitems__heading">Related Posts</h1>

	<div class="blogitems">
  <?php
		$category = get_the_category();
		$firstCategory = $category[0]->cat_name;
		$post_counter = 0;
    $args = array('posts_per_page' => 3,'ignore_sticky_posts' => 1, 'category_name' => $firstCategory, 'post__not_in' => array( $post->ID ));
    $the_query = new WP_Query( $args );

    while ( $the_query->have_posts() ) : $the_query->the_post();
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'large', true);
  ?>

	<div class="blogitems__blogitem blogitem">
		<div class="blogitem__header" style="background-image: url(<?php echo $thumb_url[0];?>);">
			<p class="blogitem__category"><?php echo $firstCategory ?></p>
			<?php the_title( sprintf( '<h1 class="blogitem__blogtitle"><a class="blogtitle__bloglink" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<span class="blogitem__color <?php echo blog_colour($post_counter); ++$post_counter;?>"></span>
		</div>
		<p class="blogitem__content"><?php echo wp_trim_words( get_the_content(), 25 ); ?></p>
		<a class="blogitem__more" href="<?php the_permalink(); ?>">Read</a>
	</div>

  <?php endwhile; ?>
	</div>
</section>


<?php get_footer(); ?>
