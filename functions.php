<?php
//load theme text domain
load_theme_textdomain( 'catandpiller');

//add style and script
function ets_load_custom_scripts() {
    wp_enqueue_script( 'popper_min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');

    wp_enqueue_script( 'slick_min_js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',array('jquery'), '0.1',true);

    wp_enqueue_script( 'bootstrap_min_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');

    wp_enqueue_script( 'script', get_template_directory_uri().'/assests/js/main.js', array('jquery'), '0.1', true );

    $see_more_array = array(
                            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
                            'security'  => wp_create_nonce( 'load_more_posts' ),
                        );
    wp_localize_script( 'script', 'see_more_post', $see_more_array );

    wp_enqueue_script( 'sticky-header', get_template_directory_uri().'/assests/js/sticky-header.js', array(), '0.1', true );

   wp_enqueue_style( 'style', get_template_directory_uri().'/assests/css/style.css', array(), '0.1','all' );

    wp_enqueue_style( 'bootstrap-min-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );

    wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );

    wp_enqueue_style( 'awesome-min-css', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css' );

    wp_enqueue_style( 'all-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' );
    
    wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assests/css/slick-theme.css', array(), '0.1','all' );
}

add_action('wp_enqueue_scripts','ets_load_custom_scripts');

//load all post ajax btn
function load_posts_by_ajax() {
    check_ajax_referer('load_more_posts', 'security');
    $args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 6,
        'paged'             => sanitize_text_field($_GET['page'] ?? 0),
    );
    $more_posts = new WP_Query( $args );
    $next_page_args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 6,
        'paged'             => isset($_GET['page']) ? intval(sanitize_text_field($_GET['page'])) + 1 : 0,
    );
    $next_page_posts = new WP_Query( $next_page_args ); 

    ob_start();
    ?>
    <?php if ( $more_posts->have_posts() ) : ?>
        <div class="row">
            <?php while ( $more_posts->have_posts() ) : $more_posts->the_post(); ?>
                <?php get_template_part('template-parts/all-single-post-card'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
    <?php 
    $more_post_html = ob_get_clean();
    $json_res = [
        "success"       => 1,
        "posts"         => trim($more_post_html),
        "has_next_page" => $next_page_posts->have_posts(),
    ];
    echo json_encode($json_res);
    wp_die();
}

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax');

//load search callback
add_action( 'wp_ajax_load_serach_posts_by_ajax', 'load_serach_posts_by_ajax' );
add_action( 'wp_ajax_nopriv_load_serach_posts_by_ajax', 'load_serach_posts_by_ajax' );

function load_serach_posts_by_ajax() {
    check_ajax_referer('load_more_posts', 'security');
    $search_field = sanitize_text_field( $_GET['searchField'] );
    $more_post_search_html = '';   
    if( isset( $search_field ) && !empty($search_field) ) {
        $search_query = new WP_Query(
            array(
                'posts_per_page' => 6,
                's'              => $search_field,
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'paged'          => sanitize_text_field($_GET['resultPage'] ?? 0),
            )
        );

        $next_page_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
         's'             => $search_field,
        'paged'          => isset($_GET['resultPage']) ? intval(sanitize_text_field($_GET['resultPage'])) + 1 : 0,
        );
        $next_page_posts = new WP_Query( $next_page_args );
        ob_start();
        ?>  
       <?php if ( $search_query->have_posts() ) : ?>
            
                    <div class="row">
                        <?php while ( $search_query->have_posts() ) : 
                            $search_query->the_post();
                            ?>
                            <?php get_template_part('template-parts/result-search-post','part'); ?> 
                        <?php endwhile;  ?>
                    </div>
        <?php endif; wp_reset_postdata(); ?>
        <?php
    } 
        $more_post_search_html = ob_get_clean();
        $json_res = [
            "success"       => 1,
            "loadposts"     => trim($more_post_search_html),
            "has_next_page" => $next_page_posts->have_posts(),
        ];
        echo json_encode($json_res);
        wp_die();
    ?>
    <?php    
}

//search callback
function load_search_results() {
    $search_field = sanitize_text_field( $_GET['searchField'] ); 
    $search_more_post_html = '';   
    if( isset( $search_field ) && !empty($search_field) ) {
        $search_query = new WP_Query(
          array(
            'posts_per_page'    => 6,
            's'                 => $search_field,
            'post_status'       => 'publish',
            'post_type'         => 'post'
          )
        );
        ob_start();
        ?> 
       <?php if ( $search_query->have_posts()) : ?>
             <div class="search_rcount">
                <p class="blog_desc"><?php printf(__('%s Search Results Found.', 'catandpillar'), $search_query->found_posts);?></p>
            </div>
            <div class="blog_divider"></div>
            <section class="card_section_3 ">
                <div class="container-fluid w_1366">
                    <div class="row">
                        <?php while ($search_query->have_posts() ) : 
                            $search_query->the_post();
                            ?>
                            <?php get_template_part('template-parts/result-search-post','part'); ?> 
                        <?php endwhile;  ?>
                    </div>
                </div>
            </section>
            <div class="container-fluid w_1366">
                <button class="btn_see_more_search btn_display" type="button"><?php _e('See more posts','catandpillar')?>
                </button>
            </div> 
        <?php wp_reset_postdata(); else : ?>
            <div class="search_rcount">
                <p class="blog_desc"><?php _e('NO Result Found','catandpillar')?></p>
            </div>
        <?php endif; ?>

    <?php 
    } 

    $more_post_search_html = ob_get_clean();
    $json_res = [
        "success"              => 1,
        "search_posts"         => trim($more_post_search_html),
    ];
    echo json_encode($json_res);
    wp_die();
    ?>
<?php        
}

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

