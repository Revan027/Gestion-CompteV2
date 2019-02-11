<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class file {
     
    private $name = '';
    private $location = '';
    
    public function __construct($name = ''){ 
        
       $this->location = $name['location'];
  
    }
    
    
    /*
    * contrôle l'extension des fichiers
    * 
    * @return boolean
    */
    private function verifExtension(){
        
        $extension = pathinfo($this->name, PATHINFO_EXTENSION); //recupere l'extension du fichier
        
        if( $extension == 'ofx'){
            
            return true;
            
        }else{
            
            return false;
        }
    }
    
    /*
    * trouve le dernier fichier enregistrez
    * 
    * @return string
    */
    public function findFile(){
        
        $list_file_complet = array();   //liste des fichiers avec leurs nom complet
        $list_file = array();   //liste des fichiers tronqués
        
        if ($dir = opendir($this->location)) {  //ouverture du répertoire

            while($file = readdir($dir)) { //parcours du repertoire et avancé du pointer tant que il ya des fichiers

                $this->name = $file;

                if($this->verifExtension() == true){
                    
                    $list_file_complet[] = $this->name;
                    $file = substr ($this->name,2,8); //extraction de la date
                    
                    $date = new DateTime($file);   //convertion en date
                   
                    $list_file[] = $date->format("Y-m-d");
                    
                }

            }
            closedir($dir);
        }
         
        $grand; //la plus grande date
        $index = 0; //l'index pour la liste des fichiers avec leurs nom complet coresspondant a celui des fichiers tronqués
        
        for($i=0;$i<count($list_file);$i++){
             
            if(isset($list_file[$i+1]) ){
                
                $grand = $list_file[$i];
                
                if(strtotime($list_file[$i]) < strtotime($list_file[$i+1])){
                 
                    $grand = $list_file[$i+1];
                    $index = $i+1;
                
                }else {

                    $grand = $list_file[$i];
                    $index = $i;

                }
                
            }
            
        }
        
        if(count($list_file_complet) == 0){
            
            return null;
            
        }else{
            
            return $list_file_complet[$index];
            
        }
        
   
        //print_r($list_file); affichage d'un array
    }

}
