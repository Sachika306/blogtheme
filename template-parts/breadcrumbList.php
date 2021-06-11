<ol class="breadcrumblist" itemscope itemtype="http://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item url" href="<?php echo get_site_url(); ?>">
        <span itemprop="name">ホーム</span>
        </a>
        <meta itemprop="position" content="1">
    </li>
    <li class="breadcrumblist-divider">></li>

    <?php
    $i = 1;
    
    // アーカイブページの場合のパンくず
    if (is_archive()) {
        $currentArcCat = get_category(get_query_var('cat'));
        $parentCatInt = $currentArcCat->category_parent;
        $parent = get_category($currentArcCat->$parentCatInt);

        // 親カテゴリがある場合
        if ($parentCatInt !== 0) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a itemprop="item url" href="'.get_category_link($parentCatInt).'">';
            echo '<span itemprop="name">'.get_cat_name($parentCatInt).'</span>';
            echo '</a>';
            $i ++;
            echo '<meta itemprop="position" content="'.$i.'">';
            echo '</li>';
            echo '<span class="breadcrumblist-divider">></span>';
        } 
        // 現在のカテゴリ表示
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="item">';
        echo '<span itemprop="name">'.$currentArcCat->cat_name.'</span>';
        echo '</span>';
        $i ++;
        echo '<meta itemprop="position" content="'.$i.'">';
        echo '</li>';
    }

    // 個別記事の場合のパンクず
    if (is_singular() && !is_page()) {
        $currentCat = get_the_category()[0];
        $parentCatInt = $currentCat->category_parent;
        $parent = get_category($parentCatInt);
        if ($parentCatInt !== 0) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a itemprop="item url" href="'.get_category_link($parentCatInt).'">';
            echo '<span itemprop="name">'.$parent->cat_name.'</span>';
            echo '</a>';
            $i ++;
            echo '<meta itemprop="position" content="'.$i.'">';
            echo '</li>';
            echo '<span class="breadcrumblist-divider">></span>';
        } 

        // 属するカテゴリの名前
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item url" href="'.get_category_link($currentCat->cat_ID).'">';
        echo '<span itemprop="name">'.$currentCat->cat_name.'</span>';
        echo '</a>';
        $i ++;
        echo '<meta itemprop="position" content="'.$i.'">';
        echo '</li>';
        echo '<p class="breadcrumblist-divider">></p>';

        // 個別記事のタイトル
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="item">';
        echo '<span itemprop="name">'.the_title().'</span>';
        echo '</span>';
        $i ++;
        echo '<meta itemprop="position" content="'.$i.'">';
        echo '</li>';
    }

    // 固定記事の場合のパンクず
    if (is_page()) {
        $currentCat = get_the_category()[0];
        $parentCatInt = $currentCat->category_parent;
        $parent = get_category($parentCatInt);

        // 個別記事のタイトル
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="item">';
        echo '<span itemprop="name">'.the_title().'</span>';
        echo '</span>';
        $i ++;
        echo '<meta itemprop="position" content="'.$i.'">';
        echo '</li>';
    }

    if (is_search()) {
        $currentCat = get_the_category()[0];
        $parentCatInt = $currentCat->category_parent;
        $parent = get_category($parentCatInt);

        // 個別記事のタイトル
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="item">';
        echo '<span itemprop="name">「'.get_search_query().'」の検索結果</span>';
        echo '</span>';
        $i ++;
        echo '<meta itemprop="position" content="'.$i.'">';
        echo '</li>';
    }
    ?>
</ol>