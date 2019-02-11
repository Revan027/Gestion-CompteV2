<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller  extends CI_Controller {    //classe controlant si la session de connection existe en fonction des requetes données

    public function __construct() {
        
        parent::__construct();
        
        $this->controllAccess();
        
        $is_active = $this->sessionIsActive();

        if(!$is_active && $this->input->is_ajax_request() == 1 ){  //si session terminé et que la requete est de l'ajax on stop la requete.
           
            die(); 
            redirect('./authentify/connection');    //redirection vers le système d'authentification
            
        }else if(!$is_active){ //si session terminé et que la requete n'est pas de l'ajax on redirige.
            
            redirect('./authentify/connection'); 
            
        }
      
    }
    
    
    /*
    * test a chaque appelle d'un controlleur si la session est active
    * 
    */
    private function sessionIsActive(){

        $user = $this->session->userdata("user");

        if($user['username'] == null){
            
            return false;

        }else{
            
            return true;
        }
    }
    
    
    
    
    /*
    *
    * 
    */
    private function controllAccess(){

        $this->uri->uri_string();
        //$uri =  $this->uri->segment(1).'/'.$this->router->fetch_class() . '/' . $this->router->fetch_method();
        $uri = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        
        if($this->uri->segment(1) === 'config'){
            
            //test si l'une des uri est acceder et si le moyen d'y acceder n'est pas une requete ajax 
            if(($uri === "accueil/addCompte" || $uri === "accueil/deleteCateg" ||  $uri === "accueil/addCateg" ||  $uri === "accueil/update" ||  $uri === "accueil/updateLibelle") &&  $this->input->is_ajax_request() != 1){ 
            echo ok;
                redirect('./config/accueil');
           
            }
        }
        
    }
    
    
    
    
    
    
    
    protected $_no_access_control = array (
        'accueil/mainPage'
    );

    // Vérifie les authorisations
    private function _check_auth() {
       
        $uri = $this->router->fetch_class() . '/' . $this->router->fetch_method(); // Construction de l'uri
      
       $this->out();
       
        if (  ! in_array($uri, $this->_no_access_control) ){  // Si la personne n'est pas connecté et qu'elle veut aller sur un lien non autorisé
           
        }
    }
    
    
    
    

    // Redirige les requetes non authorisées
    private function out() {
     
       if ( ($this->input->is_ajax_request())!=1 ) {
            redirect('./accueil/mainPage'); 
          
           /* $response = array('status' => 'disconnected');
            echo (json_encode($response));*/
            
       }
       
           
        
    }
    
    
   
}