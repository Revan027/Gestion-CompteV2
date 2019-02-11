<?php

class transform {

    public function __construct(){      //init du constructeur. Obligatoire
        
       
    }
    
    
    public function transformation($tab) {
        
        $libExplode2 = array();

            for($i=0;$i<count($tab);$i++){  

                $libExplode = explode(" ", urldecode ( preg_replace("#[^a0-zA-Z9]#", " ", $tab[$i])));   //fragmente en mot clefs et supprime les caractere speciaux
                
                if(isset($libExplode[1])){

                    if(strlen($libExplode[0])<3){
                        
                        if((strlen($libExplode[1])<=3) && (isset($libExplode[2]))){
                          
                            $libExplode[2] = preg_replace('/\-?\d+/', '', $libExplode[2]);
                            array_push($libExplode2, $libExplode[0]." ".$libExplode[1]. " ".$libExplode[2]); //recupération et formation d'au moins 2 mots clef
                            
                        }else{
                            
                            array_push($libExplode2, $libExplode[0]." ".$libExplode[1]); //recupération et formation d'au moins 2 mots clef
                        }
                        
                    }else{
                        
                        $libExplode[0] = preg_replace('/\-?\d+/', '', $libExplode[0]);
                        $libExplode[1] = preg_replace('/\-?\d+/', '', $libExplode[1]);
                        array_push($libExplode2, $libExplode[0]." ".$libExplode[1]); //recupération et formation d'au moins 2 mots clef
                    }
  
                } else {

                   array_push($libExplode2, $libExplode[0]);   //array_push : ajoute une nouvelle données dans le tableau

                } 
            }
          
           return $libExplode2;
       
    }
}
 /*foreach ($this->valeur as $value) {
            echo $value->valeur;     //tableau d'objet. A afficher avec -> pour acceder a l 'objet
        }
        foreach ($this->categ as $value) {
            echo $value->libelle;
        }*/