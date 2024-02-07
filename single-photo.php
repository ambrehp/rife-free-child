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


<!-- Mise en place du bloc des photos apparentées -->
<div class="related-photos">
    <h2>Vous aimerez aussi</h2>
    <div class="related-block-photos">
        <?php
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 2,
                'post__not_in' => array(get_the_ID()),
                'categorie' => get_the_terms(get_the_ID(), 'categorie')[0]->slug,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part('templates_part/photo-block');
                endwhile;
            endif;

            wp_reset_postdata();
        ?>
    </div>
</div>


<?php // End the loop.
        endwhile;
    endif; ?>