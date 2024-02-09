<!-- Modal -->
<button class="btn-contact">contact</button>
<div id="contact-modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">x</span>
        <img class="titre-contact" src="<?php echo get_stylesheet_directory_uri(); ?>'./assets/images/Nathalie-Mota-photographe-freelance-evenementiel-titre-contact-popup.png'" alt="image header contact popup">
        <?php echo do_shortcode('[wpforms id="56" title="false"]'); ?>
    </div>

</div>