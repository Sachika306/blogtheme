
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
              <div>
                <p><?php the_author_meta('description'); ?></p>
                <?php get_template_part('/template-parts/footerRight');?>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="copyright">
        Copyright - S, 2021 All Rights Reserved.
      </div>
    </footer>

    <link rel="stylesheet" href="">
    <?php wp_footer(); ?>
  </body>
</html>
