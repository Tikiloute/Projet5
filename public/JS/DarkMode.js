class DarkMode {

    constructor( bouton ,logo){
        this.bouton = bouton;
        this.logo = logo;
    }

    darkmode(){
        this.bouton.addEventListener("click", this.colorChange);
    }

    colorChange(){

        if (document.body.classList.contains("white")){
            document.body.classList.add("black");
            document.body.classList.remove("white");
            bouton.innerHTML = "white mode";
            logo.style.color = "white";
            localStorage.setItem("darkMode", "black");

        } else if (document.body.classList.contains("black")){
            document.body.classList.add("white");
            document.body.classList.remove("black");
            bouton.innerHTML = "Dark mode";
            logo.style.color = "black";
            localStorage.setItem("darkMode", "white");
        }

    }

    localStorageDarkMode(){

        if (localStorage.getItem("darkMode") === "black"){

            document.body.classList.add("black");
            document.body.classList.remove("white");
            this.bouton.innerHTML = "white mode";
            this.logo.style.color = "white";

        } else if (localStorage.getItem("darkMode") === "white"){

            document.body.classList.add("white");
            document.body.classList.remove("black");
            this.bouton.innerHTML = "Dark mode";
            this.logo.style.color = "black";

        }
    }


}
