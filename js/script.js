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

// Popup contact
let modal = document.getElementById("contact-modal");

// Get the button that opens the modal
let btn = document.getElementById("btn-contact");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
//span.onclick = function() {
// modal.style.display = "none";
//}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
