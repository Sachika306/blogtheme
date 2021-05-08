<?php wp_nav_menu( array(
    'theme_location'=>'footerRight', 
    'container'     =>'',
    'menu_class'    => '',
    'depth' => 0,
    'items_wrap'    =>'<ul>%3$s</ul>',
    'walker'  => new custom_walker_nav_menu));
?>
