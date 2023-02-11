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
 * カスタマイザーで設定した色を反映
 */
function customizer_option_css(){
  $headerColor = get_theme_mod('header_color_control');
  $accentColor = get_theme_mod('accent_color_control');
  $lightAccentColor = get_theme_mod('light_accent_color_control');
  if(!empty($headerColor) && !empty($accentColor) && !empty($lightAccentColor)):
  ?>
  <style type="text/css" id="customizer_option_css">
    .header{
      background:<?php echo $headerColor; ?>;
    }

    .article-readmore a {
      color: <?php echo $accentColor; ?>;
    }

    .pagination-next a, .pagination-prev a {
      background-color: <?php echo $accentColor; ?>;
    }

    .sidebar-title::after, footer .footerMenu-title:after {
      background-color: <?php echo $accentColor; ?>;
    }

    /* 目次 */
    #toc {
      border-top: <?php echo '3px solid ' . $accentColor; ?>;
    }

    #toc {
      background-color: <?php echo $lightAccentColor; ?>;
    }

    #toc .toc-title {
      color: <?php echo $accentColor; ?>;
    }

    #toc .toc-oc {
      background-color: <?php echo $accentColor; ?>;
    }

    /* 固定ページ */
    .single h2 {
      border-bottom: <?php echo '3px solid ' . $accentColor; ?>;
    }
  </style>
  <?php
  endif;	
}
add_action('wp_head', 'customizer_option_css' );




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
 * 管理画面に設定画面を追加
 */
add_action('admin_menu', 'my_theme_option');
function my_theme_option() {
  add_options_page( 'テーマ設定', 'テーマ設定', 'edit_themes','theme_option','theme_option_file' );
}

function theme_option_file(){
  require_once ( get_template_directory() . '/theme-options.php' );
}

add_action('admin_init', 'my_theme_option_setting' );
function my_theme_option_setting() {
    register_setting( 'myoption-group', 'googleTagManager' );
    register_setting( 'myoption-group', 'twitterSite' );
}

// オリジナルパーツ読み込み
get_template_part( 'include/custom' );
add_action('customize_register', 'sidebar_panel');

/*
 * 管理画面の記事一覧に「KW」欄を表示
 */
function add_customfields($post_ID){
  $post_ID['thumbnail'] = 'サムネイル';
  $post_ID['summary'] = '抜粋'; // $colums['excerpt']と書くと表示がおかしくなる
  $post_ID['check'] = 'ダブルチェック'; 
  $post_ID['pv'] = 'PV数'; 
  $post_ID['kw'] = 'KW';
  return $post_ID;
}
add_filter( 'manage_posts_columns', 'add_customfields' );


function add_columns($column_name, $post_ID) {
  // サムネイル
  if ( 'thumbnail' == $column_name ) {
    $thumb = get_the_post_thumbnail($post_id, array(100,100), 'thumbnail');
    echo ( $thumb ) ? 'あり' : '－';
  }

  // 抜粋の表示
  if ( 'summary' == $column_name ) {
    $excerpt = get_the_excerpt();
    $excerptLength = mb_strlen($excerpt, 'UTF-8');
    if ($excerptLength != 121) {
      echo $excerptLength.'文字';
    } else {
      echo 'なし';
    }
  }

  // チェック済みか否かの表示
  $isChecked = get_post_meta($post_ID, 'is_checked')[0];
  if ('check' == $column_name  && $isChecked != 1) { // カスタムフィールドの列が「ダブルチェック」かつ、'is_checked'の値が1ではない（＝チェック作業が終わってない）場合
    echo "<input type='checkbox'></input>"; //チェックが入っていないボックスを表示
  } else if ( 'check' == $column_name && $isChecked == 1 ) { // カスタムフィールドの列が「ダブルチェック」かつ、'is_checked'の値が1（＝チェック作業が終わっている）場合
    echo "<input type='checkbox' checked></input>"; //チェックが入っているボックスを表示
  }

  // kwの表示
  if ( 'kw' == $column_name ) {
      echo get_post_meta(get_the_ID(), 'kw')[0]; 
      echo '(';
      echo get_post_meta(get_the_ID(), 'search')[0];
      echo get_post_meta(get_the_ID(), 'difficulty')[0];
      echo ')'; 
  }

  // pvの表示
  if ( 'pv' == $column_name ) {
    echo get_post_meta(get_the_ID(), 'post_views_count')[0]; 
  }
}
add_action( 'manage_posts_custom_column', 'add_columns', 10, 2 );


// 各投稿のカスタムフィールドに「is_checked = 0」をデフォルトで表示
function set_kw($post_ID){
  //　現在のフィールド値を取得
  $current_field_value = esc_html(get_post_meta($post_ID,'kw', true));
  $current_field_value = esc_html(get_post_meta($post_ID,'search', true));
  $current_field_value = esc_html(get_post_meta($post_ID,'is_checked', true));
  //　フィールド値が未設定でリビジョンがない場合（新規投稿の場合）、下記のカスタムフィールドを表示
  if ($current_field_value == '' && !wp_is_post_revision($post_ID)){
          add_post_meta($post_ID, 'kw', '未設定');
          add_post_meta($post_ID, 'search', '未設定');
          add_post_meta($post_ID, 'search_difficulty', '未設定');
          add_post_meta($post_ID, 'is_checked', 0); 
  }
  return $post_ID;
}
add_action('wp_insert_post','set_kw');

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


// dialogue
function dialogue( $attrs, $content = null ) {
  return '<div class="dialogue"><p>' . $content . '</p></div>';
}
add_shortcode('dialogue', 'dialogue');


// クイックタグAPIでエディタに表示
function themes_add_presco() {
  // ctaBtn
  $html  = '<script>';
  $html .= 'QTags.addButton( "ctaBtn", "ctaBtn", "[ctaBtn url= type=]", "[/ctaBtn]", "ctaBtn", "Paragraph tag", 1 );';
  $html .= '</script>';
  echo $html;

  // dialogue
  if ( wp_script_is( 'quicktags' ) ) {
  $html  = '<script>';
  $html .= 'QTags.addButton( "dialogue", "dialogue", "[dialogue]", "[/dialogue]", "dialogue", "Paragraph tag", 2);';
  $html .= '</script>';
  echo $html;
  }
}
 add_action( 'admin_print_footer_scripts', 'themes_add_presco' );

/*
 * そのほか
 */
remove_filter('pre_user_description', 'wp_filter_kses'); //プロフィールの自己紹介欄でHTMLを適用できるようにする
add_theme_support('post-thumbnails'); // Thumbnailを使えるようにする
