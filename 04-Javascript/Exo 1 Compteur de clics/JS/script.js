// On récupère l'élément HTML du bouton pour ajouter 1
let mybtn=document.getElementById("btnajout");
// On récupère l'élément HTML du bouton pour réinitialiser le compteur
let resetbtn=document.getElementById("btnreset")

// On ajoute un événement "click" au bouton "Ajouter 1"
mybtn.addEventListener("click",function () {
    // On récupère la valeur actuelle du compteur
    // "document.querySelector('#compteur').textContent" permet de récupérer le texte dans la balise <span id="compteur">
    let nbclick=Number(document.querySelector("#compteur").textContent);

    // Pour le debug, on affiche la valeur actuelle du compteur dans la console
    console.log(nbclick);

    // On met à jour le compteur en augmentant de 1
    // On assigne la nouvelle valeur au texte du <span id="compteur">
    document.querySelector("#compteur").textContent=nbclick+1;
});

// On ajoute un événement "click" au bouton "Réinitialiser"
resetbtn.addEventListener("click", function () {
    // Lorsque le bouton "Réinitialiser" est cliqué, on réinitialise le compteur à 0
    document.querySelector("#compteur").textContent = 0;
});