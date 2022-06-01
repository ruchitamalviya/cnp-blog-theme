<div class="latest_post_area">
   <div class="text_posts">
      <a href="<?php the_permalink();?>" class="text_area">
         <h2 class="fs_18"><?php the_title(); ?></h2>
      </a>
      <div class="date_time_container">
         <span class="date fs_14"><?php echo get_the_date(); ?> </span>
         <span class="dot fs_14">·</span>
         <?php
            $read_time = sanitize_text_field( trim( get_post_meta($post->ID, "read_time", true ) ) );
         ?>
         <?php if(isset($read_time) && $read_time && !empty($read_time)): ?>
                  <span class="time fs_14"><?php printf(__('%s Min read.', 'catandpillar'), $read_time);?></span>
            <?php endif; ?>
      </div>
   </div>
   <div class="latest_img_container">
      <?php the_post_thumbnail(); ?>
   </div>
</div>