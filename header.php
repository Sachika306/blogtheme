<!DOCTYPE html>
<html lang="ja">
  <head>
    <title><?php echo get_bloginfo('name'); ?></title>
    <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5ZPKMDR');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/path/to/favicon.ico">
    <?php wp_head(); ?>
  </head>
  
  <body>
    <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5ZPKMDR"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

  <header class="header">
      <div class="header-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <div itemprop="logo" itemscope itemtype="https://schema.org/imageObject">

        <?php is_home() ? print '<h1 style="margin: 0px;">' : print '<h2 style="margin: 0px;">' ?>
          <a href="<?php echo get_site_url(); ?>" itemprop="url">
            <img src="http://selftaught056.com/wp-content/uploads/2021/05/logo.png" alt="Logo">
            <!-- https://developers.google.com/search/docs/data-types/article#logo-guidelines -->
          </a>
          <?php is_home() ? print '</h1>' : print '</h2>' ?>
          <p style="display: none;" itemprop="name">blogtitle</p>
        </div>
      </div>
      
      <!-- ヘッダーナビゲーション -->
      <div class="header-nav">
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
        <div class="spnavMenu-search">
            <?php get_search_form(); ?>
        </div>
    </div>

    <div class="search">
      <?php get_search_form(); ?>
    </div>