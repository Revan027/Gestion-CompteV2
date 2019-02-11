<?php

class MainDepense_model extends CI_Model
{
    protected $table = 'mainDepense';
    private $libelle = 'libelle';
    private $somme = 'somme';
 
    
    /*
    * retourne les entrées de la table mainDepense
    * 
    * @return array
    */
    function get_all()  
    {  
        return $this->db->select('id,libelle,somme')
			->from($this->table)
			->order_by('somme','desc') 
			->get()
			->result();
    }
      
    public function set($data)   //initialisation des variables
    { 
        $this->libelle =  $data['libelle'];  
        $this->somme =   $data['somme'];
    }
    
    
    /*
    * supprime les entrées dans la table mainDepense
    * 
    */
    function delete($id)  
    {   
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    
    /*
    * ajoute les entrées dans la table mainDepense
    * 
    */
    function add()  
    {  
        $this->db->set('libelle',   $this->libelle);
        $this->db->set('somme',    $this->somme);    

        $this->db->insert($this->table); 
    }
    
    
    /*
    * retourne la taille de la requete
    * 
    * @return array 
    */
    function count() 
    {         
        $this->db->select('id,libelle,somme')
			->from($this->table)
			->order_by('somme');
                        return  $this->db->count_all_results();                
    }    
}