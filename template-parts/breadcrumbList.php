<ol class="breadcrumblist" itemscope itemtype="http://schema.org/BreadcrumbList">
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <a itemprop="item url" href="<?php echo get_site_url(); ?>">
      <span itemprop="name">ホーム</span>
    </a>
    <meta itemprop="position" content="1">
  </li>
  <li class="breadcrumblist-divider" style="padding: 0 2px;">&gt</li>

  <?php
    function breadcrumb_item($title, $link = null, $position, $is_last = false) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo $link !== null ? '<a itemprop="item url" href="'. $link .'">' : '';
        echo '<span itemprop="name">'. $title .'</span>';
        echo $link !== null ? '</a>' : '';
        echo '<meta itemprop="position" content="'. $position .'">';
        echo !$is_last ? ' <li class="breadcrumblist-divider">&gt;</li> ' : '';
        echo '</li>';
    }
  $position = 2;

  if (is_archive()) {
    if (is_tag()) {
      breadcrumb_item(get_queried_object()->name, null, $position, true);
    } else {
      $currentArcCat = get_category(get_query_var('cat'));
      $parentCatInt = $currentArcCat->category_parent;
      $parent = get_category($currentArcCat->$parentCatInt);
      if ($parentCatInt !== 0) {
        breadcrumb_item(get_cat_name($parentCatInt), get_category_link($parentCatInt), $position, false);
        $position++;
      }
      breadcrumb_item($currentArcCat->cat_name, null, $position, true);
    }
  }

  if (is_singular() && !is_page()) {
    $currentCat = get_the_category()[0];
    $parentCatInt = $currentCat->category_parent;
    $parent = get_category($parentCatInt);
    if ($parentCatInt !== 0) {
      breadcrumb_item($parent->cat_name, get_category_link($parentCatInt), $position, false);
      $position++;
    }
    breadcrumb_item($currentCat->cat_name, get_category_link($currentCat->cat_ID), $position, false);
    $position++;
    breadcrumb_item(get_the_title(), null, $position, true);
  }

  if (is_page()) {
    breadcrumb_item(get_the_title(), null, $position, true);
  }

  if (is_search()) {
    breadcrumb_item('「'.get_search_query().'」の検索結果', null, $position, true);
  }
  ?>
</ol>
