
<?php
  get_header();
?>
    
    <main role="main" itemscope itemtype="http://schema.org/Blog" itemprop="mainContentOfPage" class="container">
    
        <section class="article col-md-8">
        <?php if (empty (get_search_query()) ): ?>
            <h1 class="article-archiveHeading">検索結果</h1>
            <div class="article-search">
                <?php get_search_form(); ?>
            </div>
            <p>キーワードが未入力でした。<br>もう一度検索してみてください。</p>
        <?php elseif (have_posts()) : ?>
            <h1 class="article-archiveHeading">「<?php echo get_search_query(); ?>」に関する記事（<?php echo $wp_query->found_posts; ?>件）</h1>
            <?php while(have_posts()): the_post(); ?>
                <article itemscope itemtype ="https://schema.org/BlogPosting" class="article-item">
                    <h2 itemprop="headline" class="article-title" >
                    <a href="<?php the_permalink(); ?>" itemprop="mainEntityOfPage"><?php the_title(); ?></a>
                    </h2>
                    <div class="article-thumbnail" itemscope itemtype="http://schema.org/ImageObject">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">
                      <?php get_template_part('template-parts/thumbnail'); ?>
                        <!--  画像幅は696 ピクセル以上　https://developers.google.com/search/docs/data-types/article#non-amp -->
                    </a>
                    </div>
                    
                    <div class="article-metabox">
                    <?php get_template_part('template-parts/dateAndCategory'); ?>
                    <p class="article-metabox__description" itemprop="description"><?php the_excerpt(); ?></p>
                    </div>
                    <div class="article-readmore">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">&raquo; READ</a>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h1 class="article-archiveHeading">検索結果</h1>
            <div class="article-search">
                <?php get_search_form(); ?>
            </div>
            <p>記事が見つかりませんでした。<br>類語などでもう一度検索してみてください。</p>
        <?php endif; ?>

          <div class="pagination">
            <div class="pagination-prev">
              <?php previous_posts_link('&laquo; PREV'); ?>
            </div>
            <div class="pagination-next">
              <?php next_posts_link('NEXT &raquo;'); ?>
            </div>
          </div>

        </section>

        <?php get_sidebar(); ?>
      </div>
    </main>

<?php
  get_footer();
?>