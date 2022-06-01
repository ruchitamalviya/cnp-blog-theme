<?php 
/**
 * Template Name: Search Page
 */
?>
<?php get_header();?> 

<?php get_search_form();?>
<?php if(isset($_GET['q']) && !empty($_GET['q'])) : ?>
  <?php  
    $search_query = new WP_Query(
      array(
        'posts_per_page'    => 6,
        's'                 => sanitize_text_field($_GET['q']),
        'post_status'       => 'publish',
        'post_type'         => 'post',
        'paged'           => -1
      )
    );
  ?>
  <?php if ( $search_query->have_posts() ) : ?>
    <div class="search_rcount">
      <p class="blog_desc"><?php printf(__('%s Search results found.', 'catandpillar'), $search_query->found_posts);?></p>
    </div>
    <div class="blog_divider"></div>
    <section class="card_section_3">
      <div class="container-fluid w_1366">
        <div class="row">
          <?php while ( $search_query->have_posts() ) : 
            $search_query->the_post();
          ?>
            <?php get_template_part('template-parts/result-search-post','part'); ?>  
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <div class="container-fluid w_1366">
      <button class="btn_see_more_search" type="button"><?php _e('See more posts','catandpillar')?></button>
    </div>
  <?php wp_reset_postdata(); else : ?>
    <div class="search_rcount">
      <p class="blog_desc"><?php _e('No results found.','catandpillar')?></p>
    </div>
  <?php endif; ?>

<?php endif;  ?>
    
<?php get_footer(); 