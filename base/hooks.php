<?php 
require_once get_stylesheet_directory().'/base/Plugin-Activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

    $plugins = array(

        array(
            'name'               => 'NC Templates Render', // The plugin name.
            'slug'               => 'nc_tpl_render', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/base/Plugin-Activation/plugins/nc_tpl_render.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'is_callable'        => 'render'
        )
    );

    $config = array(
        'id'           => 'nc_notice',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'nc-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

}

add_action( 'widgets_init','register_nc_widget');

function register_nc_widget()
{
    foreach(glob(get_stylesheet_directory().'/widgets/*.php') as $nc_widget_file) {
        
        require_once $nc_widget_file;

        if (class_exists(basename($nc_widget_file, ".php"))) {
            register_widget( basename($nc_widget_file, ".php") );
        }
    }
}

// include all config files
foreach(glob(get_stylesheet_directory().'/config/*.php') as $file) {
    require_once $file;
}

// include all shortcodes files
foreach(glob(get_stylesheet_directory().'/shortcodes/*.php') as $file) {
    require_once $file;

    if (function_exists(basename($file, ".php"))) {
        add_shortcode(str_replace('_shortcode','',basename($file, ".php")), basename($file, ".php"));
    }
}

add_action( 'genesis_setup', 'bsg_load_lib_files', 15 );
function bsg_load_lib_files() {
    foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) { require_once $file; }
}

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
// add js to wordpress
add_action( 'wp_enqueue_scripts', 'nc_enqueue_scripts' );
function nc_enqueue_scripts() {

	global $assets;

	$scripts = $assets->getScripts();

	if ($scripts) {
		foreach ($scripts as $name => $url) {
			wp_enqueue_script( $name, get_stylesheet_directory_uri() . '/' .$url, array('jquery'), CHILD_THEME_VERSION, true );
		}
	}
}

// add css to wordpress
add_action( 'wp_enqueue_scripts', 'nc_enqueue_styles' );
function nc_enqueue_styles() {

	global $assets;

	$scripts = $assets->getStyles();

	if ($scripts) {
		foreach ($scripts as $name => $url) {
			wp_enqueue_style( $name, get_stylesheet_directory_uri() . '/' .$url, array(), CHILD_THEME_VERSION );
		}
	}
}

add_action( 'init', 'disable_wp_emojicons' );
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}

add_filter( 'emoji_svg_url', '__return_false' );

function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, $home ) )
			unset($links[$l]);
}

add_action( 'pre_ping', 'no_self_ping' );

add_filter( 'xmlrpc_methods', 'nc_block_xmlrpc_attacks' );

function nc_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}

add_filter( 'wp_headers', 'nc_remove_x_pingback_header' );

function nc_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'feed_links', 2 ); //removes feed links.
remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'pingback_link');

add_filter( 'http_request_args', 'gs_prevent_theme_update', 5, 2 );
/**
 * Don't update theme from .org repo.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update. Future proofs themes.
 *
 * @since 1.1.0
 *
 * @author Mark Jaquith
 * @link   http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 */
function gs_prevent_theme_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}