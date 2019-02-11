<?php

class SalaireMoyen_model extends CI_Model
{
    protected $table2 = 'salairemoyen';
    private $total = 'total';
    private $salMoyen = 0; 
    private $sommeRestante = 0;
    
    
    /*
    * retourne les entrées de la table salairemoyen
    * 
    * @return array
    */
    function get_all()
    {
        return $this->db->select('salMoyen,total,sommeRestante')
			->from($this->table2)
			->get()
			->result();
    }
    
    function getTotal()
    {
        return $this->db->select('total')
			->from($this->table2)
			->get()
			->result();
    }
    
    
    /*
    * initialise variable de classe 
    * 
    * @param type $salaire
    */
    public function set($salaire)
    { 
        $this->salMoyen =  $salaire; 
    }
    
    
    /*
    * mise a jour du salaire moyen et de la somme restant
    * 
    * @param type $total
    */
    function update($total) 
    {    
        $this->sommeRestante =  $this->salMoyen - $total[0]->total;
        $this->db->set('salMoyen',   $this->salMoyen);
        $this->db->set('sommeRestante',   $this->sommeRestante);
        $this->db->update($this->table2);  
    }
    
    function updateTotal($data) 
    {    
        $this->db->set('total',$data['total']);
        $this->db->set('sommeRestante',$data['sommeRestante']);
        $this->db->update($this->table2);  
    }
  
 
}