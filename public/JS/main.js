
let bouton = document.querySelector(".bouton");
let logo = document.querySelector(".logo");
let table = document.querySelector(".table-light");

let darkMode = new DarkMode(bouton, logo, table);

darkMode.darkmode();
darkMode.localStorageDarkMode();
