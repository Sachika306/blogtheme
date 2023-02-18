
<?php
  get_header();
?>
    
    <main itemscope itemtype="http://schema.org/Blog" class="container">
    
        <section class="article col-md-8" itemprop="mainContentOfPage">
          
        <?php get_template_part('template-parts/breadcrumbList'); ?>
        <?php if (empty (get_search_query()) ): ?>
            <h2 class="article-archiveHeading">検索結果</h1>
            <div class="article-search">
                <?php get_search_form(); ?>
            </div>
            <p>キーワードが未入力でした。<br>もう一度検索してみてください。</p>
        <?php elseif (have_posts()) : ?>
            <h2 class="article-archiveHeading">「<?php echo get_search_query(); ?>」に関する記事（<?php echo $wp_query->found_posts; ?>件）</h1>
            <?php while(have_posts()): the_post(); ?>

            <?php echo get_template_part('/template-parts/articleIndex'); ?>

            <?php endwhile; ?>
        <?php else : ?>
            <h2 class="article-archiveHeading">検索結果</h1>
            <div class="article-search">
                <?php get_search_form(); ?>
            </div>
            <p>記事が見つかりませんでした。<br>類語などでもう一度検索してみてください。</p>
        <?php endif; ?>

          <div class="pagination">
            <div class="pagination-prev">
              <?php previous_posts_link('&laquo; 前へ'); ?>
            </div>
            <div class="pagination-next">
              <?php next_posts_link('次へ &raquo;'); ?>
            </div>
          </div>

        </section>

        <?php get_sidebar(); ?>

    </main>

<?php
  get_footer();
?>