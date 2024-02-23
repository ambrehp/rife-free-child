<?php

/**
 * Hero du header
 *
 * @package WordPress
 * @subpackage rife-free-child theme
 */
?>
<?php get_header(); ?>

<!-- Intégration du random hero -->
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

<!-- Intégration liste photo -->
<div class="photo-grid flexrow">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 16,
        'order' => 'ASC',
        'orderby' => 'date',
    );

    $query_grid = new WP_Query($args);

    if ($query_grid->have_posts()) {
        $count = 0;
        while ($query_grid->have_posts()) {
            $query_grid->the_post();
            $count++;
    ?>

            <!-- Affiche les photos dynamiquement -->
            <?php get_template_part('templates/photo-block'); ?>
    <?php
        }
    }
    ?>
</div>

<div id="pagination-container">
    <div class="load-more">
        <button class="myBtn" data-page="2" data-max-pages="<?php echo $query_grid->max_num_pages; ?>" data-nonce="<?php echo wp_create_nonce('load_more_photos'); ?>">
            Charger plus
        </button>
    </div>
</div>

<?php
// On réinitialise à la requête principale
wp_reset_postdata();
?>
<?php get_footer(); ?>