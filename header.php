<!DOCTYPE html>
<html lang="ja">
  <head>
    <title><?php echo get_bloginfo('name'); ?></title>
    <?php if ( null !== (get_option('googleTagManager')) ) : ?>
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?php echo get_option('googleTagManager'); ?>');</script>
      <!-- End Google Tag Manager -->
    <?php endif; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/uploads/2021/05/favicon-16x16.webp">
    <?php wp_head(); ?>
  </head>

  
  <body>

  <?php if ( null !== (get_option('googleTagManager')) ) : ?>
    <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo get_option('googleTagManager'); ?>"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  <?php endif; ?>

  <header class="header">
      <!-- ヘッダーナビゲーション -->
      <div class="header-nav">

        <!-- ヘッダー左のブログ名-->
        <div class="header-titlewrapper" itemscope itemtype="https://schema.org/Organization">
          <a href="<?php echo home_url(); ?>" itemprop="url">
            <h1 class="header-title" itemprop="publisher">
              <?php if (get_theme_mod('header_logo_control')) {
                  echo get_theme_mod('header_logo_control'); 
                } ?>
            </h1>
          </a>
        </div>
        <?php get_template_part('/template-parts/categoryMenu');?>

        <!-- 検索ボタン -->
        <div class="header-nav__md">
          <i class="fa fa-search fa-2x"></i>
        </div>

        <!-- スマホ用ヘッダーナビゲーションボタン -->
        <div class="header-nav__sp">
          <i class="fa fa-bars fa-lg"></i>
        </div>
      </div>
    </header>

    <!-- スマホ用ナビゲーション -->
    <div class="spnavMenu">
      <?php get_template_part('/template-parts/categoryMenu');?>
    </div>

    <div class="search">
      <?php get_search_form(); ?>
    </div>