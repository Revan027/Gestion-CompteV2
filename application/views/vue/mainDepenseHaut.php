<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8");         
?>
<div id='boxH2'> <i class="fa fa-arrow-down" aria-hidden="true"></i> Simulation des dépenses mensuels</div><br/>

<div id='contain'>
    
    <div id="chartjs-legend" class="noselect"></div>
    <div  style='width: 870px; height: 470px; margin:auto;'>
       <canvas id='myChart'></canvas>
    </div>
    
</div>


<script>
    
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }
    
    var ctx = document.getElementById("myChart").getContext('2d');
    
    var id = [] ;
    var i =0;
    <?PHP for($i=0;$i<$taille;$i++){ ?>
       
        id[i] = <?= $tableau[$i]->id; ?>;
        i = i+1;
        
    <?PHP } ?>
    
    var myContext = document.getElementById("myChart");
    
    
    var myChart = new Chart(ctx, {
    
        type:"doughnut",
            data: {
    
                labels: [
                        <?PHP  for($i=0;$i<=$taille;$i++){

                                if($i==($taille)){

                                  ?> " Restant" <?PHP

                               }else{

                                  ?> " <?PHP echo $tableau[$i]->libelle; ?>  ",

                        <?PHP  }
                           }
                        ?>


                ],
                datasets: [{
                        label:"MY", 
                        data: [
                            <?PHP $totalMainDep=0;  ?>
                                        
                            <?PHP for($i=0;$i<=$taille;$i++){

                                if($i==($taille)){

                                  ?> " <?PHP echo  $tableau2[0]->salMoyen-$totalMainDep; ?>   " <?PHP

                               }else{

                                  ?> " <?PHP    $totalMainDep = $totalMainDep +  $tableau[$i]->somme; 
                                                echo $tableau[$i]->somme; ?>  ",

                            <?PHP  }
                               }
                            ?>
                        ],

                        backgroundColor:[
                            
                            <?PHP for($i=0;$i<=$taille;$i++){

                                if($i==($taille)){

                                  ?> "rgba(255,153,0,0.4)" <?PHP

                               }else{

                                  ?> "rgba("+getRandomInt(0,255)+", "+getRandomInt(0,255)+","+getRandomInt(0,255)+",0.7)",

                            <?PHP  }
                               }?>

                        ]
                    }]
            },
                    
            options:{

                legend: false,
                legendCallback: function(chart) {   //légende personallisée

                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend">');  //ajoute dans le tableau chaque entrée a la suite
                  
                    
                    for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        
                        text.push('<li><div style="color:white; display: inline-block;  background-color: ' + chart.data.datasets[0].backgroundColor[i] + '"><i id="'+id[i]+'" class="fa fa-times-circle" aria-hidden="true"></i>'+chart.data.labels[i]+'</div></li>');
                      
                    }

                    text.push('</ul>');
                    return text.join("");   //join the elements of an array into a string:
               }
            } 
    });
    
    $("#chartjs-legend").html(myChart.generateLegend());    //permet de récupérer l'intégralité des légendes
    
    var tab =  myChart.data.datasets[0].data.slice(0);
    console.log(tab);
    
    $("#chartjs-legend").on('click', "li", function() { //show, hide, value graph

        myChart.data.datasets[0].data[$(this).index()] =   tab[$(this).index()] - myChart.data.datasets[0].data[$(this).index()] ;
        myChart.update();
        tab[(this).index()] = myChart.data.datasets[0].data[$(this).index()];
        console.log('legend: ' +  myChart);
        
    });
    
    $(".fa-times-circle").on('click', function() { //show, hide, value graph
        deleteMainDepense($(this).attr('id'));
    });
    
    
    $('#myChart').on('click', function(evt) {
        
        var activePoints = myChart.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];

        if (firstPoint !== undefined) { 
            console.log('canvas: ' + data.datasets[firstPoint._datasetIndex].data[firstPoint._index]);
        } else {
            myChart.data.labels.push("New");
            myChart.data.datasets[0].data.push(1000);
            myChart.data.datasets[0].backgroundColor.push("red");
            myChart.options.animation.animateRotate = false;
            myChart.options.animation.animateScale = false;
            myChart.update();
            $("#chartjs-legend").html(myChart.generateLegend());
        }
        
    });

    $(document).ready(function() {

        ('#myChart').click(function(evt){
            
            var activePoints = myChart.getElementsAtEvent(evt);
            var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
           // alert(activePoints[0]);
            console.log(activePoints);
            
        } );        
    });

</script>
    <div id="containGrill2">
        
        <div id="grill1">
            <div id="step"><b>Enregistrement des dépenses mensuel (impôts, loyer) </b></div>
            <div id="champ">
                Nom de la dépense <input type='text' id='nameDp'/></br></br>
                Somme <input type='text' id='sommes' maxlength='8'/></br></br>
                <input type='button' class='bouton' value='Valider' onclick='postMainDepense();'/>
            </div>
        </div>  

        <div id="grill2">
            <div id="step"><b>Rentrées d'argent mensuel</b> </div>
            <div id="champ">
                Somme <input type='text' id='salMoyen' maxlength='8'/></br></br>
                <input type='button' class='bouton' value='Valider' onclick='postSalaire();'/>
            </div>
        </div>  
    </div>    

