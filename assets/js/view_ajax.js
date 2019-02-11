
function viewTabAjax(annee) {
  
    clique = 1;
    case_checked = 0;
    $("input[name=check]").prop("checked",false); 
    closeInter();

    $('#afficherTableau').html("<center><img src='"+chargement+"'</center>").fadeIn();

    $.ajax({
        url : '../main/accueil', // La ressource ciblée
        type : 'POST', // Le type de la requête HTTP
        data:  {
            annee: annee,
            action: 2
        },
        dataType : 'html', // Le type de données à recevoir, ici, du HTML.
        success: function (data) {
         
            redirection(data);
                
            $('#afficherTableau').fadeOut("slow",function(){

               $('#afficherTableau').html(data).fadeIn("slow");

           }); 
            
        }
      
       
    });
  
    
 }



function viewGraphAjax(annee) {

    clique = 1;
    case_checked = 0;
    $("input[name=check]").prop("checked",false); 
    closeInter();

    $.ajax({

         url : '../main/accueil', // La ressource ciblée
        type : 'POST', // Le type de la requête HTTP
        data:  {
            annee: annee,
            action:3
        },
        dataType : 'html', // Le type de données à recevoir, ici, du HTML.
        success: function (data) {

            redirection(data);

            $('#afficherTableau').html(data);

        }
    
    });
    
    
 }
 
 
 function viewMainDepense() {

    clique = 1;
    case_checked = 0;
    $("input[name=check]").prop("checked",false); 
    closeInter();

    $( "#afficherTableau" ).fadeOut("slow",function(){
        
        $('#afficherTableau').html("<center><img src='"+chargement+"'</center>").fadeIn();
     
        $.ajax({
            url : '../main/mainDepense', // La ressource ciblée
            type : 'POST', // Le type de la requête HTTP
            dataType : 'html', // Le type de données à recevoir, ici, du HTML.
             
            success: function (data) {
                
                redirection(data);
                              
                $('#afficherTableau').fadeOut("slow",function(){

                    $('#afficherTableau').html(data).fadeIn("slow");

                }); 
                
            }
        });
    }); 

 }
 
 