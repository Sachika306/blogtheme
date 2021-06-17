<?php
/*
 * JSとCSSの読み込み
 */
function add_css_js() {
    wp_enqueue_style('style', get_template_directory_uri().('/css/style.css'));
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('script', get_template_directory_uri().('/js/scripts.min.js'), array('jquery'));
}
add_action('wp_enqueue_scripts', 'add_css_js'); //CSSとJSの読み込み


/*
* アクセス数の集計
*/
function set_post_views($postID) { 
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
     } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
  }

//クローラーのアクセス判別・アクセス数から除外
function is_bot() { 
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
 * ナビゲーションメニューの設定
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


/*
 * 管理画面の記事一覧にサムネイルを表示
 */
function add_posts_columns_thumbnail($columns) {
  $columns['thumbnail'] = 'サムネイル';
  return $columns;
}
function add_posts_columns_thumbnail_row($column_name, $post_id) {
  if ( 'thumbnail' == $column_name ) {
    $thumb = get_the_post_thumbnail($post_id, array(100,100), 'thumbnail');
    echo ( $thumb ) ? 'あり' : '－';
  }
}

add_filter( 'manage_posts_columns', 'add_posts_columns_thumbnail' );
add_action( 'manage_posts_custom_column', 'add_posts_columns_thumbnail_row', 10, 2 );


/*
 * 管理画面の記事一覧に抜粋を表示
 */
function add_posts_columns_excerpt($columns) {
  $columns['summary'] = '抜粋'; // $colums['excerpt']と書くと表示がおかしくなる
  return $columns;
}
function add_posts_columns_excerpt_row($column_name, $post_id) {
  if ( 'summary' == $column_name ) {
    $excerpt = get_the_excerpt();
    $excerptLength = mb_strlen($excerpt, 'UTF-8');
    if ($excerptLength != 121) {
      echo $excerptLength.'文字';
    } else {
      echo 'なし';
    }
    //echo ( $excerpt ) ? 'あり（'.$excerptLength.'文字）' : 'なし';
  }
}

add_filter( 'manage_posts_columns', 'add_posts_columns_excerpt' );
add_action( 'manage_posts_custom_column', 'add_posts_columns_excerpt_row', 10, 2 );


/*
 * 各投稿のカスタムフィールドに「is_checked」を表示
 * 管理画面の記事一覧にダブルチェックの欄を表示
 */

// 各投稿のカスタムフィールドに「is_checked = 0」をデフォルトで表示
function set_is_checked($post_ID){
  //　現在のフィールド値を取得
  $current_field_value = esc_html(get_post_meta($post_ID,'is_checked', true));
  //　フィールド値が未設定でリビジョンがない場合（新規投稿の場合）、「is_checked = 0」のカスタムフィールドを表示
  if ($current_field_value == '' && !wp_is_post_revision($post_ID)){
          add_post_meta($post_ID, 'is_checked', 0);
  }
  return $post_ID;
}
add_action('wp_insert_post','set_is_checked');

// 管理画面の記事一覧にダブルチェックの欄を追加
function add_posts_columns_check($columns) {
  $columns['check'] = 'ダブルチェック'; 
  return $columns;
}

// 管理画面の記事にダブルチェックの項目を表示
function add_posts_columns_check_row($column_name, $post_id) {
  // カスタムフィールド 'is_checked' の値を取得
  $isChecked = get_post_meta($post_id, 'is_checked')[0];
  // カスタムフィールドの列が「ダブルチェック」かつ、'is_checked'の値が1ではない（＝チェック作業が終わってない）場合
  if ('check' == $column_name  && $isChecked != 1) {
    echo "<input type='checkbox'></input>"; //チェックが入っていないボックスを表示
  // カスタムフィールドの列が「ダブルチェック」かつ、'is_checked'の値が1（＝チェック作業が終わっている）場合
  } else if ( 'check' == $column_name && $isChecked == 1 ) {
    echo "<input type='checkbox' checked></input>"; //チェックが入っているボックスを表示
  }
}

add_filter( 'manage_posts_columns', 'add_posts_columns_check' );
add_action( 'manage_posts_custom_column', 'add_posts_columns_check_row', 10, 2 );


/*
 * 管理画面の記事一覧に「PV数」欄を表示
 */
function add_posts_columns_pv($columns) {
    $columns['pv'] = 'PV数'; 
    return $columns;
  }
  function add_posts_columns_pv_row($column_name, $post_id) {
    if ( 'pv' == $column_name ) {
        echo get_post_meta(get_the_ID(), 'post_views_count')[0]; 
    }
  }
  
  add_filter( 'manage_posts_columns', 'add_posts_columns_pv' );
  add_action( 'manage_posts_custom_column', 'add_posts_columns_pv_row', 10, 2 );


/*
 * WEBP対応
 */
function custom_mime_types( $mimes ) {
  $mimes['webp'] = 'image/webp';
  return $mimes;
}
add_filter( 'upload_mimes', 'custom_mime_types' );


/*
 * TOCを表示させる
 */
function toc_in($the_content) {
  if (is_single()) {
    $toc = "<div id=\"toc\"></div>";
 
    $h2 = '/<h2.*?>/i';//H2見出し
    if ( preg_match( $h2, $the_content, $h2s )) {
      $the_content  = preg_replace($h2, $toc.$h2s[0], $the_content, 1);
    }
  }
  return $the_content;
}
add_filter('the_content','toc_in');


/*
 * ctaBtnのショートコード追加＆クイックタグAPIでエディタに表示
 */
function ctaBtn( $atts, $content = null ) {
  extract( shortcode_atts( array(
      'url' => '',
      'quote' => "'",
  ), $atts ) );
   
  return '<button onclick="window.open('.$quote.$url.$quote.','.$quote.'blank'.$quote.')" class="ctaBtn">' . $content . '</button>';
}
add_shortcode('ctaBtn', 'ctaBtn');

function themes_add_ctaBtn () {
  if ( wp_script_is( 'quicktags' ) ) {
  $html  = '<script>';
  $html .= 'QTags.addButton( "eg_paragraph", "ctaBtn", "[ctaBtn url=]", "[/ctaBtn]", "ctaBtn", "Paragraph tag", 1 );';
  $html .= '</script>';
  
  echo $html;
  }
 }
 add_action( 'admin_print_footer_scripts', 'themes_add_ctaBtn' );


 /*
 * 鉤括弧のショートコード 追加＆クイックタグAPIでエディタに表示
 */
function dialogue( $attrs, $content = null ) {
  return '<div class="dialogue"><p>' . $content . '</p></div>';
}
add_shortcode('dialogue', 'dialogue');

function themes_add_dialogue () {
  if ( wp_script_is( 'quicktags' ) ) {
  $html  = '<script>';
  $html .= 'QTags.addButton( "eg_paragraph", "dialogue", "[dialogue]", "[/dialogue]", "ctaBtn", "Paragraph tag", 1 );';
  $html .= '</script>';
  echo $html;
  }
 }
 add_action( 'admin_print_footer_scripts', 'themes_add_dialogue' );


/*
 * そのほか
 */
remove_filter('pre_user_description', 'wp_filter_kses'); //プロフィールの自己紹介欄でHTMLを適用できるようにする
add_theme_support('post-thumbnails'); // Thumbnailを使えるようにする