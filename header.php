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
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-logo">
                    <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/images/logo-nathalie-mota.png'" alt="Logo Nathalie MOTA"></a>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check" class="burger-icon">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </label>
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