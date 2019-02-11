<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo "<div id='boxH2'> <i class='fa fa-arrow-down' aria-hidden='true'></i> Graphique par année/mois </div><br/>";

echo " <table CELLPADDING= '3' cellspacing='0' id='table1'> ";
   echo " <tr>";
        foreach ($annees as $annee) 
        { 
            if($annee->annee==$select_annee){
                echo " <td class='fondA_select' id='".$annee->annee."' onclick='viewGraphAjax((this.id))'> ". $annee->annee." </td>";    
            }else{
                echo " <td class='fondA' id='".$annee->annee."' onclick='viewGraphAjax((this.id))'> ". $annee->annee." </td>";
            }
        } 
       
     echo "</tr>
</table>"; ?>

<div id='contain'>
   <canvas id='myChart'></canvas>
</div>

<script>
           

    var myContext = document.getElementById("myChart");
    var myChartConfig = {
         
    type:"line",
        data:{
            labels:[
                        <?PHP for($i=0;$i<$taille;$i++)
                            {
                                if($i==($taille-1)){
                                   ?> " <?PHP echo $tableau[$i]->mois; ?>  " <?PHP
                                }else{
                                   ?> " <?PHP echo $tableau[$i]->mois; ?>  ",
                         <?PHP  }
                            }
                        ?>
                    ],
                        
            datasets:[
                        {
                            label:"Dépense",
                            data:[ 
                                    <?PHP for($i=0;$i<$taille;$i++)
                                            {
                                                if($i==($taille-1)){
                                                    echo $tableau[$i]->depense; 
                                                }else{
                                                    echo $tableau[$i]->depense; ?> ,<?PHP 
                                                }
                                            }
                                        ?>
                            ],
                            fill:true,
                            borderColor:"red",
                            lineTension:0.2
                        },
                        {
                            label:"Salaire",
                            data:[ 
                                    <?PHP for($i=0;$i<$taille;$i++)
                                            {
                                                if($i==($taille-1)){
                                                    echo $tableau[$i]->salaire; 
                                                }else{
                                                    echo $tableau[$i]->salaire; ?> ,<?PHP 
                                                }
                                            }
                                        ?>
                            ],
                            fill:true,
                            borderColor:'blue',
                            lineTension:0.1
                        },
                         {
                            label:"Benefice",
                            data:[ 
                                    <?PHP for($i=0;$i<$taille;$i++)
                                            {
                                                if($i==($taille-1)){
                                                    echo $tableau[$i]->benefice; 
                                                }else{
                                                    echo $tableau[$i]->benefice; ?> ,<?PHP 
                                                }
                                            }
                                        ?>
                            ],
                            fill:false,
                            borderColor:'green',
                            lineTension:0.1
                        }
                    ]
            
        },
        
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }};
  
    var myChart = new Chart(myContext, myChartConfig);
</script>
