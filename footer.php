<?php

wp_footer();
?>
<!-- appel de la popup de contact -->
<?php get_template_part('templates/popup-contact') ?>

<div id="footer">
    <?php
    wp_nav_menu(array(
        'menu' => 'menu footer',
        'theme_location' => 'footer',
        'menu_id' => 'footer-menu',
        'class' => 'menu',
    ));
    ?>
    <div>
        <span>TOUS DROITS RÉSERVÉS </span>
    </div>
</div>

</body>

</html>