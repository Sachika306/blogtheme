<?php
    if (count($args) > 0):
        foreach($args as $data):
?>
    <article class="topArticles-element" itemscope itemtype ="https://schema.org/BlogPosting">
        <span class="topArticles-element__num"><?php echo ($data['rank']); ?></span>
        <h4 class="topArticles-element__title" itemprop="headline">
            <a href="<?php echo $data['permalink']; ?>" itemprop="mainEntityOfPage">
                <?php echo $data['title']; ?>
            </a>
        </h4>
    </article>
<?php
        endforeach;
    endif;
?>