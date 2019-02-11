<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
?> 

<?PHP
    echo "  
    <div id='mainConteneur'>  
    
         <div id='boxH'> 
                  <div id='top'>
                    <img class='titre' src='"; echo img_url('titre.png'); echo"' />
                </div>	
                <ul id='mainaccordeon'>

                        <li id='tittleMenu1'>
                            <span id='titre1'><i class='fa fa-list' aria-hidden='true'></i>  Choix du Compte</span>
                        
                        
                        <ul id='accordeon'>
                            <li id='contenuTitre'>";
                                   foreach ($tableau as $tab) 
                                    { 

                                       ?> <div id='lien_compte' onclick='getCompte("<?= $tab->nom ?>",date);'>  <?= $tab->nom ?> </div>
                                  <?PHP  }  ?>
                            </li>


                       <?PHP echo "
                        

                        </ul> 
                </li> 
              

                    <li id='tittleMenu1'>
                        <a id='change2' onclick='viewGraphAjax(date);'><span class='titre'><img src='";  echo img_url('graph.png'); echo"' /> Graphique</a></span>
                    </li>
                    
               
               

                    <li id='tittleMenu1'>
                        <a id='change1' onclick='viewTabAjax(date);'><span class='titre'><img src='";  echo img_url('loupe.png'); echo"' /> Dépenses/Bénéfices</a></span>
                    </li>
                    
                
                
               

                    <li id='tittleMenu1'>
                         <a id='change1' onclick='viewMainDepense();'><span class='titre'> <img src='";  echo img_url('calculette.png'); echo"' />Simulation dépenses</a></span>
                    </li>
                    
               
                
               

                    <li id='tittleMenu1'>
                        <a id='change1' href='"; echo base_url()."config/accueil"; echo "'><span class='titre'><i class='fa fa-cogs' aria-hidden='true'></i> Gestion des Comptes</a>
                    </li>
                    
              
                </ul> 
                

            </div>
              ";


