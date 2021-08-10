class DarkMode {

    constructor(bouton ,logo){
        this.bouton = bouton;
        this.logo = logo;
    }

    darkmode(){
        this.bouton.addEventListener("click", this.colorChange);
    }

    colorChange() {

        if (document.body.classList.contains("white")){
            document.body.classList.add("black");
            document.body.classList.remove("white");
            bouton.innerHTML = "Mode clair";
            bouton.style.backgroundColor = "yellow";
            bouton.style.color = "black";
            logo.style.color = "white";
            localStorage.setItem("darkMode", "black");

        } else if (document.body.classList.contains("black")){
            document.body.classList.add("white");
            document.body.classList.remove("black");
            bouton.innerHTML = "Mode nuit";
            bouton.style.backgroundColor = "#2d2d2d";
            bouton.style.color = "white";
            logo.style.color = "black";
            localStorage.setItem("darkMode", "white");
        }

    }

    localStorageDarkMode() {

        if (localStorage.getItem("darkMode") === "black"){

            document.body.classList.add("black");
            document.body.classList.remove("white");
            this.bouton.innerHTML = "Mode clair";
            bouton.style.backgroundColor = "yellow";
            bouton.style.color = "black";
            this.logo.style.color = "white";
            

        } else if (localStorage.getItem("darkMode") === "white"){

            document.body.classList.add("white");
            document.body.classList.remove("black");
            this.bouton.innerHTML = "Mode nuit";
            bouton.style.backgroundColor = "#2d2d2d";
            bouton.style.color = "white";
            this.logo.style.color = "black";
        }
    }


}
