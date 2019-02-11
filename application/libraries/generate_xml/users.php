<?php

class users {
    
    private $name_entreprise = 'sanofi pasteur';
    private $intervalle = '03';
    private $location =  'C:/Users/TOSHIBA/Downloads/';
    
 
    public function getNameEntreprise(){
        
       return $this->name_entreprise;
       
    }
    
    public function getIntervalle(){
        
       return $this->intervalle;
       
    }
    
    public function getLocation(){
        
       return $this->location;
       
    }
}
