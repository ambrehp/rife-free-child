<?php

/*
Theme Name: rife-free-child
Theme URI: https://example.com/
description: a child theme of the rife-free theme
Author: John Doe
Author URI: https://example.com.detail-left
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
    wp_enqueue_script('script-theme-enfant', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'ajouter_script_theme_enfant', 27);

/////////

function my_acf_load_value($variable, $field)
{
    // Initialisation de la valeur à retourner
    $return = "";

    // Vérifier si $field est vide ou nul
    if (!empty($field)) {
        // Recherche de la clé
        foreach ($field as $key => $value) {
            if ($key === $variable) {
                $return = $value;
            }
        }
    }

    return $return;
}


/////////

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Définir d'autres tailles d'images : 
// les options de base WP : 
//      'thumbnail': 150 x 150 hard cropped 
//      'medium' : 300 x 300 max height 300px
//      'medium_large' : resolution (768 x 0 infinite height)
//      'large' : 1024 x 1024 max height 1024px
//      'full' : original size uploaded
add_image_size('hero', 1440, 960, true);
add_image_size('desktop-home', 600, 520, true);
add_image_size('lightbox', 1300, 900, true);
