<?php
/*
Plugin Name: Stephanie's Tiny List Child Pages Plugin
Plugin URI: http://stephanieleary.com/2010/06/listing-child-pages-with-a-shortcode/
GitHub Plugin URI: https://github.com/sillybean/tiny-list-child-pages
GitHub Branch: master
Description: Lets you list child pages using a shortcode. Also displays child page list by default on empty parent pages.
Author: Stephanie Leary
Version: 1.2
Author URI: http://stephanieleary.com/
License: GPL v2 or later
*/ 

function scl_child_pages_shortcode() {
   return scl_append_child_pages('');
}
add_shortcode( 'child-pages', 'scl_child_pages_shortcode' );
add_shortcode( 'subpages', 'scl_child_pages_shortcode' );

function scl_append_child_pages( $content ) {
   $type = get_post_type();
   if ( is_post_type_hierarchical( $type )  && empty( $content ) ) {
      $args = array(
      	'echo' => 0,
      	'depth' => 1,
      	'title_li' => '',
      	'child_of' => get_the_ID(),
      	'post_type' => $type
      );
      $content .= '<ul class="childpages">' . wp_list_pages( $args ) . '</ul>';
   }
   
   return $content;
}
add_filter( 'the_content', 'scl_append_child_pages' );