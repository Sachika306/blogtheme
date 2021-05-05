<?php
function add_css_js() {
    wp_enqueue_style('style', get_template_directory_uri().('/css/style.css'));
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('script', get_template_directory_uri().('/js/scripts.js'), array('jquery'));
    wp_enqueue_script('script', get_template_directory_uri().('/js/search.js'), array('jquery'));
}

/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

class custom_walker_nav_menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="childMenu">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}

register_nav_menus( array(
    'global' => 'Global Menu',
    'footer-menu'  => 'Footer Menu',
  ) );

add_theme_support('post-thumbnails'); // Thumbnailを使えるようにする
add_action('wp_enqueue_scripts', 'add_css_js');
remove_filter('pre_user_description', 'wp_filter_kses');//プロフィールの自己紹介欄でHTMLを適用できるようにする