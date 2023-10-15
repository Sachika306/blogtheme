<?php
    $rankingResultPath = get_theme_file_path('batchOutput/ranking-result.php');
    $rankingResult = wp_json_file_decode($rankingResultPath, true);
    $maxPostNum = (get_theme_mod('popular_article_control'));
    var_dump($rankingResult);
    for ($i=0; $i<=$maxPostNum; $i++) :
        $postId = preg_replace('/[^0-9]/', '', $rankingResult[$i][0]);
        var_dump(get_page_by_path(($rankingResult[$i][0])));
?>
    <article class="topArticles-element" itemscope itemtype ="https://schema.org/BlogPosting">
        <span class="topArticles-element__num"><?php echo ($i+1); ?></span>
        <h4 class="topArticles-element__title" itemprop="headline">
            <a href="<?php echo get_permalink( get_page_by_path($postId) ); ?>" itemprop="mainEntityOfPage">
                <?php echo get_the_title($postId); ?>
            </a>
        </h4>
    </article>
<?php
    endfor;
?>