<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Accueil  extends MY_Controller{

    public function __construct(){
        
        parent::__construct(); 
    }

    public function index(){ 

        switch($_POST['action']){
            
            case '1':
            $this->deleteTab();
            break;

            case '2':
            $this->updateTab();
            break;

            case '3':
            $this->updateGraph();
            break;

            case '4':
            $this->changeCompte();
            break;

            case '5':
            $this->gestionXML();
            break;

            case '6':
            $this->addData();
            break;
        
            case '7':
            $this->showCamembert();
            break;
        
            default :
            redirect('./accueil/mainPage');
            break;
        }
    }  

    
    
    
    
    
    private function updateTab(){   //mise a jour du tableau d'annee

            $data = array();
            $data2 = array();

            $data['compte'] = $this->session->userdata('compte');//recupération du compte en cours pour passage vers le view
            $name = $this->session->userdata('compte');
            $this->load->model('vueModel/resumeCompte_model');
            $this->resumeCompte_model->setTable($name); //changement de la table

            $data['select_annee'] = $_POST['annee'];      

            $data['annees'] = $this->resumeCompte_model->getAnnee();
            $data2['tableau'] = $this->resumeCompte_model->getTableau($data['select_annee']);
            $data2['taille'] = $this->resumeCompte_model->count($data['select_annee']);

            $this->load->view('vue/currentCompte',$data);
            $this->load->view('vue/annee',$data);
            $this->load->view('vue/tableau',$data2);
        
    }

    
    
    
    
    private function deleteTab(){   //supprime une entrée du tableau
     
        $data = array();

        $data['compte'] = $this->session->userdata('compte');//recupération du compte en cours pour passage vers le view
        $name =$this->session->userdata('compte');

        $this->load->model('vueModel/resumeCompte_model');
        $this->resumeCompte_model->setTable($name); //changement de la table
      
        $id = $_POST['id'];
        $this->resumeCompte_model->delete($id);
        $this->chartCateg->delete($id);  
        $this->updateTab($_POST['annee']);
         
    }

    
    
    
    
    private function updateGraph(){   //met a jour le graph

        $data = array();

        $data['compte'] = $this->session->userdata('compte');//recupération du compte en cours pour passage vers le view
        $name =$this->session->userdata('compte');

        $this->load->model('vueModel/resumeCompte_model');
        $this->resumeCompte_model->setTable($name); //changement de la table

        $data['select_annee'] = $_POST['annee'];

        $data['annees'] = $this->resumeCompte_model->getAnnee();
        $data['tableau'] = $this->resumeCompte_model->getTableau($data['select_annee']);
        $data['taille'] = $this->resumeCompte_model->count($data['select_annee']);

        $data['compte'] = $this->session->userdata('compte');

        $this->load->view('vue/currentCompte',$data);
        $this->load->view('vue/chart',$data);
        
    }
        



    
    private function changeCompte(){   //met a jour le graph

        $this->session->set_userdata('compte',$_POST['name']); 
        $session_id = $this->session->userdata('compte');

        $this->updateTab($_POST['annee']);

    }
        



    
    private function gestionXML(){
               
        $param = array (
            'location'  => $this->users->getLocation()
        );

        $this->load->library('generate_xml/file',$param);  
        $fichier = $this->file->findFile();

        if($fichier != null){

            $this->parse->parserFile($fichier); //parsage du fichier
            $valeur = $this->parse->getValeur(); //recupération du parsage
            $date = $this->parse->getDate();
            $libelle =  $this->parse->getLibelle();

            $annee = $_POST['annee'];
            $mois = "".$this->xml->trierMois($_POST['mois']).""; //transformation du mois en chiffre
  
            $dateCentrale = $annee.'/'.$mois.'/'.$this->users->getIntervalle();     //date centrale


            $this->xml->set($valeur,$date,$libelle);    //creation objet xml
            $this->xml->createXML($dateCentrale);   //creation fichier xml
              
            if($this->xml->readXML() == true){
                
                $read_xml['xml'] = $this->xml->getValXML();
                $read_xml['libelle'] = $this->xml->getLibelleXML();
                $read_xml['date'] = $this->xml->getDateXML();
                $read_xml['entreprise'] = $this->users->getNameEntreprise();

                $this->load->model("comptes/compte_model");

                $this->load->view('vue/intervalle',$read_xml);
             }

        }else{

            echo 'Aucune extension de fichier ofx trouvée';

        }
        
    }
      
   
   
   
   
   
    private function addData(){
       
        $data['compte'] = $this->session->userdata('compte');//recupération du compte en cours pour passage vers le view
        $name = $this->session->userdata('compte');

        $this->load->model('vueModel/resumeCompte_model');
        $this->resumeCompte_model->setTable($name); //changement de la table

        $intervalle = $_POST['intervalle'];

        $tableauCateg = $this->xml->calculXML($intervalle);

        $data = array( 
            'annee' =>  $_POST['annee'],   
            'mois' => $_POST['mois'],
            'numMois' =>$this->xml->trierMois($_POST['mois']),
            'salaire' => $this->xml->getRentre_argent(),
            'depense'=> $this->xml->getDepense(),
            'benefice' => $this->xml->getBenefice()
        ); 

        $result = $this->resumeCompte_model->getMois( $_POST['annee'],$_POST['mois']);

        if(count($result) === 0){

            $this->resumeCompte_model->set($data); 
            $this->resumeCompte_model->add();

            
            
            
            
            
            /******Partie ajout pour la catégorisation********/
            
            
            $id = $this->resumeCompte_model->getId(); //retourne un tableau d'objet, à acceder avec son index et ->
            
            $libExplode2 = $this->transform->transformation($tableauCateg['libelle']);
            
            
            $data2 = array( 
                'libelle' =>$libExplode2
            );
             
            $this->wordKey->set($data2);
            
            $query = $this->wordKey->getCount();
            $taille;
            
            foreach ($query->result_array() as $tab) 
            {                   
                $taille = $tab["COUNT(*)"];             
            }
            
            $this->wordKey->add($taille);
                       
            $data2 = array( 
                'id_compte' => $id[0]->id, 
                'valeur' => $tableauCateg['valeur'],
                'libelle' =>$libExplode2,
                'table' =>$this->resumeCompte_model->getTable()
            );
           
            $this->chartCateg->set($data2);
            $this->chartCateg->add();
              
            $this->updateTab($_POST['annee']);
          
        }else{
            
           echo "MONTH_EXIST";
        }
        
   }
   
   
   
   
   
    private function showCamembert(){  
        
        $this->load->model('vueModel/resumeCompte_model');
        $param = array();
        
        $compte =  $this->session->userdata('compte');
        $this->resumeCompte_model->setTable($compte);
        $param['result_query'] = $this->resumeCompte_model->getSDB($_POST['id']);
        $query = $this->chartCateg->getSum($_POST['id']);
        
        $i = 0;
       
        if(count($query->result_array()) != 0){
            
            foreach ($query->result_array() as $row)
            { 

                $param['libelle'][$i] = $row['libelle'];
                $param['total'][$i] = round($row['total'],2,PHP_ROUND_HALF_UP);

                $i++;
            } 
            
            $this->load->view('vue/chartCateg',$param); //passage d' un tableau associatif . Objet possible a passer. Tableau d 'objet associatif aussi
        
            
        }else{ 
            
            echo "DATA MISSED";
            
        }
        
      
        
    }

}
    
        
      /* private function addData(){
                 
                 $is_active = $this->sessionIsActive();
            
                if($is_active){
                    

                    $data['compte'] = $this->session->userdata('compte');//recupération du compte en cours pour passage vers le view
                    $name =$this->session->userdata('compte');
                    
                    $this->load->model('vueModel/resumeCompte_model');
                    $this->resumeCompte_model->setTable($name); //changement de la table

                    $numMois = $this->fonctcalculate->trierMois($_POST['mois']);
                    $rentreArgent =  $_POST['rentre']; //recupère donnees du formulaire

                    $rentreArgent = str_replace(",", ".",$rentreArgent);
                    $rentreArgent = str_replace(' ', '',$rentreArgent); //remplace l'espace du milier par rien

                    $tableauDesNombres = $this->fonctcalculate->renvoieTableauDesNombres($_POST['copier']); //retourne un tableau avec chaque depnse trier
                    $depense =  $this->fonctcalculate->renvoieDepense($tableauDesNombres);   //calcule de la somme des depenses
                    $benefice = ($rentreArgent - $depense);   //calcule du bénéfice	

                    $data = array( 
                        'annee' =>  $_POST['annee'],   
                        'mois' => $_POST['mois'],
                        'salaire' => $rentreArgent,
                        'depense' => $depense,
                        'benefice' => $benefice,
                        'numMois' => $numMois 
                    ); 
                    
                    $result = $this->resumeCompte_model->getMois( $_POST['annee'],$_POST['mois']);
                    
                    if(count($result) === 0){
                        
                        $this->resumeCompte_model->set($data); 
                        $this->resumeCompte_model->add();
                        $this->updateTab( $_POST['annee']);
                        
                    }else{
                        header("HTTP/1.1 400 MONTH_EXIST");
                        $this->updateTab( $_POST['annee']);
                    }
                    
                }    
                
            }*/
            

        