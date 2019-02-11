var sommeGlobal = 0.0;
var copierGlobal = "";



function getDate(){
    var ladate=new Date();
    return ladate.getFullYear();
    
}

function raz() {
    document.formulaire.rentre2.value = "";
    sommeGlobal = 0;
    copierGlobal = "";
    document.forms["formulaire"].elements["oui"].checked = false;
 
}

function effacer() {
    if (document.formulaire.copier.value == "Copiez Coller vos données (si plusieurs pages à copier, copiez chaque page et cliquez sur 'envoyez les données') du 28 au 28 de chaque mois par exemple") {	//chemin pour acceder au parametre valeur
        document.formulaire.copier.value = "";
    }
}

function reecrire() {
    if (document.formulaire.copier.value == "") {
        document.formulaire.copier.value = "Copiez Coller vos données (si plusieurs pages à copier, copiez chaque page et cliquez sur 'envoyez les données') du 28 au 28 de chaque mois par exemple";
    }
}

function bloquer(evenement) {	//on passe l'evenement qui se produit. Cela permet au développeur d'accéder à plus d'informations (par exemple : l'objet qui a reçu l'événement, le type de l'événement et le bouton de la souris utilisé
    if (evenement.keyCode == 13) {
        evenement.returnValue = true;
    } else {
        evenement.returnValue = false;	//recuperer si evenement declencher dans l'evenement onkeypress rowspan	
    }
}

function ajoutCopierGlobal() {  //ajoute les données du textarea
    if (document.forms["formulaire"].elements["oui"].checked === true) {
        copierGlobal = copierGlobal + (document.forms["formulaire"].elements["copier"].value)+ " ";
        alert("Données enregistrées");
        formAjax(copierGlobal);
    } else {
        copierGlobal = copierGlobal + (document.forms["formulaire"].elements["copier"].value)+ " ";
        alert("Données enregistrées");
        document.forms["formulaire"].elements["copier"].value = "";
    }
}

function ajout() {
    
    if(document.formulaire.rentre.value!=""){
        
        var rentre = (document.formulaire.rentre.value);
        rentre = rentre.replace(new RegExp(' ', 'g'), '');	//Remplace les espaces et les virgules, pour le format numériques pour les calculs
        rentre = rentre.replace(new RegExp(',', 'g'), '.');
        rentre = parseFloat(rentre);	//Convertit en floatant

        sommeGlobal = rentre + sommeGlobal;

        document.formulaire.rentre.value = '';
        document.formulaire.rentre2.value = sommeGlobal;
    }
       
}


