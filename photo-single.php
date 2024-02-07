<?php get_header(); ?>

<?php
if(have_posts()) : while (have_posts()) : the_post(); ?>

<div class="photo-info-container">
    <div class="photo-container">
        <div class="photo-details-left">
            <h1><?php the_title(); ?></h1>
            <p>Référence : <?= get_field('reference'); ?></p>
            <p>Catégorie : <?= get_the_term_list(get_the_ID(), 'categorie-photo'); ?></p>
            <p>Format : <?= get_the_term_list(get_the_ID(), 'format-photo'); ?></p>
            <p>Type : <?= get_field('type'); ?></p>
            <p>Année : <?= get_field('annee'); ?></p>
        </div>
        <div class="photo-details-right">
            <?php the_post_thumbnail('medium'); ?>
            <a class="fullscreen-link" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>">
                <span></span>
            </a>
        </div>
    </div>
    <div class="photo-info-nav">
        <div class="text-interest">
            <p>Cette photo vous intéresse ?</p>
        </div>

        <button id="contact-btn" class="contact-btn-photo popup-link" data-photo-ref="<?php the_field('reference'); ?>">Contact</button>

        <div class="photo-info-nav-block">

            <div class="photo-info-nav-prev">
                <!-- Miniature précédente -->
                <div class="thumbnail-previous">
                    <?php $prev_post = get_previous_post(); ?>
                    <?php if ($prev_post) : ?>
                        <img class="nav-thumbnail-prev" src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id($prev_post->ID), 'thumbnail'); ?>" alt="<?php echo $prev_post->post_title; ?>">
                    <?php endif; ?>
                </div>
                <!-- <?php previous_post_link('%link', '<img src="/wp-content/themes/NathalieMota/images/arrow_left.svg" alt="Précédent">', FALSE, '', 'format'); ?> -->
            </div>

            <div class="photo-info-nav-next">
                <!-- Miniature suivante -->
                <div class="thumbnail-next">
                    <?php $next_post = get_next_post(); ?>
                    <?php if ($next_post) : ?>
                        <img class="nav-thumbnail-next" src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id($next_post->ID), 'thumbnail'); ?>" alt="<?php echo $next_post->post_title; ?>">
                    <?php endif; ?>
                </div>
                <!-- <?php next_post_link('%link', '<img src="/wp-content/themes/NathalieMota/images/arrow_right.svg" alt="Suivant">', FALSE, '', 'format'); ?> -->
            </div>

        </div>

    </div>
</div>
<!-- Mise en place du bloc des photos apparentées -->
<!-- <div class="related-photos">
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
    </div> -->
</div>