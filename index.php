<?php
  get_header();
?>
    
    <main itemscope itemtype="http://schema.org/Blog" itemprop="mainContentOfPage">
      <div class="container">
        <div class="article col-md-8">
          <?php 
            if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); ?>

            <?php echo get_template_part('/template-parts/articleIndex'); ?>

          <?php
            endwhile; 
            endif; ?>

            <div class="pagination">
              <div class="pagination-prev">
                <?php previous_posts_link('&laquo; PREV'); ?>
              </div>
              <div class="pagination-next">
                <?php next_posts_link('NEXT &raquo;'); ?>
              </div>
            </div>

        </div>

        <?php get_sidebar(); ?>
        
      </div>
    </main>

<?php
  get_footer();
?>