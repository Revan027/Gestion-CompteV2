<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
?>    
    <div id="containGrill2">

        <div id="grill1">
            <div id="step"><b>Création de compte </b></div>
            <div id="champ">
                Nom du compte <input type='text' id='nom_compte' maxlength="8"/></br></br>
                <input type='button' name='valider' class="bouton" value="Valider" onclick='addCompte();'/>
            </div>
        </div>  

        <div id="grill2">
            <div id="step"><b>Gestion des catégories</b> </div>
            <div id="champ">

                <input type="checkbox" id="deleteCheck" name="delete" value="Supprimer">
                <label for="subscribeNews">Voulez vous supprimer une catégorie ?</label>
                <SELECT id="categ" size="1">
                <?PHP 
                    for($i=0;$i<$taille;$i++){

                        ?> <OPTION id=" <?PHP  echo $tableau[$i]->id; ?>"> <?PHP  echo $tableau[$i]->libelle;

                    } 

                ?>
                </SELECT><br/><br/>

                Nom de la catégorie à créer <input type='text'  id='nom_categ'/></br></br>
                <input type='button' class="bouton" value="Valider" onclick='choice();'/>   

            </div>
        </div> 
        
       

    </div>    

    <div id="containGrillAlone">

        <div id="grillAlone">

            <div id="step"><b>Catégorisation</b> </div>
            <div id="champ" style="overflow: auto;">    <?PHP // overflow:auto : prend en compte des div floatant a l'intérieur'?> 
                
                <script type="text/javascript" src="<?PHP  echo js_url('slideWordKey'); ?>" > </script>   
        <?PHP

            $j=0;   // id incrementer de chaque select, pour chaque mots clef trouvé
            $memory = "";
            
             
            foreach ($query->result_array() as $tab) //affichage des mots clefs et de al categorie correspondante
            { 
                if($j === 0){
                    
                    echo"<div class='titreCategory'>".$tab['categ_libelle']."</div>
                    <div id='containWordkey' style='overflow: auto;'>";
                    
                }
                
                if($tab['categ_libelle'] != $memory && $j!=0){
                    
                    echo"</div> <div class='titreCategory'>".$tab['categ_libelle']."</div>
                    <div id='containWordkey' style='overflow: auto;'>";
                    
                }
                
                echo "    <div id='boxWordKey'> 
                           <span class='libeCateg' id='".$tab['wordKey_id']."'><input type='text' id='hiddenInput' value='".$tab['wordKey_libelle']."' onblur='updateLibelleWordkey(this);'/></span></br>

                           <SELECT class='categSelect' id='a".$j."' size='1'>
                               <option id='".$tab['categ_id']."'>".$tab['categ_libelle']."</option>";

                           for($i=0;$i<$taille;$i++){  //affichage des categories

                               ?> <OPTION id=" <?PHP  echo $tableau[$i]->id; ?>"> <?PHP  echo $tableau[$i]->libelle;

                           } 

                          echo " </SELECT>  </div> "; 
                
                   

                $j++;
                $memory = $tab['categ_libelle'];
               
            }?>
             </div>
            <div style="clear:both; text-align: center;">   <input  type='button' class="bouton" value="Valider" onclick='updateWordKey();'/></div>

            </div>
        </div>
