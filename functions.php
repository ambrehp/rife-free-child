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
    //wp_localize_script('custom-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'ajouter_script_theme_enfant', 27);

//////////////////

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

//////////////////
//////////////////

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// permet de définir la taille des images mises en avant 
// set_post_thumbnail_size(largeur, hauteur max, true = on adapte l'image aux dimensions)
set_post_thumbnail_size(600, 0, false);

// Définir d'autres tailles d'images : 
// les options de base WP : 
//      'thumbnail': 150 x 150 hard cropped 
//      'medium' : 300 x 300 max height 300px
//      'medium_large' : resolution (768 x 0 infinite height)
//      'large' : 1024 x 1024 max height 1024px
//      'full' : original size uploaded
add_image_size('hero', 1440, 960, true);
add_image_size('desktop-home', 600, 600, true);
add_image_size('lightbox', 1300, 900, true);


//////////////////
//////////////////

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos()
{

    // Vérification des données
    // vérifier l’existence du jeton de sécurité
    if (
        !isset($_REQUEST['nonce']) or
        !wp_verify_nonce($_REQUEST['nonce'], 'load_more_photos')
    ) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // On vérifie que l'identifiant a bien été envoyé
    if (!isset($_POST['postid'])) {
        wp_send_json_error("L'identifiant de l'article est manquant.", 400);
    }

    // Récupération des données du formulaire
    $post_id = intval($_POST['postid']);

    // Vérifier que l'article est publié, et public
    if (get_post_status($post_id) !== 'publish') {
        wp_send_json_error("Vous n'avez pas accès aux commentaires de cet article.", 403);
    }

    // Utilisez sanitize_text_field() pour les chaines de caractères.
    // exemple : 
    $name = sanitize_text_field($_POST['name']);

    // Requête des commentaires
    $comments = get_comments([
        'post_id' => $post_id,
        'post_type' => 'photo',
        'order' => 'ASC',
        'orderby' => 'date',
        'status' => 'approve'
    ]);

    // Préparer le HTML des commentaires
    $html = wp_list_comments([
        'per_page' => -1,
        'echo' => false,
    ], $comments);

    // Envoyer les données au navigateur
    wp_send_json_success($html);
}

// function load_more_photos()
// {
//     // Vérification du nonce
//     if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'load_more_photos')) {
//         wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
//     }

//     // Vérification de la page envoyée
//     $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
//     $offset = ($page - 1) * 10; // Nombre d'éléments à sauter

//     // Requête pour récupérer les photos mises en avant
//     $args = array(
//         'post_type' => 'photo', // Remplacez 'photo' par le nom de votre custom post type
//         'posts_per_page' => 10,
//         'offset' => $offset,
//         'order' => 'ASC',
//         'orderby' => 'date',
//     );

//     $query = new WP_Query($args);

//     // Préparer le HTML des photos
//     $html = '';
//     if ($query->have_posts()) {
//         while ($query->have_posts()) {
//             $query->the_post();
//             // Récupérer l'image mise en avant
//             $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
//             // Construire votre HTML pour chaque photo
//             $html .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '">';
//         }
//         wp_reset_postdata();
//     }

//     // Renvoyer les données au navigateur au format JSON
//     wp_send_json_success(array('html' => $html));
// }
