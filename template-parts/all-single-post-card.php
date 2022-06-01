<div class="col-md-4 mb_20">
   <div class="card_main">
      <div class="slider_img">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="slider_description_main">
         <span class="postCardTag postCardTag_slider">
         <span></span>
         <?php 
            $post_category = get_the_category($post->ID);
            foreach($post_category as $category) : ?>
               <?php
                 $cat_name = $category->cat_name;
                 echo $cat_name;
               ?>
            <?php endforeach; ?>
        </span>
         <a href="<?php the_permalink(); ?>" class="title_slider">
            <h3 class="title_slider"><?php the_title(); ?> </h3>
         </a>
         <p class="description_slider">
            <?php 
             $char_limit = 250; 
            $content = wp_strip_all_tags( get_the_content());
            echo substr($content, 0, $char_limit);
             ?>
         </p>
         <br>
         <div class="date_time_container date_time_slider">
            <span class="date fs_14"><?php echo get_the_date(); ?> </span>
            <span class="dot fs_14">·</span>
             <?php 
             $read_time = sanitize_text_field( trim( get_post_meta($post->ID, "read_time", true ) ) );?>
            <?php if(isset($read_time) && $read_time && !empty($read_time)): ?>
                  <span class="time fs_14"><?php printf(__('%s Min read.', 'catandpillar'), $read_time);?></span>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>