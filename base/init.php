<?php 

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'NC CHILD THEME' );
define( 'CHILD_THEME_URL', 'http://www.net-com.fr/' );
define( 'CHILD_THEME_VERSION', '0.0.1' );

// assets class for add css and js
require_once get_stylesheet_directory().'/base/class/assets.php';

// tpl renderer
require_once get_stylesheet_directory().'/base/tpl_render.php';

// include all config files
foreach(glob(get_stylesheet_directory().'/config/*.php') as $file) {
    require_once $file;
}

// include all widgets files
foreach(glob(get_stylesheet_directory().'/widgets/*.php') as $file) {
    
    require_once $file;
    add_action( 'widgets_init', function(){
    	global $file;
    	if (class_exists(basename($file, ".php"))) {
    		register_widget( basename($file, ".php") );
    	}
	});
}

// include all shortcodes files
foreach(glob(get_stylesheet_directory().'/shortcodes/*.php') as $file) {
    require_once $file;

    if (function_exists(basename($file, ".php"))) {
    	add_shortcode(str_replace('_shortcode','',basename($file, ".php")), basename($file, ".php"));
    }
}

// actions and filters
require_once get_stylesheet_directory().'/base/hooks.php';

update_option( 'default_ping_status', 'closed' );


// init assets class
$assets = new Assets();

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );
