<?php

/**
 * Hero header
 *
 * @package WordPress
 * @subpackage rife-free-child theme
 */
?>

<!-- Wrap Slider Area -->
<div class="hero-container">
    <div class="hero-photo">
        <!-- Initialisation de post à afficher -->
        <?php
        $custom_args = array(
            'post_type' => 'image',
            'orderby'   => 'rand',
            'posts_per_page' => 1,
        );

        //On crée ensuite une requête WP_Query basée sur les critères placés dans la variables $args
        $random_query = new WP_Query($custom_args);

        // Récupération d'une photo en mode aléatoire (rand)
        if ($random_query->have_posts()) : while ($random_query->have_posts()) : $random_query->the_post();
                $photo_hero = get_field('image');

                if (is_array($photo_hero) && count($photo_hero) > 0) {
                    $random_index = array_rand($photo_hero);
                    $random_image_url = $photo_hero[$random_index];
                    echo '<img class="img-hero" src="' . esc_url($photo_hero['url']) . '" alt="Image aléatoire">';
                    echo '<h1>Photographe Event</h1>'; // placée dans la boucle, pour être répétée à chaque fois
                } else {
                    echo 'Aucune image trouvée.';
                }
            endwhile;

        endif;
        ?>
    </div>
</div>
<?php
// On réinitialise à la requête principale
wp_reset_postdata();
?>