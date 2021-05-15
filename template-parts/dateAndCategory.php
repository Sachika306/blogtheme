<p class="<?php is_home() ? print 'article' : print 'single' ?>-metabox__date">
    <time class="datePublished" itemprop="datePublished" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time><span>公開</span>
    <?php if(get_the_date() != get_the_modified_date()) :?>
        <span>（</span><time class="dateModified" itemprop="dateModified" datetime="<?php echo get_the_modified_date(); ?>"><?php echo get_the_modified_date(); ?></time><span>更新）</span>
    <?php endif; ?>
    <a href=""><?php the_category('/'); ?></a>
</p>