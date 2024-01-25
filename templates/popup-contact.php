<!-- Trigger/Open The Modal -->
<button id="btn-contact">CONTACT</button>

<!-- The Modal -->
<div id="contact-modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">x</span>
        <img class="titre-contact" src="<?php echo get_template_directory_uri(); ?>/assets/images/Nathalie-Mota-photographe-freelance-evenementiel-titre-contact-popup.png" alt="image header contact popup">
        <?php echo do_shortcode('[wpforms id="56" title="false"]'); ?>
    </div>

</div>