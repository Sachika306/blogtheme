<?php
  // アクセス数の集計
  if( !is_user_logged_in() && !is_bot() ) { 
    set_post_views( get_the_ID() ); 
  } 
?>