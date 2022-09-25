
    <footer>
      <div class="container-fluid">
        <div class="row">

          <div class="footerMenu col-md-4">
            <?php if (get_theme_mod('show_footer_left_control')) :?>
              <?php if (wp_get_nav_menu_name('footerLeft')) :?>
                <div class="footerMenu-content">
                  <div class="footerMenu-item">
                    <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerLeft'); ?></h3>
                    <?php get_template_part('/template-parts/footerLeft');?>
                  </div>
                </div> 
              <?php endif; ?>
            <?php endif; ?>
          </div>
          
          <div class="footerMenu col-md-4">
            <?php if (get_theme_mod('show_footer_center_control')) :?>
              <?php if (wp_get_nav_menu_name('footerCenter')) :?>
                <div class="footerMenu-content">
                  <div class="footerMenu-item">
                    <h3 class="footerMenu-title"><?php echo wp_get_nav_menu_name('footerCenter'); ?></h3>
                    <div>
                    <?php get_template_part('/template-parts/footerCenter');?>
                    </div>
                  </div>
                </div>  
              <?php endif; ?>
            <?php endif; ?>
          </div>

          <div class="footerMenu col-md-4">
            <?php if (get_theme_mod('show_footer_right_control')) :?>
              <?php if (get_theme_mod('show_twitter_control')) :?>
                <div class="footerMenu-content">
                  <div class="footerMenu-item">
                    <h3 class="footerMenu-title"><?php echo get_theme_mod('twitter_title_control'); ?></h3>
                      <?php echo get_theme_mod('twitter_list_control'); ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
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
