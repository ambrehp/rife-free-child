<?php

/**
 * Hero du header
 *
 * @package WordPress
 * @subpackage rife-free-child theme
 */
?>
<?php get_header(); ?>

<!-- Wrap Slider Area -->
<div class="hero-container">
    <div class="hero-photo">
        <!-- Initialisation de post à afficher -->
        <?php
        $custom_args = array(
            'post_type' => 'photo',
            'orderby'   => 'rand',
            'posts_per_page' => 1,
        );
        //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
        $random_hero = new WP_Query($custom_args);
        ?>
        <!-- Récupération d'un post photo en mode aléatoire (rand) -->
        <?php while ($random_hero->have_posts()) : ?>
            <?php $random_hero->the_post(); ?>

            <?php
            $image_id = get_field('image', $post->ID);
            if ($image_id) {
                echo '<img src="' . esc_url(wp_get_attachment_image_url($image_id, 'hero')) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) . '">';
            }
            ?>

        <?php endwhile; ?>
        <h1 class="hero-title">Photographe Event</h1>
    </div>
</div>
<?php
// On réinitialise à la requête principale
wp_reset_postdata();
?>
<?php get_footer(); ?>