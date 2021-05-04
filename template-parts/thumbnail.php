<?php the_post_thumbnail('post-thumbnail', array(
    //サムネイル画像に属性を付与
    'itemprop' => 'thumbnailUrl', 
    'alt' => get_the_title()
)); ?>