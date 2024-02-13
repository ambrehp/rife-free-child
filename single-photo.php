<?php

/**
 * Template Name: Photo details 
 * 
 */

get_header(); ?>

<section class="detail-container flexrow">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php //   Vérifier l'activation de ACF
            if (!function_exists('get_field')) return;
            $reference = get_field('reference');
            $type = get_field('type');
            $annee = get_field('annee');
            ?>

            <div class="detail-left">
                <h1> <?php the_title(); ?></h1>
                <p>RÉFÉRENCE : <?php the_field('reference'); ?></p>
                <p>CATÉGORIE : <?php echo get_the_term_list(get_the_ID(), 'categorie-photo'); ?></p>
                <p>FORMAT : <?php echo get_the_term_list(get_the_ID(), 'format-photo'); ?></p>
                <p>TYPE : <?php the_field('type'); ?></p>
                <p>ANNÉE : <?php the_field('annee'); ?></p>
            </div>

            <div class="detail-right">
                <div class="">
                    <?php
                    $image_id = get_field('image', $post->ID);
                    if ($image_id) {
                        echo '<img src="' . esc_url(wp_get_attachment_image_url($image_id, 'large')) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) . '">';
                    }
                    ?>
                </div>
            </div>
</section>

<!-- Ajout section contact -->
<section class="contact-container">
    <div class="contact-content flexrow">
        <p>Cette photo vous intéresse ?</p>
        <button id="myBtn" data-reference="<?php the_field('reference'); ?>">Contact</button>
    </div>

    <!-- Navigation entre chaque post -->
    <div class="flexrow">
        <div class="site__navigation__prev">
            <?php
            $prev_post = get_previous_post();
            if ($prev_post) {
                $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                $prev_post_id = $prev_post->ID;
                echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title . '" class="previous_post">';
                if (has_post_thumbnail($prev_post_id)) {
            ?>
                    <div>
                        <?php echo get_the_post_thumbnail($prev_post_id, array(80, 70));
                        previous_post_link(' %link', '&#10229;'); ?> <!-- fléche post précedent  -->
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="site__navigation__next">
            <?php
            $next_post = get_next_post();
            if ($next_post) {
                $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                $next_post_id = $next_post->ID;
                echo  '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title . '" class="next_post">';
                if (has_post_thumbnail($next_post_id)) {
            ?>
                    <div><?php echo get_the_post_thumbnail($next_post_id, array(80, 70));
                            next_post_link(' %link', '&#10230;'); ?> <!-- fléche post suivant  -->
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>


<!-- Dernière partie - Photos similaires -->
<div class="similar-photo flexcolumn">
    <h3>Vous aimerez aussi</h3>
    <div class="block-photos">
        <div class="block-content flexrow">
            <?php
            // Récupération de la catégorie de la photo actu
            $categories = wp_get_post_terms(get_the_ID(), 'categorie-photo');
            // print_r($categories);
            if ($categories && !is_wp_error($categories)) {
                // print_r($categories);
                $ID_categories = wp_list_pluck($categories, 'term_id');
                // print_r($categories);
                // Récupération de deux photos de la même catégorie
                $photos_similaires = new WP_Query(array(
                    'post_type' => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categorie-photo',
                            'field' => 'id',
                            'terms' => $ID_categories,
                        ),
                    ),
                ));
                // print_r($photos_similaires);

                if ($photos_similaires->have_posts()) {
                    while ($photos_similaires->have_posts()) {
                        $photos_similaires->the_post();
                        // Affichage de la photo similaire 
                        get_template_part('templates/photo-block');
                    }
                    wp_reset_postdata();
                } else {
                    // Affichage d'un message si aucune photo similaire n'est trouvée dans la même catégorie
                    echo "Aucune photo similaire pour le moment.";
                }
            }
            ?>
        </div>
    </div>
</div>


<?php // End the loop.
        endwhile;
    endif; ?>

<?php get_footer(); ?>