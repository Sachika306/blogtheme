<?php
  get_header();
?>

    <main>
      <div class="container">

        <?php get_template_part('template-parts/breadcrumbList'); ?>

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
                <li class="facebook"><a class="sns__facebook" href="http://www.facebook.com/share.php?u=<? echo get_the_permalink(); ?>" target="_blank" rel="nofollow noopener"><i class="fab fa-facebook-f"></i></a></li>
                <li class="twitter"><a class="sns__twitter" href="https://twitter.com/share?url=<? echo get_the_permalink(); ?>&text=<? echo get_the_title(); ?>" target="_blank" rel="nofollow noopener"><i class="fab fa-twitter"></i></a></li>
                <li class="hatena"><a class="sns__line" href="https://social-plugins.line.me/lineit/share?url=<? echo get_the_permalink(); ?>" target="_blank" rel="nofollow noopener"><i class="fab fa-hatena"></i></a></li>
              </ul>
            </div>
          </article>
          
          <section class="related">
            <div class="dashedLine"></div>
            <h3>関連記事</h3>

            <?php 
              $relatedArticles = new WP_query( array(
                'category_name ' => get_the_category()[0]->name,
                'posts_per_page' => 3,
                'orderby' => 'modified',
                'post__not_in' => array(get_the_ID())
              ));

              if ( $relatedArticles->have_posts() ) {
                while ( $relatedArticles->have_posts() ) {
                  $relatedArticles->the_post();
            ?>

            <article class="related-box" itemscope itemtype="https://schema.org/BlogPosting">
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
  
  <?php get_template_part('template-parts/accessCount'); ?>
<?php get_footer(); ?>