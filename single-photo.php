<?php

/**
 * Template Name: Photo details 
 * 
 */

get_header(); ?>

<section class="detail-container">
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
    <div class="contact-content">
        <p>Cette photo vous intéresse ?</p>
        <button id="myBtn" data-reference="<?php the_field('reference'); ?>">Contact</button>
    </div>

    <!-- Navigation entre chaque post -->
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
</section>


<!-- Bloc des photos apparentées -->
<div class="related-photos">
    <h2>Vous aimerez aussi</h2>
    <div class="related-block-photos">
        <?php
            $args = array(
                'post_type' => 'image',
                'posts_per_page' => 2,
                'post__not_in' => array(get_the_ID())
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part('templates/photo-block');
                endwhile;
            endif;

            wp_reset_postdata();
        ?>
    </div>
</div>


<?php // End the loop.
        endwhile;
    endif; ?>

<?php get_footer(); ?>
<!-- Inclusion du script JavaScript -->