//add logo
function ets_custom_logo() {     
    add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme' , 'ets_custom_logo' );

//add menus
function ets_custom_new_menu() {

  register_nav_menus( array('primary-menu' =>'header-menu') );
}

add_action( 'init', 'ets_custom_new_menu' );

//remove menu by default classes and id
add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);

function clear_nav_menu_item_id($id, $item, $args) {
    return "";
}

add_filter('nav_menu_css_class', 'clear_nav_menu_item_class', 10, 3);

function clear_nav_menu_item_class($classes, $item, $args) {
    return array();
}

//add new classes in li menus
function add_additional_class_on_li($classes, $item, $args) {

    if(isset($args->add_li_class)) {
    }
        $classes[] = 'nav-item';
    return $classes;
}

add_filter('nav_menu_css_class', 'add_additional_class_on_li', 10, 3);

//add class in link
function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);

//add svg file type for logo
function ets_custom_upload_mimes( $existing_mimes ) {
  $existing_mimes['svg'] = 'image/svg'; 
  return $existing_mimes;
}

add_filter( 'mime_types', 'ets_custom_upload_mimes' );

//add featured image option
add_theme_support( 'post-thumbnails');

//additional meta for post
add_action("add_meta_boxes", "ets_add_meta_box",11, 2);

function ets_add_meta_box( $post_type, $post ){
    if ($post_type = 'post') {
        add_meta_box("ets_Additional", "Additional information", "ets_meta_box_markup", "post", "normal", "default", null);
    }
} 

function ets_meta_box_markup($post){
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    ?>
    <div>
       <?php
       $read_time = sanitize_text_field( trim( get_post_meta($post->ID, "read_time", true ) ) );
        ?>
        <div class="custom-meta-container">
            <label for = "read_time"><?php _e('Read Time (in minutes)','catandpillar')?></label>
            <input id = "read_time" name = "read_time" type = "text" value = "<?php if(isset($read_time) && $read_time) echo $read_time; ?>">       
       </div>
    </div>   
    <?php
} 

function ets_save_meta_box($post_id){
    if(isset($_POST['read_time'])){
        $readbox_content = sanitize_text_field(trim($_POST['read_time'] ) );
         update_post_meta($post_id, 'read_time', $readbox_content);
    }
}
add_action( 'save_post', 'ets_save_meta_box' );

//admin css
function ets_load_admin_style(){
 wp_enqueue_style( 'admin-custom', get_template_directory_uri().'/assests/css/admin-style.css', array(), '0.1','all' );
}

add_action( 'admin_enqueue_scripts', 'ets_load_admin_style' );

//add cat and pillar site options setting
function cat_and_pillar_setting_menu() { 
 add_menu_page( 
      'Site Options', 
      'Site Options', 
      'manage_options', 
      'newsletter', 
      'content_cat_and_pillar_setting' 
     ); 
}

add_action('admin_menu', 'cat_and_pillar_setting_menu');

function content_cat_and_pillar_setting() { 
    $catandpillar_settings= [];
    $cat_and_pillar_shortcode = get_option('setting');
    if ($cat_and_pillar_shortcode) {
        $catandpillar_shortcode = stripslashes($cat_and_pillar_shortcode['setting']);
       
    }
    ?>
    
    <div class="nw_sh_main">
      <form method="post" action="">
          <label for="news-sh"><?php _e('Newsletter Shortcode:','catandpillar')?></label>
          <input type="text" id="news-sh" name="cat_and_pillar_setting" placeholder="<?php _e('Enter Shortcode','catandpillar')?>" value="<?php if(isset($catandpillar_shortcode) && !empty($catandpillar_shortcode)) :  
                echo esc_attr($catandpillar_shortcode); endif; ?>">
          <input type="submit" class="save_setting" name="save_cat_and_pillar_setting" value="Save">
      </form>  
    </div>
<?php    
}


function save_shortcode_setting() {
    if (isset($_POST['save_cat_and_pillar_setting'] ) ) :
       $news_letter_shortcode = isset($_POST['cat_and_pillar_setting']) && $_POST['cat_and_pillar_setting'] ? sanitize_text_field(trim($_POST['cat_and_pillar_setting'] ) ) : '';
       $news_letter_shortcode = stripslashes($news_letter_shortcode);
       $catandpillar_settings = array( 'setting' => $news_letter_shortcode
        );
        update_option('setting', $catandpillar_settings);

    endif;
}
add_action( 'admin_init',  'save_shortcode_setting' );