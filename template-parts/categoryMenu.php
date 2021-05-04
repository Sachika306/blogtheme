<ul>
    <?php $categories = get_categories();
        foreach ($categories as $category) {
            echo '<li>'.'<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>'.'</li>';
        }
    ?>
</ul>