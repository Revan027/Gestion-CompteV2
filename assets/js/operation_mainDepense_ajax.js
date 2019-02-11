function postMainDepense(){
    
        var sommes =  $('#sommes').val();
        sommes = sommes.replace(new RegExp(' ', 'g'), '');
        sommes = sommes.replace(new RegExp(',', 'g'), '.');
        sommes = parseFloat(sommes);	

        $.ajax({
          
           url : base_url+'main/mainDepense', // La ressource ciblée
            type : 'POST', // Le type de la requête HTTP
            data: {
                nameDp: $('#nameDp').val(),
                sommes:sommes
            },
           // Le type de données à recevoir, ici, du HTML.
            success: function (data) {
                
                redirection(data);
                // Je charge les données dans box
                $('#afficherTableau').html(data);
            }
        });
        
}

function deleteMainDepense(id){
        $.ajax({
          
            url : base_url+'main/mainDepense', // La ressource ciblée
            type : 'POST', // Le type de la requête HTTP
            data : {
                id: id
            },
           // Le type de données à recevoir, ici, du HTML.
            success: function (data) {
                
                redirection(data);
                // Je charge les données dans box
                $('#afficherTableau').html(data);
            }
        });
        
}

function showSalaire(){
    
    $('#salMoyen').css({
        visibility : 'visible'
    });

        
}


function postSalaire(){
    
        var salMoyen =  $('#salMoyen').val();
        salMoyen = salMoyen.replace(new RegExp(' ', 'g'), '');
        salMoyen = salMoyen.replace(new RegExp(',', 'g'), '.');
        salMoyen = parseFloat(salMoyen);	
        
        $.ajax({
          
            url : base_url+'main/mainDepense',
            type : 'POST', 
            
            data: {
                salMoyen:salMoyen
            },
         
            success: function (data) {
                
                redirection(data);
                $('#afficherTableau').html(data);
            }
        });

        
}