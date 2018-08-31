<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

if ( !class_exists('Redux') )
    return;

$opt_name = "REDUX";

$theme = wp_get_theme();

$args = [
    'show_options_object' => false,
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => 'Net.Com Configuration',
    // Name that appears at the top of your panel
    'display_version'      => '1.0',
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Net.Com Configuration', 'net-com-config' ),
    'page_title'           => __( 'Net.Com Configuration', 'net-com-config' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-tools',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => false,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
];

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
    'id'    => 'contact-net-com',
    'href'  => 'https://www.net-com.fr/',
    'title' => __( 'Contactez Net.Com', 'contact-net-com' ),
);

/*$args['admin_bar_links'][] = array(
    'id'    => 'redux-docs',
    'href'  => 'http://docs.reduxframework.com/',
    'title' => __( 'Documentation', 'redux-framework-demo' ),
);

$args['admin_bar_links'][] = array(
    //'id'    => 'redux-support',
    'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
    'title' => __( 'Support', 'redux-framework-demo' ),
);

$args['admin_bar_links'][] = array(
    'id'    => 'redux-extensions',
    'href'  => 'reduxframework.com/extensions',
    'title' => __( 'Extensions', 'redux-framework-demo' ),
);*/

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
/*$args['share_icons'][] = array(
    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
    'title' => 'Visit us on GitHub',
    'icon'  => 'el el-github'
    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
);
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/reduxframework',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el el-twitter'
);
$args['share_icons'][] = array(
    'url'   => 'http://www.linkedin.com/company/redux-framework',
    'title' => 'Find us on LinkedIn',
    'icon'  => 'el el-linkedin'
);*/

// Panel Intro text -> before the form
$args['intro_text'] = "Une option vous manque ? Envoyez nous votre message à <a href='mailto:contact@net-com.fr'>contact@net-com.fr</a>";
// Add content after the form.
$args['footer_text'] = "Conçu pour vous par <a href='https://www.net-com.fr'>Net.Com</a>.";

Redux::setArgs($opt_name, $args);

Redux::setSection($opt_name, array(
    'title'            => "Général",
    'id'               => 'general',
    'desc'             => "Personnalisez votre site",
    'customizer_width' => '400px',
    'icon'             => 'el el-cogs'
));

Redux::setSection($opt_name, array(
    'title'            => "Images",
    'id'               => 'general-images',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'logo_loader',
            'type'     => 'media',
            'title'    => "Logo du loader",
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => "Header",
    'id'               => 'general-header',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'logo_header',
            'type'     => 'media',
            'title'    => "Logo",
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'            => "Réseaux sociaux",
    'id'               => 'general-rs',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'social_facebook',
            'type'     => 'text',
            'title'    => "Facebook",
            'subtitle' => "Adresse web de votre page Facebook pour lien dans le surheader et footer",
            'validate' => 'url'
        ),
        array(
            'id'       => 'social_twitter',
            'type'     => 'text',
            'title'    => "Twitter",
            'subtitle' => "Adresse web de votre page Twitter pour lien dans le surheader et footer",
            'validate' => 'url'
        ),
        array(
            'id'       => 'social_google',
            'type'     => 'text',
            'title'    => "YouTube",
            'subtitle' => "Adresse web de votre page YouTube pour lien dans le surheader et footer",
            'validate' => 'url'
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'            => "Footer",
    'id'               => 'general-footer',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'logo_footer',
            'type'     => 'media',
            'title'    => "Logo du footer",
        ),
    )
));

add_action( 'redux/loaded', 'remove_demo' );

if ( !function_exists( 'remove_demo' ) )
{
    function remove_demo()
    {
        if ( class_exists('ReduxFrameworkPlugin') )
        {
            remove_filter('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
