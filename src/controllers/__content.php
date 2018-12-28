<?php

add_action('wp', 'nc_content');

function nc_content()
{
    remove_action('genesis_before', 'genesis_do_nav');

    remove_action('genesis_header', 'genesis_header_markup_open', 5);
    remove_action('genesis_header', 'genesis_do_header');
    remove_action('genesis_header', 'genesis_header_markup_close', 15);

    remove_action('genesis_entry_header', 'genesis_do_post_title');
    remove_action('genesis_entry_header', 'genesis_post_info', 12);

    remove_action('genesis_entry_content', 'genesis_do_post_content');

    remove_action('genesis_after_content', 'genesis_get_sidebar');
    remove_action('genesis_after_content', 'genesis_get_sidebar_alt');
    remove_action('genesis_sidebar', 'genesis_do_sidebar');

    remove_action('genesis_entry_footer', 'genesis_post_meta');

    remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
    remove_action('genesis_footer', 'genesis_do_footer');
    remove_action('genesis_footer', 'genesis_footer_markup_open', 15);

    if ( is_home() || is_front_page() )
    {
        remove_action('genesis_before_content', 'PGM_genesis_breadcrumb', 50);
        remove_all_actions('genesis_sidebar');
    }

    add_filter('genesis_markup_site-inner', '__return_null');
    add_filter('genesis_markup_content-sidebar-wrap', '__return_null');
    add_filter('genesis_markup_content', '__return_null');
}
