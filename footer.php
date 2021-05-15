
    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerLeft'); ?></h3>
              <?php get_template_part('/template-parts/footerLeft');?>
            </div> 
          </div>
          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerCenter'); ?></h3>
              <div>
              <?php get_template_part('/template-parts/footerCenter');?>
              </div>
            </div>  
          </div>
          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerRight'); ?></h3>
                <!-- ブログ画像のロゴ -->
                <div itemscope itemtype="https://schema.org/imageObject" class="header-logo">
                  <a href="<?php echo home_url(); ?>" itemprop="url">
                    <img itemprop="logo" src="https://selftaught056.com/wp-content/uploads/2021/05/logo.png" alt="Logo">
                  </a>
                  <!-- https://developers.google.com/search/docs/data-types/article#logo-guidelines -->
                </div>
                <p><?php echo get_bloginfo('description'); ?></p>
              <div itemscope itemtype="https://schema.org/Person">
                <h3 class="footerMenu-title">筆者プロフィール</h3>
                <img class="profile-image" src="<?php echo get_avatar_url(wp_get_current_user()); ?>" alt="プロフィール画像" >
                <p class="profile-text"><?php the_author_meta('description'); ?></p>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="copyright">
        Copyright - S, 2021 All Rights Reserved.
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
