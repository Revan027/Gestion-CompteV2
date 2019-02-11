<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
?> 

<?php
                                   
for($i=0;$i<count($libelle);$i++){
    
    if($i%2 == 0){ 
        
        if(preg_match("/\b$entreprise\b/i",$libelle[$i])==1){
            
            echo "<div id='intervalle-check3'> <input type='checkbox' name='check' value='$i' onClick='getIntervalle();'>";
             
        }else{
            echo "<div id='intervalle-check1'> <input type='checkbox' name='check' value='$i' onClick='getIntervalle();'>";
        }
      
        
    }else if($i==0 || $i==1 || $i!=0){
 
        if(preg_match("/\b$entreprise\b/i",$libelle[$i])==1){
            
            echo "<div id='intervalle-check3'> <input type='checkbox' name='check' value='$i' onClick='getIntervalle();'>";
             
        }else{
            echo "<div id='intervalle-check2'> <input type='checkbox' name='check' value='$i' onClick='getIntervalle();'>";
        }

    }
    if(preg_match("/\b$entreprise\b/i",$libelle[$i])==1){    //compare si entreprise trouvé
        
        echo "
        <span id='date'>".$date[$i]."</span>
        <span id='libelle2'>$libelle[$i]</span>
        <span id='valeur'>".$xml[$i]." euros</span></div><br/>";
        
    }else {
        
        echo "
        <span id='date'>".$date[$i]."</span>
        <span id='libelle'>$libelle[$i]</span>";
        
        if(floatval($xml[$i]) > 0){ 
            
            echo "<span  id='valeur_pos'>".$xml[$i]." euros</span></div><br/>";
            
        }else{
            
            echo "<span id='valeur_neg'>".$xml[$i]." euros</span></div><br/>";
        }  

    }
    
}
