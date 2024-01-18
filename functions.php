<?php

/*
Theme Name: motaphoto-child
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
