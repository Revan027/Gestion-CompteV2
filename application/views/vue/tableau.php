<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html; charset=utf-8"); 

 echo "<div id='contain' style='padding:10px 0px 10px 0px; '>

    <div class='titreMois'>Mois 
        <i class='fa fa-arrow-left' aria-hidden='true'  onclick='slideAv();'></i>
       
        <i class='fa fa-arrow-right' aria-hidden='true'  onclick='slideAr( ".$taille.");'></i>
    </div> ";

    echo "<div class='suppConteneurMois'> 
            <div class='sousConteneur'>"; 
                $i=0;
                $benefAnnu = 0;

                foreach ($tableau as $tab) 
                { 
                        echo " <div class='libelleMois' id='lib0".($i+1)."'>";
                        $i=$i+1;
                        echo $tab->mois; 
                            echo "<i class='fa fa-times-circle' aria-hidden='true' onclick='confirmation(".$tab->id.",".$tab->annee.")'></i>
                            </div>";
                }
                $i=0;    
    echo"    </div>
         </div>";
    
     echo"<div class='titreValeur2'>Revenues</div>
     <div class='suppConteneur2'>
         <div class='sousConteneur'>";
            foreach ($tableau as $tab) 
            { 
                echo " <div class='valeur' id='lib1".($i+1)."' >".$tab->salaire."</div>"; 
                $i=$i+1;
            }
            $i=0; 
          echo "</div>
    </div>";

    
    
     echo" <div class='titreValeur1'>Dépenses</div>
    <div class='suppConteneur'>
        <div class='sousConteneur'>";
            foreach ($tableau as $tab) 
            {
                echo" <div class='valeur' id='lib2".($i+1)."'>".$tab->depense."</div> "; 
                $i=$i+1;
            } 
            $i=0;
        echo" </div>
    </div>

    <div class='titreValeur2'>Bénéfices</div>
    <div class='suppConteneur2'>
        <div class='sousConteneur'> "; 
            foreach ($tableau as $tab) 
            { 
                if($tab->benefice<=0)
                { 
                    echo" <div  class='valeur_neg' id='lib3".($i+1)."'>".$tab->benefice."</div>  ";
                    $i=$i+1;
                }
                else
                {    
                    echo "<div class='valeur_pos' id='lib3".($i+1)."'>".$tab->benefice."</div> ";
                    $i=$i+1;
                }
                 $benefAnnu = $benefAnnu + $tab->benefice; 
            }
            $i=0; 
          echo "</div>            
    </div>";

          
    echo"<div class='titreValeur1'>Graphique</div>
     <div class='suppConteneur'>
         <div class='sousConteneur'>";
            foreach ($tableau as $tab) 
            { 
                echo "<div class='valeur' id='lib4".($i+1)."'> <i class='fa fa-pie-chart' onclick='showChartCateg(".$tab->id.")' aria-hidden='true'></i></div>";
                $i=$i+1;   
            }
          echo "</div>
    </div>";  


          
        if($taille<=6)
        {
            $tailleBenefB = $taille*120.4;

        }
        else
        {
            $tailleBenefB = 6*120.9;
        }
      /*<div  style=" width:<?= $tailleBenefB ?>px"> <center><?= $benefAnnu ?></center>    </div> */

     echo "<div class='titreValeur3'>Bénéfice Annuelle </div>
    <div class='suppConteneurBenefA'><div class='blockBenefA'> <center> ";
     
        if($benefAnnu<=0)
        { 
            echo"<div  class='valeur_neg_benefA'>".$benefAnnu."</div>  ";
            
        }else{
            echo" <div  class='valeur_pos_benefA'>".$benefAnnu."</div>  ";
        }
  
     echo" </center></div></div> "
        . "</div> ";