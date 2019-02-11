<?php

class parse {
    
    //variables stokant les informations récupérées du parsage
    private $valeur = array();
    private $date = array();
    private $libelle = array();
    private $i1 = 0;
    private $i2 = 0;
    private $i3 = 0;
    

    
    public function getValeur(){

        return  $this->valeur;
    } 
    
    public function getDate(){

        return  $this->date;
    }

     public function getLibelle(){

        return  $this->libelle;
    }
    
    /*
    * parsage du fichier
    * 
    * @return string
    */
    function parserFile($fichier){
        
        $tab = array();
        
        $fichier = ofx_url($fichier);

        $handle = fopen($fichier, "r" );
        $contents = fread($handle, filesize( $fichier ) );

        $cut = strstr($contents, '<DTPOSTED>',false);     //on garde la partie interessante
        
        $taille = strlen($cut);   //nombre de caractere dans le fichier
        $taille2 = 0;  
        $categorie='';
       
        while($categorie != "/OFX"){
              
            $memory_cut = $cut;   //mise en memoire du premier cut
        
            $positionD = strpos($cut, '<');   //position du premier crochet de debut dans le premier cut
            $positionF = strpos($cut, '>');   //position du deuxieme crochet de fin  dans le premier cut

            $categorie =   substr($cut, $positionD+1, $positionF-1);  //recuperation du nom inscirt entre crochet dans le premier cut
 
            if($categorie === "DTPOSTED" || $categorie === "TRNAMT" ||$categorie === "NAME"){  //si nom correspondant
                //echo  "</br>". $categorie .": ";
                
                $cut = $this->parser($categorie,true,$cut,$taille,$memory_cut);

                $taille2 = strlen($cut);  
                
                }else{
                                      
                    $cut = $this->parser($categorie,false,$cut,$taille,$memory_cut);
                    
                    $taille2 = strlen($cut);
                }

        }
        fclose($handle);
    }



    /*
    * parsage du cut
    * 
    * @return string
    */
    private function parser($categorie,$verif,$cut,$taille,$memory_cut){

        
        if($verif==true){
          
            $positionD = strpos($cut, '>');    //position du premier crochet de fin dans le premier cut +1 pour obtenir la valeur inscrite apres

            $positionF = strpos($cut, '<',1);  //position du prochain crochet dans le premier cut 


            $cut = substr($cut, $positionD+1,($positionF-$positionD)-3); //recuperation de la valeur 
           
                
            for($i=0;$i<(strlen ($cut));$i++){
                //echo $cut[$i];
                
            }
            if($categorie === "TRNAMT"){
                
                $this->valeur[$this->i1] = $cut;
                $this->i1++;
                
            }else if ($categorie === "DTPOSTED"){
                
                $this->date[$this->i2] = $cut;
                $this->i2++;
                
            }else{
                
                $this->libelle[$this->i3] = $cut;
                $this->i3++;
            }

           // echo $this->valeur."</br>";
             
            $cut =  substr($memory_cut, $positionF, $taille);  //on reinitialise le premier cut en recuperant depuis la position du  prochain crochet jusqua la taille du fichier, depuis le premier cut
            return  $cut;
            
        }else{
           
            $positionD = strpos($cut, '<',1);  //position du prochain crochet dans le premier cut  pour obtenir la valeur inscrite avant
   
            $cut =  substr($memory_cut, $positionD, $taille);     //on reinitialise le premier cut en recuperant depuis la position du  prochain crochet jusqua la taille du fichier, depuis le premier cut
            return  $cut;
        }
        
    }

}
