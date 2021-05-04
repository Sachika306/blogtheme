<?php
  get_header();
?>

    <main role="main">
      <div class="container">

      <div class="breadcrumblist" itemscope itemtype="http://schema.org/BreadcrumbList">
          <ol>
            <li itemprop="itemListElement"><a href="<?php echo get_site_url(); ?>" itemprop="url">ホーム</a> > </li>
            <li>
              <?php
                if( is_singular() ) {
                  $category = get_the_category();
                  if ( is_single() ) {
                    the_category(' > ');
                  }
                  echo ' > ';
                  the_title();
                }
              ?>
            </li>
          </ol>
        </div>

        <section class="single col-md-8">
          <article itemscope itemtype ="https://schema.org/BlogPosting" class="single-item">
            <h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
            <div class="single-thumbnail" itemscope itemtype="http://schema.org/ImageObject">
              <?php get_template_part('template-parts/thumbnail'); ?>
            </div>
            <div class="single-metabox">
              <?php get_template_part('template-parts/dateAndCategory'); ?>
            </div>
            <div class="single-content" itemprop="articleBody">
              <?php the_content(); ?>
            </div>

            <div class="share">
              <ul class="">
                <li class="facebook"><i class="fab fa-facebook-f"></i></li>
                <li class="twitter"><i class="fab fa-twitter"></i></li>
                <li class="hatena"><i class="fab fa-hatena"></i></li>
              </ul>
            </div>
          </article>
          
          <section class="related">
            <div class="dashedLine"></div>
            <h3>「<a href="">カテゴリー</a>」のおすすめ記事</h3>

            <?php 
              $relatedArticles = new WP_query( array(
                'category_name ' => get_the_category()->name,
                'posts_per_page' => 3,
                'orderby' => 'modified',
                'post__not_in' => array(get_the_ID())
              ));

              if ( $relatedArticles->have_posts() ) {
                while ( $relatedArticles->have_posts() ) {
                  $relatedArticles->the_post();
            ?>

            <article class="related-box" itemscope itemtype="https://schema.org/BlogPosting">
              <div itemscope itemtype="https://schema.org/ImageObject" class="related-thumbnail">
                <a href="<?php the_permalink(); ?>" itemprop="url">
                  <?php get_template_part('template-parts/thumbnail'); ?>
                </a>
              </div>
              <a href="<?php the_permalink(); ?>" itemprop="mainEntityOfPage">
                <h4 class="" itemprop="headline"><?php the_title(); ?></h4>
              </a>
            </article>

            <?php 
                }
              }
              wp_reset_postdata(); // Restore original post data.
              ?>

          </section>
        </section>

        <?php get_sidebar(); ?>
      </div>

    </main>
    
<?php
  get_footer();
?>