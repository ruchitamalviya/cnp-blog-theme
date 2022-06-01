<?php
/*
  Template Name: Cat and Pillar
  Template Post Type:post,page
*/
get_header(); 
global $wp_query;
//global $post;
?>
<section class="latest_post_section">
   <div class="container-fluid p_0 w_1366">
      <div class="row m_0">
        <?php
          $args = array('posts_per_page'  => 5,
                        'order'           => 'DESC'
                        );
          $query = new WP_Query( $args );
        ?>
        <?php if ($query->have_posts()) : $query->the_post(); ?>
            <?php get_template_part('template-parts/latest-post-left','page'); ?>
        <?php endif;?>
         
         <div class="col-md-5 col-lg-4 mlr_15">
            <h1 class="latest_posts"><?php _e('Latest Posts','catandpillar')?></h1>
             <?php  while ($query->have_posts()) : $query->the_post();?>
               <?php get_template_part('template-parts/latest-post-right'); ?>
            <?php endwhile; ?>
         </div>
      </div>
   </div>
</section>
   
<?php $cats = get_categories();?>
<?php foreach ($cats as $cat): ?>

   <?php
      $cat_id = $cat->term_id;
      $fetch_cat_args=array('cat'           => $cat_id,
                            'post_per_page' => -1
                           );
      $fetch_cat_posts = new WP_Query($fetch_cat_args);
   ?>
   <section class="slider_container">
   </div> 
      <div class="divider"></div>
      <div class="container-fluid w_1366">
         <p class="e_commerce_title"><?php echo $cat->name; ?></p>
      </div>
      <div class="carousel w_1366">
         <?php if ($fetch_cat_posts->have_posts()) :?>
            <?php while ($fetch_cat_posts->have_posts()) : $fetch_cat_posts->the_post(); ?> 
               <?php get_template_part('template-parts/slider-card','post'); ?>

            <?php endwhile;?>
         <?php endif;?> 
      </div>
   </section>
<?php endforeach; ?>

<?php  
$morepost = array(
                  'post_type'       => 'post',
                  'orderby'         => 'ID',
                  'post_status'     => 'publish',
                  'order'           => 'DESC',
                  'posts_per_page'  => 6,
                  'paged'           => -1
               );

$result = new WP_Query( $morepost );?>
 <?php if ( $result-> have_posts() ) : ?>

   <section class="card_section_3">
      <div class="container-fluid w_1366">
         <div class="row">
            <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                  <?php get_template_part('template-parts/all-single-post-card'); ?>
           
            <?php endwhile; ?>
         </div>
      </div>
   </section>

   <div class="container-fluid w_1366">
      <button class="btn_see_more" type="button"><?php _e('See more posts','catandpillar')?></button>
   </div>
<?php endif; wp_reset_postdata(); ?>

<?php get_template_part('template-parts/subscribe', 'bottom');?>

<?php get_footer();