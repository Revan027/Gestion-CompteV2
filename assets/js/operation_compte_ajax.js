function addCompte() {  //ajout d'un compte
    clique = 1;
    var nom_compte = $('#nom_compte').val();
   
    if(nom_compte!=='' ){
        
        $.ajax({
             url : base_url+'accueil/addCompte', 
             type : 'POST',
             dataType : 'html', 

                data: {
                    nom_compte: nom_compte
                },
                success: function (data) {
                    
                    alert('Compte créer');
                    redirection(data);
                    $('#centre3').html(data);
               }
        });
        
    }else{
        alert('Entrée vide !');
    }   
    

 }


function getCompte(name,annee) {    //recuperation des differents comptes
    clique = 1;
    deroulement=0;
    
    $( "#afficherTableau" ).fadeOut("slow",function(){
        $('#afficherTableau').html("<center><img src='"+chargement+"'</center>").fadeIn();
        
        $.ajax({
             url : base_url+'main/accueil', 
             type : 'POST',
             dataType : 'html', cache: false,

                data: {
                    name: name,
                    annee: annee,
                    action: 4
                },
                success: function (data) {
                    
                    redirection(data);
                    
                    $('#afficherTableau').fadeOut("slow",function(){
                        
                       $('#accordeon').slideUp("normal");  
                       $('#afficherTableau').html(data).fadeIn("slow");
                       
                   }); 
                

            }
        });
        
    }); 

 }