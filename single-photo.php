<?php

/**
 * Template Name: Photo details 
 * 
 */

get_header(); ?>

<section class="detail-container">
    <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <?php //   Vérifier l'activation de ACF
            if (!function_exists('get_field')) return;
            $reference = get_field('reference');
            $type = get_field('type');
            $annee = get_field('annee');
            ?>

            <div class="detail-left">
                <h1> <?php the_title(); ?></h1>
                <p>Référence : <?php the_field('reference'); ?></p>
                <p>Type : <?php the_field('type'); ?></p>
                <p>Année : <?php the_field('annee'); ?></p>
            </div>

            <div class="detail-right">
                <div class="">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
</section>

<section class="contact-container">
    <div class="contact-content">
        <p>Cette phtoto vous intéresse ?</p>
        <button class="btn-contact" data-reference="<?php the_field('reference'); ?>">contact</button>
    </div>

    <!-- Previous/next post navigation -->
    <div class="post-navigation">
        <div class="previous-navigation">
            <?php echo get_the_post_thumbnail(get_previous_post(), 'single-photo-thumbnail-size'); ?>
        </div>
        <div class="next-navigation">
            <?php echo get_the_post_thumbnail(get_next_post(), 'single-photo-thumbnail-size'); ?>
        </div>
    </div>

    <div class="navigation-arrows">
        <div class="previous-arrow">
            <?php previous_post_link(' %link', '&#10229;'); ?> <!-- fléche post précedent -->
        </div>
        <div class="next-arrow">
            <?php next_post_link(' %link', '&#10230;'); ?> <!-- fléche post suivant -->
        </div>
    </div>
</section>


<section class="other-container">
    <h2>VOUS AIMEREZ AUSSI</h2>
    <div class="suggestion">
        <!----- Liste carte même catégorie ----->
        <div class="grid-container" id="post-container">
            <?php
            // Récupérer les termes de la taxonomie pour le post actuel
            $categories = get_the_terms(get_the_ID(), 'categorie-photo');
            // Récupérer l'ID du post actuellement ouvert
            $current_post_id = get_the_ID();
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 2,
                'ignore_sticky_posts' => 1,
                'orderby' => 'rand',
                'post__not_in' => array($current_post_id),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie-photo',
                        'field' => 'slug',
                        'terms' => (!empty($categories)) ? $categories[0]->slug : '',
                    ),
                ),
            );

            $query = new WP_Query($args);
            // Variable pour suivre le nombre de cartes affichées
            $card_count = 0;
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    // Vérifier si le post actuel est différent du post affiché
                    if ($current_post_id != get_the_ID()) {
                        //Appel du code de la card déplacé dans le sous template "card"
                        get_template_part('templates-parts/card');
                        // Incrémenter le nombre de cartes affichées
                        $card_count++;
                    }
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Désolé, mais il n\'y a aucune autre photo à afficher dans cette catégorie.</p>';
            endif;
            ?>
        </div>
    </div>
</section>


<?php // End the loop.
        endwhile;
    endif; ?>