<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class MainDepense extends MY_Controller {

        public function __construct(){
            //	Obligatoire
            parent::__construct();

        }

        public function index(){

            if(isset($_POST['nameDp']) && isset($_POST['sommes'])){  //ajout de donnéees

                $data = array('libelle' => $_POST['nameDp'],'somme' => $_POST['sommes']);
                $this->load->model('mainDepenseModel/mainDepense_model');

                $this->mainDepense_model->set($data); 
                $this->mainDepense_model->add(); 

                $this->recalcul_controll();

                $this->viewPage_controll();

            }else if(isset($_POST['id'])){   //suppression de donnéees 

                $data = array();

                $this->load->model('mainDepenseModel/mainDepense_model');

                $this->mainDepense_model->delete($_POST['id']); 

                $this->recalcul_controll();

                $this->viewPage_controll();

            }else if(isset($_POST['salMoyen'])){ //mise a jour de la rentré d'argent

                $data = array();

                $this->load->model('mainDepenseModel/salaireMoyen_model');

                $this->salaireMoyen_model->set($_POST['salMoyen']); 
                $data['total'] = $this->salaireMoyen_model->getTotal();
                $this->salaireMoyen_model->update($data['total']);

                $this->recalcul_controll();

                $this->viewPage_controll();

            }
            else if($this->input->is_ajax_request()){    //si user vient de la requete ajax, arrivé dans la page

               $this->viewPage_controll();
            }
            
        }

        private function viewPage_controll(){ //affichage de la page  

            $data = array(); 
            $data2 = array(); 

            $this->load->model('mainDepenseModel/mainDepense_model');
            $this->load->model('mainDepenseModel/salaireMoyen_model');

            $data2['tableau'] = $this->mainDepense_model->get_all();
            $data2['taille'] = $this->mainDepense_model->count();
            $data2['tableau2'] = $this->salaireMoyen_model->get_all(); 
            
            $this->load->view('vue/mainDepenseHaut',$data2);
            
          
        }

        private function recalcul_controll() {  //controlle du recalcule du total des dépenses

            $this->load->model('mainDepenseModel/salaireMoyen_model');
            $this->load->model('mainDepenseModel/mainDepense_model');

            $data =array();

            $data['tableau'] = $this->mainDepense_model->get_all();
            $data['tableau2'] = $this->salaireMoyen_model->get_all();

            $this->salaireMoyen_model->updateTotal($this->fonctcalculate->calcul_somme($data));
        }
   
    }          