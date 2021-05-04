<!DOCTYPE html>
<html lang="ja">
  <head>
    <title><?php echo get_bloginfo('name'); ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/path/to/favicon.ico">
    <?php wp_head(); ?>
  </head>
  
  <body>

  <header class="header">
      <div class="header-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <div itemprop="logo" itemscope itemtype="https://schema.org/imageObject">

        <?php is_home() ? print '<h1 style="margin: 0px;">' : print '<h2 style="margin: 0px;">' ?>
          <a href="<?php echo get_site_url(); ?>" itemprop="url">
            <img src="http://localhost:10028/add-a-heading/" alt="Logo">
            <!-- https://developers.google.com/search/docs/data-types/article#logo-guidelines -->
          </a>
          <?php is_home() ? print '</h1>' : print '</h2>' ?>
          <p style="display: none;" itemprop="name">blogtitle</p>
        </div>
      </div>
      
      <!-- ヘッダーナビゲーション -->
      <div class="header-nav">
          <nav itemprop="name">
            <?php get_template_part('/template-parts/categoryMenu');?>
          </nav>
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