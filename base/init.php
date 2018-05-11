<?php 

// child theme (do not remove)
define( 'CHILD_THEME_NAME', 'NC CHILD THEME' );
define( 'CHILD_THEME_URL', 'http://www.net-com.fr/' );
define( 'CHILD_THEME_VERSION', '0.0.1' );

// actions and filters
require_once get_stylesheet_directory().'/base/hooks.php';
// assets class for add css and js
require_once get_stylesheet_directory().'/base/class/assets.php';
// remove comments system
require_once get_stylesheet_directory().'/base/class/remove-comment.php';
/*multi colums gravityforms*/
require_once get_stylesheet_directory().'/base/class/gravityforms-bootstrap.php';
// generate theme options
require_once get_stylesheet_directory().'/base/customize.php';

update_option( 'default_ping_status', 'closed' );

// init assets class
$assets = new Assets();

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );
