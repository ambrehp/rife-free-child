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
        <p> <b>TOUS DROITS RÉSERVÉS</b> </p>
    </div>
    <!-- appel de la popup de contact -->
    <?php get_template_part('templates/popup-contact.php'); ?>

</div>
<?php

wp_footer();
?>
</body>

</html>