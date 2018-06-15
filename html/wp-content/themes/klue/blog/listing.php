<?php get_header(); ?>


        <? if (is_home()) { ?>
        <section class="blogfeatured">
          <?
          $featured_posts = new WP_Query( array( 'category_name' => 'featured' ) );
          if ( $featured_posts->have_posts() ) :
          while ( $featured_posts->have_posts() ) :
          $featured_posts->the_post();

              if( 0 == $featured_posts->current_post ) { ?>
                <div class="blogfeatured__main">
              	<?php if(has_post_thumbnail()) { ?>
              		<?php
              			$thumb_id = get_post_thumbnail_id();
              			$thumb_url = wp_get_attachment_image_src($thumb_id,'large');
              		?>
                  <div class="blogfeatured__text">
                    <p class="blogfeatured__category">News</p>
                    <?php the_title( sprintf( '<h1 class="blogfeatured__title"><a class="" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                    <p class="blogfeatured__content">The role that competitive and market intelligence teams play in sales is clear; to arm sales teams to close deals…</p>
                    <a class="blogfeatured__more" href="<?php echo esc_url( get_permalink() ); ?>">Read</a>
                  </div>
                  <div class="blogfeatured__image" style="background-image: url(<?php echo $thumb_url[0]; ?>);"></div>

              		<!--a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><img style="margin-bottom:0;display:block;" src="" /></a-->
                <?php } ?>
                </div>

            <?  } elseif( 1 == $featured_posts->current_post ) { ?>

              <div class="blogfeatured__secondary blogitem">
              <?php if(has_post_thumbnail()) { ?>
                <?php
                  $thumb_id = get_post_thumbnail_id();
                  $thumb_url = wp_get_attachment_image_src($thumb_id,'large', true);
                ?>
                <div class="blogitem__header blogitem__header--featured" style="background-image: url(<?php echo $thumb_url[0];?>);">
                  <p class="blogitem__category">Marketing</p>
                  <?php the_title( sprintf( '<h1 class="blogitem__blogtitle"><a class="blogtitle__bloglink" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                  <span class="blogitem__color blogitem__color--green"></span>
                </div>
                <p class="blogitem__content">The role that competitive and market intelligence teams play in sales is clear; to arm sales teams to close deals…</p>
                <a class="blogitem__more" href="<?php echo esc_url( get_permalink() ); ?>">Read</a>
                <!--a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><img style="margin-bottom:0;display:block;" src="" /></a-->
              <?php } ?>
              </div>
              <? }

          endwhile; endif; ?>


        </section>


        <section class="subscribe">
          <div class="subscribe__box">
            <h1 class="section__heading">Discover something new about your competition.</h1>
            <a class="button button--green button--subscribe" href="#">Subscribe to blog</a>
          </div>
        </section>
        <?php } ?>

        <?php
        $post_counter = 0;
        //$exclude = get_cat_ID('featured');
        //$q = 'cat=-'.$exclude;
        //query_posts($q);
        if ( have_posts() ) : ?>
          <section class="blogitems">
      			<?php while ( have_posts() ) : the_post();
             ?>
              <div class="blogitems__blogitem blogitem">
            	<?php if(has_post_thumbnail()) { ?>
            		<?php
            			$thumb_id = get_post_thumbnail_id();
            			$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
            		?>
                <div class="blogitem__header" style="background-image: url(<?php echo $thumb_url[0];?>);">
                <?php } else { ?>
                <div class="blogitem__header">
                <?php } ?> 
                  <?php the_title( sprintf( '<h1 class="blogitem__blogtitle"><a class="blogtitle__bloglink" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                  <span class="blogitem__color <?php echo blog_colour($post_counter); ++$post_counter;?>"></span>
                </div>
                <?php if(is_category()) { ?>
                  <p class="blogitem__category"><?php the_category(', '); ?></p>
                <?php } ?> 
                <p class="blogitem__content"><?php echo get_the_date(); ?> by <?php echo get_the_author(); ?>
    <br/><br /><?php echo wp_trim_words( get_the_content(), 25 ); ?></p>
    <a class="blogitem__more" href="<?php the_permalink(); ?>">Read</a>
              </div>
              <?php endwhile; ?>
          </section>
        <?php endif; ?>

        <?php
          $paginate_args = array(
            'type' => 'list',
            'prev_next' => false
          );
          echo paginate_links( $paginate_args ); ?>






<?php get_footer(); ?>
