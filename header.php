
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php wp_head();?>
   </head>
   <body>
      <!--This code is property of Conor McNamara-->
      <!--https://codepen.io/conorjmcnamara/-->
      <section class="header_section">
         <div class="container-fluid w_1366 ">
            <header>
               <nav class="navbar navbar-expand-xl p-0 my-1 ">
                  <div class="logo">
                      <?php echo get_custom_logo();?>
                  </div>
                  <button class="navbar-toggler btn_menu_toggle menu-toggle" id="menu-toggle" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu-toggle-bar menu-toggle-bar--top"></span>
                        <span class="menu-toggle-bar menu-toggle-bar--middle"></span>
                        <span class="menu-toggle-bar menu-toggle-bar--bottom"></span>
                  </button>
                  <div class="row w-100">
                     <div class="col-xl-9">
                        <div class="collapse navbar-collapse mobile_height" id="navbarTogglerDemo02">
                        <?php wp_nav_menu(
                              array(
                              'container' =>false,
                              'menu_class' => 'navbar-nav mr-auto mt-2 mt-lg-0',
                              'add_li_class'  => 'nav-item',
                              'add_a_class' => 'nav-link header_menu_link',
                              )
                           );
                        ?>
                        
                           <div class="mobile_search">
                              <div class="search_box_main">
                                 <button class="search_btn" type="button"><i class="fa-solid fa-magnifying-glass"></i><?php _e('Search','catandpillar')?></button>
                                 <div class="search_input">
                                    <input type="search" name="search">
                                 </div>
                              </div>
                           </div>
                           <div class="social_media_icon">
                              <ul class="media_icon_mobile">
                                 <li>
                                    <a href=""><img src="img/facebook.svg" alt=""> </a>
                                 </li>
                                 <li>
                                    <a href=""><img src="img/twitter.svg" alt=""> </a>
                                 </li>
                                 <li>
                                    <a href=""><img src="img/youtube.svg" alt=""> </a>
                                 </li>
                                 <li>
                                    <a href=""><img src="img/linkedin.svg" alt=""> </a>
                                 </li>
                                 <li>
                                    <a href=""><img src="img/google.svg" alt=""> </a>
                                 </li>
                              </ul>
                           </div>
                           <div class="google_play">
                              <a href=""><?php _e('Google play','catandpillar')?> </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3">
                        <div class="desktop_search">
                           <div class="search_box_main">
                               <button class="search_btn" type="button"><i class="fa-solid fa-magnifying-glass"></i><?php _e('Search','catandpillar')?></button>
                              <form method="get" action="<?php echo esc_url( home_url( '/search/' ) ); ?>">
                                 <div class="search_input">
                                    <input type="search" name="q" value="<?php if(isset($_GET['q']) && !empty($_GET['q'])): echo esc_attr($_GET['q']); endif; ?>" id="search_text" class="search-field"> 
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </nav>
            </header>
         </div>
      </section>