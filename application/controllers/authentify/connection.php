<?php


class connection extends CI_Controller {  
    
    public function __construct(){  //a chaque objet créer
        
        parent::__construct(); 
    }
    
    public function index() {  //si pas de focntion appeler
        
       $user = $this->session->userdata("user");
        
        if($user == null){    //si la session existe pas ou plus
            
            $this->load->view('main/log');
            
        }else{
            
            redirect('./');
            
        }
    }
    
    
    
    
    
    
    /*
    *  redirige en fonction du resultat de l'authentification
    * 
    * @
    */	
    public function controll() { 
        
        $user = $this->session->userdata("user");
        $data = array();
        
        $this->load->model('sessionModel/session_model');
        $data['log']=$this->session_model->userLog($_POST['login']);
              
        if($this->session_model->verifyMdp($data['log'],$_POST['mdp']) ){
 
            $newdata= $this->user->createUser($_POST['login']);
            $this->sessionUser($newdata);
            
            redirect('./accueil/mainPage'); //redirection sur l index de la page pour gérer les rafraichissement
            $this->view();  //affichage de la page
           
        }else{
            redirect('./accueil/mainPage');
        }
    }
    
    
    
    
    /*
    * creation des sessions
    *
    * @access    private
    * @return    void
    */
    private function sessionUser($newdata) {
        
        $this->session->set_userdata("user",$newdata);
        $this->session->set_userdata('compte', 'compte_courant'); //compte par default
        
    }
}
