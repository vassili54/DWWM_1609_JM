/*
let motTapeOk = true

if (motTapeOk) {
    console.log("Bravo, vous avez correctement tapé le mot")
} else {
    console.log("Echec, le mot n'est pas correct")
}
*/


const motApplication = "Bonjour"
 motUtilisateur = prompt("Entrez un mot :" + motApplication)
/*
 if (motUtilisateur === motApplication) {
    console.log("bravo !")
 } else {
    console.log("Vous avez fait une erreur de frappe.") 
 }

*/

if (motUtilisateur === motApplication) {
    console.log("Bravo !")
} else {
    if (motUtilisateur === "Gredin") {
        console.log("Restez correct !")
    } else {
        if (motUtilisateur === "Mécréant") {
            console.log("Restez correct !")
        }else {
            if (motUtilisateur === "Vilain") {
                console.log("Soyez gentil !")
            } else {
                console.log("Vous avez fait une erreur de frappe.")
            }
        }
    }
}



