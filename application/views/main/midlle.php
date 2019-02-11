<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
?>
   
            <div id="centre">
                <div id="afficherTableau" > </div> 
            </div> 

                <form name='formulaire'>
 
                <div id="centre2">
                    
                    <div id="boxH2"> <i class="fa fa-arrow-down" aria-hidden="true"></i> Ajout sur le compte en cours</div>
                    
                    <div id="containGrill2"> 
                        
                      
                        
                        <div id="grill1">
                            <div id="step"><b>Etape 1 :</b> Enregistrez le fichier 'OFX MONEY' depuis votre banque </div>
                            <div id="champ">
                                <img src='<?PHP  echo img_url('aide.png');?>'/>
                            </div>
                        </div>  
                        
                        <div id="grill2">    
                            <div id="step"><b>Etape 2 :</b>  Choississez le mois et l'année </div>
                            <div id="champ">
                  
                                <div class="container">

                                    <div class="dropdown">

                                        <div class="select">
                                          <span>Selection de l'année</span>
                                          <i class="fa fa-chevron-left"></i>
                                        </div>

                                        <input type="hidden" name="annee" id="annee"/>
                                        <ul class="dropdown-menu">
                                            <li id="2018">2018</li>
                                            <li id="2019">2019</li>
                                            <li id="2017">2017</li>
                                        </ul>

                                    </div>

                                    <span class="msg"></span>
                                </div>

                                <div class="container">

                                    <div class="dropdown">
                                        
                                        <div class="select">
                                          <span>Selection du mois</span>
                                          <i class="fa fa-chevron-left"></i>
                                        </div>

                                        <input type="hidden" name="mois" id="mois">
                                        <ul class="dropdown-menu">
                                            <li id="Janvier">Janvier</li>
                                            <li id="Février">Février</li>
                                            <li id="Mars">Mars</li>
                                            <li id="Avril">Avril</li>
                                            <li id="Mai">Mai</li>
                                            <li id="Juin">Juin</li>
                                             <li id="Juillet">Juillet</li>
                                            <li id="Aout">Aout</li>
                                            <li id="Septembre">Septembre</li>
                                            <li id="Octobre">Octobre</li>
                                            <li id="Novembre">Novembre</li>
                                            <li id="Décembre">Décembre</li>
                                        </ul>
                                        
                                    </div>

                                    <span class="msg"></span>


                                    <input type='button' name='calculer' class="bouton" value="Valider" onclick='showIntervalle();'/>
                                    <input type='reset' name='reset' class="bouton" value="Annuler" onclick='raz();' /><br/>   
                                </div>     
                            </div>  
                        </div> 
                        
                        
                    </div>  
                </div>     
            </form>	 
      </div>  