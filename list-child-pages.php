<?php
/*
	Plugin Name: Stephanie's Tiny List Child Pages Plugin
	Plugin URI: http://stephanieleary.com/2010/06/listing-child-pages-with-a-shortcode/
	Description: Lets you list child pages using a shortcode. Also displays child page list by default on empty parent pages.
	Author: Stephanie Leary
	Version: 1.1
	Author URI: http://stephanieleary.com/
	License: GPL v2 or later
*/ 

function scl_child_pages_shortcode() {
   return '<ul class="childpages">'.wp_list_pages( 'echo=0&depth=1&title_li=&child_of='. get_the_ID() ).'</ul>';
}
add_shortcode( 'child-pages', 'scl_child_pages_shortcode' );
add_shortcode( 'subpages', 'scl_child_pages_shortcode' );

function scl_append_child_pages( $content ) {
   if ( is_page() && ( empty( $content ) ) )
      $content = '<ul class="childpages">'.wp_list_pages( 'echo=0&title_li=&child_of='. get_the_ID() ).'</ul>';

   return $content;
}
add_filter( 'the_content','scl_append_child_pages' );