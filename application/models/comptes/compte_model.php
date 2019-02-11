<?php

class Compte_model extends CI_Model
{
    protected $table ='comptes';
    private $name = '';
    
    
    public function set($data)   //initialisation de la variable
    { 
        $this->name =  $data;
    }
    
    
    function create($name)  
    { 

        $fields = array(
            
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE ,
                    'unique' => TRUE,
            ),
            'annee' => array(
                    'type' => 'INT',
                    'constraint' => 11,    
            ),
            'numMois' => array(
                    'type' => 'INT',
                    'constraint' => 11,    
            ),
            'mois' => array(
                    'type' =>'VARCHAR',
                    'constraint' => '100',
            ), 
            'salaire' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
            ),
            'depense' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
            ), 
            'benefice' => array(
                    'type' => 'DOUBLE',
                    'null' => TRUE,
            ), 
        );
        
       $this->load->dbforge(); 
       $this->dbforge->add_field($fields); 
       $this->dbforge->create_table($name, TRUE);
       
    }
    
    function get_By_Name($name)  
    {  
        return $this->db->select('id')
			->from($this->table)
                        ->where('nom', $name)
			->get()
			->result();
    }
    
    /*
    * retourne les entrées de la table 
    * 
    * @return array
    */
    function get_all()  
    {  
        return $this->db->select('nom')
			->from($this->table)
			->order_by('nom') 
			->get()
			->result();
    }
    
    
    /*
    * retourne les salaires possible sur un compte choisit
    * 
    * @return array
    */
    function get_libelle_nb($name)  
    {  
        return $this->db->select('libelle_salaire','nb_salaire')
			->from($this->table)
                        ->where('nom', $name)
			->get()
			->result();
    }
      
  
    
    
    
    /*
    * ajoute les entrées 
    * 
    */
    function add()  
    {  
        $this->db->set('nom',$this->name);  

        $this->db->insert($this->table); 
    }
    
    
    
}