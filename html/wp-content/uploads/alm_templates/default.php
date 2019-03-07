<div class="blogitems__blogitem blogitem">
<?php  if(has_post_thumbnail()) {            			 
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
?>
<div class="blogitem__header" style="background-image: url('<?php echo $thumb_url[0]; ?>');">
<?php $category = get_the_category(); 
echo '<small>'.$category[0]->cat_name.'</a></small>'; } else { ?>                
<div class="blogitem__header">
<?php $category = get_the_category(); 
echo '<small>'.$category[0]->cat_name.'</a></small>';  
} 
$title = mb_strimwidth(get_the_title(), 0, 90, '...');
echo (sprintf('<h1 class="blogitem__blogtitle"><a class="blogtitle__bloglink" href="%s" rel="bookmark">', esc_url( get_permalink() ) )); 
echo $title.'</a></h1>'; ?>
<span class="blogitem__color <?php echo blog_colour($post_counter); ++$post_counter; ?>"></span> 
</div>

<p class="blogitem__content"><br /><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?> </p>
<a class="blogitem__more" href="<?php the_permalink(); ?>">Read</a>
</div>