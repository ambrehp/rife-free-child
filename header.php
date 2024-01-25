<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <title>Nathalie Mota, photographe événementiel freelance</title>
    <meta name="description" content="Découvrez mon travail à travers mon porfolio" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>
    <header>
        <nav class="nav">
            <div class="nav-header">
                <div class="nav-logo">
                    <a href="<?php echo esc_url(home_url()); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/images/logo-nathalie-mota.png'" alt="Logo Nathalie MOTA">
                    </a>
                </div>
            </div>
            <div class="nav-btn">
                <div class="burger-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/images/icon-burger-menu.svg'" alt="icon burger menu">
                </div>
                <div class="close-icon">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/images/icon-fermeture.svg'" alt="icon fermeture burger menu">
                </div>
            </div>

            <ul class="nav-list">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'menu desktop',
                        'theme_location' => 'main menu',
                        'menu_id'     => 'primary-menu',
                        'menu_class'     => 'menu',
                    )
                );
                ?>
            </ul>
        </nav>

    </header>