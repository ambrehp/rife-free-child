document.addEventListener("DOMContentLoaded", function () {
  //console.log('Le DOM est chargé.');

  //burger menu
  //Sélection des éléments dans le html
  const menuBtn = document.querySelector(".burger-icon");
  const closeMenu = document.querySelector(".close-icon");
  const menuItem = document.querySelector(".nav-list");

  //fonction de l'ouverture du burger menu au click
  function openBurgerMenu() {
    menuItem.classList.add("open");
    //console.log("affiche menu");
    menuBtn.style.display = "none";
    closeMenu.style.display = "block";
  }

  // Fonction pour fermer le menu sur mobile
  function closeMobileMenu() {
    menuItem.classList.remove("open");
    //console.log("ferme menu");
    menuBtn.style.display = "block";
    closeMenu.style.display = "none";
  }

  // Ouverture du menu au click sur le burger
  menuBtn.addEventListener("click", openBurgerMenu);

  // Fermeture du menu au clic sur la croix
  closeMenu.addEventListener("click", closeMobileMenu);

  /////////////////////////////////////////
  //////////////////////////////////////////

  // ///// FONCTION DE LA POPUP

  jQuery(function ($) {
    // Récupère le bouton contact
    let btn = $("#myBtn");

    // Récupère le lien du menu
    const btnMenu = $(".popup-link");

    // Récupère le container de la modal
    let modal = $("#myModal");

    // Récupère <span> qui ferme la modal
    let span = $(".close")[0];

    // Fonction pour ouvrir la modal
    function openModal() {
      modal.css("display", "block");
    }

    // Fonction pour fermer la modal
    function closeModal() {
      modal.css("display", "none");
    }

    // Quand l'utilisateur clique sur le bouton contact ou le lien du menu, ouvre la modal
    btn.click(openModal);
    btnMenu.click(openModal);

    // Quand l'utilisateur clique sur <span> (x), ferme la modal
    $(span).click(closeModal);

    // Quand l'utilisateur clique en dehors de la modal, ferme la modal
    $(window).click(function (event) {
      if ($(event.target).is(modal)) {
        closeModal();
      }
    });

    ///// Ajout Réf au formulaire Contact
    $("#myBtn, .popup-link").on("click", function (e) {
      e.preventDefault(); // Permet d'empêcher l'ouverture du formulaire avant le pré-remplissage de la Réf.

      // Récupère la valeur du champ ACF "reference" à partir du post actuel
      const valeurChampACF = $(this).data("reference");

      // Pré-remplit le champ du formulaire
      $("#wpforms-56-field_3").val(valeurChampACF);

      // Ouvre le formulaire
      $("#wpforms-56").show();
    });

    /////////////////////////////////////////
    //////////////////////////////////////////

    /// intégration pagination btn "charger plus"
    jQuery(document).ready(function ($) {
      $(".myBtn").click(function () {
        // Valeurs sélectionnées
        const button = $(this);
        const page = button.data("page");
        const maxPages = button.data("max-pages");
        const nonce = button.data("nonce");
        const container = $(".photo-grid");
        const annee = $("#annee").val();
        const categories = $("#filtre-categorie").val();
        const formats = $("#filtre-format").val();

        if (page <= maxPages) {
          $.ajax({
            url: custom_script_vars.ajaxurl,
            type: "post",
            data: {
              action: "load_more_photos",
              nonce: nonce,
              page: page,
              sortOrder: annee,
              categories: categories,
              formats: formats,
            },
            success: function (response) {
              container.append(response);
              button.data("page", page++);
              if (page >= maxPages) {
                button.hide();
              }
              initLightbox();
            },
          });
        }
      });
    });

    ///Ajout filtres et tri
    $(".filtre-container select").on("change", function () {
      // Récupérer les valeurs des filtres
      const categories = $("#filtre-categorie").val();
      const formats = $("#filtre-format").val();
      const annee = $("#annee").val();
      const button = $(".myBtn");

      // Récupérer le nonce (jeton de sécurité)
      const nonce = custom_script_vars.nonce;

      // Envoyez une requête AJAX
      $.ajax({
        url: custom_script_vars.ajaxurl, // URL de l'action AJAX
        type: "POST",
        data: {
          action: "filter_photos",
          nonce: nonce,
          categories: categories,
          formats: formats,
          sortOrder: annee,
        },
        success: function (response) {
          button.show();
          $(".photo-grid").html(response);
          initLightbox();
        },
      });
    });
  });
});
