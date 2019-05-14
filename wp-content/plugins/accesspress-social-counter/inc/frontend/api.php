<?php

$count = 0;
$apsc_settings = $this -> apsc_settings;
$cache_period = ($apsc_settings[ 'cache_period' ] != '') ? esc_attr( $apsc_settings[ 'cache_period' ] ) * 60 * 60 : 24 * 60 * 60;
switch ( $social_media ) {
     case 'facebook':
          include(SC_PATH . 'inc/frontend/social_network/facebook.php');
          break;
     case 'twitter':
          include(SC_PATH . 'inc/frontend/social_network/twitter.php');
          break;
     case 'googlePlus':
          include(SC_PATH . 'inc/frontend/social_network/googlePlus.php');
          break;
     case 'instagram':
          include(SC_PATH . 'inc/frontend/social_network/instagram.php');
          break;
     case 'youtube':
          include(SC_PATH . 'inc/frontend/social_network/youtube.php');
          break;
     case 'soundcloud':
          include(SC_PATH . 'inc/frontend/social_network/soundcloud.php');
          break;
     case 'dribbble':
          include(SC_PATH . 'inc/frontend/social_network/dribbble.php');
          break;
     case 'posts':
          include(SC_PATH . 'inc/frontend/social_network/posts.php');
          break;
     case 'comments':
          include(SC_PATH . 'inc/frontend/social_network/comments.php');
          break;
     default:
          break;
}
