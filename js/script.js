document.addEventListener("DOMContentLoaded", function () {
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

  // Récupère le bouton contact
  let btn = document.getElementById("myBtn");
  const btnMenu = document.querySelector(".popup-link");

  // Récupère le container de la modal
  let modal = document.getElementById("myModal");

  // Récupère <span> qui ferme la modal
  let span = document.getElementsByClassName("close")[0];

  // Déclare fonction pour ouvrir la modal
  function openModal() {
    modal.style.display = "block";
  }

  // Quand l'utilisateur clique sur le lien du menu, ouvre la modal
  btn.onclick = function () {
    openModal();
  };

  // Quand l'utilisateur clique sur le btn, ouvre la modal
  btnMenu.onclick = function () {
    openModal();
  };

  // Quand l'utilisateur clique sur <span> (x), ferme la modal
  span.onclick = function () {
    modal.style.display = "none";
  };

  // Quand l'utilisateur clique en dehors de la modal, ferme la modal
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});
