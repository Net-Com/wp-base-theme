<?php

## Init theme env

require_once get_stylesheet_directory() . '/base/init.php';

## Load controllers

$dir  = get_stylesheet_directory() . "/src/controllers/";
$root = scandir($dir);

foreach ( $root as $value ) 
{
    if ( strtolower(substr($value, -4)) == '.php' )
    {
        require($dir . $value);
    }
}

## Load Redux configuration file

require_once(dirname(__FILE__) . '/config/redux.php');

## Include CSS and JS files

add_action('wp', 'nc_enqueue');

function nc_enqueue()
{
    wp_enqueue_style('css-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('css-nc', get_stylesheet_directory_uri() . '/css/styles.css');

    wp_enqueue_script('js-jquery', get_stylesheet_directory_uri() . '/js/jquery-3.3.1.min.js');
    wp_enqueue_script('js-bootstrap-bundle', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script('js-bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script('js-tarteaucitron', get_stylesheet_directory_uri() . '/js/tarteaucitron.js');
    wp_enqueue_script('js-nc', get_stylesheet_directory_uri() . '/js/app.js');

    wp_deregister_script('jquery');
}

## Add image sizes

//add_image_size('featured-image', 720, 400, TRUE);

## Pods meta groups (Tabify Edit Screen)

/*
add_action('pods_meta_groups', 'nc_metaboxes', 10, 2);

function nc_metaboxes($type, $name)
{
    pods_group_add('books', 'Book Information', 'preface,isbn');
} 
*/

## ProfilePress translations

/*
add_filter('gettext', 'pp_string_translation', 10, 3);

function pp_string_translation($translations, $text, $domain)
{
    if ( $domain == 'profilepress' )
    {
        switch ( $text )
        {
            case 'Email address is not valid':
                $translations = 'Adresse mail non valide.';
                break;
        }
    }

    if ( $domain == 'default' )
    {
        switch ( $text )
        {
            case '<strong>ERROR</strong>: Invalid username or e-mail.':
                $translations = '<strong>ERREUR</strong> : Pseudonyme ou adresse mail non valide.';
                break;

            case '<strong>ERROR</strong>: Enter a username or e-mail address.':
                $translations = '<strong>ERREUR</strong> : Veuillez entrer un pseudonyme ou une adresse mail.';
                break;

            case 'Someone requested that the password be reset for the following account:':
                $translations = 'Vous avez demandé à changer les identifiants du compte suivant :';
                break;
        }
    }

    return $translations;
}
*/
