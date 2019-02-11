<?php

class xml {
    
    private $name;  //nom fichier xml   
    private $valeur;    //valeurs ofx
    private $date;  //dates ofx
    private $libelle; //libelle ofx
    
    private $libelle_xml;  //libelles restant apres creation du xml
    private $date_xml;  
    private $val_xml; 
    private $depense = 0;
    private $rentre_argent = 0;
    private $benefice = 0;
 
    
    public function __construct()
    {
        $this->name = xml_url('test.xml');
    }
    
    
    /*
    * getteur et setteur
    * 
    * 
    */
    public function set($valeur,$date,$libelle)
    {
        $this->valeur = $valeur;
        $this->date = $date;
        $this->libelle = $libelle;
    }
    
    public function getDepense()
    {
        return  $this->depense;
    }
    
    public function getRentre_argent()
    {
        return $this->rentre_argent;
    }
    
    public function getBenefice()
    {
        return $this->benefice;
    }
    
    public function getLibelleXML()
    {
        return $this->libelle_xml;
    }
    
    public function getDateXML()
    {
        return $this->date_xml;
    }
    
    public function getValXML()
    {
        return $this->val_xml;
    }
    
    /*
    * lecture du xml
    * 
    * @return array
    */
    public function readXML()
    {
        if(file_exists($this->name)){
            
            $data = array();
            $i = 0;
            $xml = simplexml_load_file($this->name);

            foreach($xml as $journee){

                $this->val_xml[$i] = (float)$journee->valeur;
                $this->libelle_xml[$i] = $journee->nom;
                $this->date_xml[$i] = $journee->date;
                $i++;
            }
            return true;
        }else{
            return false;
        }
    }
    
    
    /*
    * calcul des benefices/dépenses et rentrées d' argent depuis le xml
    * 
    * @return void
    */
    public function calculXML($intervalle)
    {
        $categorisation= array();
        $categorisation2 = array();
        $categorisation3;
        
        if(file_exists($this->name)){
                 
            $xml = simplexml_load_file($this->name);
            $i=0;

            foreach($xml as $journee){

                if($intervalle[0] < $i){
                    
                    if( ((float)$journee->valeur) >0){

                       $this->rentre_argent = $this->rentre_argent + (float)$journee->valeur;

                    }else{
                        $this->depense =  (float)($journee->valeur)*-1 +  $this->depense ;
                        array_push($categorisation, $journee->nom);
                        array_push($categorisation2, $journee->valeur);

                    }
                }
                if($intervalle[1] == $i){

                    $this->benefice =  $this->rentre_argent - $this->depense ;
                    $this->benefice = round($this->benefice , 2);
                    $categorisation3['libelle'] = $categorisation;
                    $categorisation3['valeur'] = $categorisation2;
                    return $categorisation3;
                }

            $i++;

            }

        }
    }
   
   
    
    
    /*
    * creation du xml
    * 
    * @return void
    */
    public function createXML($date)      
    {   
        $date_choice = new DateTime($date); 
       

        if( !$this->anneeIsExist($date_choice)){
           
           echo "Annee non existante dans le fichier";
           if(file_exists($this->name)){
                 
               unlink($this->name);
           }
           
        }else if( !$this->monthIsExist($date_choice)){
           
            echo "Mois non existant dans le fichier";
            if(file_exists($this->name)){
                 
               unlink($this->name);
            }
            
        }else if( !$this->monthIsComplete($date_choice)){
            
            echo "Mois non complet. Attendez le début de mois pour télécharger le fichier depuis votre banque";
            if(file_exists($this->name)){
                 
               unlink($this->name);
            }
            
        }else{
             $date_choice2 = new DateTime($date); 
            $taille = count($this->date);
            $doc = new DOMDocument('1.0', 'utf-8');

            $doc->formatOutput = true;  // nous voulons un joli affichage

            $main = $doc->createElement('donnee');  //noeud principale xml
            $main = $doc->appendChild($main);
 
            $date_choice2->modify("+1 month"); //mois d'apres
            $date_choice_after =  $date_choice2->format("Y-m-d");
            $date_choice_after2 = $date_choice2->format('F');

            $date_choice2->modify("-2 month");   //mois d'avant
            $date_choice_before = $date_choice2->format("Y-m-25");
          

            for($i=0;$i<$taille;$i++){

                $date = new DateTime($this->date[$i]);  //chaque du fichier
                $date_formater = $date->format("Y-m-d"); //formatage en date
                $month_current = $date->format( 'M' ); //formatage au mois


                if(strtotime($date_formater) < strtotime($date_choice_after)){ //si mois en cours plus petit en temps passe que le commencemnt de l'intervalle 

                    if(strtotime($date_formater) <= strtotime($date_choice_before)){    //si mois en cours plus petit en temps passe que la fin de l'intervalle on a finit

                        $i = $taille;

                    }else{

                        $sub_main = $doc->createElement('journee');
                        $sub_main = $main->appendChild($sub_main);

                        $title = $doc->createElement('date');
                        $title = $sub_main->appendChild($title);

                        $text = $doc->createTextNode($date_formater);
                        $text = $title->appendChild($text);

                        $title2 = $doc->createElement('valeur');
                        $title2 = $sub_main->appendChild($title2);

                        $text = $doc->createTextNode( $this->valeur[$i]);
                        $text = $title2->appendChild($text);


                        $title3 = $doc->createElement('nom');
                        $title3 = $sub_main->appendChild($title3);

                        $text = $doc->createTextNode( $this->libelle[$i]);
                        $text = $title3->appendChild($text);
                    }

                }

            }
      
        $doc->save($this->name);

       }
    }
    
    
    /*
    * regarde si l'année choisit existe dans le fichier 
    * 
    * @return boolean
    */
    private function anneeIsExist($date) 
    { 
        $retour = false;
        $date =  $date->format("Y");
        $taille = count($this->date);

        for($i=0;$i<$taille;$i++){
            
            $date2 = new DateTime($this->date[$i]);  
            $date2 = $date2->format("Y"); 
            
            if(strtotime($date) ==   strtotime($date2) ){
                return  $retour = true;
            }
        }
       
    }
    
     
    /*
    * regarde si le mois choisit existe dans le fichier 
    * 
    * @return boolean
    */
    private function monthIsExist($date) 
    {
        $retour = false;
        $date =  $date->format("Y-M");
        $taille = count($this->date);
        
        for($i=0;$i<$taille;$i++){
             
            $date2 = new DateTime($this->date[$i]);  
            $date2 = $date2->format("Y-M");
           
            if(strtotime($date) == strtotime($date2)){
               return  $retour = true;
            }
        }
       
    }
    
    
    /*
    * regarde si le mois choisit est complet dans le fichier 
    * 
    * @return boolean
    */
    private function monthIsComplete($date) 
    {
        $retour = false;
        $date->modify("+1 month"); //mois d'apres
        $date = $date->format('M');
        $taille = count($this->date);
        
        for($i=0;$i<$taille;$i++){
             
            $date2 = new DateTime($this->date[$i]);  
            $date2 = $date2->format("M");
           
            if(strtotime($date) == strtotime($date2)){
               return  $retour = true;
            }
        }
       
    }
    
    /*
    * recuperation des valeurs du mois a enregistrer
    * 
    * @return array
    */
    function trierMois($mois) 
    {
        $tableauMois = array('Rien', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        
        if(array_search($mois, $tableauMois) <10){
            return '0'.array_search($mois, $tableauMois);
        }else{
             return array_search($mois, $tableauMois);
        }
       
    }
    
     
}
