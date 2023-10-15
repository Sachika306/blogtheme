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

// ランキングのJSON結果を取得する
function get_ranking_result_decoded() {
  $rankingResultPath = get_theme_file_path('batchOutput/ranking-result.php');
  if (!$rankingResultPath) {
    return null; 
  };

  $rankingResultDecoded = wp_json_file_decode($rankingResultPath, true);
  return $rankingResultDecoded;
}

// ランキングをタイトルとURLの配列にする
function get_ranking_result() {
  $rankingResultDecoded = get_ranking_result_decoded();
  $maxPostNum = (get_theme_mod('popular_article_control'));
  for ($i = 0; $i <= $maxPostNum; $i++) {
    $post_obj = get_page_by_path($rankingResultDecoded[$i][0], OBJECT, 'post');
    if ($post_obj) {
      $rankingResult[] = array(
        'rank' => $i+1,
        'title' => get_the_title($post_obj->ID),
        'permalink'  => get_permalink($post_obj->ID),
      );
    }
  }

  return $rankingResult;
}

/*
 * そのほか
 */
remove_filter('pre_user_description', 'wp_filter_kses'); //プロフィールの自己紹介欄でHTMLを適用できるようにする
add_theme_support('post-thumbnails'); // Thumbnailを使えるようにする
