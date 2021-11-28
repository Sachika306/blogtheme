
    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <div class="footerMenu-item">
                <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerLeft'); ?></h3>
                <?php get_template_part('/template-parts/footerLeft');?>
              </div>
            </div> 
          </div>

          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <div class="footerMenu-item">
                <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerCenter'); ?></h3>
                <div>
                <?php get_template_part('/template-parts/footerCenter');?>
                </div>
              </div>
            </div>  
          </div>

          <div class="footerMenu col-md-4">
            <div class="footerMenu-content">
              <div class="footerMenu-item">
                <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerRight'); ?></h3>
                <!-- ブログ画像のロゴ -->
                <div itemscope itemtype="https://schema.org/imageObject" class="header-logo">
                  <a href="<?php echo home_url(); ?>" itemprop="url">
                    <img itemprop="logo" src="<?php echo get_option('logoImg'); ?>" alt="Logo">
                  </a>
                  <!-- https://developers.google.com/search/docs/data-types/article#logo-guidelines -->
                </div>
                <p><?php echo get_bloginfo('description'); ?></p>
              </div>

              <div class="footerMenu-item">
                <div itemscope itemtype="https://schema.org/Person">
                <h3 class="footerMenu-title">プロフィール</h3>
                <div class="profile-image">
                  <img class="profile-image__content" src="<?php echo get_option('profileImg'); ?>" alt="プロフィール画像" >
                </div>
                <p class="profile-text"><?php the_author_meta('description'); ?></p>
                </div>
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
