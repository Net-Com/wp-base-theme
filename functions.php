<?php
// init genesis
require_once( get_template_directory() . '/lib/init.php' );

// init theme env
require_once get_stylesheet_directory().'/base/init.php';

// add css in wp-head
$assets->addStyle('debug/htmllint.css');
$assets->addStyle('css/main.css');

// add js in bottom of body
$assets->addScript('js/main.js');

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );
