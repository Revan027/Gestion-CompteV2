function choice() {
    
    if($("#deleteCheck").is(":checked")){
        
       deleteCategorie();
       
    }else{
        
        addCategorie();
    }
     
}

    
function updateLibelleWordkey(element){
    
   /* var id = $(element).parent().prop('id');
    var libelle = $(element).val();
     
    $.ajax({
       url : './accueil/updateLibelle', 
        type : 'POST',
        dataType : 'html', 

            data: {
               id:id,
               libelle: libelle
            },

            success: function (data) {
               $(element).val(libelle);

            }
    });*/
    
}

function updateWordKey(){

    var idCategorieS={b: []};   //format pour serializer
    var idWordKeyS = {a: []};

 
    $(".categSelect").each(function( index ) {  //parcours les SELECT categSelect par leur index
        
        //console.log( index + ": " + $("#"+id+" option:selected" ).prop('id') );
        var idCategorieParse = $("#a"+index+" option:selected" ).prop('id');
        idCategorieS.b.push(idCategorieParse);  //ajoute une données a la suite du tableau

        var idWordKey =  $( this ).prev().prev().prop('id');  //recupere l'element DOM précédent
        //alert(libelle + idCategorieParse);
        //console.log($( this ).prev().prev().children().val());
        idWordKeyS.a.push(idWordKey);   //ajoute une données a la suite du tableau, corespondance entre l'id de la categorie grace aux meme index pour les 2 tableaux

    });
    
    idCategorieS = $.param( idCategorieS);  // $.param serialize
    idWordKey = $.param(idWordKeyS); 
        
    $.ajax({
        url : './accueil/update', 
        type : 'POST',
        dataType : 'html', 

            data: {
               idCategorie:idCategorieS,
               idWordKey: idWordKey
            },

            success: function (data) {
                
                redirection(data);
                
                if(data === "Rien à catégoriser"){
                    
                    alert('Rien à catégoriser'); 
                    window.location.replace("./accueil");
                    
                }else{
                    alert('Catégorisation réalisée'); 
                    $('#centre3').html(data);
                    
                }
               
              
            }
    }); 
}

function addCategorie() {  //ajout 
   
    var nom_categ = $('#nom_categ').val();
    
    if(nom_categ!=='' ){
        
        $.ajax({
            url : './accueil/addCateg', 
            type : 'POST',
            dataType : 'html', 

                data: {
                    nom_categ: nom_categ
                },
                
                success: function (data) {
                    alert('Catégorie créer');
                    redirection(data);
                    $('#centre3').html(data);
                }
        });
        
    }else{
        alert('Entrée vide !');
    }
 }

 
function deleteCategorie() {  //supp
   
    var id = $( "#categ option:selected" ).prop('id');

    $.ajax({
        url : './accueil/deleteCateg', 
        type : 'POST',
        dataType : 'html', 

            data: {
               id: id
            },

            success: function (data) {
               alert('Catégorie supprimer');
               redirection(data);
               $('#centre3').html(data);
            }
    });
        
    
 }
 
   
    function closeChartCateg(){  
        
        $( "#containChart" ).remove();
        $( "#bigContain" ).remove();
        
        /*$('#mainConteneur').animate({blurRadius: -3}, {
            duration: 1500,
            easing: 'swing', // or "linear"
                             // use jQuery UI or Easing plugin for more options
            step: function() {
              
                $('#mainConteneur').css({
                    "-webkit-filter": "blur("+this.blurRadius+"px)",
                    "filter": "blur("+this.blurRadius+"px)"
                });
            }
        }).queue(function(){
            
            $('#boxH').css({
                "z-index": 12
                });$(this).dequeue();
        });*/
    }
 
    function showChartCateg(id) { 

        $.ajax({
            url : base_url+'main/accueil', 
            type : 'POST',
            dataType : 'html', 

            data: {
                action:7,
                id:id
            },

            success: function (data) {
               
                redirection(data);
                
                if(data === "DATA MISSED"){
                    
                    alert("Données manquantes")
                }else{
                    
                    $( "body" ).append( "<div id='bigContain' ></div>");
                
                    $( "body" ).append( "<div id='containChart' > <i class='fa fa-times-circle' style='float:right; color:white;' aria-hidden='true' onclick='closeChartCateg();'></i>"+data+"  </div>" ); 
                    
                }
               /* $( "#mainConteneur" ).animate({blurRadius: 3}, {
                    
                    duration: 1500,
                    easing: 'swing', // or "linear"
                                     // use jQuery UI or Easing plugin for more options
                    step: function() {
                        

                        $('#mainConteneur').css({
                            "-webkit-filter": "blur("+this.blurRadius+"px)",
                            "filter": "blur("+this.blurRadius+"px)"
                        });
                    }
                    
                 });*/
 
              
               
            }
        });
   
    
  

    
}
