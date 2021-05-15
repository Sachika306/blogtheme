<p class="<?php is_home() ? print 'article' : print 'single' ?>-metabox__date">
    <time class="datePublished" itemprop="datePublished" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
    <?php if(get_the_date() != get_the_modified_date()) :?>
        （<time class="dateModified" itemprop="dateModified" datetime="<?php echo get_the_modified_date(); ?>"><?php echo get_the_modified_date(); ?></time>更新）
    <?php endif; ?>
    <a href=""><?php the_category('/'); ?></a>
</p>