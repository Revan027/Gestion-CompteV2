<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
 

class Accueil extends MY_Controller {
    
    
    public function __construct(){
        
        parent::__construct(); 
        $this->uri->uri_string();
        $uri =  $this->router->fetch_class() . '/' . $this->router->fetch_method();
        //echo $this->uri->segment(1);

        //si on tente d accéder à la fct de traitement ajax depuis l 'url. test si la requete est de l'ajax
        if(($uri === "accueil/addCompte" || $uri === "accueil/deleteCateg" ||  $uri === "accueil/addCateg" ||  $uri === "accueil/update") &&  $this->input->is_ajax_request() != 1){ 
            
           redirect('./config/accueil');
           
        }
    }
    
    
    public function index() { 
        
        $this->view();
        
    } 
     
    
    
   
    
    /*
    * ajoute un nouveau compte
    * 
    * @
    */
    function addCompte(){ 
  
        $this->load->model('comptes/compte_model'); 

        $this->compte_model->create($_POST['nom_compte']); 
        $this->compte_model->set($_POST['nom_compte']); 
        $this->compte_model->add();

        $this->view2();  
    }
    
    

     /*
    * supprime une categorie
    * 
    * @
    */
    function deleteCateg(){ 

        $this->load->model('categorisation/categorie'); 
        $this->categorie->delete($_POST['id']);
        $this->wordKey->updateIfSupp($_POST['id']);
        
        $this->view2();    
    }
    
    
    
    
    
    /*
    * ajoute une nouvelle categorie
    * 
    * @
    */
    function addCateg(){ 

        $this->load->model('categorisation/categorie');     
        $this->categorie->set($_POST['nom_categ']); 
        $this->categorie->add(); 

        $this->view2(); 
    }
    
    
    
    
    /*
    * mise a jour du zoom
    * 
    * @
    */
    function update(){ 
       
        $data['id_categorie']  = $this->unserializeForm($_POST['idCategorie']);
        $data['id_wordKey']  = $this->unserializeForm($_POST['idWordKey']);
      
        $this->wordKey->update($data); 

        $this->view2();           
    }
    
    
   
    
    
    
    /*
    * désérialize la requete http. car envoie de tableau en ajax impossible sans cela
    * 
    * @
    */
    
    private function unserializeForm($str) {
        
        $returndata = array();

        $strArray = explode("&", $str); //explode fragment la chaine dès qu'elle trouve le caractere & du serialize

        for($i=0;$i<count($strArray);$i++){
             
            $returndata[$i] = substr ($strArray[$i],8);    //recupere la chaine apres les b%5B%5D=, d'ou 8
            $returndata[$i] = str_replace ('%20',' ' ,$returndata[$i] );    //remplace le caractere %20 par ' '
        
        }
           return $returndata;
    }
    
    
    
    
    
 


    /*
    * affiche la vue
    * 
    * @
    */
    private function view(){

        $data = array();
        $data['tableau'] = $this->categorie->get_all(); 
        $data['taille'] = $this->categorie->count();
        
        $data['query'] = $this->wordKey->getAll();  
        
        $data['compte'] = $this->session->userdata('compte');
        
        $this->load->view('main/declare');
        $this->load->view('main/top'); 
        $this->load->view('config/menuView');
        $this->load->view('config/accueilView',$data);
        $this->load->view('config/closeDiv'); 
        $this->load->view('main/footer');  
    }
    
    
    
    
    private function view2(){
        
        $data = array();
        $data['tableau'] = $this->categorie->get_all(); 
        $data['taille'] = $this->categorie->count();
        
        $data['query'] = $this->wordKey->getAll(); 
         
        $data['compte'] = $this->session->userdata('compte');
        
        $this->load->view('config/accueilView',$data); 
    }
    

}
