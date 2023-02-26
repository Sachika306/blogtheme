<?php
    $rankingResultPath = get_theme_file_path('batchOutput/ranking-result.php');
    $rankingResult = wp_json_file_decode($rankingResultPath, true);
    $maxPostNum = (get_theme_mod('popular_article_control'));
    for ($i=0; $i<=$maxPostNum; $i++) :
        $postId = preg_replace('/[^0-9]/', '', $rankingResult[$i][0]);
?>
    <article class="topArticles-element" itemscope itemtype ="https://schema.org/BlogPosting">
        <span class="topArticles-element__num"><?php echo ($i+1); ?></span>
        <h4 class="topArticles-element__title" itemprop="headline">
            <a href="<?php echo get_the_permalink($postId); ?>" itemprop="mainEntityOfPage">
                <?php echo get_the_title($postId); ?>
            </a>
        </h4>
    </article>
<?php
    endfor;
?>