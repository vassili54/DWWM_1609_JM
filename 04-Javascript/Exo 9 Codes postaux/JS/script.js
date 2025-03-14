fetch ("https://arfp.github.io/tp/web/javascript/02-zipcodes/zipcodes.json")
.then((Response)=>{return Response.json()})
.then(data=>{console.log(data);
    RemplirDataList(data);
    const myButton = document.querySelector("#btnValider");
    myButton.addEventListener("click",function(){ 
        const saisie = document.querySelector("#citySearch");
        let tabResult = []; 
        
        tabResult=data.filter((ville)=>ville.codePostal == saisie.value || ville.codeCommune == saisie.value || ville.nomCommune == saisie.value);
        console.clear(); 
        const info=document.querySelector("#results");
        info.innerHTML="";
        tabResult.forEach(ville => {
           
            console.log(ville);
            info.innerHTML+=`Nom de la commune :${ville.nomCommune} <br> cp de la commune :${ville.codePostal} <br> libelle Acheminement :${ville.libelleAcheminement} <br> code commune :${ville.codeCommune}<br><br>`

            });
    })




}).catch( (Error)=>{alert("message:"+Error)} ); //


function RemplirDataList(_data){
    const dataList = document.querySelector("#citySuggestions");
    for (let i = 0; i < _data.length; i++) {
     const myOption = new Option();
     myOption.value = _data[i].codeCommune;

        myOption.textContent = _data[i].nomCommune + "cp:" + _data[i].codePostal;
        dataList.appendChild(myOption);
    }
}

