<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php $isHome = is_front_page() || is_home(); ?>
    <title><?php ($isHome) ? print(get_bloginfo('name')) : print(get_the_title(get_post())); ?></title>
    <!-- OG tag -->
      <meta property="og:url" content="<?php ($isHome) ? print(get_site_url()) : print(get_the_permalink(get_post())); ?>" />
      <meta property="og:type" content="website" />
      <meta property="og:title" content="<?php ($isHome) ? print(get_bloginfo('name')) : print(get_the_title(get_post())) ; ?>" />
      <meta property="og:description" content="<?php ($isHome) ? print(get_bloginfo('description')) : print(get_the_excerpt(get_post()))?>" />
      <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
      <meta property="og:image" content="<?php ($isHome) ? print(get_site_icon_url()) : print(get_the_post_thumbnail_url(get_post())); ?>" />
    <!-- END OG tag -->
    <!-- Twitter Card Tag -->
      <meta name="twitter:card" content="summary">
      <?php if (get_option('twitterSite')) : ?>
        <meta name="twitter:site" content="<?php echo get_option('twitterSite') ?>">
        <meta name="twitter:creator" content="<?php echo get_option('twitterSite') ?>">
      <?php endif; ?>
    <!-- End Twitter Card Tag -->
    <!-- Google Tag Manager -->
      <?php if (get_option('googleTagManager')) : ?>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?php echo get_option('googleTagManager'); ?>');</script>
      <?php endif; ?>
    <!-- End Google Tag Manager -->
    <!-- Others -->
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <?php wp_head(); ?>
    <!-- End Others -->
  </head>

  
  <body>

  <?php if (get_option('googleTagManager')) : ?>
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

        <div class="header-pcmenu">
          <?php get_template_part('/template-parts/categoryMenu');?>
        </div>

        <!-- 検索ボタン -->
        <div class="header-nav__md">
          <i class="fa fa-search fa-2x"></i>
        </div>

        <!-- スマホ用ヘッダーナビゲーションボタン -->
        <?php if (get_theme_mod('header_mobile_menu_control')) : ?>
          <div class="header-nav__sp">
            <i class="fa fa-bars fa-lg"></i>
          </div>
        <?php endif; ?>
      </div>
      <!-- スマホ用ナビゲーション -->
      <div class="header-spmenu">
        <?php get_template_part('/template-parts/categoryMenu');?>
      </div>
    </header>

    <div class="search">
      <?php get_search_form(); ?>
    </div>