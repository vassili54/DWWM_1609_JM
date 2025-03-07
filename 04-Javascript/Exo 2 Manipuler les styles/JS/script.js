// Fonction pour augmenter la taille du texte
function increaseTextSize() {
    // Sélectionnez le paragraphe de texte
    var textParagraph = document.getElementById('textParagraph');
    // Obtenez la taille actuelle du texte
    var currentSize = parseFloat(window.getComputedStyle(textParagraph, null).getPropertyValue('font-size'));
    // calculer la nouvelle taille du texte
    var newSize = currentSize + 1;
    // Si la nouvelle taille dépasse 48px, réinitialisez-la à 16px
    if (newSize > 48) {
        newSize = 16;
    }
    // Appliquez la nouvelle taille au paragraphe
    textParagraph.style.fontSize = newSize + 'px';
    // Mettez à jour la valeur de l'input
    document.getElementById('textSizeInput').value = newSize;
}

// Fonction pour diminuer la taille du texte
function decreaseTextSize() {
    // Sélectionnez le paragraphe de texte
    var textParagraph = document.getElementById('textParagraph');
    // Obtenez la taille actuelle du texte
    var currentSize = parseFloat(window.getComputedStyle(textParagraph, null).getPropertyValue('font-size'));
    // Calculez la nouvelle taille du texte
    var newSize = currentSize -1;
    // Si la nouvelle taille est inférieure à 8px, réinitialisez-la à 16px
    if (newSize < 8) {
        newSize = 16;
    }
    // Appliquez la nouvelle taille au paragraphe
    textParagraph.style.fontSize = newSize + 'px';
    // Mettez à jour la valeur de l'input
    document.getElementById('textSizeInput').value = newSize;
}

// Fonction pour définir manuellement la taille du texte
function setTextSize() {
    // Sélectionnez le paragraphe de texte
    var textParagraph = document.getElementById('textParagraph');
    // Obtenez la valeur de l'input
    var newSize = parseInt(document.getElementById('textSizeInput').value);
    // Vérifiez les contraintes de taille
    if (newSize < 8) {
        newSize = 8;
    }else if (newSize > 48) {
        newSize = 48;
    }
    // Appliquez la nouvelle taille au paragraphe
    textParagraph.style.fontSize = newSize + 'px';
}