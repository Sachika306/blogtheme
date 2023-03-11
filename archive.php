<?php
  get_header();
?>
    
    <main itemscope itemtype="http://schema.org/Blog" class="container">

      <section class="article col-md-8" itemprop="mainContentOfPage">
        <?php get_template_part('template-parts/breadcrumbList'); ?>

        <!-- カテゴリーの見出し -->
        <h2 class="article-archiveHeading">
          <?php
              if ( is_category() ) {
                $currentCategory = get_category( get_query_var('cat') ); // 現在表示しているカテゴリの情報を取得
                $parentCatInt = $currentCategory->category_parent;  // 親カテゴリのIDを取得
                // 親カテゴリがある場合
                if ( $parentCatInt !== 0 ) {
                  echo '「' . get_cat_name( $parentCatInt ) . '」>'; // 親カテゴリ名を表示
                  echo '「' . $currentCategory->cat_name . '」';  // 子カテゴリ名を表示
                } else { 
                  echo '「' . $currentCategory->cat_name . '」';  // 親カテゴリがない場合は、カテゴリ名のみを表示
                }
              } elseif ( is_tag() ) {
                $currentTag = get_queried_object(); // 現在表示しているタグの情報を取得
                $parentTagID = $currentTag->parent; // 親タグのIDを取得
                // 親タグがある場合の処理
                if ( $parentTagID ) {
                  $parentTag = get_term( $parentTagID ); // 親タグ名を表示
                  echo '「' . $parentTag->name . '」>';
                }
                echo '「' . $currentTag->name . '」'; // 子タグ名を表示
              } else {
                // カテゴリアーカイブページでもタグアーカイブページでもない場合は、「アーカイブ」と表示
                echo 'アーカイブ';
              }
          ?>の記事
        </h1>

        <?php 
          if ( have_posts() ) : 
          while ( have_posts() ) : the_post(); ?>

          <?php echo get_template_part('/template-parts/articleIndex'); ?>

        <?php
          endwhile; 
          endif; ?>

          <div class="pagination">
            <div class="pagination-prev">
              <?php previous_posts_link('&laquo; 前へ'); ?>
            </div>
            <div class="pagination-next">
              <?php next_posts_link('次へ'); ?>
            </div>
          </div>

      </section>

      <?php get_sidebar(); ?>
        
    </main>
    
    <?php get_template_part('template-parts/accessCount'); ?>
<?php get_footer(); ?>