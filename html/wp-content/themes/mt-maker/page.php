<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package (mt) Maker Theme
 */

get_header(); ?>

<div class="maker">
	<?php
	$images = get_post_meta( get_the_id(), '_maker_header_images' );
	$image_1 = $images[0];
	$image_2 = $images[1];

	if( $image_1 || $image_2 ) : ?>
		<div class="header-images">
			<div class="image">
				<?php echo wp_get_attachment_image( $image_1, 'header-1' );?>
			</div>
			<div class="image">
				<?php echo wp_get_attachment_image( $image_2, 'header-2' );?>
			</div>
		</div>
	<?php endif;?>

	<?php
	$top_section_title = esc_html( get_post_meta( get_the_id(), 'top-section-title', true ) );
	$top_section_image = get_post_meta( get_the_id(), 'top-section-image', true );
	$top_section_content = esc_html( get_post_meta( get_the_id(), 'top-section-content', true ) );

	if( $top_section_title || $top_section_image || $top_section_content ) : ?>

		<div class="top-section">

			<h2><?php echo $top_section_title;?></h2>

			<div class="image">
				<?php echo wp_get_attachment_image( $top_section_image, 'bio' );?>
			</div>

			<div class="content">
				<?php echo wpautop( $top_section_content );?>
			</div>

		</div>
	<?php endif;?>

	<?php
	$products = get_post_meta( get_the_id(), 'product' );
	if( $products ) : ?>
	<div class="products">

		<h2><?php _e( 'Products', 'maker' );?></h2>

		<ul class="bxslider products-slider">

			<?php
			foreach( $products as $product ) {

				$product_image = $product["product_image"];
				$product_name = $product["product_name"];
				$product_cost = $product["product_cost"];
				?>
				<li>
					<?php echo wp_get_attachment_image( $product_image, 'slider' );?>
					<div class="name"><?php echo $product_name;?></div>
					<div class="cost"><?php echo $product_cost;?></div>
				</li>

			<?php } ?>
		</ul>
	</div>
<?php endif;?>

<?php
$process_title = esc_html( get_post_meta( get_the_id(), 'process-title', true ) );
$process_content = esc_html( get_post_meta( get_the_id(), 'process-content', true ) );
$process_image = get_post_meta( get_the_id(), 'process-image', false );

if( $process_title || $process_image || $process_content ) : ?>

	<div class="process">

		<div class="content">
			<h2><?php echo $process_title;?></h2>
			<?php echo wpautop( $process_content );?>
		</div>

		<div class="images">
			<ul>
			<?php foreach( $process_image as $image ) { ?>
			<li><?php echo wp_get_attachment_image( $image, 'grid' );?></li>

			<?php } ?>
		</li>
			</ul>
			</div>

		</div>
<?php endif;?>

	<?php $video = get_post_meta( get_the_id(), 'video', true );
	if( $video ) :?>
	<div class="video">
			<?php $embed_code = wp_oembed_get( $video );
			echo $embed_code;?>
	</div>

	<?php endif;?>

	<?php
	$inspiration_title = esc_html( get_post_meta( get_the_id(), 'inspiration-title', true ) );
	$inspiration_content = esc_html( get_post_meta( get_the_id(), 'inspiration-content', true ) );
	$inspiration_image = get_post_meta( get_the_id(), 'inspiration-image', false );

	if( $inspiration_title || $inspiration_image || $inspiration_content ) : ?>

		<div class="inspiration">

			<div class="content">
				<h2><?php echo $inspiration_title;?></h2>
				<?php echo wpautop( $inspiration_content );?>
			</div>

			<div class="images">
				<ul>
					<?php foreach( $inspiration_image as $image ) { ?>
						<li><?php echo wp_get_attachment_image( $image, 'grid' );?></li>

					<?php } ?>
					</li>
				</ul>
			</div>

		</div>
	<?php endif;?>
<?php
$stockists = get_post_meta( get_the_ID(), 'stockists', false );
if ( $stockists ) :
?>
	<div class="stockists">
		<h2><?php _e( 'Stockists', 'maker' );?></h2>

		<ul>

			<?php foreach( $stockists as $stockist ) {
				$names = $stockist["stockists_name"];
				$streets = $stockist["stockists_street_address"];
				$states = $stockist["city_state_zip"];

				if( $names != '' || $streets != '' || $states != '' ) : ?>
			<li>
				<?php echo $names;?><br>
				<?php echo $streets;?><br>
				<?php echo $states;?><br>
			</li>
				<?php endif;?>
			<?php } ?>
		</ul>
	</div>
<?php endif;?>

</div>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'page' ); ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() ) :
		comments_template();
	endif;
	?>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
