<?php
/**
 * Contains version number of the application.
 * The application is based on
 *      + WP theme
 *      + WP Plugins
 */

$version = [
    "major_structure_update" => 0,
    "feature_batch" => 1,
    "bugfix_batch" => 0,
];

// Global version of the theme
define('UNT_APP_VERSION', 'v' . join('.', $version));

// Server document
define('SERVER_DOCUMENTS', 'http://ssl.sword-group.com/front-wordpress-document/document/');
define('SERVER_SUPLOM', 'http://ssl.sword-group.com/front-wordpress-document/');

// Liste des menus dans le footer
register_nav_menus( array(
    'header' => __('Header', 'unt'),
    'footer' => __( 'Footer', 'unt' )
) );