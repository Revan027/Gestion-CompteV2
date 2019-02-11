<?php

class categorie  extends CI_Model{

    protected $table = 'categorie';
    private $libelle = 'libelle';
 
    
    /*
    * retourne les entrées
    * 
    * @return array
    */
    function get_all()  
    {  
        return $this->db->select('id,libelle')
			->from($this->table)
                        ->where('id !=',45) 
			->get()
			->result();
    }
    
    
    
    
    
    function get_libelle($result)  
    {  
         
        for($i=0;$i<count($result);$i++){

            return $this->db->select('libelle')
			->distinct()
			->from($this->table)
                        ->where('id',$result[$i]->id_categorie) 
			->get()
			->result();
            
        }
       
        
    }
      
    public function set($data)   //initialisation des variables
    { 
        $this->libelle =  $data;  
    }
    
    
    /*
    * supprime les entrées
    * 
    */
    function delete($id)  
    {   
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    
    /*
    * ajoute les entrées
    * 
    */
    function add()  
    {  
        $this->db->set('libelle', $this->libelle); 

        $this->db->insert($this->table); 
    }
    
    
    /*
    * retourne la taille de la requete
    * 
    * @return array 
    */
    function count() 
    {         
        $this->db->select('id,libelle')
			->from($this->table)
                        ->where('id !=',45);
                        return  $this->db->count_all_results();                
    }    

}
