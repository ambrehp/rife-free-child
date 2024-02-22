<?php

/**
 * ACCUEIL 
 *
 * @package WordPress
 * @subpackage rife-free-child theme
 */

get_header(); ?>


<div class="content">
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
</div>
<?php get_footer(); ?>