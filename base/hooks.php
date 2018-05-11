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
        ),
        array(
            'name'               => 'Exemple plugin', // The plugin name.
            'slug'               => 'exemple_plugins', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/base/Plugin-Activation/plugins/exemple_plugins.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'is_callable'        => false
        )
    );

    $config = array(
        'id'           => 'nc_child_theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'nc-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
          'page_title'                      => __( 'Install Required Plugins', 'nc_child_theme' ),
          'menu_title'                      => __( 'Install Plugins', 'nc_child_theme' ),
          'installing'                      => __( 'Installing Plugin: %s', 'nc_child_theme' ),
          'updating'                        => __( 'Updating Plugin: %s', 'nc_child_theme' ),
          'oops'                            => __( 'Something went wrong with the plugin API.', 'nc_child_theme' ),
          'notice_can_install_required'     => _n_noop(
            'This theme requires the following plugin: %1$s.',
            'This theme requires the following plugins: %1$s.',
            'nc_child_theme'
          ),
          'notice_can_install_recommended'  => _n_noop(
            'This theme recommends the following plugin: %1$s.',
            'This theme recommends the following plugins: %1$s.',
            'nc_child_theme'
          ),
          'notice_ask_to_update'            => _n_noop(
            'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
            'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
            'nc_child_theme'
          ),
          'notice_ask_to_update_maybe'      => _n_noop(
            /* translators: 1: plugin name(s). */
            'There is an update available for: %1$s.',
            'There are updates available for the following plugins: %1$s.',
            'nc_child_theme'
          ),
          'notice_can_activate_required'    => _n_noop(
            /* translators: 1: plugin name(s). */
            'The following required plugin is currently inactive: %1$s.',
            'The following required plugins are currently inactive: %1$s.',
            'nc_child_theme'
          ),
          'notice_can_activate_recommended' => _n_noop(
            /* translators: 1: plugin name(s). */
            'The following recommended plugin is currently inactive: %1$s.',
            'The following recommended plugins are currently inactive: %1$s.',
            'nc_child_theme'
          ),
          'install_link'                    => _n_noop(
            'Begin installing plugin',
            'Begin installing plugins',
            'nc_child_theme'
          ),
          'update_link'             => _n_noop(
            'Begin updating plugin',
            'Begin updating plugins',
            'nc_child_theme'
          ),
          'activate_link'                   => _n_noop(
            'Begin activating plugin',
            'Begin activating plugins',
            'nc_child_theme'
          ),
          'return'                          => __( 'Return to Required Plugins Installer', 'nc_child_theme' ),
          'plugin_activated'                => __( 'Plugin activated successfully.', 'nc_child_theme' ),
          'activated_successfully'          => __( 'The following plugin was activated successfully:', 'nc_child_theme' ),
          /* translators: 1: plugin name. */
          'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'nc_child_theme' ),
          /* translators: 1: plugin name. */
          'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'nc_child_theme' ),
          /* translators: 1: dashboard link. */
          'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'nc_child_theme' ),
          'dismiss'                         => __( 'Dismiss this notice', 'nc_child_theme' ),
          'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'nc_child_theme' ),
          'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'nc_child_theme' ),

          'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
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
    }elseif (class_exists(basename($file, ".php"))) {
      $className = basename($file, ".php");
      New $className();
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

//on enleve le author + date création
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
//on enleve le bouton edit sur backoofice
add_filter ( 'genesis_edit_post_link' , '__return_false' );

add_filter( 'genesis_attr_archive-pagination' , 'nc_pagination');

function nc_pagination($attrs)
{
  $attrs['class'] .= ' test';
  d($attrs);
  return $attrs;
}