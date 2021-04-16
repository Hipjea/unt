<?php

/** #############################################################################
 * Ajout Custom types NOTICETest
 * ############################################################################ **/
function aLaUne_init() {
    $labels = [
        'name' =>  'A la une',
        'singular_name' => 'aLaUne',
        'add_new' => 'Ajouter une carte à la une',
        'add_new_item' => 'Ajouter une carte à la une',
        'edit_item' => 'Editer',
        'new_item' => 'Nouvelle carte à la une',
        'all_items' => 'A la une',
        'view_item' => 'Voir carte à la une',
        'search_items' => 'Chercher',
        'not_found' => 'Pas de carte à la une trouvée',
        'not_found_in_trash' => 'Pas de carte à la une trouvée dans la corbeille',
        'parent_item_colon' => '',
        'menu_name' => 'A la une'
    ];


    $args = [
        'can_export' => true,
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'aLaUne'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => ['title']
    ];

    register_post_type('aLaUne', $args);
}

add_action('init', 'aLaUne_init');
