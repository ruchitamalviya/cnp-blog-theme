<section class="blog_search_section">
  <div class="blog_search_main">
    <div class="blog_search">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get">
          <input type="search"  name="q" placeholder="<?php _e('Search Here','catandpillar');?>" value="<?php if(isset($_GET['q']) && !empty($_GET['q'])): echo esc_attr($_GET['q']); endif;?>"class="search-field" id="search-field" >
          <button type="submit" id="search_posts"><?php _e('Search','catandpillar');?></button>
        </form>
       <i class="las la-times cross_icon clr-text"></i>
       <i class="fa-solid fa-magnifying-glass search_icon"></i>  
    </div>
  </div>
</section>
<div class="rs"></div>
