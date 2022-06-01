<div class="item">
   <a class="item_name"><?php echo get_bloginfo( 'name' ); ?></a>
   <a class="item_desc"><?php the_title(); ?></a>
</div>
<div class="blog_profile_main">
   <div class="blog_time_date_main">
      <?php 
      $read_time = sanitize_text_field( trim( get_post_meta($post->ID, "read_time", true ) ) );?>
      <?php if(isset($read_time) && $read_time && !empty($read_time)): ?>
                  <span class="time fs_14"><?php printf(__('%s Min read.', 'catandpillar'), $read_time);?></span>
            <?php endif; ?>
      <span class="blog_date"> <?php echo get_the_date(); ?></span>
   </div>
   <div class="blog_e-commerce">
      <span class="icon"><?php echo _e('#','catandpillar') ?></span>
      <span class="text-e-commerce">
       <?php 
      $post_category = get_the_category($post->ID);
      foreach($post_category as $category){
          echo $category->cat_name;
        }
    ?>

     </span>
   </div>
</div>