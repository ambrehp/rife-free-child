<?php

/*
Theme Name: rife-free-child
Theme URI: https://example.com/
description: a child theme of the rife-free theme
Author: John Doe
Author URI: https://example.com
Template: rife-free
Version: 1.0
*/


// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
// Load the stylesheet
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    //  Chargement du style personnalisé pour le theme
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
    wp_enqueue_style('mediaqueries-style', get_stylesheet_directory_uri() . '/css/mediaqueries.css', array(), filemtime(get_stylesheet_directory() . '/css/mediaqueries.css'));
}


/******* EMPLACEMENT MENU WP *******/
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('menu desktop'),
            'footer-menu'  => __('menu footer'),
        )
    );
}
add_action('init', 'register_my_menus');



// import script.js
function ajouter_script_theme_enfant()
{
    wp_enqueue_script('script-theme-enfant', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'ajouter_script_theme_enfant', 27);


////
add_action('init', function () {
    register_taxonomy('categorie-photo', array(
        0 => 'info_photo',
    ), array(
        'labels' => array(
            'name' => 'categories',
            'singular_name' => 'categorie',
            'menu_name' => 'catégorie',
            'all_items' => 'Tout les catégorie',
            'edit_item' => 'Modifier catégorie',
            'view_item' => 'Voir catégorie',
            'update_item' => 'Mettre à jour catégorie',
            'add_new_item' => 'Ajouter catégorie',
            'new_item_name' => 'Nom du nouveau catégorie',
            'search_items' => 'Rechercher catégorie',
            'popular_items' => 'catégorie populaire',
            'separate_items_with_commas' => 'Séparer les catégorie avec une virgule',
            'add_or_remove_items' => 'Ajouter ou retirer catégorie',
            'choose_from_most_used' => 'Choisir parmi les catégorie les plus utilisés',
            'not_found' => 'Aucun catégorie trouvé',
            'no_terms' => 'Aucun catégorie',
            'items_list_navigation' => 'Navigation dans la liste catégorie',
            'items_list' => 'Liste catégorie',
            'back_to_items' => '← Aller à « catégorie »',
            'item_link' => 'Lien catégorie',
            'item_link_description' => 'Un lien vers un catégorie',
        ),
        'public' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));

    register_taxonomy('format-photo', array(
        0 => 'info_photo',
    ), array(
        'labels' => array(
            'name' => 'formats',
            'singular_name' => 'format',
            'menu_name' => 'formats',
            'all_items' => 'Tout les formats',
            'edit_item' => 'Modifier format',
            'view_item' => 'Voir format',
            'update_item' => 'Mettre à jour format',
            'add_new_item' => 'Ajouter format',
            'new_item_name' => 'Nom du nouveau format',
            'search_items' => 'Rechercher formats',
            'popular_items' => 'formats populaire',
            'separate_items_with_commas' => 'Séparer les formats avec une virgule',
            'add_or_remove_items' => 'Ajouter ou retirer formats',
            'choose_from_most_used' => 'Choisir parmi les formats les plus utilisés',
            'not_found' => 'Aucun formats trouvé',
            'no_terms' => 'Aucun formats',
            'items_list_navigation' => 'Navigation dans la liste formats',
            'items_list' => 'Liste formats',
            'back_to_items' => '← Aller à « formats »',
            'item_link' => 'Lien format',
            'item_link_description' => 'Un lien vers un format',
        ),
        'public' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
    ));
});

add_action('init', function () {
    register_post_type('info_photo', array(
        'labels' => array(
            'name' => 'info photos',
            'singular_name' => 'Info photo',
            'menu_name' => 'Info photos',
            'all_items' => 'Tout les photos',
            'edit_item' => 'Modifier photo',
            'view_item' => 'Voir photo',
            'view_items' => 'Voir photos',
            'add_new_item' => 'Ajouter photo',
            'add_new' => 'Ajouter photo',
            'new_item' => 'Nouveau photo',
            'parent_item_colon' => 'photo parent :',
            'search_items' => 'Rechercher photos',
            'not_found' => 'Aucun photos trouvé',
            'not_found_in_trash' => 'No photos found in Trash',
            'archives' => 'Archives des photo',
            'attributes' => 'Attributs des photo',
            'insert_into_item' => 'Insérer dans photo',
            'uploaded_to_this_item' => 'Téléversé sur ce photo',
            'filter_items_list' => 'Filtrer la liste photos',
            'filter_by_date' => 'Filtrer photos par date',
            'items_list_navigation' => 'Navigation dans la liste photos',
            'items_list' => 'Liste photos',
            'item_published' => 'photo publié.',
            'item_published_privately' => 'photo publié en privé.',
            'item_reverted_to_draft' => 'photo repassé en brouillon.',
            'item_scheduled' => 'photo planifié.',
            'item_updated' => 'photo mis à jour.',
            'item_link' => 'Lien photo',
            'item_link_description' => 'Un lien vers un photo.',
        ),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-format-image',
        'supports' => array(
            0 => 'title',
            1 => 'editor',
            2 => 'revisions',
            3 => 'page-attributes',
            4 => 'thumbnail',
            5 => 'custom-fields',
            6 => 'post-formats',
        ),
        'taxonomies' => array(
            0 => 'categorie-photo',
            1 => 'format-photo',
        ),
        'delete_with_user' => false,
    ));
});
