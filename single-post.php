<?php get_header();?>
<section class="blog_details_section">
   <div class="w_610 blog_details_top">
  	<?php if (have_posts()) :?>
				<?php while (have_posts()) : the_post(); ?>

    			 <?php get_template_part('template-parts/content/content','post');?>

  			<?php endwhile; ?>
	   <?php endif; ?>
	</div>	
</section>
<?php get_template_part('template-parts/subscribe','bottom');?>

<?php  $post_category = get_the_category($post->ID);?>

<?php foreach ($post_category as $cat) : ?>
 <?php
   $cat_id = $cat->term_id;
   $fetch_cat_args = array('cat'             => $cat_id,
                           'post_per_page'   => -1
                        );
   $fetch_cat_posts = new WP_Query($fetch_cat_args);
 ?>
 <section class="slider_container">
 </div> 
   <div class="divider"></div>
      <div class="container-fluid w_1366">
       <p class="e_commerce_title color_green"><?php echo $cat->name; ?></p>
      </div>
      <div class="carousel w_1366">
       <?php if ($fetch_cat_posts->have_posts()) :?>
               <?php while ($fetch_cat_posts->have_posts()) : $fetch_cat_posts->the_post(); ?> 
                   <?php get_template_part('template-parts/slider-card','post'); ?>
       
               <?php endwhile; ?>
           <?php endif; ?>  
      </div>
	</section>
<?php endforeach; ?>

<?php get_footer();