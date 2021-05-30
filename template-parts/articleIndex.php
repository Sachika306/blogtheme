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
        <div class="article-metabox__description" itemprop="description"><?php the_excerpt(); ?></div>
    </div>
    <div class="article-readmore">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">記事を読む</a>
    </div>
</article>