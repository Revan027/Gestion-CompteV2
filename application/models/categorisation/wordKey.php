<?php


class wordKey extends CI_Model{
    
    protected $table = 'wordKey';
    private $libelle;
    private $id_categorie = 45;
    
    
    /*
    * initialisation des variables
    * 
    * @return void
    */
    public function set($data)  
    { 
        $this->libelle =  $data['libelle'];
    }
    
    
     /*
    * ajoute les entrées
    * 
    */
    function add($taille)  
    {              
        for($i=0;$i<count($this->libelle);$i++){
      
            if($taille>0){
                $libe = strval($this->libelle[$i]);
                //$this->db->query("INSERT INTO ".$this->table." (libelle, id_categorie) SELECT '".$this->libelle[$i]."','".$this->id_categorie."' FROM ".$this->table." WHERE NOT EXISTS (SELECT id FROM ".$this->table." WHERE libelle='".$this->libelle[$i]."') LIMIT 1");   
                //$this->db->query("INSERT INTO ".$this->table." (libelle, id_categorie) SELECT '".$this->libelle[$i]."','".$this->id_categorie."' FROM ".$this->table." WHERE NOT EXISTS (SELECT id FROM ".$this->table." WHERE STRCMP(libelle, '".$this->libelle[$i]."')=0) LIMIT 1"); //syntaxe pour ajouter une ligne qui n'existe pas déja
               $this->db->query("INSERT INTO ".$this->table." (libelle, id_categorie) SELECT UPPER('".$this->libelle[$i]."'), UPPER('".$this->id_categorie."') FROM ".$this->table." WHERE NOT EXISTS (SELECT libelle FROM ".$this->table." WHERE INSTR('".$libe."',libelle)>0) LIMIT 1");
                
            }     
            else{   //si pas de requete dans la table

                $this->db->query("INSERT INTO ".$this->table." (libelle, id_categorie) SELECT UPPER('".$this->libelle[$i]."'), UPPER('".$this->id_categorie."')");
                $taille=1;
            }

        }
    }
    
     /*
    * mise a jour 
    * 
    * @param type $data
    */
    function update($data) 
    {   
        for($i=0;$i<count($data['id_categorie']);$i++){  //parcours le tableau des jointures id_categorie

            $this->db->query("UPDATE ".$this->table." SET id_categorie='".$data['id_categorie'][$i]."' WHERE id='".$data['id_wordKey'][$i]."'");
                  
            /*$this->db->like('libelle', $libExplode[0], 'after'); 
             * $this->db->where('SUBSTRING(libelle, 1,'.$taille.')=',$libExplode2); //comparaison entre le mot clef et la recuperation, via SUBSTRING, du libelle coupé avec la taille du mot clef 
            $this->db->update($this->table);*/    
        }  
      
    } 
    
    
     
    
    
    
      
     /*
    * mise a jour si suppression de categorie
    * 
    * @param type $id
    */
    function updateIfSupp($id) 
    { 
            $this->db->set('id_categorie', 45);
            $this->db->where('id_categorie',$id);
            $this->db->update($this->table);  
    } 
    
    
    
    
    
    
     /*
    * retourne les entrées correspondant entre les id de 2 tables
    * 
    * @return array
     *  
    */
    function getAll()  
    {  
        return $this->db->query('SELECT DISTINCT a.id AS wordKey_id, a.libelle AS wordKey_libelle, b.libelle AS categ_libelle, b.id AS categ_id FROM '.$this->table.' AS a, categorie AS b WHERE b.id = a.id_categorie ORDER BY a.id_categorie');        
       
        /*return $this->db->select('chartCateg.libell,categorie.libelle')
                        ->distinct()
			->from('chartCateg')
                        ->join('categorie', 'categorie.id = chartCateg.id_categorie')
			->get()
			->result();*/
       
    }
    
   
    function getCount(){
        
        return $this->db->query('SELECT COUNT(*) FROM '.$this->table.'');
        
    }
}
