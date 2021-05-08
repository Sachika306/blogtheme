   <?php wp_nav_menu( array(
        'theme_location'=>'global', 
        'container'     =>'<nav>', 
        'menu_class'    =>'header-nav',
        'depth' => 0,
        'items_wrap'    =>'<ul class="parentMenu">%3$s</ul>',
        'walker'  => new custom_walker_nav_menu));
    ?>
