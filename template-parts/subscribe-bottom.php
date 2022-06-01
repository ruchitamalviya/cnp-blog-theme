<section class="mobile_img_section">
   <div class="container">
      <div class="row">
         <div class="col-md-5 col-lg-4">
            <div class="mobile_image_container">
               <img src="<?php echo get_template_directory_uri().'/assests/img/phone@1x.png'?>" alt="mobile">
            </div>
         </div>
         <div class="col-md-6 col-lg-6 offset-md-1 align-self-center">
            <div class="mail_icon"></div>
            <p class="subscribe_title"><?php _e(
               'Tips to run your business smarter. Delivered to you monthly.','catandpillar')?>
            </p>
            
               <div class="email_main">
                  <!-- <div class="input-container_email">
                           <input id="email" class="input" type="text" pattern=".+" name="email" required placeholder="Email address" />
                        </div>
                        <input type="submit" name="submit" value="Subscribe" class="btn_subscribe"> -->
                  <?php
                  $cat_and_pillar_shortcode  = (get_option('setting'));
                  if(isset($cat_and_pillar_shortcode ) && !empty($cat_and_pillar_shortcode )) : 
                     $get_cat_and_pillar_shortcode = stripslashes($cat_and_pillar_shortcode['setting']);
                     echo do_shortcode($get_cat_and_pillar_shortcode);

                  endif;
                  ?>
               </div>

               <span class="email_bottom_desc"><?php _e('By clicking, you agree to our' ,'catandpillar')?>
               <a href="" target="_blank"><?php _e('Terms &amp; Conditions','catandpillar')?> ,</a>
               <a href="" target="_blank"><?php _e('Privacy and Data Protection Policy','catandpillar')?></a></span>
         </div>
      </div>
   </div>
</section>