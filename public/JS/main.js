
let bouton = document.querySelector(".bouton");
let logo = document.querySelector(".logo");
let tabColor = document.querySelector(".tabColor");

let darkMode = new DarkMode(bouton, logo);

darkMode.darkmode();
darkMode.localStorageDarkMode();

