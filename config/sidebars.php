<?php 

/**
 * Creates a sidebar
 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
 */

$args = array(
	'name'          => __( 'Sidebar name', 'theme_text_domain' ),
	'id'            => 'unique-sidebar-id',
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1" class="widget %2">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);

register_sidebar( $args );
