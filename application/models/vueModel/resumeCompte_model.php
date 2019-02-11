<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class ResumeCompte_model extends CI_Model
{
    private $table;
    /*variable portant le meme libelle que celle de la table bd*/
    private $annee; 
    private $numMois;
    private $mois;
    private $salaire;
    private $depense;
    private $benefice;
    
    
    public function __construct ()
    {      
        parent::__construct();     
    }
    
    
    
    
    public function setTable($data)   //initialisation des variables
    {
        $this->table =  $data;  
    }
    
    
    public function set($data)   //initialisation des variables
    { 
        $this->annee =  $data['annee'];  
        $this->numMois =   $data['numMois'];
        $this->mois =  $data['mois'];
        $this->salaire =  $data['salaire'];
        $this->depense =  $data['depense'];
        $this->benefice =  $data['benefice'];
    }
    
    
    
    
    function add()
    {  
        $this->db->set('annee',   $this->annee);    //ajout des entrée de la table dans db
        $this->db->set('numMois',    $this->numMois);
        $this->db->set('mois',  $this->mois);
        $this->db->set('salaire',   $this->salaire);
        $this->db->set('depense',    $this->depense);
        $this->db->set('benefice',  $this->benefice);       

        $this->db->insert($this->table);                  
    }
    
    
    
    function addCamembert($data)
    {  
        $this->db->set('exist_camenbert',1);   
        $this->db->where('mois',$data[0]->mois);
        $this->db->where('annee',$data[0]->annee); 
        $this->db->update($this->table);  
    }
    
    
    function getMois($annee,$mois)
    {  
        return $this->db->select('mois')
			->from($this->table)
                        ->where('annee', $annee)
                        ->where('mois', $mois)
			->get()
			->result();             
    }
    
    
    
    function getTable()
    {  
        return $this->table;           
    }
    
    
    
    
    function delete($id) 
    {  
        $this->db->where('id', $id);
        $this->db->delete($this->table);  //supp des entrée de la table
    }
    
    
    
    function getId() 
    {  
        return $this->db->select('id')
			->from($this->table)
			->where('annee',  $this->annee)
                        ->where('mois',  $this->mois)
			->get()
			->result();
    }
    
    
    
    function getAnnee() 
    {  
        return $this->db->select('annee')
                        ->distinct('annee')
			->from($this->table)
			->order_by('annee')
			->get()
			->result();
    }
    
    
    function getTableau($annee)  
    {
        return $this->db->select('id,annee,mois,salaire,depense,benefice')
                        ->distinct('annee')
			->from($this->table)
                        ->where('annee', $annee)
			->order_by('numMois')
			->get()
			->result();
    }
    
    function getSDB($id)  
    {
        return $this->db->select('mois,salaire,depense,benefice')
			->from($this->table)
                        ->where('id', $id)
			->get()
			->result();
    }
    
    function count($annee) 
    {  
        $this->db->select('id,annee,mois,salaire,depense,benefice')
                        ->distinct('annee')
			->from($this->table)
                        ->where('annee', $annee)
			->order_by('numMois');
                        return  $this->db->count_all_results();                
    }
}
