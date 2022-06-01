<div class="col-md-7 col-lg-8 p_0">
   <div class="img-main-container">
      <div class="img-container">
        <?php the_post_thumbnail(); ?>  
      </div>
      <div class="e-commerce_container">
         <span class="postCardTag">
         <span></span>
       <?php 
         $post_category = get_the_category($post->ID);
         foreach($post_category as $category){
             echo $category->cat_name;
           }
       ?>
         </span>
         <a href="<?php the_permalink();?>" class="text_area">
            <h1><?php the_title(); ?></h1>
         </a>
         <div class="date_time_container">
            <span class="date fs_14"> <?php echo get_the_date(); ?> </span>
            <span class="dot fs_14">·</span>
           <?php
               $read_time = sanitize_text_field( trim( get_post_meta($post->ID, "read_time", true ) ) );
            ?>
            <?php if(isset($read_time) && $read_time && !empty($read_time)): ?>
                  <span class="time fs_14"><?php printf(__('%s Min read.', 'catandpillar'), $read_time);?></span>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>