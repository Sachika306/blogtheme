<?php
  get_header();
?>
    
    <main role="main" itemscope itemtype="http://schema.org/Blog" itemprop="mainContentOfPage" class="container">

        <section class="article col-md-8">
        <?php get_template_part('template-parts/breadcrumbList'); ?>

        <!-- カテゴリーの見出し -->
        <h1 class="article-archiveHeading">
          <?php
            // 現在開いているページのカテゴリと親のカテゴリーの情報取得
            $currentCategory = get_category(get_query_var('cat'));
            $parentCatInt = $currentCategory->category_parent;

            // 親のカテゴリーがある場合の処理
            if ($parentCatInt !== 0) {
              echo '「'.get_cat_name($parentCatInt).'」>';
              echo '「'.$currentCategory->cat_name.'」';
            // 親のカテゴリーがない場合の処理
            } else { 
              echo '「'.$currentCategory->cat_name.'」';
            }
          ?>の記事
        </h1>

        <?php 
          if ( have_posts() ) : 
          while ( have_posts() ) : the_post(); ?>
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

        <?php
          endwhile; 
          endif; ?>

          <div class="pagination">
            <div class="pagination-prev">
              <?php previous_posts_link('&laquo; PREV'); ?>
            </div>
            <div class="pagination-next">
              <?php next_posts_link('NEXT'); ?>
            </div>
          </div>

        </section>

        <?php get_sidebar(); ?>
      </div>
    </main>
    
    <?php get_template_part('template-parts/accessCount'); ?>
<?php get_footer(); ?>