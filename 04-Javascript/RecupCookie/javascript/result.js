const information = document.querySelector(".info");

function recupCookie(nomCookie) {
    let tabCookie = document.cookie.split(";");
    for (let i = 0; i < tabCookie.length; i++) {
        let tabKeyValue = tabCookie[i].split("=");
        if (tabKeyValue[0] === nomCookie) {
            return tabKeyValue[1];
    
        }

    }
}
const message = "Bienvenue " + recupCookie("Nom") + " sur notre site";
information.textContent = message;