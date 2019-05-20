<?php

/* Chargement de la feuille du style du theme parent */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles' );
function wpchild_enqueue_styles(){
  wp_enqueue_style( 'wpm-ruby-style', get_template_directory_uri() . '/style.css' );
}

function prefix_category_title( $title ) {
  if ( is_category() ) {
      $title = single_cat_title( '', false );
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );