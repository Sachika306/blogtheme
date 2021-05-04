<p class="<?php is_home() ? print 'article' : print 'single' ?>-metabox__date">
    <time itemprop="datePublished" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?>公開</time>
    <?php if(get_the_date() != get_the_modified_date()) :?>
        （<span itemprop="dateModified" datetime="<?php echo get_the_modified_date(); ?>"><?php echo get_the_modified_date(); ?></span>更新）
    <?php endif; ?>
    <a href=""><?php the_category('/'); ?></a>
</p>