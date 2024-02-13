<?php
// Récupération des informations de la photo
$titre_post = get_the_title();
$titre_nettoye = sanitize_title($titre_post);
$lien_post = get_site_url() . '/photo/' . $titre_nettoye;
$photo_post = get_field('image');
$reference_photo = get_field('reference');

// Récupération du format de la photo et stockage pour filtrage
$formats = get_the_terms(get_the_ID(), 'formats-photo');
if ($formats && !is_wp_error($formats)) {
    $noms_formats = array();
    foreach ($formats as $format) {
        $noms_formats[] = $format->name;
    }
    $liste_formats = join(', ', $noms_formats);
}

// Récupération de la catégorie de la photo et stockage pour filtrage
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
    <div class="lien-photo">
        <?php echo 'lien:', $lien_post; ?>
    </div>
    <?php echo 'Photo :', $photo_post; ?>
    <div class="survol-photo">
        <div class="structuration-survol-photo">
            <div class="fullscreen-container">
                <a href="#lightbox">
                    <img class="icon-fullscreen" src="<?php echo get_stylesheet_directory_uri() . './assets/images/icon_fullscreen.png'; ?>" alt="Icon Fullscreen">
                </a>
            </div>
            <div class="eye-container">
                <a href="<?php echo esc_url($lien_post); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri() . './assets/images/icon_eye.png'; ?>" alt="Icon oeil">
                </a>
            </div>
            <div class="ref-container">
                <div class="survol-reference">
                    <?php echo $reference_photo ?>
                </div>
                <!-- Vérifier si $liste_categories est définie avant de l'utiliser -->
                <div class="cat-container">
                    <?php if (isset($liste_categories)) {
                        echo $liste_categories;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>