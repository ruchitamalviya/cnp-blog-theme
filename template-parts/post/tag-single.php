<?php 
$posttags = get_the_tags();?>
<?php if ($posttags && !empty($posttags)) :     ?>
   
   <b class="tags"><?php _e('Tags:','catandpillar')?></b>
   <div class="blog_e-commerce">
     <?php foreach($posttags as $tag) :?>
         <span class="icon"><?php _e('#','catandpillar')?></span>
         <span class="text-e-commerce">
   	     <?php echo $tag->name; ?>     
         </span>   
      <?php endforeach;?>
   </div>
          
<?php endif; ?>