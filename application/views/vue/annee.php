<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html; charset=utf-8"); 

    echo "<div id='boxH2'><i class='fa fa-arrow-down  fa-2x' aria-hidden='true'></i> Visualisation par année/mois en tableau</div><br/>";
    
    echo " <table CELLPADDING= '1' cellspacing='0' id='table1'> 
            <tr>";
                foreach ($annees as $annee) 
                { 
                    if($annee->annee==$select_annee){
                        echo " <td class='fondA_select' id='".$annee->annee."' onclick='viewTabAjax((this.id))'> ". $annee->annee." </td>";    
                    }else{
                        echo " <td class='fondA' id='".$annee->annee."' onclick='viewTabAjax((this.id))'> ". $annee->annee." </td>";
                    }
                } 
       echo "</tr>
    </table>";
