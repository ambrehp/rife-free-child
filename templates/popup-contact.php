<!-- Modal -->
<!-- <p>Cette phtoto vous intéresse ?</p> -->
<!-- <button id="myBtn" class="popup-link">Open Modal</button> -->

<!-- Container de la modal -->
<div id="myModal" class="modal">
    <!-- <div id="contact-modal" class="modal"> -->

    <!-- content de la Modal -->
    <div class="modal-content">
        <span class="close">x</span>
        <img class="titre-contact" src="<?php echo get_stylesheet_directory_uri(); ?>'./assets/images/Nathalie-Mota-photographe-freelance-evenementiel-titre-contact-popup.png'" alt="image header contact popup">
        <?php echo do_shortcode('[wpforms id="56" title="false"]'); ?>
    </div>

</div>