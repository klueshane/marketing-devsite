<?php get_header(); ?>


        <? if (is_home()) { ?>
        <section class="blogfeatured">
          <?
          $featured_posts = new WP_Query( array( 'category_name' => 'featured', 'orderby' => 'ID', 'order' => 'ASC' ) );
          if ( $featured_posts->have_posts() ) :
          while ( $featured_posts->have_posts() ) :
          $featured_posts->the_post();

              if( 0 == $featured_posts->current_post ) { ?>
                <div class="blogfeatured__main">
              	<?php 
                if(has_post_thumbnail()) { ?>
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
                <p class="blogitem__content" style="min-height: 0;">The role that competitive and market intelligence teams play in sales is clear; to arm sales teams to close deals…</p>
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

        if ( have_posts() ) : ?>
          <section class="blogitems">
            <?php if(is_category()) { 
              $titleStr = str_replace('Category: ','',get_the_archive_title());
              the_archive_description( '<section class="blog__category_description"><h2>'.$titleStr.'</h2>', '</section>' ); 
           } 

      			
          $cat = get_query_var('cat');
          $category = get_category ($cat);
          echo do_shortcode('[ajax_load_more css_classes="button button--green-solid" id="1562680210" seo="true" category="'.$category->slug.'" post_type="post" posts_per_page="9" button_label="Load More" scroll="false"]'); 
          ?>



</section>
        <?php endif; ?>


<?php get_footer(); ?>
