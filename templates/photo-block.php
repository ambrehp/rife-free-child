<?php
// Récupération des informations de la photo
$post_permalink = get_permalink();
$photo_image_id  = get_field('image');
$reference_photo = get_field('reference');
$terms = get_the_terms($post->ID, 'categorie-photo');

// Récupération du format de la photo et filtrage
$formats = get_the_terms(get_the_ID(), 'formats-photo');
if ($formats && !is_wp_error($formats)) {
    $noms_formats = array();
    foreach ($formats as $format) {
        $noms_formats[] = $format->name;
    }
    $liste_formats = join(', ', $noms_formats);
}

// Récupération de la catégorie de la photo et filtrage
$categories = get_the_terms(get_the_ID(), 'categorie-photo');
if ($categories && !is_wp_error($categories)) {
    $noms_categories = array();
    foreach ($categories as $categorie) {
        $noms_categories[] = $categorie->name;
    }
    $liste_categories = join(', ', $noms_categories);
} else {
    $liste_categories = ''; // Définir une valeur par défaut si aucune catégorie n'est pas trouvée
}
?>

<!-- Affichage du bloc photo -->
<div class="autres-photos">
    <div class="hover-photo lightbox">
        <div class="info-container">
            <div class="fullscreen-container">
                <a href="#lightbox">
                    <img class="icon-fullscreen" src="<?php echo get_stylesheet_directory_uri() . './assets/images/icon_fullscreen.png'; ?>" alt="Icon Fullscreen">
                </a>
            </div>
            <div class="eye-container">
                <a href="<?php echo esc_url($post_permalink); ?>">
                    <img class="icon-eye" src="<?php echo get_stylesheet_directory_uri() . './assets/images/icon_eye.png'; ?>" alt="Icon oeil">
                </a>
            </div>
            <div class="ref-container">
                <div class="ref-info">

                    <?php
                    //Afficher la référence
                    echo $reference_photo ?>
                </div>
                <!-- Vérifier si $liste_categories est définie avant de l'utiliser -->
                <div class="cat-info">
                    <?php
                    if (isset($liste_categories)) {
                        //Afficher la catégorie
                        echo $liste_categories;
                    } ?>
                </div>
            </div>
        </div>

        <?php
        if ($photo_image_id) {
            $photo_image_url = wp_get_attachment_image_src($photo_image_id, 'desktop-home'); // Récupérer l'URL de l'image
            if ($photo_image_url) {
                $photo_image_url = $photo_image_url[0]; // L'URL de l'image se trouve à l'index 0 du tableau retourné
                echo '<img class="autre-categorie" src="' . esc_url($photo_image_url) . '" alt="Photo">';
            }
        }
        ?>
    </div>
</div>