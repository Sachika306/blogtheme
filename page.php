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
          </article>
        </section>

        <?php get_sidebar(); ?>
      </div>

    </main>
  
  <?php get_template_part('template-parts/accessCount'); ?>
<?php get_footer(); ?>