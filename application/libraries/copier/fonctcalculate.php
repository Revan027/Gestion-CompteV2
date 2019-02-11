<?php

class Fonctcalculate
{
        /**
     * 
     * @param string $copier
     * @return array
     */
    function renvoieTableauDesNombres($copier) {

        $nombre_string;
        $nombre_float = 0;
        $depense = 0;
        $tableauDesNombres = array();

        $trie = explode('-', $copier);     //trouve le signe - et sépare a partir du signe -la chaine en plusieurs chaines
        $taille = count($trie); //taille de la chaine pour le parcourir avec le for
       // echo $copier ;

        for ($i = 0; $i < $taille; $i++) { //parcoure le tableau
            //echo "</br>Trie 1 : ".$trie[$i];
            sscanf($trie[$i], "%s", $nombre_string);   //recherche le nombre (string) du debut separer par un espace et l'insert dans un tableau
           // echo "</br>Trie 2 : ".$nombre_string ."</br>";

            if (($this->rechercher($nombre_string)) != false) {

                $nombre_string = str_replace(",", ".", $nombre_string);  //remplace les virgules par des points 
                $nombre_string = str_replace(' ', '', $nombre_string);

                $nombre_float = floatval($nombre_string); //convertit le string en float
                //echo "</br>Bon: " .$nombre_float;

                $tableauDesNombres[] = $nombre_float;
            }
        }

        return $tableauDesNombres;
    }

    /**
     * 
     * @param array $tableauDesNombres
     * @return float
     */
    function renvoieDepense($tableauDesNombres) {

        $depense = 0;

        for ($i = 0; $i < (count($tableauDesNombres)); $i++) {
            $depense = $depense + $tableauDesNombres[$i];
        }

        return $depense;
    }

    /**
     * 
     * @param type $chaine
     * @return boolean
     */
    function rechercher($chaine) {

        $recherche = "#[&!.^$\(\])[{}?+*&@%§£\#/]#"; //caractere a trouver

        $a = strpos($chaine, ','); //recherche si la chaine contient une virgule. Sinon, ce n'est pas une depense;	
        $b = preg_match($recherche, $chaine); //cherche des caracteres spéciaux dans la chaine

        if ($a == false || $b == 1) {
            //echo "Valeur non prise : ".$chaine."</br>";
            return false;
        } else {
            return true;
        }
    }

    function trierMois($mois) 
    {
        $tableauMois = array('Rien', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return array_search($mois, $tableauMois);
    }
    
    function calcul_somme($tableau) 
    {
        
        $total = 0;
        
        foreach($tableau['tableau'] as $new_tableau) {
            $total = $total + $new_tableau->somme;  //accéder pour les foreach
        }
        foreach($tableau['tableau2'] as $new_tableau) {
            $sommeRestante = $new_tableau->salMoyen -  $total;  
        }
        
        $data=array('sommeRestante' => $sommeRestante,'total' => $total);
        return  $data;
    }
}
