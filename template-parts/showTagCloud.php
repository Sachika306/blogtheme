<?php
$tags = get_tags();
$max = get_theme_mod('tag_cloud_num_control'); 

if ($tags) {
    $tag_counts = array();
    foreach($tags as $tag) {
        $tag_counts[$tag->term_id] = $tag->count;
    }
    arsort($tag_counts); // sort tags by count in descending order

    $count = 0;
    foreach($tag_counts as $tag_id => $count) {
        $tag = get_tag($tag_id);
        echo '<a href="' . get_tag_link($tag->term_id) . '" class="link">' . $tag->name . '</a> ';

        if ($count == $max) {
            return;
        }

        $count++;
    }
}

?>