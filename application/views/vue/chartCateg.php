<?php defined('BASEPATH') OR exit('No direct script access allowed');    
?>
<?PHP  $taille = count($libelle); ?>

<div id='titleLegend' style='background-color: rgba(121, 87,96,0.7);'><?PHP foreach ( $result_query as $row)
                                    { 
                                      echo $row->mois;
                                    } ?>
</div>
<div id='titleLegend' style='background-color: rgba(156, 148,174,0.7); '>Revenues : <?PHP foreach ( $result_query as $row)
                                    { 
                                      echo $row->salaire;
                                    } ?> euros
</div>

<div id="chartjs-legend" class="noselect"></div>

<canvas id='myChart'  width="800" height="500"></canvas>

<script>
     function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }
    
    var ctx = document.getElementById("myChart").getContext('2d');

    var myContext = document.getElementById("myChart");
    
    
    var myChart = new Chart(ctx, {
    
        type:"doughnut",
            data: {
    
                labels: [
                        <?PHP   for($i=0;$i<$taille;$i++){

                                    ?> " <?PHP echo $libelle[$i]; ?>  ",

                            <?PHP  
                                }?>
                                
                                "Bénéfices"

                ],
                datasets: [{
                        label:"MY", 
                        data: [
                             <?PHP  for($i=0;$i<$taille;$i++){

                                     ?> " <?PHP echo $total[$i]; ?>  ",

                              <?PHP } ?>
                              
                             "<?PHP foreach ( $result_query as $row)
                                    { 
                                      echo $row->benefice;
                                    }
                           ?>"
                        ],

                        backgroundColor:[
                            
                            <?PHP for($i=0;$i<=$taille;$i++){

                                if($i==($taille)){

                                  ?> "green" <?PHP

                               }else{

                                  ?> "rgba("+getRandomInt(0,255)+", "+getRandomInt(0,255)+","+getRandomInt(0,255)+",0.7)",

                            <?PHP  }
                               }?>

                        ]
                    }]
            },
            
            options: {
            
                animation: {
                    duration: 0
                },
                
                legend: false,
                legendCallback: function(chart) {   //légende personallisée

                    var text = [];
                    text.push('<ul>');  //ajoute dans le tableau chaque entrée a la suite
                  
                    
                    for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        
                        text.push('<li><div style="color:white; display: inline-block;  background-color: ' + chart.data.datasets[0].backgroundColor[i] + '">'+chart.data.labels[i]+'</div></li>');
                      
                    }

                    text.push('</ul>');
                    return text.join("");   //join the elements of an array into a string:
               }
            }          
           
    });
 
$("#chartjs-legend").html(myChart.generateLegend());    //permet de récupérer l'intégralité des légendes
    
var tab =  myChart.data.datasets[0].data.slice(0);

$("#chartjs-legend").on('click', "li", function() { //show, hide, value graph

    myChart.data.datasets[0].data[$(this).index()] =   tab[$(this).index()] - myChart.data.datasets[0].data[$(this).index()] ;
    myChart.update();
    tab[(this).index()] = myChart.data.datasets[0].data[$(this).index()];
    console.log('legend: ' +  myChart);

});
     
</script>