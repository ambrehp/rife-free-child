// burger menu
// Sélection des éléments dans le html
let menuBtn = document.querySelector(".menu-btn");
let menu = document.querySelector(".mobile-menu");
//let menuItem = document.querySelectorAll(".menu-item");

// écoute de l'event click pour ajouter la class active au clique sur le menu
menuBtn.addEventListener("click", function () {
  //console.log("Menu button clicked");
  menuBtn.classList.toggle("active");
  menu.classList.toggle("active");
});

// écoute de l'event sur menuItem pour désactiver le menu burger au clique
menu.addEventListener("click", function () {
  menuBtn.classList.remove("active");
  menu.classList.remove("active");
});
2;
