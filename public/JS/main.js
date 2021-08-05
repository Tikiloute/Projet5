
let bouton = document.querySelector(".bouton");
let logo = document.querySelector(".logo");
let card = document.querySelector(".cardNight");


let darkMode = new DarkMode(bouton, logo, card);

darkMode.darkmode();
darkMode.localStorageDarkMode();
