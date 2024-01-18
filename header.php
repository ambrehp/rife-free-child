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
        <nav id="site-navigation">
            <div class="main-navigation">
                <div class="main-navigation-logo">
                    <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/images/logo-nathalie-mota.png'" alt="Logo Nathalie MOTA"></a>
                </div>
            </div>

            <!-- Menu wp -->
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
            </div>
        </nav>
    </header>