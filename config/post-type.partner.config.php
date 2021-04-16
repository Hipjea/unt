<?php

/** #############################################################################
 * Ajout Custom type Parner
 * ############################################################################ **/
function partner_init() {
    $labels = [
        'name' =>  'Partenaires',
        'singular_name' => 'Partenaire',
        'add_new' => 'Ajouter un partenaire',
        'add_new_item' => 'Ajouter une fiche partenaire',
        'edit_item' => 'Editer',
        'new_item' => 'Nouveau partenaire',
        'all_items' => 'Partenaires',
        'view_item' => 'Voir fiche partenaire',
        'search_items' => 'Chercher',
        'not_found' => 'Pas de partenaire trouvé',
        'not_found_in_trash' => 'Pas de partenaire trouvé dans la corbeille',
        'parent_item_colon' => '',
        'menu_name' => 'Partenaires'
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
        'rewrite' => ['slug' => 'partenaire'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 7,
        'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI0LjAuMywgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhbHF1ZV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIKCSB2aWV3Qm94PSIwIDAgMTAwMCAxMDAwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxMDAwIDEwMDA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojOUVBM0E4O30KPC9zdHlsZT4KPGc+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNOTg0LjIsNDAzLjdjMCwwLTQ0LjEsMzEuOC02OC43LDQyLjRjLTI0LjYsMTAuNi0zNC40LTguNS0zNC40LTguNUw3NjkuNCwyNjcuOWMtMS44LTkuMSwxNy4yLTE2LjksMTcuMi0xNi45CgkJczM4LjktMzAuOSw2MC4xLTQyLjRjMjEuMi0xMS41LDM0LjQsOC41LDM0LjQsOC41czkwLDE0MSwxMDMuMSwxNjEuMUM5OTcuMywzOTguMyw5ODQuMiw0MDMuNyw5ODQuMiw0MDMuN3ogTTg0Ni43LDQyOS4xCgkJYzAsMCwzLjgsMTMuNi04LjYsMjUuNGMtMTIuNCwxMS44LTYzLjYsNzAuOC02OC43LDc2LjNjMCwwLTkuNSwxNC45LTI1LjgtOC41QzcyNy4zLDQ5OSw1MzkuNSwzMzguMSw1MjguOSwzMzUuOAoJCWMtMTAuNi0yLjMtOS44LTExLjctMzQuNCwwcy0xMjguOSw1OS40LTEyOC45LDU5LjRzLTMxLjIsNS43LTQzLTE3Yy0xMS43LTIyLjcsMi43LTQwLjQsMjUuOC01MC45CgkJYzIzLjEtMTAuNSwxMjAuMy01OS40LDEyMC4zLTU5LjRzNDIuNy0yOC45LDEwMy4xLTI1LjRjNjAuNCwzLjUsMTk3LjYsNTAuOSwxOTcuNiw1MC45TDg0Ni43LDQyOS4xeiBNMjg4LjQsMzY5LjcKCQljMTAsMzguNCw1MS41LDUwLjksNTEuNSw1MC45TDIxOS43LDUyMi40YzAuMywwLTE1LjYsMTAuMi0zNS43LTdjLTE5LTE2LjItNTAuMi00OC45LTUwLjItNjAuOHMxMzIuOC0xNTguNSwxMjAuMy0xNTIuNwoJCWMxNy03LjgsMTAyLjItMTAuNiwxMDMuMSwwQzM1Ny45LDMxMi41LDI4MC43LDM0MC40LDI4OC40LDM2OS43eiBNMTMzLjgsNDI5LjFDMTE1LDQ1NS40LDk5LjQsNDQ2LDk5LjQsNDQ2cy0zNi41LTE1LjYtNjguNy00Mi40CgkJcy0xNy4yLTQyLjQtMTcuMi00Mi40UzkwLDI1Ni4yLDExNi42LDIxN3M1MS41LTI1LjQsNTEuNS0yNS40czUzLjEsNDYuMyw2OC43LDU5LjRjMTUuNywxMy4xLDAsMzMuOSwwLDMzLjkKCQlTMTUyLjYsNDAyLjcsMTMzLjgsNDI5LjF6IE0zMzkuOSw0MzcuNmMwLDAsMjAtMTgsNDMsOC41YzIyLjIsMjUuNiwwLDQyLjQsMCw0Mi40bC0xMDMuMSw5My4zYzAsMC0yNC41LDguNC00My04LjQKCQljLTE4LjQtMTYuOS04LjYtMzMuOS04LjYtMzMuOUwzMzkuOSw0MzcuNnogTTQwMC4xLDQ5Ni45YzAsMCwyMC0xOC4xLDQzLDguNWMyMi4yLDI1LjYsMCw0Mi40LDAsNDIuNEwzMzEuMyw2NDkuNgoJCWMwLDAtMjQuNSw4LjMtNDIuOS04LjVzLTguNi0zMy45LTguNi0zMy45TDQwMC4xLDQ5Ni45eiBNNDM0LjQsNTczLjNjMCwwLDIwLTE4LjEsNDMsOC40YzIyLjIsMjUuNiwwLDQyLjQsMCw0Mi40TDM5MS41LDcwOQoJCWMwLDAtMjQuNSw4LjQtNDMtOC41Yy0xOC40LTE2LjgtOC42LTMzLjktOC42LTMzLjlMNDM0LjQsNTczLjN6IE00NjguOCw2NTguMWMwLDAsMjAtMTgsNDIuOSw4LjVjMjIuMiwyNS42LDAsNDIuNCwwLDQyLjQKCQlsLTYwLjEsNTkuNGMwLDAtMjQuNSw4LjQtNDMtOC41QzM5MC4yLDc0My4xLDQwMCw3MjYsNDAwLDcyNkw0NjguOCw2NTguMXogTTU2My4zLDc3Ni44Yy0zLjUsMjEuNS00MywzMy45LTQzLDMzLjlsLTQyLjktNDIuNAoJCWw1MS41LTU5LjRDNTI4LjksNzA5LDU2Ni44LDc1NS40LDU2My4zLDc3Ni44eiBNNDk0LjUsNjMyLjZjMCwwLDItMy44LDguNi0xN3MtMTQuOC01Ny4zLTM0LjQtNTkuNGMwLDAtMTEtMy44LDAtMTcKCQljMCwwLTE2LjYtNTUuNi02MC4xLTU5LjRjMCwwLTE5LjUtNTYuNi00My01OS40YzAsMCwxMjQtNTguOSwxMjguOS01OS40YzQuOC0wLjUsMTguOC0xMS43LDM0LjQsMGMwLDAsMTYxLjIsMTE2LjUsMTg5LDE2MS4xCgkJczc3LjMsMTE4LjcsNzcuMywxMTguN3MxMC42LDE5LjUtMjUuOCw0Mi40Yy0zNi40LDIyLjktNTEuNS0xNi45LTUxLjUtMTYuOWwtNTEuNS0xMDEuOGMwLDAtMjkuOS01LjUtMTcuMiwxNi45CgkJYzEyLjcsMjIuNSw2OC43LDExOC44LDY4LjcsMTE4LjhzMTEuMywyMS4yLTguNiwzMy45Yy0xOS45LDEyLjctMzMsMTMuNS01MS41LTguNXMtNjAuMS0xMDEuOC02MC4xLTEwMS44cy0yNi42LTE1LjEtMTcuMiw4LjUKCQljOS40LDIzLjYsNjAuMSwxMDEuOCw2MC4xLDEwMS44cy0yLjIsMTAuOS0yNS44LDI1LjRjLTIzLjYsMTQuNi0zNC40LTguNS0zNC40LTguNXMtNTkuNS05NC40LTY4LjctMTAxLjgKCQlDNTAyLjYsNjQyLjEsNDk0LjUsNjMyLjYsNDk0LjUsNjMyLjZ6Ii8+CjwvZz4KPC9zdmc+Cg==',
        'supports' => ['title']
    ];

    register_post_type('partner', $args);
}

add_action('init', 'partner_init');
