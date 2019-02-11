<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainPage extends MY_Controller {  
    
    public function __construct(){  //a chaque objet créer
        
        parent::__construct(); 
    }
    
    public function index() {  //si pas de focntion appeler
        
        $this->view();
            
    } 
	  
   
    private function view() { 
        
        $this->load->model('comptes/compte_model');

        $data = array();
        $data['tableau']=$this->compte_model->get_all(); 
        
        $this->load->view('main/declare');
        $this->load->view('main/top'); 
        $this->load->view('main/menu',$data);
        $this->load->view('main/midlle');
        $this->load->view('main/footer');
    }
    
    
} 
    

