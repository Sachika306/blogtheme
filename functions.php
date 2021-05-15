<?php
/*
 * JSとCSSの読み込み
 */
function add_css_js() {
    wp_enqueue_style('style', get_template_directory_uri().('/css/style.css'));
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('script', get_template_directory_uri().('/js/scripts.js'), array('jquery'));
}
add_action('wp_enqueue_scripts', 'add_css_js'); //CSSとJSの読み込み


/*
 * アクセス数の集計
 */
function set_post_views($postID) { 
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
      $count++;
      update_post_meta($postID, $count_key, $count);
    }
  }
	
function is_bot() { //クローラーのアクセス判別
    $ua = $_SERVER['HTTP_USER_AGENT'];
   
    $bot = array(
          "googlebot",
          "msnbot",
          "yahoo"
    );
    foreach( $bot as $bot ) {
      if (stripos( $ua, $bot ) !== false){
        return true;
      }
    }
    return false;
  }
  

/*
 * ナビゲーション メニューの設定
 */
register_nav_menus( array(
    'global' => 'グローバルメニュー',
    'footerLeft'  => 'フッター左',
    'footerCenter'  => 'フッター中央',
    'footerRight'  => 'フッター右'
  ) );

class custom_walker_nav_menu extends Walker_Nav_Menu { // CustomWalker設定
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="childMenu">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}

remove_filter('pre_user_description', 'wp_filter_kses'); //プロフィールの自己紹介欄でHTMLを適用できるようにする
add_theme_support('post-thumbnails'); // Thumbnailを使えるようにする

