function closeInter(){  
    $('#accordeon').slideUp('normal');
    $('#titre1').removeClass('active');

    $('#divHidden').hide();
    
    $( "#bigContain" ).remove();
}


/*
 * affiche une fenetre contenant les valeurs  du fichier xml
 * 
 * @return void
 */
function showIntervalle(){
    
    case_checked = 0;
    $("input[name=check]").prop("checked",false);
   
    var mois =  $('#mois').val();
    var annee =  $('#annee').val();
    
    $('#divHidden').css('visibility', 'visible'); 
    $("#divHidden").show();
    
    $( "body" ).append( "<div id='bigContain' ></div>");
    
        $.ajax({

           url : base_url+'main/accueil',
            type : 'POST', 
            data: {
                 mois:mois,
                 annee:annee,
                 action:5
            },
   
            success: function (data) {
                
                redirection(data);

                $('#intervalle').html(data).fadeIn("slow");
                $('#divHidden').css('overflow-y', 'scroll'); 

            }
        });
   
}




/*
 * recupere les id des valeurs qui formeront l'intervalle depuis des checkbox
 * 
 * @return void
 */
var case_checked = 0;

function getIntervalle(){
   
    case_checked = case_checked+1;

    if(case_checked == 2){
          
        if ((window.confirm("L'intervalle est-il correcte ?")) == true) {
            
            var intervalle=[];

            $("input:checked[name=check]").each(function(){ //parcours les box
                intervalle.push($(this).val()); //injecte la valeur de la box
            }); 
     
            case_checked = 0;
            $("input[name=check]").prop("checked",false);
            addTableau(intervalle);
            
        }else{
           
            case_checked = 0;
            $("input[name=check]").prop("checked",false);  
            
        }
    }
}






/*
 * envoie les valeurs de l'intervalle choisit
 * 
 * @return void
 */
function addTableau(intervalle){
    
    closeInter();
    clique = 1;
    deroulement = 0;
    var mois = $('#mois').val();
    var annee = $('#annee').val();
    
    $( "#afficherTableau" ).fadeOut("slow",function(){
        
        $('#afficherTableau').html("<center><img src='"+chargement+"'</center>").fadeIn();
        
        $.ajax({
             url : base_url+'main/accueil', 
             type : 'POST',
             dataType : 'html', cache: false,

                data: {
                    mois: mois,
                    annee: annee,
                    action: 6,
                    intervalle:intervalle
                },
                success: function (data) {
                    
                    redirection(data);
                      
                    if(data=='MONTH_EXIST'){

                        alert("Le mois existe déjà pour cette année");
                        window.location.replace("./mainpage");

                    }else{
                        
                        alert("Données enregistrées ");
                        
                        $('#inter').fadeOut("slow");

                        $('#afficherTableau').fadeOut("slow",function(){

                            $('#afficherTableau').html(data).fadeIn("slow");

                        }); 
         
                       
                    }

                }
        });
        
    }); 

}




/*
 * demande de confirmation pour la suppression de mois
 * 
 * @return void
 */
function confirmation(id, annee) {
    if ((window.confirm("Voulez vous supprimer ce mois ?")) == true) {
        clique=1;
        deleteAjax(id, annee);
    }
}




/*
 * envoie pour la suppression de mois
 * 
 * @return void
 */

function deleteAjax(id, annee){
    
    clique = 1;
    $.ajax({

        url : base_url+'main/accueil', // La ressource ciblée
        type : 'POST', // Le type de la requête HTTP
        data : {
            id: id,
            action:1,
            annee:annee
        },
       // Le type de données à recevoir, ici, du HTML.
        success: function (data) {
            
            redirection(data);
            // Je charge les données dans box
            $('#afficherTableau').html(data);
        }
    });
        
}


/*
function formAjax(copierGlobal1) {
    
    var copier = copierGlobal1;	//recupere donnees du formulaire et du text area copier
    var annee = document.formulaire.annee.value;
    var mois = document.formulaire.mois.value;
    var rentre = document.formulaire.rentre2.value;
    copierGlobal = "";
    clique=1;

    var xhr = null;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {	//Si etape 4 terminé. Serveur renvoie les données en reponse de affichertableau()

            if (xhr.status == 400) {	//si la reponse côté serveur renvoie une erreur
                switch (xhr.statusText) {
                    case 'MONTH_EXIST' : alert("Le mois existe déjà pour cette année"); 
                }
                 document.getElementById('afficherTableau').innerHTML = xhr.responseText; 
            } else {
   
                //document.getElementById("infoBulle").style.visibility = "visible";
                document.getElementById('afficherTableau').innerHTML = xhr.responseText; //injecte le code html
        
                $(document).ready(function() {
                     $('#infoBulleBox').hide(); 
                     $( "#infoBulleBox" ).fadeIn("slow");                 
                });
           
            }
        }else   document.getElementById('afficherTableau').innerHTML = "<center><img src='"+chargement+"'</center>";
    }

    copier = encodeURIComponent(copier);//encodage pour envoyer les caracteres speciaux & ou autre

    xhr.open("POST",'../vueControll/form_controller', true); //ouverture de la connexion en post
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	//obligatoire pour le post
    xhr.send("copier=" + copier + "&annee=" + annee + "&action=5" +  "&mois=" + mois + "&rentre=" + rentre);	//envoie des donnees en post

    document.formulaire.copier.value = "";
    document.formulaire.mois.value = "";
    document.formulaire.rentre2.value = "";
    document.forms["formulaire"].elements["oui"].checked = false;

    rentreGlobal = 0;
    sommeGlobal = 0;
}*/