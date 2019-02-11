<?php

class chartCateg  extends CI_Model{

    protected $table = 'chartCateg';
    private $valeur;
    private $libelle;
    private $id_compte;
    private $libelle_compte;

    
    
    
    
    /*
    * retourne les entrées correspondant entre les id de 2 tables
    * 
    * @return array
     *  
    */
    function getInfoCateg()  
    {  
        return $this->db->query('SELECT DISTINCT a.libelle, b.libelle AS lib_b, b.id FROM '.$this->table.' AS a, categorie AS b WHERE b.id = a.id_categorie');        
       
    }
    
    
    
    /*
    * retourne les sommes par categorie suivant le compte
    * 
    * @return query 
    */
    function getSum($id)
    {  
        //return $this->db->query('SELECT DISTINCT categorie.libelle, SUM('.$this->table.'.valeur) AS total FROM '.$this->table.',categorie, wordKey  WHERE '.$this->table.'.id_compte='.$id.' AND workey.id = '.$this->table.'.id_wordKey GROUP BY wordKey.id_categorie');        
        return $this->db->query('SELECT categorie.libelle, SUM('.$this->table.'.valeur) AS total FROM '.$this->table.', wordKey, categorie WHERE '.$this->table.'.id_compte='.$id.' AND '.$this->table.'.id_wordKey=wordKey.id AND wordKey.id_categorie=categorie.id GROUP BY wordKey.id_categorie');        
        
    } 
    
    

    
    
    
    /*
    * initialisation des variables
    * 
    * @return void
    */
    public function set($data)  
    { 
        $this->valeur =  $data['valeur'];
        $this->libelle =  $data['libelle'];
        $this->id_compte =  $data['id_compte'];
        $this->libelle_compte =  $data['table'];
    }
    
    
    
    
    
    
    /*
    * supprime les entrées
    * 
    */
    function delete($id) 
    {  
        $this->db->where('id_compte', $id);
        $this->db->delete($this->table);  
    }
    

    
    /*
    * ajoute les entrées
    * 
    */
    function add()  
    {  
        
        $id_categorie = 45;
        
        for($i=0;$i<count($this->valeur);$i++){
            
            if($this->valeur[$i]<0){    //si c'est une depense, donc negatif
                
                $query = $this->db->query("SELECT id FROM wordKey WHERE INSTR('".$this->libelle[$i]."',libelle)>0 LIMIT 1");    //recupération de l'id categorie en fonction du mot clef
                
                foreach ($query->result_array() as $tab) 
                {                   
                    $id = $tab['id'];
                }
                
                $this->db->query("INSERT INTO ".$this->table." (id_compte, valeur, libelle, libelle_compte, id_wordKey) VALUES ('".$this->id_compte."','".floatval(($this->valeur[$i]))*-1.0."', UPPER('".$this->libelle[$i]."'),'". $this->libelle_compte."','".$id."')");        
                     
            }
           
        } 
    }
   
  
}
