var clique = 1; //nombre de clique fait qui s'incrémentera


function slideAr(taille){
    //chaque div "lib" contenant les données se voit rajouter un suffixe indiquant son emplacement en numéro
    var v = "#lib0".concat(clique.toString());  //on concatène, le nom de chaque div horizontale contenant les données, avec le nombre de clique fait afin d'identifier les div "lib" a déplacer
    var v2 = "#lib1".concat(clique.toString());
    var v3 = "#lib2".concat(clique.toString());
    var v4 = "#lib3".concat(clique.toString());
    var v5 = "#lib4".concat(clique.toString()); 
    
   var number_possiblity = taille-7;
    
    if((taille>7) && (clique<=number_possiblity)){   //si plus de 6 mois à afficher et que le nombre de clique est inférieur au nombre de clique possible pour faire appaitre le dernier mois 
       
        $(function(){
          
            $(v).animate({marginLeft:-150},300,function(){
                 $(v).hide();
                
            }); 
              
             $(v2).animate({marginLeft:-150},300,function(){
                 $(v2).hide();
                
            }); 
            
            $(v3).animate({marginLeft:-150},300,function(){
                 $(v3).hide();
                
            }); 
            
            $(v4).animate({marginLeft:-150},300,function(){
                 $(v4).hide();
                
            }); 
            
            $(v5).animate({marginLeft:-150},300,function(){
                 $(v5).hide();
                
            }); 
            clique=clique+1;    //incrémentation du nombre de clique fait
         });
         
      
    }
  
}

function slideAv(){

    if(clique !== 1){ //si un clique à été réalisé, c'est que l'on a avancé le slide
        
        clique=clique-1;    //décrémentation jusqu'à l'état initial
        
        var v = "#lib0".concat(clique.toString());
        var v2 = "#lib1".concat(clique.toString());
        var v3 = "#lib2".concat(clique.toString());      
        var v4 = "#lib3".concat(clique.toString());  
        var v5 = "#lib4".concat(clique.toString()); 
        
        $(function(){
            
     
            $(v).show();    
            $(v).stop().animate({marginLeft:0},300);
            
            $(v2).show();    
            $(v2).stop().animate({marginLeft:0},300);
            
            $(v3).show();    
            $(v3).stop().animate({marginLeft:0},300);
            
            $(v4).show();    
            $(v4).stop().animate({marginLeft:0},300);
            
            $(v5).show();    
            $(v5).stop().animate({marginLeft:0},300);
            
        });
        
      
    } 
}

  // $('#lib2').prop('id', 'lib1'); changer id juery