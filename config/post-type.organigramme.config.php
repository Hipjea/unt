<?php

/** #############################################################################
 * Ajout Custom type Organigramme
 * ############################################################################ **/
function organigramme_init() {
    $labels = [
        'name' =>  'Organigrammes',
        'singular_name' => 'Organigramme',
        'add_new' => 'Ajouter un collaborateur',
        'add_new_item' => 'Ajouter une fiche collaborateur',
        'edit_item' => 'Editer',
        'new_item' => 'Nouvel organigramme',
        'all_items' => 'Organigrammes',
        'view_item' => 'Voir fiche organigramme',
        'search_items' => 'Chercher',
        'not_found' => 'Pas d\'organigramme trouvé',
        'not_found_in_trash' => 'Pas d\'organigramme trouvé dans la corbeille',
        'parent_item_colon' => '',
        'menu_name' => 'Organigrammes'
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
        'rewrite' => ['slug' => 'Organigramme'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 7,
        'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjEuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIKCSBpZD0ic3ZnMTIiIGlua3NjYXBlOnZlcnNpb249IjAuOTIuMiA1YzNlODBkLCAyMDE3LTA4LTA2IiBzb2RpcG9kaTpkb2NuYW1lPSJub3VuXzEwNDk1MTNfY2Muc3ZnIiB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOmlua3NjYXBlPSJodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy9uYW1lc3BhY2VzL2lua3NjYXBlIiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiIHhtbG5zOnNvZGlwb2RpPSJodHRwOi8vc29kaXBvZGkuc291cmNlZm9yZ2UubmV0L0RURC9zb2RpcG9kaS0wLmR0ZCIgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKCSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYyLjkgNzAuOSIKCSBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2Mi45IDcwLjk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHNvZGlwb2RpOm5hbWVkdmlldyAgYm9yZGVyY29sb3I9IiM2NjY2NjYiIGJvcmRlcm9wYWNpdHk9IjEiIGZpdC1tYXJnaW4tYm90dG9tPSIxMCIgZml0LW1hcmdpbi1sZWZ0PSIxMCIgZml0LW1hcmdpbi1yaWdodD0iMTAiIGZpdC1tYXJnaW4tdG9wPSIxMCIgZ3JpZHRvbGVyYW5jZT0iMTAiIGd1aWRldG9sZXJhbmNlPSIxMCIgaWQ9Im5hbWVkdmlldzE0IiBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJzdmcxMiIgaW5rc2NhcGU6Y3g9IjQwLjQ1NCIgaW5rc2NhcGU6Y3k9IjMzLjI0IiBpbmtzY2FwZTpwYWdlb3BhY2l0eT0iMCIgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iNDgwIiBpbmtzY2FwZTp3aW5kb3ctbWF4aW1pemVkPSIwIiBpbmtzY2FwZTp3aW5kb3ctd2lkdGg9IjY0MCIgaW5rc2NhcGU6d2luZG93LXg9IjAiIGlua3NjYXBlOndpbmRvdy15PSIwIiBpbmtzY2FwZTp6b29tPSIxLjg4OCIgb2JqZWN0dG9sZXJhbmNlPSIxMCIgcGFnZWNvbG9yPSIjZmZmZmZmIiBzaG93Z3JpZD0iZmFsc2UiPgoJPC9zb2RpcG9kaTpuYW1lZHZpZXc+CjxnIGlkPSJnNiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTkuNTQ2LC00Ljg0OSkiPgoJPGcgaWQ9Imc0Ij4KCQk8cGF0aCBpZD0icGF0aDIiIGlua3NjYXBlOmNvbm5lY3Rvci1jdXJ2YXR1cmU9IjAiIGQ9Ik02OC40LDUyLjdINjJ2LThjMC0yLjItMS44LTQtNC00SDQyLjFWMjcuOGg2LjVjMi4yLDAsNC0xLjgsNC00di0xNQoJCQljMC0yLjItMS44LTQtNC00aC0xNWMtMi4yLDAtNCwxLjgtNCw0djE1YzAsMi4yLDEuOCw0LDQsNGg2LjV2MTIuOUgyNC4xYy0yLjIsMC00LDEuOC00LDR2OGgtNi42Yy0yLjIsMC00LDEuOC00LDR2MTUKCQkJYzAsMi4yLDEuOCw0LDQsNGgxNWMyLjIsMCw0LTEuOCw0LTR2LTE1YzAtMi4yLTEuOC00LTQtNGgtNi40di04YzAtMS4xLDAuOS0yLDItMkg1OGMxLjEsMCwyLDAuOSwyLDJ2OGgtNi42Yy0yLjIsMC00LDEuOC00LDR2MTUKCQkJYzAsMi4yLDEuOCw0LDQsNGgxNWMyLjIsMCw0LTEuOCw0LTR2LTE1QzcyLjQsNTQuNSw3MC42LDUyLjcsNjguNCw1Mi43eiBNMzEuNiwyMy44di0xNWMwLTEuMSwwLjktMiwyLTJoMTVjMS4xLDAsMiwwLjksMiwydjE1CgkJCWMwLDEuMS0wLjksMi0yLDJoLTE1QzMyLjUsMjUuOCwzMS42LDI0LjksMzEuNiwyMy44eiBNMzAuNSw1Ni44djE1YzAsMS4xLTAuOSwyLTIsMmgtMTVjLTEuMSwwLTItMC45LTItMnYtMTVjMC0xLjEsMC45LTIsMi0yaDE1CgkJCUMyOS42LDU0LjcsMzAuNSw1NS42LDMwLjUsNTYuOHogTTcwLjQsNzEuN2MwLDEuMS0wLjksMi0yLDJoLTE1Yy0xLjEsMC0yLTAuOS0yLTJ2LTE1YzAtMS4xLDAuOS0yLDItMmgxNWMxLjEsMCwyLDAuOSwyLDJWNzEuN3oiCgkJCS8+Cgk8L2c+CjwvZz4KPC9zdmc+Cg==',
        'supports' => ['title']
    ];

    register_post_type('organigramme', $args);
}

add_action('init', 'organigramme_init');
