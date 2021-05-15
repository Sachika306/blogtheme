<p class="<?php is_home() ? print 'article' : print 'single' ?>-metabox__date">
    <time class="datePublished" itemprop="datePublished" datetime="<?php echo get_the_date('Y-m-d g:i+09:00'); ?>"><?php echo get_the_date(); ?></time><span>公開</span>
    <?php if(get_the_date() != get_the_modified_date()) :?>
        <span>（</span><time class="dateModified" itemprop="dateModified" datetime="<?php echo get_the_modified_date('Y-m-d g:i+09:00'); ?>"><?php echo get_the_modified_date(); ?></time><span>更新）</span>
    <?php endif; ?>
    <?php the_category('/'); ?>
</p>