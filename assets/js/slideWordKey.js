
$(document).ready(function() {  // deroulement pour l'affichage des comptes

    $('.titreCategory').click( function (e) {

     e.preventDefault(); // prévient l'exécustion du comportement par défaut
        if($(this).next().hasClass('active')){ //si la prochaine div est active

            $("#grillAlone").find("div").each(function() {  //trouve les div et parcours si active

                if($( this ).hasClass('active')){   //si active on ferme
                    $( this ).removeClass("active");
                    $( this ).slideUp();
                }
            });

        }else{

            $("#grillAlone").find("div").each(function() {

                if($( this ).hasClass('active')){ 
                    $( this ).removeClass("active");
                    $( this ).slideUp();
                }
            });

            $(this).next().addClass( "active" );
            $(this).next().slideDown("normal");
        } 
    });   
}); 